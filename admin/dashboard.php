
<?php

session_start();


/*
=========================================================
    ADMIN ACCESS PROTECTION
=========================================================
*/

if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");

    exit();

}


/*
=========================================================
    PAGE INFORMATION
=========================================================
*/

$currentPage = "dashboard";

$pageTitle = "Dashboard";

$pageDescription = "Overview of your Ultimate marketplace";


/*
=========================================================
    ADMIN INFORMATION
=========================================================
*/

$adminName = $_SESSION["admin_name"] ?? "Administrator";

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

        Dashboard | Ultimate Admin

    </title>


    <!-- =========================================
         GOOGLE FONT
    ========================================== -->

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >


    <!-- =========================================
         FONT AWESOME
    ========================================== -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >


    <!-- =========================================
         SHARED ADMIN CSS
    ========================================== -->

    <link
        rel="stylesheet"
        href="assets/css/admin.css"
    >


    <!-- =========================================
         DASHBOARD CSS
    ========================================== -->

    <style>

        /* ========================================
           DASHBOARD CONTENT
        ======================================== */

        .dashboard-content{

            padding:30px;

            flex:1;

        }


        /* ========================================
           WELCOME SECTION
        ======================================== */

        .dashboard-welcome{

            margin-bottom:27px;

        }


        .dashboard-welcome h2{

            font-size:18px;

            font-weight:500;

            color:#eee7f2;

        }


        .dashboard-welcome h2 span{

            color:#b57bdd;

        }


        .dashboard-welcome p{

            margin-top:4px;

            font-size:10px;

            color:#776d7d;

        }


        /* ========================================
           STATISTICS
        ======================================== */

        .stats-grid{

            display:grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap:16px;

            margin-bottom:27px;

        }


        .stat-card{

            position:relative;

            min-height:145px;

            padding:20px;

            overflow:hidden;

            border:1px solid rgba(255,255,255,0.06);

            border-radius:16px;

            background:
                linear-gradient(
                    145deg,
                    rgba(29,23,35,0.90),
                    rgba(15,13,18,0.94)
                );

            box-shadow:
                0 12px 35px rgba(0,0,0,0.18);

            transition:
                transform 0.25s ease,
                border-color 0.25s ease;

        }


        .stat-card:hover{

            transform:translateY(-3px);

            border-color:
                rgba(171,107,220,0.18);

        }


        .stat-card::after{

            content:"";

            position:absolute;

            width:120px;

            height:120px;

            right:-55px;

            bottom:-65px;

            border-radius:50%;

            background:
                rgba(145,76,190,0.09);

            filter:blur(18px);

        }


        .stat-top{

            display:flex;

            align-items:center;

            justify-content:space-between;

            margin-bottom:20px;

        }


        .stat-icon{

            width:40px;

            height:40px;

            display:flex;

            align-items:center;

            justify-content:center;

            border-radius:11px;

            background:
                rgba(164,102,210,0.11);

            color:#b77cdf;

            font-size:14px;

        }


        .stat-menu{

            color:#625969;

            font-size:12px;

        }


        .stat-label{

            font-size:9px;

            color:#7d7182;

        }


        .stat-value{

            margin-top:4px;

            font-size:23px;

            line-height:1.1;

            font-weight:600;

            color:#f2ebf5;

        }


        .stat-change{

            position:absolute;

            right:20px;

            bottom:20px;

            display:flex;

            align-items:center;

            gap:4px;

            font-size:8px;

            color:#78c98b;

        }


        .stat-change i{

            font-size:7px;

        }


        /* ========================================
           DASHBOARD GRID
        ======================================== */

        .dashboard-grid{

            display:grid;

            grid-template-columns:
                minmax(0, 1.6fr)
                minmax(280px, 0.9fr);

            gap:17px;

        }


        /* ========================================
           DASHBOARD CARD
        ======================================== */

        .dashboard-card{

            border:1px solid rgba(255,255,255,0.06);

            border-radius:16px;

            background:
                linear-gradient(
                    145deg,
                    rgba(27,22,32,0.92),
                    rgba(14,12,17,0.95)
                );

            overflow:hidden;

        }


        .dashboard-card-header{

            min-height:68px;

            padding:16px 19px;

            display:flex;

            align-items:center;

            justify-content:space-between;

            gap:15px;

            border-bottom:1px solid rgba(255,255,255,0.05);

        }


        .card-heading h3{

            font-size:12px;

            font-weight:500;

            color:#eee6f1;

        }


        .card-heading p{

            margin-top:3px;

            font-size:8px;

            color:#706575;

        }


        .view-all{

            font-size:8px;

            color:#a66bce;

            transition:0.2s ease;

        }


        .view-all:hover{

            color:#d09aea;

        }


        /* ========================================
           ACTIVITY
        ======================================== */

        .activity-list{

            padding:4px 19px;

        }


        .activity-item{

            min-height:63px;

            display:flex;

            align-items:center;

            gap:11px;

            border-bottom:1px solid rgba(255,255,255,0.045);

        }


        .activity-item:last-child{

            border-bottom:0;

        }


        .activity-icon{

            width:33px;

            height:33px;

            flex-shrink:0;

            display:flex;

            align-items:center;

            justify-content:center;

            border-radius:9px;

            background:rgba(164,102,210,0.09);

            color:#aa70d0;

            font-size:10px;

        }


        .activity-info{

            min-width:0;

            flex:1;

        }


        .activity-info strong{

            display:block;

            font-size:9px;

            font-weight:500;

            color:#cfc4d4;

        }


        .activity-info span{

            display:block;

            margin-top:2px;

            font-size:8px;

            color:#6f6473;

        }


        .activity-time{

            flex-shrink:0;

            font-size:7px;

            color:#5e5363;

        }


        /* ========================================
           QUICK ACTIONS
        ======================================== */

        .quick-actions{

            padding:17px;

            display:grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap:9px;

        }


        .quick-action{

            min-height:82px;

            padding:13px;

            display:flex;

            flex-direction:column;

            justify-content:center;

            gap:8px;

            border:1px solid rgba(255,255,255,0.05);

            border-radius:12px;

            background:rgba(255,255,255,0.025);

            color:#8c808f;

            transition:0.25s ease;

        }


        .quick-action:hover{

            border-color:
                rgba(171,107,220,0.20);

            background:
                rgba(155,93,202,0.07);

            color:#e2d7e6;

            transform:translateY(-2px);

        }


        .quick-action i{

            width:27px;

            height:27px;

            display:flex;

            align-items:center;

            justify-content:center;

            border-radius:8px;

            background:rgba(166,104,213,0.10);

            color:#b87bdd;

            font-size:10px;

        }


        .quick-action span{

            font-size:8px;

        }


        /* ========================================
           RESPONSIVE
        ======================================== */

        @media(max-width:1100px){

            .stats-grid{

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

            }

        }


        @media(max-width:800px){

            .dashboard-content{

                padding:22px 18px;

            }


            .dashboard-grid{

                grid-template-columns:1fr;

            }

        }


        @media(max-width:500px){

            .dashboard-content{

                padding:18px 14px;

            }


            .stats-grid{

                grid-template-columns:1fr;

            }


            .stat-card{

                min-height:130px;

            }


            .quick-actions{

                grid-template-columns:1fr 1fr;

            }

        }


    </style>


</head>


<body>


    <!-- ========================================
         SIDEBAR
    ========================================= -->

    <?php include "includes/sidebar.php"; ?>



    <!-- ========================================
         MAIN ADMIN AREA
    ========================================= -->

    <main class="admin-main">


        <!-- =====================================
             TOPBAR
        ====================================== -->

        <?php include "includes/topbar.php"; ?>



        <!-- =====================================
             DASHBOARD CONTENT
        ====================================== -->

        <section class="dashboard-content">


            <!-- =================================
                 WELCOME
            ================================== -->

            <div class="dashboard-welcome">


                <h2>

                    Welcome back,

                    <span>

                        <?= htmlspecialchars($adminName); ?>

                    </span>

                </h2>


                <p>

                    Here's what's happening across your marketplace today.

                </p>


            </div>



            <!-- =================================
                 STATISTICS
            ================================== -->

            <div class="stats-grid">


                <!-- USERS -->

                <div class="stat-card">


                    <div class="stat-top">


                        <div class="stat-icon">

                            <i class="fa-solid fa-users"></i>

                        </div>


                        <span class="stat-menu">

                            <i class="fa-solid fa-ellipsis"></i>

                        </span>


                    </div>


                    <span class="stat-label">

                        Total Customers

                    </span>


                    <div class="stat-value">

                        0

                    </div>


                    <span class="stat-change">

                        <i class="fa-solid fa-arrow-up"></i>

                        0%

                    </span>


                </div>



                <!-- PRODUCTS -->

                <div class="stat-card">


                    <div class="stat-top">


                        <div class="stat-icon">

                            <i class="fa-solid fa-box"></i>

                        </div>


                        <span class="stat-menu">

                            <i class="fa-solid fa-ellipsis"></i>

                        </span>


                    </div>


                    <span class="stat-label">

                        Total Products

                    </span>


                    <div class="stat-value">

                        0

                    </div>


                    <span class="stat-change">

                        <i class="fa-solid fa-arrow-up"></i>

                        0%

                    </span>


                </div>



                <!-- SELLERS -->

                <div class="stat-card">


                    <div class="stat-top">


                        <div class="stat-icon">

                            <i class="fa-solid fa-store"></i>

                        </div>


                        <span class="stat-menu">

                            <i class="fa-solid fa-ellipsis"></i>

                        </span>


                    </div>


                    <span class="stat-label">

                        Active Sellers

                    </span>


                    <div class="stat-value">

                        0

                    </div>


                    <span class="stat-change">

                        <i class="fa-solid fa-arrow-up"></i>

                        0%

                    </span>


                </div>



                <!-- ORDERS -->

                <div class="stat-card">


                    <div class="stat-top">


                        <div class="stat-icon">

                            <i class="fa-solid fa-bag-shopping"></i>

                        </div>


                        <span class="stat-menu">

                            <i class="fa-solid fa-ellipsis"></i>

                        </span>


                    </div>


                    <span class="stat-label">

                        Total Orders

                    </span>


                    <div class="stat-value">

                        0

                    </div>


                    <span class="stat-change">

                        <i class="fa-solid fa-arrow-up"></i>

                        0%

                    </span>


                </div>


            </div>



            <!-- =================================
                 LOWER DASHBOARD
            ================================== -->

            <div class="dashboard-grid">


                <!-- =================================
                     RECENT ACTIVITY
                ================================== -->

                <div class="dashboard-card">


                    <div class="dashboard-card-header">


                        <div class="card-heading">

                            <h3>

                                Recent Activity

                            </h3>


                            <p>

                                Latest activity across the marketplace

                            </p>

                        </div>


                        <a
                            href="orders.php"
                            class="view-all"
                        >

                            View all

                        </a>


                    </div>



                    <div class="activity-list">


                        <!-- ACTIVITY 1 -->

                        <div class="activity-item">


                            <div class="activity-icon">

                                <i class="fa-solid fa-user-plus"></i>

                            </div>


                            <div class="activity-info">

                                <strong>

                                    No recent activity

                                </strong>


                                <span>

                                    New marketplace activity will appear here.

                                </span>

                            </div>


                            <span class="activity-time">

                                —

                            </span>


                        </div>


                        <!-- ACTIVITY 2 -->

                        <div class="activity-item">


                            <div class="activity-icon">

                                <i class="fa-solid fa-box"></i>

                            </div>


                            <div class="activity-info">

                                <strong>

                                    Products

                                </strong>


                                <span>

                                    Product activity will appear here.

                                </span>

                            </div>


                            <span class="activity-time">

                                —

                            </span>


                        </div>


                        <!-- ACTIVITY 3 -->

                        <div class="activity-item">


                            <div class="activity-icon">

                                <i class="fa-solid fa-store"></i>

                            </div>


                            <div class="activity-info">

                                <strong>

                                    Sellers

                                </strong>


                                <span>

                                    Seller activity will appear here.

                                </span>

                            </div>


                            <span class="activity-time">

                                —

                            </span>


                        </div>


                    </div>


                </div>



                <!-- =================================
                     QUICK ACTIONS
                ================================== -->

                <div class="dashboard-card">


                    <div class="dashboard-card-header">


                        <div class="card-heading">

                            <h3>

                                Quick Actions

                            </h3>


                            <p>

                                Frequently used tools

                            </p>

                        </div>


                    </div>



                    <div class="quick-actions">


                        <a
                            href="products.php"
                            class="quick-action"
                        >

                            <i class="fa-solid fa-plus"></i>

                            <span>

                                Add Product

                            </span>

                        </a>



                        <a
                            href="categories.php"
                            class="quick-action"
                        >

                            <i class="fa-solid fa-layer-group"></i>

                            <span>

                                Categories

                            </span>

                        </a>



                        <a
                            href="sellers.php"
                            class="quick-action"
                        >

                            <i class="fa-solid fa-store"></i>

                            <span>

                                Sellers

                            </span>

                        </a>



                        <a
                            href="customers.php"
                            class="quick-action"
                        >

                            <i class="fa-solid fa-users"></i>

                            <span>

                                Customers

                            </span>

                        </a>


                    </div>


                </div>


            </div>


        </section>



        <!-- =====================================
             FOOTER
        ====================================== -->

        <?php include "includes/footer.php"; ?>


    </main>


</body>

</html>

