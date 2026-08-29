<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ultimate Beauty</title>

    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <!-- ================================
         BEAUTY NAVBAR
    ================================= -->

    <header class="beauty-header">

        <nav class="beauty-navbar">

            <a href="#" class="beauty-logo">
                ULTIMATE<span>.</span>
            </a>

            <!-- Desktop Navigation -->
            <div class="desktop-nav">

                <a href="#">Home</a>
                <a href="#categories">Categories</a>
                <a href="#services">Services</a>
                <a href="#products">Products</a>
                <a href="#vendors">Vendors</a>

            </div>

            <div class="nav-actions">

                <a href="#" class="nav-signin">Sign In</a>

                <a href="#" class="nav-vendor">
                    Become a Vendor
                </a>

            </div>

            <!-- Hamburger -->
            <button class="menu-toggle" id="menuToggle" aria-label="Open menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </nav>

    </header>


    <!-- ================================
         MOBILE MENU
    ================================= -->

    <div class="mobile-menu" id="mobileMenu">

        <button class="mobile-close" id="mobileClose">
            &times;
        </button>

        <a href="#">Home</a>
        <a href="#categories">Categories</a>
        <a href="#services">Services</a>
        <a href="#products">Products</a>
        <a href="#vendors">Vendors</a>

        <div class="mobile-actions">

            <a href="#" class="mobile-signin">
                Sign In
            </a>

            <a href="#" class="mobile-vendor">
                Become a Vendor
            </a>

        </div>

    </div>


    <!-- ================================
         HERO SECTION
    ================================= -->

    <main>

        <section class="beauty-hero">

            <div class="hero-content">

                <div class="hero-label">
                    <span></span>
                    ULTIMATE BEAUTY
                </div>

                <h1>
                    Beauty that
                    <span>speaks</span>
                    before you do.
                </h1>

                <p>
                    Discover trusted salons, makeup artists, spas,
                    skincare experts and premium beauty products —
                    all in one elegant marketplace.
                </p>

                <div class="hero-buttons">

                    <a href="#categories" class="primary-btn">
                        Explore Beauty
                        <span>→</span>
                    </a>

                    <a href="#" class="secondary-btn">
                        Become a Beauty Vendor
                    </a>

                </div>

                <div class="hero-stats">

                    <div class="hero-stat">
                        <strong>4,000+</strong>
                        <span>Beauty Professionals</span>
                    </div>

                    <div class="stat-divider"></div>

                    <div class="hero-stat">
                        <strong>Instant</strong>
                        <span>Booking</span>
                    </div>

                </div>

            </div>


            <!-- Hero Visual -->

            <div class="hero-visual">

                <div class="hero-glow"></div>

                <div class="beauty-image">

                    <img
                        src="images/hero-image.jpg"
                        alt="Beauty professional">

                </div>

                <div class="floating-card card-rating">

                    <div class="rating-icon">
                        ★
                    </div>

                    <div>
                        <strong>4.9/5</strong>
                        <span>Customer Rating</span>
                    </div>

                </div>

                <div class="floating-card card-booking">

                    <div class="booking-dot"></div>

                    <div>
                        <strong>Book with ease</strong>
                        <span>Trusted professionals</span>
                    </div>

                </div>

            </div>

        </section>

        <!-- =================================
     BEAUTY CATEGORIES
================================= -->

<section class="beauty-categories" id="categories">

    <div class="section-heading">

        <div class="section-label">
            <span></span>
            EXPLORE BEAUTY
        </div>

        <h2>
            Find your kind of
            <span>beautiful.</span>
        </h2>

        <p>
            From everyday essentials to luxurious treatments,
            discover everything you need to look and feel your best.
        </p>

    </div>


    <div class="categories-grid">

        <!-- Hair -->

        <a href="#" class="beauty-category-card">

            <img
                src="images/beauty-hair.jpg"
                alt="Hair and braids">

            <div class="category-overlay"></div>

            <div class="category-content">

                <span class="category-number">01</span>

                <h3>Hair & Braids</h3>

                <p>
                    Hair styling, braids, extensions & more.
                </p>

                <span class="category-arrow">→</span>

            </div>

        </a>


        <!-- Makeup -->

        <a href="#" class="beauty-category-card">

            <img
                src="images/beauty-makeup.jpg"
                alt="Makeup">

            <div class="category-overlay"></div>

            <div class="category-content">

                <span class="category-number">02</span>

                <h3>Makeup</h3>

                <p>
                    Glam, bridal, editorial & everyday looks.
                </p>

                <span class="category-arrow">→</span>

            </div>

        </a>


        <!-- Skincare -->

        <a href="#" class="beauty-category-card">

            <img
                src="images/beauty-skincare.jpg"
                alt="Skincare">

            <div class="category-overlay"></div>

            <div class="category-content">

                <span class="category-number">03</span>

                <h3>Skincare</h3>

                <p>
                    Facials, treatments & skincare essentials.
                </p>

                <span class="category-arrow">→</span>

            </div>

        </a>


        <!-- Body Care -->

        <a href="#" class="beauty-category-card">

            <img
                src="images/beauty-bodycare.jpg"
                alt="Body care">

            <div class="category-overlay"></div>

            <div class="category-content">

                <span class="category-number">04</span>

                <h3>Body Care</h3>

                <p>
                    Spa treatments, wellness & body essentials.
                </p>

                <span class="category-arrow">→</span>

            </div>

        </a>


        <!-- Nails -->

        <a href="#" class="beauty-category-card">

            <img
                src="images/beauty-nails.jpg"
                alt="Nail care">

            <div class="category-overlay"></div>

            <div class="category-content">

                <span class="category-number">05</span>

                <h3>Nails</h3>

                <p>
                    Manicures, pedicures & creative nail art.
                </p>

                <span class="category-arrow">→</span>

            </div>

        </a>


        <!-- Fragrance -->

        <a href="#" class="beauty-category-card">

            <img
                src="images/beauty-fragrance.jpg"
                alt="Beauty fragrance">

            <div class="category-overlay"></div>

            <div class="category-content">

                <span class="category-number">06</span>

                <h3>Fragrance</h3>

                <p>
                    Signature scents, perfumes & body mists.
                </p>

                <span class="category-arrow">→</span>

            </div>

        </a>


        <!-- Men's Grooming -->

        <a href="#" class="beauty-category-card">

            <img
                src="images/beauty-grooming.jpg"
                alt="Men's grooming">

            <div class="category-overlay"></div>

            <div class="category-content">

                <span class="category-number">07</span>

                <h3>Men's Grooming</h3>

                <p>
                    Barbers, skincare & grooming essentials.
                </p>

                <span class="category-arrow">→</span>

            </div>

        </a>


        <!-- Products -->

        <a href="#" class="beauty-category-card">

            <img
                src="images/beauty-products.jpg"
                alt="Beauty products">

            <div class="category-overlay"></div>

            <div class="category-content">

                <span class="category-number">08</span>

                <h3>Beauty Products</h3>

                <p>
                    Shop trusted beauty products from vendors.
                </p>

                <span class="category-arrow">→</span>

            </div>

        </a>

    </div>

</section>

<!-- =================================
     FEATURED BEAUTY SERVICES
================================= -->

<section class="featured-services" id="services">

    <div class="services-heading">

        <div class="section-label">
            <span></span>
            FEATURED EXPERIENCES
        </div>

        <h2>
            Beauty experiences
            <span>worth booking.</span>
        </h2>

        <p>
            Discover carefully selected treatments from
            trusted beauty professionals and turn everyday
            self-care into something extraordinary.
        </p>

    </div>


    <!-- ================================
         SERVICE SLIDER
    ================================= -->

    <div class="service-slider">

        <div class="service-slide">

            <img
                src="images/service-facials.jpg"
                alt="Luxury HydraFacial"
                id="serviceImage">


            <div class="service-image-overlay"></div>


            <!-- Top Information -->

            <div class="service-top-info">

                <span class="service-featured">
                    FEATURED
                </span>

                <span class="service-counter">
                    <span id="currentService">01</span>
                    /
                    <span id="totalServices">06</span>
                </span>

            </div>


            <!-- Main Content -->

            <div class="service-content">

                <span
                    class="service-category"
                    id="serviceCategory">
                    SKINCARE
                </span>

                <h3 id="serviceTitle">
                    Luxury
                    <em>HydraFacial</em>
                </h3>

                <p id="serviceDescription">
                    A deep cleansing and hydration experience
                    designed to leave your skin visibly refreshed.
                </p>


                <div class="service-footer">

                    <div class="service-price">

                        <small>
                            Starting from
                        </small>

                        <strong id="servicePrice">
                            ₦25,000
                        </strong>

                    </div>


                    <a href="#" class="book-service">
                        Book this experience

                        <span>↗</span>
                    </a>

                </div>

            </div>

        </div>


        <!-- =================================
             SLIDER CONTROLS
        ================================= -->

        <div class="service-controls">

            <div class="service-progress">

                <div
                    class="service-progress-bar"
                    id="serviceProgress">
                </div>

            </div>


            <div class="service-navigation">

                <button
                    type="button"
                    id="servicePrev"
                    aria-label="Previous service">
                    ←
                </button>

                <button
                    type="button"
                    id="serviceNext"
                    aria-label="Next service">
                    →
                </button>

            </div>

        </div>

    </div>

</section>

<!-- =================================
     BATCH 4
     TOP SALONS & SPAS
================================= -->

<section class="top-salons" id="salons">

    <!-- Section Heading -->

    <div class="salons-heading">

        <div class="section-label">
            <span></span>
            DISCOVER YOUR BEAUTY SPACE
        </div>

        <h2>
            Places where
            <span>beauty lives.</span>
        </h2>

        <p>
            Explore exceptional salons and spas,
            carefully selected for unforgettable
            beauty experiences.
        </p>

    </div>


    <!-- =================================
         FLIP CARDS
    ================================= -->

    <div class="flip-cards-wrapper">


        <!-- =================================
             CARD ONE
        ================================= -->

        <div class="beauty-flip-card">

            <div class="beauty-card-inner">


                <!-- FRONT -->

                <div class="beauty-card-front">

                    <img
                        src="images/salon-aura.jpg"
                        alt="Aura Beauty Lounge">

                    <div class="card-image-overlay"></div>


                    <div class="card-front-top">

                        <span class="card-badge">
                            FEATURED
                        </span>

                        <span class="card-number">
                            01
                        </span>

                    </div>


                    <div class="card-front-content">

                        <span class="card-category">
                            LUXURY SALON
                        </span>

                        <h3>
                            Aura Beauty
                            <em>Lounge</em>
                        </h3>

                        <div class="card-location">
                            <span>⌖</span>
                            Victoria Island, Lagos
                        </div>

                    </div>

                </div>


                <!-- BACK -->

                <div class="beauty-card-back">

                    <div class="back-top">

                        <span>
                            AURA BEAUTY LOUNGE
                        </span>

                        <strong>
                            ★ 4.9
                        </strong>

                    </div>


                    <div class="back-content">

                        <span class="back-label">
                            WHAT THEY OFFER
                        </span>

                        <h3>
                            Your beauty,
                            <em>elevated.</em>
                        </h3>

                        <ul>

                            <li>
                                <span>✦</span>
                                Hair Styling
                            </li>

                            <li>
                                <span>✦</span>
                                Signature Facials
                            </li>

                            <li>
                                <span>✦</span>
                                Nail Art
                            </li>

                            <li>
                                <span>✦</span>
                                Bridal Beauty
                            </li>

                        </ul>

                    </div>


                    <a href="#" class="explore-beauty">

                        Explore salon

                        <span>↗</span>

                    </a>

                </div>

            </div>

        </div>



        <!-- =================================
             CARD TWO
        ================================= -->

        <div class="beauty-flip-card">

            <div class="beauty-card-inner">


                <!-- FRONT -->

                <div class="beauty-card-front">

                    <img
                        src="images/spa-serenity.jpg"
                        alt="Serenity Spa">

                    <div class="card-image-overlay"></div>


                    <div class="card-front-top">

                        <span class="card-badge">
                            WELLNESS
                        </span>

                        <span class="card-number">
                            02
                        </span>

                    </div>


                    <div class="card-front-content">

                        <span class="card-category">
                            PREMIUM SPA
                        </span>

                        <h3>
                            Serenity
                            <em>Spa</em>
                        </h3>

                        <div class="card-location">
                            <span>⌖</span>
                            Ikoyi, Lagos
                        </div>

                    </div>

                </div>


                <!-- BACK -->

                <div class="beauty-card-back">

                    <div class="back-top">

                        <span>
                            SERENITY SPA
                        </span>

                        <strong>
                            ★ 4.8
                        </strong>

                    </div>


                    <div class="back-content">

                        <span class="back-label">
                            WHAT THEY OFFER
                        </span>

                        <h3>
                            Slow down.
                            <em>Feel renewed.</em>
                        </h3>

                        <ul>

                            <li>
                                <span>✦</span>
                                Deep Tissue Massage
                            </li>

                            <li>
                                <span>✦</span>
                                Body Treatments
                            </li>

                            <li>
                                <span>✦</span>
                                Luxury Facials
                            </li>

                            <li>
                                <span>✦</span>
                                Wellness Therapy
                            </li>

                        </ul>

                    </div>


                    <a href="#" class="explore-beauty">

                        Explore spa

                        <span>↗</span>

                    </a>

                </div>

            </div>

        </div>

    </div>



    <!-- =================================
         NAVIGATION
    ================================= -->

    <div class="flip-navigation">

        <button
            type="button"
            id="flipPrevious"
            aria-label="Previous salons">

            ←

        </button>


        <div class="flip-indicator">

            <span id="flipCurrent">
                01
            </span>

            <i></i>

            <span>
                03
            </span>

        </div>


        <button
            type="button"
            id="flipNext"
            aria-label="Next salons">

            →

        </button>

    </div>

</section>

<!-- =================================
     BATCH 5
     MAKEUP ARTISTS & HAIR STYLISTS
================================= -->

<section class="artists-section" id="artists">

    <!-- =================================
         SECTION HEADER
    ================================= -->

    <div class="artists-header">

        <div>

            <span class="artists-eyebrow">
                BEAUTY TALENT
            </span>

            <h2>
                The artists
                <span>behind the look.</span>
            </h2>

        </div>


        <p>
            Discover talented makeup artists and
            hair stylists creating unforgettable
            beauty experiences.
        </p>

    </div>


    <!-- =================================
         ARTIST SHOWCASE
    ================================= -->

    <div class="artist-showcase">


        <!-- IMAGE SIDE -->

        <div class="artist-image-container">

            <img
                id="artistImage"
                src="images/artist-amara.jpg"
                alt="Amara Beauty">

            <div class="artist-image-gradient"></div>


            <div class="artist-image-number">

                <span id="artistNumber">
                    01
                </span>

                <i></i>

                <span>
                    04
                </span>

            </div>


            <div class="artist-category-badge">

                <span id="artistCategory">
                    MAKEUP ARTIST
                </span>

            </div>

        </div>



        <!-- INFORMATION SIDE -->

        <div class="artist-information">


            <div class="artist-small-label">
                FEATURED ARTIST
            </div>


            <div class="artist-name">

                <h3 id="artistName">
                    Amara
                </h3>

                <h4 id="artistNameStyle">
                    Beauty
                </h4>

            </div>


            <p
                class="artist-description"
                id="artistDescription">

                Creating timeless bridal looks,
                editorial glam and effortless
                beauty transformations.

            </p>


            <!-- DETAILS -->

            <div class="artist-details">

                <div class="artist-detail">

                    <span>
                        SPECIALTY
                    </span>

                    <strong id="artistSpecialty">
                        Bridal & Editorial
                    </strong>

                </div>


                <div class="artist-detail">

                    <span>
                        LOCATION
                    </span>

                    <strong id="artistLocation">
                        Victoria Island, Lagos
                    </strong>

                </div>


                <div class="artist-detail">

                    <span>
                        RATING
                    </span>

                    <strong id="artistRating">
                        ★ 4.9
                    </strong>

                </div>

            </div>


            <!-- BUTTON -->

            <a
                href="#"
                class="artist-button">

                View artist profile

                <span>
                    ↗
                </span>

            </a>


        </div>

    </div>


    <!-- =================================
         NAVIGATION
    ================================= -->

    <div class="artists-navigation">

        <button
            type="button"
            id="artistPrevious"
            aria-label="Previous artist">

            ←

        </button>


        <div class="artist-progress">

            <span id="artistProgress">
                01
            </span>

            <div class="progress-line">
                <span id="artistProgressBar"></span>
            </div>

            <span>
                04
            </span>

        </div>


        <button
            type="button"
            id="artistNext"
            aria-label="Next artist">

            →

        </button>

    </div>

</section>

<!-- /* =========================================
   BATCH 6
   BEAUTY PRODUCTS — THE BEAUTY SHELF
========================================= */ -->

<section class="beauty-products" id="beauty-products">

    <!-- SECTION INTRO -->

    <div class="products-intro">

        <span class="products-eyebrow">
            THE BEAUTY SHELF
        </span>

        <h2>
            Curated beauty,
            <em>beautifully.</em>
        </h2>

        <p>
            Discover carefully selected skincare,
            makeup, haircare and beauty essentials
            from trusted brands.
        </p>

    </div>


    <!-- MAIN SHOWCASE -->

    <div class="product-showcase">


        <!-- PRODUCT IMAGE -->

        <div class="product-visual">

            <div class="product-glow"></div>

            <div class="product-orbit orbit-one"></div>

            <div class="product-orbit orbit-two"></div>


            <img
                id="beautyProductImage"
                src="images/essentials.png"
                alt="Lumière Radiance Serum">


            <!-- FLOATING DETAILS -->

            <div class="product-detail detail-one">

                <span></span>

                <strong>
                    HYALURONIC ACID
                </strong>

            </div>


            <div class="product-detail detail-two">

                <span></span>

                <strong>
                    DEEP HYDRATION
                </strong>

            </div>


            <div class="product-detail detail-three">

                <span></span>

                <strong>
                    VEGAN FORMULA
                </strong>

            </div>

        </div>


        <!-- PRODUCT INFORMATION -->

        <div class="product-information">

            <div class="product-top">

                <span id="productCategory">
                    SKINCARE
                </span>

                <span
                    id="productNumber"
                    class="product-number">

                    01 / 05

                </span>

            </div>


            <div class="product-title">

                <h3 id="beautyProductName">
                    Lumière
                </h3>

                <h4 id="beautyProductType">
                    Radiance Serum
                </h4>

            </div>


            <p id="beautyProductDescription">

                A lightweight radiance serum
                designed to deeply hydrate the skin
                while leaving a luminous finish.

            </p>


            <!-- RATING -->

            <div class="product-rating">

                <span>
                    ★★★★★
                </span>

                <strong id="beautyProductRating">
                    4.9
                </strong>

                <small>
                    128 reviews
                </small>

            </div>


            <!-- PRICE -->

            <div class="product-price">

                <span>
                    PRICE
                </span>

                <strong id="beautyProductPrice">
                    ₦38,000
                </strong>

            </div>


            <!-- BUTTON -->

            <a
                href="#"
                class="product-button">

                Discover product

                <span>
                    ↗
                </span>

            </a>

        </div>

    </div>


    <!-- CATEGORY NAVIGATION -->

    <div class="product-categories">

        <button
            class="product-category active"
            data-category="Skincare">

            SKINCARE

        </button>


        <button
            class="product-category"
            data-category="Makeup">

            MAKEUP

        </button>


        <button
            class="product-category"
            data-category="Haircare">

            HAIRCARE

        </button>


        <button
            class="product-category"
            data-category="Fragrance">

            FRAGRANCE

        </button>


        <button
            class="product-category"
            data-category="Body">

            BODY

        </button>

    </div>


    <!-- PRODUCT NAVIGATION -->

    <div class="product-navigation">

        <button
            type="button"
            id="productPrevious"
            aria-label="Previous product">

            ←

        </button>


        <div class="product-progress">

            <span id="productCurrent">
                01
            </span>

            <div>

                <span
                    id="productProgressBar">
                </span>

            </div>

            <span>
                05
            </span>

        </div>


        <button
            type="button"
            id="productNext"
            aria-label="Next product">

            →

        </button>

    </div>

</section>

<!-- =========================================
     BATCH 7
     BEFORE & AFTER TRANSFORMATION
========================================= -->

<section class="transformation-section" id="transformations">

    <div class="transformation-header">

        <div>

            <span class="transformation-eyebrow">
                THE TRANSFORMATION
            </span>

            <h2>
                See the
                <em>difference.</em>
            </h2>

        </div>

        <p>
            Explore real beauty transformations
            created by talented professionals
            across Ultimate.
        </p>

    </div>


    <!-- =====================================
         TRANSFORMATION STAGE
    ====================================== -->

    <div class="transformation-stage">


        <!-- BEFORE -->

        <div class="transformation-side before-side">

            <img
                id="beforeImage"
                src="images/before-1.jpg"
                alt="Before transformation">


            <div class="side-overlay"></div>


            <div class="side-label">

                <span>
                    01
                </span>

                BEFORE

            </div>

        </div>


        <!-- AFTER -->

        <div
            class="transformation-side after-side"
            id="afterSide">

            <img
                id="afterImage"
                src="images/after-1.jpg"
                alt="After transformation">


            <div class="side-overlay"></div>


            <div class="side-label">

                <span>
                    02
                </span>

                AFTER

            </div>

        </div>


        <!-- =================================
             CENTER DIVIDER
        ================================== -->

        <div
            class="comparison-divider"
            id="comparisonDivider">


            <div class="divider-line"></div>


            <button
                type="button"
                class="comparison-handle"
                id="comparisonHandle"
                aria-label="Drag to compare before and after">

                <span>←</span>

                <strong>↔</strong>

                <span>→</span>

            </button>


            <div class="drag-hint">
                DRAG TO COMPARE
            </div>

        </div>


        <!-- =================================
             TRANSFORMATION INFO
        ================================== -->

        <div class="transformation-info">

            <span
                id="transformationCategory">

                BRIDAL MAKEUP

            </span>


            <h3 id="transformationName">

                Soft Glam

            </h3>


            <p id="transformationDescription">

                A refined bridal transformation
                created with soft tones, radiant
                skin and timeless definition.

            </p>


            <div class="transformation-artist">

                <span>
                    CREATED BY
                </span>

                <strong id="transformationArtist">

                    Amara Beauty

                </strong>

            </div>

        </div>

    </div>


    <!-- =====================================
         TRANSFORMATION SELECTOR
    ====================================== -->

    <div class="transformation-selector">


        <button
            class="transformation-option active"
            data-index="0">

            <span>
                01
            </span>

            SOFT GLAM

        </button>


        <button
            class="transformation-option"
            data-index="1">

            <span>
                02
            </span>

            HAIR REVIVAL

        </button>


        <button
            class="transformation-option"
            data-index="2">

            <span>
                03
            </span>

            BRIDAL LOOK

        </button>


        <button
            class="transformation-option"
            data-index="3">

            <span>
                04
            </span>

            SKIN GLOW

        </button>

    </div>

</section>

<!-- =========================================
     BATCH 8
     WHY CHOOSE ULTIMATE BEAUTY
========================================= -->

<section class="beauty-trust">

    <div class="trust-header">

        <span>WHY CHOOSE ULTIMATE</span>

        <h2>
            Luxury beauty begins with
            <em>trust.</em>
        </h2>

        <p>
            Every salon, makeup artist and beauty
            professional is selected to give customers
            a premium and reliable experience.
        </p>

    </div>


    <div class="trust-timeline">

        <div class="timeline-line"></div>


        <div class="trust-point">

            <div class="trust-icon">
                ✓
            </div>

            <h3>Verified</h3>

            <p>
                Trusted salons and certified beauty professionals.
            </p>

        </div>


        <div class="trust-point">

            <div class="trust-icon">
                ★
            </div>

            <h3>Real Reviews</h3>

            <p>
                Genuine customer ratings from completed bookings.
            </p>

        </div>


        <div class="trust-point">

            <div class="trust-icon">
                ⚡
            </div>

            <h3>Instant Booking</h3>

            <p>
                Book appointments within minutes from any device.
            </p>

        </div>


        <div class="trust-point">

            <div class="trust-icon">
                🛡
            </div>

            <h3>Secure Payments</h3>

            <p>
                Safe transactions with complete payment protection.
            </p>

        </div>

    </div>

</section>

<!-- =========================================
     BATCH 9
     CTA
========================================= -->

<section class="beauty-cta">

    <div class="cta-glow"></div>

    <div class="cta-content">

        <span>ULTIMATE BEAUTY</span>

        <h2>
            Your next beauty
            experience starts here.
        </h2>

        <p>
            Discover trusted salons, book talented makeup artists,
            explore premium beauty products and experience luxury —
            all in one marketplace.
        </p>

        <div class="cta-buttons">

            <a href="#" class="cta-primary">
                Explore Beauty
            </a>

            <a href="#" class="cta-secondary">
                Become a Vendor
            </a>

        </div>

    </div>

</section>


<!-- =========================================
     FOOTER
========================================= -->

<footer class="beauty-footer">

    <div class="footer-grid">

        <!-- BRAND -->

        <div class="footer-brand">

            <h2>Ultimate</h2>

            <p>
                Nigeria's luxury marketplace connecting people with
                trusted products, services and unforgettable experiences.
            </p>

            <div class="footer-socials">

                <a href="#">Fb</a>
                <a href="#">Ig</a>
                <a href="#">X</a>
                <a href="#">In</a>

            </div>

        </div>


        <!-- BEAUTY -->

        <div>

            <h3>Beauty</h3>

            <ul>

                <li><a href="#">Salons</a></li>
                <li><a href="#">Makeup Artists</a></li>
                <li><a href="#">Hair Stylists</a></li>
                <li><a href="#">Skincare</a></li>

            </ul>

        </div>


        <!-- COMPANY -->

        <div>

            <h3>Company</h3>

            <ul>

                <li><a href="#">About</a></li>
                <li><a href="#">Vendors</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Contact</a></li>

            </ul>

        </div>


        <!-- SUPPORT -->

        <div>

            <h3>Support</h3>

            <ul>

                <li><a href="#">Help Centre</a></li>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Terms</a></li>
                <li><a href="#">Report Vendor</a></li>

            </ul>

        </div>

    </div>


    <div class="footer-bottom">

        <p>
            © 2026 Ultimate Marketplace. All rights reserved.
        </p>

        <span>
            Designed with Luxury • Lagos
        </span>

    </div>

</footer>



    </main>


    <script src="js/main.js"></script>

</body>

</html>