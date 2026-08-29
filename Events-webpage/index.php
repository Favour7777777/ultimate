<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <link rel="stylesheet" href="css/index.css?v=2">
</head>
<body>
<section class="container">
        <?php
        include "includes/navbar.php"
        ?>

    <section class="hero">

        <!-- I will replace this image later -->
        <img src="images/hero-image.jpg" class="hero-image" alt="Events Hero">

        <div class="hero-overlay"></div>

        <div class="hero-content">

            <span class="hero-tag">Ultimate Events</span>

            <h1>
                Every Great Moment
                Begins With An Event
            </h1>

            <p>
                Discover concerts, weddings, conferences, festivals and unforgettable experiences across Nigeria.
            </p>

            <div class="hero-buttons">
                <a href="#" class="primary-btn">Explore Events</a>
                <a href="#" class="secondary-btn">Become a Vendor</a>
            </div>

        </div>

        <!-- Floating glass cards -->
        <div class="floating-card card-one">
            🎵 2,500+ Live Events
        </div>

        <div class="floating-card card-two">
            🎫 Instant Ticket Booking
        </div>

    </section>

    <section class="event-categories">

    <div class="section-heading">

        <span>DISCOVER</span>

        <h2>Explore Event Categories</h2>

        <p>
            Find experiences that match your interests,
            mood and occasion.
        </p>

    </div>


    <div class="category-grid">


        <a href="#" class="category-card">

            <img
                src="images/live-music.jpg"
                alt="Concerts"
            >

            <div class="category-overlay">

                <h3>Concerts</h3>

                <p>Live music and unforgettable performances</p>

            </div>

        </a>


        <a href="#" class="category-card">

            <img
                src="images/wedding.png"
                alt="Weddings"
            >

            <div class="category-overlay">

                <h3>Weddings</h3>

                <p>Celebrate love and beautiful beginnings</p>

            </div>

        </a>


        <a href="#" class="category-card">

            <img
                src="images/conference.jpg"
                alt="Corporate Events"
            >

            <div class="category-overlay">

                <h3>Corporate</h3>

                <p>Conferences, meetings and business events</p>

            </div>

        </a>


        <a href="#" class="category-card">

            <img
                src="images/festivals.jpg"
                alt="Festivals"
            >

            <div class="category-overlay">

                <h3>Festivals</h3>

                <p>Culture, entertainment and celebrations</p>

            </div>

        </a>


        <a href="#" class="category-card">

            <img
                src="images/birthday.jpg"
                alt="Birthdays"
            >

            <div class="category-overlay">

                <h3>Birthdays</h3>

                <p>Make every birthday worth remembering</p>

            </div>

        </a>


        <a href="#" class="category-card">

            <img
                src="images/sports.jpg"
                alt="Sports"
            >

            <div class="category-overlay">

                <h3>Sports</h3>

                <p>Experience the excitement live</p>

            </div>

        </a>


        <a href="#" class="category-card">

            <img
                src="images/worship.jpg"
                alt="Religious Events"
            >

            <div class="category-overlay">

                <h3>Religious</h3>

                <p>Gatherings, worship and spiritual experiences</p>

            </div>

        </a>


        <a href="#" class="category-card">

            <img
                src="images/nightlife.jpg"
                alt="Nightlife"
            >

            <div class="category-overlay">

                <h3>Nightlife</h3>

                <p>Discover nights worth talking about</p>

            </div>

        </a>


    </div>

</section>

        <section class="featured-events">

            <div class="section-heading">

                <span>What's Happening</span>

                <h2>Featured Events</h2>

                <p>
                    Discover exciting events happening around you
                    and find your next experience.
                </p>

            </div>


            <div class="events-container" id="eventsContainer">
            <div class="events-track" id="eventsTrack">


                <!-- EVENT CARD 1 -->

                <article class="event-card">

                    <div class="event-image">

                        <img src="images/music" alt="Music Concert">

                        <span class="event-date">
                            AUG 28
                        </span>

                    </div>


                    <div class="event-content">

                        <h3>
                            Summer Music Festival
                        </h3>

                        <p class="event-location">
                            <i class="fa-solid fa-location-dot"></i>
                            Lagos, Nigeria
                        </p>

                        <p class="event-description">

                            Experience an unforgettable night
                            filled with live music and entertainment.

                        </p>


                        <div class="event-bottom">

                            <span class="event-price">
                                From ₦15,000
                            </span>

                            <a href="#" class="event-button">
                                View Event
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </div>

                </article>


                <!-- EVENT CARD 2 -->

                <article class="event-card">

                    <div class="event-image">

                        <img src="images/innovation-summit.jpg" alt="Business Conference">

                        <span class="event-date">
                            SEP 05
                        </span>

                    </div>


                    <div class="event-content">

                        <h3>
                            Business & Innovation Summit
                        </h3>

                        <p class="event-location">
                            <i class="fa-solid fa-location-dot"></i>
                            Abuja, Nigeria
                        </p>

                        <p class="event-description">

                            Connect with entrepreneurs, innovators
                            and industry leaders.

                        </p>


                        <div class="event-bottom">

                            <span class="event-price">
                                From ₦10,000
                            </span>

                            <a href="#" class="event-button">
                                View Event
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </div>

                </article>


                <!-- EVENT CARD 3 -->

                <article class="event-card">

                    <div class="event-image">

                        <img src="images/arts-exhibition.jpg" alt="Art Exhibition">

                        <span class="event-date">
                            SEP 12
                        </span>

                    </div>


                    <div class="event-content">

                        <h3>
                            Contemporary Art Exhibition
                        </h3>

                        <p class="event-location">
                            <i class="fa-solid fa-location-dot"></i>
                            Victoria Island, Lagos
                        </p>

                        <p class="event-description">

                            Explore creative works from talented
                            artists and creators.

                        </p>


                        <div class="event-bottom">

                            <span class="event-price">
                                Free Entry
                            </span>

                            <a href="#" class="event-button">
                                View Event
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </div>

                    

                </article>
            <!-- EVENTS CARD4  -->
                <article class="event-card">

                    <div class="event-image">

                        <img src="images/food-event.jpg" alt="Art Exhibition">

                        <span class="event-date">
                            SEP 12
                        </span>

                    </div>


                    <div class="event-content">

                        <h3>
                            Food & Culinary Festivals
                        </h3>

                        <p class="event-location">
                            <i class="fa-solid fa-location-dot"></i>
                            Lekki, Abuja
                        </p>

                        <p class="event-description">

                            Taste your way through the best chefs, flavours, and food experiences in Abuja.

                        </p>


                        <div class="event-bottom">

                            <span class="event-price">
                                Free Entry
                            </span>

                            <a href="#" class="event-button">
                                View Event
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </div>

                </article>
                <!-- EVENTS CARD 5 -->
                <article class="event-card">

                    <div class="event-image">

                        <img src="images/fashion.jpg" alt="Fashion shows and Runways">

                        <span class="event-date">
                            SEP 12
                        </span>

                    </div>


                    <div class="event-content">

                        <h3>
                            Fashion Shows & Runways
                        </h3>

                        <p class="event-location">
                            <i class="fa-solid fa-location-dot"></i>
                            Maryland, Lagos.
                        </p>

                        <p class="event-description">

                           Experience style, glamour, and creativity from top designers and models
                        </p>


                        <div class="event-bottom">

                            <span class="event-price">
                                Free Entry
                            </span>

                            <a href="#" class="event-button">
                                View Event
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </div>

                    

                </article>
                </div>



            </div>

        </section>


</section>

<!-- =========================================
     EVENT ORGANIZERS & HOSTS
========================================= -->

<section class="event-organizers">

    <div class="section-heading">

        <span>MEET THE PEOPLE BEHIND THE EVENTS</span>

        <h2>Event Organizers & Hosts</h2>

        <p>
            Discover the organizers, hosts and communities
            bringing amazing experiences to life.
        </p>

    </div>


    <div class="organizers-grid">


        <!-- ORGANIZER / HOST 1 -->

        <article class="organizer-card">

            <div class="organizer-image">

                <img
                    src="images/ultimate-events.png"
                    alt="Event Organizer"
                >

            </div>


            <div class="organizer-content">

                <span class="organizer-type">
                    Event Host&Organizer
                </span>

                <h3>
                    Ultimate Events Ltd
                </h3>

                <p>
                    Creating unforgettable experiences,
                    conferences and entertainment events.
                </p>

                <div class="organizer-bottom">

                    <span class="event-count">
                        12 Events
                    </span>

                    <a href="#" class="organizer-button">

                        View Profile

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </div>

        </article>


        <!-- ORGANIZER / HOST 2 -->

        <article class="organizer-card">

            <div class="organizer-image">

                <img
                    src="images/john-events.jpg"
                    alt="Event Host"
                >

            </div>


            <div class="organizer-content">

                <span class="organizer-type">
                    Event Host
                </span>

                <h3>
                    John Events
                </h3>

                <p>
                    Bringing energy, entertainment and
                    unforgettable moments to every event.
                </p>

                <div class="organizer-bottom">

                    <span class="event-count">
                        8 Events
                    </span>

                    <a href="#" class="organizer-button">

                        View Host

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </div>

        </article>


        <!-- HOST & ORGANIZER -->

        <article class="organizer-card">

            <div class="organizer-image">

                <img
                    src="images/lagos-creative-hub.jpg"
                    alt="Host and Organizer"
                >

            </div>


            <div class="organizer-content">

                <span class="organizer-type">
                    Host & Organizer
                </span>

                <h3>
                    Lagos Creative Hub
                </h3>

                <p>
                    A creative community hosting and organizing
                    inspiring events across Lagos.
                </p>

                <div class="organizer-bottom">

                    <span class="event-count">
                        15 Events
                    </span>

                    <a href="#" class="organizer-button">

                        View Profile

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </div>

        </article>


    </div>

    <!-- =========================================
     WHY CHOOSE EVENTSUT
========================================= -->

<section class="why-eventsut">


    <!-- BACKGROUND -->

    <div class="why-background">

        <img
            src="images/why-events.jpg"
            alt="EventsUT experience"
        >

    </div>


    <!-- DARK OVERLAY -->

    <div class="why-overlay"></div>


    <!-- CONTENT -->

    <div class="why-content">


        <!-- LEFT SIDE -->

        <div class="why-intro">

            <span class="why-eyebrow">
                THE EVENTSUT EXPERIENCE
            </span>

            <h2>
                More than<br>
                <span>just tickets.</span>
            </h2>

            <p>
                Discover experiences worth remembering,
                connect with the people behind them,
                and make every event count.
            </p>

        </div>


        <!-- RIGHT SIDE -->

        <div class="why-benefits">


            <!-- BENEFIT 01 -->

            <div class="why-benefit">

                <span class="benefit-number">
                    01
                </span>

                <div class="benefit-info">

                    <h3>
                        Verified Events
                    </h3>

                    <p>
                        Discover events from trusted
                        organizers and hosts.
                    </p>

                </div>

                <span class="benefit-arrow">

                    <i class="fa-solid fa-arrow-up-right"></i>

                </span>

            </div>


            <!-- BENEFIT 02 -->

            <div class="why-benefit">

                <span class="benefit-number">
                    02
                </span>

                <div class="benefit-info">

                    <h3>
                        Easy Ticketing
                    </h3>

                    <p>
                        Find and secure your tickets
                        without unnecessary hassle.
                    </p>

                </div>

                <span class="benefit-arrow">

                    <i class="fa-solid fa-arrow-up-right"></i>

                </span>

            </div>


            <!-- BENEFIT 03 -->

            <div class="why-benefit">

                <span class="benefit-number">
                    03
                </span>

                <div class="benefit-info">

                    <h3>
                        Discover More
                    </h3>

                    <p>
                        Explore concerts, conferences,
                        parties, workshops and more.
                    </p>

                </div>

                <span class="benefit-arrow">

                    <i class="fa-solid fa-arrow-up-right"></i>

                </span>

            </div>


            <!-- BENEFIT 04 -->

            <div class="why-benefit">

                <span class="benefit-number">
                    04
                </span>

                <div class="benefit-info">

                    <h3>
                        Support When You Need It
                    </h3>

                    <p>
                        Get assistance whenever you
                        need help with your experience.
                    </p>

                </div>

                <span class="benefit-arrow">

                    <i class="fa-solid fa-arrow-up-right"></i>

                </span>

            </div>


        </div>

    </div>

</section>

<!-- =========================================
     TRENDING RIGHT NOW
========================================= -->

<section class="trending-events">


    <!-- SECTION HEADING -->

    <div class="trending-heading">

        <div>

            <span>
                DON'T MISS OUT
            </span>

            <h2>
                Trending Right Now
            </h2>

        </div>

        <a href="#" class="trending-view-all">

            View All Events

            <i class="fa-solid fa-arrow-up-right"></i>

        </a>

    </div>


    <!-- TRENDING SHOWCASE -->

    <div class="trending-showcase">


        <!-- LARGE EVENT -->

        <a href="#" class="trending-item trending-large">

            <img
                src="images/live-music.jpg"
                alt="Live Music Festival"
            >

            <div class="trending-gradient"></div>

            <div class="trending-info">

                <span class="trending-tag">
                    MUSIC
                </span>

                <h3>
                    Live Music Festival
                </h3>

                <p>
                    Lagos • Aug 28
                </p>

            </div>

        </a>


        <!-- TOP RIGHT -->

        <a href="#" class="trending-item trending-small trending-top">

            <img
                src="images/conference2.jpg"
                alt="Business Conference"
            >

            <div class="trending-gradient"></div>

            <div class="trending-info">

                <span class="trending-tag">
                    BUSINESS
                </span>

                <h3>
                    Innovation Summit
                </h3>

                <p>
                    Abuja • Sep 05
                </p>

            </div>

        </a>


        <!-- BOTTOM RIGHT -->

        <a href="#" class="trending-item trending-small trending-bottom">

            <img
                src="images/arts-exhibition.jpg"
                alt="Art Exhibition"
            >

            <div class="trending-gradient"></div>

            <div class="trending-info">

                <span class="trending-tag">
                    ART
                </span>

                <h3>
                    Contemporary Art Night
                </h3>

                <p>
                    Lagos • Sep 12
                </p>

            </div>

        </a>


        <!-- FAR RIGHT -->

        <a href="#" class="trending-item trending-medium">

            <img
                src="images/fashion.jpg"
                alt="Fashion Event"
            >

            <div class="trending-gradient"></div>

            <div class="trending-info">

                <span class="trending-tag">
                    FASHION
                </span>

                <h3>
                    Fashion Week Experience
                </h3>

                <p>
                    Lagos • Sep 18
                </p>

            </div>

        </a>


    </div>

</section>

<!-- =========================================
     HOW IT WORKS
========================================= -->

<section class="how-it-works">

    <div class="how-heading">

        <span>
            HOW IT WORKS
        </span>

        <h2>
            Your Experience<br>
            Starts Here.
        </h2>

        <p>
            From discovering an event to experiencing it,
            Ultimate makes every step simple.
        </p>

    </div>


    <!-- ORBIT EXPERIENCE -->

    <div class="experience-orbit">


        <!-- ORBIT -->

        <div class="orbit-ring orbit-ring-one"></div>

        <div class="orbit-ring orbit-ring-two"></div>


        <!-- CENTER -->

        <div class="orbit-center">

            <div class="center-glow"></div>

            <i class="fa-solid fa-ticket"></i>

            <span>
                ULTIMATE
            </span>

        </div>


        <!-- STEP 01 -->

        <div class="experience-step step-one">

            <div class="step-number">
                01
            </div>

            <div class="step-icon">
                <i class="fa-solid fa-compass"></i>
            </div>

            <div class="step-content">

                <span>
                    DISCOVER
                </span>

                <h3>
                    Find Your Event
                </h3>

                <p>
                    Discover concerts, conferences,
                    exhibitions and experiences
                    happening around you.
                </p>

            </div>

        </div>


        <!-- STEP 02 -->

        <div class="experience-step step-two">

            <div class="step-number">
                02
            </div>

            <div class="step-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>

            <div class="step-content">

                <span>
                    EXPLORE
                </span>

                <h3>
                    Know The Details
                </h3>

                <p>
                    Explore the event, venue,
                    date, host, organizer and
                    everything you need to know.
                </p>

            </div>

        </div>


        <!-- STEP 03 -->

        <div class="experience-step step-three">

            <div class="step-number">
                03
            </div>

            <div class="step-icon">
                <i class="fa-solid fa-ticket-simple"></i>
            </div>

            <div class="step-content">

                <span>
                    EXPERIENCE
                </span>

                <h3>
                    Book & Enjoy
                </h3>

                <p>
                    Secure your spot and get ready
                    to experience something
                    unforgettable.
                </p>

            </div>

        </div>


    </div>


    <!-- CTA -->

    <a href="#" class="how-cta">

        Explore Events

        <i class="fa-solid fa-arrow-right"></i>

    </a>

</section>

<!-- =========================================
     ULTIMATE EVENTS FOOTER
========================================= -->

<footer class="events-footer">

    <div class="footer-glow"></div>

    <div class="footer-main">


        <!-- BRAND -->

        <div class="footer-brand">

            <a href="#" class="footer-logo">
                Ultimate<span>.</span>
            </a>

            <p>
                Discover experiences worth remembering.
                Find events, connect with people and
                make every moment count.
            </p>


            <div class="footer-socials">

                <a href="#" aria-label="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>

                <a href="#" aria-label="Facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>

                <a href="#" aria-label="X">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>

                <a href="#" aria-label="TikTok">
                    <i class="fa-brands fa-tiktok"></i>
                </a>

            </div>

        </div>


        <!-- EXPLORE -->

        <div class="footer-column">

            <h4>
                Explore
            </h4>

            <a href="#">
                All Events
            </a>

            <a href="#">
                Trending Events
            </a>

            <a href="#">
                Upcoming Events
            </a>

            <a href="#">
                Event Categories
            </a>

            <a href="#">
                Discover
            </a>

        </div>


        <!-- EVENTS -->

        <div class="footer-column">

            <h4>
                Events
            </h4>

            <a href="#">
                Music & Concerts
            </a>

            <a href="#">
                Business
            </a>

            <a href="#">
                Arts & Culture
            </a>

            <a href="#">
                Fashion
            </a>

            <a href="#">
                Sports
            </a>

        </div>


        <!-- ORGANIZERS -->

        <div class="footer-column">

            <h4>
                For Organizers
            </h4>

            <a href="#">
                Create an Event
            </a>

            <a href="#">
                Manage Events
            </a>

            <a href="#">
                Become a Host
            </a>

            <a href="#">
                Organizer Dashboard
            </a>

            <a href="#">
                Help Center
            </a>

        </div>


        <!-- NEWSLETTER -->

        <div class="footer-newsletter">

            <h4>
                Stay in the loop
            </h4>

            <p>
                Get notified about exciting events,
                experiences and what's happening
                around you.
            </p>


            <form class="newsletter-form">

                <input
                    type="email"
                    placeholder="Your email address"
                    required
                >

                <button type="submit">

                    <i class="fa-solid fa-arrow-right"></i>

                </button>

            </form>

        </div>


    </div>


    <!-- =========================================
         FOOTER BOTTOM
    ========================================= -->

    <div class="footer-bottom">

        <p>
            © 2026 Ultimate. All rights reserved.
        </p>


        <div class="footer-legal">

            <a href="#">
                Privacy Policy
            </a>

            <a href="#">
                Terms & Conditions
            </a>

            <a href="#">
                Cookie Policy
            </a>

        </div>

    </div>

</footer>

</section>


<script src="js/script.js?v=2"></script>
    
</body>
</html>

