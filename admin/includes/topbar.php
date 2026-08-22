
<?php

/*
========================================
        ADMIN TOPBAR
========================================*/


$pageTitle = $pageTitle ?? "Dashboard";

$pageDescription = $pageDescription ?? "Manage your Ultimate marketplace";

$adminName = $_SESSION["admin_name"] ?? "Administrator";

$adminEmail = $_SESSION["admin_email"] ?? "";

?>


<!-- ========================================
        TOPBAR
======================================== -->

<header class="admin-topbar">


    <!-- ====================================
            LEFT SIDE
    ===================================== -->

    <div class="topbar-left">


        <!-- MOBILE MENU BUTTON -->

        <button
            type="button"
            class="mobile-menu-button"
            id="mobileMenuButton"
            aria-label="Open navigation"
        >

            <i class="fa-solid fa-bars"></i>

        </button>



        <!-- PAGE INFORMATION -->

        <div class="page-heading">


            <div class="page-breadcrumb">

                <span>

                    Ultimate

                </span>


                <i class="fa-solid fa-chevron-right"></i>


                <span class="current-breadcrumb">

                    <?= htmlspecialchars($pageTitle); ?>

                </span>

            </div>


            <h1>

                <?= htmlspecialchars($pageTitle); ?>

            </h1>


            <p>

                <?= htmlspecialchars($pageDescription); ?>

            </p>


        </div>


    </div>



    <!-- ====================================
            RIGHT SIDE
    ===================================== -->

    <div class="topbar-right">


        <!-- SEARCH -->

        <div class="topbar-search">


            <i class="fa-solid fa-magnifying-glass"></i>


            <input
                type="search"
                id="adminSearch"
                placeholder="Search..."
                autocomplete="off"
            >


            <span class="search-shortcut">

                /

            </span>


        </div>



        <!-- NOTIFICATIONS -->

        <button
            type="button"
            class="topbar-action"
            id="notificationButton"
            aria-label="Notifications"
        >

            <i class="fa-regular fa-bell"></i>


            <span class="notification-indicator"></span>

        </button>



        <!-- DIVIDER -->

        <span class="topbar-divider"></span>



        <!-- ADMIN PROFILE -->

        <button
            type="button"
            class="topbar-profile"
            id="profileButton"
        >


            <div class="topbar-avatar">

                <?= strtoupper(
                    substr(
                        htmlspecialchars($adminName),
                        0,
                        1
                    )
                ); ?>

            </div>


            <div class="topbar-profile-info">


                <strong>

                    <?= htmlspecialchars($adminName); ?>

                </strong>


                <span>

                    Administrator

                </span>


            </div>


            <i class="fa-solid fa-chevron-down profile-chevron"></i>


        </button>



        <!-- =================================
                PROFILE DROPDOWN
        ================================== -->

        <div
            class="profile-dropdown"
            id="profileDropdown"
        >


            <!-- PROFILE HEADER -->

            <div class="dropdown-profile-header">


                <div class="dropdown-avatar">

                    <?= strtoupper(
                        substr(
                            htmlspecialchars($adminName),
                            0,
                            1
                        )
                    ); ?>

                </div>


                <div>

                    <strong>

                        <?= htmlspecialchars($adminName); ?>

                    </strong>


                    <span>

                        <?= htmlspecialchars($adminEmail); ?>

                    </span>

                </div>


            </div>



            <div class="dropdown-divider"></div>



            <!-- PROFILE -->

            <a
                href="profile.php"
                class="dropdown-item"
            >

                <span class="dropdown-item-icon">

                    <i class="fa-regular fa-user"></i>

                </span>


                <span>

                    My Profile

                </span>

            </a>



            <!-- SETTINGS -->

            <a
                href="settings.php"
                class="dropdown-item"
            >

                <span class="dropdown-item-icon">

                    <i class="fa-solid fa-gear"></i>

                </span>


                <span>

                    Settings

                </span>

            </a>



            <div class="dropdown-divider"></div>



            <!-- LOGOUT -->

            <a
                href="logout.php"
                class="dropdown-item dropdown-logout"
            >

                <span class="dropdown-item-icon">

                    <i class="fa-solid fa-right-from-bracket"></i>

                </span>


                <span>

                    Logout

                </span>

            </a>


        </div>


    </div>


</header>

