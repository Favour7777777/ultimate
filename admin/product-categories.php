

<?php

session_start();

require_once "../config.php";



/*
=========================================================
    ADD PRODUCT CATEGORY
=========================================================
*/

$message = "";
$messageType = "";


if(isset($_POST["add_category"])){

    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $icon = trim($_POST["icon"]);


    /*
    =====================================================
        VALIDATE TITLE
    =====================================================
    */

    if($title === ""){

        $message = "Please enter a category title.";
        $messageType = "error";

    }else{

        /*
        =================================================
            IMAGE UPLOAD
        =================================================
        */

        $imageName = "";


        if(isset($_FILES["image"]) && $_FILES["image"]["error"] === 0){

            $uploadDirectory = __DIR__ ."/uploads/categories/product-categories/";

            $allowedTypes = [
                "image/jpg",
                "image/png",
                "image/webp"
            ];


            if(!in_array($_FILES["image"]["type"], $allowedTypes)){

                $message = "Only JPG, PNG and WEBP images are allowed.";
                $messageType = "error";

            }else{

                $extension = pathinfo(
                    $_FILES["image"]["name"],
                    PATHINFO_EXTENSION
                );


                $imageName =
                    "product_category_" .
                    uniqid() .
                    "." .
                    $extension;


                $uploadPath = $uploadDirectory . $imageName;


                if(move_uploaded_file(
                    $_FILES["image"]["tmp_name"],
                    $uploadPath
                )){

                    /*
                    =====================================
                        INSERT CATEGORY
                    =====================================
                    */

                    $stmt = mysqli_prepare(
                        $conn,
                        "INSERT INTO product_categories
                        (title, description, icon, image)
                        VALUES (?, ?, ?, ?)"
                    );


                    mysqli_stmt_bind_param(
                        $stmt,
                        "ssss",
                        $title,
                        $description,
                        $icon,
                        $imageName
                    );


                    if(mysqli_stmt_execute($stmt)){

                        $message =
                            "Product category added successfully.";

                        $messageType = "success";

                    }else{

                        $message =
                            "Failed to add product category.";

                        $messageType = "error";

                    }


                    mysqli_stmt_close($stmt);

                }else{

                    $message =
                        "Failed to upload the image.";

                    $messageType = "error";

                }

            }

        }else{

            $message = "Please select a category image.";
            $messageType = "error";

        }

    }

}


/*
=========================================================
    GET PRODUCT CATEGORIES
=========================================================
*/

$query = "
    SELECT
        id,
        title,
        description,
        icon,
        image,
        created_at
    FROM product_categories
    ORDER BY created_at DESC
";


$result = mysqli_query($conn, $query);


if(!$result){

    die(
        "Failed to load product categories: " .
        mysqli_error($conn)
    );

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

<title>Product Categories | Admin</title>

<link
        rel="stylesheet"
        href="assets/css/admin.css"
    >




<style>

*{

    box-sizing:border-box;

    margin:0;

    padding:0;

}


body{

    min-height:100vh;

    background:#0d0b0f;

    color:#ffffff;

    font-family:Arial,sans-serif;

}


.container{

    width:min(1100px,92%);

    margin:0 auto;

    padding:60px 0;

}


h1{

    margin-bottom:8px;

}


.subtitle{

    color:#8f8794;

    margin-bottom:35px;

}


/*
=========================================================
    MESSAGE
=========================================================
*/

.message{

    padding:14px 18px;

    margin-bottom:25px;

    border-radius:8px;

}


.message.success{

    background:rgba(40,180,100,0.12);

    border:1px solid rgba(40,180,100,0.3);

    color:#70e0a0;

}


.message.error{

    background:rgba(220,60,60,0.12);

    border:1px solid rgba(220,60,60,0.3);

    color:#ff8585;

}


/*
=========================================================
    FORM
=========================================================
*/

.form-card{

    padding:30px;

    margin-bottom:45px;

    border:1px solid rgba(255,255,255,0.08);

    border-radius:15px;

    background:#151219;

}


.form-group{

    margin-bottom:20px;

}


.form-group label{

    display:block;

    margin-bottom:8px;

    color:#cfc5d5;

    font-size:14px;

}


.form-group input,
.form-group textarea{

    width:100%;

    padding:13px 15px;

    border:1px solid rgba(255,255,255,0.08);

    border-radius:8px;

    outline:none;

    background:#0e0c10;

    color:#ffffff;

}


.form-group textarea{

    min-height:100px;

    resize:vertical;

}


.form-group input:focus,
.form-group textarea:focus{

    border-color:#9b5bc4;

}


button{

    padding:13px 22px;

    border:none;

    border-radius:8px;

    background:#8b4bb5;

    color:#ffffff;

    cursor:pointer;

}


button:hover{

    background:#a25ed0;

}


/*
=========================================================
    CATEGORY LIST
=========================================================
*/

.categories-grid{

    display:grid;

    grid-template-columns:
        repeat(auto-fit,minmax(240px,1fr));

    gap:20px;

}


.category-card{

    overflow:hidden;

    border:1px solid rgba(255,255,255,0.08);

    border-radius:15px;

    background:#151219;

}


.category-card img{

    width:100%;

    height:180px;

    object-fit:cover;

    display:block;

}


.category-content{

    padding:18px;

}


.category-content h3{

    margin-bottom:7px;

}



.category-content p{

    color:#8f8794;

    font-size:13px;

    line-height:1.6;

}


.icon{

    margin-bottom:10px;

    color:#b878df;

}


@media(max-width:600px){

    .container{

        padding:35px 0;

    }

    .form-card{

        padding:20px;

    }

}

</style>

</head>




<body>

    <?php

    $currentPage = "categories";

    ?>

    <?php include "includes/sidebar.php"; ?>


    <main class="admin-main">

            <?php

        $pageTitle = "Product Categories";

        $pageDescription =
            "Manage product categories for the Ultimate marketplace";

        include "includes/topbar.php";

        ?>

<div class="container">


    

    <?php if($message !== ""): ?>

        <div class="message <?= $messageType; ?>">

            <?= htmlspecialchars($message); ?>

        </div>

    <?php endif; ?>


    <!-- =========================================
         ADD CATEGORY FORM
    ========================================== -->

    <div class="form-card">

        <h2 style="margin-bottom:25px;">

            Add Product Category

        </h2>


        <form
            method="POST"
            enctype="multipart/form-data"
        >


            <div class="form-group">

                <label for="title">

                    Category Title

                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    placeholder="e.g. Electronics"
                    required
                >

            </div>


            <div class="form-group">

                <label for="description">

                    Description

                </label>

                <textarea
                    id="description"
                    name="description"
                    placeholder="Short description of this category"
                ></textarea>

            </div>


            <div class="form-group">

                <label for="icon">

                    Font Awesome Icon

                </label>

                <input
                    type="text"
                    id="icon"
                    name="icon"
                    placeholder="fa-solid fa-mobile-screen"
                >

            </div>


            <div class="form-group">

                <label for="image">

                    Category Image

                </label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp"
                    required
                >

            </div>


            <button
                type="submit"
                name="add_category"
            >

                Add Product Category

            </button>


        </form>

    </div>


    <!-- =========================================
         EXISTING CATEGORIES
    ========================================== -->

    <h2 style="margin-bottom:20px;">

        Existing Product Categories

    </h2>


    <div class="categories-grid">


        <?php if(mysqli_num_rows($result) > 0): ?>


            <?php while($category = mysqli_fetch_assoc($result)): ?>


                <article class="category-card">


                    <img
                        src="uploads/categories/product-categories/<?= htmlspecialchars($category["image"]); ?>"
                        alt="<?= htmlspecialchars($category["title"]); ?>"
                    >


                    <div class="category-content">


                        <?php if(!empty($category["icon"])): ?>

                            <div class="icon">

                                <i class="<?= htmlspecialchars($category["icon"]); ?>"></i>

                            </div>

                        <?php endif; ?>


                        <h3>

                            <?= htmlspecialchars($category["title"]); ?>

                        </h3>


                        <p>

                            <?= htmlspecialchars($category["description"]); ?>

                        </p>

                        <button>

                        <a
                            href="products-listing.php?category_id=<?= (int)$category["id"]; ?>"
                            class="view-category-listing"
                        >
                            View This Product Category Listing
                        </a>

                        </button>


                    </div>


                </article>


            <?php endwhile; ?>


        <?php else: ?>


            <p style="color:#8f8794;">

                No product categories have been added yet.

            </p>


        <?php endif; ?>


    </div>


</div>

<!-- FOOTER -->

<?php include "includes/footer.php"; ?>
</main>




</body>

</html>