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


/*
=========================================================
    CURRENT PAGE
=========================================================
*/

$currentPage = "categories";


/*
=========================================================
    DATABASE CONNECTION
=========================================================
*/

require_once "../config.php";


/*
=========================================================
    PAGE INFORMATION
=========================================================
*/

$pageTitle = "Edit Category";

$pageDescription =
    "Update marketplace category information";


/*
=========================================================
    GET CATEGORY ID
=========================================================
*/

if(!isset($_GET["id"]) || !is_numeric($_GET["id"])){

    header("Location: categories.php");

    exit();

}


$categoryId = (int)$_GET["id"];


/*
=========================================================
    GET CATEGORY
=========================================================
*/

$query = "
    SELECT
        id,
        title,
        description,
        icon,
        image,
        page_link
    FROM categories
    WHERE id = ?
";


$stmt = mysqli_prepare($conn, $query);


if(!$stmt){

    die("Database error: " . mysqli_error($conn));

}


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $categoryId
);


mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);


$category = mysqli_fetch_assoc($result);


mysqli_stmt_close($stmt);


/*
=========================================================
    CATEGORY NOT FOUND
=========================================================
*/

if(!$category){

    header("Location: categories.php");

    exit();

}


/*
=========================================================
    VARIABLES
=========================================================
*/

$error = "";


/*
=========================================================
    PROCESS UPDATE
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
        IMAGE VARIABLES
    =====================================================
    */

    else{

        $newImagePath = $category["image"];

        $newImageUploaded = false;


        /*
        =================================================
            CHECK IF A NEW IMAGE WAS SELECTED
        =================================================
        */

        if(
            isset($_FILES["image"]) &&
            $_FILES["image"]["error"] !== UPLOAD_ERR_NO_FILE
        ){


            if($_FILES["image"]["error"] !== UPLOAD_ERR_OK){

                $error = "There was a problem uploading the new image.";

            }

            else{


                $image = $_FILES["image"];


                /*
                -----------------------------------------
                    ALLOWED IMAGE TYPES
                -----------------------------------------
                */

                $allowedTypes = [

                    "image/jpeg",
                    "image/png",
                    "image/webp"

                ];


                /*
                -----------------------------------------
                    CHECK IMAGE TYPE
                -----------------------------------------
                */

                if(!in_array($image["type"], $allowedTypes, true)){

                    $error =
                        "Only JPG, JPEG, PNG and WEBP images are allowed.";

                }


                /*
                -----------------------------------------
                    CHECK IMAGE SIZE
                -----------------------------------------
                */

                elseif($image["size"] > 5 * 1024 * 1024){

                    $error =
                        "The image must not be larger than 5MB.";

                }


                /*
                -----------------------------------------
                    UPLOAD NEW IMAGE
                -----------------------------------------
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
                    -------------------------------------
                        GET EXTENSION
                    -------------------------------------
                    */

                    $extension = strtolower(
                        pathinfo(
                            $image["name"],
                            PATHINFO_EXTENSION
                        )
                    );


                    /*
                    -------------------------------------
                        CREATE UNIQUE NAME
                    -------------------------------------
                    */

                    $newFileName =
                        uniqid("category_", true)
                        . "."
                        . $extension;


                    $newImagePath =
                        $uploadDirectory
                        . $newFileName;


                    /*
                    -------------------------------------
                        MOVE IMAGE
                    -------------------------------------
                    */

                    if(!move_uploaded_file(
                        $image["tmp_name"],
                        $newImagePath
                    )){

                        $error =
                            "The new image could not be uploaded.";

                    }

                    else{

                        $newImageUploaded = true;

                    }

                }

            }

        }


        /*
        =================================================
            UPDATE DATABASE
        =================================================
        */

        if($error === ""){


            $updateQuery = "
                UPDATE categories
                SET
                    title = ?,
                    description = ?,
                    icon = ?,
                    image = ?,
                    page_link = ?
                WHERE id = ?
            ";


            $updateStmt = mysqli_prepare(
                $conn,
                $updateQuery
            );


            if(!$updateStmt){

                /*
                -----------------------------------------
                    REMOVE NEW IMAGE IF QUERY FAILED
                -----------------------------------------
                */

                if(
                    $newImageUploaded &&
                    file_exists($newImagePath)
                ){

                    unlink($newImagePath);

                }


                $error =
                    "Database error: "
                    . mysqli_error($conn);

            }

            else{


                mysqli_stmt_bind_param(
                    $updateStmt,
                    "sssssi",
                    $title,
                    $description,
                    $icon,
                    $newImagePath,
                    $pageLink,
                    $categoryId
                    
                );


                if(mysqli_stmt_execute($updateStmt)){


                    mysqli_stmt_close($updateStmt);


                    /*
                    =====================================
                        DELETE OLD IMAGE
                    =====================================
                    */

                    if(
                        $newImageUploaded &&
                        !empty($category["image"]) &&
                        file_exists($category["image"])
                    ){

                        unlink($category["image"]);

                    }


                    /*
                    =====================================
                        REDIRECT
                    =====================================
                    */

                    header(
                        "Location: categories.php?success=category_updated"
                    );

                    exit();

                }

                else{


                    /*
                    -------------------------------------
                        REMOVE NEW IMAGE IF UPDATE FAILED
                    -------------------------------------
                    */

                    if(
                        $newImageUploaded &&
                        file_exists($newImagePath)
                    ){

                        unlink($newImagePath);

                    }


                    $error =
                        "Category could not be updated: "
                        . mysqli_stmt_error($updateStmt);


                    mysqli_stmt_close($updateStmt);

                }

            }

        }

    }


    /*
    =====================================================
        KEEP FORM VALUES AFTER ERROR
    =====================================================
    */

    $category["title"] = $title;

    $category["description"] = $description;

    $category["icon"] = $icon;

    $category["page_link"] = $pageLink;

}


/*
=========================================================
    ESCAPE DISPLAY VALUES
=========================================================
*/

$titleValue =
    htmlspecialchars(
        $category["title"],
        ENT_QUOTES,
        "UTF-8"
    );


$descriptionValue =
    htmlspecialchars(
        $category["description"],
        ENT_QUOTES,
        "UTF-8"
    );

$pageLinkValue =
    htmlspecialchars(
        $category["page_link"] ?? "",
        ENT_QUOTES,
        "UTF-8"
    );



$iconValue =
    htmlspecialchars(
        $category["icon"],
        ENT_QUOTES,
        "UTF-8"
    );


$imageValue =
    htmlspecialchars(
        $category["image"],
        ENT_QUOTES,
        "UTF-8"
    );

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

        Edit Category | Ultimate Admin

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


    <!--
    =====================================================
        PAGE-SPECIFIC CSS
    =====================================================
    -->

    <style>

        .admin-content{

            padding:30px;

        }


        .page-intro{

            margin-bottom:25px;

        }


        .page-intro h2{

            color:#f2ebf5;

            font-size:20px;

            font-weight:500;

        }


        .page-intro p{

            margin-top:5px;

            color:#776d7d;

            font-size:10px;

        }


        /* =============================================
           MESSAGE
        ============================================= */

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


        /* =============================================
           FORM LAYOUT
        ============================================= */

        .edit-category-layout{

            max-width:1000px;

            display:grid;

            grid-template-columns:
                280px
                minmax(0,1fr);

            gap:22px;

        }


        /* =============================================
           IMAGE PREVIEW
        ============================================= */

        .category-preview-card{

            padding:15px;

            border:1px solid rgba(255,255,255,0.06);

            border-radius:16px;

            background:
                linear-gradient(
                    145deg,
                    rgba(29,23,35,0.92),
                    rgba(14,12,17,0.96)
                );

            box-shadow:
                0 15px 40px rgba(0,0,0,0.20);

            height:max-content;

        }


        .preview-image{

            width:100%;

            height:190px;

            overflow:hidden;

            border-radius:12px;

            background:#17131b;

        }


        .preview-image img{

            width:100%;

            height:100%;

            object-fit:cover;

            display:block;

        }


        .preview-label{

            margin-top:12px;

            color:#665b6b;

            font-size:8px;

        }


        .preview-icon{

            display:flex;

            align-items:center;

            gap:8px;

            margin-top:7px;

            color:#c28ae9;

            font-size:10px;

        }


        .preview-icon i{

            width:30px;

            height:30px;

            display:flex;

            align-items:center;

            justify-content:center;

            border-radius:8px;

            background:
                rgba(155,101,211,0.10);

        }


        /* =============================================
           FORM CARD
        ============================================= */

        .category-form-card{

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
                repeat(2,minmax(0,1fr));

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

            color:#b6aaba;

            font-size:9px;

            font-weight:500;

        }


        .form-group input,
        .form-group textarea{

            width:100%;

            border:1px solid rgba(255,255,255,0.07);

            outline:none;

            border-radius:10px;

            background:rgba(255,255,255,0.035);

            color:#eee7f2;

            font-family:"Poppins",sans-serif;

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


        /* =============================================
           ICON INPUT
        ============================================= */

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


        /* =============================================
           FILE INPUT
        ============================================= */

        .image-input{

            height:auto !important;

            padding:10px;

            cursor:pointer;

        }


        .image-help{

            margin-top:3px;

            color:#665b6b;

            font-size:8px;

        }


        /* =============================================
           ACTIONS
        ============================================= */

        .form-actions{

            display:flex;

            justify-content:flex-end;

            gap:10px;

            margin-top:25px;

            padding-top:20px;

            border-top:
                1px solid
                rgba(255,255,255,0.05);

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

            text-decoration:none;

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

            border:0;

            background:
                linear-gradient(
                    135deg,
                    #9b65d3,
                    #61317f
                );

            color:#ffffff;

            cursor:pointer;

            box-shadow:
                0 8px 22px rgba(102,47,135,0.25);

        }


        .submit-button:hover{

            transform:translateY(-2px);

            box-shadow:
                0 12px 28px rgba(102,47,135,0.35);

        }


        /* =============================================
           MOBILE
        ============================================= */

        @media(max-width:850px){

            .edit-category-layout{

                grid-template-columns:1fr;

            }


            .category-preview-card{

                max-width:400px;

            }

        }


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

        <?php include "includes/topbar.php"; ?>


        <!-- CONTENT -->

        <section class="admin-content">


            <div class="page-intro">

                <h2>

                    Edit Category

                </h2>

                <p>

                    Update the information for this marketplace category.

                </p>

            </div>


            <?php if($error !== ""): ?>

                <div class="form-message form-error">

                    <?= htmlspecialchars($error); ?>

                </div>

            <?php endif; ?>


            <div class="edit-category-layout">


                <!-- =====================================
                     CURRENT CATEGORY PREVIEW
                ====================================== -->

                <div class="category-preview-card">


                    <div class="preview-image">

                        <img
                            src="<?= $imageValue; ?>"
                            alt="<?= $titleValue; ?>"
                        >

                    </div>


                    <div class="preview-label">

                        CURRENT CATEGORY IMAGE

                    </div>


                    <div class="preview-icon">

                        <i class="<?= $iconValue; ?>"></i>

                        <span>

                            <?= $titleValue; ?>

                        </span>

                    </div>


                </div>


                <!-- =====================================
                     EDIT FORM
                ====================================== -->

                <div class="category-form-card">


                    <form
                        action="edit-category.php?id=<?= $categoryId; ?>"
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
                                    value="<?= $titleValue; ?>"
                                    placeholder="e.g. Gadgets & Electronics"
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
                                        value="<?= $iconValue; ?>"
                                        placeholder="e.g. fa-solid fa-mobile-screen"
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
                                    placeholder="Describe this category..."
                                    required
                                ><?= $descriptionValue; ?></textarea>

                            </div>

                            <div class="form-group full-width">

                                <label for="page_link">

                                    Page Link

                                </label>

                                <input
                                    type="text"
                                    id="page_link"
                                    name="page_link"
                                    placeholder="Input page link"
                                    required
                                    value="<?= $pageLinkValue; ?>" >

                            </div>


                            <!-- NEW IMAGE -->

                            <div class="form-group full-width">

                                <label for="image">

                                    Replace Category Image

                                </label>

                                <input
                                    class="image-input"
                                    type="file"
                                    id="image"
                                    name="image"
                                    accept="image/jpeg,image/png,image/webp"
                                >

                                <span class="image-help">

                                    Leave this empty to keep the current image.
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

                                <i class="fa-solid fa-floppy-disk"></i>

                                Save Changes

                            </button>


                        </div>


                    </form>


                </div>


            </div>


        </section>


        <!-- FOOTER -->

        <?php include "includes/footer.php"; ?>


    </main>


</body>

</html>