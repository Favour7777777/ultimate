<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>

<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$vendorApproved = false;

if(isset($_SESSION["user_id"])){

    require_once "config.php";

    $user_id = $_SESSION["user_id"];

    $vendorQuery = "
        SELECT status
        FROM vendors
        WHERE user_id = ?
        LIMIT 1
    ";

    $stmt = mysqli_prepare($conn, $vendorQuery);

    mysqli_stmt_bind_param($stmt, "i", $user_id);

    mysqli_stmt_execute($stmt);

    $vendorResult = mysqli_stmt_get_result($stmt);

    if($vendorResult && $vendor = mysqli_fetch_assoc($vendorResult)){

        if($vendor["status"] === "Approved"){
            $vendorApproved = true;
        }

    }

    mysqli_stmt_close($stmt);
}
?>


<!-- NAVBAR -->

<nav class="navbar">

<div class="logo">

Ultimate

</div>

<ul class="nav-links">

<li><a href="#">Home</a></li>

<li><a href="view-categories.php">Categories</a></li>

<li><a href="#">Services</a></li>

<li>

    <?php if($vendorApproved): ?>

        <a href="vendor-dashboard-entry.php">
            Vendor Dashboard
        </a>

    <?php else: ?>

        <a href="become-vendor.php">
            Vendor login/signup
        </a>

    <?php endif; ?>

</li>

<li><a href="#">Support</a></li>

<li>
    <?php if(isset($_SESSION["user_id"])): ?>

        <a href="user/dashboard.php">
            Dashboard
        </a>

    <?php else: ?>

        <a href="login.php?return_to=user/dashboard.php">
            Dashboard
        </a>

    <?php endif; ?>
</li>

<li><a href="signup.php">Sign Up</a></li>



</ul>

<div class="menu-btn">

<i class="fa-solid fa-bars"></i>

</div>

</nav>

<!-- MOBILE MENU -->

<div class="mobile-menu">

<a href="#">Home</a>
<a href="view-categories.php">Categories</a>
<a href="#">Services</a>
<li>

    <?php if($vendorApproved): ?>

        <a href="vendor-dashboard-entry.php">
            Vendor Dashboard
        </a>

    <?php else: ?>

        <a href="become-vendor.php">
            Vendor login/signup
        </a>

    <?php endif; ?>

</li>
<a href="#">Support</a>
<a href="<?= isset($_SESSION["user_id"])
    ? 'user/dashboard.php'
    : 'login.php?return_to=user/dashboard.php'
?>">
    Dashboard
</a>
<a href="login.php">Sign In</a>

</div>

    <!-- <script src="main.js"></script> -->

