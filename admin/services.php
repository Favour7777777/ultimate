
<?php

session_start();

if(!isset($_SESSION["admin_id"])){
    header("Location: login.php");
    exit();
}

require_once "../config.php";

$currentPage = "services";
$pageTitle = "Services";
$pageDescription = "Manage services available on your Ultimate marketplace";


//========================================
// FETCH SERVICES
//========================================

$serviceQuery = "
    SELECT
        services.id,
        services.service_name,
        services.description,
        services.price,
        services.discount_price,
        services.duration,
        services.service_type,
        services.image,
        services.status,
        services.created_at,
        categories.title AS category_name

    FROM services

    INNER JOIN categories
        ON services.category_id = categories.id

    ORDER BY services.created_at DESC
";

$serviceResult = mysqli_query($conn, $serviceQuery);

if(!$serviceResult){
    die("Failed to load services: " . mysqli_error($conn));
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

    <title><?= htmlspecialchars($pageTitle); ?> | Ultimate Admin</title>

    <!-- Google Font -->

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- Font Awesome -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <!-- Admin CSS -->

    <link
        rel="stylesheet"
        href="assets/css/admin.css"
    >


    <style>

        /*========================================
                SERVICES PAGE
        =========================================*/

        .services-page-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:20px;
            margin-bottom:30px;
        }


        .services-page-title h1{
            margin:0 0 8px;
            font-size:28px;
            font-weight:600;
        }


        .services-page-title p{
            margin:0;
            color:#aaa;
            font-size:14px;
        }


        /*========================================
                ADD SERVICE BUTTON
        =========================================*/

        .add-service-btn{
            display:inline-flex;
            align-items:center;
            gap:10px;

            padding:13px 20px;

            background:linear-gradient(
                135deg,
                #7c3aed,
                #a855f7
            );

            color:#fff;

            text-decoration:none;

            border-radius:12px;

            font-size:14px;
            font-weight:500;

            transition:all .3s ease;

            box-shadow:
                0 8px 25px rgba(124,58,237,.25);
        }


        .add-service-btn:hover{
            transform:translateY(-2px);

            box-shadow:
                0 12px 30px rgba(124,58,237,.4);
        }


        /*========================================
                TABLE WRAPPER
        =========================================*/

        .services-table-container{
            width:100%;

            background:rgba(255,255,255,.035);

            border:1px solid rgba(255,255,255,.08);

            border-radius:18px;

            overflow:hidden;

            backdrop-filter:blur(15px);

            -webkit-backdrop-filter:blur(15px);
        }


        .services-table-wrapper{
            width:100%;
            overflow-x:auto;
        }


        /*========================================
                TABLE
        =========================================*/

        .services-table{
            width:100%;
            min-width:1050px;

            border-collapse:collapse;
        }


        .services-table thead{
            background:rgba(124,58,237,.10);
        }


        .services-table th{
            padding:17px 18px;

            text-align:left;

            font-size:12px;

            font-weight:600;

            text-transform:uppercase;

            letter-spacing:.6px;

            color:#bbb;

            border-bottom:1px solid rgba(255,255,255,.08);

            white-space:nowrap;
        }


        .services-table td{
            padding:18px;

            border-bottom:1px solid rgba(255,255,255,.06);

            font-size:13px;

            color:#ddd;

            vertical-align:middle;
        }


        .services-table tbody tr{
            transition:background .25s ease;
        }


        .services-table tbody tr:hover{
            background:rgba(255,255,255,.035);
        }


        .services-table tbody tr:last-child td{
            border-bottom:none;
        }


        /*========================================
                SERVICE NAME
        =========================================*/

        .service-name-cell{
            display:flex;
            align-items:center;
            gap:13px;

            min-width:220px;
        }


        .service-thumb{
            width:55px;
            height:55px;

            flex-shrink:0;

            border-radius:12px;

            overflow:hidden;

            background:#181818;

            border:1px solid rgba(255,255,255,.08);
        }


        .service-thumb img{
            width:100%;
            height:100%;

            object-fit:cover;

            display:block;
        }


        .service-name{
            font-weight:500;
            color:#fff;

            max-width:180px;

            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
        }


        /*========================================
                CATEGORY
        =========================================*/

        .category-badge{
            display:inline-block;

            padding:6px 10px;

            border-radius:20px;

            background:rgba(168,85,247,.10);

            border:1px solid rgba(168,85,247,.18);

            color:#c084fc;

            font-size:11px;

            white-space:nowrap;
        }


        /*========================================
                PRICE
        =========================================*/

        .service-price{
            display:flex;
            flex-direction:column;
            gap:3px;
        }


        .current-price{
            color:#fff;
            font-weight:600;
        }


        .original-price{
            color:#777;
            font-size:11px;
        }


        /*========================================
                SERVICE TYPE
        =========================================*/

        .service-type{
            color:#bbb;
            white-space:nowrap;
        }


        /*========================================
                STATUS
        =========================================*/

        .status-badge{
            display:inline-flex;
            align-items:center;
            gap:6px;

            padding:6px 11px;

            border-radius:20px;

            font-size:11px;
            font-weight:500;

            white-space:nowrap;
        }


        .status-badge::before{
            content:"";

            width:6px;
            height:6px;

            border-radius:50%;
        }


        .status-active{
            background:rgba(34,197,94,.10);
            color:#4ade80;
        }


        .status-active::before{
            background:#4ade80;
        }


        .status-inactive{
            background:rgba(239,68,68,.10);
            color:#f87171;
        }


        .status-inactive::before{
            background:#f87171;
        }


        /*========================================
                ACTIONS
        =========================================*/

        .service-actions{
            display:flex;
            align-items:center;
            gap:8px;
        }


        .action-btn{
            width:36px;
            height:36px;

            display:flex;
            align-items:center;
            justify-content:center;

            border-radius:9px;

            text-decoration:none;

            transition:all .25s ease;
        }


        .edit-service-btn{
            color:#c084fc;

            background:rgba(168,85,247,.10);

            border:1px solid rgba(168,85,247,.15);
        }


        .edit-service-btn:hover{
            background:rgba(168,85,247,.20);
            transform:translateY(-2px);
        }


        .delete-service-btn{
            border:1px solid rgba(239,68,68,.15);

            background:rgba(239,68,68,.08);

            color:#f87171;

            cursor:pointer;
        }


        .delete-service-btn:hover{
            background:rgba(239,68,68,.18);

            transform:translateY(-2px);
        }


        /*========================================
                EMPTY STATE
        =========================================*/

        .empty-services{
            padding:70px 30px;

            text-align:center;
        }


        .empty-services i{
            font-size:45px;

            color:#7c3aed;

            margin-bottom:18px;
        }


        .empty-services h3{
            margin:0 0 8px;

            color:#fff;

            font-size:18px;
        }


        .empty-services p{
            margin:0;

            color:#888;

            font-size:13px;
        }


        /*========================================
                DELETE MODAL
        =========================================*/

        .delete-modal{
            position:fixed;

            inset:0;

            display:none;

            align-items:center;
            justify-content:center;

            padding:20px;

            background:rgba(0,0,0,.72);

            backdrop-filter:blur(8px);

            -webkit-backdrop-filter:blur(8px);

            z-index:9999;
        }


        .delete-modal.active{
            display:flex;
        }


        .delete-modal-box{
            width:100%;
            max-width:430px;

            padding:30px;

            background:
                linear-gradient(
                    145deg,
                    rgba(30,30,30,.98),
                    rgba(15,15,15,.98)
                );

            border:1px solid rgba(255,255,255,.09);

            border-radius:20px;

            box-shadow:
                0 25px 80px rgba(0,0,0,.6);

            text-align:center;

            animation:modalPop .25s ease;
        }


        @keyframes modalPop{

            from{
                opacity:0;
                transform:scale(.92) translateY(10px);
            }

            to{
                opacity:1;
                transform:scale(1) translateY(0);
            }

        }


        .delete-icon{
            width:60px;
            height:60px;

            margin:0 auto 18px;

            display:flex;
            align-items:center;
            justify-content:center;

            border-radius:50%;

            background:rgba(239,68,68,.10);

            border:1px solid rgba(239,68,68,.18);

            color:#f87171;

            font-size:23px;
        }


        .delete-modal-box h3{
            margin:0 0 10px;

            color:#fff;

            font-size:20px;
        }


        .delete-modal-box p{
            margin:0 auto 25px;

            max-width:330px;

            color:#999;

            font-size:13px;

            line-height:1.6;
        }


        .delete-modal-actions{
            display:flex;
            justify-content:center;

            gap:10px;
        }


        .modal-btn{
            padding:11px 20px;

            border-radius:10px;

            font-family:inherit;

            font-size:13px;

            cursor:pointer;

            transition:all .25s ease;
        }


        .cancel-delete{
            background:#222;

            color:#ccc;

            border:1px solid rgba(255,255,255,.08);
        }


        .cancel-delete:hover{
            background:#2b2b2b;
        }


        .confirm-delete{
            background:#dc2626;

            color:#fff;

            border:1px solid #dc2626;
        }


        .confirm-delete:hover{
            background:#b91c1c;
        }


        /*========================================
                RESPONSIVE
        =========================================*/

        @media(max-width:768px){

            .services-page-header{
                flex-direction:column;
                align-items:flex-start;
            }


            .add-service-btn{
                width:100%;
                justify-content:center;
            }


            .services-page-title h1{
                font-size:24px;
            }


            .services-table-container{
                border-radius:14px;
            }


            .delete-modal-box{
                padding:25px 20px;
            }

        }


        @media(max-width:480px){

            .services-page-title h1{
                font-size:21px;
            }


            .services-page-title p{
                font-size:12px;
            }


            .delete-modal-actions{
                flex-direction:column;
            }


            .modal-btn{
                width:100%;
            }

        }

    </style>

</head>


<body>


<?php include "includes/sidebar.php"; ?>


<main class="admin-main">


    <?php include "includes/topbar.php"; ?>


    <section class="admin-content">


        <!--========================================
                PAGE HEADER
        =========================================-->

        <div class="services-page-header">

            <!-- <div class="services-page-title">

                <h1>
                    <?= htmlspecialchars($pageTitle); ?>
                </h1>

                <p>
                    <?= htmlspecialchars($pageDescription); ?>
                </p>

            </div> -->


            <a
                href="add-service.php"
                class="add-service-btn"
            >

                <i class="fa-solid fa-plus"></i>

                Add Service

            </a>

        </div>


        <!--========================================
                SERVICES TABLE
        =========================================-->

        <div class="services-table-container">

            <?php if(mysqli_num_rows($serviceResult) > 0): ?>

                <div class="services-table-wrapper">

                    <table class="services-table">

                        <thead>

                            <tr>

                                <th>Service</th>

                                <th>Category</th>

                                <th>Price</th>

                                <th>Duration</th>

                                <th>Service Type</th>

                                <th>Status</th>

                                <th>Actions</th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php while($service = mysqli_fetch_assoc($serviceResult)): ?>

                                <tr>

                                    <!-- Service -->

                                    <td>

                                        <div class="service-name-cell">

                                            <div class="service-thumb">

                                                <img
                                                    src="<?= htmlspecialchars($service['image']); ?>"
                                                    alt="<?= htmlspecialchars($service['service_name']); ?>"
                                                >

                                            </div>


                                            <div class="service-name">

                                                <?= htmlspecialchars($service['service_name']); ?>

                                            </div>

                                        </div>

                                    </td>


                                    <!-- Category -->

                                    <td>

                                        <span class="category-badge">

                                            <?= htmlspecialchars($service['category_name']); ?>

                                        </span>

                                    </td>


                                    <!-- Price -->

                                    <td>

                                        <div class="service-price">

                                            <?php if(!empty($service['discount_price'])): ?>

                                                <span class="current-price">

                                                    $<?= number_format($service['discount_price'], 2); ?>

                                                </span>

                                                <del class="original-price">

                                                    $<?= number_format($service['price'], 2); ?>

                                                </del>

                                            <?php else: ?>

                                                <span class="current-price">

                                                    $<?= number_format($service['price'], 2); ?>

                                                </span>

                                            <?php endif; ?>

                                        </div>

                                    </td>


                                    <!-- Duration -->

                                    <td>

                                        <?= !empty($service['duration'])
                                            ? htmlspecialchars($service['duration'])
                                            : "—";
                                        ?>

                                    </td>


                                    <!-- Service Type -->

                                    <td>

                                        <span class="service-type">

                                            <?= htmlspecialchars($service['service_type']); ?>

                                        </span>

                                    </td>


                                    <!-- Status -->

                                    <td>

                                        <?php if($service['status'] === "Active"): ?>

                                            <span class="status-badge status-active">
                                                Active
                                            </span>

                                        <?php else: ?>

                                            <span class="status-badge status-inactive">
                                                Inactive
                                            </span>

                                        <?php endif; ?>

                                    </td>


                                    <!-- Actions -->

                                    <td>

                                        <div class="service-actions">

                                            <a
                                                href="edit-service.php?id=<?= (int)$service['id']; ?>"
                                                class="action-btn edit-service-btn"
                                                title="Edit Service"
                                            >

                                                <i class="fa-solid fa-pen"></i>

                                            </a>


                                            <button
                                                type="button"
                                                class="action-btn delete-service-btn"
                                                title="Delete Service"
                                                onclick="openDeleteModal(<?= (int)$service['id']; ?>)"
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

                <div class="empty-services">

                    <i class="fa-solid fa-briefcase"></i>

                    <h3>No Services Yet</h3>

                    <p>
                        Start adding services to your marketplace.
                    </p>

                </div>

            <?php endif; ?>

        </div>


    </section>


    <?php include "includes/footer.php"; ?>


</main>


<!--========================================
        DELETE MODAL
=========================================-->

<div
    class="delete-modal"
    id="deleteModal"
>

    <div class="delete-modal-box">


        <div class="delete-icon">

            <i class="fa-solid fa-trash"></i>

        </div>


        <h3>
            Delete Service?
        </h3>


        <p>
            This action will permanently remove this service
            from your database. This cannot be undone.
        </p>


        <div class="delete-modal-actions">

            <button
                type="button"
                class="modal-btn cancel-delete"
                onclick="closeDeleteModal()"
            >
                Cancel
            </button>


            <button
                type="button"
                class="modal-btn confirm-delete"
                onclick="confirmDeleteService()"
            >
                Delete Service
            </button>

        </div>

    </div>

</div>


<script>

    let selectedServiceId = null;


    function openDeleteModal(serviceId){

        selectedServiceId = serviceId;

        document
            .getElementById("deleteModal")
            .classList
            .add("active");

        document.body.style.overflow = "hidden";

    }


    function closeDeleteModal(){

        document
            .getElementById("deleteModal")
            .classList
            .remove("active");

        document.body.style.overflow = "";

        selectedServiceId = null;

    }


    function confirmDeleteService(){

        if(selectedServiceId !== null){

            window.location.href =
                "delete-service.php?id=" + selectedServiceId;

        }

    }


    /* Close when clicking backdrop */

    document
        .getElementById("deleteModal")
        .addEventListener("click", function(event){

            if(event.target === this){

                closeDeleteModal();

            }

        });


    /* Close with Escape */

    document.addEventListener("keydown", function(event){

        if(event.key === "Escape"){

            closeDeleteModal();

        }

    });

</script>


</body>

</html>

