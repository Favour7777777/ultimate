<?php

require_once "config.php";


/*
=========================================================
    GET CATEGORY ID
=========================================================
*/

$categoryId = isset($_GET["id"])
    ? (int) $_GET["id"]
    : 0;


if($categoryId <= 0){

    die("Invalid product category.");

}


/*
=========================================================
    GET PRODUCT CATEGORY
=========================================================
*/

$categoryQuery = "
    SELECT
        id,
        title,
        description,
        image
    FROM product_categories
    WHERE id = ?
";


$categoryStmt = mysqli_prepare(
    $conn,
    $categoryQuery
);


if(!$categoryStmt){

    die("Database error.");

}


mysqli_stmt_bind_param(
    $categoryStmt,
    "i",
    $categoryId
);


mysqli_stmt_execute(
    $categoryStmt
);


$categoryResult =
    mysqli_stmt_get_result(
        $categoryStmt
    );


$category =
    mysqli_fetch_assoc(
        $categoryResult
    );


mysqli_stmt_close(
    $categoryStmt
);


if(!$category){

    die("Product category not found.");

}


/*
=========================================================
    GET PRODUCTS IN THIS CATEGORY
=========================================================
*/

$productQuery = "
    SELECT
        id,
        product_name,
        description,
        price,
        discount_price,
        stock_quantity,
        image,
        product_condition,
        brand
    FROM products
    WHERE product_category_id = ?
    AND status = 'Active'
    ORDER BY id DESC
";


$productStmt = mysqli_prepare(
    $conn,
    $productQuery
);


if(!$productStmt){

    die("Database error.");

}


mysqli_stmt_bind_param(
    $productStmt,
    "i",
    $categoryId
);


mysqli_stmt_execute(
    $productStmt
);


$productResult =
    mysqli_stmt_get_result(
        $productStmt
    );

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

        <?= htmlspecialchars($category["title"]); ?>

        | Ultimate

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


    <!-- YOUR MAIN WEBSITE CSS -->

    <link
        rel="stylesheet"
        href="styles.css"
    >


    <style>


        /* =========================================
           PRODUCT LISTING PAGE
        ========================================= */

        .products-page{

            width:100%;

            max-width:1400px;

            margin:0 auto;

            padding:120px 40px 80px;

        }


        /* =========================================
           CATEGORY HERO
        ========================================= */

        .category-header{

            position:relative;

            min-height:270px;

            display:flex;

            align-items:flex-end;

            overflow:hidden;

            border-radius:24px;

            margin-bottom:45px;

            background:#151219;

            border:1px solid
                rgba(255,255,255,0.07);

        }


        .category-header-image{

            position:absolute;

            inset:0;

        }


        .category-header-image img{

            width:100%;

            height:100%;

            object-fit:cover;

            opacity:.38;

        }


        .category-header-overlay{

            position:absolute;

            inset:0;

            background:
                linear-gradient(
                    90deg,
                    rgba(10,9,12,.98),
                    rgba(10,9,12,.72),
                    rgba(10,9,12,.25)
                );

        }


        .category-header-content{

            position:relative;

            z-index:2;

            max-width:700px;

            padding:38px;

        }


        .category-label{

            display:inline-flex;

            align-items:center;

            gap:7px;

            margin-bottom:12px;

            padding:7px 12px;

            border-radius:30px;

            background:
                rgba(157,91,207,.12);

            border:1px solid
                rgba(157,91,207,.25);

            color:#c18ae4;

            font-size:9px;

            font-weight:500;

        }


        .category-header h1{

            margin-bottom:10px;

            color:#ffffff;

            font-size:30px;

            font-weight:600;

            line-height:1.2;

        }


        .category-header p{

            color:#aaa0ae;

            font-size:11px;

            line-height:1.8;

        }


        /* =========================================
           PRODUCTS HEADER
        ========================================= */

        .products-top{

            display:flex;

            align-items:center;

            justify-content:space-between;

            margin-bottom:22px;

        }


        .products-top h2{

            color:#f5f1f7;

            font-size:18px;

            font-weight:500;

        }


        .products-count{

            color:#766d7c;

            font-size:10px;

        }


        /* =========================================
           PRODUCTS GRID
        ========================================= */

        .products-grid{

            display:grid;

            grid-template-columns:
                repeat(4, minmax(0,1fr));

            gap:20px;

        }


        /* =========================================
           PRODUCT CARD
        ========================================= */

        .product-card{

            overflow:hidden;

            border-radius:17px;

            background:
                linear-gradient(
                    145deg,
                    rgba(29,24,35,.95),
                    rgba(15,13,18,.98)
                );

            border:1px solid
                rgba(255,255,255,.06);

            transition:
                transform .3s ease,
                border-color .3s ease,
                box-shadow .3s ease;

        }


        .product-card:hover{

            transform:translateY(-6px);

            border-color:
                rgba(171,101,220,.28);

            box-shadow:
                0 18px 40px
                rgba(0,0,0,.35);

        }


        /* =========================================
           PRODUCT IMAGE
        ========================================= */

        .product-image{

            position:relative;

            height:220px;

            overflow:hidden;

            background:#17141a;

        }


        .product-image img{

            width:100%;

            height:100%;

            object-fit:cover;

            transition:
                transform .45s ease;

        }


        .product-card:hover
        .product-image img{

            transform:scale(1.06);

        }


        /* =========================================
           CONDITION
        ========================================= */

        .condition-badge{

            position:absolute;

            top:12px;

            left:12px;

            padding:5px 9px;

            border-radius:20px;

            background:
                rgba(10,10,12,.78);

            backdrop-filter:blur(10px);

            color:#ddd6e1;

            font-size:8px;

        }


        /* =========================================
           PRODUCT INFO
        ========================================= */

        .product-info{

            padding:17px;

        }


        .product-brand{

            margin-bottom:5px;

            color:#9875aa;

            font-size:8px;

            text-transform:uppercase;

            letter-spacing:.7px;

        }


        .product-name{

            min-height:42px;

            margin-bottom:9px;

            color:#f3edf5;

            font-size:13px;

            font-weight:500;

            line-height:1.6;

        }


        .product-description{

            display:-webkit-box;

            -webkit-line-clamp:2;

            -webkit-box-orient:vertical;

            overflow:hidden;

            margin-bottom:14px;

            color:#827985;

            font-size:9px;

            line-height:1.7;

        }


        /* =========================================
           PRICE
        ========================================= */

        .product-price{

            display:flex;

            align-items:center;

            gap:8px;

            margin-bottom:15px;

        }


        .current-price{

            color:#d39bf0;

            font-size:15px;

            font-weight:600;

        }


        .old-price{

            color:#625967;

            font-size:9px;

            text-decoration:line-through;

        }


        /* =========================================
           VIEW PRODUCT BUTTON
        ========================================= */

        .view-product{

            width:100%;

            min-height:39px;

            display:flex;

            align-items:center;

            justify-content:center;

            gap:7px;

            border-radius:9px;

            background:
                linear-gradient(
                    135deg,
                    #9b65d3,
                    #61317f
                );

            color:#ffffff;

            text-decoration:none;

            font-size:9px;

            font-weight:500;

            transition:.25s ease;

        }


        .view-product:hover{

            transform:translateY(-2px);

            box-shadow:
                0 8px 20px
                rgba(102,47,135,.30);

        }


        /* =========================================
           EMPTY PRODUCTS
        ========================================= */

        .empty-products{

            padding:70px 20px;

            text-align:center;

            border:1px solid
                rgba(255,255,255,.06);

            border-radius:18px;

            background:
                rgba(255,255,255,.02);

        }


        .empty-products i{

            margin-bottom:15px;

            color:#71547e;

            font-size:28px;

        }


        .empty-products h3{

            margin-bottom:7px;

            color:#eee8f1;

            font-size:15px;

            font-weight:500;

        }


        .empty-products p{

            color:#766d7c;

            font-size:9px;

        }


        /* =========================================
           TABLET
        ========================================= */

        @media(max-width:1100px){

            .products-grid{

                grid-template-columns:
                    repeat(3,minmax(0,1fr));

            }

        }


        /* =========================================
           MOBILE
        ========================================= */

        @media(max-width:800px){

            .products-page{

                padding:30px 20px 60px;

            }


            .products-grid{

                grid-template-columns:
                    repeat(2,minmax(0,1fr));

                gap:15px;

            }


            .product-image{

                height:190px;

            }


            .category-header-content{

                padding:28px;

            }

        }


        @media(max-width:550px){

            .products-page{

                padding:22px 14px 50px;

            }


            .category-header{

                min-height:230px;

                border-radius:18px;

            }


            .category-header-content{

                padding:22px;

            }


            .category-header h1{

                font-size:23px;

            }


            .products-grid{

                grid-template-columns:1fr;

            }


            .product-image{

                height:240px;

            }


            .products-top{

                align-items:flex-start;

                flex-direction:column;

                gap:5px;

            }

        }


    </style>

</head>


<body>


    <!-- NAVBAR -->

   


    <!-- PRODUCTS PAGE -->

    <main class="products-page">

         <?php include "includes/navbar.php"; ?>

        <!-- CATEGORY HEADER -->

        <section class="category-header">


            <div class="category-header-image">

                <img
                    src="<?= htmlspecialchars($category["image"]); ?>"
                    alt="<?= htmlspecialchars($category["title"]); ?>"
                >

            </div>


            <div class="category-header-overlay"></div>


            <div class="category-header-content">


                <div class="category-label">

                    <i class="fa-solid fa-layer-group"></i>

                    Product Category

                </div>


                <h1>

                    <?= htmlspecialchars(
                        $category["title"]
                    ); ?>

                </h1>


                <p>

                    <?= htmlspecialchars(
                        $category["description"]
                    ); ?>

                </p>


            </div>


        </section>


        <!-- PRODUCTS HEADER -->

        <div class="products-top">


            <h2>

                Products in this category

            </h2>


            <span class="products-count">

                <?= mysqli_num_rows($productResult); ?>

                product(s)

            </span>


        </div>


        <!-- PRODUCT GRID -->

        <?php if(
            mysqli_num_rows($productResult) > 0
        ): ?>


            <div class="products-grid">


                <?php while(
                    $product =
                    mysqli_fetch_assoc(
                        $productResult
                    )
                ): ?>


                    <article class="product-card">


                        <!-- IMAGE -->

                        <div class="product-image">


                            <img
                                src="<?= htmlspecialchars(
                                    $product["image"]
                                ); ?>"
                                alt="<?= htmlspecialchars(
                                    $product["product_name"]
                                ); ?>"
                            >


                            <?php if(
                                !empty(
                                    $product["product_condition"]
                                )
                            ): ?>

                                <span class="condition-badge">

                                    <?= htmlspecialchars(
                                        $product["product_condition"]
                                    ); ?>

                                </span>

                            <?php endif; ?>


                        </div>


                        <!-- PRODUCT INFORMATION -->

                        <div class="product-info">


                            <?php if(
                                !empty($product["brand"])
                            ): ?>

                                <div class="product-brand">

                                    <?= htmlspecialchars(
                                        $product["brand"]
                                    ); ?>

                                </div>

                            <?php endif; ?>


                            <h3 class="product-name">

                                <?= htmlspecialchars(
                                    $product["product_name"]
                                ); ?>

                            </h3>


                            <p class="product-description">

                                <?= htmlspecialchars(
                                    $product["description"]
                                ); ?>

                            </p>


                            <!-- PRICE -->

                            <div class="product-price">


                                <?php if(
                                    !empty(
                                        $product["discount_price"]
                                    ) &&
                                    $product["discount_price"] > 0
                                ): ?>


                                    <span class="current-price">

                                        $<?= number_format(
                                            $product["discount_price"],
                                            2
                                        ); ?>

                                    </span>


                                    <span class="old-price">

                                        $<?= number_format(
                                            $product["price"],
                                            2
                                        ); ?>

                                    </span>


                                <?php else: ?>


                                    <span class="current-price">

                                        $<?= number_format(
                                            $product["price"],
                                            2
                                        ); ?>

                                    </span>


                                <?php endif; ?>


                            </div>


                            <!-- VIEW PRODUCT -->

                            <a
                                href="product-details.php?id=<?= (int)$listing["product_detail_id"]; ?>"
                                class="view-product"
                            >

                                <i class="fa-solid fa-arrow-right"></i>

                            </a>


                        </div>


                    </article>


                <?php endwhile; ?>


            </div>


        <?php else: ?>


            <!-- EMPTY STATE -->

            <div class="empty-products">


                <i class="fa-solid fa-box-open"></i>


                <h3>

                    No products yet

                </h3>


                <p>

                    There are currently no products listed
                    in this category.

                </p>


            </div>


        <?php endif; ?>


    </main>


    <!-- FOOTER -->

    <?php include "includes/footer.php"; ?>

<script src="main.js"></script>
</body>

</html>