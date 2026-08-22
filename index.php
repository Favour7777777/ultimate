
<?php

require "config.php";

$categoryQuery = "SELECT id, title, description, icon, image
                  FROM categories
                  ORDER BY created_at DESC
                  LIMIT 7";

$categoryResult = mysqli_query($conn, $categoryQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Marketplace</title>

<link rel="stylesheet" href="styles.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<?php
include "includes/navbar.php";
?>

<!-- HERO -->

<section class="hero">

<div class="overlay"></div>


<!-- HERO CONTENT -->

<div class="hero-content">

<h1>

Everything You Need.<br>
One Marketplace.

</h1>

<p>

Products • Services • Rentals • Digital Solutions

</p>

<div class="search-box">

<i class="fa-solid fa-magnifying-glass"></i>

<input
type="text"
id="searchInput">

</div>

</div>

</section>

<!-- ==========================================
CHOOSE YOUR EXPERIENCE
========================================== -->

<section class="experience">

    <div class="experience-heading">

        <h2>Choose Your Experience</h2>

        <p>
            Find the shopping experience that suits your lifestyle and budget.
        </p>

    </div>

    <div class="experience-grid">

        <!-- Royals -->
         <div class="card-overlay"></div>
        <div class="experience-card royals">

           

            <div class="experience-content">

                <div class="experience-icon">

                    <i class="fa-solid fa-crown"></i>

                </div>

                <h3>Royals</h3>

                <p>

                    Luxury products, premium services,
                    exclusive brands and VIP experiences
                    designed for those who expect the very best.

                </p>

                <a href="#" class="experience-btn">

                    <span>Explore Royals</span>

                </a>

            </div>

        </div>

        <!-- Essentials -->

        <div class="experience-card essentials">

            <div class="card-overlay"></div>

            <div class="experience-content">

                <div class="experience-icon">

                    <i class="fa-solid fa-star"></i>

                </div>

                <h3>Essentials</h3>

                <p>

                    Affordable quality products,
                    trusted services and everyday
                    marketplace deals for everyone.

                </p>

                <a href="#" class="experience-btn">

                   <span> Explore Essentials</span>

                </a>

            </div>

        </div>

    </div>

</section>

<!--========================================
        EXPLORE EVERYTHING SECTION
=========================================-->

<section class="explore-section">

    <div class="explore-header">

        <h2>Explore Everything</h2>

        <p>
            From products to professional services, discover everything in one place.
        </p>

    </div>

    <div class="categories-grid">

        <!-- Shop -->
        <!-- <a href="#" class="category-card">

            <img src="images/shop.jpg" alt="Shop">

            <div class="category-overlay">

                <div class="category-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>

                <h3>Shop</h3>

            </div>

        </a> -->

        <!-- Services -->
        <!-- <a href="#" class="category-card">

            <img src="images/services.jpg" alt="Services">

            <div class="category-overlay">

                <div class="category-icon">
                    <i class="fa-solid fa-briefcase"></i>
                </div>

                <h3>Services</h3>

            </div>

        </a> -->

        <!-- Vehicles -->
        <!-- <a href="#" class="category-card">

            <img src="images/vehicles.jpg" alt="Vehicles">

            <div class="category-overlay">

                <div class="category-icon">
                    <i class="fa-solid fa-car-side"></i>
                </div>

                <h3>Vehicles</h3>

            </div>

        </a> -->

        <!-- Real Estate -->
        <!-- <a href="#" class="category-card">

            <img src="images/real-estate.png" alt="Real Estate">

            <div class="category-overlay">

                <div class="category-icon">
                    <i class="fa-solid fa-building"></i>
                </div>

                <h3>Real Estate</h3>

            </div>

        </a> -->

        <!-- Tech -->
        <!-- <a href="#" class="category-card">

            <img src="images/tech.png" alt="Tech">

            <div class="category-overlay">

                <div class="category-icon">
                    <i class="fa-solid fa-laptop-code"></i>
                </div>

                <h3>Tech</h3>

            </div>

        </a> -->

        <!-- Fashion -->
        <!-- <a href="#" class="category-card">

            <img src="images/fashion.jpg" alt="Fashion">

            <div class="category-overlay">

                <div class="category-icon">
                    <i class="fa-solid fa-shirt"></i>
                </div>

                <h3>Fashion</h3>

            </div>

        </a> -->

        <!-- Food -->
        <!-- <a href="#" class="category-card">

            <img src="images/food.png" alt="Food">

            <div class="category-overlay">

                <div class="category-icon">
                    <i class="fa-solid fa-utensils"></i>
                </div>

                <h3>Food</h3>

            </div>

        </a> -->

        <!-- Beauty -->
        <!-- <a href="#" class="category-card">

            <img src="images/beauty.jpg" alt="Beauty">

            <div class="category-overlay">

                <div class="category-icon">
                    <i class="fa-solid fa-spa"></i>
                </div>

                <h3>Beauty</h3>

            </div>

        </a> -->

        <!-- Education -->
        <!-- <a href="#" class="category-card">

            <img src="images/education.jpg" alt="Education">

            <div class="category-overlay">

                <div class="category-icon">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>

                <h3>Education</h3>

            </div>

        </a> -->

        <!-- Events -->
        <!-- <a href="#" class="category-card">

            <img src="images/events.jpg" alt="Events">

            <div class="category-overlay">

                <div class="category-icon">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>

                <h3>Events</h3>

            </div>

        </a> -->

        <?php while($category = mysqli_fetch_assoc($categoryResult)): ?>

    <a href="categories_details.php?id=<?= $category['id']; ?>" class="category-card">

        <img 
            src="admin/<?= htmlspecialchars($category['image']); ?>" 
            alt="<?= htmlspecialchars($category['title']); ?>"
        >

        <div class="category-overlay">

            <div class="category-icon">
                <i class="<?= htmlspecialchars($category['icon']); ?>"></i>
            </div>

            <h3><?= htmlspecialchars($category['title']); ?></h3>

        </div>

    </a>

<?php endwhile; ?>


    </div>

    <div class="view-all-container">

        <a href="view-categories.php" class="view-all-btn">
            View All Categories
        </a>

    </div>

</section>
<!--========================================
        HANDPICKED FOR YOU SECTION
=========================================-->

<section class="handpicked-section">

    <div class="handpicked-header">

        <h2>Handpicked for You</h2>

        <p>
            Discover our most popular products and services, carefully selected for you.
        </p>

    </div>

    <div class="handpicked-grid">

        <!-- Product 1 -->

        <div class="product-card">

            <div class="product-image">

                <img src="images/shopping.webp" alt="Luxury Wrist Watch">

                <span class="category-badge">Fashion</span>

            </div>

            <div class="product-content">

                <h3>Luxury Wrist Watch</h3>

                <div class="rating">

                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>

                    <span>4.8</span>

                </div>

                <div class="price">$299</div>

                <a href="#" class="details-btn">View Details</a>

            </div>

        </div>

        <!-- Product 2 -->

        <div class="product-card">

            <div class="product-image">

                <img src="images/shopping (1).webp" alt="Gaming Laptop">

                <span class="category-badge">Tech</span>

            </div>

            <div class="product-content">

                <h3>Gaming Laptop</h3>

                <div class="rating">

                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>

                    <span>5.0</span>

                </div>

                <div class="price">$1,250</div>

                <a href="#" class="details-btn">View Details</a>

            </div>

        </div>

        <!-- Product 3 -->

        <div class="product-card">

            <div class="product-image">

                <img src="images/images (2).jpg" alt="Luxury SUV">

                <span class="category-badge">Vehicles</span>

            </div>

            <div class="product-content">

                <h3>Luxury SUV</h3>

                <div class="rating">

                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>

                    <span>5.0</span>

                </div>

                <div class="price">$65,000</div>

                <a href="#" class="details-btn">View Details</a>

            </div>

        </div>

        <!-- Product 4 -->

        <div class="product-card">

            <div class="product-image">

                <img src="images/NMVBJNHKJNB.jpg" alt="Luxury Apartment">

                <span class="category-badge">Real Estate</span>

            </div>

            <div class="product-content">

                <h3>Luxury Apartment</h3>

                <div class="rating">

                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>

                    <span>4.9</span>

                </div>

                <div class="price">$250,000</div>

                <a href="#" class="details-btn">View Details</a>

            </div>

        </div>

        <!-- Product 5 -->

        <div class="product-card">

            <div class="product-image">

                <img src="images/images (2).png" alt="Restaurant Special">

                <span class="category-badge">Food</span>

            </div>

            <div class="product-content">

                <h3>Chef's Special Platter</h3>

                <div class="rating">

                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>

                    <span>5.0</span>

                </div>

                <div class="price">$45</div>

                <a href="#" class="details-btn">View Details</a>

            </div>

        </div>

        <!-- Product 6 -->

        <div class="product-card">

            <div class="product-image">

                <img src="images/images (7).jpg" alt="Beauty Kit">

                <span class="category-badge">Beauty</span>

            </div>

            <div class="product-content">

                <h3>Premium Beauty Kit</h3>

                <div class="rating">

                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>

                    <span>4.7</span>

                </div>

                <div class="price">$89</div>

                <a href="#" class="details-btn">View Details</a>

            </div>

        </div>

        <div class="view-all-container">

        <a href="view-products-categories.php" class="view-all-btn">
            View All Products Categories
        </a>

    </div>

    </div>

</section>
<!--=========================================
        SERVICES YOU CAN BOOK
==========================================-->

<section class="services-section">

    <div class="services-header">

        <h2>Services You Can Book</h2>

        <p>
            Hire trusted professionals for every need.
        </p>

    </div>

    <div class="services-slider-wrapper">

        <!-- Left Arrow -->

        <button class="slider-btn prev-btn">

            <i class="fa-solid fa-chevron-left"></i>

        </button>

        <!-- Slider -->

        <div class="services-slider">

            <!--=========================
                    CARD 1
            ==========================-->

            <div class="service-card">

                <img src="images/IMG-20251114-WA0095.jpg" alt="Cleaning">

                <div class="service-overlay">

                    <div class="service-icon">

                        <i class="fa-solid fa-broom"></i>

                    </div>

                    <h3>Home Cleaning</h3>

                    <span class="service-price">
                        Starting from $25
                    </span>

                    <a href="#" class="book-btn">

                        Book Now

                    </a>

                </div>

            </div>

            <!--=========================
                    CARD 2
            ==========================-->

            <div class="service-card">

                <img src="images/plumbing.jpg" alt="Plumbing">

                <div class="service-overlay">

                    <div class="service-icon">

                        <i class="fa-solid fa-wrench"></i>

                    </div>

                    <h3>Plumbing</h3>

                    <span class="service-price">
                        Starting from $40
                    </span>

                    <a href="#" class="book-btn">

                        Book Now

                    </a>

                </div>

            </div>

            <!--=========================
                    CARD 3
            ==========================-->

            <div class="service-card">

                <img src="images/electrician.jpg" alt="Electrician">

                <div class="service-overlay">

                    <div class="service-icon">

                        <i class="fa-solid fa-bolt"></i>

                    </div>

                    <h3>Electrician</h3>

                    <span class="service-price">
                        Starting from $50
                    </span>

                    <a href="#" class="book-btn">

                        Book Now

                    </a>

                </div>

            </div>

            <!--=========================
                    CARD 4
            ==========================-->

            <div class="service-card">

                <img src="images/photography.jpg" alt="Photography">

                <div class="service-overlay">

                    <div class="service-icon">

                        <i class="fa-solid fa-camera"></i>

                    </div>

                    <h3>Photography</h3>

                    <span class="service-price">
                        Starting from $80
                    </span>

                    <a href="#" class="book-btn">

                        Book Now

                    </a>

                </div>

            </div>

            <!--=========================
                    CARD 5
            ==========================-->

            <div class="service-card">

                <img src="images/IMG-20251205-WA0073.jpg" alt="Hair Styling">

                <div class="service-overlay">

                    <div class="service-icon">

                        <i class="fa-solid fa-scissors"></i>

                    </div>

                    <h3>Hair Styling</h3>

                    <span class="service-price">
                        Starting from $30
                    </span>

                    <a href="#" class="book-btn">

                        Book Now

                    </a>

                </div>

            </div>

            <!--=========================
                    CARD 6
            ==========================-->

            <div class="service-card">

                <img src="images/carwash.jpg" alt="Car Wash">

                <div class="service-overlay">

                    <div class="service-icon">

                        <i class="fa-solid fa-car"></i>

                    </div>

                    <h3>Car Wash</h3>

                    <span class="service-price">
                        Starting from $20
                    </span>

                    <a href="#" class="book-btn">

                        Book Now

                    </a>

                </div>

            </div>

        </div>

        <!-- Right Arrow -->

        <button class="slider-btn next-btn">

            <i class="fa-solid fa-chevron-right"></i>

        </button>

    </div>

</section>

<!--=========================================
        WHY CHOOSE ULTIMATE
==========================================-->

<section class="why-section">

    <div class="why-header">

        <h2>Why Choose Ultimate</h2>

        <p>
            We are committed to providing a secure, reliable and exceptional marketplace experience.
        </p>

    </div>

    <div class="why-grid">

        <!-- Card 1 -->

        <div class="why-card">

            <div class="why-icon">

                <i class="fa-solid fa-badge-check"></i>

            </div>

            <h3>Verified Sellers</h3>

            <p>
                Shop with confidence knowing every verified seller has been carefully reviewed for authenticity and quality service.
            </p>

        </div>

        <!-- Card 2 -->

        <div class="why-card">

            <div class="why-icon">

                <i class="fa-solid fa-truck-fast"></i>

            </div>

            <h3>Fast & Secure Delivery</h3>

            <p>
                Enjoy reliable delivery services with real-time tracking, ensuring your orders arrive safely and on time.
            </p>

        </div>

        <!-- Card 3 -->

        <div class="why-card">

            <div class="why-icon">

                <i class="fa-solid fa-shield-halved"></i>

            </div>

            <h3>Safe Payments</h3>

            <p>
                Every transaction is protected with secure payment technology to keep your personal and financial information safe.
            </p>

        </div>

        <!-- Card 4 -->

        <div class="why-card">

            <div class="why-icon">

                <i class="fa-solid fa-headset"></i>

            </div>

            <h3>24/7 Customer Support</h3>

            <p>
                Our friendly support team is always available to help you with bookings, purchases and marketplace enquiries.
            </p>

        </div>

    </div>

</section>

<!--=========================================
        WHAT OUR CUSTOMERS SAY
==========================================-->

<section class="testimonial-section">

    <div class="testimonial-header">

        <h2>What Our Customers Say</h2>

        <p>
            See why thousands of customers trust Ultimate.
        </p>

    </div>

    <div class="testimonial-wrapper">

        <!-- Previous -->

        <button class="testimonial-btn prev-testimonial">

            <i class="fa-solid fa-chevron-left"></i>

        </button>

        <!-- Slider -->

        <div class="testimonial-slider">

            <!--=====================
                Testimonial 1
            ======================-->

            <div class="testimonial-card">

                <div class="customer-image">

                    <img src="images/customer1.jpg" alt="Customer">

                </div>

                <h3>Sarah Johnson</h3>

                <div class="stars">

                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>

                </div>

                <p>

                    Ultimate made shopping so easy. Everything arrived on time and the customer service was outstanding.

                </p>

                <span class="customer-city">

                    Lagos, Nigeria

                </span>

            </div>

            <!--=====================
                Testimonial 2
            ======================-->

            <div class="testimonial-card">

                <div class="customer-image">

                    <img src="images/customer2.jpg" alt="Customer">

                </div>

                <h3>Michael Brown</h3>

                <div class="stars">

                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>

                </div>

                <p>

                    Booking services has never been easier. Highly recommended for anyone looking for quality.

                </p>

                <span class="customer-city">

                    Abuja, Nigeria

                </span>

            </div>

            <!--=====================
                Testimonial 3
            ======================-->

            <div class="testimonial-card">

                <div class="customer-image">

                    <img src="images/customer3.jpg" alt="Customer">

                </div>

                <h3>Grace Williams</h3>

                <div class="stars">

                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>

                </div>

                <p>

                    Beautiful marketplace, verified sellers and secure payments. I love using Ultimate every week.

                </p>

                <span class="customer-city">

                    Port Harcourt, Nigeria

                </span>

            </div>

            <!--=====================
                Testimonial 4
            ======================-->

            <div class="testimonial-card">

                <div class="customer-image">

                    <img src="images/customer4.jpg" alt="Customer">

                </div>

                <h3>David Wilson</h3>

                <div class="stars">

                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-regular fa-star"></i>

                </div>

                <p>

                    Excellent experience from start to finish. The platform is fast, modern and trustworthy.

                </p>

                <span class="customer-city">

                    Ibadan, Nigeria

                </span>

            </div>

        </div>

        <!-- Next -->

        <button class="testimonial-btn next-testimonial">

            <i class="fa-solid fa-chevron-right"></i>

        </button>

    </div>

</section>

<!-- ==========================================
        FEATURED VENDORS
=========================================== -->

<section class="vendors-section">

    <div class="vendors-header">

        <h2>Featured Vendors</h2>

        <p>
            Meet our trusted marketplace partners delivering exceptional products and services every day.
        </p>

    </div>

    <div class="vendors-showcase">

        <!-- LEFT SPOTLIGHT -->

        <div class="vendor-spotlight">

            <img
                src="images/vendor-1.jpg"
                class="spotlight-bg"
                id="spotlightImage"
                alt="Vendor Background">

            <div class="spotlight-overlay">

                <div class="verified-badge">

                    <i class="fa-solid fa-circle-check"></i>

                    Verified Partner

                </div>

                <div class="spotlight-content">

                    <div class="vendor-logo">

                        <img
                        src="images/logo1.png"
                        id="spotlightLogo"
                        alt="Vendor Logo">

                    </div>

                    <h3 id="spotlightTitle">

                        Nike Official Store

                    </h3>

                    <div class="spotlight-rating">

                        <i class="fa-solid fa-star"></i>

                        <span>4.9 Rating</span>

                    </div>

                    <div class="vendor-stats">

                        <div>

                            <h4 id="productsCount">

                                12,500+

                            </h4>

                            <span>Products</span>

                        </div>

                        <div>

                            <h4 id="followersCount">

                                25K+

                            </h4>

                            <span>Followers</span>

                        </div>

                        <div>

                            <h4 id="cityName">

                                Lagos

                            </h4>

                            <span>Location</span>

                        </div>

                    </div>

                    <a href="#" class="visit-store-btn">

                        Visit Store

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </div>

        </div>

        <!-- RIGHT SIDE -->

        <div class="vendor-list">

            <div class="vendor-item active"

                data-image="images/mike.jpg"

                data-logo="images/mike logo.jpg"

                data-title="Mike Official Store"

                data-products="12,500+"

                data-followers="25K+"

                data-city="Lagos">

                <img src="images/mike.jpg">

                <div>

                    <h4>Mike Official Store</h4>

                    <span>Fashion</span>

                </div>

            </div>

            <div class="vendor-item"

                data-image="images/gadgets.jpg"

                data-logo="images/gadgets logo.jpg"

                data-title="Billionz Gadgets"

                data-products="8,700+"

                data-followers="18K+"

                data-city="Abuja">

                <img src="images/gadgets.jpg">

                <div>

                    <h4>Billionz Gadgets</h4>

                    <span>Technology</span>

                </div>

            </div>

            <div class="vendor-item"

                data-image="images/boutique.jpg"

                data-logo="images/boutique logo.jpg"

                data-title="Bright Boutique"

                data-products="5,200+"

                data-followers="14K+"

                data-city="Port Harcourt">

                <img src="images/boutique.jpg">

                <div>

                    <h4>Bright Boutique</h4>

                    <span>Luxury Fashion</span>

                </div>

            </div>

            <div class="vendor-item"

                data-image="images/hairsaloon.jpg"

                data-logo="images/denzyl logo.jpg"

                data-title="Denzyl Unisex"

                data-products="9,900+"

                data-followers="20K+"

                data-city="Ibadan">

                <img src="images/hairsaloon.jpg">

                <div>

                    <h4>Denzyl Unisex</h4>

                    <span>Hair Saloon</span>

                </div>

            </div>

            <div class="vendor-item"

                data-image="images/jewellery.jpg"

                data-logo="images/jewellery logo.jpg"

                data-title="Setryl Jewellry Palace"

                data-products="2,800+"

                data-followers="10K+"

                data-city="Lekki">

                <img src="images/jewellery.jpg">

                <div>

                    <h4>Jewellry Palace</h4>

                    <span>Luxury</span>

                </div>

            </div>
            <a href="vendors.php" class="view-vendors-btn">

    View More Vendors

    <i class="fa-solid fa-arrow-right"></i>

</a>

        </div>

    </div>

</section>

<!--=========================================
        TRENDING RIGHT NOW
==========================================-->

<section class="trending-section">

    <div class="trending-header">

        <h2>Trending Right Now</h2>

        <p>
            Discover the hottest products and services everyone is talking about today.
        </p>

    </div>

    <div class="trending-masonry">

        <!-- CARD 1 -->

        <article class="trend-card tall">

            <img src="images/nikeairmax.png" alt="Nike Sneakers">

            <div class="trend-overlay">

                <div class="trend-top">

                    <span class="trend-badge">

                        🔥 Trending

                    </span>

                    <button class="wishlist-btn">

                        <i class="fa-regular fa-heart"></i>

                    </button>

                </div>

                <div class="trend-content">

                    <span class="trend-category">

                        Fashion

                    </span>

                    <h3>Nike Air Max 2026</h3>

                    <div class="trend-rating">

                        ★★★★★

                        <span>(214)</span>

                    </div>

                    <h4>$189</h4>

                    <p>Nike Official Store</p>

                    <a href="#" class="quick-view">

                        Quick View

                    </a>

                </div>

            </div>

        </article>

        <!-- CARD 2 -->

        <article class="trend-card medium">

            <img src="images/macbook.jpg" alt="MacBook">

            <div class="trend-overlay">

                <div class="trend-top">

                    <span class="trend-badge">

                        🔥 Trending

                    </span>

                    <button class="wishlist-btn">

                        <i class="fa-regular fa-heart"></i>

                    </button>

                </div>

                <div class="trend-content">

                    <span class="trend-category">

                        Tech

                    </span>

                    <h3>MacBook Pro M6</h3>

                    <div class="trend-rating">

                        ★★★★★

                        <span>(180)</span>

                    </div>

                    <h4>$2,499</h4>

                    <p>Apple Store</p>

                    <a href="#" class="quick-view">

                        Quick View

                    </a>

                </div>

            </div>

        </article>

        <!-- CARD 3 -->

        <article class="trend-card wide">

            <img src="images/mercedes.jpg" alt="Mercedes">

            <div class="trend-overlay">

                <div class="trend-top">

                    <span class="trend-badge">

                        🔥 Trending

                    </span>

                    <button class="wishlist-btn">

                        <i class="fa-regular fa-heart"></i>

                    </button>

                </div>

                <div class="trend-content">

                    <span class="trend-category">

                        Vehicles

                    </span>

                    <h3>Mercedes G-Wagon 2026</h3>

                    <div class="trend-rating">

                        ★★★★★

                        <span>(75)</span>

                    </div>

                    <h4>$185,000</h4>

                    <p>Luxury Auto Hub</p>

                    <a href="#" class="quick-view">

                        Quick View

                    </a>

                </div>

            </div>

        </article>

        <!-- CARD 4 -->

        <article class="trend-card small">

            <img src="images/oudperfume.jpg" alt="Perfume">

            <div class="trend-overlay">

                <div class="trend-top">

                    <span class="trend-badge">

                        🔥 Trending

                    </span>

                    <button class="wishlist-btn">

                        <i class="fa-regular fa-heart"></i>

                    </button>

                </div>

                <div class="trend-content">

                    <span class="trend-category">

                        Beauty

                    </span>

                    <h3>Luxury Oud Perfume</h3>

                    <div class="trend-rating">

                        ★★★★★

                        <span>(143)</span>

                    </div>

                    <h4>$95</h4>

                    <p>Elite Fragrance</p>

                    <a href="#" class="quick-view">

                        Quick View

                    </a>

                </div>

            </div>

        </article>

        <!-- CARD 5 -->

        <article class="trend-card tall">

            <img src="images/luxury apartment.jpg" alt="Apartment">

            <div class="trend-overlay">

                <div class="trend-top">

                    <span class="trend-badge">

                        🔥 Trending

                    </span>

                    <button class="wishlist-btn">

                        <i class="fa-regular fa-heart"></i>

                    </button>

                </div>

                <div class="trend-content">

                    <span class="trend-category">

                        Real Estate

                    </span>

                    <h3>Luxury Smart Apartment</h3>

                    <div class="trend-rating">

                        ★★★★★

                        <span>(52)</span>

                    </div>

                    <h4>$450,000</h4>

                    <p>Prime Properties</p>

                    <a href="#" class="quick-view">

                        Quick View

                    </a>

                </div>

            </div>

        </article>

        <!-- CARD 6 -->

        <article class="trend-card medium">

            <img src="images/Gourmet_Beef_Burger.webp" alt="Burger">

            <div class="trend-overlay">

                <div class="trend-top">

                    <span class="trend-badge">

                        🔥 Trending

                    </span>

                    <button class="wishlist-btn">

                        <i class="fa-regular fa-heart"></i>

                    </button>

                </div>

                <div class="trend-content">

                    <span class="trend-category">

                        Food

                    </span>

                    <h3>Ultimate Gourmet Burger</h3>

                    <div class="trend-rating">

                        ★★★★☆

                        <span>(126)</span>

                    </div>

                    <h4>$24</h4>

                    <p>Foodie's Kitchen</p>

                    <a href="#" class="quick-view">

                        Quick View

                    </a>

                </div>

            </div>

        </article>

    </div>

    <div class="trending-footer">

        <a href="#" class="explore-trending-btn">

            Explore More Trending

            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>

</section>

<!--==================================================
        BECOME A SELLER / SERVICE PROVIDER
===================================================-->

<section class="seller-section">

    <!-- Background Glow Shapes -->
    <div class="seller-background-shape shape-1"></div>
    <div class="seller-background-shape shape-2"></div>

    <div class="seller-container">

        <!-- =========================
                LEFT CONTENT
        ========================== -->

        <div class="seller-left">

            <span class="seller-tag">
                🚀 Start Your Business Journey
            </span>

            <h2>
                Become a Seller or Service Provider
            </h2>

            <p class="seller-description">
                Turn your passion into profit with Ultimate Marketplace. Whether
                you sell products, rent vehicles, list properties, or provide
                professional services, we give you everything you need to grow
                your business and reach thousands of customers.
            </p>

            <!-- Marketplace Statistics -->

            <div class="seller-stats">

                <div class="stat-box">

                    <h3>5,000+</h3>

                    <span>Active Sellers</span>

                </div>

                <div class="stat-box">

                    <h3>1,200+</h3>

                    <span>Service Providers</span>

                </div>

                <div class="stat-box">

                    <h3>98%</h3>

                    <span>Customer Satisfaction</span>

                </div>

                <div class="stat-box">

                    <h3>50K+</h3>

                    <span>Monthly Visitors</span>

                </div>

            </div>

            <!-- Benefits -->

            <div class="seller-benefits">

                <div class="benefit">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>Sell Unlimited Products</span>

                </div>

                <div class="benefit">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>Offer Professional Services</span>

                </div>

                <div class="benefit">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>Receive Secure Payments</span>

                </div>

                <div class="benefit">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>Manage Everything From One Dashboard</span>

                </div>

                <div class="benefit">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>Real-Time Orders & Notifications</span>

                </div>

                <div class="benefit">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>Reach Thousands of Customers</span>

                </div>

            </div>

            <!-- Buttons -->

            <div class="seller-buttons">

                <a href="seller-signup.php" class="seller-btn">

                    Start Selling Today

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

                <a href="seller-login.php" class="login-link">

                    Already a Seller? Log In

                </a>

            </div>

        </div>

        <!-- =========================
                RIGHT CONTENT
        ========================== -->

        <div class="seller-right">

            <!-- Dashboard -->

            <div class="dashboard-card">

                <div class="dashboard-top">

                    <span class="dashboard-dot red"></span>

                    <span class="dashboard-dot yellow"></span>

                    <span class="dashboard-dot green"></span>

                </div>

                <div class="dashboard-body">

                    <h3>Ultimate Seller Dashboard</h3>

                    <div class="dashboard-grid">

                        <div class="dashboard-widget">

                            <i class="fa-solid fa-wallet"></i>

                            <h4>$24,580</h4>

                            <span>Total Earnings</span>

                        </div>

                        <div class="dashboard-widget">

                            <i class="fa-solid fa-cart-shopping"></i>

                            <h4>185</h4>

                            <span>New Orders</span>

                        </div>

                        <div class="dashboard-widget">

                            <i class="fa-solid fa-star"></i>

                            <h4>4.9</h4>

                            <span>Seller Rating</span>

                        </div>

                        <div class="dashboard-widget">

                            <i class="fa-solid fa-users"></i>

                            <h4>12,450</h4>

                            <span>Customers</span>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Floating Notification Cards -->

            <div class="floating-card card-one">

                <i class="fa-solid fa-bag-shopping"></i>

                <div>

                    <h5>New Order</h5>

                    <span>2 Minutes Ago</span>

                </div>

            </div>

            <div class="floating-card card-two">

                <i class="fa-solid fa-money-bill-wave"></i>

                <div>

                    <h5>Payment Received</h5>

                    <span>$320.00</span>

                </div>

            </div>

            <div class="floating-card card-three">

                <i class="fa-solid fa-star"></i>

                <div>

                    <h5>New Review</h5>

                    <span>★★★★★</span>

                </div>

            </div>

        </div>

    </div>

</section>

<!--==================================================
                TAKE ULTIMATE EVERYWHERE
===================================================-->

<section class="mobile-app-section">

    <div class="app-glow glow-one"></div>
    <div class="app-glow glow-two"></div>

    <div class="mobile-app-container">

        <!--============================
                LEFT CONTENT
        =============================-->

        <div class="app-left">

            <span class="app-tag">

                📱 Mobile Experience

            </span>

            <h2>

                Take Ultimate Everywhere

            </h2>

            <p>

                Shop premium products, book trusted professionals,
                discover amazing properties, rent vehicles,
                and manage your business anytime,
                anywhere with the Ultimate Mobile App.

            </p>

            <!-- FEATURES -->

            <div class="app-features">

                <div class="app-feature">

                    <i class="fa-solid fa-bell"></i>

                    <span>Instant Notifications</span>

                </div>

                <div class="app-feature">

                    <i class="fa-solid fa-cart-shopping"></i>

                    <span>Faster Checkout</span>

                </div>

                <div class="app-feature">

                    <i class="fa-solid fa-heart"></i>

                    <span>Save Favorites</span>

                </div>

                <div class="app-feature">

                    <i class="fa-solid fa-location-dot"></i>

                    <span>Nearby Services</span>

                </div>

                <div class="app-feature">

                    <i class="fa-solid fa-comments"></i>

                    <span>In-App Messaging</span>

                </div>

                <div class="app-feature">

                    <i class="fa-solid fa-shield-halved"></i>

                    <span>Secure Payments</span>

                </div>

            </div>

            <!-- DOWNLOAD BUTTONS -->

            <div class="download-buttons">

                <a href="#" class="store-btn app-store">

                    <i class="fa-brands fa-apple"></i>

                    <div>

                        <small>Download on the</small>

                        <strong>App Store</strong>

                    </div>

                </a>

                <a href="#" class="store-btn play-store">

                    <i class="fa-brands fa-google-play"></i>

                    <div>

                        <small>GET IT ON</small>

                        <strong>Google Play</strong>

                    </div>

                </a>

            </div>

        </div>

        <!--============================
                RIGHT CONTENT
        =============================-->

        <div class="app-right">

            <!-- BACK PHONE -->

            <div class="phone phone-back">

                <img src="images/dashboard-removebg-preview.png" alt="Seller Dashboard">

            </div>

            <!-- FRONT PHONE -->

            <div class="phone phone-front">

                <img src="images/ChatGPT_Image_Jul_27__2026__03_24_48_PM-removebg-preview.png" alt="Ultimate Mobile App">

            </div>

            <!-- FLOATING CARD -->

            <div class="app-floating-card rating-card">

                <i class="fa-solid fa-star"></i>

                <div>

                    <h4>4.9 Rating</h4>

                    <span>Trusted by thousands</span>

                </div>

            </div>

            <div class="app-floating-card delivery-card">

                <i class="fa-solid fa-truck-fast"></i>

                <div>

                    <h4>Fast Delivery</h4>

                    <span>Across the country</span>

                </div>

            </div>

            <div class="app-floating-card secure-card">

                <i class="fa-solid fa-lock"></i>

                <div>

                    <h4>100% Secure</h4>

                    <span>Protected Payments</span>

                </div>

            </div>

        </div>

    </div>

</section>

<!--==================================================
                FINAL CALL TO ACTION
===================================================-->

<section class="final-cta">

    <!-- Background Glow -->
    <div class="cta-glow glow-left"></div>
    <div class="cta-glow glow-right"></div>

    <div class="cta-container">

        <span class="cta-badge">

            ✨ Join Thousands of Happy Customers & Businesses

        </span>

        <h2>

            Your Marketplace.
            <br>
            Your Services.
            <br>
            Your Future.

        </h2>

        <p>

            Whether you're shopping for everyday essentials,
            booking trusted professionals,
            discovering vehicles,
            exploring real estate,
            or growing your business,
            Ultimate brings everything together in one secure,
            modern marketplace built for everyone.

        </p>

        <!-- CTA BUTTONS -->

        <div class="cta-buttons">

            <a href="explore.php" class="cta-primary">

                <i class="fa-solid fa-compass"></i>

                Start Exploring

            </a>

            <a href="seller-signup.php" class="cta-secondary">

                <i class="fa-solid fa-store"></i>

                Become a Seller

            </a>

        </div>

        <!-- QUICK STATS -->

        <div class="cta-stats">

            <div class="cta-stat">

                <h3>50K+</h3>

                <span>Happy Customers</span>

            </div>

            <div class="cta-stat">

                <h3>5K+</h3>

                <span>Trusted Sellers</span>

            </div>

            <div class="cta-stat">

                <h3>10K+</h3>

                <span>Products & Services</span>

            </div>

            <div class="cta-stat">

                <h3>99%</h3>

                <span>Customer Satisfaction</span>

            </div>

        </div>

    </div>

</section>

<?php
include "includes/footer.php";
?>

<script src="main.js"></script>

</body>
</html>

<!-- stopped at 768px -->