
<?php

session_start();

if(!isset($_SESSION["admin_id"])){
    header("Location: login.php");
    exit();
}

$currentPage = "categories";

require_once "../config.php";


/* =========================================
   GET EVENTS CATEGORY ID
========================================= */

$categoryId = (int)($_GET["id"] ?? 0);

if($categoryId <= 0){

    header("Location: categories.php");
    exit();

}


/* =========================================
   FETCH MAIN EVENTS CATEGORY
========================================= */

$categoryQuery = "
    SELECT
        id,
        title
    FROM categories
    WHERE id = ?
    LIMIT 1
";

$stmt = mysqli_prepare($conn, $categoryQuery);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $categoryId
);

mysqli_stmt_execute($stmt);

$categoryResult = mysqli_stmt_get_result($stmt);

$category = mysqli_fetch_assoc($categoryResult);

mysqli_stmt_close($stmt);


if(!$category){

    header("Location: categories.php");
    exit();

}


/* =========================================
   FETCH EVENT CATEGORIES
========================================= */

$eventCategoryQuery = "
    SELECT
        id,
        category_id,
        name,
        slug,
        short_description,
        icon,
        image,
        status,
        created_at
    FROM event_categories
    WHERE category_id = ?
    ORDER BY created_at DESC
";

$stmt = mysqli_prepare($conn, $eventCategoryQuery);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $categoryId
);

mysqli_stmt_execute($stmt);

$eventCategoryResult = mysqli_stmt_get_result($stmt);

$eventCategories = [];

while($row = mysqli_fetch_assoc($eventCategoryResult)){

    $eventCategories[] = $row;

}

mysqli_stmt_close($stmt);


/* =========================================
   COUNT
========================================= */

$totalCategories = count($eventCategories);

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
        Event Categories | Ultimate
    </title>


    <link
        rel="stylesheet"
        href="assets/css/admin.css"
    >

    <link
        rel="stylesheet"
        href="assets/css/events-categories.css"
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


    <div class="events-categories-content">


        <!-- =================================
             PAGE HEADER
        ================================== -->

        <section class="events-categories-header">


            <div class="header-left">


                <a
                    href="events-category-dashboard.php?id=<?= $categoryId; ?>"
                    class="back-link"
                >

                    <i class="fa-solid fa-arrow-left"></i>

                    Events Dashboard

                </a>


                <span class="page-eyebrow">
                    EVENTS DEPARTMENT
                </span>


                <h1>
                    Event Categories
                </h1>


                <p>
                    Organize the Events marketplace into clear categories
                    such as Weddings, Concerts, Conferences and more.
                </p>


            </div>


            <div class="header-action">

                <a
                    href="add-event-category.php?id=<?= $categoryId; ?>"
                    class="add-category-button"
                >

                    <i class="fa-solid fa-plus"></i>

                    Add Event Category

                </a>

            </div>


        </section>



        <!-- =================================
             CATEGORY SUMMARY
        ================================== -->

        <div class="category-summary">


            <div class="summary-icon">

                <i class="fa-solid fa-layer-group"></i>

            </div>


            <div>

                <span>
                    TOTAL EVENT CATEGORIES
                </span>

                <strong>
                    <?= $totalCategories; ?>
                </strong>

            </div>


        </div>



        <!-- =================================
             EVENT CATEGORIES
        ================================== -->

        <?php if(empty($eventCategories)): ?>


            <section class="empty-state">


                <div class="empty-icon">

                    <i class="fa-solid fa-calendar-xmark"></i>

                </div>


                <h2>
                    No Event Categories Yet
                </h2>


                <p>
                    Create your first event category to begin organizing
                    the Events marketplace.
                </p>


                <a
                    href="add-event-category.php?id=<?= $categoryId; ?>"
                    class="empty-action"
                >

                    <i class="fa-solid fa-plus"></i>

                    Create Event Category

                </a>


            </section>


        <?php else: ?>


            <section class="event-category-grid">


                <?php foreach($eventCategories as $eventCategory): ?>


                    <article class="event-category-card">


                        <!-- IMAGE -->

                        <div class="event-category-image">


                            <?php if(!empty($eventCategory["image"])): ?>

                                <img
                                    src="<?= htmlspecialchars($eventCategory["image"]); ?>"
                                    alt="<?= htmlspecialchars($eventCategory["name"]); ?>"
                                >

                            <?php else: ?>

                                <div class="image-placeholder">

                                    <i class="fa-solid fa-calendar-days"></i>

                                </div>

                            <?php endif; ?>


                            <span
                                class="category-status
                                <?= strtolower($eventCategory["status"]); ?>"
                            >

                                <?= htmlspecialchars($eventCategory["status"]); ?>

                            </span>


                        </div>



                        <!-- CONTENT -->

                        <div class="event-category-card-content">


                            <div class="event-category-icon">

                                <i class="<?= htmlspecialchars($eventCategory["icon"] ?: "fa-solid fa-calendar-days"); ?>"></i>

                            </div>


                            <h2>
                                <?= htmlspecialchars($eventCategory["name"]); ?>
                            </h2>


                            <p>

                                <?= htmlspecialchars(
                                    $eventCategory["short_description"]
                                    ?: "No description available."
                                ); ?>

                            </p>


                            <span class="category-created">

                                <i class="fa-regular fa-calendar"></i>

                                Created
                                <?= date(
                                    "M d, Y",
                                    strtotime($eventCategory["created_at"])
                                ); ?>

                            </span>


                        </div>



                        <!-- ACTIONS -->

                        <div class="event-category-actions">


                            <a
                                href="event-category-details.php?id=<?= (int)$eventCategory["id"]; ?>"
                                class="view-category"
                            >

                                <i class="fa-solid fa-eye"></i>

                                View Listings

                            </a>


                            <a
                                href="edit-event-category.php?id=<?= (int)$eventCategory["id"]; ?>"
                                class="edit-category"
                            >

                                <i class="fa-solid fa-pen"></i>

                            </a>


                            <a
                                href="delete-event-category.php?id=<?= (int)$eventCategory["id"]; ?>"
                                class="delete-category"
                                title="Delete Category"
                            >

                                <i class="fa-solid fa-trash"></i>

                            </a>


                        </div>


                    </article>


                <?php endforeach; ?>


            </section>


        <?php endif; ?>


    </div>


    <?php include "includes/footer.php"; ?>


</main>


</body>

</html>

