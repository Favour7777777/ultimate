
<?php

require_once "../config.php";

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin Login | Ultimate Marketplace</title>


    <!-- GOOGLE FONT -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >


    <!-- FONT AWESOME -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >


    <!-- LOGIN CSS -->

    <link
        rel="stylesheet"
        href="assets/css/login.css"
    >

</head>


<body>


    <!-- ==================================
            LOGIN PAGE
    ================================== -->

    <main class="login-page">


        <!-- ==================================
                LEFT PANEL
        ================================== -->

        <section class="login-left">


            <!-- BRAND -->

            <div class="brand">


                <div class="brand-logo">

                    <i class="fa-solid fa-crown"></i>

                </div>


                <h1>

                    Ultimate

                </h1>


                <p>

                    Marketplace Administration

                </p>


            </div>



            <!-- ADMIN INTRO -->

            <div class="admin-text">


                <h2>

                    Welcome Back,
                    Administrator

                </h2>


                <p>

                    Manage products, services, vendors,
                    customers, orders and the entire
                    Ultimate ecosystem from one
                    premium dashboard.

                </p>


            </div>



            <!-- FEATURES -->

            <div class="features">


                <div>

                    <i class="fa-solid fa-shield-halved"></i>

                    <span>

                        Secure Access

                    </span>

                </div>


                <div>

                    <i class="fa-solid fa-chart-line"></i>

                    <span>

                        Marketplace Analytics

                    </span>

                </div>


                <div>

                    <i class="fa-solid fa-store"></i>

                    <span>

                        Seller Management

                    </span>

                </div>


            </div>


        </section>



        <!-- ==================================
                RIGHT PANEL
        ================================== -->

        <section class="login-right">


            <div class="login-card">


                <!-- LOGIN HEADING -->

                <div class="login-heading">


                    <span class="login-label">

                        ADMIN PORTAL

                    </span>


                    <h2>

                        Admin Login

                    </h2>


                    <p>

                        Sign in to continue.

                    </p>


                </div>



                <!-- LOGIN FORM -->

                <form
                    action="login-process.php"
                    method="POST"
                >


                    <!-- EMAIL -->

                    <div class="input-group">


                        <i class="fa-solid fa-envelope"></i>


                        <input
                            type="email"
                            name="email"
                            placeholder="Admin Email"
                            autocomplete="email"
                            required
                        >


                    </div>



                    <!-- PASSWORD -->

                    <div class="input-group">


                        <i class="fa-solid fa-lock"></i>


                        <input
                            type="password"
                            name="password"
                            placeholder="Password"
                            autocomplete="current-password"
                            required
                        >


                    </div>



                    <!-- LOGIN BUTTON -->

                    <button
                        type="submit"
                        class="login-btn"
                    >

                        Login

                    </button>


                </form>


            </div>


        </section>


    </main>


</body>

</html>

