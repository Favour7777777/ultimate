<?php
require_once "../auth.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard | Ultimate</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<link rel="stylesheet" href="css/dashboard.css">

<style>


</style>

</head>
<body>

<div class="dashboard">

    <!-- SIDEBAR -->
    <?php include "includes/sidebar.php"; ?>

    <div class="main">

        <!-- TOPBAR -->
    <?php include "includes/topbar.php"; ?>

        <div class="content">

            <!-- WELCOME -->

            <section class="welcome">

                <div>

                    <h1>
                        Welcome,
                        <?php echo htmlspecialchars($_SESSION["user_name"]); ?> 👋
                    </h1>

                    <p>
                        Manage your profile, reviews, bookings, saved products and
                        everything across Ultimate from one beautiful dashboard.
                    </p>

                </div>

                <div class="avatar">
                    <i class="fa-solid fa-user"></i>
                </div>

            </section>

            <!-- STATS -->

            <div class="stats">

                <div class="card">
                    <i class="fa-solid fa-star"></i>
                    <h2>0</h2>
                    <span>Reviews Given</span>
                </div>

                <div class="card">
                    <i class="fa-solid fa-heart"></i>
                    <h2>0</h2>
                    <span>Saved Items</span>
                </div>

                <div class="card">
                    <i class="fa-solid fa-calendar-check"></i>
                    <h2>0</h2>
                    <span>Bookings</span>
                </div>

                <div class="card">
                    <i class="fa-solid fa-box"></i>
                    <h2>0</h2>
                    <span>Orders</span>
                </div>

            </div>

            <!-- QUICK ACTIONS -->

            <h2 class="section-title">Quick Actions</h2>

            <div class="actions">
                <a href="reviews.php">
                    <div class="action-box">
                    <i class="fa-solid fa-star-half-stroke"></i>
                    <h3>Leave Review</h3>
                    <p>Share your experience with Ultimate.</p>
                </div>

                </a>
                

                <div class="action-box">
                    <i class="fa-solid fa-user-pen"></i>
                    <h3>Edit Profile</h3>
                    <p>Update your personal information.</p>
                </div>

                <div class="action-box">
                    <i class="fa-solid fa-bookmark"></i>
                    <h3>Saved Items</h3>
                    <p>Access products you've saved.</p>
                </div>

                <div class="action-box">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <h3>Recent Activity</h3>
                    <p>Continue where you left off.</p>
                </div>

            </div>

        </div>

        <!-- FOOTER -->
        <?php include "includes/footer.php"; ?>

    </div>

</div>

</body>
</html>