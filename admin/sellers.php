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
   FETCH VENDORS
========================= */

$vendors = [];

$vendorQuery = "
    SELECT
        vendors.id,
        vendors.store_name,
        vendors.store_description,
        vendors.business_email,
        vendors.phone_number,
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

    ORDER BY vendors.created_at DESC
";


$vendorResult = mysqli_query($conn, $vendorQuery);


if($vendorResult){

    while($row = mysqli_fetch_assoc($vendorResult)){

        $vendors[] = $row;

    }

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

    <title>Sellers | Ultimate Admin</title>


    <link
        rel="stylesheet"
        href="assets/css/admin.css"
    >

    <link
        rel="stylesheet"
        href="assets/css/sellers.css"
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


        <!-- PAGE HEADER -->

        <div class="sellers-header">

            <div>

                <span class="sellers-eyebrow">
                    MARKETPLACE MANAGEMENT
                </span>

                <h1>
                    Sellers
                </h1>

                <p>
                    Manage Ultimate vendors, monitor their performance
                    and review their verification status.
                </p>

            </div>


            <div class="seller-total">

                <i class="fa-solid fa-store"></i>

                <div>

                    <strong>
                        <?= count($vendors); ?>
                    </strong>

                    <span>
                        Total Sellers
                    </span>

                </div>

            </div>

        </div>


        <!-- SELLERS TABLE -->

        <div class="sellers-card">


            <div class="sellers-card-header">

                <div>

                    <h2>
                        All Sellers
                    </h2>

                    <p>
                        Vendors registered on Ultimate.
                    </p>

                </div>


                <div class="seller-search">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input
                        type="text"
                        id="sellerSearch"
                        placeholder="Search sellers..."
                    >

                </div>

            </div>


            <?php if(empty($vendors)): ?>


                <div class="sellers-empty">

                    <div class="empty-icon">

                        <i class="fa-solid fa-store-slash"></i>

                    </div>

                    <h3>
                        No Sellers Yet
                    </h3>

                    <p>
                        Approved or pending vendor applications
                        will appear here.
                    </p>

                </div>


            <?php else: ?>


                <div class="sellers-table-wrapper">

                    <table class="sellers-table">


                        <thead>

                            <tr>

                                <th>
                                    Seller
                                </th>

                                <th>
                                    Category
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Verification
                                </th>

                                <th>
                                    Joined
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody id="sellersTableBody">


                        <?php foreach($vendors as $vendor): ?>


                            <tr>


                                <!-- SELLER -->

                                <td>

                                    <div class="seller-info">


                                        <div class="seller-avatar">

                                            <?php if(!empty($vendor["profile_image"])): ?>

                                                <img
                                                    src="../<?= htmlspecialchars($vendor["profile_image"]); ?>"
                                                    alt=""
                                                >

                                            <?php else: ?>

                                                <i class="fa-solid fa-store"></i>

                                            <?php endif; ?>

                                        </div>


                                        <div>

                                            <strong>
                                                <?= htmlspecialchars($vendor["store_name"]); ?>
                                            </strong>

                                            <span>
                                                <?= htmlspecialchars($vendor["fullname"]); ?>
                                            </span>

                                        </div>


                                    </div>

                                </td>


                                <!-- CATEGORY -->

                                <td>

                                    <span class="seller-category">

                                        <?= htmlspecialchars($vendor["category_name"]); ?>

                                    </span>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    <?php if($vendor["status"] === "Approved"): ?>

                                        <span class="seller-status approved">

                                            <i class="fa-solid fa-circle-check"></i>

                                            Approved

                                        </span>

                                    <?php elseif($vendor["status"] === "Pending"): ?>

                                        <span class="seller-status pending">

                                            <i class="fa-solid fa-clock"></i>

                                            Pending

                                        </span>

                                    <?php elseif($vendor["status"] === "Rejected"): ?>

                                        <span class="seller-status rejected">

                                            <i class="fa-solid fa-circle-xmark"></i>

                                            Rejected

                                        </span>

                                    <?php elseif($vendor["status"] === "Suspended"): ?>

                                        <span class="seller-status suspended">

                                            <i class="fa-solid fa-ban"></i>

                                            Suspended

                                        </span>

                                    <?php else: ?>

                                        <span class="seller-status dormant">

                                            <i class="fa-solid fa-moon"></i>

                                            Dormant

                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- VERIFICATION -->

                                <td>

                                    <?php if((int)$vendor["is_verified"] === 1): ?>

                                        <span class="verification-status verified">

                                            <i class="fa-solid fa-shield-check"></i>

                                            Verified

                                        </span>

                                    <?php else: ?>

                                        <span class="verification-status unverified">

                                            <i class="fa-solid fa-shield"></i>

                                            Not Verified

                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- JOINED -->

                                <td>

                                    <span class="seller-date">

                                        <?= date("M d, Y", strtotime($vendor["created_at"])); ?>

                                    </span>

                                </td>


                                <!-- ACTION -->

                                <td>

                                    <a
                                        href="seller-details.php?id=<?= $vendor["id"]; ?>"
                                        class="seller-action"
                                    >

                                        View

                                        <i class="fa-solid fa-arrow-right"></i>

                                    </a>

                                </td>


                            </tr>


                        <?php endforeach; ?>


                        </tbody>

                    </table>

                </div>


            <?php endif; ?>


        </div>


    </section>


    <?php include "includes/footer.php"; ?>


</main>


<script>

const searchInput = document.getElementById("sellerSearch");

const rows = document.querySelectorAll("#sellersTableBody tr");


if(searchInput){

    searchInput.addEventListener("input", function(){

        const searchValue = this.value.toLowerCase();


        rows.forEach(function(row){

            const text = row.textContent.toLowerCase();

            row.style.display =
                text.includes(searchValue)
                ? ""
                : "none";

        });

    });

}

</script>


</body>

</html>