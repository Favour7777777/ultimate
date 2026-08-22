```php
<?php

session_start();


/*
=========================================================
    ADMIN ACCESS PROTECTION
=========================================================
*/

if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");

    exit();

}

/*Current admin page*/ 

$currentPage = "categories";


/*
=========================================================
    DATABASE CONNECTION
=========================================================
*/

require_once "../config.php";


/*
=========================================================
    VARIABLES
=========================================================
*/

$error = "";

$success = "";


/*
=========================================================
    PROCESS FORM
=========================================================
*/

if($_SERVER["REQUEST_METHOD"] === "POST"){


    /*
    =====================================================
        GET FORM DATA
    =====================================================
    */

    $title = trim($_POST["title"] ?? "");

    $description = trim($_POST["description"] ?? "");

    $icon = trim($_POST["icon"] ?? "");

    $pageLink = trim($_POST["page_link"] ?? "");


    /*
    =====================================================
        VALIDATE TEXT FIELDS
    =====================================================
    */

    if(
        $title === "" ||
        $description === "" ||
        $icon === "" ||
        $pageLink === ""
    ){

        $error = "Please fill in all category fields.";

    }


    /*
    =====================================================
        CHECK IMAGE
    =====================================================
    */

    elseif(!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK){

        $error = "Please select a category image.";

    }


    /*
    =====================================================
        PROCESS IMAGE
    =====================================================
    */

    else{

        $image = $_FILES["image"];


        /*
        -----------------------------------------------
            ALLOWED IMAGE TYPES
        -----------------------------------------------
        */

        $allowedTypes = [
            "image/jpeg",
            "image/png",
            "image/webp"
        ];


        /*
        -----------------------------------------------
            CHECK FILE TYPE
        -----------------------------------------------
        */

        if(!in_array($image["type"], $allowedTypes, true)){

            $error = "Only JPG, JPEG, PNG and WEBP images are allowed.";

        }


        /*
        -----------------------------------------------
            CHECK FILE SIZE
        -----------------------------------------------
        */

        elseif($image["size"] > 5 * 1024 * 1024){

            $error = "The image must not be larger than 5MB.";

        }


        /*
        -----------------------------------------------
            CREATE UPLOAD FOLDER
        -----------------------------------------------
        */

        else{

            $uploadDirectory = "uploads/categories/";


            if(!is_dir($uploadDirectory)){

                mkdir(
                    $uploadDirectory,
                    0777,
                    true
                );

            }


            /*
            -------------------------------------------
                CREATE UNIQUE FILE NAME
            -------------------------------------------
            */

            $extension =
                strtolower(
                    pathinfo(
                        $image["name"],
                        PATHINFO_EXTENSION
                    )
                );


            $newFileName =
                uniqid("category_", true)
                . "."
                . $extension;


            $imagePath =
                $uploadDirectory
                . $newFileName;


            /*
            -------------------------------------------
                MOVE IMAGE
            -------------------------------------------
            */

            if(!move_uploaded_file(
                $image["tmp_name"],
                $imagePath
            )){

                $error = "The image could not be uploaded.";

            }


            /*
            -------------------------------------------
                INSERT CATEGORY
            -------------------------------------------
            */

            else{

                $query = "
                    INSERT INTO categories
                    (
                        title,
                        description,
                        icon,
                        image,
                        page_link
                    )
                    VALUES
                    (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    )
                ";


                $stmt = mysqli_prepare(
                    $conn,
                    $query
                );


                if(!$stmt){

                    /*
                    -----------------------------------
                        REMOVE IMAGE IF QUERY FAILED
                    -----------------------------------
                    */

                    if(file_exists($imagePath)){

                        unlink($imagePath);

                    }


                    $error =
                        "Database error: "
                        . mysqli_error($conn);

                }

                else{


                    mysqli_stmt_bind_param(
                        $stmt,
                        "sssss",
                        $title,
                        $description,
                        $icon,
                        $imagePath,
                        $pageLink
                    );


                    if(mysqli_stmt_execute($stmt)){

                        mysqli_stmt_close($stmt);


                        /*
                        --------------------------------
                            REDIRECT AFTER SUCCESS
                        --------------------------------
                        */

                        header(
                            "Location: categories.php?success=category_added"
                        );

                        exit();

                    }


                    else{

                        /*
                        -------------------------------
                            REMOVE IMAGE IF INSERT
                            FAILED
                        -------------------------------
                        */

                        if(file_exists($imagePath)){

                            unlink($imagePath);

                        }


                        $error =
                            "Category could not be added: "
                            . mysqli_stmt_error($stmt);


                        mysqli_stmt_close($stmt);

                    }

                }

            }

        }

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


    <title>

        Add Category | Ultimate Admin

    </title>


    <!-- GOOGLE FONT -->

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


    <!-- FONT AWESOME -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >


    <!-- ADMIN CSS -->

    <link
        rel="stylesheet"
        href="assets/css/admin.css"
    >


    <style>

        /* =========================================
           ADD CATEGORY PAGE
        ========================================= */

        .admin-content{

            padding:30px;

        }


        .page-intro{

            margin-bottom:25px;

        }


        .page-intro h2{

            font-size:20px;

            font-weight:500;

            color:#f2ebf5;

        }


        .page-intro p{

            margin-top:5px;

            font-size:10px;

            color:#776d7d;

        }


        /* =========================================
           MESSAGE
        ========================================= */

        .form-message{

            max-width:850px;

            margin-bottom:18px;

            padding:12px 14px;

            border-radius:10px;

            font-size:9px;

        }


        .form-error{

            border:1px solid rgba(220,90,110,0.18);

            background:rgba(220,90,110,0.07);

            color:#dc98a6;

        }


        /* =========================================
           FORM CARD
        ========================================= */

        .category-form-card{

            max-width:850px;

            padding:25px;

            border:1px solid rgba(255,255,255,0.06);

            border-radius:17px;

            background:
                linear-gradient(
                    145deg,
                    rgba(29,23,35,0.92),
                    rgba(14,12,17,0.96)
                );

            box-shadow:
                0 15px 40px rgba(0,0,0,0.20);

        }


        .form-grid{

            display:grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap:20px;

        }


        .form-group{

            display:flex;

            flex-direction:column;

            gap:7px;

        }


        .form-group.full-width{

            grid-column:1 / -1;

        }


        .form-group label{

            font-size:9px;

            font-weight:500;

            color:#b6aaba;

        }


        .form-group input,
        .form-group textarea{

            width:100%;

            border:1px solid rgba(255,255,255,0.07);

            outline:none;

            border-radius:10px;

            background:rgba(255,255,255,0.035);

            color:#eee7f2;

            font-family:"Poppins", sans-serif;

            font-size:10px;

            transition:0.25s ease;

        }


        .form-group input{

            height:44px;

            padding:0 13px;

        }


        .form-group textarea{

            min-height:120px;

            padding:12px 13px;

            resize:vertical;

        }


        .form-group input:focus,
        .form-group textarea:focus{

            border-color:
                rgba(177,111,225,0.40);

            background:
                rgba(255,255,255,0.05);

        }


        .form-group input::placeholder,
        .form-group textarea::placeholder{

            color:#625867;

        }


        /* =========================================
           ICON INPUT
        ========================================= */

        .icon-input-wrapper{

            position:relative;

        }


        .icon-input-wrapper i{

            position:absolute;

            left:14px;

            top:50%;

            transform:translateY(-50%);

            color:#8b709b;

            font-size:12px;

            pointer-events:none;

        }


        .icon-input-wrapper input{

            padding-left:38px;

        }


        /* =========================================
           IMAGE INPUT
        ========================================= */

        .image-input{

            padding:10px;

            height:auto !important;

            cursor:pointer;

        }


        .image-help{

            margin-top:3px;

            font-size:8px;

            color:#665b6b;

        }


        /* =========================================
           FORM ACTIONS
        ========================================= */

        .form-actions{

            display:flex;

            justify-content:flex-end;

            gap:10px;

            margin-top:25px;

            padding-top:20px;

            border-top:1px solid rgba(255,255,255,0.05);

        }


        .cancel-button,
        .submit-button{

            min-height:40px;

            padding:0 18px;

            display:flex;

            align-items:center;

            justify-content:center;

            gap:7px;

            border-radius:9px;

            font-size:9px;

            font-weight:500;

            transition:0.25s ease;

        }


        .cancel-button{

            border:1px solid rgba(255,255,255,0.07);

            background:rgba(255,255,255,0.03);

            color:#8d8190;

        }


        .cancel-button:hover{

            background:rgba(255,255,255,0.07);

            color:#ddd4e1;

        }


        .submit-button{

            background:
                linear-gradient(
                    135deg,
                    #9b65d3,
                    #61317f
                );

            color:#ffffff;

            box-shadow:
                0 8px 22px rgba(102,47,135,0.25);

        }


        .submit-button:hover{

            transform:translateY(-2px);

            box-shadow:
                0 12px 28px rgba(102,47,135,0.35);

        }


        /* =========================================
           MOBILE
        ========================================= */

        @media(max-width:700px){

            .admin-content{

                padding:22px 18px;

            }


            .form-grid{

                grid-template-columns:1fr;

            }


            .form-group.full-width{

                grid-column:auto;

            }

        }


        @media(max-width:500px){

            .admin-content{

                padding:18px 14px;

            }


            .category-form-card{

                padding:18px;

            }


            .form-actions{

                flex-direction:column-reverse;

            }


            .cancel-button,
            .submit-button{

                width:100%;

            }

        }

    </style>


</head>


<body>


    <!-- SIDEBAR -->

    <?php include "includes/sidebar.php"; ?>


    <!-- MAIN -->

    <main class="admin-main">


        <!-- TOPBAR -->

        <?php

        $currentPage = "categories";

        $pageTitle = "Add Category";

        $pageDescription =
            "Create a new category for the Ultimate marketplace";

        include "includes/topbar.php";

        ?>


        <!-- CONTENT -->

        <section class="admin-content">


            <div class="page-intro">

                <h2>

                    Add Category

                </h2>

                <p>

                    Create a new category for the Ultimate marketplace.

                </p>

            </div>


            <?php if($error !== ""): ?>

                <div class="form-message form-error">

                    <?= htmlspecialchars($error); ?>

                </div>

            <?php endif; ?>


            <div class="category-form-card">


                <form
                    action=""
                    method="POST"
                    enctype="multipart/form-data"
                >


                    <div class="form-grid">


                        <!-- TITLE -->

                        <div class="form-group">

                            <label for="title">

                                Category Title

                            </label>

                            <input
                                type="text"
                                id="title"
                                name="title"
                                placeholder="e.g. Gadgets & Electronics"
                                value="<?= htmlspecialchars($_POST["title"] ?? ""); ?>"
                                required
                            >

                        </div>


                        <!-- ICON -->

                        <div class="form-group">

                            <label for="icon">

                                Font Awesome Icon

                            </label>


                            <div class="icon-input-wrapper">

                                <i class="fa-solid fa-icons"></i>

                                <input
                                    type="text"
                                    id="icon"
                                    name="icon"
                                    placeholder="e.g. fa-solid fa-mobile-screen"
                                    value="<?= htmlspecialchars($_POST["icon"] ?? ""); ?>"
                                    required
                                >

                            </div>

                        </div>


                        <!-- DESCRIPTION -->

                        <div class="form-group full-width">

                            <label for="description">

                                Description

                            </label>

                            <textarea
                                id="description"
                                name="description"
                                placeholder="Describe what customers can find in this category..."
                                required
                            ><?= htmlspecialchars($_POST["description"] ?? ""); ?></textarea>

                        </div>

                        <!-- PAGE LINK -->


                         <div class="form-group full-width">

                            <label for="page_link">

                                Page Link

                            </label>

                            <input
                                type="text"
                                id="page_link"
                                name="page_link"
                                placeholder="Insert page link.."
                                required
                            ><?= htmlspecialchars($_POST["page_link"] ?? ""); ?></input>

                        </div>




                        <!-- IMAGE -->

                        <div class="form-group full-width">

                            <label for="image">

                                Category Image

                            </label>

                            <input
                                class="image-input"
                                type="file"
                                id="image"
                                name="image"
                                accept="image/jpeg,image/png,image/webp"
                                required
                            >

                            <span class="image-help">

                                JPG, JPEG, PNG or WEBP — maximum 5MB.

                            </span>

                        </div>


                    </div>


                    <!-- ACTIONS -->

                    <div class="form-actions">


                        <a
                            href="categories.php"
                            class="cancel-button"
                        >

                            Cancel

                        </a>


                        <button
                            type="submit"
                            class="submit-button"
                        >

                            <i class="fa-solid fa-plus"></i>

                            Add Category

                        </button>


                    </div>


                </form>


            </div>


        </section>


        <!-- FOOTER -->

        <?php include "includes/footer.php"; ?>


    </main>


</body>

</html>
```
