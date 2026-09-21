
<?php

session_start();

require_once "../config.php";
require_once "../mail/mailer.php";


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

$vendorMail = null;

if($action === "verify"){
    $vendorMailQuery = "
        SELECT
            vendors.store_name,
            vendors.business_email,
            users.fullname,
            users.email AS user_email
        FROM vendors
        INNER JOIN users
            ON users.id = vendors.user_id
        WHERE vendors.id = ?
        LIMIT 1
    ";

    $vendorMailStmt = mysqli_prepare($conn, $vendorMailQuery);
    mysqli_stmt_bind_param($vendorMailStmt, "i", $vendor_id);
    mysqli_stmt_execute($vendorMailStmt);
    $vendorMailResult = mysqli_stmt_get_result($vendorMailStmt);
    $vendorMail = mysqli_fetch_assoc($vendorMailResult);
    mysqli_stmt_close($vendorMailStmt);
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

if(
    $action === "verify" &&
    $vendorMail &&
    !empty(trim((string)$vendorMail["business_email"]))
){
    $vendorName = $vendorMail["fullname"] ?? "Vendor";
    $storeName = htmlspecialchars($vendorMail["store_name"] ?? "your store");
    $verifiedSubject = "Your Ultimate Vendor Has Been Verified";
    $verifiedBody = "
        <h2>Congratulations, " . htmlspecialchars($vendorName) . "!</h2>

        <p>
            Your store, <strong>" . $storeName . "</strong>, has been verified by
            the Ultimate admin team.
        </p>

        <p>
            Your verified vendor badge is now active. You can sign in to your
            vendor dashboard to manage your store, products, services and listings.
        </p>

        <p><strong>Verification Status:</strong> Verified</p>

        <p>Thank you for building your business with Ultimate.</p>
    ";

    sendUltimateMail(
        $vendorMail["business_email"],
        $vendorName,
        $verifiedSubject,
        $verifiedBody
    );

    if(
        filter_var($vendorMail["user_email"] ?? "", FILTER_VALIDATE_EMAIL) &&
        strcasecmp($vendorMail["user_email"], $vendorMail["business_email"]) !== 0
    ){
        sendUltimateMail(
            $vendorMail["user_email"],
            $vendorName,
            $verifiedSubject,
            $verifiedBody
        );
    }
}


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

