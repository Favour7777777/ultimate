<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ultimate Education</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <!-- ===================== NAVBAR ===================== -->

    <header class="navbar">

    <a href="#" class="logo">
        Ultimate<span>.</span>
    </a>

    <nav class="nav-links" id="navLinks">

        <a href="#">Home</a>
        <a href="#">Courses</a>
        <a href="#">Institutions</a>
        <a href="#">Tutors</a>
        <a href="#">About</a>

        <!-- Mobile Login -->
        <a href="#" class="login-btn mobile-login">
            Login
        </a>

    </nav>

    <!-- Desktop Search -->
    <div class="nav-actions">

        <div class="search-box">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                placeholder="Search courses..."
            >

        </div>

    </div>

    <!-- Hamburger -->
    <button class="menu-toggle" id="menuToggle">

        <i class="fa-solid fa-bars"></i>

    </button>

</header>
    <!-- ===================== HERO ===================== -->

    <section class="hero">

        <img
            src="images/hero-section.jpg"
            alt="Ultimate Education Hero"
            class="hero-image"
        >

        <div class="hero-overlay"></div>

        <div class="hero-content">

            <span class="hero-badge">

                <i class="fa-solid fa-graduation-cap"></i>

                Learn Without Limits

            </span>

            <h1>
                Discover Courses,
                Tutors & Institutions
            </h1>

            <p>
                Find certified tutors, universities, professional courses,
                scholarships and educational opportunities — all in one premium platform.
            </p>

            <div class="hero-buttons">

                <a href="#" class="primary-btn">
                    Explore Education
                </a>

                <a href="#" class="secondary-btn">
                    Become an Instructor
                </a>

            </div>

        </div>


        <!-- FLOATING STATS -->

        <div class="hero-stat stat-one">

            <h3>5,000+</h3>

            <span>Courses</span>

        </div>

        <div class="hero-stat stat-two">

            <h3>850+</h3>

            <span>Verified Tutors</span>

        </div>

    </section>

    <!-- =========================================
     EXPLORE EDUCATION CATEGORIES
========================================= -->

<section class="education-categories">

    <div class="section-heading">

        <span>EXPLORE LEARNING</span>

        <h2>Choose Your Learning Path</h2>

        <p>
            Discover courses, institutions and educational opportunities
            across different fields of study.
        </p>

    </div>


    <div class="education-grid">


        <!-- CARD 1 -->

        <a href="#" class="education-card">

            <div class="category-icon">
                <i class="fa-solid fa-laptop-code"></i>
            </div>

            <h3>Technology</h3>

            <p>Programming, AI, Cybersecurity & more.</p>

            <span class="course-count">1,240 Courses</span>

        </a>


        <!-- CARD 2 -->

        <a href="#" class="education-card">

            <div class="category-icon">
                <i class="fa-solid fa-briefcase"></i>
            </div>

            <h3>Business</h3>

            <p>Entrepreneurship, Finance & Leadership.</p>

            <span class="course-count">890 Courses</span>

        </a>


        <!-- CARD 3 -->

        <a href="#" class="education-card">

            <div class="category-icon">
                <i class="fa-solid fa-scale-balanced"></i>
            </div>

            <h3>Law</h3>

            <p>Legal studies and professional training.</p>

            <span class="course-count">315 Courses</span>

        </a>


        <!-- CARD 4 -->

        <a href="#" class="education-card">

            <div class="category-icon">
                <i class="fa-solid fa-heart-pulse"></i>
            </div>

            <h3>Medicine</h3>

            <p>Healthcare, Nursing & Medical Sciences.</p>

            <span class="course-count">670 Courses</span>

        </a>


        <!-- CARD 5 -->

        <a href="#" class="education-card">

            <div class="category-icon">
                <i class="fa-solid fa-palette"></i>
            </div>

            <h3>Creative Arts</h3>

            <p>Design, Photography & Digital Creativity.</p>

            <span class="course-count">540 Courses</span>

        </a>


        <!-- CARD 6 -->

        <a href="#" class="education-card">

            <div class="category-icon">
                <i class="fa-solid fa-language"></i>
            </div>

            <h3>Languages</h3>

            <p>English, French, Korean & more.</p>

            <span class="course-count">420 Courses</span>

        </a>


        <!-- CARD 7 -->

        <a href="#" class="education-card">

            <div class="category-icon">
                <i class="fa-solid fa-building-columns"></i>
            </div>

            <h3>Universities</h3>

            <p>Degree programs and admissions.</p>

            <span class="course-count">120 Institutions</span>

        </a>


        <!-- CARD 8 -->

        <a href="#" class="education-card">

            <div class="category-icon">
                <i class="fa-solid fa-user-graduate"></i>
            </div>

            <h3>Tutors</h3>

            <p>Learn directly from verified educators.</p>

            <span class="course-count">850 Tutors</span>

        </a>


    </div>

</section>

<!-- =========================================
     FEATURED COURSES
========================================= -->

<section class="featured-courses">

    <div class="section-heading">

        <span>LEARN SOMETHING NEW</span>

        <h2>Featured Courses</h2>

        <p>
            Explore popular courses taught by skilled instructors
            and discover your next opportunity to grow.
        </p>

    </div>


    <div class="courses-grid">


        <!-- COURSE 1 -->

        <article class="course-card">

            <div class="course-image">

                <img src="images/web-development" alt="Web Development">

                <span class="course-category">
                    Technology
                </span>

            </div>


            <div class="course-content">

                <h3>Complete Web Development</h3>

                <p>
                    Learn HTML, CSS, JavaScript and build modern websites.
                </p>


                <div class="course-instructor">

                    <i class="fa-solid fa-user"></i>

                    <span>John Smith</span>

                </div>


                <div class="course-info">

                    <span>⭐ 4.9</span>

                    <span>120 Students</span>

                </div>


                <div class="course-bottom">

                    <strong>₦25,000</strong>

                    <a href="#">View Course</a>

                </div>

            </div>

        </article>


        <!-- COURSE 2 -->

        <article class="course-card">

            <div class="course-image">

                <img src="images/digital-marketing.jpg" alt="Digital Marketing">

                <span class="course-category">
                    Business
                </span>

            </div>


            <div class="course-content">

                <h3>Digital Marketing Masterclass</h3>

                <p>
                    Master social media, advertising and online marketing.
                </p>


                <div class="course-instructor">

                    <i class="fa-solid fa-user"></i>

                    <span>Sarah Johnson</span>

                </div>


                <div class="course-info">

                    <span>⭐ 4.8</span>

                    <span>95 Students</span>

                </div>


                <div class="course-bottom">

                    <strong>₦18,000</strong>

                    <a href="#">View Course</a>

                </div>

            </div>

        </article>


        <!-- COURSE 3 -->

        <article class="course-card">

            <div class="course-image">

                <img src="images/ux-design.jpg" alt="UI UX Design">

                <span class="course-category">
                    Creative Arts
                </span>

            </div>


            <div class="course-content">

                <h3>UI/UX Design Fundamentals</h3>

                <p>
                    Learn how to design beautiful and user-friendly interfaces.
                </p>


                <div class="course-instructor">

                    <i class="fa-solid fa-user"></i>

                    <span>Michael Brown</span>

                </div>


                <div class="course-info">

                    <span>⭐ 4.9</span>

                    <span>76 Students</span>

                </div>


                <div class="course-bottom">

                    <strong>₦22,000</strong>

                    <a href="#">View Course</a>

                </div>

            </div>

        </article>


    </div>


    <div class="section-button">

        <a href="#">
            View All Courses
        </a>

    </div>

</section>

<!-- =========================================
     INSTITUTION SPOTLIGHT
========================================= -->

<section class="institution-spotlight">

    <div class="section-heading">

        <span>INSTITUTION SPOTLIGHT</span>

        <h2>Discover Where Futures Begin</h2>

        <p>
            Explore outstanding institutions and discover
            opportunities to learn, grow and build your future.
        </p>

    </div>


    <div class="institution-slider">


        <!-- SLIDE 1 -->

        <div class="institution-slide active">

            <img
                src="images/ultimate-uni.jpg"
                alt="Ultimate University"
            >

            <div class="institution-overlay"></div>


            <div class="institution-details">

                <span class="institution-label">
                    UNIVERSITY
                </span>

                <h3>Ultimate University</h3>

                <p class="institution-location">
                    <i class="fa-solid fa-location-dot"></i>
                    Lagos, Nigeria
                </p>

                <p class="institution-description">
                    Discover world-class programs, modern facilities
                    and opportunities designed for the next generation.
                </p>

                <a href="#" class="institution-view-btn">
                    Explore Institution
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        </div>


        <!-- SLIDE 2 -->

        <div class="institution-slide">

            <img
                src="images/future-skills.jpg"
                alt="Future Skills College"
            >

            <div class="institution-overlay"></div>


            <div class="institution-details">

                <span class="institution-label">
                    COLLEGE
                </span>

                <h3>Future Skills College</h3>

                <p class="institution-location">
                    <i class="fa-solid fa-location-dot"></i>
                    Abuja, Nigeria
                </p>

                <p class="institution-description">
                    Build practical skills and prepare yourself
                    for the opportunities of tomorrow.
                </p>

                <a href="#" class="institution-view-btn">
                    Explore Institution
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        </div>


        <!-- SLIDE 3 -->

        <div class="institution-slide">

            <img
                src="images/digital-academy.jpg"
                alt="Digital Academy"
            >

            <div class="institution-overlay"></div>


            <div class="institution-details">

                <span class="institution-label">
                    ACADEMY
                </span>

                <h3>Digital Academy</h3>

                <p class="institution-location">
                    <i class="fa-solid fa-location-dot"></i>
                    Port Harcourt, Nigeria
                </p>

                <p class="institution-description">
                    Master technology, design and digital skills
                    through practical, career-focused programs.
                </p>

                <a href="#" class="institution-view-btn">
                    Explore Institution
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        </div>


        <!-- CONTROLS -->

        <button class="institution-prev">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <button class="institution-next">
            <i class="fa-solid fa-chevron-right"></i>
        </button>


        <!-- DOTS -->

        <div class="institution-dots">

            <button class="institution-dot active"></button>

            <button class="institution-dot"></button>

            <button class="institution-dot"></button>

        </div>


        <!-- COUNTER -->

        <div class="institution-counter">

            <span class="current-slide">01</span>

            <span>/</span>

            <span>03</span>

        </div>

    </div>

</section>

<!-- =========================================
     FIND YOUR LEARNING OPPORTUNITY
========================================= -->

<section class="learning-finder">

    <div class="finder-content">

        <span class="finder-label">
            FIND YOUR PATH
        </span>

        <h2>
            What Do You Want To Learn?
        </h2>

        <p>
            Find courses, programs and learning opportunities
            that match your goals.
        </p>


        <div class="learning-search">

            <div class="search-field">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    placeholder="Search courses, skills or subjects..."
                >

            </div>


            <div class="select-field">

                <i class="fa-solid fa-book-open"></i>

                <select>

                    <option selected disabled>
                        Category
                    </option>

                    <option>Technology</option>
                    <option>Business</option>
                    <option>Law</option>
                    <option>Medicine</option>
                    <option>Creative Arts</option>
                    <option>Languages</option>

                </select>

            </div>


            <div class="select-field">

                <i class="fa-solid fa-layer-group"></i>

                <select>

                    <option selected disabled>
                        Level
                    </option>

                    <option>Beginner</option>
                    <option>Intermediate</option>
                    <option>Advanced</option>

                </select>

            </div>


            <div class="select-field">

                <i class="fa-solid fa-location-dot"></i>

                <select>

                    <option selected disabled>
                        Location
                    </option>

                    <option>Online</option>
                    <option>Lagos</option>
                    <option>Abuja</option>
                    <option>Port Harcourt</option>
                    <option>Ibadan</option>

                </select>

            </div>


            <button class="find-learning-btn">

                Find Courses

                <i class="fa-solid fa-arrow-right"></i>

            </button>

        </div>

    </div>

</section>

<!-- =========================================
     SCHOLARSHIPS & OPPORTUNITIES
========================================= -->

<section class="education-opportunities">

    <div class="section-heading">

        <span>OPEN DOORS</span>

        <h2>Scholarships & Opportunities</h2>

        <p>
            Discover scholarships, internships, fellowships and
            other opportunities designed to help you move forward.
        </p>

    </div>


    <div class="opportunity-board">


        <!-- FEATURED OPPORTUNITY -->

        <div class="featured-opportunity">

            <div class="opportunity-glow"></div>

            <img
                src="images/scholarship.jpg"
                alt="Scholarship opportunity"
            >

            <div class="opportunity-overlay"></div>


            <div class="featured-opportunity-content">

                <span class="opportunity-type">
                    SCHOLARSHIP
                </span>

                <h3>
                    Global Excellence Scholarship
                </h3>

                <p class="opportunity-amount">
                    Up to ₦5,000,000
                </p>

                <p class="opportunity-description">
                    Support your educational journey with funding
                    opportunities for outstanding students.
                </p>


                <div class="opportunity-deadline">

                    <i class="fa-regular fa-calendar"></i>

                    Deadline: October 30, 2026

                </div>


                <a href="#" class="opportunity-button">

                    View Opportunity

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </div>

        </div>


        <!-- OPPORTUNITY LIST -->

        <div class="opportunity-list">


            <!-- ITEM 1 -->

            <article class="opportunity-item">

                <div class="opportunity-item-icon">

                    <i class="fa-solid fa-briefcase"></i>

                </div>


                <div class="opportunity-item-content">

                    <span>INTERNSHIP</span>

                    <h3>Tech Internship 2026</h3>

                    <p>
                        Gain real-world experience with leading
                        technology companies.
                    </p>

                    <small>
                        Deadline: September 15, 2026
                    </small>

                </div>


                <a href="#" class="opportunity-arrow">

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </article>


            <!-- ITEM 2 -->

            <article class="opportunity-item">

                <div class="opportunity-item-icon">

                    <i class="fa-solid fa-earth-africa"></i>

                </div>


                <div class="opportunity-item-content">

                    <span>FELLOWSHIP</span>

                    <h3>Global Leaders Fellowship</h3>

                    <p>
                        Connect with emerging leaders and
                        develop your leadership skills.
                    </p>

                    <small>
                        Deadline: November 12, 2026
                    </small>

                </div>


                <a href="#" class="opportunity-arrow">

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </article>


            <!-- ITEM 3 -->

            <article class="opportunity-item">

                <div class="opportunity-item-icon">

                    <i class="fa-solid fa-trophy"></i>

                </div>


                <div class="opportunity-item-content">

                    <span>COMPETITION</span>

                    <h3>Future Innovators Challenge</h3>

                    <p>
                        Showcase your ideas and compete for
                        exciting prizes and recognition.
                    </p>

                    <small>
                        Deadline: December 5, 2026
                    </small>

                </div>


                <a href="#" class="opportunity-arrow">

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </article>


        </div>

    </div>


    <div class="section-button">

        <a href="#">
            Explore All Opportunities
        </a>

    </div>

</section>

<!-- =========================================
     EXPERT INSTRUCTORS
========================================= -->

<section class="expert-instructors">

    <div class="expert-intro">

        <span>LEARN FROM EXPERTS</span>

        <h2>
            Learn From People
            Who Know The Way.
        </h2>

        <p>
            Connect with experienced instructors who bring
            practical knowledge, professional experience and
            real-world insight into every lesson.
        </p>


        <div class="expert-stats">

            <div>

                <strong>250+</strong>

                <span>Expert Instructors</span>

            </div>


            <div>

                <strong>12K+</strong>

                <span>Students Taught</span>

            </div>


            <div>

                <strong>4.9</strong>

                <span>Average Rating</span>

            </div>

        </div>


        <a href="#" class="expert-all-btn">

            Explore Instructors

            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>


    <!-- EXPERT SLIDER -->

    <div class="expert-slider">


        <!-- EXPERT 1 -->

        <div class="expert-slide active">

            <div class="expert-image">

                <img
                    src="images/whitefemaletutor.jpg"
                    alt="Sarah Johnson"
                >

                <span class="expert-number">
                    01
                </span>

            </div>


            <div class="expert-details">

                <span class="expert-specialty">
                    DIGITAL MARKETING
                </span>

                <h3>Sarah Johnson</h3>

                <p>
                    Helping businesses and entrepreneurs build
                    powerful digital brands and marketing strategies.
                </p>


                <div class="expert-rating">

                    <span>⭐ 4.9</span>

                    <span>12 Courses</span>

                    <span>2.4K Students</span>

                </div>


                <a href="#" class="expert-profile-btn">

                    View Profile

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </div>

        </div>


        <!-- EXPERT 2 -->

        <div class="expert-slide">

            <div class="expert-image">

                <img
                    src="images/blackmantutor.jpg"
                    alt="Michael Brown"
                >

                <span class="expert-number">
                    02
                </span>

            </div>


            <div class="expert-details">

                <span class="expert-specialty">
                    UI/UX DESIGN
                </span>

                <h3>Michael Brown</h3>

                <p>
                    Teaching designers how to create beautiful,
                    accessible and user-focused digital experiences.
                </p>


                <div class="expert-rating">

                    <span>⭐ 4.9</span>

                    <span>9 Courses</span>

                    <span>1.8K Students</span>

                </div>


                <a href="#" class="expert-profile-btn">

                    View Profile

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </div>

        </div>


        <!-- EXPERT 3 -->

        <div class="expert-slide">

            <div class="expert-image">

                <img
                    src="images/blackmantutor2.jpg"
                    alt="David Williams"
                >

                <span class="expert-number">
                    03
                </span>

            </div>


            <div class="expert-details">

                <span class="expert-specialty">
                    SOFTWARE ENGINEERING
                </span>

                <h3>David Williams</h3>

                <p>
                    Breaking down complex programming concepts
                    and helping students become confident developers.
                </p>


                <div class="expert-rating">

                    <span>⭐ 5.0</span>

                    <span>18 Courses</span>

                    <span>3.1K Students</span>

                </div>


                <a href="#" class="expert-profile-btn">

                    View Profile

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </div>

        </div>


        <!-- CONTROLS -->

        <button class="expert-prev">

            <i class="fa-solid fa-chevron-left"></i>

        </button>


        <button class="expert-next">

            <i class="fa-solid fa-chevron-right"></i>

        </button>


        <!-- PROGRESS -->

        <div class="expert-progress">

            <span class="expert-progress-current">
                01
            </span>

            <div class="expert-progress-line">

                <span></span>

            </div>

            <span>03</span>

        </div>

    </div>

</section>

<!-- =========================================
     STUDENT SUCCESS STORIES
========================================= -->

<section class="student-success">

    <div class="success-heading">

        <span>STUDENT SUCCESS</span>

        <h2>
            Real People.
            Real Progress.
        </h2>

    </div>


    <div class="success-slider">


        <!-- STORY 1 -->

        <div class="success-slide active">


            <div class="success-quote">

                <span class="quote-mark">“</span>

                <p>
                    Ultimate helped me find the right course
                    and connect with an instructor who completely
                    changed the way I approach technology.
                </p>


                <div class="success-rating">

                    ★★★★★

                </div>


                <h3>
                    Sarah Williams
                </h3>

                <span class="success-role">
                    Software Engineering Student
                </span>


                <div class="success-achievement">

                    <i class="fa-solid fa-graduation-cap"></i>

                    Completed 8 Courses

                </div>

            </div>


            <div class="success-image">

                <div class="success-glow"></div>

                <img
                    src="images/white-female.jpg"
                    alt="Sarah Williams"
                >

                <div class="success-image-label">

                    <span>STUDENT</span>

                    <strong>01</strong>

                </div>

            </div>

        </div>


        <!-- STORY 2 -->

        <div class="success-slide">


            <div class="success-quote">

                <span class="quote-mark">“</span>

                <p>
                    I discovered a scholarship through Ultimate
                    that gave me the opportunity to continue my
                    education without worrying about the cost.
                </p>


                <div class="success-rating">

                    ★★★★★

                </div>


                <h3>
                    David Okafor
                </h3>

                <span class="success-role">
                    Business Administration Student
                </span>


                <div class="success-achievement">

                    <i class="fa-solid fa-award"></i>

                    Scholarship Recipient

                </div>

            </div>


            <div class="success-image">

                <div class="success-glow"></div>

                <img
                    src="images/blackmanstudent.jpg"
                    alt="David Okafor"
                >

                <div class="success-image-label">

                    <span>STUDENT</span>

                    <strong>02</strong>

                </div>

            </div>

        </div>


        <!-- STORY 3 -->

        <div class="success-slide">


            <div class="success-quote">

                <span class="quote-mark">“</span>

                <p>
                    Finding a verified tutor on Ultimate made
                    studying much easier. I finally had someone
                    who could explain difficult concepts clearly.
                </p>


                <div class="success-rating">

                    ★★★★★

                </div>


                <h3>
                    Amaka Eze
                </h3>

                <span class="success-role">
                    Medical Sciences Student
                </span>


                <div class="success-achievement">

                    <i class="fa-solid fa-book-open"></i>

                    Connected With A Tutor

                </div>

            </div>


            <div class="success-image">

                <div class="success-glow"></div>

                <img
                    src="images/blackfemalestudent.jpg"
                    alt="Amaka Eze"
                >

                <div class="success-image-label">

                    <span>STUDENT</span>

                    <strong>03</strong>

                </div>

            </div>

        </div>


        <!-- CONTROLS -->

        <button class="success-prev">

            <i class="fa-solid fa-chevron-left"></i>

        </button>


        <button class="success-next">

            <i class="fa-solid fa-chevron-right"></i>

        </button>


        <!-- PROGRESS -->

        <div class="success-progress">

            <span class="success-current">
                01
            </span>

            <div class="success-progress-line">

                <span></span>

            </div>

            <span>03</span>

        </div>

    </div>

</section>

<!-- =========================================
     CAREER PATHWAYS
========================================= -->

<section class="career-pathways">

    <div class="section-heading">

        <span>YOUR FUTURE STARTS HERE</span>

        <h2>Where Can Your Learning Take You?</h2>

        <p>
            Explore career paths and discover the skills,
            courses and steps needed to reach your goals.
        </p>

    </div>


    <div class="career-container">


        <!-- CAREER NAVIGATION -->

        <div class="career-tabs">

            <button class="career-tab active">

                <i class="fa-solid fa-code"></i>

                Technology

            </button>


            <button class="career-tab">

                <i class="fa-solid fa-chart-line"></i>

                Business

            </button>


            <button class="career-tab">

                <i class="fa-solid fa-pen-ruler"></i>

                Design

            </button>


            <button class="career-tab">

                <i class="fa-solid fa-heart-pulse"></i>

                Healthcare

            </button>

        </div>


        <!-- CAREER CONTENT -->

        <div class="career-content">


            <div class="career-info">

                <span class="career-label">
                    CAREER PATH
                </span>

                <h3>Software Engineering</h3>

                <p>
                    Build the technical skills needed to design,
                    develop and maintain modern software applications.
                </p>


                <div class="career-meta">

                    <span>
                        <i class="fa-solid fa-book"></i>
                        24 Courses
                    </span>

                    <span>
                        <i class="fa-solid fa-clock"></i>
                        6–12 Months
                    </span>

                </div>


                <a href="#" class="career-button">

                    Explore Career Path

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </div>


            <!-- PATHWAY -->

            <div class="career-roadmap">


                <div class="roadmap-line"></div>


                <div class="roadmap-step">

                    <div class="roadmap-number">
                        01
                    </div>

                    <div>

                        <span>START HERE</span>

                        <h4>Programming Fundamentals</h4>

                        <p>
                            Learn the foundations of coding.
                        </p>

                    </div>

                </div>


                <div class="roadmap-step">

                    <div class="roadmap-number">
                        02
                    </div>

                    <div>

                        <span>BUILD SKILLS</span>

                        <h4>Frontend & Backend Development</h4>

                        <p>
                            Build real-world web applications.
                        </p>

                    </div>

                </div>


                <div class="roadmap-step">

                    <div class="roadmap-number">
                        03
                    </div>

                    <div>

                        <span>GO PROFESSIONAL</span>

                        <h4>Professional Software Developer</h4>

                        <p>
                            Apply your skills to real careers.
                        </p>

                    </div>

                </div>


            </div>

        </div>

    </div>

</section>

<!-- =========================================
     STUDENT LEARNING DASHBOARD
========================================= -->

<section class="learning-preview">

    <div class="learning-heading">

        <span>YOUR LEARNING JOURNEY</span>

        <h2>
            Everything You Need
            To Keep Moving Forward.
        </h2>

        <p>
            Track your courses, monitor your progress,
            earn certificates and stay focused on your
            learning goals.
        </p>

    </div>


    <!-- DASHBOARD -->

    <div class="learning-dashboard">


        <!-- TOPBAR -->

        <div class="learning-topbar">

            <div>

                <span class="dashboard-label">
                    MY LEARNING
                </span>

                <h3>
                    Welcome back, Alex
                </h3>

            </div>


            <div class="learning-streak">

                <span>🔥</span>

                <div>

                    <strong>12</strong>

                    <small>
                        Day Streak
                    </small>

                </div>

            </div>

        </div>


        <!-- STATS -->

        <div class="learning-stats">


            <div class="learning-stat">

                <span class="stat-icon">
                    <i class="fa-solid fa-book-open"></i>
                </span>

                <div>

                    <strong>08</strong>

                    <span>Courses</span>

                </div>

            </div>


            <div class="learning-stat">

                <span class="stat-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </span>

                <div>

                    <strong>72%</strong>

                    <span>Progress</span>

                </div>

            </div>


            <div class="learning-stat">

                <span class="stat-icon">
                    <i class="fa-solid fa-certificate"></i>
                </span>

                <div>

                    <strong>04</strong>

                    <span>Certificates</span>

                </div>

            </div>


            <div class="learning-stat">

                <span class="stat-icon">
                    <i class="fa-solid fa-clock"></i>
                </span>

                <div>

                    <strong>36h</strong>

                    <span>Learning Time</span>

                </div>

            </div>


        </div>


        <!-- MAIN DASHBOARD AREA -->

        <div class="learning-main">


            <!-- CONTINUE LEARNING -->

            <div class="continue-learning">

                <div class="dashboard-section-title">

                    <div>

                        <span>CONTINUE LEARNING</span>

                        <h4>
                            Pick up where you left off
                        </h4>

                    </div>

                    <a href="#">
                        View All
                    </a>

                </div>


                <div class="course-progress-card">

                    <div class="course-icon">

                        <i class="fa-solid fa-code"></i>

                    </div>


                    <div class="course-progress-info">

                        <span>
                            SOFTWARE DEVELOPMENT
                        </span>

                        <h4>
                            Full Stack Web Development
                        </h4>

                        <p>
                            HTML • CSS • JavaScript
                        </p>


                        <div class="progress-wrapper">

                            <div class="progress-bar">

                                <span></span>

                            </div>

                            <strong>
                                72%
                            </strong>

                        </div>

                    </div>


                    <a href="#" class="continue-button">

                        <i class="fa-solid fa-play"></i>

                    </a>

                </div>

            </div>


            <!-- ACTIVITY -->

            <div class="learning-activity">

                <div class="dashboard-section-title">

                    <div>

                        <span>RECENT ACTIVITY</span>

                        <h4>
                            Your Progress
                        </h4>

                    </div>

                </div>


                <div class="activity-item">

                    <span class="activity-icon">

                        <i class="fa-solid fa-check"></i>

                    </span>

                    <div>

                        <strong>
                            Completed a lesson
                        </strong>

                        <small>
                            JavaScript Functions
                        </small>

                    </div>

                    <time>
                        2h
                    </time>

                </div>


                <div class="activity-item">

                    <span class="activity-icon">

                        <i class="fa-solid fa-award"></i>

                    </span>

                    <div>

                        <strong>
                            Certificate earned
                        </strong>

                        <small>
                            HTML Fundamentals
                        </small>

                    </div>

                    <time>
                        1d
                    </time>

                </div>


                <div class="activity-item">

                    <span class="activity-icon">

                        <i class="fa-solid fa-fire"></i>

                    </span>

                    <div>

                        <strong>
                            Learning streak
                        </strong>

                        <small>
                            12 days in a row
                        </small>

                    </div>

                    <time>
                        2d
                    </time>

                </div>

            </div>

        </div>


        <!-- BOTTOM -->

        <div class="learning-bottom">

            <span>

                <i class="fa-solid fa-shield-halved"></i>

                Your learning progress is saved automatically.

            </span>


            <a href="#">
                Open Student Dashboard
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>

    </div>

</section>

<!-- =========================================
     EDUCATION MARKETPLACE
========================================= -->

<section class="education-marketplace">

    <div class="marketplace-heading">

        <span>EDUCATION MARKETPLACE</span>

        <h2>Learn. Connect. Grow.</h2>

        <p>
            Discover courses, connect with expert tutors
            and explore institutions built around your goals.
        </p>

    </div>


    <!-- =====================================
         MARKETPLACE TABS
    ====================================== -->

    <div class="marketplace-tabs">

        <button
            class="marketplace-tab active"
            data-market="courses">

            <i class="fa-solid fa-book-open"></i>

            Courses

        </button>


        <button
            class="marketplace-tab"
            data-market="tutors">

            <i class="fa-solid fa-chalkboard-user"></i>

            Personal Tutors

        </button>


        <button
            class="marketplace-tab"
            data-market="institutions">

            <i class="fa-solid fa-building-columns"></i>

            Institutions

        </button>

    </div>



    <!-- =====================================
         COURSES
    ====================================== -->

    <div
        class="marketplace-panel active"
        id="courses-panel">

        <div class="marketplace-carousel">


            <button
                class="marketplace-arrow course-prev">

                <i class="fa-solid fa-chevron-left"></i>

            </button>


            <div class="marketplace-track">


                <!-- COURSE 1 -->

                <div class="marketplace-slide">

                    <div class="course-card">

                        <div class="course-image">

                            <img
                                src="images/web-development.jpg"
                                alt="Web Development Course">

                            <span>
                                BEST SELLER
                            </span>

                        </div>


                        <div class="course-content">

                            <small>
                                SOFTWARE DEVELOPMENT
                            </small>

                            <h3>
                                Full Stack Web Development
                            </h3>

                            <p>
                                Learn HTML, CSS, JavaScript,
                                PHP and modern web development.
                            </p>


                            <div class="course-rating">

                                <strong>4.9</strong>

                                <span>★★★★★</span>

                                <small>
                                    2.3k students
                                </small>

                            </div>


                            <div class="course-bottom">

                                <strong>
                                    ₦25,000
                                </strong>

                                <a href="#">
                                    Explore
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- COURSE 2 -->

                <div class="marketplace-slide">

                    <div class="course-card">

                        <div class="course-image">

                            <img
                                src="images/ux-design.jpg"
                                alt="UI UX Course">

                        </div>


                        <div class="course-content">

                            <small>
                                DESIGN
                            </small>

                            <h3>
                                UI/UX Design Masterclass
                            </h3>

                            <p>
                                Learn user research, wireframes,
                                prototypes and modern interface design.
                            </p>


                            <div class="course-rating">

                                <strong>4.8</strong>

                                <span>★★★★★</span>

                                <small>
                                    1.8k students
                                </small>

                            </div>


                            <div class="course-bottom">

                                <strong>
                                    ₦18,500
                                </strong>

                                <a href="#">
                                    Explore
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- COURSE 3 -->

                <div class="marketplace-slide">

                    <div class="course-card">

                        <div class="course-image">

                            <img
                                src="images/digital-marketing2.jpg"
                                alt="Digital Marketing Course">

                        </div>


                        <div class="course-content">

                            <small>
                                BUSINESS
                            </small>

                            <h3>
                                Digital Marketing Strategy
                            </h3>

                            <p>
                                Master social media, SEO, advertising
                                and modern digital marketing.
                            </p>


                            <div class="course-rating">

                                <strong>4.9</strong>

                                <span>★★★★★</span>

                                <small>
                                    950 students
                                </small>

                            </div>


                            <div class="course-bottom">

                                <strong>
                                    ₦15,000
                                </strong>

                                <a href="#">
                                    Explore
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- COURSE 4 -->

                <div class="marketplace-slide">

                    <div class="course-card">

                        <div class="course-image">

                            <img
                                src="images/digitalmarketing.jpg"
                                alt="Data Science Course">

                        </div>


                        <div class="course-content">

                            <small>
                                TECHNOLOGY
                            </small>

                            <h3>
                                Data Science & AI
                            </h3>

                            <p>
                                Learn data analysis, machine learning
                                and artificial intelligence.
                            </p>


                            <div class="course-rating">

                                <strong>4.7</strong>

                                <span>★★★★★</span>

                                <small>
                                    1.2k students
                                </small>

                            </div>


                            <div class="course-bottom">

                                <strong>
                                    ₦30,000
                                </strong>

                                <a href="#">
                                    Explore
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <button
                class="marketplace-arrow course-next">

                <i class="fa-solid fa-chevron-right"></i>

            </button>

        </div>


        <div class="carousel-dots course-dots"></div>

    </div>



    <!-- =====================================
         PERSONAL TUTORS
    ====================================== -->

    <div
        class="marketplace-panel"
        id="tutors-panel">

        <div class="marketplace-carousel">


            <button
                class="marketplace-arrow tutor-prev">

                <i class="fa-solid fa-chevron-left"></i>

            </button>


            <div class="marketplace-track">


                <!-- TUTOR 1 -->

                <div class="marketplace-slide">

                    <div class="tutor-card">

                        <div class="tutor-image">

                            <img
                                src="images/blackmantutor.jpg"
                                alt="David Okafor">

                            <span class="verified-tutor">

                                <i class="fa-solid fa-check"></i>

                            </span>

                        </div>


                        <div class="tutor-content">

                            <small>
                                MATHEMATICS • JAMB • WAEC
                            </small>

                            <h3>
                                David Okafor
                            </h3>

                            <p>
                                Mathematics and Further Mathematics
                                tutor with 7+ years experience.
                            </p>


                            <div class="tutor-rating">

                                <strong>4.9</strong>

                                <span>★★★★★</span>

                                <small>
                                    126 reviews
                                </small>

                            </div>


                            <div class="tutor-bottom">

                                <div>

                                    <strong>
                                        ₦8,000
                                    </strong>

                                    <span>
                                        / hour
                                    </span>

                                </div>

                                <a href="#">
                                    Book Tutor
                                </a>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- TUTOR 2 -->

                <div class="marketplace-slide">

                    <div class="tutor-card">

                        <div class="tutor-image">

                            <img
                                src="images/whitefemaletutor.jpg"
                                alt="Sarah Williams">

                            <span class="verified-tutor">

                                <i class="fa-solid fa-check"></i>

                            </span>

                        </div>


                        <div class="tutor-content">

                            <small>
                                ENGLISH • IELTS • TOEFL
                            </small>

                            <h3>
                                Sarah Williams
                            </h3>

                            <p>
                                English language coach helping
                                students reach their academic goals.
                            </p>


                            <div class="tutor-rating">

                                <strong>5.0</strong>

                                <span>★★★★★</span>

                                <small>
                                    98 reviews
                                </small>

                            </div>


                            <div class="tutor-bottom">

                                <div>

                                    <strong>
                                        ₦6,500
                                    </strong>

                                    <span>
                                        / hour
                                    </span>

                                </div>

                                <a href="#">
                                    Book Tutor
                                </a>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- TUTOR 3 -->

                <div class="marketplace-slide">

                    <div class="tutor-card">

                        <div class="tutor-image">

                            <img
                                class="black-student"
                                src="images/blackfemalestudent.jpg"
                                alt="Amaka Eze">

                            <span class="verified-tutor">

                                <i class="fa-solid fa-check"></i>

                            </span>

                        </div>


                        <div class="tutor-content">

                            <small>
                                CHEMISTRY • BIOLOGY
                            </small>

                            <h3>
                                Amaka Eze
                            </h3>

                            <p>
                                Medical sciences tutor specializing
                                in exam preparation.
                            </p>


                            <div class="tutor-rating">

                                <strong>4.8</strong>

                                <span>★★★★★</span>

                                <small>
                                    84 reviews
                                </small>

                            </div>


                            <div class="tutor-bottom">

                                <div>

                                    <strong>
                                        ₦7,000
                                    </strong>

                                    <span>
                                        / hour
                                    </span>

                                </div>

                                <a href="#">
                                    Book Tutor
                                </a>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- TUTOR 4 -->

                <div class="marketplace-slide">

                    <div class="tutor-card">

                        <div class="tutor-image">

                            <img
                                src="images/blackmantutor2.jpg"
                                alt="John Ade">

                            <span class="verified-tutor">

                                <i class="fa-solid fa-check"></i>

                            </span>

                        </div>


                        <div class="tutor-content">

                            <small>
                                PHYSICS • MATHEMATICS
                            </small>

                            <h3>
                                John Ade
                            </h3>

                            <p>
                                Experienced science tutor helping
                                students prepare for major examinations.
                            </p>


                            <div class="tutor-rating">

                                <strong>4.9</strong>

                                <span>★★★★★</span>

                                <small>
                                    72 reviews
                                </small>

                            </div>


                            <div class="tutor-bottom">

                                <div>

                                    <strong>
                                        ₦7,500
                                    </strong>

                                    <span>
                                        / hour
                                    </span>

                                </div>

                                <a href="#">
                                    Book Tutor
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <button
                class="marketplace-arrow tutor-next">

                <i class="fa-solid fa-chevron-right"></i>

            </button>

        </div>


        <div class="carousel-dots tutor-dots"></div>

    </div>



    <!-- =====================================
         INSTITUTIONS
    ====================================== -->

    <div
        class="marketplace-panel"
        id="institutions-panel">

        <div class="marketplace-carousel">


            <button
                class="marketplace-arrow institution-prev">

                <i class="fa-solid fa-chevron-left"></i>

            </button>


            <div class="marketplace-track">


                <!-- INSTITUTION 1 -->

                <div class="marketplace-slide">

                    <div class="institution-card">

                        <div class="institution-image">

                            <img
                                src="images/ultimate-uni.jpg"
                                alt="University">

                        </div>


                        <div class="institution-content">

                            <small>
                                UNIVERSITY
                            </small>

                            <h3>
                                University of Lagos
                            </h3>

                            <p>
                                Explore undergraduate and postgraduate
                                programmes across multiple disciplines.
                            </p>


                            <div class="institution-meta">

                                <span>
                                    <i class="fa-solid fa-location-dot"></i>
                                    Lagos
                                </span>

                                <span>
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    120+ Programmes
                                </span>

                            </div>


                            <a href="#">
                                Explore Institution
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </div>

                </div>



                <!-- INSTITUTION 2 -->

                <div class="marketplace-slide">

                    <div class="institution-card">

                        <div class="institution-image">

                            <img
                                src="images/digital-academy.jpg"
                                alt="Technology Academy">

                        </div>


                        <div class="institution-content">

                            <small>
                                TRAINING INSTITUTE
                            </small>

                            <h3>
                                Tech Academy
                            </h3>

                            <p>
                                Professional technology training,
                                certifications and practical programmes.
                            </p>


                            <div class="institution-meta">

                                <span>
                                    <i class="fa-solid fa-location-dot"></i>
                                    Abuja
                                </span>

                                <span>
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    35 Programmes
                                </span>

                            </div>


                            <a href="#">
                                Explore Institution
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </div>

                </div>



                <!-- INSTITUTION 3 -->

                <div class="marketplace-slide">

                    <div class="institution-card">

                        <div class="institution-image">

                            <img
                                src="images/future-skills.jpg"
                                alt="Business School">

                        </div>


                        <div class="institution-content">

                            <small>
                                BUSINESS SCHOOL
                            </small>

                            <h3>
                                Lagos Business School
                            </h3>

                            <p>
                                Executive education and professional
                                development programmes.
                            </p>


                            <div class="institution-meta">

                                <span>
                                    <i class="fa-solid fa-location-dot"></i>
                                    Lagos
                                </span>

                                <span>
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    40+ Programmes
                                </span>

                            </div>


                            <a href="#">
                                Explore Institution
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </div>

                </div>

            </div>


            <button
                class="marketplace-arrow institution-next">

                <i class="fa-solid fa-chevron-right"></i>

            </button>

        </div>


        <div class="carousel-dots institution-dots"></div>

    </div>

</section>

<!-- =========================================
     BATCH 12 — KNOWLEDGE NETWORK
========================================= -->

<section class="knowledge-network">


    <!-- HEADER -->

    <div class="knowledge-heading">

        <span>THE KNOWLEDGE NETWORK</span>

        <h2>
            Your knowledge
            <br>
            <strong>has value.</strong>
        </h2>

        <p>
            Connect what you know with someone
            who is ready to learn it.
        </p>

    </div>


    <!-- =====================================
         VISUAL NETWORK
    ====================================== -->

    <div class="knowledge-visual">


        <!-- CONNECTION LINES -->

        <div class="network-line line-one"></div>

        <div class="network-line line-two"></div>

        <div class="network-line line-three"></div>

        <div class="network-line line-four"></div>


        <!-- FLOATING SUBJECTS -->

        <div class="knowledge-tag tag-one">
            JAMB
        </div>

        <div class="knowledge-tag tag-two">
            CODING
        </div>

        <div class="knowledge-tag tag-three">
            IELTS
        </div>

        <div class="knowledge-tag tag-four">
            MATHEMATICS
        </div>


        <!-- TUTOR CARD -->

        <div class="network-profile tutor-profile">

            <div class="profile-avatar">

                <img
                    src="images/blackmantutor.jpg"
                    alt="Tutor">

            </div>

            <div>

                <small>VERIFIED TUTOR</small>

                <strong>
                    David Okafor
                </strong>

                <span>
                    Mathematics
                </span>

            </div>

            <div class="profile-rating">

                ★ 4.9

            </div>

        </div>


        <!-- STUDENT CARD -->

        <div class="network-profile student-profile">

            <div class="profile-avatar student-avatar">

                <i class="fa-solid fa-user-graduate"></i>

            </div>

            <div>

                <small>LEARNING</small>

                <strong>
                    Chiamaka
                </strong>

                <span>
                    JAMB Preparation
                </span>

            </div>

        </div>


        <!-- CENTRAL ORB -->

        <div class="knowledge-core">


            <div class="core-ring ring-one"></div>

            <div class="core-ring ring-two"></div>

            <div class="core-ring ring-three"></div>


            <div class="core-center">

                <i class="fa-solid fa-graduation-cap"></i>

                <strong>
                    KNOWLEDGE
                </strong>

                <span>
                    CONNECTED
                </span>

            </div>


        </div>


        <!-- FLOATING ICONS -->

        <div class="floating-icon icon-one">

            <i class="fa-solid fa-book"></i>

        </div>


        <div class="floating-icon icon-two">

            <i class="fa-solid fa-code"></i>

        </div>


        <div class="floating-icon icon-three">

            <i class="fa-solid fa-language"></i>

        </div>


        <div class="floating-icon icon-four">

            <i class="fa-solid fa-calculator"></i>

        </div>


    </div>



    <!-- =====================================
         CTA
    ====================================== -->

    <div class="knowledge-cta">

        <div>

            <span>
                FOR EDUCATORS
            </span>

            <h3>
                Turn what you know
                into opportunity.
            </h3>

            <p>
                Create your profile, showcase your expertise,
                connect with students and build your teaching
                business on Ultimate.
            </p>

        </div>


        <a href="#" class="knowledge-button">

            Become a Tutor

            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>



    <!-- =====================================
         HOW IT WORKS
    ====================================== -->

    <div class="knowledge-steps">


        <div class="knowledge-step">

            <span>01</span>

            <i class="fa-solid fa-user-plus"></i>

            <h4>
                Create Profile
            </h4>

            <p>
                Tell students what you teach.
            </p>

        </div>


        <div class="knowledge-step">

            <span>02</span>

            <i class="fa-solid fa-shield-check"></i>

            <h4>
                Get Verified
            </h4>

            <p>
                Build trust with your credentials.
            </p>

        </div>


        <div class="knowledge-step">

            <span>03</span>

            <i class="fa-solid fa-chalkboard-user"></i>

            <h4>
                Start Teaching
            </h4>

            <p>
                Connect with students.
            </p>

        </div>


        <div class="knowledge-step">

            <span>04</span>

            <i class="fa-solid fa-wallet"></i>

            <h4>
                Get Paid
            </h4>

            <p>
                Turn your expertise into income.
            </p>

        </div>


    </div>

</section>

<!-- =========================================
     FINAL CTA
========================================= -->

<section class="education-final-cta">

    <div class="cta-glow cta-glow-one"></div>
    <div class="cta-glow cta-glow-two"></div>

    <div class="cta-content">

        <span class="cta-label">
            YOUR NEXT CHAPTER STARTS HERE
        </span>

        <h2>
            Learn something.
            <br>
            <strong>Build something.</strong>
        </h2>

        <p>
            Discover courses, connect with expert tutors,
            find the right institution and turn your
            learning goals into real opportunities.
        </p>

        <div class="cta-buttons">

            <a href="#" class="cta-primary">
                Start Learning
                <i class="fa-solid fa-arrow-right"></i>
            </a>

            <a href="#" class="cta-secondary">
                Become a Tutor
            </a>

        </div>

    </div>


    <div class="cta-orbit orbit-one"></div>
    <div class="cta-orbit orbit-two"></div>

    <div class="cta-floating-card card-top">

        <i class="fa-solid fa-graduation-cap"></i>

        <span>
            Keep Learning
        </span>

    </div>

    <div class="cta-floating-card card-bottom">

        <i class="fa-solid fa-star"></i>

        <span>
            Grow Your Skills
        </span>

    </div>

</section>



<!-- =========================================
     PREMIUM EDUCATION FOOTER
========================================= -->

<footer class="education-footer">


    <div class="footer-main">


        <!-- BRAND -->

        <div class="footer-brand">

            <a href="#" class="footer-logo">
                ULTIMATE<span>.</span>
            </a>

            <p>
                A smarter way to discover knowledge,
                connect with educators and build
                your future.
            </p>


            <div class="footer-socials">

                <a href="#">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>

                <a href="#">
                    <i class="fa-brands fa-instagram"></i>
                </a>

                <a href="#">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>

                <a href="#">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>

            </div>

        </div>



        <!-- EXPLORE -->

        <div class="footer-column">

            <h4>
                Explore
            </h4>

            <a href="#">
                Courses
            </a>

            <a href="#">
                Tutors
            </a>

            <a href="#">
                Institutions
            </a>

            <a href="#">
                Learning Paths
            </a>

        </div>



        <!-- FOR EDUCATORS -->

        <div class="footer-column">

            <h4>
                For Educators
            </h4>

            <a href="#">
                Become a Tutor
            </a>

            <a href="#">
                Create a Course
            </a>

            <a href="#">
                Institution Listing
            </a>

            <a href="#">
                Educator Resources
            </a>

        </div>



        <!-- SUPPORT -->

        <div class="footer-column">

            <h4>
                Support
            </h4>

            <a href="#">
                Help Center
            </a>

            <a href="#">
                Contact Us
            </a>

            <a href="#">
                Safety & Trust
            </a>

            <a href="#">
                Terms & Privacy
            </a>

        </div>



        <!-- NEWSLETTER -->

        <div class="footer-newsletter">

            <h4>
                Stay in the loop.
            </h4>

            <p>
                Get useful learning resources,
                opportunities and updates.
            </p>

            <form class="footer-subscribe">

                <input
                    type="email"
                    placeholder="Your email address"
                >

                <button type="submit">

                    <i class="fa-solid fa-arrow-right"></i>

                </button>

            </form>

        </div>

    </div>



    <!-- FOOTER BOTTOM -->

    <div class="footer-bottom">

        <span>
            © 2026 Ultimate. All rights reserved.
        </span>

        <span>
            Built for learners. Built for educators.
        </span>

    </div>


</footer>




    <script src="js/script.js?v=2"></script>

</body>
</html>