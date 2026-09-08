```php
<?php

session_start();

/* =========================================
   ADMIN PROTECTION
========================================= */

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

/* =========================================
   DATABASE CONNECTION
========================================= */

require_once "../config.php";

/* =========================================
   PAGE INFORMATION
========================================= */

$currentPage = "products";
$pageTitle = "Add Product";
$pageDescription = "Add a new product to your Ultimate marketplace";

$success = false;
$error = "";

/* =========================================
   FETCH ALL CATEGORIES
========================================= */

$categoryQuery = "
    SELECT id, title
    FROM categories
    ORDER BY title ASC
";

$categoryResult = mysqli_query($conn, $categoryQuery);

if (!$categoryResult) {
    $error = "Unable to load categories.";
}

/* =========================================
   ADD PRODUCT
========================================= */

if (isset($_POST["add_product"])) {

    $category_id = (int) $_POST["category_id"];

    $product_name = trim($_POST["product_name"]);

    $description = trim($_POST["description"]);

    $price = (float) $_POST["price"];

    $discount_price = !empty($_POST["discount_price"])
        ? (float) $_POST["discount_price"]
        : null;

    $stock_quantity = (int) $_POST["stock_quantity"];

    $product_condition = $_POST["product_condition"];

    $brand = trim($_POST["brand"]);

    $specifications = trim($_POST["specifications"]);

    $status = $_POST["status"];


    /* =========================================
       BASIC VALIDATION
    ========================================= */

    if (
        empty($product_name) ||
        empty($description) ||
        $category_id <= 0
    ) {

        $error = "Please fill in all required fields.";

    } elseif ($price < 0) {

        $error = "Price cannot be negative.";

    } elseif ($discount_price !== null && $discount_price >= $price) {

        $error = "Discount price must be lower than the original price.";

    } elseif ($stock_quantity < 0) {

        $error = "Stock quantity cannot be negative.";

    } elseif (
        !in_array($product_condition, ["New", "Used"])
    ) {

        $error = "Invalid product condition.";

    } elseif (
        !in_array($status, ["Active", "Inactive"])
    ) {

        $error = "Invalid product status.";

    } else {

        /* =========================================
           IMAGE UPLOAD
        ========================================= */

        $image = "";

        if (
            isset($_FILES["image"]) &&
            $_FILES["image"]["error"] === UPLOAD_ERR_OK
        ) {

            $uploadFolder = "uploads/products/";

            /* Create folder if it doesn't exist */

            if (!is_dir($uploadFolder)) {

                mkdir($uploadFolder, 0777, true);

            }


            /* Check that uploaded file is actually an image */

            $imageInfo = getimagesize($_FILES["image"]["tmp_name"]);

            if ($imageInfo === false) {

                $error = "The uploaded file is not a valid image.";

            } else {

                /* Allowed image types */

                $allowedTypes = [
                    "image/jpeg" => "jpg",
                    "image/png"  => "png",
                    "image/webp" => "webp",
                    "image/gif"  => "gif"
                ];

                $mimeType = $imageInfo["mime"];

                if (!isset($allowedTypes[$mimeType])) {

                    $error = "Only JPG, PNG, WEBP and GIF images are allowed.";

                } else {

                    /* Maximum file size: 5MB */

                    if ($_FILES["image"]["size"] > 5 * 1024 * 1024) {

                        $error = "Image size must not exceed 5MB.";

                    } else {

                        /*
                         * Generate a unique filename
                         * so two products cannot accidentally
                         * overwrite each other's images.
                         */

                        $extension = $allowedTypes[$mimeType];

                        $newFileName =
                            "product_" .
                            time() .
                            "_" .
                            uniqid() .
                            "." .
                            $extension;

                        $destination =
                            $uploadFolder .
                            $newFileName;


                        if (
                            move_uploaded_file(
                                $_FILES["image"]["tmp_name"],
                                $destination
                            )
                        ) {

                            $image = $destination;

                        } else {

                            $error = "Failed to upload the product image.";

                        }
                    }
                }
            }

        } else {

            $error = "Please select a product image.";

        }


        /* =========================================
           INSERT INTO DATABASE
        ========================================= */

        if (empty($error)) {

            /*
             * If there is a discount price,
             * use a normal placeholder.
             */

            if ($discount_price !== null) {

                $sql = "
                    INSERT INTO products (
                        category_id,
                        product_name,
                        description,
                        price,
                        discount_price,
                        stock_quantity,
                        product_condition,
                        brand,
                        specifications,
                        image,
                        status
                    )
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ";

                $stmt = mysqli_prepare($conn, $sql);

                mysqli_stmt_bind_param(
                    $stmt,
                    "issddisssss",
                    $category_id,
                    $product_name,
                    $description,
                    $price,
                    $discount_price,
                    $stock_quantity,
                    $product_condition,
                    $brand,
                    $specifications,
                    $image,
                    $status
                );

            } else {

                /*
                 * No discount price:
                 * store NULL in the database.
                 */

                $sql = "
                    INSERT INTO products (
                        category_id,
                        product_name,
                        description,
                        price,
                        discount_price,
                        stock_quantity,
                        product_condition,
                        brand,
                        specifications,
                        image,
                        status
                    )
                    VALUES (?, ?, ?, ?, NULL, ?, ?, ?, ?, ?, ?)
                ";

                $stmt = mysqli_prepare($conn, $sql);

                mysqli_stmt_bind_param(
                    $stmt,
                    "issdisssss",
                    $category_id,
                    $product_name,
                    $description,
                    $price,
                    $stock_quantity,
                    $product_condition,
                    $brand,
                    $specifications,
                    $image,
                    $status
                );
            }


            /* =========================================
               EXECUTE INSERT
            ========================================= */

            if (mysqli_stmt_execute($stmt)) {

                $success = true;

            } else {

                $error = "Failed to add product: " . mysqli_error($conn);

                /*
                 * If database insertion fails after
                 * uploading the image, remove the
                 * unused image.
                 */

                if (!empty($image) && file_exists($image)) {

                    unlink($image);

                }
            }

            mysqli_stmt_close($stmt);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add Product | Ultimate Admin</title>


    <!-- GOOGLE FONT -->

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">


    <!-- FONT AWESOME -->

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


    <!-- ADMIN CSS -->

    <link rel="stylesheet"
          href="assets/css/admin.css">


    <style>

        /* =========================================
           PAGE
        ========================================= */

        .admin-content {
            padding: 35px;
        }


        /* =========================================
           PAGE HEADER
        ========================================= */

        .product-page-header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 20px;

            margin-bottom: 25px;
        }


        .product-page-header h2 {

            color: #ffffff;

            font-size: 23px;

            font-weight: 600;

            margin: 0;
        }


        .product-page-header p {

            color: #918697;

            font-size: 11px;

            margin-top: 6px;
        }


        .back-products {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 11px 17px;

            background: #19141f;

            border: 1px solid rgba(255,255,255,.07);

            border-radius: 10px;

            color: #d9d0df;

            text-decoration: none;

            font-size: 10px;

            transition: .25s;
        }


        .back-products:hover {

            border-color: rgba(155,101,211,.5);

            color: #ffffff;

            transform: translateY(-2px);
        }


        /* =========================================
           FORM CONTAINER
        ========================================= */

        .product-form-card {

            background: linear-gradient(
                145deg,
                #1b1621,
                #100d13
            );

            border: 1px solid rgba(255,255,255,.07);

            border-radius: 20px;

            padding: 30px;

            box-shadow:
                0 20px 60px rgba(0,0,0,.20);
        }


        /* =========================================
           FORM GRID
        ========================================= */

        .product-form-grid {

            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 22px;
        }


        .product-field {

            display: flex;

            flex-direction: column;

            gap: 8px;
        }


        .product-field.full {

            grid-column: 1 / -1;
        }


        .product-field label {

            color: #cfc5d5;

            font-size: 11px;

            font-weight: 500;
        }


        .required-star {

            color: #a96ddd;

            margin-left: 3px;
        }


        /* =========================================
           INPUTS
        ========================================= */

        .product-field input,
        .product-field select,
        .product-field textarea {

            width: 100%;

            box-sizing: border-box;

            padding: 14px 15px;

            background: #0f0c12;

            border: 1px solid rgba(255,255,255,.08);

            border-radius: 11px;

            color: #ffffff;

            outline: none;

            font-family: Poppins, sans-serif;

            font-size: 11px;

            transition: .25s;
        }


        .product-field input::placeholder,
        .product-field textarea::placeholder {

            color: #625a67;
        }


        .product-field input:focus,
        .product-field select:focus,
        .product-field textarea:focus {

            border-color: #9b65d3;

            box-shadow:
                0 0 0 3px rgba(155,101,211,.10);
        }


        .product-field textarea {

            min-height: 125px;

            resize: vertical;
        }


        .product-field select option {

            background: #17131d;

            color: #ffffff;
        }


        /* =========================================
           FILE INPUT
        ========================================= */

        .product-field input[type="file"] {

            padding: 11px;

            cursor: pointer;
        }


        .image-help {

            color: #716877;

            font-size: 9px;

            margin-top: -2px;
        }


        /* =========================================
           SAVE BUTTON
        ========================================= */

        .product-submit-area {

            margin-top: 30px;

            padding-top: 25px;

            border-top: 1px solid rgba(255,255,255,.06);

            display: flex;

            justify-content: flex-end;
        }


        .save-product-btn {

            border: none;

            padding: 14px 24px;

            border-radius: 11px;

            background:
                linear-gradient(
                    135deg,
                    #9b65d3,
                    #602d86
                );

            color: #ffffff;

            font-family: Poppins, sans-serif;

            font-size: 11px;

            font-weight: 600;

            cursor: pointer;

            display: flex;

            align-items: center;

            gap: 9px;

            transition: .25s;
        }


        .save-product-btn:hover {

            transform: translateY(-2px);

            box-shadow:
                0 12px 30px rgba(104,47,137,.35);
        }


        /* =========================================
           ERROR MESSAGE
        ========================================= */

        .error-message {

            margin-bottom: 20px;

            padding: 14px 16px;

            border-radius: 11px;

            background: rgba(180,40,60,.10);

            border: 1px solid rgba(220,70,90,.20);

            color: #ff9eac;

            font-size: 10px;

            display: flex;

            align-items: center;

            gap: 10px;
        }


        /* =========================================
           SUCCESS MODAL
        ========================================= */

        .success-overlay {

            position: fixed;

            inset: 0;

            background: rgba(0,0,0,.75);

            backdrop-filter: blur(10px);

            -webkit-backdrop-filter: blur(10px);

            display: flex;

            align-items: center;

            justify-content: center;

            z-index: 9999;

            padding: 20px;
        }


        .success-modal {

            width: 100%;

            max-width: 420px;

            background:
                linear-gradient(
                    145deg,
                    #21192a,
                    #100c14
                );

            border: 1px solid rgba(255,255,255,.09);

            border-radius: 22px;

            padding: 35px 30px;

            text-align: center;

            box-shadow:
                0 30px 80px rgba(0,0,0,.55);

            animation: modalAppear .3s ease;
        }


        @keyframes modalAppear {

            from {

                opacity: 0;

                transform: translateY(20px) scale(.96);

            }

            to {

                opacity: 1;

                transform: translateY(0) scale(1);

            }
        }


        .success-icon {

            width: 70px;

            height: 70px;

            margin: 0 auto 18px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            background: rgba(92,214,137,.10);

            border: 1px solid rgba(92,214,137,.20);

            color: #6ee7a0;

            font-size: 30px;
        }


        .success-modal h3 {

            color: #ffffff;

            font-size: 18px;

            margin: 0 0 10px;
        }


        .success-modal p {

            color: #94899b;

            font-size: 10px;

            line-height: 1.7;

            margin-bottom: 25px;
        }


        .modal-actions {

            display: flex;

            gap: 10px;
        }


        .modal-btn {

            flex: 1;

            padding: 12px;

            border-radius: 10px;

            text-decoration: none;

            font-size: 10px;

            transition: .25s;
        }


        .modal-primary {

            background: #8f5bc5;

            color: #ffffff;
        }


        .modal-secondary {

            background: #29222f;

            color: #d8cfdd;

            border: 1px solid rgba(255,255,255,.06);
        }


        .modal-btn:hover {

            transform: translateY(-2px);
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 900px) {

            .admin-content {

                padding: 25px;
            }

        }


        @media (max-width: 700px) {

            .admin-content {

                padding: 20px;
            }


            .product-page-header {

                flex-direction: column;

                align-items: flex-start;
            }


            .product-form-card {

                padding: 20px;
            }


            .product-form-grid {

                grid-template-columns: 1fr;
            }


            .product-field.full {

                grid-column: auto;
            }


            .product-submit-area {

                justify-content: stretch;
            }


            .save-product-btn {

                width: 100%;

                justify-content: center;
            }


            .modal-actions {

                flex-direction: column;
            }

        }


        @media (max-width: 450px) {

            .admin-content {

                padding: 15px;
            }


            .product-form-card {

                padding: 16px;
            }


            .product-page-header h2 {

                font-size: 20px;
            }

        }

    </style>

</head>


<body>


<?php include "includes/sidebar.php"; ?>


<main class="admin-main">


    <?php include "includes/topbar.php"; ?>


    <section class="admin-content">


        <!-- =====================================
             PAGE HEADER
        ====================================== -->

        <div class="product-page-header">

            <!-- <div>

                <h2>Add New Product</h2>

                <p>
                    Add a product to any category in the Ultimate marketplace.
                </p>

            </div> -->


            <a href="products.php"
               class="back-products">

                <i class="fa-solid fa-arrow-left"></i>

                Back to Products

            </a>

        </div>


        <!-- =====================================
             ERROR MESSAGE
        ====================================== -->

        <?php if (!empty($error)): ?>

            <div class="error-message">

                <i class="fa-solid fa-circle-exclamation"></i>

                <?= htmlspecialchars($error); ?>

            </div>

        <?php endif; ?>


        <!-- =====================================
             PRODUCT FORM
        ====================================== -->

        <div class="product-form-card">


            <form method="POST"
                  enctype="multipart/form-data">


                <div class="product-form-grid">


                    <!-- PRODUCT NAME -->

                    <div class="product-field full">

                        <label>

                            Product Name

                            <span class="required-star">*</span>

                        </label>

                        <input
                            type="text"
                            name="product_name"
                            placeholder="Enter product name"
                            required
                        >

                    </div>


                    <!-- CATEGORY -->

                    <div class="product-field">

                        <label>

                            Category

                            <span class="required-star">*</span>

                        </label>

                        <select
                            name="category_id"
                            required
                        >

                            <option value="">
                                Select Category
                            </option>


                            <?php if ($categoryResult): ?>

                                <?php while ($category = mysqli_fetch_assoc($categoryResult)): ?>

                                    <option
                                        value="<?= $category["id"]; ?>"
                                    >

                                        <?= htmlspecialchars($category["title"]); ?>

                                    </option>

                                <?php endwhile; ?>

                            <?php endif; ?>

                        </select>

                    </div>


                    <!-- BRAND -->

                    <div class="product-field">

                        <label>

                            Brand

                        </label>

                        <input
                            type="text"
                            name="brand"
                            placeholder="e.g. Apple, Nike, Samsung"
                        >

                    </div>


                    <!-- PRICE -->

                    <div class="product-field">

                        <label>

                            Price

                            <span class="required-star">*</span>

                        </label>

                        <input
                            type="number"
                            name="price"
                            step="0.01"
                            min="0"
                            placeholder="0.00"
                            required
                        >

                    </div>


                    <!-- DISCOUNT PRICE -->

                    <div class="product-field">

                        <label>

                            Discount Price

                        </label>

                        <input
                            type="number"
                            name="discount_price"
                            step="0.01"
                            min="0"
                            placeholder="Optional"
                        >

                    </div>


                    <!-- STOCK -->

                    <div class="product-field">

                        <label>

                            Stock Quantity

                            <span class="required-star">*</span>

                        </label>

                        <input
                            type="number"
                            name="stock_quantity"
                            min="0"
                            value="0"
                            required
                        >

                    </div>


                    <!-- CONDITION -->

                    <div class="product-field">

                        <label>

                            Product Condition

                        </label>

                        <select name="product_condition">

                            <option value="New">
                                New
                            </option>

                            <option value="Used">
                                Used
                            </option>

                        </select>

                    </div>


                    <!-- STATUS -->

                    <div class="product-field">

                        <label>

                            Product Status

                        </label>

                        <select name="status">

                            <option value="Active">
                                Active
                            </option>

                            <option value="Inactive">
                                Inactive
                            </option>

                        </select>

                    </div>


                    <!-- IMAGE -->

                    <div class="product-field">

                        <label>

                            Product Image

                            <span class="required-star">*</span>

                        </label>

                        <input
                            type="file"
                            name="image"
                            accept="image/jpeg,image/png,image/webp,image/gif"
                            required
                        >

                        <span class="image-help">

                            JPG, PNG, WEBP or GIF — maximum 5MB.

                        </span>

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="product-field full">

                        <label>

                            Product Description

                            <span class="required-star">*</span>

                        </label>

                        <textarea
                            name="description"
                            placeholder="Describe the product..."
                            required
                        ></textarea>

                    </div>


                    <!-- SPECIFICATIONS -->

                    <div class="product-field full">

                        <label>

                            Specifications

                        </label>

                        <textarea
                            name="specifications"
                            placeholder="Example:&#10;RAM: 16GB&#10;Storage: 512GB SSD&#10;Color: Black&#10;Screen: 15.6 inches"
                        ></textarea>

                    </div>


                </div>


                <!-- =================================
                     SUBMIT
                ================================== -->

                <div class="product-submit-area">

                    <button
                        type="submit"
                        name="add_product"
                        class="save-product-btn"
                    >

                        <i class="fa-solid fa-plus"></i>

                        Add Product

                    </button>

                </div>


            </form>


        </div>


    </section>


    <?php include "includes/footer.php"; ?>


</main>


<!-- =========================================
     SUCCESS MODAL
========================================= -->

<?php if ($success): ?>

    <div class="success-overlay">

        <div class="success-modal">


            <div class="success-icon">

                <i class="fa-solid fa-check"></i>

            </div>


            <h3>
                Product Added Successfully
            </h3>


            <p>

                Your product has been saved to the Ultimate
                marketplace database.

            </p>


            <div class="modal-actions">


                <a
                    href="products.php"
                    class="modal-btn modal-primary"
                >

                    View Products

                </a>


                <a
                    href="add-product.php"
                    class="modal-btn modal-secondary"
                >

                    Add Another

                </a>


            </div>


        </div>

    </div>

<?php endif; ?>


</body>

</html>

