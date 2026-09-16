
<aside class="vendor-sidebar">

    <!-- LOGO -->
    <div class="sidebar-logo">

        <a href="dashboard.php">
            <span class="logo-main">ULTIMATE</span>
            <span class="logo-sub">VENDOR CENTER</span>
        </a>

    </div>


    <!-- VENDOR PROFILE -->
    <div class="vendor-mini-profile">

        <div class="vendor-avatar">
            <i class="fa-solid fa-store"></i>
        </div>

        <div class="vendor-profile-info">

            <strong>
                Vendor Store
            </strong>

            <?php if(isset($vendorTrust) && $vendorTrust === "verified"): ?>

                <span class="verified-badge">
                    <i class="fa-solid fa-circle-check"></i>
                    Verified Seller
                </span>

            <?php else: ?>

                <span class="pending-badge">
                    <i class="fa-solid fa-clock"></i>
                    New Vendor
                </span>

            <?php endif; ?>

        </div>

    </div>


    <!-- NAVIGATION -->
    <nav class="vendor-nav">

        <p class="nav-section-title">
            MAIN MENU
        </p>


        <a
            href="dashboard.php"
            class="nav-link <?= ($currentPage === 'dashboard') ? 'active' : ''; ?>"
        >

            <i class="fa-solid fa-grid-2"></i>

            <span>Dashboard</span>

        </a>


        <a
            href="products.php"
            class="nav-link <?= ($currentPage === 'products') ? 'active' : ''; ?>"
        >

            <i class="fa-solid fa-box"></i>

            <span>My Products</span>

        </a>


        <a
            href="services.php"
            class="nav-link <?= ($currentPage === 'services') ? 'active' : ''; ?>"
        >

            <i class="fa-solid fa-briefcase"></i>

            <span>My Services</span>

        </a>

        <a
            href="renewal.php"
            class="nav-link <?= ($currentPage === 'renewal') ? 'active' : ''; ?>"
        >

            <i class="fa-solid fa-briefcase"></i>

            <span>Renewal</span>

        </a>


        <a
            href="orders.php"
            class="nav-link <?= ($currentPage === 'orders') ? 'active' : ''; ?>"
        >

            <i class="fa-solid fa-cart-shopping"></i>

            <span>Orders</span>

            <span class="nav-count">
                0
            </span>

        </a>



        <p class="nav-section-title">
            STORE
        </p>


        <a
            href="store-profile.php"
            class="nav-link <?= ($currentPage === 'store-profile') ? 'active' : ''; ?>"
        >

            <i class="fa-solid fa-store"></i>

            <span>Store Profile</span>

        </a>


        <a
            href="reviews.php"
            class="nav-link <?= ($currentPage === 'reviews') ? 'active' : ''; ?>"
        >

            <i class="fa-solid fa-star"></i>

            <span>Reviews</span>

        </a>


        <a
            href="earnings.php"
            class="nav-link <?= ($currentPage === 'earnings') ? 'active' : ''; ?>"
        >

            <i class="fa-solid fa-naira-sign"></i>

            <span>Earnings</span>

        </a>



        <p class="nav-section-title">
            ACCOUNT
        </p>


        <a
            href="settings.php"
            class="nav-link <?= ($currentPage === 'settings') ? 'active' : ''; ?>"
        >

            <i class="fa-solid fa-gear"></i>

            <span>Settings</span>

        </a>


        <a href="logout.php" class="nav-link logout-link">

            <i class="fa-solid fa-right-from-bracket"></i>

            <span>Logout</span>

        </a>

    </nav>


    <!-- SIDEBAR FOOTER -->
    <div class="sidebar-bottom">

        <div class="sidebar-help">

            <div class="help-icon">
                <i class="fa-solid fa-circle-question"></i>
            </div>

            <div>

                <strong>
                    Need Help?
                </strong>

                <span>
                    Contact Ultimate Support
                </span>

            </div>

        </div>

    </div>

</aside>
