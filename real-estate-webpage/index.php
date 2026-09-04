<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ultimate Estate</title>

    <link rel="stylesheet" href="css/estate.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>

    <!-- ================= NAVBAR ================= -->

    <header class="estate-navbar">

        <div class="estate-logo">
            <span>ULTIMATE</span>
            <small>ESTATE</small>
        </div>

        <nav class="estate-nav">

            <a href="#home" class="active">Home</a>
            <a href="#properties">Properties</a>
            <a href="#types">Property Types</a>
            <a href="#locations">Locations</a>
            <a href="#services">Services</a>

        </nav>

        <div class="nav-actions">

            <a href="#contact" class="nav-contact">
                Contact Us
            </a>

            <button class="menu-toggle" id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>

    </header>


    <!-- ================= MOBILE MENU ================= -->

    <div class="mobile-menu" id="mobileMenu">

        <a href="#home">Home</a>
        <a href="#properties">Properties</a>
        <a href="#types">Property Types</a>
        <a href="#locations">Locations</a>
        <a href="#services">Services</a>
        <a href="#contact">Contact Us</a>

    </div>


    <!-- ================= HERO ================= -->

    <main>

        <section class="estate-hero" id="home">

            <div class="hero-overlay"></div>

            <div class="hero-content">

                <p class="hero-label">
                    ULTIMATE ESTATE
                </p>

                <h1>
                    FIND A PLACE
                    <br>
                    <span>WORTH CALLING HOME.</span>
                </h1>

                <p class="hero-description">
                    Discover exceptional homes, refined apartments,
                    premium land and extraordinary spaces curated
                    for the Ultimate lifestyle.
                </p>

                <div class="hero-buttons">

                    <a href="#properties" class="primary-btn">
                        Explore Properties
                    </a>

                    <a href="#types" class="secondary-btn">
                        Browse Categories
                    </a>

                </div>

            </div>


            <!-- HERO STATS -->

            <div class="hero-stats">

                <div>
                    <strong>500+</strong>
                    <span>Properties</span>
                </div>

                <div>
                    <strong>25+</strong>
                    <span>Locations</span>
                </div>

                <div>
                    <strong>100%</strong>
                    <span>Curated</span>
                </div>

            </div>

        </section>


        <!-- ================= SEARCH PANEL ================= -->

        <section class="property-search-wrapper">

            <div class="property-search">

                <div class="search-heading">

                    <span>PROPERTY SEARCH</span>

                    <h2>
                        What are you looking for?
                    </h2>

                </div>


                <div class="search-fields">

                    <div class="search-field">

                        <label>Looking For</label>

                        <select>
                            <option>Buy</option>
                            <option>Rent</option>
                            <option>Short Let</option>
                            <option>Land</option>
                        </select>

                    </div>


                    <div class="search-field">

                        <label>Property Type</label>

                        <select>
                            <option>Any Property</option>
                            <option>Luxury Apartment</option>
                            <option>Duplex</option>
                            <option>Villa</option>
                            <option>Land</option>
                            <option>Commercial</option>
                        </select>

                    </div>


                    <div class="search-field">

                        <label>Location</label>

                        <select>
                            <option>Any Location</option>
                            <option>Lagos</option>
                            <option>Abuja</option>
                            <option>Port Harcourt</option>
                            <option>Ibadan</option>
                        </select>

                    </div>


                    <button class="search-btn">
                        Search Properties
                    </button>

                </div>

            </div>

        </section>


        <!-- ================= FEATURED PROPERTIES ================= -->

        <section class="featured-section" id="properties">

            <div class="section-heading">

                <div>

                    <p class="section-label">
                        THE ULTIMATE COLLECTION
                    </p>

                    <h2>
                        Featured <span>Properties</span>
                    </h2>

                </div>

                <a href="#" class="view-all">
                    View All Properties
                    <span>→</span>
                </a>

            </div>


            <div class="property-showcase">


                <!-- PROPERTY 1 -->

                <article class="property-card property-large">

                    <div class="property-image image-one">

                        <div class="property-tag">
                            FOR SALE
                        </div>

                        <button class="heart-btn">
                            ♡
                        </button>

                        <div class="property-price">
                            ₦850M
                        </div>

                    </div>

                    <div class="property-info">

                        <p class="property-location">
                            Ikoyi, Lagos
                        </p>

                        <h3>
                            The Aurelia Residence
                        </h3>

                        <div class="property-details">

                            <span>5 Beds</span>
                            <span>6 Baths</span>
                            <span>850 sqm</span>

                        </div>

                    </div>

                </article>


                <!-- PROPERTY 2 -->

                <article class="property-card">

                    <div class="property-image image-two">

                        <div class="property-tag">
                            FOR RENT
                        </div>

                        <button class="heart-btn">
                            ♡
                        </button>

                        <div class="property-price">
                            ₦12M / YEAR
                        </div>

                    </div>

                    <div class="property-info">

                        <p class="property-location">
                            Victoria Island, Lagos
                        </p>

                        <h3>
                            Noir Heights
                        </h3>

                        <div class="property-details">

                            <span>4 Beds</span>
                            <span>5 Baths</span>
                            <span>620 sqm</span>

                        </div>

                    </div>

                </article>


                <!-- PROPERTY 3 -->

                <article class="property-card">

                    <div class="property-image image-three">

                        <div class="property-tag">
                            SHORT LET
                        </div>

                        <button class="heart-btn">
                            ♡
                        </button>

                        <div class="property-price">
                            ₦450K / NIGHT
                        </div>

                    </div>

                    <div class="property-info">

                        <p class="property-location">
                            Lekki Phase 1, Lagos
                        </p>

                        <h3>
                            Violet Haven
                        </h3>

                        <div class="property-details">

                            <span>3 Beds</span>
                            <span>4 Baths</span>
                            <span>480 sqm</span>

                        </div>

                    </div>

                </article>

            </div>

        </section>


        <!-- ================= PROPERTY TYPES ================= -->

        <section class="types-section" id="types">

            <div class="types-intro">

                <p class="section-label">
                    EXPLORE ESTATE
                </p>

                <h2>
                    Find Your
                    <br>
                    <span>Perfect Space.</span>
                </h2>

                <p>
                    From sophisticated city apartments to expansive
                    estates and investment land, discover spaces
                    designed around the way you want to live.
                </p>

            </div>


            <div class="types-list">


                <a href="#" class="type-item">

                    <div class="type-number">
                        01
                    </div>

                    <div>

                        <h3>
                            Luxury Apartments
                        </h3>

                        <p>
                            Modern city living
                        </p>

                    </div>

                    <span class="type-arrow">
                        ↗
                    </span>

                </a>


                <a href="#" class="type-item">

                    <div class="type-number">
                        02
                    </div>

                    <div>

                        <h3>
                            Houses & Duplexes
                        </h3>

                        <p>
                            Designed for elevated living
                        </p>

                    </div>

                    <span class="type-arrow">
                        ↗
                    </span>

                </a>


                <a href="#" class="type-item">

                    <div class="type-number">
                        03
                    </div>

                    <div>

                        <h3>
                            Villas & Mansions
                        </h3>

                        <p>
                            Extraordinary private residences
                        </p>

                    </div>

                    <span class="type-arrow">
                        ↗
                    </span>

                </a>


                <a href="#" class="type-item">

                    <div class="type-number">
                        04
                    </div>

                    <div>

                        <h3>
                            Land & Investments
                        </h3>

                        <p>
                            Build your next opportunity
                        </p>

                    </div>

                    <span class="type-arrow">
                        ↗
                    </span>

                </a>


                <a href="#" class="type-item">

                    <div class="type-number">
                        05
                    </div>

                    <div>

                        <h3>
                            Commercial Spaces
                        </h3>

                        <p>
                            Spaces built for business
                        </p>

                    </div>

                    <span class="type-arrow">
                        ↗
                    </span>

                </a>

            </div>

        </section>


        <!-- ================= ESTATE PHILOSOPHY ================= -->

        <section class="estate-statement">

            <div class="statement-glow"></div>

            <p>
                ULTIMATE ESTATE
            </p>

            <h2>
                WHERE
                <span>LOCATION</span>
                MEETS
                <span>LIFESTYLE.</span>
            </h2>

        </section>


    </main>


    <!-- ================= FOOTER ================= -->

    <footer class="estate-footer">

        <div class="footer-brand">

            <div class="estate-logo">
                <span>ULTIMATE</span>
                <small>ESTATE</small>
            </div>

            <p>
                Exceptional spaces.
                Extraordinary living.
            </p>

        </div>


        <div class="footer-column">

            <h4>Explore</h4>

            <a href="#">Properties</a>
            <a href="#">Apartments</a>
            <a href="#">Houses</a>
            <a href="#">Land</a>

        </div>


        <div class="footer-column">

            <h4>Ultimate</h4>

            <a href="#">About Us</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
            <a href="#">Become a Partner</a>

        </div>


        <div class="footer-column">

            <h4>Connect</h4>

            <a href="#">Instagram</a>
            <a href="#">Facebook</a>
            <a href="#">WhatsApp</a>
            <a href="#">Email Us</a>

        </div>


        <div class="footer-bottom">

            <span>
                © 2026 Ultimate Estate
            </span>

            <span>
                Part of the Ultimate Marketplace
            </span>

        </div>

    </footer>


    <script src="js/estate.js"></script>

</body>

</html>