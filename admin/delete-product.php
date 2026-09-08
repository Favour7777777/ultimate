
<?php

session_start();

if(!isset($_SESSION["admin_id"])){
    header("Location: login.php");
    exit();
}

require_once "../config.php";


/*
|--------------------------------------------------------------------------
| Check Product ID
|--------------------------------------------------------------------------
*/

if(!isset($_GET["id"]) || !is_numeric($_GET["id"])){
    header("Location: products.php");
    exit();
}

$productId = (int) $_GET["id"];


/*
|--------------------------------------------------------------------------
| Find Product
|--------------------------------------------------------------------------
| We first get the image name so we can remove the
| physical image file after deleting the database record.
|--------------------------------------------------------------------------
*/

$selectQuery = "
    SELECT image
    FROM products
    WHERE id = ?
";

$stmt = mysqli_prepare($conn, $selectQuery);

if(!$stmt){
    die("Database error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $productId);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$product = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


/*
|--------------------------------------------------------------------------
| Product Does Not Exist
|--------------------------------------------------------------------------
*/

if(!$product){
    header("Location: products.php");
    exit();
}


/*
|--------------------------------------------------------------------------
| Delete Product From Database
|--------------------------------------------------------------------------
*/

$deleteQuery = "
    DELETE FROM products
    WHERE id = ?
";

$stmt = mysqli_prepare($conn, $deleteQuery);

if(!$stmt){
    die("Database error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $productId);

if(mysqli_stmt_execute($stmt)){

    /*
    |--------------------------------------------------------------------------
    | Delete Product Image
    |--------------------------------------------------------------------------
    */

    if(!empty($product["image"])){

        $imagePath = __DIR__ . "/" . $product["image"];

        if(file_exists($imagePath)){
            unlink($imagePath);
        }
    }

    mysqli_stmt_close($stmt);

    /*
    |--------------------------------------------------------------------------
    | Return To Products Page
    |--------------------------------------------------------------------------
    */

    header("Location: products.php");
    exit();

}else{

    mysqli_stmt_close($stmt);

    die("Failed to delete product: " . mysqli_error($conn));
}

?>

