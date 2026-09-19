
<?php

session_start();

require_once "../config.php";


/* =========================
   ADMIN AUTHENTICATION
========================= */

if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");

    exit();

}


/* =========================
   GET VENDOR ID
========================= */

$vendor_id = isset($_POST["vendor_id"])
    ? (int) $_POST["vendor_id"]
    : 0;

$action = $_POST["action"] ?? "";


if($vendor_id <= 0){

    header("Location: sellers.php");

    exit();

}


/* =========================
   VERIFY / REMOVE
========================= */

if($action === "verify"){

    $query = "
        UPDATE vendors
        SET is_verified = 1
        WHERE id = ?
    ";

}
elseif($action === "remove"){

    $query = "
        UPDATE vendors
        SET is_verified = 0
        WHERE id = ?
    ";

}
else{

    header("Location: seller-details.php?id=" . $vendor_id);

    exit();

}


$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $vendor_id
);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);


/* =========================
   RETURN TO SELLER DETAILS
========================= */

header(
    "Location: seller-details.php?id=" .
    $vendor_id .
    "&updated=1"
);

exit();
?>

