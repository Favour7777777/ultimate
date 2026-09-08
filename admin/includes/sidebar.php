
<?php


$adminName = $_SESSION["admin_name"] ?? "Administrator";

$adminEmail = $_SESSION["admin_email"] ?? "";

?>


<!-- ========================================
        SIDEBAR
======================================== -->

<aside class="sidebar" id="adminSidebar">


    <!-- ====================================
            SIDEBAR HEADER
    ===================================== -->

    <div class="sidebar-header">


        <a
            href="dashboard.php"
            class="sidebar-brand"
        >


            <div class="brand-icon">

                <i class="fa-solid fa-crown"></i>

            </div>


            <div class="brand-text">

                <h2>

                    Ultimate

                </h2>

                <span>

                    Control Center

                </span>

            </div>


        </a>


        <!-- MOBILE CLOSE BUTTON -->

        <button
            type="button"
            class="sidebar-close"
            id="sidebarClose"
            aria-label="Close navigation"
        >

            <i class="fa-solid fa-xmark"></i>

        </button>


    </div>



    <!-- ====================================
            ADMIN PROFILE
    ===================================== -->

    <div class="sidebar-profile">


        <div class="sidebar-avatar">

            <?= strtoupper(
                substr(
                    htmlspecialchars($adminName),
                    0,
                    1
                )
            ); ?>

        </div>


        <div class="sidebar-profile-info">

            <strong>

                <?= htmlspecialchars($adminName); ?>

            </strong>


            <span>

                Administrator

            </span>

        </div>


        <span class="online-indicator"></span>


    </div>



    <!-- ====================================
            NAVIGATION
    ===================================== -->

    <nav class="sidebar-navigation">


        <!-- =================================
                MAIN
        ================================== -->

        <div class="navigation-section">


            <span class="navigation-title">

                MAIN

            </span>


            <a
                href="dashboard.php"
                class="navigation-item <?= ($currentPage === 'dashboard') ? 'active' : ''; ?>"
            >

                <span class="navigation-icon">

                    <i class="fa-solid fa-grid-2"></i>

                </span>


                <span class="navigation-text">

                    Dashboard

                </span>


            </a>


        </div>



        <!-- =================================
                MARKETPLACE
        ================================== -->

        <div class="navigation-section">


            <span class="navigation-title">

                MARKETPLACE

            </span>


            <a
                href="products.php"
                class="navigation-item <?= ($currentPage === 'Products') ? 'active' : ''; ?>"
            >

                <span class="navigation-icon">

                    <i class="fa-solid fa-box"></i>

                </span>


                <span class="navigation-text">

                    Products

                </span>

            </a>


            



            <a
                href="categories.php"
                class="navigation-item <?= ($currentPage === 'categories') ? 'active' : ''; ?>"
            >

                <span class="navigation-icon">

                    <i class="fa-solid fa-layer-group"></i>

                </span>


                <span class="navigation-text">

                    Categories

                </span>

            </a>

            

            <a
                href="services.php"
                class="navigation-item <?= ($currentPage === 'services') ? 'active' : ''; ?>"
            >

                <span class="navigation-icon">

                    <i class="fa-solid fa-calendar-check"></i>

                </span>


                <span class="navigation-text">

                    Services

                </span>

            </a>



            <a
                href="sellers.php"
                class="navigation-item <?= ($currentPage === 'sellers') ? 'active' : ''; ?>"
            >

                <span class="navigation-icon">

                    <i class="fa-solid fa-store"></i>

                </span>


                <span class="navigation-text">

                    Sellers

                </span>

            </a>


        </div>



        <!-- =================================
                MANAGEMENT
        ================================== -->

        <div class="navigation-section">


            <span class="navigation-title">

                MANAGEMENT

            </span>


            <a
                href="customers.php"
                class="navigation-item <?= ($currentPage === 'customers') ? 'active' : ''; ?>"
            >

                <span class="navigation-icon">

                    <i class="fa-solid fa-users"></i>

                </span>


                <span class="navigation-text">

                    Customers

                </span>

            </a>



            <a
                href="orders.php"
                class="navigation-item <?= ($currentPage === 'orders') ? 'active' : ''; ?>"
            >

                <span class="navigation-icon">

                    <i class="fa-solid fa-bag-shopping"></i>

                </span>


                <span class="navigation-text">

                    Orders

                </span>


                <span class="navigation-count">

                    0

                </span>

            </a>



            <a
                href="payments.php"
                class="navigation-item <?= ($currentPage === 'payments') ? 'active' : ''; ?>"
            >

                <span class="navigation-icon">

                    <i class="fa-solid fa-credit-card"></i>

                </span>


                <span class="navigation-text">

                    Payments

                </span>

            </a>



            <a
                href="reviews.php"
                class="navigation-item <?= ($currentPage === 'reviews') ? 'active' : ''; ?>"
            >

                <span class="navigation-icon">

                    <i class="fa-solid fa-star"></i>

                </span>


                <span class="navigation-text">

                    Reviews

                </span>

            </a>


        </div>



        <!-- =================================
                BUSINESS
        ================================== -->

        <div class="navigation-section">


            <span class="navigation-title">

                BUSINESS

            </span>


            <a
                href="analytics.php"
                class="navigation-item <?= ($currentPage === 'analytics') ? 'active' : ''; ?>"
            >

                <span class="navigation-icon">

                    <i class="fa-solid fa-chart-line"></i>

                </span>


                <span class="navigation-text">

                    Analytics

                </span>

            </a>



            <a
                href="messages.php"
                class="navigation-item <?= ($currentPage === 'messages') ? 'active' : ''; ?>"
            >

                <span class="navigation-icon">

                    <i class="fa-solid fa-message"></i>

                </span>


                <span class="navigation-text">

                    Messages

                </span>


                <span class="navigation-count">

                    0

                </span>

            </a>


        </div>



        <!-- =================================
                SYSTEM
        ================================== -->

        <div class="navigation-section">


            <span class="navigation-title">

                SYSTEM

            </span>


            <a
                href="settings.php"
                class="navigation-item <?= ($currentPage === 'settings') ? 'active' : ''; ?>"
            >

                <span class="navigation-icon">

                    <i class="fa-solid fa-gear"></i>

                </span>


                <span class="navigation-text">

                    Settings

                </span>

            </a>


        </div>


    </nav>



    <!-- ====================================
            SIDEBAR BOTTOM
    ===================================== -->

    <div class="sidebar-bottom">


        <div class="sidebar-upgrade">


            <div class="upgrade-icon">

                <i class="fa-solid fa-gem"></i>

            </div>


            <div class="upgrade-text">

                <strong>

                    Ultimate Premium

                </strong>

                <span>

                    Your marketplace control center

                </span>

            </div>


        </div>



        <a
            href="logout.php"
            class="sidebar-logout"
        >

            <span class="logout-icon">

                <i class="fa-solid fa-right-from-bracket"></i>

            </span>


            <span>

                Logout

            </span>

        </a>


    </div>


</aside>


<!-- ========================================
        MOBILE SIDEBAR OVERLAY
========================================= -->

<div
    class="sidebar-overlay"
    id="sidebarOverlay"
></div>

