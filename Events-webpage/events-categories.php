
<?php

require_once "../config.php";


/* =========================================
   GET MAIN EVENTS CATEGORY
========================================= */

$mainQuery = "
    SELECT id
    FROM categories
    WHERE title = 'Events'
    LIMIT 1
";

$mainResult = mysqli_query(
    $conn,
    $mainQuery
);

$mainCategory = mysqli_fetch_assoc(
    $mainResult
);

$eventsCategoryId = $mainCategory["id"] ?? 0;


/* =========================================
   FETCH ACTIVE EVENT CATEGORIES
========================================= */

$eventCategories = [];


if($eventsCategoryId > 0){

    $query = "
        SELECT
            id,
            name,
            slug,
            short_description,
            icon,
            image
        FROM event_categories
        WHERE category_id = ?
        AND status = 'Active'
        ORDER BY created_at DESC
    ";


    $stmt = mysqli_prepare(
        $conn,
        $query
    );


    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $eventsCategoryId
    );


    mysqli_stmt_execute(
        $stmt
    );


    $result = mysqli_stmt_get_result(
        $stmt
    );


    while($row = mysqli_fetch_assoc($result)){

        $eventCategories[] = $row;

    }


    mysqli_stmt_close($stmt);

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
        Event Categories | Ultimate
    </title>


    <link
        rel="stylesheet"
        href="css/index.css?v=3"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <style>

        /* =========================================
           EVENT CATEGORIES PAGE
        ========================================= */

        .event-categories-page{

            padding:60px 6% 100px;

        }


        /* =========================================
           HEADER
        ========================================= */

        .event-categories-header{

            max-width:760px;

            margin:0 auto 55px;

            text-align:center;

        }


        .event-categories-header span{

            display:inline-block;

            margin-bottom:12px;

            font-size:11px;

            font-weight:600;

            letter-spacing:2px;

            color:#a855f7;

        }


        .event-categories-header h1{

            margin-bottom:18px;

            font-size:clamp(
                32px,
                5vw,
                58px
            );

            line-height:1.1;

            color:#fff;

        }


        .event-categories-header p{

            max-width:650px;

            margin:auto;

            color:#9999a5;

            font-size:14px;

            line-height:1.8;

        }


        /* =========================================
           CATEGORY GRID
        ========================================= */

        .event-categories-grid{

            display:grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap:25px;

            max-width:1250px;

            margin:auto;

        }


        /* =========================================
           CATEGORY CARD
        ========================================= */

        .event-category-card{

            position:relative;

            overflow:hidden;

            min-height:390px;

            display:flex;

            flex-direction:column;

            border-radius:24px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.07),
                    rgba(255,255,255,.025)
                );

            border:1px solid rgba(
                255,
                255,
                255,
                .08
            );

            text-decoration:none;

            transition:
                transform .35s ease,
                border-color .35s ease,
                box-shadow .35s ease;

        }


        .event-category-card:hover{

            transform:translateY(-8px);

            border-color:
                rgba(168,85,247,.45);

            box-shadow:
                0 25px 60px
                rgba(0,0,0,.35),
                0 0 35px
                rgba(168,85,247,.10);

        }


        /* =========================================
           IMAGE
        ========================================= */

        .event-category-image{

            position:relative;

            height:240px;

            overflow:hidden;

        }


        .event-category-image img{

            width:100%;

            height:100%;

            display:block;

            object-fit:cover;

            transition:
                transform .6s ease;

        }


        .event-category-card:hover
        .event-category-image img{

            transform:scale(1.07);

        }


        .event-category-image::after{

            content:"";

            position:absolute;

            inset:0;

            background:
                linear-gradient(
                    to bottom,
                    transparent 45%,
                    rgba(8,8,12,.85)
                );

        }


        /* =========================================
           CONTENT
        ========================================= */

        .event-category-content{

            position:relative;

            flex:1;

            padding:25px;

        }


        .event-category-icon{

            width:45px;

            height:45px;

            margin-bottom:15px;

            display:flex;

            align-items:center;

            justify-content:center;

            border-radius:13px;

            background:
                rgba(168,85,247,.12);

            border:1px solid
                rgba(168,85,247,.18);

            color:#a855f7;

            font-size:16px;

        }


        .event-category-content h2{

            margin-bottom:10px;

            color:#fff;

            font-size:21px;

        }


        .event-category-content p{

            color:#888894;

            font-size:12px;

            line-height:1.7;

        }


        /* =========================================
           VIEW ARROW
        ========================================= */

        .event-category-arrow{

            position:absolute;

            right:25px;

            bottom:25px;

            width:40px;

            height:40px;

            display:flex;

            align-items:center;

            justify-content:center;

            border-radius:50%;

            background:
                rgba(255,255,255,.05);

            color:#fff;

            transition:.3s ease;

        }


        .event-category-card:hover
        .event-category-arrow{

            background:#a855f7;

            transform:
                translateX(4px);

        }


        /* =========================================
           EMPTY STATE
        ========================================= */

        .event-categories-empty{

            max-width:600px;

            margin:80px auto;

            padding:55px 30px;

            text-align:center;

            border-radius:24px;

            background:
                rgba(255,255,255,.035);

            border:1px solid
                rgba(255,255,255,.07);

        }


        .event-categories-empty i{

            margin-bottom:20px;

            font-size:42px;

            color:#a855f7;

        }


        .event-categories-empty h2{

            margin-bottom:10px;

            color:#fff;

        }


        .event-categories-empty p{

            color:#777783;

            font-size:13px;

        }


        /* =========================================
           TABLET
        ========================================= */

        @media(max-width:1000px){

            .event-categories-grid{

                grid-template-columns:
                    repeat(2, minmax(0,1fr));

            }

        }


        /* =========================================
           MOBILE
        ========================================= */

        @media(max-width:650px){

            .event-categories-page{

                padding:
                    40px 20px 70px;

            }


            .event-categories-header{

                margin-bottom:35px;

            }


            .event-categories-header h1{

                font-size:34px;

            }


            .event-categories-header p{

                font-size:13px;

            }


            .event-categories-grid{

                grid-template-columns:1fr;

                gap:18px;

            }


            .event-category-card{

                min-height:370px;

            }

        }

    </style>

</head>


<body>


<section class="container">


    <?php include "includes/navbar.php"; ?>


    <!-- =========================================
         PAGE
    ========================================= -->

    <main class="event-categories-page">


        <!-- HEADER -->

        <header class="event-categories-header">

            <span>
                ULTIMATE EVENTS
            </span>

            <h1>
                Explore Event Categories
            </h1>

            <p>
                Discover experiences for every occasion.
                Explore weddings, concerts, conferences,
                celebrations and more.
            </p>

        </header>


        <!-- =========================================
             CATEGORY GRID
        ========================================= -->

        <?php if(empty($eventCategories)): ?>


            <section class="event-categories-empty">

                <i class="fa-regular fa-calendar-xmark"></i>

                <h2>
                    No Event Categories Available
                </h2>

                <p>
                    There are currently no active event
                    categories available.
                </p>

            </section>


        <?php else: ?>


            <section class="event-categories-grid">


                <?php foreach($eventCategories as $category): ?>


                    <a
                        href="event-category-listings.php?id=<?= (int)$category["id"]; ?>"
                        class="event-category-card"
                    >


                        <!-- IMAGE -->

                        <div class="event-category-image">

                            <?php if(!empty($category["image"])): ?>

                                <img
                                    src="<?= htmlspecialchars($category["image"]); ?>"
                                    alt="<?= htmlspecialchars($category["name"]); ?>"
                                >

                            <?php else: ?>

                                <div
                                    style="
                                        height:100%;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        background:#111118;
                                    "
                                >

                                    <i
                                        class="<?= htmlspecialchars(
                                            $category["icon"]
                                            ?: "fa-solid fa-calendar-days"
                                        ); ?>"
                                        style="
                                            font-size:50px;
                                            color:#a855f7;
                                        "
                                    ></i>

                                </div>

                            <?php endif; ?>

                        </div>


                        <!-- CONTENT -->

                        <div class="event-category-content">


                            <div class="event-category-icon">

                                <i
                                    class="<?= htmlspecialchars(
                                        $category["icon"]
                                        ?: "fa-solid fa-calendar-days"
                                    ); ?>"
                                ></i>

                            </div>


                            <h2>
                                <?= htmlspecialchars(
                                    $category["name"]
                                ); ?>
                            </h2>


                            <p>
                                <?= htmlspecialchars(
                                    $category["short_description"]
                                ); ?>
                            </p>


                            <span class="event-category-arrow">

                                <i class="fa-solid fa-arrow-right"></i>

                            </span>


                        </div>


                    </a>


                <?php endforeach; ?>


            </section>


        <?php endif; ?>


    </main>


    <?php include "includes/footer.php"; ?>


</section>


<script src="js/script.js?v=3"></script>

</body>

</html>
