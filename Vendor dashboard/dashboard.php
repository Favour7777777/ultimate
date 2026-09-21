<?php

session_start();

require_once "../config.php";


if(!isset($_SESSION["user_id"])){
    header("Location: ../login.php?return_to=Vendor%20dashboard/dashboard.php");
    exit();
}

$vendorQuery = "
    SELECT
    id,
    store_name,
    is_verified,
    verification_notice_seen
    FROM vendors
    WHERE user_id = ?
    AND status = 'Approved'
    LIMIT 1
";

$vendorStmt = mysqli_prepare($conn, $vendorQuery);

mysqli_stmt_bind_param(
    $vendorStmt,
    "i",
    $_SESSION["user_id"]
);



mysqli_stmt_execute($vendorStmt);

$vendorResult = mysqli_stmt_get_result($vendorStmt);

$vendor = mysqli_fetch_assoc($vendorResult);

mysqli_stmt_close($vendorStmt);

if(
    $vendor &&
    (int)$vendor["is_verified"] === 1 &&
    (int)$vendor["verification_notice_seen"] === 0
){
    header("Location: verification-welcome.php?id=" . $vendor["id"]);

exit();
}

if(!$vendor){
    header("Location: ../vendor-dashboard-entry.php");
    exit();
}

$_SESSION["vendor_id"] = $vendor["id"];


$currentPage = "dashboard";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Vendor Dashboard | Ultimate</title>


    <!-- FONT AWESOME -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >


    <!-- VENDOR LAYOUT -->

    <link
        rel="stylesheet"
        href="css/includes.css"
    >


    <!-- DASHBOARD -->

    <link
        rel="stylesheet"
        href="css/dashboard.css"
    >

</head>


<body>


<div class="vendor-layout">


    <!-- SIDEBAR -->

    <?php include "includes/sidebar.php"; ?>


    <!-- MAIN -->

    <main class="vendor-main">


        <!-- TOPBAR -->

        <?php include "includes/topbar.php"; ?>


        <!-- DASHBOARD -->

        <section class="dashboard-content">


            <!-- PAGE HEADER -->

            <div class="dashboard-header">

                <div>

                    <span class="dashboard-eyebrow">
                        VENDOR CENTER
                    </span>

                    <h1>
                        Welcome back, <?= htmlspecialchars($vendor["store_name"]); ?> 👋
                    </h1>

                    <p>
                        Manage your store, listings, orders and earnings from one place.
                    </p>

                </div>


                <a
                    href="products.php"
                    class="add-listing-btn"
                >

                    <i class="fa-solid fa-plus"></i>

                    Add Listing

                </a>

            </div>



            <!-- STORE STATUS -->

            <div class="store-status-card">

                <div class="status-icon">

                    <i class="fa-solid fa-store"></i>

                </div>


                    <div class="status-content">

                        <span>
                            VENDOR ACCOUNT
                        </span>

                        <strong>
                            Your vendor account is approved
                        </strong>

                        <p>
                            Your account has been approved and you can now start managing your store on Ultimate.
                        </p>

                    </div>


                    <div class="status-indicator">

                <span class="status-dot"></span>

                Approved

            </div>


            <?php if((int)$vendor["is_verified"] === 1): ?>

                <div class="verified-vendor-tag">

                    <i class="fa-solid fa-shield-check"></i>

                    Verified Vendor

                </div>

            <?php endif; ?>

                    </div>



            <!-- STATISTICS -->

            <div class="dashboard-stats">


                <!-- PRODUCTS -->

                <div class="stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon purple">

                            <i class="fa-solid fa-box"></i>

                        </div>

                        <span class="stat-label">
                            PRODUCTS
                        </span>

                    </div>


                    <div class="stat-number">
                        0
                    </div>


                    <p class="stat-description">
                        Products listed in your store
                    </p>

                </div>



                <!-- SERVICES -->

                <div class="stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon blue">

                            <i class="fa-solid fa-briefcase"></i>

                        </div>

                        <span class="stat-label">
                            SERVICES
                        </span>

                    </div>


                    <div class="stat-number">
                        0
                    </div>


                    <p class="stat-description">
                        Services listed in your store
                    </p>

                </div>



                <!-- ORDERS -->

                <div class="stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon green">

                            <i class="fa-solid fa-cart-shopping"></i>

                        </div>

                        <span class="stat-label">
                            ORDERS
                        </span>

                    </div>


                    <div class="stat-number">
                        0
                    </div>


                    <p class="stat-description">
                        Orders received from customers
                    </p>

                </div>



                <!-- EARNINGS -->

                <div class="stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon gold">

                            <i class="fa-solid fa-naira-sign"></i>

                        </div>

                        <span class="stat-label">
                            EARNINGS
                        </span>

                    </div>


                    <div class="stat-number">
                        ₦0
                    </div>


                    <p class="stat-description">
                        Total earnings
                    </p>

                </div>

            </div>



            <!-- DASHBOARD GRID -->

            <div class="dashboard-grid">


                <!-- RECENT ORDERS -->

                <div class="dashboard-panel">

                    <div class="panel-header">

                        <div>

                            <span class="panel-eyebrow">
                                ACTIVITY
                            </span>

                            <h2>
                                Recent Orders
                            </h2>

                        </div>


                        <a href="orders.php">
                            View All
                        </a>

                    </div>


                    <div class="empty-state">

                        <div class="empty-icon">

                            <i class="fa-solid fa-cart-shopping"></i>

                        </div>


                        <h3>
                            No orders yet
                        </h3>


                        <p>
                            Orders from your customers will appear here.
                        </p>

                    </div>

                </div>



                <!-- QUICK ACTIONS -->

                <div class="dashboard-panel">

                    <div class="panel-header">

                        <div>

                            <span class="panel-eyebrow">
                                SHORTCUTS
                            </span>

                            <h2>
                                Quick Actions
                            </h2>

                        </div>

                    </div>


                    <div class="quick-actions">


                        <!-- ADD PRODUCT -->

                        <a
                            href="products.php"
                            class="quick-action"
                        >

                            <div class="quick-action-icon">

                                <i class="fa-solid fa-box"></i>

                            </div>


                            <div>

                                <strong>
                                    Add Product
                                </strong>

                                <span>
                                    Create a new product listing
                                </span>

                            </div>


                            <i class="fa-solid fa-arrow-right"></i>

                        </a>



                        <!-- ADD SERVICE -->

                        <a
                            href="services.php"
                            class="quick-action"
                        >

                            <div class="quick-action-icon">

                                <i class="fa-solid fa-briefcase"></i>

                            </div>


                            <div>

                                <strong>
                                    Add Service
                                </strong>

                                <span>
                                    Create a new service listing
                                </span>

                            </div>


                            <i class="fa-solid fa-arrow-right"></i>

                        </a>



                        <!-- STORE PROFILE -->

                        <a
                            href="store-profile.php"
                            class="quick-action"
                        >

                            <div class="quick-action-icon">

                                <i class="fa-solid fa-store"></i>

                            </div>


                            <div>

                                <strong>
                                    Store Profile
                                </strong>

                                <span>
                                    Manage your public store
                                </span>

                            </div>


                            <i class="fa-solid fa-arrow-right"></i>

                        </a>



                        <!-- SETTINGS -->

                        <a
                            href="settings.php"
                            class="quick-action"
                        >

                            <div class="quick-action-icon">

                                <i class="fa-solid fa-gear"></i>

                            </div>


                            <div>

                                <strong>
                                    Settings
                                </strong>

                                <span>
                                    Manage your vendor account
                                </span>

                            </div>


                            <i class="fa-solid fa-arrow-right"></i>

                        </a>

                    </div>

                </div>

            </div>



            <!-- STORE PERFORMANCE -->

            <div class="dashboard-panel performance-panel">

                <div class="panel-header">

                    <div>

                        <span class="panel-eyebrow">
                            STORE PERFORMANCE
                        </span>

                        <h2>
                            Listing Overview
                        </h2>

                    </div>

                </div>


                <div class="performance-grid">


                    <!-- PRODUCT VIEWS -->

                    <div class="performance-item">

                        <span class="performance-number">
                            0
                        </span>

                        <span class="performance-label">
                            Product Views
                        </span>

                    </div>



                    <!-- SERVICE VIEWS -->

                    <div class="performance-item">

                        <span class="performance-number">
                            0
                        </span>

                        <span class="performance-label">
                            Service Views
                        </span>

                    </div>



                    <!-- REVIEWS -->

                    <div class="performance-item">

                        <span class="performance-number">
                            0
                        </span>

                        <span class="performance-label">
                            Customer Reviews
                        </span>

                    </div>



                    <!-- COMPLETED ORDERS -->

                    <div class="performance-item">

                        <span class="performance-number">
                            0
                        </span>

                        <span class="performance-label">
                            Completed Orders
                        </span>

                    </div>

                </div>

            </div>


        </section>



        <!-- FOOTER -->

        <?php include "includes/footer.php"; ?>


    </main>


</div>



<!-- VENDOR JAVASCRIPT -->

<script src="js/dashboard.js"></script>


</body>

</html>