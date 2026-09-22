```php
<?php

session_start();

if(!isset($_SESSION["admin_id"])){
    header("Location: login.php");
    exit();
}

$currentPage = "categories";

require_once "../config.php";


/* =========================================
   GET CATEGORY ID
========================================= */

$categoryId = (int)($_GET["id"] ?? 0);

if($categoryId <= 0){
    header("Location: categories.php");
    exit();
}


/* =========================================
   FETCH CATEGORY
========================================= */

$categoryQuery = "
    SELECT
        id,
        title,
        description,
        icon,
        image,
        dashboard_link
    FROM categories
    WHERE id = ?
    LIMIT 1
";

$stmt = mysqli_prepare($conn, $categoryQuery);

if(!$stmt){
    die("Database error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $categoryId
);

mysqli_stmt_execute($stmt);

$categoryResult = mysqli_stmt_get_result($stmt);

$category = mysqli_fetch_assoc($categoryResult);

mysqli_stmt_close($stmt);


/* =========================================
   MAKE SURE CATEGORY EXISTS
========================================= */

if(!$category){
    header("Location: categories.php");
    exit();
}

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
        <?= htmlspecialchars($category["title"]); ?> Dashboard | Ultimate
    </title>


    <link
        rel="stylesheet"
        href="assets/css/admin.css"
    >

    <link
        rel="stylesheet"
        href="assets/css/events-category-dashboard.css"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

</head>


<body>


<?php include "includes/sidebar.php"; ?>


<main class="admin-main">


    <?php include "includes/topbar.php"; ?>


    <div class="events-dashboard-content">


        <!-- =================================
             DASHBOARD HEADER
        ================================== -->

        <section class="events-dashboard-header">


            <div class="events-header-left">


                <a
                    href="categories.php"
                    class="back-category-link"
                >

                    <i class="fa-solid fa-arrow-left"></i>

                    Back to Categories

                </a>


                <div class="events-title-row">


                    <div class="events-category-icon">

                        <i class="<?= htmlspecialchars($category["icon"]); ?>"></i>

                    </div>


                    <div>

                        <span class="events-eyebrow">
                            CATEGORY DEPARTMENT
                        </span>

                        <h1>
                            <?= htmlspecialchars($category["title"]); ?>
                            Dashboard
                        </h1>

                        <p>
                            <?= htmlspecialchars($category["description"]); ?>
                        </p>

                    </div>


                </div>


            </div>


            <div class="events-header-status">

                <span class="status-dot"></span>

                Department Active

            </div>


        </section>



        <!-- =================================
             MANAGEMENT OVERVIEW
        ================================== -->

        <section class="dashboard-section">


            <div class="section-title">

                <div>

                    <span class="section-eyebrow">
                        MANAGEMENT
                    </span>

                    <h2>
                        Events Department
                    </h2>

                    <p>
                        Manage everything related to the Events category
                        from this department.
                    </p>

                </div>

            </div>



            <div class="management-grid">


                <!-- EVENT CATEGORIES -->

                <a
                    href="events-categories.php?id=<?= $categoryId; ?>"
                    class="management-card"
                >

                    <div class="management-icon">

                        <i class="fa-solid fa-layer-group"></i>

                    </div>


                    <div class="management-info">

                        <h3>
                            Event Categories
                        </h3>

                        <p>
                            Create and manage the different types of events
                            available on Ultimate.
                        </p>

                    </div>


                    <span class="management-arrow">

                        <i class="fa-solid fa-arrow-right"></i>

                    </span>

                </a>



                <!-- EVENTS -->

                <a
                    href="events.php?id=<?= $categoryId; ?>"
                    class="management-card"
                >

                    <div class="management-icon">

                        <i class="fa-solid fa-calendar-days"></i>

                    </div>


                    <div class="management-info">

                        <h3>
                            Events
                        </h3>

                        <p>
                            View and manage events submitted to the
                            Ultimate marketplace.
                        </p>

                    </div>


                    <span class="management-arrow">

                        <i class="fa-solid fa-arrow-right"></i>

                    </span>

                </a>



                <!-- VENDOR LISTINGS -->

                <a
                    href="events-vendor-listings.php?id=<?= $categoryId; ?>"
                    class="management-card"
                >

                    <div class="management-icon">

                        <i class="fa-solid fa-store"></i>

                    </div>


                    <div class="management-info">

                        <h3>
                            Vendor Listings
                        </h3>

                        <p>
                            Review and manage approved vendor listings
                            connected to Events.
                        </p>

                    </div>


                    <span class="management-arrow">

                        <i class="fa-solid fa-arrow-right"></i>

                    </span>

                </a>



                <!-- REVIEWS -->

                <a
                    href="events-reviews.php?id=<?= $categoryId; ?>"
                    class="management-card"
                >

                    <div class="management-icon">

                        <i class="fa-solid fa-star"></i>

                    </div>


                    <div class="management-info">

                        <h3>
                            Reviews
                        </h3>

                        <p>
                            Monitor customer reviews and feedback
                            relating to Events.
                        </p>

                    </div>


                    <span class="management-arrow">

                        <i class="fa-solid fa-arrow-right"></i>

                    </span>

                </a>


            </div>


        </section>



        <!-- =================================
             QUICK ACTIONS
        ================================== -->

        <section class="dashboard-section">


            <div class="section-title">

                <div>

                    <span class="section-eyebrow">
                        QUICK ACTIONS
                    </span>

                    <h2>
                        Manage Events
                    </h2>

                </div>

            </div>



            <div class="quick-actions">


                <a
                    href="add-event-category.php?id=<?= $categoryId; ?>"
                    class="quick-action primary"
                >

                    <i class="fa-solid fa-plus"></i>

                    <span>
                        Add Event Category
                    </span>

                </a>


                <a
                    href="add-event.php?id=<?= $categoryId; ?>"
                    class="quick-action"
                >

                    <i class="fa-solid fa-calendar-plus"></i>

                    <span>
                        Add Event
                    </span>

                </a>


                <a
                    href="categories.php"
                    class="quick-action"
                >

                    <i class="fa-solid fa-folder-open"></i>

                    <span>
                        All Categories
                    </span>

                </a>


            </div>


        </section>



        <!-- =================================
             CATEGORY INFORMATION
        ================================== -->

        <section class="category-information">


            <div class="category-information-image">

                <?php if(!empty($category["image"])): ?>

                    <img
                        src="<?= htmlspecialchars($category["image"]); ?>"
                        alt="<?= htmlspecialchars($category["title"]); ?>"
                    >

                <?php endif; ?>

            </div>


            <div class="category-information-content">

                <span class="section-eyebrow">
                    CATEGORY INFORMATION
                </span>

                <h2>
                    <?= htmlspecialchars($category["title"]); ?>
                </h2>

                <p>
                    <?= htmlspecialchars($category["description"]); ?>
                </p>


                <div class="category-meta">

                    <div>

                        <span>
                            Category ID
                        </span>

                        <strong>
                            #<?= $categoryId; ?>
                        </strong>

                    </div>


                    <div>

                        <span>
                            Dashboard
                        </span>

                        <strong>
                            Events Department
                        </strong>

                    </div>

                </div>

            </div>


        </section>


    </div>


    <?php include "includes/footer.php"; ?>


</main>


</body>

</html>


