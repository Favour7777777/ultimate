<?php

session_start();

if(!isset($_SESSION["admin_id"])){
    header("Location: login.php");
    exit();
}

$currentPage = "categories";

require_once "../config.php";


/* =========================================
   GET EVENT CATEGORY ID
========================================= */

$id = (int)($_GET["id"] ?? $_POST["id"] ?? 0);

if($id <= 0){
    header("Location: categories.php");
    exit();
}


/* =========================================
   FETCH CATEGORY
========================================= */

$query = "
    SELECT *
    FROM event_categories
    WHERE id = ?
    LIMIT 1
";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param($stmt,"i",$id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$eventCategory = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if(!$eventCategory){
    header("Location: categories.php");
    exit();
}

$error = "";


/* =========================================
   UPDATE CATEGORY
========================================= */

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $name = trim($_POST["name"]);
    $slug = trim($_POST["slug"]);
    $description = trim($_POST["short_description"]);
    $icon = trim($_POST["icon"]);
    $status = $_POST["status"];

    $imagePath = $eventCategory["image"];


    /* IMAGE UPLOAD */

    if(isset($_FILES["image"]) &&
       $_FILES["image"]["error"] === UPLOAD_ERR_OK){

        $image = $_FILES["image"];

        $allowed = [
            "image/jpeg",
            "image/png",
            "image/webp"
        ];

        if(in_array($image["type"],$allowed,true)){

            $folder = "uploads/event-categories/";

            if(!is_dir($folder)){
                mkdir($folder,0777,true);
            }

            $ext = strtolower(
                pathinfo($image["name"],PATHINFO_EXTENSION)
            );

            $fileName =
                uniqid("event_category_",true)
                .".".$ext;

            $newImage = $folder.$fileName;

            if(move_uploaded_file(
                $image["tmp_name"],
                $newImage
            )){

                if(
                    !empty($imagePath) &&
                    file_exists($imagePath)
                ){
                    unlink($imagePath);
                }

                $imagePath = $newImage;

            }

        }

    }


    /* UPDATE DATABASE */

    $update = "
        UPDATE event_categories
        SET
            name=?,
            slug=?,
            short_description=?,
            icon=?,
            image=?,
            status=?
        WHERE id=?
    ";

    $stmt = mysqli_prepare($conn,$update);

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssi",
        $name,
        $slug,
        $description,
        $icon,
        $imagePath,
        $status,
        $id
    );

    if(mysqli_stmt_execute($stmt)){

        mysqli_stmt_close($stmt);

        header(
            "Location: events-categories.php?id="
            .$eventCategory["category_id"]
        );

        exit();

    }

    $error = "Unable to update category.";

    mysqli_stmt_close($stmt);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Edit Event Category</title>

<link rel="stylesheet"
href="assets/css/admin.css">

<link rel="stylesheet"
href="assets/css/add-event-category.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<?php include "includes/sidebar.php"; ?>

<main class="admin-main">

<?php include "includes/topbar.php"; ?>

<div class="add-event-category-content">

<div class="add-event-category-header">

<div>

<a href="events-categories.php?id=<?= $eventCategory["category_id"]; ?>"
class="back-link">

<i class="fa-solid fa-arrow-left"></i>

Event Categories

</a>

<span class="page-eyebrow">

EVENTS DEPARTMENT

</span>

<h1>Edit Event Category</h1>

<p>Update this event category.</p>

</div>

</div>


<section class="event-category-form-card">

<?php if($error): ?>

<div class="form-error">

<i class="fa-solid fa-circle-exclamation"></i>

<?= $error; ?>

</div>

<?php endif; ?>


<form method="POST"
enctype="multipart/form-data">

<input type="hidden"
name="id"
value="<?= $eventCategory["id"]; ?>">


<div class="form-group">

<label>Category Name</label>

<input type="text"
name="name"
value="<?= htmlspecialchars($eventCategory["name"]); ?>"
required>

</div>


<div class="form-group">

<label>Slug</label>

<input type="text"
name="slug"
value="<?= htmlspecialchars($eventCategory["slug"]); ?>"
required>

</div>


<div class="form-group full-width">

<label>Short Description</label>

<textarea
name="short_description"
rows="4"
required><?= htmlspecialchars($eventCategory["short_description"]); ?></textarea>

</div>


<div class="form-group">

<label>Font Awesome Icon</label>

<input type="text"
name="icon"
value="<?= htmlspecialchars($eventCategory["icon"]); ?>">

</div>


<div class="form-group">

<label>Status</label>

<select name="status">

<option value="Active"
<?= $eventCategory["status"]==="Active"?"selected":""; ?>>

Active

</option>

<option value="Inactive"
<?= $eventCategory["status"]==="Inactive"?"selected":""; ?>>

Inactive

</option>

</select>

</div>


<div class="form-group full-width">

<label>Current Image</label>

<img src="<?= htmlspecialchars($eventCategory["image"]); ?>"
style="width:180px;height:120px;object-fit:cover;border-radius:12px;display:block;margin-bottom:12px;">

<input type="file"
name="image"
accept=".jpg,.jpeg,.png,.webp">

<small>
Leave empty to keep the current image.
</small>

</div>


<div class="form-actions">

<a href="events-categories.php?id=<?= $eventCategory["category_id"]; ?>"
class="cancel-button">

Cancel

</a>

<button type="submit"
class="save-button">

<i class="fa-solid fa-floppy-disk"></i>

Save Changes

</button>

</div>

</form>

</section>

</div>

<?php include "includes/footer.php"; ?>

</main>

</body>
</html>