<?php

session_start();

if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");
    exit();

}

require_once "../config.php";


/*
=========================================
    VALIDATE REVIEW ID
=========================================
*/

if(
    !isset($_GET["id"]) ||
    !is_numeric($_GET["id"])
){

    header("Location: reviews.php");
    exit();

}


$reviewId = (int) $_GET["id"];


/*
=========================================
    APPROVE REVIEW
=========================================
*/

$query = "
    UPDATE reviews

    SET status = 'Approved'

    WHERE id = ?
";


$stmt = mysqli_prepare(
    $conn,
    $query
);


if(!$stmt){

    die(
        "Database error: " .
        mysqli_error($conn)
    );

}


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $reviewId
);


mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);


/*
=========================================
    RETURN TO REVIEWS PAGE
=========================================
*/

header("Location: reviews.php");
exit();

?>