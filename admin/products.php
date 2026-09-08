```php
<?php
session_start();

if(!isset($_SESSION["admin_id"])){
    header("Location: login.php");
    exit();
}

$currentPage = "products";

require_once "../config.php";

$pageTitle = "Products";
$pageDescription = "Manage your Ultimate marketplace products";


// FETCH PRODUCTS
$productQuery = "
    SELECT
        products.id,
        products.product_name,
        products.description,
        products.price,
        products.discount_price,
        products.stock_quantity,
        products.product_condition,
        products.brand,
        products.specifications,
        products.image,
        products.status,
        products.created_at,
        categories.title AS category_name
    FROM products
    INNER JOIN categories
        ON products.category_id = categories.id
    ORDER BY products.created_at DESC
";

$productResult = mysqli_query($conn, $productQuery);

if(!$productResult){
    die("Failed to load products: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($pageTitle); ?> | Ultimate Admin</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >

    <!-- Admin CSS -->
    <link rel="stylesheet" href="assets/css/admin.css">


    <style>

        /* =========================================
           PRODUCTS PAGE
        ========================================= */

        .products-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }


        .products-header-text h1 {
            margin: 0 0 6px;
            font-size: 22px;
            font-weight: 600;
        }


        .products-header-text p {
            margin: 0;
            color: rgba(255,255,255,0.55);
            font-size: 12px;
        }


        /* =========================================
           ADD PRODUCT BUTTON
        ========================================= */

        .add-product-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            padding: 11px 18px;

            border-radius: 10px;

            background: linear-gradient(
                135deg,
                #7c3aed,
                #9333ea
            );

            color: #fff;

            text-decoration: none;

            font-size: 12px;
            font-weight: 600;

            border: 1px solid rgba(255,255,255,0.08);

            box-shadow:
                0 8px 25px rgba(124,58,237,0.25);

            transition: 0.3s ease;
        }


        .add-product-btn:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 30px rgba(124,58,237,0.35);
        }


        /* =========================================
           PRODUCTS TABLE WRAPPER
        ========================================= */

        .products-table-wrapper {
            width: 100%;

            overflow-x: auto;

            border-radius: 16px;

            border: 1px solid rgba(255,255,255,0.06);

            background: rgba(255,255,255,0.025);

            backdrop-filter: blur(15px);

            -webkit-backdrop-filter: blur(15px);

            scrollbar-width: thin;
        }


        .products-table-wrapper::-webkit-scrollbar {
            height: 6px;
        }


        .products-table-wrapper::-webkit-scrollbar-thumb {
            background: rgba(124,58,237,0.6);
            border-radius: 20px;
        }


        /* =========================================
           TABLE
        ========================================= */

        .products-table {
            width: 100%;

            min-width: 1050px;

            border-collapse: collapse;
        }


        /* =========================================
           TABLE HEADER
        ========================================= */

        .products-table thead {
            background: rgba(255,255,255,0.035);
        }


        .products-table th {
            padding: 15px 16px;

            text-align: left;

            font-size: 10px;

            font-weight: 600;

            color: rgba(255,255,255,0.5);

            text-transform: uppercase;

            letter-spacing: 0.6px;

            white-space: nowrap;

            border-bottom: 1px solid rgba(255,255,255,0.06);
        }


        /* =========================================
           PRODUCT ROW
        ========================================= */

        .products-table tbody tr {
            transition: 0.25s ease;

            border-bottom: 1px solid rgba(255,255,255,0.045);
        }


        .products-table tbody tr:last-child {
            border-bottom: none;
        }


        .products-table tbody tr:hover {
            background: rgba(124,58,237,0.055);
        }


        .products-table td {
            padding: 14px 16px;

            font-size: 11px;

            color: rgba(255,255,255,0.82);

            vertical-align: middle;
        }


        /* =========================================
           PRODUCT INFO
        ========================================= */

        .product-info {
            display: flex;

            align-items: center;

            gap: 12px;

            min-width: 230px;
        }


        .product-image {
            width: 54px;
            height: 54px;

            flex-shrink: 0;

            border-radius: 10px;

            overflow: hidden;

            background: rgba(255,255,255,0.05);

            border: 1px solid rgba(255,255,255,0.07);

            display: flex;

            align-items: center;

            justify-content: center;
        }


        .product-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            display: block;
        }


        .product-image-placeholder {
            width: 100%;
            height: 100%;

            display: flex;

            align-items: center;
            justify-content: center;

            color: rgba(255,255,255,0.25);

            font-size: 18px;
        }


        .product-name {
            max-width: 180px;

            font-size: 12px;

            font-weight: 600;

            color: #fff;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .product-brand {
            margin-top: 3px;

            font-size: 9px;

            color: rgba(255,255,255,0.4);
        }


        /* =========================================
           CATEGORY
        ========================================= */

        .category-name {
            color: rgba(255,255,255,0.7);

            white-space: nowrap;
        }


        /* =========================================
           PRICE
        ========================================= */

        .price-container {
            white-space: nowrap;
        }


        .discount-price {
            display: block;

            font-size: 12px;

            font-weight: 600;

            color: #c084fc;
        }


        .original-price {
            display: block;

            margin-top: 2px;

            font-size: 9px;

            color: rgba(255,255,255,0.35);

            text-decoration: line-through;
        }


        .regular-price {
            font-size: 12px;

            font-weight: 600;

            color: #fff;
        }


        /* =========================================
           STOCK
        ========================================= */

        .stock-number {
            font-weight: 600;

            color: rgba(255,255,255,0.8);
        }


        .out-of-stock {
            color: #f87171;
        }


        /* =========================================
           BADGES
        ========================================= */

        .product-badge {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 5px 9px;

            border-radius: 20px;

            font-size: 9px;

            font-weight: 600;

            white-space: nowrap;
        }


        .condition-new {
            background: rgba(34,197,94,0.1);

            color: #86efac;

            border: 1px solid rgba(34,197,94,0.15);
        }


        .condition-used {
            background: rgba(251,191,36,0.1);

            color: #fcd34d;

            border: 1px solid rgba(251,191,36,0.15);
        }


        .status-active {
            background: rgba(34,197,94,0.1);

            color: #86efac;

            border: 1px solid rgba(34,197,94,0.15);
        }


        .status-inactive {
            background: rgba(239,68,68,0.1);

            color: #fca5a5;

            border: 1px solid rgba(239,68,68,0.15);
        }


        /* =========================================
           ACTION BUTTONS
        ========================================= */

        .product-actions {
            display: flex;

            align-items: center;

            gap: 7px;
        }


        .product-action {
            width: 32px;
            height: 32px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            border-radius: 8px;

            text-decoration: none;

            border: 1px solid rgba(255,255,255,0.07);

            background: rgba(255,255,255,0.035);

            color: rgba(255,255,255,0.65);

            cursor: pointer;

            transition: 0.25s ease;
        }


        .product-action.edit:hover {
            color: #c084fc;

            background: rgba(124,58,237,0.12);

            border-color: rgba(124,58,237,0.25);

            transform: translateY(-1px);
        }


        .product-action.delete:hover {
            color: #f87171;

            background: rgba(239,68,68,0.1);

            border-color: rgba(239,68,68,0.2);

            transform: translateY(-1px);
        }


        /* =========================================
           EMPTY STATE
        ========================================= */

        .products-empty {
            padding: 70px 30px;

            text-align: center;
        }


        .products-empty-icon {
            width: 65px;
            height: 65px;

            margin: 0 auto 18px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: rgba(124,58,237,0.1);

            border: 1px solid rgba(124,58,237,0.15);

            color: #c084fc;

            font-size: 24px;
        }


        .products-empty h3 {
            margin: 0 0 7px;

            font-size: 15px;
        }


        .products-empty p {
            margin: 0 0 20px;

            color: rgba(255,255,255,0.45);

            font-size: 11px;
        }


        /* =========================================
           DELETE MODAL
        ========================================= */

        .delete-modal {
            position: fixed;

            inset: 0;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 20px;

            background: rgba(0,0,0,0.72);

            backdrop-filter: blur(8px);

            -webkit-backdrop-filter: blur(8px);

            z-index: 9999;

            opacity: 0;

            visibility: hidden;

            transition: 0.25s ease;
        }


        .delete-modal.active {
            opacity: 1;

            visibility: visible;
        }


        .delete-modal-box {
            width: 100%;

            max-width: 420px;

            padding: 30px;

            border-radius: 18px;

            background:
                linear-gradient(
                    145deg,
                    rgba(25,18,38,0.98),
                    rgba(12,12,12,0.98)
                );

            border: 1px solid rgba(255,255,255,0.08);

            box-shadow:
                0 30px 80px rgba(0,0,0,0.6);

            transform: translateY(15px) scale(0.97);

            transition: 0.25s ease;
        }


        .delete-modal.active .delete-modal-box {
            transform: translateY(0) scale(1);
        }


        .delete-modal-icon {
            width: 52px;
            height: 52px;

            margin-bottom: 18px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background: rgba(239,68,68,0.1);

            color: #f87171;

            font-size: 20px;
        }


        .delete-modal-box h3 {
            margin: 0 0 8px;

            font-size: 17px;

            color: #fff;
        }


        .delete-modal-box p {
            margin: 0;

            font-size: 11px;

            line-height: 1.7;

            color: rgba(255,255,255,0.5);
        }


        .delete-product-name {
            color: #fff;

            font-weight: 600;
        }


        .delete-modal-actions {
            display: flex;

            justify-content: flex-end;

            gap: 10px;

            margin-top: 25px;
        }


        .modal-btn {
            padding: 10px 16px;

            border-radius: 9px;

            border: 1px solid rgba(255,255,255,0.08);

            font-family: inherit;

            font-size: 11px;

            font-weight: 600;

            cursor: pointer;

            transition: 0.25s ease;
        }


        .modal-cancel {
            background: rgba(255,255,255,0.04);

            color: rgba(255,255,255,0.7);
        }


        .modal-cancel:hover {
            background: rgba(255,255,255,0.08);
        }


        .modal-delete {
            background: rgba(239,68,68,0.12);

            color: #f87171;

            border-color: rgba(239,68,68,0.2);
        }


        .modal-delete:hover {
            background: rgba(239,68,68,0.2);
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media(max-width: 800px){

            .products-header {
                align-items: flex-start;

                flex-direction: column;
            }

            .add-product-btn {
                width: 100%;
            }

            .products-table-wrapper {
                border-radius: 12px;
            }

        }


        @media(max-width: 500px){

            .products-header-text h1 {
                font-size: 19px;
            }

            .products-header-text p {
                font-size: 10px;
            }

            .delete-modal-box {
                padding: 24px;
            }

            .delete-modal-actions {
                flex-direction: column;
            }

            .modal-btn {
                width: 100%;
            }

        }

    </style>

</head>


<body>


    <!-- SIDEBAR -->
    <?php include "includes/sidebar.php"; ?>


    <main class="admin-main">


        <!-- TOPBAR / NAVBAR -->
        <?php include "includes/topbar.php"; ?>


        <section class="admin-content">


            <!-- PAGE HEADER -->
            <div class="products-header">

                <a href="add-product.php" class="add-product-btn">

                    <i class="fa-solid fa-plus"></i>

                    Add Product

                </a>

            </div>


            <!-- PRODUCTS TABLE -->
            <?php if(mysqli_num_rows($productResult) > 0): ?>

                <div class="products-table-wrapper">

                    <table class="products-table">

                        <thead>

                            <tr>

                                <th>Product</th>

                                <th>Category</th>

                                <th>Price</th>

                                <th>Stock</th>

                                <th>Condition</th>

                                <th>Status</th>

                                <th>Actions</th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php while($product = mysqli_fetch_assoc($productResult)): ?>

                                <?php

                                    $productId = (int)$product["id"];

                                    $productName = htmlspecialchars(
                                        $product["product_name"],
                                        ENT_QUOTES,
                                        "UTF-8"
                                    );

                                    $categoryName = htmlspecialchars(
                                        $product["category_name"],
                                        ENT_QUOTES,
                                        "UTF-8"
                                    );

                                    $brand = htmlspecialchars(
                                        $product["brand"] ?? "",
                                        ENT_QUOTES,
                                        "UTF-8"
                                    );

                                    $productImage = htmlspecialchars(
                                        $product["image"] ?? "",
                                        ENT_QUOTES,
                                        "UTF-8"
                                    );

                                ?>

                                <tr>


                                    <!-- PRODUCT -->
                                    <td>

                                        <div class="product-info">


                                            <div class="product-image">

                                                <?php if(!empty($product["image"])): ?>

                                                    <img
                                                        src="<?= $productImage; ?>"
                                                        alt="<?= $productName; ?>"
                                                    >

                                                <?php else: ?>

                                                    <div class="product-image-placeholder">

                                                        <i class="fa-solid fa-box"></i>

                                                    </div>

                                                <?php endif; ?>

                                            </div>


                                            <div>

                                                <div class="product-name">

                                                    <?= $productName; ?>

                                                </div>


                                                <?php if(!empty($product["brand"])): ?>

                                                    <div class="product-brand">

                                                        <?= $brand; ?>

                                                    </div>

                                                <?php endif; ?>

                                            </div>


                                        </div>

                                    </td>


                                    <!-- CATEGORY -->
                                    <td>

                                        <span class="category-name">

                                            <?= $categoryName; ?>

                                        </span>

                                    </td>


                                    <!-- PRICE -->
                                    <td>

                                        <div class="price-container">

                                            <?php if(
                                                $product["discount_price"] !== null &&
                                                $product["discount_price"] > 0
                                            ): ?>

                                                <span class="discount-price">

                                                    $<?= number_format(
                                                        $product["discount_price"],
                                                        2
                                                    ); ?>

                                                </span>


                                                <span class="original-price">

                                                    $<?= number_format(
                                                        $product["price"],
                                                        2
                                                    ); ?>

                                                </span>

                                            <?php else: ?>

                                                <span class="regular-price">

                                                    $<?= number_format(
                                                        $product["price"],
                                                        2
                                                    ); ?>

                                                </span>

                                            <?php endif; ?>

                                        </div>

                                    </td>


                                    <!-- STOCK -->
                                    <td>

                                        <?php if((int)$product["stock_quantity"] > 0): ?>

                                            <span class="stock-number">

                                                <?= (int)$product["stock_quantity"]; ?>

                                            </span>

                                        <?php else: ?>

                                            <span class="stock-number out-of-stock">

                                                Out of stock

                                            </span>

                                        <?php endif; ?>

                                    </td>


                                    <!-- CONDITION -->
                                    <td>

                                        <?php if($product["product_condition"] === "New"): ?>

                                            <span class="product-badge condition-new">

                                                New

                                            </span>

                                        <?php else: ?>

                                            <span class="product-badge condition-used">

                                                Used

                                            </span>

                                        <?php endif; ?>

                                    </td>


                                    <!-- STATUS -->
                                    <td>

                                        <?php if($product["status"] === "Active"): ?>

                                            <span class="product-badge status-active">

                                                Active

                                            </span>

                                        <?php else: ?>

                                            <span class="product-badge status-inactive">

                                                Inactive

                                            </span>

                                        <?php endif; ?>

                                    </td>


                                    <!-- ACTIONS -->
                                    <td>

                                        <div class="product-actions">


                                            <!-- EDIT -->
                                            <a
                                                href="edit-product.php?id=<?= $productId; ?>"
                                                class="product-action edit"
                                                title="Edit Product"
                                            >

                                                <i class="fa-solid fa-pen"></i>

                                            </a>


                                            <!-- DELETE -->
                                            <button
                                                type="button"
                                                class="product-action delete"
                                                title="Delete Product"
                                                data-id="<?= $productId; ?>"
                                                data-name="<?= $productName; ?>"
                                            >

                                                <i class="fa-solid fa-trash"></i>

                                            </button>


                                        </div>

                                    </td>


                                </tr>

                            <?php endwhile; ?>

                        </tbody>

                    </table>

                </div>


            <?php else: ?>


                <!-- EMPTY STATE -->
                <div class="products-table-wrapper">

                    <div class="products-empty">

                        <div class="products-empty-icon">

                            <i class="fa-solid fa-box-open"></i>

                        </div>


                        <h3>

                            No Products Yet

                        </h3>


                        <p>

                            You haven't added any products to your marketplace.

                        </p>


                        <a
                            href="add-product.php"
                            class="add-product-btn"
                        >

                            <i class="fa-solid fa-plus"></i>

                            Add Your First Product

                        </a>

                    </div>

                </div>


            <?php endif; ?>


        </section>


        <!-- FOOTER -->
        <?php include "includes/footer.php"; ?>


    </main>


    <!-- =========================================
         DELETE MODAL
    ========================================== -->

    <div class="delete-modal" id="deleteModal">

        <div class="delete-modal-box">


            <div class="delete-modal-icon">

                <i class="fa-solid fa-trash"></i>

            </div>


            <h3>

                Delete Product?

            </h3>


            <p>

                Are you sure you want to delete

                <span
                    class="delete-product-name"
                    id="deleteProductName"
                ></span>?

                This action cannot be undone.

            </p>


            <div class="delete-modal-actions">


                <button
                    type="button"
                    class="modal-btn modal-cancel"
                    id="deleteCancelButton"
                >

                    Cancel

                </button>


                <a
                    href="#"
                    class="modal-btn modal-delete"
                    id="deleteConfirmButton"
                >

                    Delete Product

                </a>


            </div>


        </div>

    </div>


    <!-- =========================================
         DELETE MODAL JAVASCRIPT
    ========================================== -->

    <script>

        const deleteModal = document.getElementById("deleteModal");

        const deleteProductName =
            document.getElementById("deleteProductName");

        const deleteConfirmButton =
            document.getElementById("deleteConfirmButton");

        const deleteCancelButton =
            document.getElementById("deleteCancelButton");


        /* OPEN DELETE MODAL */

        document.querySelectorAll(".product-action.delete").forEach(button => {

            button.addEventListener("click", function(){

                const productId =
                    this.getAttribute("data-id");

                const productName =
                    this.getAttribute("data-name");


                deleteProductName.textContent =
                    productName;


                deleteConfirmButton.href =
                    "delete-product.php?id=" + productId;


                deleteModal.classList.add("active");

                document.body.style.overflow = "hidden";

            });

        });


        /* CLOSE MODAL */

        function closeDeleteModal(){

            deleteModal.classList.remove("active");

            document.body.style.overflow = "";

        }


        deleteCancelButton.addEventListener(
            "click",
            closeDeleteModal
        );


        /* CLICK OUTSIDE MODAL */

        deleteModal.addEventListener("click", function(event){

            if(event.target === deleteModal){

                closeDeleteModal();

            }

        });


        /* ESCAPE KEY */

        document.addEventListener("keydown", function(event){

            if(
                event.key === "Escape" &&
                deleteModal.classList.contains("active")
            ){

                closeDeleteModal();

            }

        });

    </script>


</body>

</html>

