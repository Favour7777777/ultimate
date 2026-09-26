
<?php

require "../config.php";

/* =========================================
   FETCH ALL CATEGORIES + ACTIVE SERVICES COUNT
========================================= */

$query = "
    SELECT
        categories.id,
        categories.title,
        categories.description,
        categories.icon,
        categories.image,

        COUNT(
            CASE
                WHEN services.status = 'Active'
                THEN services.id
            END
        ) AS total_services

    FROM categories

    LEFT JOIN services
        ON services.category_id = categories.id

    GROUP BY categories.id

    ORDER BY categories.title ASC
";

$result = mysqli_query($conn, $query);

$categories = [];

while($row = mysqli_fetch_assoc($result)){
    $categories[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../styles.css">
<link rel="stylesheet" href="css/services.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<?php include "../includes/navbar.php"; ?>

<!-- CATEGORIES -->

<section class="services-categories">

    <div class="section-heading">

        <span>BROWSE</span>

        <h2>Service Categories</h2>

        <p>
            Choose a category to discover available services.
        </p>

    </div>


    <div class="services-grid">

        <?php foreach($categories as $category): ?>

             <a
        href="<?=
            in_array($category["title"], ["Technology", "Beauty", "Education","Food", "Events", "Fashion", "real-estate"])
            ? "service-category-listings.php?id=" . $category["id"]
            : "../coming-soon.php";
        ?>"
        class="service-category-card"
                >

            <div class="category-image">

                <img
                    src="../admin/<?= htmlspecialchars($category["image"]); ?>"
                    alt="<?= htmlspecialchars($category["title"]); ?>"
                >

                <div class="image-overlay"></div>

            </div>


            <div class="category-content">

                <div class="category-icon">

                    <i class="<?= htmlspecialchars($category["icon"]); ?>"></i>

                </div>

                <h3>
                    <?= htmlspecialchars($category["title"]); ?>
                </h3>

                <p>
                    <?= htmlspecialchars($category["description"]); ?>
                </p>


                <div class="category-footer">

                    <span class="service-count">

                        <?= (int)$category["total_services"]; ?>

                        Service<?= $category["total_services"] == 1 ? "" : "s"; ?>

                    </span>

                    <span class="explore-link">

                        Explore

                        <i class="fa-solid fa-arrow-right"></i>

                    </span>

                </div>

            </div>

        </a>

        <?php endforeach; ?>

    </div>

</section>


<?php include "../includes/footer.php"; ?>

</body>
</html>