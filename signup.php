<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Join Ultimate</title>

    <link rel="stylesheet" href="signup.css">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

</head>

<body>

    <main class="signup-page">

        <!-- =========================================
                    BACKGROUND EFFECTS
        ========================================== -->

        <div class="background-grid"></div>

        <div class="glow glow-one"></div>
        <div class="glow glow-two"></div>
        <div class="glow glow-three"></div>


        <!-- =========================================
                    LEFT BRANDING SIDE
        ========================================== -->

        <section class="signup-intro">

            <a href="index.php" class="ultimate-logo">
                <span>U</span>ltimate
            </a>

            <div class="intro-content">

                <span class="eyebrow">
                    YOUR WORLD. YOUR FUTURE.
                </span>

                <h1>
                    Welcome to
                    <strong>Ultimate.</strong>
                </h1>

                <p>
                    One account opens the door to a world of products,
                    services, opportunities, communities and experiences
                    built around you.
                </p>

                <div class="intro-features">

                    <div class="intro-feature">
                        <div class="feature-icon">
                            <i class="fa-solid fa-bolt"></i>
                        </div>

                        <div>
                            <h3>Discover</h3>
                            <p>Find products and services made for you.</p>
                        </div>
                    </div>


                    <div class="intro-feature">
                        <div class="feature-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>

                        <div>
                            <h3>Connect</h3>
                            <p>Meet people, creators and trusted providers.</p>
                        </div>
                    </div>


                    <div class="intro-feature">
                        <div class="feature-icon">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>

                        <div>
                            <h3>Experience</h3>
                            <p>Everything you need, brought together.</p>
                        </div>
                    </div>

                </div>

            </div>

            <div class="intro-footer">
                <span>© 2026 Ultimate</span>
                <span>Built for everything.</span>
            </div>

        </section>


        <!-- =========================================
                    SIGNUP SIDE
        ========================================== -->

        <section class="signup-side">

            <div class="signup-card">

                <div class="mobile-logo">
                    <a href="index.php">
                        <span>U</span>ltimate
                    </a>
                </div>


                <div class="form-header">

                    <span class="form-label">
                        CREATE YOUR ACCOUNT
                    </span>

                    <h2>
                        Begin your
                        <span>Ultimate</span>
                        journey.
                    </h2>

                    <p>
                        Create your account and step into everything
                        Ultimate has to offer.
                    </p>

                </div>


                <!-- =========================================
                            SIGNUP FORM
                ========================================== -->

                <form action="#" method="POST" class="signup-form">

                    <div class="form-row">

                        <div class="input-group">

                            <label for="fullname">
                                Full Name
                            </label>

                            <div class="input-wrapper">

                                <i class="fa-regular fa-user"></i>

                                <input
                                    type="text"
                                    id="fullname"
                                    name="fullname"
                                    placeholder="Enter your full name"
                                    autocomplete="name"
                                    required
                                >

                            </div>

                        </div>


                        <div class="input-group">

                            <label for="phone">
                                Phone Number
                            </label>

                            <div class="input-wrapper">

                                <i class="fa-solid fa-phone"></i>

                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone_number"
                                    placeholder="Enter your phone number"
                                    autocomplete="tel"
                                    required
                                >

                            </div>

                        </div>

                    </div>


                    <div class="input-group">

                        <label for="email">
                            Email Address
                        </label>

                        <div class="input-wrapper">

                            <i class="fa-regular fa-envelope"></i>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="Enter your email address"
                                autocomplete="email"
                                required
                            >

                        </div>

                    </div>


                    <div class="input-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="input-wrapper">

                            <i class="fa-solid fa-lock"></i>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Create a strong password"
                                autocomplete="new-password"
                                required
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                id="passwordToggle"
                                aria-label="Show password"
                            >
                                <i class="fa-regular fa-eye"></i>
                            </button>

                        </div>

                        <div class="password-strength">

                            <div class="strength-bars">

                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>

                            </div>

                            <small id="strengthText">
                                Use 8 or more characters
                            </small>

                        </div>

                    </div>


                    <div class="terms-row">

                        <label class="checkbox-wrapper">

                            <input
                                type="checkbox"
                                name="terms"
                                required
                            >

                            <span class="custom-checkbox">
                                <i class="fa-solid fa-check"></i>
                            </span>

                            <span class="terms-text">
                                I agree to the
                                <a href="#">Terms</a>
                                and
                                <a href="#">Privacy Policy</a>
                            </span>

                        </label>

                    </div>


                    <button type="submit" class="signup-btn">

                        <span>Create My Account</span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </button>


                    <div class="divider">
                        <span>OR</span>
                    </div>


                    <p class="login-link">

                        Already part of Ultimate?

                        <a href="login.php">
                            Sign in
                        </a>

                    </p>

                </form>

            </div>

        </section>

    </main>


    <script src="signup.js"></script>

</body>
</html>