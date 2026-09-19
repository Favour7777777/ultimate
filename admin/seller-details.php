```php
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


$currentPage = "sellers";


/* =========================
   GET SELLER ID
========================= */

$vendor_id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;


if($vendor_id <= 0){

    header("Location: sellers.php");

    exit();

}


/* =========================
   FETCH SELLER
========================= */

$vendorQuery = "
    SELECT
        vendors.id,
        vendors.user_id,
        vendors.store_name,
        vendors.store_description,
        vendors.phone_number,
        vendors.business_email,
        vendors.business_address,
        vendors.status,
        vendors.is_verified,
        vendors.created_at,

        users.fullname,
        users.email,
        users.profile_image,

        categories.title AS category_name

    FROM vendors

    INNER JOIN users
        ON vendors.user_id = users.id

    INNER JOIN categories
        ON vendors.category_id = categories.id

    WHERE vendors.id = ?

    LIMIT 1
";


$stmt = mysqli_prepare($conn, $vendorQuery);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $vendor_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$vendor = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


if(!$vendor){

    header("Location: sellers.php");

    exit();

}


/* =========================
   COUNT PRODUCTS
========================= */

$productCount = 0;

$productQuery = "
    SELECT COUNT(*) AS total
    FROM products
    WHERE vendor_id = ?
";

$stmt = mysqli_prepare($conn, $productQuery);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $vendor_id
);

mysqli_stmt_execute($stmt);

$productResult = mysqli_stmt_get_result($stmt);

if($productData = mysqli_fetch_assoc($productResult)){

    $productCount = (int)$productData["total"];

}

mysqli_stmt_close($stmt);


/* =========================
   COUNT SERVICES
========================= */

$serviceCount = 0;

$serviceQuery = "
    SELECT COUNT(*) AS total
    FROM services
    WHERE vendor_id = ?
";

$stmt = mysqli_prepare($conn, $serviceQuery);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $vendor_id
);

mysqli_stmt_execute($stmt);

$serviceResult = mysqli_stmt_get_result($stmt);

if($serviceData = mysqli_fetch_assoc($serviceResult)){

    $serviceCount = (int)$serviceData["total"];

}

mysqli_stmt_close($stmt);


/* =========================
   FUTURE PERFORMANCE DATA
========================= */

$engagements = 0;

$orders = 0;

$successfulDeliveries = 0;

$reviews = 0;

$averageRating = 0;


/*
    FUTURE:

    When the engagement system is created,
    connect it here using:

    $vendor_id

    When the orders system is created,
    connect completed orders here.

    When the delivery system is created,
    connect successful deliveries here.

    When the vendor review system is created,
    connect reviews and ratings here.
*/


$totalListings = $productCount + $serviceCount;

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
        <?= htmlspecialchars($vendor["store_name"]); ?> | Ultimate Admin
    </title>


    <link
        rel="stylesheet"
        href="assets/css/admin.css"
    >

    <link
        rel="stylesheet"
        href="assets/css/seller-details.css"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

</head>


<body>


<?php include "includes/sidebar.php"; ?>


<main class="admin-main">


    <?php include "includes/topbar.php"; ?>


    <section class="admin-content">


        <!-- =========================
             BACK
        ========================== -->

        <a
            href="sellers.php"
            class="seller-back"
        >

            <i class="fa-solid fa-arrow-left"></i>

            Back to Sellers

        </a>


        <!-- =========================
             SELLER PROFILE
        ========================== -->

        <div class="seller-profile-card">


            <div class="seller-profile-main">


                <div class="seller-profile-avatar">

                    <?php if(!empty($vendor["profile_image"])): ?>

                        <img
                            src="../<?= htmlspecialchars($vendor["profile_image"]); ?>"
                            alt="<?= htmlspecialchars($vendor["store_name"]); ?>"
                        >

                    <?php else: ?>

                        <i class="fa-solid fa-store"></i>

                    <?php endif; ?>

                </div>


                <div class="seller-profile-info">

                    <span class="seller-eyebrow">
                        SELLER PROFILE
                    </span>

                    <h1>
                        <?= htmlspecialchars($vendor["store_name"]); ?>
                    </h1>

                    <p>
                        <?= htmlspecialchars($vendor["category_name"]); ?>
                    </p>


                    <div class="seller-profile-status">


                        <?php if($vendor["status"] === "Approved"): ?>

                            <span class="status-pill approved">

                                <i class="fa-solid fa-circle-check"></i>

                                Approved

                            </span>

                        <?php elseif($vendor["status"] === "Pending"): ?>

                            <span class="status-pill pending">

                                <i class="fa-solid fa-clock"></i>

                                Pending

                            </span>

                        <?php elseif($vendor["status"] === "Rejected"): ?>

                            <span class="status-pill rejected">

                                <i class="fa-solid fa-circle-xmark"></i>

                                Rejected

                            </span>

                        <?php elseif($vendor["status"] === "Suspended"): ?>

                            <span class="status-pill suspended">

                                <i class="fa-solid fa-ban"></i>

                                Suspended

                            </span>

                        <?php else: ?>

                            <span class="status-pill dormant">

                                <i class="fa-solid fa-moon"></i>

                                Dormant

                            </span>

                        <?php endif; ?>


                        <?php if((int)$vendor["is_verified"] === 1): ?>

                            <span class="status-pill verified">

                                <i class="fa-solid fa-shield-check"></i>

                                Verified

                            </span>

                        <?php else: ?>

                            <span class="status-pill not-verified">

                                <i class="fa-solid fa-shield"></i>

                                Not Verified

                            </span>

                        <?php endif; ?>


                    </div>

                </div>


            </div>


            <div class="seller-profile-date">

                <span>
                    Joined Ultimate
                </span>

                <strong>
                    <?= date(
                        "M d, Y",
                        strtotime($vendor["created_at"])
                    ); ?>
                </strong>

            </div>


        </div>


        <!-- =========================
             PERFORMANCE
        ========================== -->

        <div class="section-title">

            <div>

                <span>
                    SELLER PERFORMANCE
                </span>

                <h2>
                    Marketplace Activity
                </h2>

            </div>

            <p>
                Performance data used to evaluate vendor activity.
            </p>

        </div>


        <div class="performance-grid">


            <!-- ENGAGEMENTS -->

            <div class="performance-card">

                <div class="performance-icon">

                    <i class="fa-solid fa-chart-line"></i>

                </div>

                <span>
                    Engagements
                </span>

                <strong>
                    <?= number_format($engagements); ?>
                </strong>

                <small>
                    Views, clicks & interactions
                </small>

            </div>


            <!-- ORDERS -->

            <div class="performance-card">

                <div class="performance-icon">

                    <i class="fa-solid fa-bag-shopping"></i>

                </div>

                <span>
                    Orders
                </span>

                <strong>
                    <?= number_format($orders); ?>
                </strong>

                <small>
                    Completed marketplace orders
                </small>

            </div>


            <!-- DELIVERIES -->

            <div class="performance-card">

                <div class="performance-icon">

                    <i class="fa-solid fa-truck-fast"></i>

                </div>

                <span>
                    Successful Deliveries
                </span>

                <strong>
                    <?= number_format($successfulDeliveries); ?>
                </strong>

                <small>
                    Successfully fulfilled orders
                </small>

            </div>


            <!-- REVIEWS -->

            <div class="performance-card">

                <div class="performance-icon">

                    <i class="fa-solid fa-star"></i>

                </div>

                <span>
                    Reviews
                </span>

                <strong>
                    <?= number_format($reviews); ?>
                </strong>

                <small>
                    Customer reviews received
                </small>

            </div>


            <!-- RATING -->

            <div class="performance-card">

                <div class="performance-icon">

                    <i class="fa-solid fa-ranking-star"></i>

                </div>

                <span>
                    Average Rating
                </span>

                <strong>

                    <?php if($averageRating > 0): ?>

                        <?= number_format($averageRating, 1); ?>

                    <?php else: ?>

                        —

                    <?php endif; ?>

                </strong>

                <small>
                    Based on customer reviews
                </small>

            </div>


            <!-- LISTINGS -->

            <div class="performance-card">

                <div class="performance-icon">

                    <i class="fa-solid fa-layer-group"></i>

                </div>

                <span>
                    Total Listings
                </span>

                <strong>
                    <?= number_format($totalListings); ?>
                </strong>

                <small>
                    Products & services
                </small>

            </div>


        </div>


        <!-- =========================
             SELLER INFORMATION
        ========================== -->

        <div class="seller-details-grid">


            <!-- STORE INFORMATION -->

            <div class="details-card">

                <div class="details-heading">

                    <i class="fa-solid fa-store"></i>

                    <div>

                        <h3>
                            Store Information
                        </h3>

                        <p>
                            Business details
                        </p>

                    </div>

                </div>


                <div class="detail-row">

                    <span>
                        Store Name
                    </span>

                    <strong>
                        <?= htmlspecialchars($vendor["store_name"]); ?>
                    </strong>

                </div>


                <div class="detail-row">

                    <span>
                        Category
                    </span>

                    <strong>
                        <?= htmlspecialchars($vendor["category_name"]); ?>
                    </strong>

                </div>


                <div class="detail-row">

                    <span>
                        Business Email
                    </span>

                    <strong>
                        <?= htmlspecialchars($vendor["business_email"]); ?>
                    </strong>

                </div>


                <div class="detail-row">

                    <span>
                        Phone
                    </span>

                    <strong>
                        <?= htmlspecialchars($vendor["phone_number"]); ?>
                    </strong>

                </div>


                <div class="detail-row">

                    <span>
                        Address
                    </span>

                    <strong>
                        <?= htmlspecialchars($vendor["business_address"]); ?>
                    </strong>

                </div>


            </div>


            <!-- ACCOUNT OWNER -->

            <div class="details-card">

                <div class="details-heading">

                    <i class="fa-solid fa-user"></i>

                    <div>

                        <h3>
                            Account Owner
                        </h3>

                        <p>
                            Registered user information
                        </p>

                    </div>

                </div>


                <div class="detail-row">

                    <span>
                        Full Name
                    </span>

                    <strong>
                        <?= htmlspecialchars($vendor["fullname"]); ?>
                    </strong>

                </div>


                <div class="detail-row">

                    <span>
                        Account Email
                    </span>

                    <strong>
                        <?= htmlspecialchars($vendor["email"]); ?>
                    </strong>

                </div>


                <div class="detail-row">

                    <span>
                        Products
                    </span>

                    <strong>
                        <?= number_format($productCount); ?>
                    </strong>

                </div>


                <div class="detail-row">

                    <span>
                        Services
                    </span>

                    <strong>
                        <?= number_format($serviceCount); ?>
                    </strong>

                </div>


            </div>


        </div>


        <!-- =========================
             VERIFICATION
        ========================== -->

        <div class="verification-panel">


            <div>

                <span class="verification-eyebrow">
                    VENDOR VERIFICATION
                </span>

                <h2>
                    Verification Review
                </h2>

                <p>
                    Verification should be based on marketplace
                    performance rather than how long the seller
                    has existed on Ultimate.
                </p>

            </div>


            <div class="verification-status-box">


                <?php if((int)$vendor["is_verified"] === 1): ?>


                    <!-- VERIFIED -->

                    <div class="verification-current verified">

                        <i class="fa-solid fa-shield-check"></i>

                        <div>

                            <strong>
                                Verified Vendor
                            </strong>

                            <span>
                                This seller is currently verified.
                            </span>

                        </div>

                    </div>


                    <form
                        action="verify-vendor.php"
                        method="POST"
                    >

                        <input
                            type="hidden"
                            name="vendor_id"
                            value="<?= $vendor["id"]; ?>"
                        >

                        <input
                            type="hidden"
                            name="action"
                            value="remove"
                        >

                        <button
                            type="submit"
                            class="verification-btn remove"
                        >

                            Remove Verification

                        </button>

                    </form>


                <?php else: ?>


                    <!-- NOT VERIFIED -->

                    <div class="verification-current">

                        <i class="fa-solid fa-shield"></i>

                        <div>

                            <strong>
                                Not Verified
                            </strong>

                            <span>
                                Performance review required.
                            </span>

                        </div>

                    </div>


                    <form
                        action="verify-vendor.php"
                        method="POST"
                    >

                        <input
                            type="hidden"
                            name="vendor_id"
                            value="<?= $vendor["id"]; ?>"
                        >

                        <input
                            type="hidden"
                            name="action"
                            value="verify"
                        >

                        <button
                            type="submit"
                            class="verification-btn"
                        >

                            Verify Vendor

                            <i class="fa-solid fa-arrow-right"></i>

                        </button>

                    </form>


                <?php endif; ?>


            </div>


        </div>


    </section>


    <?php include "includes/footer.php"; ?>


</main>


</body>

</html>

