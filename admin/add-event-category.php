
<?php

session_start();

if(!isset($_SESSION["admin_id"])){
    header("Location: login.php");
    exit();
}

$currentPage = "categories";

require_once "../config.php";


/* =========================================
   GET EVENTS CATEGORY ID
========================================= */

$categoryId = (int)($_GET["id"] ?? $_POST["category_id"] ?? 0);

if($categoryId <= 0){
    header("Location: categories.php");
    exit();
}


/* =========================================
   VERIFY MAIN CATEGORY
========================================= */

$categoryQuery = "
    SELECT
        id,
        title
    FROM categories
    WHERE id = ?
    LIMIT 1
";

$stmt = mysqli_prepare($conn, $categoryQuery);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $categoryId
);

mysqli_stmt_execute($stmt);

$categoryResult = mysqli_stmt_get_result($stmt);

$category = mysqli_fetch_assoc($categoryResult);

mysqli_stmt_close($stmt);


if(!$category){

    header("Location: categories.php");
    exit();

}


/* =========================================
   FORM VARIABLES
========================================= */

$error = "";


/* =========================================
   HANDLE FORM
========================================= */

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $name = trim($_POST["name"] ?? "");

    $slug = trim($_POST["slug"] ?? "");

    $shortDescription =
        trim($_POST["short_description"] ?? "");

    $icon = trim($_POST["icon"] ?? "");

    $status = $_POST["status"] ?? "Active";


    /* =====================================
       VALIDATION
    ===================================== */

    if($name === ""){

        $error = "Please enter an event category name.";

    }
    elseif($slug === ""){

        $error = "Please enter a slug.";

    }
    elseif($shortDescription === ""){

        $error = "Please enter a short description.";

    }
    elseif(!in_array($status, ["Active", "Inactive"], true)){

        $error = "Invalid category status.";

    }
    // elseif(
    //     !isset($_FILES["image"]) ||
    //     $_FILES["image"]["error"] !== UPLOAD_ERR_OK
    // ){

    //     $error = "Please select a category image.";

    // }

        elseif(!isset($_FILES["image"])){

            $error = "PHP did not receive the image.";

        }
        elseif($_FILES["image"]["error"] !== UPLOAD_ERR_OK){

            $error = "Upload error code: " . $_FILES["image"]["error"];

        }


    else{

        $image = $_FILES["image"];


        /* =================================
           IMAGE VALIDATION
        ================================= */

        $allowedTypes = [
            "image/jpeg",
            "image/png",
            "image/webp"
        ];


        if(!in_array($image["type"], $allowedTypes, true)){

            $error =
                "Only JPG, JPEG, PNG and WEBP images are allowed.";

        }
        elseif($image["size"] > 5 * 1024 * 1024){

            $error =
                "The image must not be larger than 5MB.";

        }
        else{


            /* =============================
               UPLOAD DIRECTORY
            ============================= */

            $uploadDirectory =
    "../Events-webpage/images/event-categories/";


            if(!is_dir($uploadDirectory)){

                mkdir(
                    $uploadDirectory,
                    0777,
                    true
                );

            }


            /* =============================
               FILE NAME
            ============================= */

            $extension =
                strtolower(
                    pathinfo(
                        $image["name"],
                        PATHINFO_EXTENSION
                    )
                );


            $newFileName =
                uniqid(
                    "event_category_",
                    true
                )
                . "."
                . $extension;


            $imagePath =
                $uploadDirectory
                . $newFileName;


            /* =============================
               MOVE IMAGE
            ============================= */

            if(!move_uploaded_file(
                $image["tmp_name"],
                $imagePath
            )){

                $error =
                    "The image could not be uploaded.";

            }
            else{


                /* =========================
                   INSERT CATEGORY
                ========================= */

                $insertQuery = "
                    INSERT INTO event_categories
                    (
                        category_id,
                        name,
                        slug,
                        short_description,
                        icon,
                        image,
                        status
                    )
                    VALUES
                    (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    )
                ";


                $stmt =
                    mysqli_prepare(
                        $conn,
                        $insertQuery
                    );


                if(!$stmt){

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
                        "issssss",
                        $categoryId,
                        $name,
                        $slug,
                        $shortDescription,
                        $icon,
                        $imagePath,
                        $status
                    );


                    if(mysqli_stmt_execute($stmt)){

                        mysqli_stmt_close($stmt);


                        header(
                            "Location: events-categories.php?id="
                            . $categoryId
                        );

                        exit();

                    }
                    else{

                        if(file_exists($imagePath)){
                            unlink($imagePath);
                        }

                        $error =
                            "Event category could not be added: "
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
        Add Event Category | Ultimate
    </title>


    <link
        rel="stylesheet"
        href="assets/css/admin.css"
    >

    <link
        rel="stylesheet"
        href="assets/css/add-event-category.css"
    >


    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

</head>


<body>


<?php include "includes/sidebar.php"; ?>


<main class="admin-main">


    <?php include "includes/topbar.php"; ?>


    <div class="add-event-category-content">


        <!-- =================================
             HEADER
        ================================== -->

        <div class="add-event-category-header">


            <div>


                <a
                    href="events-categories.php?id=<?= $categoryId; ?>"
                    class="back-link"
                >

                    <i class="fa-solid fa-arrow-left"></i>

                    Event Categories

                </a>


                <span class="page-eyebrow">
                    EVENTS DEPARTMENT
                </span>


                <h1>
                    Add Event Category
                </h1>


                <p>
                    Create a new category inside
                    <?= htmlspecialchars($category["title"]); ?>.
                </p>


            </div>


        </div>



        <!-- =================================
             FORM
        ================================== -->

        <section class="event-category-form-card">


            <?php if($error !== ""): ?>

                <div class="form-error">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <?= htmlspecialchars($error); ?>

                </div>

            <?php endif; ?>


            <form
                method="POST"
                enctype="multipart/form-data"
            >


                <input
                    type="hidden"
                    name="category_id"
                    value="<?= $categoryId; ?>"
                >


                <!-- CATEGORY NAME -->

                <div class="form-group">

                    <label for="name">
                        Category Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="e.g. Weddings"
                        value="<?= htmlspecialchars($_POST["name"] ?? ""); ?>"
                        required
                    >

                </div>



                <!-- SLUG -->

                <div class="form-group">

                    <label for="slug">
                        Slug
                    </label>

                    <input
                        type="text"
                        id="slug"
                        name="slug"
                        placeholder="e.g. weddings"
                        value="<?= htmlspecialchars($_POST["slug"] ?? ""); ?>"
                        required
                    >

                    <small>
                        Used for the category URL.
                    </small>

                </div>



                <!-- SHORT DESCRIPTION -->

                <div class="form-group full-width">

                    <label for="short_description">
                        Short Description
                    </label>

                    <textarea
                        id="short_description"
                        name="short_description"
                        rows="4"
                        placeholder="Briefly describe this event category..."
                        required
                    ><?= htmlspecialchars($_POST["short_description"] ?? ""); ?></textarea>

                </div>



                <!-- ICON -->

                <div class="form-group">

                    <label for="icon">
                        Font Awesome Icon
                    </label>

                    <input
                        type="text"
                        id="icon"
                        name="icon"
                        placeholder="e.g. fa-solid fa-ring"
                        value="<?= htmlspecialchars($_POST["icon"] ?? ""); ?>"
                    >

                    <small>
                        Example:
                        <strong>fa-solid fa-ring</strong>
                    </small>

                </div>



                <!-- STATUS -->

                <div class="form-group">

                    <label for="status">
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                    >

                        <option
                            value="Active"
                            <?= (($_POST["status"] ?? "Active") === "Active")
                                ? "selected"
                                : ""; ?>
                        >
                            Active
                        </option>

                        <option
                            value="Inactive"
                            <?= (($_POST["status"] ?? "") === "Inactive")
                                ? "selected"
                                : ""; ?>
                        >
                            Inactive
                        </option>

                    </select>

                </div>



                <!-- IMAGE -->

                <div class="form-group full-width">

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

                    <small>
                        JPG, PNG or WEBP. Maximum size: 5MB.
                    </small>

                </div>



                <!-- ACTIONS -->

                <div class="form-actions">

                    <a
                        href="events-categories.php?id=<?= $categoryId; ?>"
                        class="cancel-button"
                    >
                        Cancel
                    </a>


                    <button
                        type="submit"
                        class="save-button"
                    >

                        <i class="fa-solid fa-plus"></i>

                        Create Event Category

                    </button>

                </div>


            </form>


        </section>


    </div>


    <?php include "includes/footer.php"; ?>


</main>


</body>

</html>





