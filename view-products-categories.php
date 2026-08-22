<?php

/*
=========================================================
    DATABASE CONNECTION
=========================================================
*/

require_once "config.php";


/*
=========================================================
    GET PRODUCT CATEGORIES
=========================================================
*/

$query = "
    SELECT
        id,
        title,
        description,
        image
    FROM product_categories
    ORDER BY created_at DESC
";


$result = mysqli_query($conn, $query);


if(!$result){

    die(
        "Failed to load product categories: "
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
        Product Categories | Ultimate
    </title>


    <!-- GOOGLE FONT -->

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
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

        .product-categories-page{

            width:min(1200px, 92%);

            margin:0 auto;

            padding:120px 0 70px;

        }


        /* =============================================
           PAGE HEADER
        ============================================= */

        .product-categories-header{

            text-align:center;

            margin-bottom:45px;

        }


        .product-categories-header .eyebrow{

            display:inline-block;

            margin-bottom:10px;

            color:#a76bd3;

            font-size:10px;

            font-weight:500;

            letter-spacing:2px;

            text-transform:uppercase;

        }


        .product-categories-header h1{

            color:#f5edf8;

            font-size:clamp(
                28px,
                4vw,
                44px
            );

            font-weight:500;

            line-height:1.2;

        }


        .product-categories-header p{

            max-width:620px;

            margin:14px auto 0;

            color:#83788a;

            font-size:12px;

            line-height:1.8;

        }


        /* =============================================
           CATEGORY GRID
        ============================================= */

        .product-categories-grid{

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

        .product-category-card{

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


        .product-category-card:hover{

            transform:translateY(-7px);

            border-color:
                rgba(174,108,218,0.28);

            box-shadow:
                0 25px 60px
                rgba(0,0,0,0.40);

        }


        /* =============================================
           IMAGE
        ============================================= */

        .product-category-image{

            position:absolute;

            inset:0;

            width:100%;

            height:100%;

        }


        .product-category-image img{

            width:100%;

            height:100%;

            object-fit:cover;

            display:block;

            transition:
                transform 0.5s ease;

        }


        .product-category-card:hover
        .product-category-image img{

            transform:scale(1.07);

        }


        /* =============================================
           OVERLAY
        ============================================= */

        .product-category-overlay{

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
           CONTENT
        ============================================= */

        .product-category-content{

            position:absolute;

            left:0;

            right:0;

            bottom:0;

            z-index:2;

            padding:24px;

        }


        /* =============================================
           TITLE
        ============================================= */

        .product-category-title{

            color:#ffffff;

            font-size:17px;

            font-weight:500;

        }


        /* =============================================
           DESCRIPTION
        ============================================= */

        .product-category-description{

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
           VIEW CATEGORY BUTTON
        ============================================= */

        .view-product-category{

            display:inline-flex;

            align-items:center;

            gap:7px;

            margin-top:15px;

            padding:9px 14px;

            border:1px solid
                rgba(174,108,218,0.25);

            border-radius:8px;

            background:
                rgba(167,107,211,0.10);

            color:#d0a4ed;

            font-size:9px;

            font-weight:500;

            text-decoration:none;

            transition:0.25s ease;

        }


        .view-product-category i{

            font-size:8px;

            transition:transform 0.25s ease;

        }


        .view-product-category:hover{

            background:#a76bd3;

            border-color:#a76bd3;

            color:#ffffff;

        }


        .view-product-category:hover i{

            transform:translateX(4px);

        }


        /* =============================================
           EMPTY STATE
        ============================================= */

        .empty-product-categories{

            grid-column:1 / -1;

            padding:80px 20px;

            text-align:center;

            border:1px dashed
                rgba(255,255,255,0.09);

            border-radius:20px;

            background:
                rgba(255,255,255,0.02);

        }


        .empty-product-categories i{

            margin-bottom:15px;

            color:#8551aa;

            font-size:30px;

        }


        .empty-product-categories h3{

            color:#ded4e3;

            font-size:15px;

            font-weight:500;

        }


        .empty-product-categories p{

            margin-top:7px;

            color:#756a7c;

            font-size:10px;

        }


        /* =============================================
           MOBILE
        ============================================= */

        @media(max-width:700px){

            .product-categories-page{

                width:90%;

                padding:45px 0;

            }


            .product-categories-header{

                margin-bottom:30px;

            }


            .product-categories-header p{

                font-size:10px;

            }


            .product-categories-grid{

                grid-template-columns:1fr;

                gap:16px;

            }


            .product-category-card{

                min-height:300px;

            }

        }


        @media(max-width:400px){

            .product-category-content{

                padding:20px;

            }


            .product-category-title{

                font-size:15px;

            }

        }

    </style>

</head>


<body id="top">


    <?php

    include "includes/navbar.php";

    ?>


    <main class="product-categories-page">


        <!-- =========================================
             HEADER
        ========================================== -->

        <header class="product-categories-header">

            <span class="eyebrow">

                Shop

            </span>


            <h1>

                Explore Product Categories

            </h1>


            <p>

                Discover products across our marketplace
                and find exactly what you're looking for.

            </p>

        </header>


        <!-- =========================================
             PRODUCT CATEGORY GRID
        ========================================== -->

        <section class="product-categories-grid">


            <?php if(mysqli_num_rows($result) > 0): ?>


                <?php while($category = mysqli_fetch_assoc($result)): ?>


                    <article class="product-category-card">


                        <!-- IMAGE -->

                        <div class="product-category-image">


                            <img
                                src="admin/uploads/categories/product-categories/<?= htmlspecialchars(
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

                            <div class="product-category-overlay"></div>


                        </div>


                        <!-- CONTENT -->

                        <div class="product-category-content">


                            <h2 class="product-category-title">

                                <?= htmlspecialchars(
                                    $category["title"],
                                    ENT_QUOTES,
                                    "UTF-8"
                                ); ?>

                            </h2>


                            <p class="product-category-description">

                                <?= htmlspecialchars(
                                    $category["description"],
                                    ENT_QUOTES,
                                    "UTF-8"
                                ); ?>

                            </p>


                            <a
                                href="products-listing.php?id=<?= (int)$category["id"]; ?>"
                                class="view-product-category"
                            >

                                View This Category

                                <i class="fa-solid fa-arrow-right"></i>

                            </a>


                        </div>


                    </article>


                <?php endwhile; ?>


            <?php else: ?>


                <div class="empty-product-categories">

                    <i class="fa-solid fa-layer-group"></i>


                    <h3>

                        No Product Categories Available

                    </h3>


                    <p>

                        Product categories will appear here
                        once they are added.

                    </p>

                </div>


            <?php endif; ?>


        </section>


    </main>


    <?php

    include "includes/footer.php";

    ?>


    <script src="main.js"></script>


</body>

</html>