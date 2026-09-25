<?php

session_start();

if(!isset($_SESSION["admin_id"])){
    header("Location: login.php");
    exit();
}

require_once "../config.php";

/* =========================================
   GET EVENT CATEGORY ID
========================================= */

$id = (int)($_GET["id"] ?? 0);

if($id <= 0){
    header("Location: events-categories.php");
    exit();
}

/* =========================================
   GET CATEGORY DETAILS
========================================= */

$query = "
    SELECT
        id,
        category_id,
        image
    FROM event_categories
    WHERE id = ?
    LIMIT 1
";

$stmt = mysqli_prepare($conn, $query);

if(!$stmt){
    die("Database error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$category = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if(!$category){
    header("Location: events-categories.php");
    exit();
}

/* =========================================
   DELETE DATABASE RECORD
========================================= */

$delete = "
    DELETE FROM event_categories
    WHERE id = ?
";

$stmt = mysqli_prepare($conn, $delete);

if(!$stmt){
    die("Database error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $id);

if(mysqli_stmt_execute($stmt)){
    mysqli_stmt_close($stmt);

    if(
        !empty($category["image"]) &&
        file_exists($category["image"])
    ){
        unlink($category["image"]);
    }

    header(
        "Location: events-categories.php?id="
        . (int)$category["category_id"]
    );

    exit();
}

mysqli_stmt_close($stmt);

die("Unable to delete event category.");