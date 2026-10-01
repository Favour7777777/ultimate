
<?php

session_start();

require_once "../config.php";


/* =========================
   ADMIN LOGIN CHECK
========================= */

if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");

    exit();

}


/* =========================
   PAGE SETTINGS
========================= */

$currentPage = "Classification Knowledge";

$pageTitle = "Classification Knowledge";

$pageDescription = "Manage Ultimate's Essentials and Royals classification knowledge.";


/* =========================
   FETCH CLASSIFICATION KNOWLEDGE
========================= */

$knowledgeQuery = "
    SELECT
        ultimate_classification_knowledge.id,
        ultimate_classification_knowledge.entity_type,
        ultimate_classification_knowledge.entity_name,
        ultimate_classification_knowledge.attribute,
        ultimate_classification_knowledge.min_price,
        ultimate_classification_knowledge.max_price,
        ultimate_classification_knowledge.recommended_tier,
        ultimate_classification_knowledge.reason,
        ultimate_classification_knowledge.status,
        ultimate_classification_knowledge.created_at,
        categories.title AS category_name

    FROM ultimate_classification_knowledge

    INNER JOIN categories
        ON ultimate_classification_knowledge.category_id = categories.id

    ORDER BY ultimate_classification_knowledge.created_at DESC
";


$knowledgeResult = mysqli_query(
    $conn,
    $knowledgeQuery
);


if(!$knowledgeResult){

    die(mysqli_error($conn));

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
        <?= htmlspecialchars($pageTitle); ?> | Ultimate Admin
    </title>


    <!-- ADMIN CSS -->

    <link
        rel="stylesheet"
        href="assets/css/admin.css"
    >


    <!-- FONT AWESOME -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >


    <style>

        /* =========================================
           CLASSIFICATION KNOWLEDGE
        ========================================= */

        .classification-page{
            padding:30px;
        }


        /* =========================================
           PAGE HEADER
        ========================================= */

        .classification-header{

            display:flex;

            align-items:center;

            justify-content:space-between;

            gap:20px;

            margin-bottom:25px;
        }


        .classification-header h2{

            margin:0 0 6px;

            font-size:24px;

            font-weight:600;
        }


        .classification-header p{

            margin:0;

            color:#888894;

            font-size:12px;
        }


        /* =========================================
           ADD BUTTON
        ========================================= */

        .add-knowledge-btn{

            display:inline-flex;

            align-items:center;

            gap:8px;

            padding:11px 17px;

            border-radius:10px;

            background:
                linear-gradient(
                    135deg,
                    #7c3aed,
                    #a855f7
                );

            color:#fff;

            font-size:11px;

            font-weight:600;

            text-decoration:none;

            transition:.25s ease;

            box-shadow:
                0 8px 22px rgba(124,58,237,.22);
        }


        .add-knowledge-btn:hover{

            transform:translateY(-2px);

            box-shadow:
                0 12px 28px rgba(124,58,237,.35);
        }


        /* =========================================
           TABLE CONTAINER
        ========================================= */

        .knowledge-table-container{

            width:100%;

            overflow-x:auto;

            background:
                rgba(255,255,255,.025);

            border:1px solid rgba(255,255,255,.07);

            border-radius:16px;

            box-shadow:
                0 15px 45px rgba(0,0,0,.2);
        }


        .knowledge-table{

            width:100%;

            min-width:900px;

            border-collapse:collapse;
        }


        .knowledge-table thead{

            background:
                rgba(168,85,247,.08);
        }


        .knowledge-table th{

            padding:15px 16px;

            text-align:left;

            color:#aaaab5;

            font-size:9px;

            font-weight:600;

            letter-spacing:1px;

            text-transform:uppercase;

            white-space:nowrap;

            border-bottom:
                1px solid rgba(255,255,255,.07);
        }


        .knowledge-table td{

            padding:16px;

            font-size:11px;

            color:#d6d6df;

            border-bottom:
                1px solid rgba(255,255,255,.05);

            vertical-align:middle;
        }


        .knowledge-table tbody tr{

            transition:.2s ease;
        }


        .knowledge-table tbody tr:hover{

            background:
                rgba(168,85,247,.035);
        }


        .knowledge-table tbody tr:last-child td{

            border-bottom:none;
        }


        /* =========================================
           CATEGORY
        ========================================= */

        .category-name{

            color:#fff;

            font-weight:600;
        }


        /* =========================================
           ENTITY TYPE
        ========================================= */

        .entity-type{

            color:#aaaab5;

            font-weight:500;
        }


        /* =========================================
           ENTITY NAME
        ========================================= */

        .entity-name{

            color:#fff;

            font-weight:600;
        }


        /* =========================================
           ATTRIBUTE
        ========================================= */

        .entity-attribute{

            color:#858592;

            font-size:10px;
        }


        .no-attribute{

            color:#555560;

            font-size:10px;
        }


        /* =========================================
           TIER BADGE
        ========================================= */

        .tier-badge{

            display:inline-flex;

            align-items:center;

            gap:6px;

            padding:6px 9px;

            border-radius:8px;

            font-size:9px;

            font-weight:600;

            white-space:nowrap;
        }


        .tier-badge.essentials{

            background:
                rgba(255,255,255,.06);

            color:#d4d4dc;

            border:
                1px solid rgba(255,255,255,.08);
        }


        .tier-badge.royals{

            background:
                rgba(168,85,247,.12);

            color:#c084fc;

            border:
                1px solid rgba(168,85,247,.18);
        }


        /* =========================================
           STATUS
        ========================================= */

        .status-badge{

            display:inline-flex;

            align-items:center;

            gap:6px;

            padding:6px 9px;

            border-radius:8px;

            font-size:9px;

            font-weight:600;
        }


        .status-badge.active{

            background:
                rgba(34,197,94,.08);

            color:#86efac;

            border:
                1px solid rgba(34,197,94,.12);
        }


        .status-badge.inactive{

            background:
                rgba(239,68,68,.08);

            color:#fca5a5;

            border:
                1px solid rgba(239,68,68,.12);
        }


        /* =========================================
           ACTIONS
        ========================================= */

        .knowledge-actions{

            display:flex;

            align-items:center;

            gap:7px;
        }


        .knowledge-action{

            width:31px;

            height:31px;

            display:flex;

            align-items:center;

            justify-content:center;

            border-radius:8px;

            border:1px solid rgba(255,255,255,.07);

            background:
                rgba(255,255,255,.035);

            color:#888894;

            text-decoration:none;

            transition:.2s ease;
        }


        .knowledge-action:hover{

            background:
                rgba(168,85,247,.1);

            color:#c084fc;

            border-color:
                rgba(168,85,247,.18);
        }


        .knowledge-action.delete:hover{

            background:
                rgba(239,68,68,.08);

            color:#f87171;

            border-color:
                rgba(239,68,68,.15);
        }


        /* =========================================
           EMPTY STATE
        ========================================= */

        .knowledge-empty{

            padding:70px 25px;

            text-align:center;
        }


        .knowledge-empty-icon{

            width:60px;

            height:60px;

            margin:0 auto 18px;

            display:flex;

            align-items:center;

            justify-content:center;

            border-radius:16px;

            background:
                rgba(168,85,247,.08);

            color:#a855f7;

            font-size:22px;
        }


        .knowledge-empty h3{

            margin-bottom:7px;

            color:#fff;

            font-size:15px;
        }


        .knowledge-empty p{

            margin-bottom:20px;

            color:#666672;

            font-size:11px;
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media(max-width:768px){

            .classification-page{

                padding:20px;
            }


            .classification-header{

                align-items:flex-start;

                flex-direction:column;
            }


            .add-knowledge-btn{

                width:100%;

                justify-content:center;
            }

        }


        @media(max-width:480px){

            .classification-page{

                padding:15px;
            }


            .classification-header h2{

                font-size:20px;
            }


            .classification-header p{

                font-size:10px;
                line-height:1.6;
            }

        }

    </style>

</head>


<body>


<?php include "includes/sidebar.php"; ?>


<main class="admin-main">


    <?php include "includes/topbar.php"; ?>


    <div class="classification-page">


        <!-- =====================================
             PAGE HEADER
        ====================================== -->

        <div class="classification-header">

            <div>

                <h2>
                    Ultimate Classification Knowledge
                </h2>

                <p>
                    Manage the knowledge Ultimate uses to recommend
                    Essentials and Royals classifications.
                </p>

            </div>


            <a
                href="add-classification-knowledge.php"
                class="add-knowledge-btn"
            >

                <i class="fa-solid fa-plus"></i>

                Add Knowledge

            </a>

        </div>



        <!-- =====================================
             KNOWLEDGE TABLE
        ====================================== -->

        <div class="knowledge-table-container">


            <?php if(mysqli_num_rows($knowledgeResult) === 0): ?>


                <div class="knowledge-empty">

                    <div class="knowledge-empty-icon">

                        <i class="fa-solid fa-brain"></i>

                    </div>


                    <h3>
                        No Classification Knowledge Yet
                    </h3>


                    <p>
                        Start teaching Ultimate how to classify
                        marketplace listings.
                    </p>


                    <a
                        href="add-classification-knowledge.php"
                        class="add-knowledge-btn"
                    >

                        <i class="fa-solid fa-plus"></i>

                        Add First Knowledge

                    </a>

                </div>


            <?php else: ?>


                <table class="knowledge-table">


                    <thead>

                        <tr>

                            <th>Category</th>

                            <th>Type</th>

                            <th>Entity</th>

                            <th>Attribute</th>

                            <th>Tier</th>

                            <th>Status</th>

                            <th>Actions</th>

                        </tr>

                    </thead>


                    <tbody>


                        <?php while($knowledge = mysqli_fetch_assoc($knowledgeResult)): ?>


                            <tr>


                                <!-- CATEGORY -->

                                <td>

                                    <span class="category-name">

                                        <?= htmlspecialchars(
                                            $knowledge["category_name"]
                                        ); ?>

                                    </span>

                                </td>


                                <!-- ENTITY TYPE -->

                                <td>

                                    <span class="entity-type">

                                        <?= htmlspecialchars(
                                            $knowledge["entity_type"]
                                        ); ?>

                                    </span>

                                </td>


                                <!-- ENTITY -->

                                <td>

                                    <span class="entity-name">

                                        
                                        
                                <?php if($knowledge["entity_type"] === "Price"): ?>

                                    ₦<?= number_format((float)$knowledge["min_price"], 2); ?>

                                    –

                                    ₦<?= number_format((float)$knowledge["max_price"], 2); ?>

                                <?php else: ?>

                                    <?= htmlspecialchars($knowledge["entity_name"] ?? "—"); ?>

                                <?php endif; ?>




                                    </span>

                                </td>


                                <!-- ATTRIBUTE -->

                                <td>

                                    <?php if(
                                        !empty($knowledge["attribute"])
                                    ): ?>

                                        <span class="entity-attribute">

                                            <?= htmlspecialchars(
                                                $knowledge["attribute"]
                                            ); ?>

                                        </span>

                                    <?php else: ?>

                                        <span class="no-attribute">

                                            —

                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- TIER -->

                                <td>

                                    <?php if(
                                        $knowledge["recommended_tier"]
                                        === "Royals"
                                    ): ?>

                                        <span class="tier-badge royals">

                                            <i class="fa-solid fa-crown"></i>

                                            Royals

                                        </span>

                                    <?php else: ?>

                                        <span class="tier-badge essentials">

                                            <i class="fa-solid fa-star"></i>

                                            Essentials

                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    <?php if(
                                        $knowledge["status"]
                                        === "Active"
                                    ): ?>

                                        <span class="status-badge active">

                                            <i class="fa-solid fa-circle-check"></i>

                                            Active

                                        </span>

                                    <?php else: ?>

                                        <span class="status-badge inactive">

                                            <i class="fa-solid fa-circle-xmark"></i>

                                            Inactive

                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- ACTIONS -->

                                <td>

                                    <div class="knowledge-actions">


                                        <a
                                            href="edit-classification-knowledge.php?id=<?= (int)$knowledge["id"]; ?>"
                                            class="knowledge-action"
                                            title="Edit"
                                        >

                                            <i class="fa-solid fa-pen"></i>

                                        </a>


                                        <a
                                            href="delete-classification-knowledge.php?id=<?= (int)$knowledge["id"]; ?>"
                                            class="knowledge-action delete"
                                            title="Delete"
                                        >

                                            <i class="fa-solid fa-trash"></i>

                                        </a>


                                    </div>

                                </td>


                            </tr>


                        <?php endwhile; ?>


                    </tbody>

                </table>


            <?php endif; ?>


        </div>


    </div>


    <?php include "includes/footer.php"; ?>


</main>


</body>

</html>

