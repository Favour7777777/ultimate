<header class="vendor-topbar">

    <!-- MOBILE MENU BUTTON -->
    <button class="mobile-menu-btn" id="mobileMenuBtn">
        <i class="fa-solid fa-bars"></i>
    </button>


    <!-- PAGE TITLE -->
    <div class="topbar-title">

        <span class="topbar-eyebrow">
            ULTIMATE VENDOR CENTER
        </span>

        <h1>
            <?= ucfirst($currentPage ?? 'Dashboard'); ?>
        </h1>

    </div>


    <!-- TOPBAR RIGHT -->
    <div class="topbar-right">


        <!-- NOTIFICATIONS -->
        <button class="topbar-icon-btn notification-btn">

            <i class="fa-regular fa-bell"></i>

            <span class="notification-dot"></span>

        </button>


        <!-- VENDOR PROFILE -->
        <div class="topbar-profile">

            <div class="topbar-avatar">
                <i class="fa-solid fa-store"></i>
            </div>


            <div class="topbar-profile-info">

                <strong>
                    Vendor Store
                </strong>

                <span>
                    Vendor Account
                </span>

            </div>


            <i class="fa-solid fa-chevron-down profile-arrow"></i>

        </div>

    </div>

</header>