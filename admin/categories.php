<?php

session_start();


/*
=========================================================
    ADMIN ACCESS PROTECTION
=========================================================
*/

if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");

    exit();

}


/*
=========================================================
    CURRENT PAGE
=========================================================
*/

$currentPage = "categories";


/*
=========================================================
    DATABASE CONNECTION
=========================================================
*/

require_once "../config.php";


/*
=========================================================
    PAGE INFORMATION
=========================================================
*/

$pageTitle = "Categories";

$pageDescription =
    "Manage your Ultimate marketplace categories";


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
        created_at
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

        Categories | Ultimate Admin

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


    <!-- ADMIN CSS -->

    <link
        rel="stylesheet"
        href="assets/css/admin.css"
    >


    <style>

        /* =========================================
           CATEGORIES PAGE
        ========================================= */

        .admin-content{

            padding:30px;

        }


        /* =========================================
           PAGE HEADER
        ========================================= */

        .categories-header{

            display:flex;

            align-items:flex-end;

            justify-content:space-between;

            gap:20px;

            margin-bottom:25px;

        }


        .categories-heading h2{

            font-size:20px;

            font-weight:500;

            color:#f2ebf5;

        }


        .categories-heading p{

            margin-top:5px;

            font-size:10px;

            color:#776d7d;

        }


        /* =========================================
           ADD CATEGORY BUTTON
        ========================================= */

        .add-category-button{

            display:inline-flex;

            align-items:center;

            justify-content:center;

            gap:8px;

            min-height:40px;

            padding:0 17px;

            border-radius:10px;

            background:
                linear-gradient(
                    135deg,
                    #9b65d3,
                    #61317f
                );

            color:#ffffff;

            font-size:9px;

            font-weight:500;

            text-decoration:none;

            box-shadow:
                0 8px 22px rgba(102,47,135,0.25);

            transition:0.25s ease;

            white-space:nowrap;

        }


        .add-category-button:hover{

            transform:translateY(-2px);

            box-shadow:
                0 12px 28px rgba(102,47,135,0.35);

        }


        /* =========================================
           CATEGORY GRID
        ========================================= */

        .categories-grid{

            display:grid;

            grid-template-columns:
                repeat(
                    auto-fill,
                    minmax(240px, 1fr)
                );

            gap:20px;

        }


        /* =========================================
           CATEGORY CARD
        ========================================= */

        .category-card{

            overflow:hidden;

            border:1px solid rgba(255,255,255,0.06);

            border-radius:16px;

            background:
                linear-gradient(
                    145deg,
                    rgba(29,23,35,0.92),
                    rgba(14,12,17,0.96)
                );

            box-shadow:
                0 12px 35px rgba(0,0,0,0.18);

            transition:
                transform 0.25s ease,
                border-color 0.25s ease,
                box-shadow 0.25s ease;

        }


        .category-card:hover{

            transform:translateY(-4px);

            border-color:
                rgba(177,111,225,0.20);

            box-shadow:
                0 18px 42px rgba(0,0,0,0.28);

        }


        /* =========================================
           IMAGE
        ========================================= */

        .category-image{

            position:relative;

            width:100%;

            height:165px;

            overflow:hidden;

            background:#17131b;

        }


        .category-image img{

            width:100%;

            height:100%;

            object-fit:cover;

            display:block;

            transition:transform 0.35s ease;

        }


        .category-card:hover
        .category-image img{

            transform:scale(1.05);

        }


        /* =========================================
           ICON
        ========================================= */

        .category-icon{

            position:absolute;

            left:15px;

            bottom:15px;

            width:38px;

            height:38px;

            display:flex;

            align-items:center;

            justify-content:center;

            border:1px solid
                rgba(255,255,255,0.10);

            border-radius:11px;

            background:
                rgba(17,13,21,0.82);

            backdrop-filter:blur(10px);

            color:#c28ae9;

            font-size:14px;

        }


        /* =========================================
           CARD CONTENT
        ========================================= */

        .category-content{

            padding:17px;

        }


        .category-title{

            margin:0;

            color:#f0e8f4;

            font-size:13px;

            font-weight:500;

        }


        .category-description{

            margin-top:7px;

            min-height:42px;

            color:#817687;

            font-size:9px;

            line-height:1.7;

            display:-webkit-box;

            -webkit-line-clamp:2;

            -webkit-box-orient:vertical;

            overflow:hidden;

        }


        /* =========================================
           CARD FOOTER
        ========================================= */

        .category-footer{

            display:flex;

            align-items:center;

            justify-content:space-between;

            gap:8px;

            margin-top:17px;

            padding-top:14px;

            border-top:
                1px solid
                rgba(255,255,255,0.05);

        }


        .category-date{

            color:#5f5664;

            font-size:8px;

        }


        /* =========================================
           ACTION BUTTONS
        ========================================= */

        .category-actions{

            display:flex;

            align-items:center;

            gap:6px;

        }


        .category-action{

            width:31px;

            height:31px;

            display:flex;

            align-items:center;

            justify-content:center;

            border:1px solid
                rgba(255,255,255,0.07);

            border-radius:8px;

            background:
                rgba(255,255,255,0.03);

            color:#817687;

            text-decoration:none;

            font-size:9px;

            transition:0.2s ease;

        }


        .category-action.edit:hover{

            color:#c28ae9;

            border-color:
                rgba(194,138,233,0.25);

            background:
                rgba(194,138,233,0.08);

        }


        .category-action.delete:hover{

            color:#e28d9b;

            border-color:
                rgba(226,141,155,0.25);

            background:
                rgba(226,141,155,0.08);

        }


        /* =========================================
           EMPTY STATE
        ========================================= */

        .categories-empty{

            grid-column:1 / -1;

            padding:70px 20px;

            text-align:center;

            border:1px dashed
                rgba(255,255,255,0.08);

            border-radius:16px;

            background:
                rgba(255,255,255,0.015);

        }


        .categories-empty-icon{

            width:55px;

            height:55px;

            margin:0 auto 15px;

            display:flex;

            align-items:center;

            justify-content:center;

            border-radius:15px;

            background:
                rgba(155,101,211,0.10);

            color:#9b65d3;

            font-size:18px;

        }


        .categories-empty h3{

            color:#dcd2e1;

            font-size:12px;

            font-weight:500;

        }


        .categories-empty p{

            margin-top:6px;

            color:#6e6373;

            font-size:9px;

        }


        /* =========================================
           MOBILE
        ========================================= */

        @media(max-width:700px){

            .admin-content{

                padding:22px 18px;

            }


            .categories-header{

                align-items:stretch;

                flex-direction:column;

            }


            .add-category-button{

                width:100%;

            }


            .categories-grid{

                grid-template-columns:1fr;

            }

        }


        @media(max-width:500px){

            .admin-content{

                padding:18px 14px;

            }


            .category-image{

                height:190px;

            }

        }

        /* =========================================
   DELETE CATEGORY MODAL
========================================= */

.delete-modal-overlay{

    position:fixed;

    inset:0;

    z-index:99999;

    display:flex;

    align-items:center;

    justify-content:center;

    padding:20px;

    background:rgba(5,3,8,0.72);

    backdrop-filter:blur(12px);

    -webkit-backdrop-filter:blur(12px);

    opacity:0;

    visibility:hidden;

    transition:
        opacity 0.25s ease,
        visibility 0.25s ease;

}


.delete-modal-overlay.active{

    opacity:1;

    visibility:visible;

}


/* =========================================
   MODAL BOX
========================================= */

.delete-modal{

    position:relative;

    width:100%;

    max-width:420px;

    padding:30px;

    border:1px solid
        rgba(255,255,255,0.08);

    border-radius:20px;

    background:
        linear-gradient(
            145deg,
            rgba(34,27,41,0.98),
            rgba(13,10,17,0.99)
        );

    box-shadow:
        0 30px 80px rgba(0,0,0,0.55),
        0 0 0 1px
        rgba(155,101,211,0.04);

    transform:
        translateY(15px)
        scale(0.96);

    transition:
        transform 0.25s ease;

}


.delete-modal-overlay.active
.delete-modal{

    transform:
        translateY(0)
        scale(1);

}


/* =========================================
   CLOSE BUTTON
========================================= */

.delete-modal-close{

    position:absolute;

    top:14px;

    right:14px;

    width:32px;

    height:32px;

    display:flex;

    align-items:center;

    justify-content:center;

    border:1px solid
        rgba(255,255,255,0.06);

    border-radius:9px;

    background:
        rgba(255,255,255,0.035);

    color:#776d7d;

    cursor:pointer;

    transition:0.2s ease;

}


.delete-modal-close:hover{

    color:#eee7f2;

    background:
        rgba(255,255,255,0.08);

}


/* =========================================
   DELETE ICON
========================================= */

.delete-modal-icon{

    width:58px;

    height:58px;

    margin:0 auto 18px;

    display:flex;

    align-items:center;

    justify-content:center;

    border:1px solid
        rgba(226,141,155,0.15);

    border-radius:17px;

    background:
        rgba(226,141,155,0.08);

    color:#e28d9b;

    font-size:20px;

    box-shadow:
        0 10px 30px
        rgba(226,141,155,0.06);

}


/* =========================================
   CONTENT
========================================= */

.delete-modal-content{

    text-align:center;

}


.delete-modal-content h3{

    margin:0;

    color:#f2ebf5;

    font-size:17px;

    font-weight:500;

}


.delete-modal-content p{

    margin:10px auto 0;

    max-width:320px;

    color:#817687;

    font-size:9px;

    line-height:1.8;

}


.delete-modal-content strong{

    color:#c9b2d4;

    font-weight:500;

}


/* =========================================
   ACTION BUTTONS
========================================= */

.delete-modal-actions{

    display:grid;

    grid-template-columns:
        1fr 1fr;

    gap:10px;

    margin-top:25px;

}


.delete-modal-cancel,
.delete-modal-confirm{

    min-height:42px;

    display:flex;

    align-items:center;

    justify-content:center;

    gap:7px;

    border-radius:10px;

    font-family:"Poppins",sans-serif;

    font-size:9px;

    font-weight:500;

    cursor:pointer;

    text-decoration:none;

    transition:0.25s ease;

}


/* CANCEL */

.delete-modal-cancel{

    border:1px solid
        rgba(255,255,255,0.07);

    background:
        rgba(255,255,255,0.035);

    color:#978b9d;

}


.delete-modal-cancel:hover{

    background:
        rgba(255,255,255,0.07);

    color:#eee7f2;

}


/* DELETE */

.delete-modal-confirm{

    border:1px solid
        rgba(226,141,155,0.16);

    background:
        linear-gradient(
            135deg,
            #a94d63,
            #733447
        );

    color:#ffffff;

    box-shadow:
        0 8px 22px
        rgba(169,77,99,0.20);

}


.delete-modal-confirm:hover{

    transform:translateY(-2px);

    box-shadow:
        0 12px 28px
        rgba(169,77,99,0.30);

}


/* =========================================
   MOBILE
========================================= */

@media(max-width:500px){

    .delete-modal{

        padding:25px 20px;

        border-radius:17px;

    }


    .delete-modal-actions{

        grid-template-columns:1fr;

    }


    .delete-modal-cancel{

        order:2;

    }


    .delete-modal-confirm{

        order:1;

    }

}

    </style>


</head>


<body>


    <!-- SIDEBAR -->

    <?php include "includes/sidebar.php"; ?>


    <!-- MAIN -->

    <main class="admin-main">


        <!-- TOPBAR -->

        <?php include "includes/topbar.php"; ?>


        <!-- CONTENT -->

        <section class="admin-content">


            <!-- PAGE HEADER -->

            <div class="categories-header">


                <div class="categories-heading">

                    <h2>

                        Categories

                    </h2>

                    <p>

                        Manage the categories available across the Ultimate marketplace.

                    </p>

                </div>


                <a
                    href="add-categories.php"
                    class="add-category-button"
                >

                    <i class="fa-solid fa-plus"></i>

                    Add Category

                </a>


            </div>


            <!-- CATEGORY GRID -->

            <div class="categories-grid">


                <?php if(mysqli_num_rows($result) > 0): ?>


                    <?php while($category = mysqli_fetch_assoc($result)): ?>


                        <article class="category-card">


                            <!-- IMAGE -->

                            <div class="category-image">


                                <img
                                    src="<?= htmlspecialchars($category["image"]); ?>"
                                    alt="<?= htmlspecialchars($category["title"]); ?>"
                                >


                                <div class="category-icon">

                                    <i
                                        class="<?= htmlspecialchars($category["icon"]); ?>"
                                    ></i>

                                </div>


                            </div>


                            <!-- CONTENT -->

                            <div class="category-content">


                                <h3 class="category-title">

                                    <?= htmlspecialchars($category["title"]); ?>

                                </h3>


                                <p class="category-description">

                                    <?= htmlspecialchars($category["description"]); ?>

                                </p>


                                <!-- FOOTER -->

                                <div class="category-footer">


                                    <span class="category-date">

                                        Added
                                        <?= date(
                                            "M d, Y",
                                            strtotime($category["created_at"])
                                        ); ?>

                                    </span>


                                    <div class="category-actions">


                                        <!-- EDIT -->

                                        <a
                                            href="edit-category.php?id=<?= (int)$category["id"]; ?>"
                                            class="category-action edit"
                                            title="Edit Category"
                                        >

                                            <i class="fa-solid fa-pen"></i>

                                        </a>


                                        <!-- DELETE -->
                                        <button
                                            type="button"
                                            class="category-action delete"
                                            title="Delete Category"
                                            data-category-id="<?= (int)$category["id"]; ?>"
                                            data-category-name="<?= htmlspecialchars(
                                                $category["title"],
                                                ENT_QUOTES,
                                                "UTF-8"
                                            ); ?>"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                            
                                        

                                            

                                        


                                    </div>


                                </div>


                            </div>


                        </article>


                    <?php endwhile; ?>


                <?php else: ?>


                    <!-- EMPTY STATE -->

                    <div class="categories-empty">


                        <div class="categories-empty-icon">

                            <i class="fa-solid fa-layer-group"></i>

                        </div>


                        <h3>

                            No Categories Yet

                        </h3>


                        <p>

                            Add your first marketplace category to get started.

                        </p>


                    </div>


                <?php endif; ?>


            </div>


        </section>


        <!-- FOOTER -->

        <?php include "includes/footer.php"; ?>


    </main>
            <!-- DELETE CATEGORY MODAL -->

            <div
                class="delete-modal-overlay"
                id="deleteModal"
            >

                <div class="delete-modal">

                    <button
                        type="button"
                        class="delete-modal-close"
                        onclick="closeDeleteModal()"
                    >

                        <i class="fa-solid fa-xmark"></i>

                    </button>


                    <div class="delete-modal-icon">

                        <i class="fa-solid fa-trash-can"></i>

                    </div>


                    <div class="delete-modal-content">

                        <h3>
                            Delete Category?
                        </h3>

                        <p>

                            Are you sure you want to delete

                            <strong id="deleteCategoryName"></strong>?

                            This action cannot be undone.

                        </p>

                    </div>


                    <div class="delete-modal-actions">

                        <button
                            type="button"
                            class="delete-modal-cancel"
                            onclick="closeDeleteModal()"
                        >

                            Cancel

                        </button>


                        <a
                            href="#"
                            class="delete-modal-confirm"
                            id="deleteConfirmButton"
                        >

                            <i class="fa-solid fa-trash-can"></i>

                            Delete Category

                        </a>

                    </div>

                </div>

            </div>


            <!-- DELETE MODAL JAVASCRIPT -->

            <script>

                const deleteModal =
                    document.getElementById("deleteModal");

                const deleteCategoryName =
                    document.getElementById("deleteCategoryName");

                const deleteConfirmButton =
                    document.getElementById("deleteConfirmButton");


                const deleteButtons =
                    document.querySelectorAll(
                        ".category-action.delete"
                    );


                deleteButtons.forEach(function(button){

                    button.addEventListener(
                        "click",
                        function(){

                            const categoryId =
                                this.dataset.categoryId;

                            const categoryName =
                                this.dataset.categoryName;


                            deleteCategoryName.textContent =
                                categoryName;


                            deleteConfirmButton.href =
                                "delete-category.php?id="
                                + categoryId;


                            deleteModal.classList.add("active");


                            document.body.style.overflow =
                                "hidden";

                        }
                    );

                });


                function closeDeleteModal(){

                    deleteModal.classList.remove("active");

                    document.body.style.overflow = "";

                }


                deleteModal.addEventListener(
                    "click",
                    function(event){

                        if(event.target === deleteModal){

                            closeDeleteModal();

                        }

                    }
                );


                document.addEventListener(
                    "keydown",
                    function(event){

                        if(event.key === "Escape"){

                            closeDeleteModal();

                        }

                    }
                );

            </script>


            </body>

            </html>


            </body>

            </html>