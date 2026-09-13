
<?php

require_once "../auth.php";


/*
=========================================
    GET CURRENT USER ID
=========================================
*/

$userId = $_SESSION["user_id"];


/*
=========================================
    GET GENERAL WEBSITE REVIEW
=========================================
*/

$reviewQuery = "
    SELECT
        id,
        rating,
        review,
        admin_reply,
        created_at,
        replied_at
    FROM reviews
    WHERE user_id = ?
    LIMIT 1
";


$stmt = mysqli_prepare(
    $conn,
    $reviewQuery
);


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $userId
);


mysqli_stmt_execute($stmt);


$reviewResult =
    mysqli_stmt_get_result($stmt);


$generalReview =
    mysqli_fetch_assoc($reviewResult);


mysqli_stmt_close($stmt);


/*
=========================================
    PRODUCT / SERVICE REVIEW COUNTS
=========================================
*/

$productReviewCount = 0;

$serviceReviewCount = 0;


/*
=========================================
    GENERAL REVIEW COUNT
=========================================
*/

$generalReviewCount =
    $generalReview ? 1 : 0;


/*
=========================================
    TOTAL REVIEWS
=========================================
*/

$totalReviews =
    $productReviewCount +
    $serviceReviewCount +
    $generalReviewCount;

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>My Reviews | Ultimate</title>


    <link
        rel="stylesheet"
        href="css/dashboard.css"
    >

    <link
        rel="stylesheet"
        href="css/reviews.css"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

</head>


<body>


<div class="dashboard">


    <?php include "includes/sidebar.php"; ?>


    <main class="main">


        <?php include "includes/topbar.php"; ?>


        <div class="content">


            <!-- =========================================
                    PAGE HEADER
            ========================================== -->

            <div class="page-header">

                <div>

                    <span class="section-label">
                        FEEDBACK & EXPERIENCE
                    </span>

                    <h1>
                        My Reviews
                    </h1>

                    <p>
                        Manage the reviews you have shared
                        with Ultimate.
                    </p>

                </div>


                <div class="review-total">

                    <span>
                        Total Reviews
                    </span>

                    <strong>
                        <?= $totalReviews; ?>
                    </strong>

                </div>

            </div>



            <!-- =========================================
                    REVIEW SECTIONS
            ========================================== -->

            <div class="review-sections">


                <!-- =====================================
                        PRODUCT & SERVICE REVIEWS
                ====================================== -->

                <div class="review-card">


                    <div class="review-card-header">

                        <div class="review-icon">

                            <i class="fa-solid fa-bag-shopping"></i>

                        </div>


                        <div>

                            <h2>
                                Product & Service Reviews
                            </h2>

                            <p>
                                Reviews you leave for products
                                and services.
                            </p>

                        </div>


                        <span class="review-count">

                            <?= $productReviewCount + $serviceReviewCount; ?>

                        </span>

                    </div>



                    <div class="empty-review">

                        <i class="fa-regular fa-comment-dots"></i>

                        <h3>
                            No product or service reviews yet
                        </h3>

                        <p>
                            Your product and service reviews
                            will appear here.
                        </p>

                    </div>


                </div>



                <!-- =====================================
                        GENERAL WEBSITE REVIEW
                ====================================== -->

                <div class="review-card general-review-card">


                    <div class="review-card-header">


                        <div class="review-icon">

                            <i class="fa-solid fa-star"></i>

                        </div>


                        <div>

                            <h2>
                                General Website Review
                            </h2>

                            <p>
                                Share your overall experience
                                with Ultimate.
                            </p>

                        </div>


                        <span class="review-count">

                            <?= $generalReviewCount; ?>

                        </span>

                    </div>



                    <?php if($generalReview): ?>


                        <!-- =================================
                                EXISTING REVIEW
                        ================================== -->

                        <div class="my-review">


                            <div class="stars">


                                <?php for($i = 1; $i <= 5; $i++): ?>

                                    <i
                                        class="fa-solid fa-star <?= $i <= $generalReview["rating"] ? "active" : ""; ?>"
                                    ></i>

                                <?php endfor; ?>


                            </div>


                            <p class="review-text">

                                <?= nl2br(
                                    htmlspecialchars(
                                        $generalReview["review"]
                                    )
                                ); ?>

                            </p>


                            <span class="review-date">

                                Reviewed on

                                <?= date(
                                    "F j, Y",
                                    strtotime(
                                        $generalReview["created_at"]
                                    )
                                ); ?>

                            </span>



                            <?php if(!empty($generalReview["admin_reply"])): ?>

                                <div class="admin-reply">

                                    <strong>
                                        Ultimate replied:
                                    </strong>

                                    <p>

                                        <?= nl2br(
                                            htmlspecialchars(
                                                $generalReview["admin_reply"]
                                            )
                                        ); ?>

                                    </p>

                                </div>

                            <?php endif; ?>



                            <button
                                type="button"
                                class="edit-review-btn"
                            >

                                <i class="fa-solid fa-pen"></i>

                                Edit Review

                            </button>


                        </div>


                    <?php else: ?>


                        <!-- =================================
                                NO REVIEW YET
                        ================================== -->

                        <div class="empty-review">

                            <i class="fa-regular fa-star"></i>

                            <h3>
                                You haven't reviewed Ultimate yet
                            </h3>

                            <p>
                                Tell us about your experience
                                using the Ultimate platform.
                            </p>


                            <button
                                type="button"
                                class="write-review-btn"
                            >

                                <i class="fa-solid fa-star"></i>

                                Write a Review

                            </button>

                        </div>


                    <?php endif; ?>


                </div>


            </div>


        </div>


        <?php include "includes/footer.php"; ?>


    </main>


</div>



<!-- =========================================
        REVIEW MODAL
========================================= -->

<div
    class="review-modal-overlay"
    id="reviewModal"
>


    <div class="review-modal">


        <button
            type="button"
            class="review-modal-close"
            id="closeReviewModal"
            aria-label="Close review modal"
        >

            <i class="fa-solid fa-xmark"></i>

        </button>



        <div class="review-modal-icon">

            <i class="fa-solid fa-star"></i>

        </div>



        <span class="review-modal-label">

            YOUR EXPERIENCE

        </span>



        <h2>
            How was your experience?
        </h2>


        <p>
            Tell us what you think about Ultimate.
            Your feedback helps us improve.
        </p>



        <!-- =========================================
                REVIEW FORM
        ========================================== -->

        <form
            action="submit-review.php"
            method="POST"
            id="reviewForm"
        >


            <!-- RATING -->

            <div class="review-rating">


                <button
                    type="button"
                    data-rating="1"
                >

                    <i class="fa-solid fa-star"></i>

                </button>


                <button
                    type="button"
                    data-rating="2"
                >

                    <i class="fa-solid fa-star"></i>

                </button>


                <button
                    type="button"
                    data-rating="3"
                >

                    <i class="fa-solid fa-star"></i>

                </button>


                <button
                    type="button"
                    data-rating="4"
                >

                    <i class="fa-solid fa-star"></i>

                </button>


                <button
                    type="button"
                    data-rating="5"
                >

                    <i class="fa-solid fa-star"></i>

                </button>


            </div>


            <p
                class="rating-text"
                id="ratingText"
            >
                Select a rating
            </p>


            <!--
                JavaScript will put
                the selected rating here.
            -->

            <input
                type="hidden"
                name="rating"
                id="selectedRating"
                value=""
            >



            <!-- REVIEW TEXT -->

            <div class="review-textarea-group">


                <label for="reviewText">

                    Your Review

                </label>


                <textarea
                    id="reviewText"
                    name="review"
                    placeholder="Share your experience with Ultimate..."
                    rows="5"
                    required
                ></textarea>


            </div>



            <!-- ACTION BUTTONS -->

            <div class="review-modal-actions">


                <button
                    type="button"
                    class="review-cancel-btn"
                    id="cancelReview"
                >

                    Cancel

                </button>


                <button
                    type="submit"
                    class="review-submit-btn"
                >

                    <span>
                        Submit Review
                    </span>

                    <i class="fa-solid fa-arrow-right"></i>

                </button>


            </div>


        </form>


    </div>


</div>



<script src="js/reviews.js"></script>


</body>

</html>
