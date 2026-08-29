<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ultimate Food</title>
<link rel="stylesheet" href="css/styles.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

<!-- ================= NAVBAR ================= -->

<header class="navbar">

    <div class="logo">
        Ultimate
    </div>

    <nav class="desktop-menu">

        <a href="#">Home</a>
        <a href="#">Restaurants</a>
        <a href="#">Private Chefs</a>
        <a href="#">Catering</a>
        <a href="#">Delivery</a>

    </nav>

    <div class="nav-right">

        <button class="signin">
            Sign In
        </button>

        <button class="menu-toggle" id="menuToggle">
            ☰
        </button>

    </div>

</header>


<!-- ================= MOBILE MENU ================= -->

<div class="mobile-menu" id="mobileMenu">

    <button class="mobile-close" id="mobileClose">
        &times;
    </button>

    <a href="#">Home</a>
    <a href="#">Restaurants</a>
    <a href="#">Private Chefs</a>
    <a href="#">Catering</a>
    <a href="#">Delivery</a>

    <button class="mobile-signin">
        Sign In
    </button>

</div>


<!-- ================= HERO ================= -->

<section class="hero">

    <div class="hero-content">

        <span class="hero-tag">
            ULTIMATE FOOD
        </span>

        <h1>
            Every Meal.
            Every Chef.
            Every Celebration.
        </h1>

        <p>
            Order from premium restaurants, hire private chefs,
            book buffet services, discover talented home cooks
            and enjoy luxury food experiences across Nigeria.
        </p>

        <div class="hero-search">

            <input
                type="text"
                placeholder="Search meals, restaurants or chefs...">

            <button>
                Explore
            </button>

        </div>

        <div class="hero-buttons">

            <a href="#" class="primary-btn">
                Order Food
            </a>

            <a href="#" class="secondary-btn">
                Hire a Chef
            </a>

        </div>

    </div>


    <!-- Floating Cards -->

    <div class="hero-visual">

        <div class="main-food-card">

            <img src="images/food-hero.jpg" alt="Food">

            <div class="food-info">

                <h3>Chef's Signature</h3>

                <span>4.9 ★ Premium Dining</span>

            </div>

        </div>


        <div class="floating-card card-one">

            <h4>🚚 Delivery</h4>

            <p>18 mins</p>

        </div>


        <div class="floating-card card-two">

            <h4>👨‍🍳 Private Chef</h4>

            <p>Available Today</p>

        </div>


        <div class="floating-card card-three">

            <h4>🎉 Buffet</h4>

            <p>120+ Guests</p>

        </div>

    </div>

</section>

<!-- =========================================
     BATCH 2
     3D CUISINE RING
========================================= -->

<section class="cuisine-section">

    <div class="cuisine-heading">

        <span>EXPLORE CUISINES</span>

        <h2>
            One marketplace.
            <em>Every craving.</em>
        </h2>

        <p>
            From authentic Nigerian meals to continental dining,
            discover restaurants, chefs and catering services for every occasion.
        </p>

    </div>


    <div class="cuisine-wrapper">

        <button class="ring-arrow" id="prevCuisine">&#10094;</button>

        <div class="cuisine-ring" id="cuisineRing">

            <div class="cuisine-item active">
                <img src="images/cuisine-nigerian.jpg" alt="">
                <h4>Nigerian</h4>
            </div>

            <div class="cuisine-item">
                <img src="images/cuisine-pizza.jpg" alt="">
                <h4>Pizza</h4>
            </div>

            <div class="cuisine-item">
                <img src="images/cuisine-chinese.jpg" alt="">
                <h4>Chinese</h4>
            </div>

            <div class="cuisine-item">
                <img src="images/cuisine-dessert.jpg" alt="">
                <h4>Desserts</h4>
            </div>

            <div class="cuisine-item">
                <img src="images/cuisine-drinks.jpg" alt="">
                <h4>Drinks</h4>
            </div>

            <div class="cuisine-item">
                <img src="images/cuisine-buffet.jpg" alt="">
                <h4>Buffet</h4>
            </div>

        </div>

        <button class="ring-arrow" id="nextCuisine">&#10095;</button>

    </div>


    <div class="featured-cuisine">

        <span id="cuisineTag">FEATURED CUISINE</span>

        <h3 id="cuisineTitle">Nigerian Cuisine</h3>

        <p id="cuisineDesc">
            Rich local flavours, smoky grills, delicious soups,
            rice dishes and premium Nigerian dining experiences.
        </p>

        <a href="#" class="discover-btn">
            Discover Restaurants →
        </a>

    </div>

</section>

<!-- =========================================
     BATCH 3
     RESTAURANT SPOTLIGHT STAGE
========================================= -->

<section class="spotlight-section">

    <div class="spotlight-header">

        <span>FEATURED RESTAURANTS</span>

        <h2>
            Dine somewhere
            <em>extraordinary.</em>
        </h2>

        <p>
            Discover premium restaurants, luxury lounges and hidden gems
            delivering unforgettable dining experiences.
        </p>

    </div>


    <div class="spotlight-stage">

        <button class="spotlight-arrow left" id="restaurantPrev">
            &#10094;
        </button>


        <div class="restaurant-slider" id="restaurantSlider">

            <!-- CARD 1 -->

            <div class="restaurant-card">

                <img src="images/rest-1.jpg" alt="">

                <div class="restaurant-overlay">

                    <div class="restaurant-top">
                        <span>4.9 ★</span>
                        <span>18 mins</span>
                    </div>

                    <h3>Velvet Grill</h3>

                    <p>Premium Nigerian • Victoria Island</p>

                </div>

            </div>


            <!-- CARD 2 -->

            <div class="restaurant-card">

                <img src="images/rest-2.jpg" alt="">

                <div class="restaurant-overlay">

                    <div class="restaurant-top">
                        <span>4.8 ★</span>
                        <span>24 mins</span>
                    </div>

                    <h3>Maison Rouge</h3>

                    <p>Continental Fine Dining</p>

                </div>

            </div>


            <!-- CARD 3 -->

            <div class="restaurant-card">

                <img src="images/rest-3.jpg" alt="">

                <div class="restaurant-overlay">

                    <div class="restaurant-top">
                        <span>4.9 ★</span>
                        <span>20 mins</span>
                    </div>

                    <h3>Dragon Wok</h3>

                    <p>Chinese Signature Kitchen</p>

                </div>

            </div>


            <!-- CARD 4 -->

            <div class="restaurant-card">

                <img src="images/rest-4.jpg" alt="">

                <div class="restaurant-overlay">

                    <div class="restaurant-top">
                        <span>5.0 ★</span>
                        <span>30 mins</span>
                    </div>

                    <h3>Amore Pizza</h3>

                    <p>Wood Fired Italian Pizza</p>

                </div>

            </div>

        </div>


        <button class="spotlight-arrow right" id="restaurantNext">
            &#10095;
        </button>

    </div>


    <!-- FEATURE PANEL -->

    <div class="restaurant-panel">

        <div class="panel-left">

            <span class="panel-tag">
                RESTAURANT OF THE WEEK
            </span>

            <h3 id="panelName">
                Velvet Grill
            </h3>

            <p id="panelDesc">
                An award-winning luxury restaurant serving elevated Nigerian cuisine with
                handcrafted cocktails and an unforgettable atmosphere.
            </p>

        </div>


        <div class="panel-right">

            <div>
                <h4 id="panelCuisine">Nigerian</h4>
                <span>Cuisine</span>
            </div>

            <div>
                <h4 id="panelDelivery">18 mins</h4>
                <span>Delivery</span>
            </div>

            <div>
                <h4 id="panelRating">4.9</h4>
                <span>Rating</span>
            </div>

        </div>

    </div>

</section>

<!-- =========================================
     BATCH 4
     EDITORIAL CHEF GALLERY
========================================= -->

<section class="chef-gallery">

    <div class="chef-heading">

        <span>PRIVATE CHEFS & HOME COOKS</span>

        <h2>
            Bring the
            <em>restaurant home.</em>
        </h2>

        <p>
            Hire luxury private chefs, talented home cooks and culinary
            professionals for intimate dinners, family meals and exclusive events.
        </p>

    </div>


    <div class="chef-stage">


        <!-- LEFT PORTRAIT -->

        <div class="chef-side left">

            <img
                id="leftChefImage"
                src="images/chef-2.jpg"
                alt="Chef">

        </div>


        <!-- CENTER FEATURED -->

        <div class="chef-feature">

            <img
                id="mainChefImage"
                src="images/chef-1.jpg"
                alt="Featured Chef">


            <div class="booking-card">

                <span class="chef-badge">
                    AVAILABLE TODAY
                </span>

                <h3 id="chefName">
                    Chef Amara
                </h3>

                <p id="chefRole">
                    Luxury Private Chef
                </p>

                <div class="chef-stats">

                    <div>
                        <strong id="chefRating">
                            4.9
                        </strong>

                        <span>Rating</span>
                    </div>

                    <div>
                        <strong id="chefEvents">
                            240+
                        </strong>

                        <span>Events</span>
                    </div>

                    <div>
                        <strong id="chefPrice">
                            ₦85k
                        </strong>

                        <span>From</span>
                    </div>

                </div>

                <button class="book-chef">
                    Book This Chef
                </button>

            </div>

        </div>


        <!-- RIGHT PORTRAIT -->

        <div class="chef-side right">

            <img
                id="rightChefImage"
                src="images/chef-3.jpg"
                alt="Chef">

        </div>

    </div>


    <!-- SPECIALTIES -->

    <div class="chef-specialties">

        <button class="chef-btn active" data-chef="0">
            Amara
        </button>

        <button class="chef-btn" data-chef="1">
            Kemi
        </button>

        <button class="chef-btn" data-chef="2">
            Daniel
        </button>

        <button class="chef-btn" data-chef="3">
            Zara
        </button>

    </div>


    <!-- INFO PANEL -->

    <div class="chef-info-panel">

        <div>

            <span>CHEF SPECIALTIES</span>

            <h3 id="chefCuisine">
                Fine Nigerian Dining
            </h3>

        </div>

        <p id="chefDescription">
            Award-winning chef specializing in luxury Nigerian cuisine,
            private dinners and celebrity events.
        </p>

    </div>

</section>

<!-- =========================================
     BATCH 5
     INTERACTIVE BUFFET TABLESCAPE
========================================= -->

<section class="buffet-section">

    <div class="buffet-heading">

        <span>BUFFET & CATERING</span>

        <h2>
            Every celebration deserves an unforgettable
            <em>table.</em>
        </h2>

        <p>
            From weddings and birthdays to corporate banquets and outdoor parties,
            discover premium catering experiences across Ultimate.
        </p>

    </div>


    <div class="buffet-stage">

        <img src="images/buffet-wedding.jpg"
             alt="Luxury Catering"
             id="buffetImage">


        <!-- HOTSPOTS -->

        <button class="hotspot active"
                data-service="0"
                style="top:28%; left:22%;">
            +
        </button>

        <button class="hotspot"
                data-service="1"
                style="top:42%; left:72%;">
            +
        </button>

        <button class="hotspot"
                data-service="2"
                style="top:65%; left:34%;">
            +
        </button>

        <button class="hotspot"
                data-service="3"
                style="top:58%; left:82%;">
            +
        </button>


        <div class="service-label" id="serviceLabel">
            💍 Wedding Catering
        </div>

    </div>


    <div class="buffet-panel">

        <div class="panel-title">

            <span id="serviceTag">
                EVENT SERVICE
            </span>

            <h3 id="serviceTitle">
                Luxury Wedding Buffet
            </h3>

        </div>


        <p id="serviceDescription">
            Elegant buffet experiences with gourmet meals, live chefs,
            dessert stations and premium guest service for weddings.
        </p>


        <div class="panel-stats">

            <div>
                <strong id="guestCount">300+</strong>
                <span>Guests</span>
            </div>

            <div>
                <strong id="startingPrice">₦450k</strong>
                <span>Starting From</span>
            </div>

            <div>
                <strong id="prepTime">48 hrs</strong>
                <span>Preparation</span>
            </div>

        </div>


        <button class="panel-book">
            Book Catering Service
        </button>

    </div>

</section>

<!-- =========================================
     BATCH 6
     FOOD DELIVERY NETWORK
========================================= -->

<section class="delivery-network">

    <div class="delivery-header">

        <span>FOOD DELIVERY NETWORK</span>

        <h2>
            Fast delivery,
            <em>beautifully tracked.</em>
        </h2>

        <p>
            Restaurants, chefs and caterers are connected through Ultimate's
            premium delivery network, giving customers speed, reliability and
            real-time order visibility.
        </p>

    </div>


    <div class="network-container">

        <!-- MAP -->

        <div class="city-map">

            <div class="road road-one"></div>
            <div class="road road-two"></div>
            <div class="road road-three"></div>

            <!-- LOCATIONS -->

            <div class="map-point restaurant">
                🍽
                <span>Restaurant</span>
            </div>

            <div class="map-point chef">
                👨‍🍳
                <span>Private Chef</span>
            </div>

            <div class="map-point hub">
                📦
                <span>Delivery Hub</span>
            </div>

            <div class="map-point customer" id="destinationPoint">

                <span id="destinationIcon">🏠</span>

                <span id="destinationLabel">Customer</span>

            </div>

            <!-- MOVING RIDER -->

            <div class="delivery-rider" id="deliveryRider">
                🛵
            </div>

        </div>


        <!-- LIVE PANEL -->

        <div class="delivery-panel">

            <span class="live-tag">
                ● LIVE TRACKING
            </span>

            <h3 id="deliveryTitle">
                Express Bike Delivery
            </h3>

            <p id="deliveryDescription">
                Perfect for meals within the city. Average arrival time is
                under 25 minutes with insulated food carriers.
            </p>

            <div class="delivery-metrics">

                <div>
                    <strong id="deliveryTime">22 mins</strong>
                    <span>ETA</span>
                </div>

                <div>
                    <strong id="deliveryCost">₦1,500</strong>
                    <span>Delivery Fee</span>
                </div>

                <div>
                    <strong id="deliverySpeed">Fastest</strong>
                    <span>Priority</span>
                </div>

            </div>


            <div class="delivery-options">

                <button class="delivery-btn active" data-mode="0">
                    Bike
                </button>

                <button class="delivery-btn" data-mode="1">
                    Car
                </button>

                <button class="delivery-btn" data-mode="2">
                    Van
                </button>

                <button class="delivery-btn" data-mode="3">
                    Catering
                </button>

            </div>

        </div>

    </div>

</section>

<!-- =========================================
     BATCH 7
     TRUST ORBIT
========================================= -->

<section class="trust-orbit">

    <div class="orbit-heading">

        <span>WHY ULTIMATE FOOD</span>

        <h2>
            Built on trust,
            <em>served with excellence.</em>
        </h2>

        <p>
            Every restaurant, chef and catering vendor is verified before joining
            Ultimate, giving customers confidence with every booking.
        </p>

    </div>


    <div class="orbit-stage">

        <!-- CENTER -->

        <div class="orbit-core">

            <div class="core-ring"></div>

            <div class="core-circle">

                <h3>Ultimate</h3>
                <span>Food</span>

            </div>

        </div>


        <!-- ORBITING ITEMS -->

        <div class="orbit-item active" data-index="0">
            ✓
        </div>

        <div class="orbit-item" data-index="1">
            ★
        </div>

        <div class="orbit-item" data-index="2">
            🛡
        </div>

        <div class="orbit-item" data-index="3">
            ⚡
        </div>

    </div>


    <!-- INFO PANEL -->

    <div class="orbit-panel">

        <span id="orbitTag">
            VERIFIED VENDORS
        </span>

        <h3 id="orbitTitle">
            Every vendor is carefully verified.
        </h3>

        <p id="orbitDesc">
            Restaurants, chefs and catering professionals undergo identity and quality verification before appearing on Ultimate.
        </p>

    </div>

</section>

<!-- =========================================
     BATCH 8
     LUXURY CTA
========================================= -->

<section class="food-cta">

    <img src="images/cta-food.jpg" alt="Luxury Dining">

    <div class="cta-overlay"></div>

    <div class="cta-content">

        <span>ULTIMATE FOOD</span>

        <h2>
            Every unforgettable meal begins with one decision.
        </h2>

        <p>
            Order from premium restaurants, hire exceptional chefs,
            book luxury catering and enjoy food experiences designed
            for every celebration.
        </p>

        <div class="cta-buttons">

            <a href="#" class="cta-primary">
                Order Your Next Meal
            </a>

            <a href="#" class="cta-secondary">
                Become a Food Vendor
            </a>

        </div>

    </div>

</section>


<!-- =========================================
     PREMIUM FOOTER
========================================= -->

<footer class="food-footer">

    <div class="footer-grid">

        <!-- BRAND -->

        <div class="footer-brand">

            <h2>Ultimate</h2>

            <p>
                The luxury marketplace connecting customers with trusted
                restaurants, chefs, catering services and unforgettable
                experiences across Nigeria.
            </p>

            <div class="footer-socials">

                <a href="#">Fb</a>
                <a href="#">Ig</a>
                <a href="#">X</a>
                <a href="#">In</a>

            </div>

        </div>


        <!-- FOOD -->

        <div>

            <h3>Food</h3>

            <ul>

                <li><a href="#">Restaurants</a></li>
                <li><a href="#">Private Chefs</a></li>
                <li><a href="#">Catering</a></li>
                <li><a href="#">Delivery</a></li>

            </ul>

        </div>


        <!-- COMPANY -->

        <div>

            <h3>Company</h3>

            <ul>

                <li><a href="#">About</a></li>
                <li><a href="#">Become Vendor</a></li>
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
            Crafted with Luxury • Lagos
        </span>

    </div>

</footer>

<script src="js/main.js"></script>

</body>
</html>