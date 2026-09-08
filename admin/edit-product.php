```php
<?php

session_start();

if(!isset($_SESSION["admin_id"])){
    header("Location: login.php");
    exit();
}

require_once "../config.php";

$currentPage = "products";
$pageTitle = "Edit Product";
$pageDescription = "Update product information";


// --------------------------------------------------
// GET PRODUCT ID
// --------------------------------------------------

if(!isset($_GET["id"]) || !is_numeric($_GET["id"])){

    header("Location: products.php");
    exit();

}

$productId = (int) $_GET["id"];


// --------------------------------------------------
// FETCH PRODUCT
// --------------------------------------------------

$productQuery = "
    SELECT *
    FROM products
    WHERE id = $productId
    LIMIT 1
";

$productResult = mysqli_query($conn, $productQuery);

if(!$productResult){

    die("Failed to load product: " . mysqli_error($conn));

}

if(mysqli_num_rows($productResult) === 0){

    header("Location: products.php");
    exit();

}

$product = mysqli_fetch_assoc($productResult);


// --------------------------------------------------
// FETCH CATEGORIES
// --------------------------------------------------

$categoryQuery = "
    SELECT id, title
    FROM categories
    ORDER BY title ASC
";

$categoryResult = mysqli_query($conn, $categoryQuery);

if(!$categoryResult){

    die("Failed to load categories: " . mysqli_error($conn));

}


// --------------------------------------------------
// VARIABLES
// --------------------------------------------------

$error = "";
$success = false;


// --------------------------------------------------
// UPDATE PRODUCT
// --------------------------------------------------

if(isset($_POST["update_product"])){

    $category_id = (int) $_POST["category_id"];

    $product_name = trim($_POST["product_name"]);
    $description = trim($_POST["description"]);

    $price = (float) $_POST["price"];

    $discount_price = trim($_POST["discount_price"]);

    $stock_quantity = (int) $_POST["stock_quantity"];

    $product_condition = $_POST["product_condition"];

    $brand = trim($_POST["brand"]);

    $specifications = trim($_POST["specifications"]);

    $status = $_POST["status"];


    // ----------------------------------------------
    // VALIDATION
    // ----------------------------------------------

    if(
        $category_id <= 0 ||
        $product_name === "" ||
        $description === "" ||
        $price < 0
    ){

        $error = "Please fill in all required fields correctly.";

    }

    elseif($discount_price !== "" && (float)$discount_price >= $price){

        $error = "Discount price must be lower than the original price.";

    }

    elseif($stock_quantity < 0){

        $error = "Stock quantity cannot be negative.";

    }

    elseif(
        !in_array($product_condition, ["New", "Used"])
    ){

        $error = "Invalid product condition.";

    }

    elseif(
        !in_array($status, ["Active", "Inactive"])
    ){

        $error = "Invalid product status.";

    }


    // ----------------------------------------------
    // IMAGE
    // ----------------------------------------------

    $newImage = $product["image"];

    if($error === "" && isset($_FILES["image"]) && $_FILES["image"]["error"] !== UPLOAD_ERR_NO_FILE){

        $uploadDirectory = __DIR__ . "/uploads/products/";

        if(!is_dir($uploadDirectory)){

            mkdir($uploadDirectory, 0777, true);

        }


        // Check image
        $imageInfo = getimagesize($_FILES["image"]["tmp_name"]);

        if($imageInfo === false){

            $error = "The uploaded file is not a valid image.";

        }

        // Check size
        elseif($_FILES["image"]["size"] > 5 * 1024 * 1024){

            $error = "Image size must not exceed 5MB.";

        }

        else{

            $allowedTypes = [

                "image/jpeg" => "jpg",
                "image/png"  => "png",
                "image/webp" => "webp",
                "image/gif"  => "gif"

            ];

            $mimeType = $imageInfo["mime"];

            if(!isset($allowedTypes[$mimeType])){

                $error = "Only JPG, PNG, WEBP and GIF images are allowed.";

            }

            else{

                $extension = $allowedTypes[$mimeType];

                $newFileName =
                    "product_" .
                    time() .
                    "_" .
                    uniqid() .
                    "." .
                    $extension;

                $destination = $uploadDirectory . $newFileName;

                if(move_uploaded_file(
                    $_FILES["image"]["tmp_name"],
                    $destination
                )){

                    $newImage = "uploads/products/" . $newFileName;

                }

                else{

                    $error = "Failed to upload the new image.";

                }

            }

        }

    }


    // ----------------------------------------------
    // UPDATE DATABASE
    // ----------------------------------------------

    if($error === ""){

        if($discount_price !== ""){

            $discountValue = (float) $discount_price;

            $updateQuery = "
                UPDATE products
                SET
                    category_id = ?,
                    product_name = ?,
                    description = ?,
                    price = ?,
                    discount_price = ?,
                    stock_quantity = ?,
                    product_condition = ?,
                    brand = ?,
                    specifications = ?,
                    image = ?,
                    status = ?
                WHERE id = ?
            ";

            $stmt = mysqli_prepare($conn, $updateQuery);

            mysqli_stmt_bind_param(
                $stmt,
                "issddisssssi",
                $category_id,
                $product_name,
                $description,
                $price,
                $discountValue,
                $stock_quantity,
                $product_condition,
                $brand,
                $specifications,
                $newImage,
                $status,
                $productId
            );

        }

        else{

            $updateQuery = "
                UPDATE products
                SET
                    category_id = ?,
                    product_name = ?,
                    description = ?,
                    price = ?,
                    discount_price = NULL,
                    stock_quantity = ?,
                    product_condition = ?,
                    brand = ?,
                    specifications = ?,
                    image = ?,
                    status = ?
                WHERE id = ?
            ";

            $stmt = mysqli_prepare($conn, $updateQuery);

            mysqli_stmt_bind_param(
                $stmt,
                "issdisssssi",
                $category_id,
                $product_name,
                $description,
                $price,
                $stock_quantity,
                $product_condition,
                $brand,
                $specifications,
                $newImage,
                $status,
                $productId
            );

        }


        if(mysqli_stmt_execute($stmt)){

            // Delete old image only when a new image was uploaded
            if(
                $newImage !== $product["image"] &&
                !empty($product["image"])
            ){

                $oldImagePath = __DIR__ . "/" . $product["image"];

                if(file_exists($oldImagePath)){

                    unlink($oldImagePath);

                }

            }

            $success = true;

            // Update displayed product values
            $product["category_id"] = $category_id;
            $product["product_name"] = $product_name;
            $product["description"] = $description;
            $product["price"] = $price;
            $product["discount_price"] = $discount_price;
            $product["stock_quantity"] = $stock_quantity;
            $product["product_condition"] = $product_condition;
            $product["brand"] = $brand;
            $product["specifications"] = $specifications;
            $product["image"] = $newImage;
            $product["status"] = $status;

        }

        else{

            $error = "Failed to update product: " . mysqli_stmt_error($stmt);

            // Remove newly uploaded image if database update failed
            if(
                $newImage !== $product["image"] &&
                !empty($newImage)
            ){

                $newImagePath = __DIR__ . "/" . $newImage;

                if(file_exists($newImagePath)){

                    unlink($newImagePath);

                }

            }

        }

        mysqli_stmt_close($stmt);

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Product | Ultimate Admin</title>

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="assets/css/admin.css"
    >


    <style>

        .edit-product-wrapper{

            max-width:1100px;
            margin:0 auto;

        }


        .page-header{

            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:20px;
            margin-bottom:30px;

        }


        .page-header h1{

            margin:0;
            font-size:28px;

        }


        .page-header p{

            margin:6px 0 0;
            color:#aaa;
            font-size:14px;

        }


        .back-btn{

            display:inline-flex;
            align-items:center;
            gap:8px;

            padding:12px 18px;

            border-radius:12px;

            text-decoration:none;

            color:#fff;

            background:rgba(255,255,255,0.06);

            border:1px solid rgba(255,255,255,0.1);

            transition:0.3s;

        }


        .back-btn:hover{

            background:rgba(138,43,226,0.2);

            border-color:rgba(138,43,226,0.5);

        }


        .form-container{

            background:rgba(255,255,255,0.035);

            border:1px solid rgba(255,255,255,0.08);

            border-radius:20px;

            padding:30px;

            backdrop-filter:blur(18px);

            box-shadow:0 20px 60px rgba(0,0,0,0.3);

        }


        .form-grid{

            display:grid;

            grid-template-columns:repeat(2, 1fr);

            gap:22px;

        }


        .form-group{

            display:flex;

            flex-direction:column;

            gap:8px;

        }


        .form-group.full{

            grid-column:1 / -1;

        }


        .form-group label{

            font-size:13px;

            font-weight:500;

            color:#ddd;

        }


        .form-group label span{

            color:#a855f7;

        }


        .form-group input,
        .form-group select,
        .form-group textarea{

            width:100%;

            box-sizing:border-box;

            padding:14px 15px;

            border-radius:12px;

            border:1px solid rgba(255,255,255,0.1);

            background:#111;

            color:#fff;

            outline:none;

            font-family:Poppins,sans-serif;

            transition:0.3s;

        }


        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus{

            border-color:#8b5cf6;

            box-shadow:0 0 0 3px rgba(139,92,246,0.12);

        }


        .form-group textarea{

            min-height:130px;

            resize:vertical;

        }


        .form-group select option{

            background:#111;

            color:#fff;

        }


        .current-image{

            margin-top:5px;

            display:flex;

            align-items:center;

            gap:15px;

        }


        .current-image img{

            width:90px;

            height:90px;

            object-fit:cover;

            border-radius:14px;

            border:1px solid rgba(255,255,255,0.1);

        }


        .no-image{

            width:90px;

            height:90px;

            border-radius:14px;

            display:flex;

            align-items:center;

            justify-content:center;

            background:rgba(255,255,255,0.05);

            color:#777;

            font-size:28px;

        }


        .image-note{

            color:#888;

            font-size:12px;

        }


        .error-message{

            margin-bottom:25px;

            padding:15px 18px;

            border-radius:12px;

            background:rgba(239,68,68,0.1);

            border:1px solid rgba(239,68,68,0.3);

            color:#fca5a5;

            font-size:14px;

        }


        .form-actions{

            margin-top:30px;

            display:flex;

            justify-content:flex-end;

            gap:12px;

        }


        .cancel-btn,
        .save-btn{

            padding:13px 22px;

            border-radius:12px;

            font-family:Poppins,sans-serif;

            font-weight:600;

            cursor:pointer;

            text-decoration:none;

            transition:0.3s;

        }


        .cancel-btn{

            color:#ddd;

            background:rgba(255,255,255,0.06);

            border:1px solid rgba(255,255,255,0.1);

        }


        .save-btn{

            color:#fff;

            background:linear-gradient(135deg,#7c3aed,#a855f7);

            border:none;

            box-shadow:0 10px 25px rgba(124,58,237,0.25);

        }


        .save-btn:hover{

            transform:translateY(-2px);

            box-shadow:0 15px 30px rgba(124,58,237,0.35);

        }


        .cancel-btn:hover{

            background:rgba(255,255,255,0.1);

        }


        /* SUCCESS MODAL */

        .success-modal{

            position:fixed;

            inset:0;

            background:rgba(0,0,0,0.72);

            backdrop-filter:blur(8px);

            display:flex;

            align-items:center;

            justify-content:center;

            padding:20px;

            z-index:9999;

        }


        .success-box{

            width:min(440px,100%);

            padding:35px;

            text-align:center;

            border-radius:22px;

            background:#151515;

            border:1px solid rgba(168,85,247,0.3);

            box-shadow:0 30px 80px rgba(0,0,0,0.6);

        }


        .success-icon{

            width:70px;

            height:70px;

            margin:0 auto 20px;

            border-radius:50%;

            display:flex;

            align-items:center;

            justify-content:center;

            background:rgba(34,197,94,0.12);

            border:1px solid rgba(34,197,94,0.3);

            color:#4ade80;

            font-size:30px;

        }


        .success-box h2{

            margin:0 0 10px;

        }


        .success-box p{

            margin:0 0 25px;

            color:#aaa;

            font-size:14px;

        }


        .modal-actions{

            display:flex;

            gap:12px;

            justify-content:center;

        }


        .modal-actions a{

            padding:12px 18px;

            border-radius:11px;

            text-decoration:none;

            font-size:13px;

            font-weight:600;

        }


        .view-btn{

            color:#fff;

            background:linear-gradient(135deg,#7c3aed,#a855f7);

        }


        .continue-btn{

            color:#ddd;

            background:rgba(255,255,255,0.07);

            border:1px solid rgba(255,255,255,0.1);

        }


        /* RESPONSIVE */

        @media(max-width:800px){

            .form-grid{

                grid-template-columns:1fr;

            }

            .form-group.full{

                grid-column:auto;

            }

            .page-header{

                align-items:flex-start;

                flex-direction:column;

            }

        }


        @media(max-width:500px){

            .form-container{

                padding:20px;

            }

            .page-header h1{

                font-size:23px;

            }

            .form-actions{

                flex-direction:column;

            }

            .cancel-btn,
            .save-btn{

                width:100%;

                text-align:center;

            }

            .modal-actions{

                flex-direction:column;

            }

            .modal-actions a{

                display:block;

            }

        }

    </style>

</head>


<body>


<?php include "includes/sidebar.php"; ?>


<main class="admin-main">


    <?php include "includes/topbar.php"; ?>


    <section class="admin-content">


        <div class="edit-product-wrapper">


            <div class="page-header">

                <div>

                    <!-- <h1>Edit Product</h1> -->

                    <p>
                        Update the information for
                        <?= htmlspecialchars($product["product_name"]); ?>
                    </p>

                </div>


                <a
                    href="products.php"
                    class="back-btn"
                >

                    <i class="fa-solid fa-arrow-left"></i>

                    Back to Products

                </a>

            </div>


            <?php if($error !== ""): ?>

                <div class="error-message">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <?= htmlspecialchars($error); ?>

                </div>

            <?php endif; ?>


            <div class="form-container">


                <form
                    method="POST"
                    enctype="multipart/form-data"
                >


                    <div class="form-grid">


                        <!-- CATEGORY -->

                        <div class="form-group">

                            <label>
                                Category <span>*</span>
                            </label>

                            <select
                                name="category_id"
                                required
                            >

                                <option value="">
                                    Select Category
                                </option>


                                <?php while($category = mysqli_fetch_assoc($categoryResult)): ?>

                                    <option
                                        value="<?= $category["id"]; ?>"
                                        <?= $product["category_id"] == $category["id"] ? "selected" : ""; ?>
                                    >

                                        <?= htmlspecialchars($category["title"]); ?>

                                    </option>

                                <?php endwhile; ?>

                            </select>

                        </div>


                        <!-- PRODUCT NAME -->

                        <div class="form-group">

                            <label>
                                Product Name <span>*</span>
                            </label>

                            <input
                                type="text"
                                name="product_name"
                                value="<?= htmlspecialchars($product["product_name"]); ?>"
                                required
                            >

                        </div>


                        <!-- PRICE -->

                        <div class="form-group">

                            <label>
                                Price <span>*</span>
                            </label>

                            <input
                                type="number"
                                name="price"
                                step="0.01"
                                min="0"
                                value="<?= htmlspecialchars($product["price"]); ?>"
                                required
                            >

                        </div>


                        <!-- DISCOUNT -->

                        <div class="form-group">

                            <label>
                                Discount Price
                            </label>

                            <input
                                type="number"
                                name="discount_price"
                                step="0.01"
                                min="0"
                                value="<?= htmlspecialchars($product["discount_price"] ?? ""); ?>"
                                placeholder="Optional"
                            >

                        </div>


                        <!-- STOCK -->

                        <div class="form-group">

                            <label>
                                Stock Quantity <span>*</span>
                            </label>

                            <input
                                type="number"
                                name="stock_quantity"
                                min="0"
                                value="<?= htmlspecialchars($product["stock_quantity"]); ?>"
                                required
                            >

                        </div>


                        <!-- CONDITION -->

                        <div class="form-group">

                            <label>
                                Condition <span>*</span>
                            </label>

                            <select
                                name="product_condition"
                                required
                            >

                                <option
                                    value="New"
                                    <?= $product["product_condition"] === "New" ? "selected" : ""; ?>
                                >
                                    New
                                </option>

                                <option
                                    value="Used"
                                    <?= $product["product_condition"] === "Used" ? "selected" : ""; ?>
                                >
                                    Used
                                </option>

                            </select>

                        </div>


                        <!-- BRAND -->

                        <div class="form-group">

                            <label>
                                Brand
                            </label>

                            <input
                                type="text"
                                name="brand"
                                value="<?= htmlspecialchars($product["brand"] ?? ""); ?>"
                                placeholder="Optional"
                            >

                        </div>


                        <!-- STATUS -->

                        <div class="form-group">

                            <label>
                                Status <span>*</span>
                            </label>

                            <select
                                name="status"
                                required
                            >

                                <option
                                    value="Active"
                                    <?= $product["status"] === "Active" ? "selected" : ""; ?>
                                >
                                    Active
                                </option>

                                <option
                                    value="Inactive"
                                    <?= $product["status"] === "Inactive" ? "selected" : ""; ?>
                                >
                                    Inactive
                                </option>

                            </select>

                        </div>


                        <!-- DESCRIPTION -->

                        <div class="form-group full">

                            <label>
                                Description <span>*</span>
                            </label>

                            <textarea
                                name="description"
                                required
                            ><?= htmlspecialchars($product["description"]); ?></textarea>

                        </div>


                        <!-- SPECIFICATIONS -->

                        <div class="form-group full">

                            <label>
                                Specifications
                            </label>

                            <textarea
                                name="specifications"
                                placeholder="Enter product specifications"
                            ><?= htmlspecialchars($product["specifications"] ?? ""); ?></textarea>

                        </div>


                        <!-- IMAGE -->

                        <div class="form-group full">

                            <label>
                                Product Image
                            </label>


                            <div class="current-image">

                                <?php if(!empty($product["image"])): ?>

                                    <img
                                        src="<?= htmlspecialchars($product["image"]); ?>"
                                        alt="Current Product Image"
                                    >

                                <?php else: ?>

                                    <div class="no-image">

                                        <i class="fa-solid fa-image"></i>

                                    </div>

                                <?php endif; ?>


                                <div>

                                    <div class="image-note">

                                        Current product image

                                    </div>

                                    <div class="image-note">

                                        Upload a new image only if you want to replace it.

                                    </div>

                                </div>

                            </div>


                            <input
                                type="file"
                                name="image"
                                accept="image/jpeg,image/png,image/webp,image/gif"
                            >

                        </div>


                    </div>


                    <div class="form-actions">


                        <a
                            href="products.php"
                            class="cancel-btn"
                        >

                            Cancel

                        </a>


                        <button
                            type="submit"
                            name="update_product"
                            class="save-btn"
                        >

                            <i class="fa-solid fa-floppy-disk"></i>

                            Save Changes

                        </button>


                    </div>


                </form>


            </div>


        </div>


    </section>


    <?php include "includes/footer.php"; ?>


</main>


<?php if($success): ?>

    <div class="success-modal">

        <div class="success-box">

            <div class="success-icon">

                <i class="fa-solid fa-check"></i>

            </div>


            <h2>Product Updated</h2>

            <p>
                The product has been successfully updated.
            </p>


            <div class="modal-actions">

                <a
                    href="products.php"
                    class="view-btn"
                >
                    View Products
                </a>


                <a
                    href="edit-product.php?id=<?= $productId; ?>"
                    class="continue-btn"
                >
                    Continue Editing
                </a>

            </div>

        </div>

    </div>

<?php endif; ?>


</body>

</html>

