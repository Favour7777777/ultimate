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
    DATABASE CONNECTION
=========================================================
*/

require_once "../config.php";


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
    SELECT image
    FROM categories
    WHERE id = ?
";


$stmt = mysqli_prepare(
    $conn,
    $query
);


if(!$stmt){

    die(
        "Database error: "
        . mysqli_error($conn)
    );

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
    CATEGORY DOES NOT EXIST
=========================================================
*/

if(!$category){

    header("Location: categories.php");

    exit();

}


/*
=========================================================
    DELETE CATEGORY
=========================================================
*/

$deleteQuery = "
    DELETE FROM categories
    WHERE id = ?
";


$deleteStmt = mysqli_prepare(
    $conn,
    $deleteQuery
);


if(!$deleteStmt){

    die(
        "Database error: "
        . mysqli_error($conn)
    );

}


mysqli_stmt_bind_param(
    $deleteStmt,
    "i",
    $categoryId
);


if(mysqli_stmt_execute($deleteStmt)){


    mysqli_stmt_close($deleteStmt);


    /*
    =====================================================
        DELETE CATEGORY IMAGE
    =====================================================
    */

    if(
        !empty($category["image"]) &&
        file_exists($category["image"])
    ){

        unlink($category["image"]);

    }


    /*
    =====================================================
        RETURN TO CATEGORIES
    =====================================================
    */

    header(
        "Location: categories.php?success=category_deleted"
    );

    exit();

}


else{


    $error =
        "Category could not be deleted: "
        . mysqli_stmt_error($deleteStmt);


    mysqli_stmt_close($deleteStmt);


    die($error);

}

?>