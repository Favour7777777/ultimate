<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
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

<li><a href="#">Sell</a></li>

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
<a href="#">Sell</a>
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

