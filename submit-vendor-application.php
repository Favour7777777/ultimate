<?php

session_start();

include "config.php";
require_once "mail/mailer.php";


/* =========================================
   CHECK USER LOGIN
========================================= */

if(!isset($_SESSION["user_id"])){

    header("Location: login.php");
    exit();

}

$user_id = $_SESSION["user_id"];


/* =========================================
   GET FORM DATA
========================================= */

$store_name = trim($_POST["store_name"] ?? "");
$category_id = intval($_POST["category_id"] ?? 0);
$store_description = trim($_POST["store_description"] ?? "");
$phone_number = trim($_POST["phone_number"] ?? "");
$business_email = trim($_POST["business_email"] ?? "");
$business_address = trim($_POST["business_address"] ?? "");


/* =========================================
   VALIDATE REQUIRED FIELDS
========================================= */

if(
    empty($store_name) ||
    $category_id <= 0 ||
    empty($phone_number) ||
    empty($business_email) ||
    empty($business_address)
){

    die("Please complete all required fields.");

}


/* =========================================
   VALIDATE EMAIL
========================================= */

if(!filter_var($business_email, FILTER_VALIDATE_EMAIL)){

    die("Please enter a valid business email address.");

}


/* =========================================
   CHECK CATEGORY
========================================= */

$categoryQuery = "
    SELECT id
    FROM categories
    WHERE id = ?
";

$categoryStmt = mysqli_prepare($conn, $categoryQuery);

mysqli_stmt_bind_param(
    $categoryStmt,
    "i",
    $category_id
);

mysqli_stmt_execute($categoryStmt);

$categoryResult = mysqli_stmt_get_result($categoryStmt);

if(mysqli_num_rows($categoryResult) === 0){

    mysqli_stmt_close($categoryStmt);

    die("The selected category does not exist.");

}

mysqli_stmt_close($categoryStmt);


/* =========================================
   CHECK EXISTING VENDOR APPLICATION
========================================= */

$vendorQuery = "
    SELECT id, status
    FROM vendors
    WHERE user_id = ?
    LIMIT 1
";

$vendorStmt = mysqli_prepare($conn, $vendorQuery);

mysqli_stmt_bind_param(
    $vendorStmt,
    "i",
    $user_id
);

mysqli_stmt_execute($vendorStmt);

$vendorResult = mysqli_stmt_get_result($vendorStmt);

if(mysqli_num_rows($vendorResult) > 0){

    $vendor = mysqli_fetch_assoc($vendorResult);

    mysqli_stmt_close($vendorStmt);

    die(
        "You already have a vendor account or application. " .
        "Current status: " . htmlspecialchars($vendor["status"])
    );

}

mysqli_stmt_close($vendorStmt);

$userQuery = "
    SELECT fullname, email
    FROM users
    WHERE id = ?
    LIMIT 1
";

$userStmt = mysqli_prepare($conn, $userQuery);

mysqli_stmt_bind_param(
    $userStmt,
    "i",
    $user_id
);

mysqli_stmt_execute($userStmt);

$userResult = mysqli_stmt_get_result($userStmt);

$user = mysqli_fetch_assoc($userResult);

mysqli_stmt_close($userStmt);

$fullname = $user["fullname"] ?? "Vendor";
$userEmail = $user["email"] ?? "";


/* =========================================
   CREATE VENDOR APPLICATION
========================================= */

$insertQuery = "
    INSERT INTO vendors (
        user_id,
        category_id,
        store_name,
        store_description,
        phone_number,
        business_email,
        business_address,
        status
    )
    VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')
";

$insertStmt = mysqli_prepare($conn, $insertQuery);

mysqli_stmt_bind_param(
    $insertStmt,
    "iisssss",
    $user_id,
    $category_id,
    $store_name,
    $store_description,
    $phone_number,
    $business_email,
    $business_address
);

mysqli_stmt_execute($insertStmt);

$vendor_id = mysqli_insert_id($conn);


// =========================================
// SEND VENDOR APPLICATION EMAIL
// =========================================

$vendorSubject = "Welcome to Ultimate - Vendor Application Received";

$vendorBody = "
    <h2>Welcome to Ultimate, " . htmlspecialchars($fullname) . "!</h2>

    <p>
        Your vendor application for <strong>" . htmlspecialchars($store_name) . "</strong>
        has been successfully submitted to the Ultimate admin team for review.
    </p>

    <p>
        Our team will review your application and update you once
        a decision has been made.
    </p>

    <p>
        <strong>Application Status:</strong> Pending Approval
    </p>

    <p>
        Thank you for choosing Ultimate.
    </p>
";

sendUltimateMail(
    $business_email,
    $fullname,
    $vendorSubject,
    $vendorBody
);

if(
    filter_var($userEmail, FILTER_VALIDATE_EMAIL) &&
    strcasecmp($userEmail, $business_email) !== 0
){
    sendUltimateMail(
        $userEmail,
        $fullname,
        $vendorSubject,
        $vendorBody
    );
}



mysqli_stmt_close($insertStmt);


/* =========================================
   CREATE ADMIN NOTIFICATION
========================================= */

$notificationQuery = "
    INSERT INTO admin_notifications (
        type,
        title,
        message,
        reference_id,
        reference_type
    )
    VALUES (?, ?, ?, ?, ?)
";

$notificationStmt = mysqli_prepare(
    $conn,
    $notificationQuery
);

$notificationType = "vendor_application";

$notificationTitle = "New Vendor Application";

$notificationMessage =
    "A new vendor application has been submitted by a user.";

$referenceType = "vendor";

mysqli_stmt_bind_param(
    $notificationStmt,
    "sssis",
    $notificationType,
    $notificationTitle,
    $notificationMessage,
    $vendor_id,
    $referenceType
);

mysqli_stmt_execute($notificationStmt);

mysqli_stmt_close($notificationStmt);

/* =========================================
   APPLICATION SUBMITTED
========================================= */

header("Location: vendor-application-status.php");
exit();

?>