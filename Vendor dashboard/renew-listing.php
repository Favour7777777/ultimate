<?php

session_start();
include "../config.php";


/* =========================================
   CHECK VENDOR LOGIN
========================================= */

if(!isset($_SESSION["vendor_id"])){
    header("Location: login.php");
    exit();
}


$vendor_id = $_SESSION["vendor_id"];


/* =========================================
   GET FORM DATA
========================================= */

$type = $_POST["type"] ?? "";
$listing_id = intval($_POST["listing_id"] ?? 0);


/* =========================================
   VALIDATE REQUEST
========================================= */

if($listing_id <= 0 || !in_array($type, ["product", "service"])){
    header("Location: renewal.php");
    exit();
}


/* =========================================
   RENEW PRODUCT
========================================= */

if($type === "product"){

    $query = "
        UPDATE products
        SET
            last_availability_renewal = NOW(),
            availability_renewal_due = DATE_ADD(NOW(), INTERVAL 24 HOUR),
            availability_status = 'Available'
        WHERE
            id = ?
            AND vendor_id = ?
            AND approval_status = 'Approved'
    ";
}


/* =========================================
   RENEW SERVICE
========================================= */

if($type === "service"){

    $query = "
        UPDATE services
        SET
            last_availability_renewal = NOW(),
            availability_renewal_due = DATE_ADD(NOW(), INTERVAL 24 HOUR),
            availability_status = 'Available'
        WHERE
            id = ?
            AND vendor_id = ?
            AND approval_status = 'Approved'
    ";
}


/* =========================================
   EXECUTE RENEWAL
========================================= */

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param(
    $stmt,
    "ii",
    $listing_id,
    $vendor_id
);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);


/* =========================================
   RETURN TO RENEWAL PAGE
========================================= */

header("Location: renewal.php");
exit();

?>