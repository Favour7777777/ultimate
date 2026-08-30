<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Ultimate Fashion</title>

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

        <a href="#">Women</a>
        <a href="#">Men</a>
        <a href="#">Designers</a>
        <a href="#">Accessories</a>
        <a href="#">Tailors</a>

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

    <a href="#">Women</a>
    <a href="#">Men</a>
    <a href="#">Designers</a>
    <a href="#">Accessories</a>
    <a href="#">Tailors</a>

    <button class="mobile-signin">
        Sign In
    </button>

</div>


<!-- ================= HERO ================= -->

<section class="fashion-hero">

    <div class="hero-left">

        <span class="hero-tag">
            ULTIMATE FASHION
        </span>

        <h1>
            Wear confidence.
            Own the runway.
        </h1>

        <p>
            Discover luxury fashion houses, independent designers,
            bespoke tailors and statement accessories—all within
            one premium marketplace.
        </p>


        <div class="hero-search">

            <input
                type="text"
                placeholder="Search designers, outfits or brands...">

            <button>
                Explore
            </button>

        </div>


        <div class="hero-buttons">

            <a href="#" class="primary-btn">
                Explore Fashion
            </a>

            <a href="#" class="secondary-btn">
                Become a Designer
            </a>

        </div>

    </div>


    <!-- RIGHT VISUAL -->

    <div class="hero-right">

        <div class="main-fashion-card">

            <img src="images/fashion-hero.jpg" alt="Runway Fashion">

            <div class="fashion-glass">

                <span>NEW COLLECTION</span>

                <h3>Midnight Violet</h3>

                <p>Luxury Editorial • 2026</p>

            </div>

        </div>


        <div class="floating-tag top">
            🖤 Haute Couture
        </div>

        <div class="floating-tag middle">
            ✂ Bespoke Tailoring
        </div>

        <div class="floating-tag bottom">
            ✨ Luxury Accessories
        </div>

    </div>

</section>

<!-- =========================================
     BATCH 2
     3D FASHION HOUSES
========================================= -->

<section class="fashion-houses">

    <div class="houses-heading">

        <span>EXPLORE FASHION HOUSES</span>

        <h2>
            Where every style has its
            <em>own world.</em>
        </h2>

        <p>
            Browse luxury collections, bespoke tailoring and statement accessories
            through Ultimate's premium fashion marketplace.
        </p>

    </div>


    <div class="houses-wrapper">

        <button class="house-arrow" id="prevHouse">&#10094;</button>


        <div class="houses-ring" id="housesRing">

            <div class="house-item active">
                <img src="images/house-haute.jpg" alt="">
                <h4>Haute</h4>
            </div>

            <div class="house-item">
                <img src="images/house-men.jpg" alt="">
                <h4>Men</h4>
            </div>

            <div class="house-item">
                <img src="images/house-women.jpg" alt="">
                <h4>Women</h4>
            </div>

            <div class="house-item">
                <img src="images/house-accessories.jpg" alt="">
                <h4>Luxury</h4>
            </div>

            <div class="house-item">
                <img src="images/house-footwear.jpg" alt="">
                <h4>Footwear</h4>
            </div>

            <div class="house-item">
                <img src="images/house-tailor.jpg" alt="">
                <h4>Tailoring</h4>
            </div>

        </div>


        <button class="house-arrow" id="nextHouse">&#10095;</button>

    </div>


    <!-- MAGAZINE REVEAL -->

    <div class="editorial-card">

        <div class="editorial-image">

            <img src="images/house-haute.jpg"
                 id="editorialImage"
                 alt="Fashion House">

        </div>


        <div class="editorial-content">

            <span id="houseTag">
                HAUTE COUTURE
            </span>

            <h3 id="houseTitle">
                Midnight Atelier
            </h3>

            <p id="houseDescription">
                Dramatic silhouettes, handcrafted evening wear and runway couture
                designed for unforgettable entrances.
            </p>


            <div class="editorial-stats">

                <div>
                    <strong id="houseDesigners">42</strong>
                    <span>Designers</span>
                </div>

                <div>
                    <strong id="housePieces">680</strong>
                    <span>Collections</span>
                </div>

                <div>
                    <strong id="houseRating">4.9</strong>
                    <span>Rating</span>
                </div>

            </div>


            <a href="#" class="editorial-btn">
                View Collection →
            </a>

        </div>

    </div>

</section>

<!-- =========================================
     BATCH 3
     RUNWAY CYLINDER
========================================= -->

<section class="runway-section">

    <div class="runway-heading">
        <span>RUNWAY CYLINDER</span>

        <h2>
            The runway never
            <em>stands still.</em>
        </h2>

        <p>
            Explore editorial collections from Ultimate's finest designers.
        </p>
    </div>


    <div class="runway-stage">

        <button class="runway-arrow" id="runwayPrev">&#10094;</button>

        <div class="runway-cylinder">

            <div class="runway-model">
                <img src="images/runway1.jpg">
            </div>

            <div class="runway-model">
                <img src="images/runway2.jpg">
            </div>

            <div class="runway-model">
                <img src="images/runway3.jpg">
            </div>

            <div class="runway-model">
                <img src="images/runway4.jpg">
            </div>

        </div>

        <button class="runway-arrow" id="runwayNext">&#10095;</button>

    </div>


    <div class="collection-panel">

        <span id="collectionTag">
            HAUTE COUTURE
        </span>

        <h3 id="collectionName">
            Midnight Eclipse
        </h3>

        <p id="collectionDesc">
            Sculpted silhouettes inspired by modern luxury and timeless elegance.
        </p>

        <div class="collection-meta">

            <div>
                <strong id="pieces">42</strong>
                <span>Looks</span>
            </div>

            <div>
                <strong id="designer">Amina Cole</strong>
                <span>Designer</span>
            </div>

            <div>
                <strong id="season">FW26</strong>
                <span>Season</span>
            </div>

        </div>

        <a href="#" class="view-runway">
            View Full Collection →
        </a>

    </div>

</section>

<!-- =========================================
     BATCH 3
     INTERACTIVE VOGUE WALL
========================================= -->

<section class="vogue-wall">

    <div class="vogue-heading">

        <span>EDITORIAL COLLECTIONS</span>

        <h2>
            Browse fashion like a
            <em>luxury magazine.</em>
        </h2>

        <p>
            Every collection tells a story. Explore couture, menswear,
            womenswear and avant-garde editorials.
        </p>

    </div>


    <div class="editorial-layout">

        <!-- FEATURED COVER -->

        <div class="featured-cover">

            <img
                src="images/vogue1.jpg"
                id="featuredImage">

            <div class="cover-overlay">

                <span id="coverSeason">
                    FW26
                </span>

                <h3 id="coverTitle">
                    Midnight Atelier
                </h3>

                <p id="coverDesigner">
                    by Amina Cole
                </p>

            </div>

        </div>


        <!-- MAGAZINE STRIPS -->

        <div class="magazine-strip">

            <div class="mini-cover active" data-look="0">

                <img src="images/vogue1.jpg">

                <div>
                    <small>FW26</small>
                    <h4>Midnight</h4>
                </div>

            </div>


            <div class="mini-cover" data-look="1">

                <img src="images/vogue2.jpg">

                <div>
                    <small>SS26</small>
                    <h4>Noir Homme</h4>
                </div>

            </div>


            <div class="mini-cover" data-look="2">

                <img src="images/vogue3.jpg">

                <div>
                    <small>FW26</small>
                    <h4>Violet Muse</h4>
                </div>

            </div>


            <div class="mini-cover" data-look="3">

                <img src="images/vogue4.jpg">

                <div>
                    <small>LIMITED</small>
                    <h4>Chrome</h4>
                </div>

            </div>

        </div>

    </div>


    <!-- DETAILS -->

    <div class="collection-details">

        <div>

            <span id="detailTag">
                HAUTE COUTURE
            </span>

            <h3 id="detailTitle">
                Midnight Atelier
            </h3>

            <p id="detailDescription">
                Sculptural evening wear crafted for modern luxury and unforgettable entrances.
            </p>

        </div>


        <div class="detail-stats">

            <div>

                <strong id="detailLooks">
                    42
                </strong>

                <span>Looks</span>

            </div>

            <div>

                <strong id="detailRating">
                    4.9
                </strong>

                <span>Rating</span>

            </div>

            <div>

                <strong id="detailPieces">
                    680
                </strong>

                <span>Pieces</span>

            </div>

        </div>

    </div>

</section>

<!-- =========================================
     BATCH 4 - VIRTUAL WARDROBE
========================================= -->

<section class="virtual-wardrobe">

    <div class="wardrobe-heading">
        <span>VIRTUAL WARDROBE</span>
        <h2>Style it before you buy it.</h2>
        <p>
            Mix luxury blazers, trousers and footwear to create your perfect editorial outfit.
        </p>
    </div>


    <div class="wardrobe-stage">

        <!-- LEFT CONTROLS -->
        <div class="style-controls">

            <h3>Outerwear</h3>

            <button class="wardrobe-btn active" data-category="blazer" data-index="0">
                Midnight Blazer
            </button>

            <button class="wardrobe-btn" data-category="blazer" data-index="1">
                Ivory Jacket
            </button>

            <button class="wardrobe-btn" data-category="blazer" data-index="2">
                Velvet Coat
            </button>


            <h3>Trousers</h3>

            <button class="wardrobe-btn active" data-category="trouser" data-index="0">
                Tailored Black
            </button>

            <button class="wardrobe-btn" data-category="trouser" data-index="1">
                Cream Wide Leg
            </button>

            <button class="wardrobe-btn" data-category="trouser" data-index="2">
                Leather Fit
            </button>


            <h3>Footwear</h3>

            <button class="wardrobe-btn active" data-category="shoe" data-index="0">
                Luxury Loafers
            </button>

            <button class="wardrobe-btn" data-category="shoe" data-index="1">
                Stiletto Heels
            </button>

            <button class="wardrobe-btn" data-category="shoe" data-index="2">
                Designer Sneakers
            </button>

        </div>


        <!-- MANNEQUIN -->
        <div class="mannequin-stage">

            <div class="spotlight"></div>

            <img src="images/base-body.png" class="body-layer">

            <img src="images/blazer1.png" id="blazerLayer" class="clothing-layer">

            <img src="images/trouser1.png" id="trouserLayer" class="clothing-layer">

            <img src="images/shoe1.png" id="shoeLayer" class="clothing-layer">

        </div>


        <!-- RIGHT CARD -->
        <div class="outfit-card">

            <span>EDITOR'S PICK</span>

            <h3 id="outfitName">Midnight Executive</h3>

            <p id="outfitDesc">
                Luxury tailored blazer with modern black trousers and handcrafted loafers.
            </p>

            <div class="outfit-price">
                <strong id="outfitPrice">₦285,000</strong>
                <small>Complete Outfit</small>
            </div>

            <button class="shop-look">Shop This Look</button>

        </div>

    </div>

</section>


<script src="js/main.js"></script>

</body>
</html>