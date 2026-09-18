<?php

session_start();


/* =========================
   CHECK LOGIN
========================= */

if(!isset($_SESSION["user_id"])){

    header("Location: login.php?return_to=vendor-dashboard-entry.php");

    exit();

}


require_once "config.php";


$user_id = $_SESSION["user_id"];

if(isset($_POST["continue_dashboard"])){

    $updateQuery = "
        UPDATE vendors
        SET approval_notice_seen = 1
        WHERE user_id = ?
        AND status = 'Approved'
    ";

    $stmt = mysqli_prepare($conn, $updateQuery);

    mysqli_stmt_bind_param($stmt, "i", $user_id);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("Location: Vendor dashboard/dashboard.php");
    exit();
}


/* =========================
   FETCH VENDOR
========================= */

$vendorQuery = "
    SELECT
        id,
        store_name,
        status,
        approval_notice_seen
    FROM vendors
    WHERE user_id = ?
    LIMIT 1
";

$stmt = mysqli_prepare($conn, $vendorQuery);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $user_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$vendor = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


/* =========================
   CHECK VENDOR
========================= */

if(!$vendor){

    header("Location: become-vendor.php");

    exit();

}


/* =========================
   CHECK APPROVAL
========================= */

if($vendor["status"] !== "Approved"){

    header("Location: become-vendor.php");

    exit();

}


/* =========================
   CHECK APPROVAL NOTICE
========================= */

if((int)$vendor["approval_notice_seen"] === 1){

    header("Location: Vendor dashboard/dashboard.php");

    exit();

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
        Vendor Application Approved | Ultimate
    </title>


    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="vendor-dashboard-entry.css"
    >

</head>


<body>


<div class="approval-page">


    <div class="approval-glow glow-one"></div>

    <div class="approval-glow glow-two"></div>


    <div class="approval-modal">


        <div class="approval-icon">

            <div class="approval-icon-inner">

                <i class="fa-solid fa-check"></i>

            </div>

        </div>


        <span class="approval-eyebrow">
            VENDOR APPLICATION
        </span>


        <h1>
            You're Approved
        </h1>


        <p class="approval-message">

            Congratulations,
            <strong>
                <?= htmlspecialchars($vendor["store_name"]); ?>
            </strong>

            has officially been approved on Ultimate.

        </p>


        <div class="approval-status">

            <i class="fa-solid fa-circle-check"></i>

            Application Reviewed & Approved

        </div>


        <p class="approval-subtext">

            Your vendor account is now ready.
            Continue to your dashboard to start managing
            your store, products and services.

        </p>


        

        <form action="vendor-dashboard-entry.php" method="POST">
            <button type="submit" name="continue_dashboard" class="continue-btn">
                Continue to Vendor Dashboard
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>


    </div>


</div>


</body>

</html>