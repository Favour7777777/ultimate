
<?php

session_start();
include "../config.php";

/*
if(!isset($_SESSION["vendor_id"])){
    header("Location: login.php");
    exit();
}
*/

$currentPage = "renewal";

$vendor_id = $_SESSION["vendor_id"] ?? 0;


/* =========================
   FETCH VENDOR PRODUCTS
========================= */

$products = [];

if($vendor_id){

    $productQuery = "
        SELECT 
            id,
            product_name,
            price,
            image,
            status,
            approval_status,
            last_availability_renewal,
            availability_renewal_due,
            availability_status
        FROM products
        WHERE vendor_id = ?
        ORDER BY created_at DESC
    ";

    $stmt = mysqli_prepare($conn, $productQuery);

    mysqli_stmt_bind_param($stmt, "i", $vendor_id);

    mysqli_stmt_execute($stmt);

    $productResult = mysqli_stmt_get_result($stmt);

    while($row = mysqli_fetch_assoc($productResult)){
        $products[] = $row;
    }

    mysqli_stmt_close($stmt);
}


/* =========================
   FETCH VENDOR SERVICES
========================= */

$services = [];

if($vendor_id){

    $serviceQuery = "
        SELECT 
            id,
            service_name,
            price,
            image,
            status,
            approval_status,
            last_availability_renewal,
            availability_renewal_due,
            availability_status
        FROM services
        WHERE vendor_id = ?
        ORDER BY created_at DESC
    ";

    $stmt = mysqli_prepare($conn, $serviceQuery);

    mysqli_stmt_bind_param($stmt, "i", $vendor_id);

    mysqli_stmt_execute($stmt);

    $serviceResult = mysqli_stmt_get_result($stmt);

    while($row = mysqli_fetch_assoc($serviceResult)){
        $services[] = $row;
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Renewals | Ultimate Vendor Center</title>

    <link rel="stylesheet" href="css/includes.css">

    <link rel="stylesheet" href="css/renewal.css">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

</head>

<body>

<?php include "includes/sidebar.php"; ?>


<main class="vendor-main">

    <?php include "includes/topbar.php"; ?>


    <div class="renewal-content">


        <!-- PAGE HEADER -->

        <div class="renewal-header">

            <div>

                <span class="renewal-eyebrow">
                    AVAILABILITY MANAGEMENT
                </span>

                <h2>Listing Renewals</h2>

                <p>
                    Confirm that your products and services are still available
                    so customers can continue to find them on Ultimate.
                </p>

            </div>

        </div>



        <!-- =================================
             PRODUCTS RENEWAL
        ================================== -->

        <section class="renewal-section">


            <div class="section-heading">

                <div class="section-heading-icon">
                    <i class="fa-solid fa-box"></i>
                </div>

                <div>

                    <h3>Products Renewal</h3>

                    <p>
                        Manage availability for your marketplace products.
                    </p>

                </div>

            </div>



            <?php if(empty($products)): ?>


                <div class="renewal-empty">

                    <div class="empty-icon">
                        <i class="fa-solid fa-box-open"></i>
                    </div>

                    <h4>No Current Products</h4>

                    <p>
                        You currently have no products to renew.
                    </p>

                    <a href="products.php" class="renewal-action">

                        <i class="fa-solid fa-plus"></i>

                        Add Product

                    </a>

                </div>


            <?php else: ?>


                <div class="renewal-list">


                    <?php foreach($products as $product): ?>


                        <article class="renewal-card">


                            <div class="renewal-card-image">

                                <img
                                    src="../<?= htmlspecialchars($product['image']); ?>"
                                    alt="<?= htmlspecialchars($product['product_name']); ?>"
                                >

                            </div>



                            <div class="renewal-card-info">

                                <h4>
                                    <?= htmlspecialchars($product['product_name']); ?>
                                </h4>

                                <span class="renewal-price">

                                    ₦<?= number_format($product['price'], 2); ?>

                                </span>


                                <?php if($product['approval_status'] === 'Pending'): ?>


                                    <span class="renewal-status pending">

                                        <i class="fa-solid fa-clock"></i>

                                        Pending Approval

                                    </span>


                                <?php elseif($product['approval_status'] === 'Rejected'): ?>


                                    <span class="renewal-status rejected">

                                        <i class="fa-solid fa-circle-xmark"></i>

                                        Rejected

                                    </span>


                                <?php elseif($product['availability_status'] === 'Unavailable'): ?>


                                    <span class="renewal-status unavailable">

                                        <i class="fa-solid fa-ban"></i>

                                        Unavailable

                                    </span>


                                <?php elseif(empty($product['last_availability_renewal'])): ?>


                                    <span class="renewal-status awaiting">

                                        <i class="fa-solid fa-rotate"></i>

                                        Renewal Required

                                    </span>


                                <?php else: ?>


                                    <span class="renewal-status available">

                                        <i class="fa-solid fa-circle-check"></i>

                                        Available

                                    </span>


                                <?php endif; ?>

                                <?php if(
                                    $product['approval_status'] === 'Approved' &&
                                    $product['availability_status'] === 'Available' &&
                                    !empty($product['availability_renewal_due'])
                                ): ?>

                                    <div class="renewal-countdown"
                                        data-renewal-due="<?= htmlspecialchars($product['availability_renewal_due']); ?>">

                                        <i class="fa-regular fa-clock"></i>

                                        <span>
                                            Renews in <strong class="countdown-time">--:--:--</strong>
                                        </span>

                                    </div>

                                <?php endif; ?>

                            </div>



                            <div class="renewal-card-action">


                                <?php if($product['approval_status'] === 'Approved'): ?>


                                    <form
                                        action="renew-listing.php"
                                        method="POST"
                                    >

                                        <input
                                            type="hidden"
                                            name="type"
                                            value="product"
                                        >

                                        <input
                                            type="hidden"
                                            name="listing_id"
                                            value="<?= $product['id']; ?>"
                                        >

                                        <button
                                            type="submit"
                                            class="renew-btn"
                                        >

                                            <i class="fa-solid fa-rotate"></i>

                                            Renew

                                        </button>

                                    </form>


                                <?php elseif($product['approval_status'] === 'Pending'): ?>


                                    <span class="action-note">
                                        Awaiting admin approval
                                    </span>


                                <?php elseif($product['approval_status'] === 'Rejected'): ?>


                                    <span class="action-note">
                                        Review required
                                    </span>


                                <?php endif; ?>


                            </div>


                        </article>


                    <?php endforeach; ?>


                </div>


            <?php endif; ?>


        </section>




        <!-- =================================
             SERVICES RENEWAL
        ================================== -->

        <section class="renewal-section">


            <div class="section-heading">

                <div class="section-heading-icon">
                    <i class="fa-solid fa-briefcase"></i>
                </div>

                <div>

                    <h3>Services Renewal</h3>

                    <p>
                        Manage availability for your marketplace services.
                    </p>

                </div>

            </div>



            <?php if(empty($services)): ?>


                <div class="renewal-empty">

                    <div class="empty-icon">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>

                    <h4>No Current Services</h4>

                    <p>
                        You currently have no services to renew.
                    </p>

                    <a href="services.php" class="renewal-action">

                        <i class="fa-solid fa-plus"></i>

                        Add Service

                    </a>

                </div>


            <?php else: ?>


                <div class="renewal-list">


                    <?php foreach($services as $service): ?>


                        <article class="renewal-card">


                            <div class="renewal-card-image">

                                <img
                                    src="../<?= htmlspecialchars($service['image']); ?>"
                                    alt="<?= htmlspecialchars($service['service_name']); ?>"
                                >

                            </div>



                            <div class="renewal-card-info">

                                <h4>
                                    <?= htmlspecialchars($service['service_name']); ?>
                                </h4>

                                <span class="renewal-price">

                                    ₦<?= number_format($service['price'], 2); ?>

                                </span>


                                <?php if($service['approval_status'] === 'Pending'): ?>


                                    <span class="renewal-status pending">

                                        <i class="fa-solid fa-clock"></i>

                                        Pending Approval

                                    </span>


                                <?php elseif($service['approval_status'] === 'Rejected'): ?>


                                    <span class="renewal-status rejected">

                                        <i class="fa-solid fa-circle-xmark"></i>

                                        Rejected

                                    </span>


                                <?php elseif($service['availability_status'] === 'Unavailable'): ?>


                                    <span class="renewal-status unavailable">

                                        <i class="fa-solid fa-ban"></i>

                                        Unavailable

                                    </span>


                                <?php elseif(empty($service['last_availability_renewal'])): ?>


                                    <span class="renewal-status awaiting">

                                        <i class="fa-solid fa-rotate"></i>

                                        Renewal Required

                                    </span>


                                <?php else: ?>


                                    <span class="renewal-status available">

                                        <i class="fa-solid fa-circle-check"></i>

                                        Available

                                    </span>


                                <?php endif; ?>

                                <?php if(
                                    $service['approval_status'] === 'Approved' &&
                                    $service['availability_status'] === 'Available' &&
                                    !empty($service['availability_renewal_due'])
                                ): ?>

                                    <div class="renewal-countdown"
                                        data-renewal-due="<?= htmlspecialchars($service['availability_renewal_due']); ?>">

                                        <i class="fa-regular fa-clock"></i>

                                        <span>
                                            Renews in <strong class="countdown-time">--:--:--</strong>
                                        </span>

                                    </div>

                                <?php endif; ?>


                            </div>



                            <div class="renewal-card-action">


                                <?php if($service['approval_status'] === 'Approved'): ?>


                                    <form
                                        action="renew-listing.php"
                                        method="POST"
                                    >

                                        <input
                                            type="hidden"
                                            name="type"
                                            value="service"
                                        >

                                        <input
                                            type="hidden"
                                            name="listing_id"
                                            value="<?= $service['id']; ?>"
                                        >

                                        <button
                                            type="submit"
                                            class="renew-btn"
                                        >

                                            <i class="fa-solid fa-rotate"></i>

                                            Renew

                                        </button>

                                    </form>


                                <?php elseif($service['approval_status'] === 'Pending'): ?>


                                    <span class="action-note">
                                        Awaiting admin approval
                                    </span>


                                <?php elseif($service['approval_status'] === 'Rejected'): ?>


                                    <span class="action-note">
                                        Review required
                                    </span>


                                <?php endif; ?>


                            </div>


                        </article>


                    <?php endforeach; ?>


                </div>


            <?php endif; ?>


        </section>


    </div>


    <?php include "includes/footer.php"; ?>


</main>


<script src="js/renewal.js"></script>

</body>

</html>

