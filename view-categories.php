<?php

/*
=========================================================
    DATABASE CONNECTION
=========================================================
*/

require_once "config.php";


/*
=========================================================
    GET ALL CATEGORIES
=========================================================
*/

$query = "
    SELECT
        id,
        title,
        description,
        icon,
        image,
        page_link
    FROM categories
    ORDER BY created_at DESC
";


$result = mysqli_query($conn, $query);


if(!$result){

    die(
        "Failed to load categories: "
        . mysqli_error($conn)
    );

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

        Categories | Ultimate

    </title>


    <!-- GOOGLE FONT -->

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
        crossorigin
    >


    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >


    <!-- FONT AWESOME -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <link rel="stylesheet" href="styles.css">

    <!--
    =====================================================
        PAGE-SPECIFIC CSS
    =====================================================
    -->

    <style>

        *{

            box-sizing:border-box;

            margin:0;

            padding:0;

        }


        body{

            min-height:100vh;

            background:
                linear-gradient(
                    135deg,
                    #0b090d,
                    #151019,
                    #0b090d
                );

            color:#ffffff;

            font-family:"Poppins",sans-serif;

        }


        /* =============================================
           PAGE CONTAINER
        ============================================= */

        .categories-page{

            width:min(1200px, 92%);

            margin:0 auto;

            padding:120px 0 70px;

        }


        /* =============================================
           PAGE HEADER
        ============================================= */

        .categories-header{

            text-align:center;

            margin-bottom:45px;

        }


        .categories-header .eyebrow{

            display:inline-block;

            margin-bottom:10px;

            color:#a76bd3;

            font-size:10px;

            font-weight:500;

            letter-spacing:2px;

            text-transform:uppercase;

        }


        .categories-header h1{

            color:#f5edf8;

            font-size:clamp(
                28px,
                4vw,
                44px
            );

            font-weight:500;

            line-height:1.2;

        }


        .categories-header p{

            max-width:620px;

            margin:14px auto 0;

            color:#83788a;

            font-size:12px;

            line-height:1.8;

        }


        /* =============================================
           CATEGORY GRID
        ============================================= */

        .categories-grid{

            display:grid;

            grid-template-columns:
                repeat(
                    auto-fit,
                    minmax(250px, 1fr)
                );

            gap:22px;

        }


        /* =============================================
           CATEGORY CARD
        ============================================= */

        .category-card{

            position:relative;

            overflow:hidden;

            min-height:330px;

            border:1px solid
                rgba(255,255,255,0.07);

            border-radius:20px;

            background:#17121c;

            box-shadow:
                0 15px 45px
                rgba(0,0,0,0.25);

            transition:
                transform 0.3s ease,
                border-color 0.3s ease,
                box-shadow 0.3s ease;

        }


        .category-card:hover{

            transform:translateY(-7px);

            border-color:
                rgba(174,108,218,0.28);

            box-shadow:
                0 25px 60px
                rgba(0,0,0,0.40);

        }


        /* =============================================
           CATEGORY IMAGE
        ============================================= */

        .category-image{

            position:absolute;

            inset:0;

            width:100%;

            height:100%;

        }


        .category-image img{

            width:100%;

            height:100%;

            object-fit:cover;

            display:block;

            transition:
                transform 0.5s ease;

        }


        .category-card:hover
        .category-image img{

            transform:scale(1.07);

        }


        /* =============================================
           IMAGE OVERLAY
        ============================================= */

        .category-overlay{

            position:absolute;

            inset:0;

            background:
                linear-gradient(
                    to top,
                    rgba(8,6,11,0.98) 5%,
                    rgba(8,6,11,0.75) 42%,
                    rgba(8,6,11,0.08) 100%
                );

        }


        /* =============================================
           CARD CONTENT
        ============================================= */

        .category-content{

            position:absolute;

            left:0;

            right:0;

            bottom:0;

            z-index:2;

            padding:24px;

        }


        /* =============================================
           ICON
        ============================================= */

        .category-icon{

            width:42px;

            height:42px;

            display:flex;

            align-items:center;

            justify-content:center;

            margin-bottom:13px;

            border:1px solid
                rgba(255,255,255,0.12);

            border-radius:12px;

            background:
                rgba(16,11,21,0.65);

            backdrop-filter:blur(10px);

            color:#c18be5;

            font-size:15px;

        }


        /* =============================================
           TITLE
        ============================================= */

        .category-title{

            color:#ffffff;

            font-size:17px;

            font-weight:500;

        }


        /* =============================================
           DESCRIPTION
        ============================================= */

        .category-description{

            max-width:400px;

            margin-top:7px;

            color:#b1a5b8;

            font-size:10px;

            line-height:1.7;

            display:-webkit-box;

            -webkit-line-clamp:2;

            -webkit-box-orient:vertical;

            overflow:hidden;

        }


        /* =============================================
           VIEW CATEGORY
        ============================================= */

        .view-category{

            display:inline-flex;

            align-items:center;

            gap:7px;

            margin-top:15px;

            color:#d0a4ed;

            font-size:9px;

            font-weight:500;

            text-decoration:none;

            transition:0.25s ease;

        }


        .view-category i{

            font-size:8px;

            transition:transform 0.25s ease;

        }


        .view-category:hover{

            color:#ffffff;

        }


        .view-category:hover i{

            transform:translateX(4px);

        }


        /* =============================================
           EMPTY STATE
        ============================================= */

        .empty-categories{

            grid-column:1 / -1;

            padding:80px 20px;

            text-align:center;

            border:1px dashed
                rgba(255,255,255,0.09);

            border-radius:20px;

            background:
                rgba(255,255,255,0.02);

        }


        .empty-categories i{

            margin-bottom:15px;

            color:#8551aa;

            font-size:30px;

        }


        .empty-categories h3{

            color:#ded4e3;

            font-size:15px;

            font-weight:500;

        }


        .empty-categories p{

            margin-top:7px;

            color:#756a7c;

            font-size:10px;

        }


        /* =============================================
           MOBILE
        ============================================= */

        @media(max-width:700px){

            .categories-page{

                width:90%;

                padding:45px 0;

            }


            .categories-header{

                margin-bottom:30px;

                margin-top:100px;

            }


            .categories-header p{

                font-size:10px;

            }


            .categories-grid{

                grid-template-columns:1fr;

                gap:16px;

            }


            .category-card{

                min-height:300px;

            }

        }


        @media(max-width:400px){

            .category-content{

                padding:20px;

            }


            .category-title{

                font-size:15px;

            }

        }

    </style>


</head>


<body id="top">

    <?php
    include "includes/navbar.php"
    ?>

    <main class="categories-page">


        <!-- =========================================
             HEADER
        ========================================== -->

        <header class="categories-header">


            <span class="eyebrow">

                Explore

            </span>


            <h1>

                Explore Our Categories

            </h1>


            <p>

                Discover products, services and experiences
                across the Ultimate marketplace.

            </p>


        </header>


        <!-- =========================================
             CATEGORY GRID
        ========================================== -->

        <section class="categories-grid">


            <?php if(mysqli_num_rows($result) > 0): ?>


                <?php while($category = mysqli_fetch_assoc($result)): ?>


                    <article class="category-card">


                        <!-- IMAGE -->

                        <div class="category-image">


                            <img
                                src="admin/<?= htmlspecialchars(
                                    $category["image"],
                                    ENT_QUOTES,
                                    "UTF-8"
                                ); ?>"
                                alt="<?= htmlspecialchars(
                                    $category["title"],
                                    ENT_QUOTES,
                                    "UTF-8"
                                ); ?>"
                            >


                            <div class="category-overlay"></div>


                        </div>


                        <!-- CONTENT -->

                        <div class="category-content">


                            <div class="category-icon">

                                <i
                                    class="<?= htmlspecialchars(
                                        $category["icon"],
                                        ENT_QUOTES,
                                        "UTF-8"
                                    ); ?>"
                                ></i>

                            </div>


                            <h2 class="category-title">

                                <?= htmlspecialchars(
                                    $category["title"],
                                    ENT_QUOTES,
                                    "UTF-8"
                                ); ?>

                            </h2>


                            <p class="category-description">

                                <?= htmlspecialchars(
                                    $category["description"],
                                    ENT_QUOTES,
                                    "UTF-8"
                                ); ?>

                            </p>


                            <a
                                href="<?= htmlspecialchars($category["page_link"], ENT_QUOTES, "UTF-8"); ?>"
                                class="view-category"
                            >

                                Explore Category

                                <i class="fa-solid fa-arrow-right"></i>

                            </a>


                        </div>


                    </article>


                <?php endwhile; ?>


            <?php else: ?>


                <div class="empty-categories">

                    <i class="fa-solid fa-layer-group"></i>


                    <h3>

                        No Categories Available

                    </h3>


                    <p>

                        Categories will appear here once they are added.

                    </p>

                </div>


            <?php endif; ?>


        </section>

    </main>

    <?php
    include "includes/footer.php"
    ?>

    <script src="main.js?v=2"></script>

</body>

</html>