
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

$pageTitle = "Add Classification Knowledge";

$pageDescription = "Teach Ultimate how to classify marketplace listings.";


/* =========================
   FETCH CATEGORIES
========================= */

$categoryQuery = "
    SELECT
        id,
        title

    FROM categories

    ORDER BY title ASC
";

$categoryResult = mysqli_query(
    $conn,
    $categoryQuery
);


if(!$categoryResult){

    die(mysqli_error($conn));

}


/* =========================
   FORM SUBMISSION
========================= */

$error = "";

$success = "";


if(isset($_POST["save_knowledge"])){

    $category_id = (int)($_POST["category_id"] ?? 0);

    $entity_type = trim(
        $_POST["entity_type"] ?? ""
    );

    
    $entity_name = trim(
    $_POST["entity_name"] ?? ""
    );

    $attribute = trim(
    $_POST["attribute"] ?? ""
   );

     
    $min_price = $_POST["min_price"] ?? "";

    $max_price = $_POST["max_price"] ?? "";


    /*
    * Price ranges only apply when
    * the classification type is Price.
    */
    if($entity_type !== "Price"){

        $min_price = null;

        $max_price = null;

    }
    
    if($entity_type === "Price"){

        $entity_name = null;

    }



            


    $recommended_tier = $_POST["recommended_tier"] ?? "";

    $reason = trim(
        $_POST["reason"] ?? ""
    );

    $status = $_POST["status"] ?? "Active";


    /* =========================
       VALIDATION
    ========================= */

    if($category_id <= 0){

        $error = "Please select a category.";

    }

    elseif($entity_type === ""){

        $error = "Please enter what you are classifying.";

    }

    
    elseif(
        $entity_type !== "Price" &&
        $entity_name === ""
    ){
        $error = "Please enter the entity name.";
    }



    elseif(
        !in_array(
            $recommended_tier,
            ["Essentials", "Royals"],
            true
        )
    ){

        $error = "Please select a valid classification.";

    }

    
    elseif($entity_type === "Price" && $min_price === ""){
        $error = "Please enter the minimum price.";
    }
    elseif($entity_type === "Price" && $max_price === ""){
        $error = "Please enter the maximum price.";
    }
    elseif(
        $entity_type === "Price" &&
        is_numeric($min_price) &&
        is_numeric($max_price) &&
        (float)$max_price < (float)$min_price
    ){
        $error = "Maximum price cannot be lower than minimum price.";
    }



    elseif($reason === ""){

        $error = "Please explain why this entity belongs to the selected tier.";

    }

    elseif(
        !in_array(
            $status,
            ["Active", "Inactive"],
            true
        )
    ){

        $error = "Please select a valid status.";

    }


    /* =========================
       SAVE KNOWLEDGE
    ========================= */

    if($error === ""){

        $insertQuery = "
            INSERT INTO ultimate_classification_knowledge (

                category_id,
                entity_type,
                entity_name,
                attribute,
                min_price,
                max_price,
                recommended_tier,
                reason,
                status

            )

            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";


        $stmt = mysqli_prepare(
            $conn,
            $insertQuery
        );


        if(!$stmt){

            $error = mysqli_error($conn);

        }

        else{

            mysqli_stmt_bind_param(
                $stmt,
                "isssddsss",
                $category_id,
                $entity_type,
                $entity_name,
                $attribute,
                $min_price,
                $max_price,
                $recommended_tier,
                $reason,
                $status
            );


            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_close($stmt);

                header(
                    "Location: classification-knowledge.php"
                );

                exit();

            }

            else{

                $error = mysqli_stmt_error($stmt);

                mysqli_stmt_close($stmt);

            }

        }

    }

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
           PAGE
        ========================================= */

        .classification-form-page{

            padding:30px;

            max-width:950px;

            margin:0 auto;
        }


        /* =========================================
           HEADER
        ========================================= */

        .classification-form-header{

            margin-bottom:25px;
        }


        .classification-form-header h2{

            margin:0 0 6px;

            font-size:24px;

            font-weight:600;
        }


        .classification-form-header p{

            margin:0;

            color:#888894;

            font-size:12px;

            line-height:1.6;
        }


        .back-link{

            display:inline-flex;

            align-items:center;

            gap:7px;

            margin-bottom:18px;

            color:#888894;

            font-size:10px;

            text-decoration:none;

            transition:.2s ease;
        }


        .back-link:hover{

            color:#c084fc;
        }


        /* =========================================
           FORM CARD
        ========================================= */

        .classification-form-card{

            padding:28px;

            background:
                rgba(255,255,255,.025);

            border:
                1px solid rgba(255,255,255,.07);

            border-radius:18px;

            box-shadow:
                0 20px 55px rgba(0,0,0,.22);
        }


        /* =========================================
           FORM GRID
        ========================================= */

        .classification-form-grid{

            display:grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap:20px;
        }


        .form-group{

            display:flex;

            flex-direction:column;

            gap:8px;
        }


        .form-group.full-width{

            grid-column:1 / -1;
        }


        .form-group label{

            color:#cfcfd8;

            font-size:10px;

            font-weight:600;

            letter-spacing:.4px;
        }


        .form-group label span{

            color:#a855f7;
        }


        .form-group input,
        .form-group select,
        .form-group textarea{

            width:100%;

            padding:12px 13px;

            border:
                1px solid rgba(255,255,255,.08);

            border-radius:10px;

            outline:none;

            background:
                rgba(255,255,255,.035);

            color:#fff;

            font-family:inherit;

            font-size:11px;

            transition:.2s ease;
        }


        .form-group input::placeholder,
        .form-group textarea::placeholder{

            color:#555561;
        }


        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus{

            border-color:
                rgba(168,85,247,.45);

            background:
                rgba(168,85,247,.035);

            box-shadow:
                0 0 0 3px rgba(168,85,247,.06);
        }


        .form-group select option{

            background:#17171f;

            color:#fff;
        }


        .form-group textarea{

            min-height:120px;

            resize:vertical;

            line-height:1.6;
        }


        .field-help{

            color:#5f5f6b;

            font-size:9px;

            line-height:1.5;
        }


        /* =========================================
           TIER OPTIONS
        ========================================= */

        .tier-options{

            display:grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap:10px;
        }


        .tier-option{

            position:relative;
        }


        .tier-option input{

            position:absolute;

            opacity:0;

            pointer-events:none;
        }


        .tier-option label{

            display:flex;

            align-items:center;

            gap:10px;

            padding:12px;

            border:
                1px solid rgba(255,255,255,.08);

            border-radius:10px;

            background:
                rgba(255,255,255,.025);

            cursor:pointer;

            transition:.2s ease;
        }


        .tier-option label:hover{

            border-color:
                rgba(168,85,247,.25);

            background:
                rgba(168,85,247,.05);
        }


        .tier-option input:checked + label{

            border-color:
                rgba(168,85,247,.45);

            background:
                rgba(168,85,247,.09);

            box-shadow:
                0 0 0 2px rgba(168,85,247,.05);
        }


        .tier-icon{

            width:34px;

            height:34px;

            flex-shrink:0;

            display:flex;

            align-items:center;

            justify-content:center;

            border-radius:9px;

            background:
                rgba(255,255,255,.05);

            color:#aaaab5;
        }


        .tier-option input:checked + label .tier-icon{

            background:
                rgba(168,85,247,.14);

            color:#c084fc;
        }


        .tier-text{

            display:flex;

            flex-direction:column;

            gap:3px;
        }


        .tier-text strong{

            color:#fff;

            font-size:10px;
        }


        .tier-text span{

            color:#666672;

            font-size:8px;

            font-weight:400;
        }


        /* =========================================
           ALERTS
        ========================================= */

        .form-alert{

            margin-bottom:20px;

            padding:12px 14px;

            border-radius:10px;

            font-size:10px;

            line-height:1.5;
        }


        .form-alert.error{

            background:
                rgba(239,68,68,.08);

            border:
                1px solid rgba(239,68,68,.14);

            color:#fca5a5;
        }


        /* =========================================
           FORM ACTIONS
        ========================================= */

        .form-actions{

            display:flex;

            align-items:center;

            justify-content:flex-end;

            gap:10px;

            margin-top:25px;

            padding-top:20px;

            border-top:
                1px solid rgba(255,255,255,.06);
        }


        .cancel-btn,
        .save-btn{

            display:inline-flex;

            align-items:center;

            justify-content:center;

            gap:8px;

            min-width:130px;

            padding:12px 17px;

            border-radius:10px;

            font-family:inherit;

            font-size:10px;

            font-weight:600;

            text-decoration:none;

            cursor:pointer;

            transition:.2s ease;
        }


        .cancel-btn{

            border:
                1px solid rgba(255,255,255,.08);

            background:
                rgba(255,255,255,.025);

            color:#888894;
        }


        .cancel-btn:hover{

            background:
                rgba(255,255,255,.05);

            color:#fff;
        }


        .save-btn{

            border:0;

            background:
                linear-gradient(
                    135deg,
                    #7c3aed,
                    #a855f7
                );

            color:#fff;

            box-shadow:
                0 8px 22px rgba(124,58,237,.22);
        }


        .save-btn:hover{

            transform:translateY(-2px);

            box-shadow:
                0 12px 28px rgba(124,58,237,.35);
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media(max-width:700px){

            .classification-form-page{

                padding:20px;
            }


            .classification-form-grid{

                grid-template-columns:1fr;
            }


            .form-group.full-width{

                grid-column:auto;
            }


            .tier-options{

                grid-template-columns:1fr;
            }


            .classification-form-card{

                padding:20px;
            }


            .form-actions{

                flex-direction:column-reverse;
            }


            .cancel-btn,
            .save-btn{

                width:100%;
            }

        }


        @media(max-width:480px){

            .classification-form-page{

                padding:15px;
            }


            .classification-form-header h2{

                font-size:20px;
            }


            .classification-form-header p{

                font-size:10px;
            }


            .classification-form-card{

                padding:16px;
            }

        }

    </style>

</head>


<body>


<?php include "includes/sidebar.php"; ?>


<main class="admin-main">


    <?php include "includes/topbar.php"; ?>


    <div class="classification-form-page">


        <a
            href="classification-knowledge.php"
            class="back-link"
        >

            <i class="fa-solid fa-arrow-left"></i>

            Back to Classification Knowledge

        </a>


        <div class="classification-form-header">

            <h2>
                Add Classification Knowledge
            </h2>

            <p>
                Teach Ultimate how a particular entity should
                normally be classified.
            </p>

        </div>


        <?php if($error !== ""): ?>

            <div class="form-alert error">

                <i class="fa-solid fa-circle-exclamation"></i>

                <?= htmlspecialchars($error); ?>

            </div>

        <?php endif; ?>


        <form
            method="POST"
            class="classification-form-card"
        >


            <div class="classification-form-grid">


                <!-- CATEGORY -->

                <div class="form-group">

                    <label for="category_id">

                        Category <span>*</span>

                    </label>


                    <select
                        name="category_id"
                        id="category_id"
                        required
                    >

                        <option value="">
                            Select category
                        </option>


                        <?php while($category = mysqli_fetch_assoc($categoryResult)): ?>

                            <option
                                value="<?= (int)$category["id"]; ?>"
                                <?= (
                                    isset($_POST["category_id"]) &&
                                    (int)$_POST["category_id"]
                                    === (int)$category["id"]
                                )
                                    ? "selected"
                                    : ""
                                ?>
                            >

                                <?= htmlspecialchars(
                                    $category["title"]
                                ); ?>

                            </option>

                        <?php endwhile; ?>

                    </select>


                    <span class="field-help">

                        Select the Ultimate category this knowledge belongs to.

                    </span>

                </div>



                
            <!-- ENTITY TYPE -->

            <div class="form-group">

                <label for="entity_type">

                    What are you classifying? <span>*</span>

                </label>


                <select
                    name="entity_type"
                    id="entity_type"
                    required
                >

                    <option value="">
                        Select type
                    </option>

                    <option
                        value="Venue"
                        <?= (
                            ($_POST["entity_type"] ?? "") === "Venue"
                        ) ? "selected" : "" ?>
                    >
                        Venue
                    </option>

                    <option
                        value="Brand"
                        <?= (
                            ($_POST["entity_type"] ?? "") === "Brand"
                        ) ? "selected" : "" ?>
                    >
                        Brand
                    </option>

                    <option
                        value="Vehicle"
                        <?= (
                            ($_POST["entity_type"] ?? "") === "Vehicle"
                        ) ? "selected" : "" ?>
                    >
                        Vehicle
                    </option>

                    <option
                        value="Restaurant"
                        <?= (
                            ($_POST["entity_type"] ?? "") === "Restaurant"
                        ) ? "selected" : "" ?>
                    >
                        Restaurant
                    </option>

                    <option
                        value="Service"
                        <?= (
                            ($_POST["entity_type"] ?? "") === "Service"
                        ) ? "selected" : "" ?>
                    >
                        Service
                    </option>

                    <option
                        value="Product"
                        <?= (
                            ($_POST["entity_type"] ?? "") === "Product"
                        ) ? "selected" : "" ?>
                    >
                        Product
                    </option>

                    <option
                        value="Artist"
                        <?= (
                            ($_POST["entity_type"] ?? "") === "Artist"
                        ) ? "selected" : "" ?>
                    >
                        Artist
                    </option>

                    <option
                        value="Price"
                        <?= (
                            ($_POST["entity_type"] ?? "") === "Price"
                        ) ? "selected" : "" ?>
                    >
                        Price
                    </option>

                    <option
                        value="Other"
                        <?= (
                            ($_POST["entity_type"] ?? "") === "Other"
                        ) ? "selected" : "" ?>
                    >
                        Other
                    </option>

                </select>


                <span class="field-help">

                    Choose what kind of classification knowledge you are adding.

                </span>

            </div>


                
<!-- =========================================
     ENTITY / PRICE RANGE
========================================= -->

            <div class="form-group" id="entity-name-group">

                <label for="entity_name">
                    Entity Name <span>*</span>
                </label>

                <input
                    type="text"
                    name="entity_name"
                    id="entity_name"
                    placeholder="e.g. Ikoyi Hotel"
                    value="<?= htmlspecialchars(
                        $_POST["entity_name"] ?? ""
                    ); ?>"
                >

                <span class="field-help">

                    Enter the specific entity Ultimate should recognize.

                </span>

            </div>


            <!-- =========================================
                PRICE RANGE
            ========================================= -->

            <div
                class="form-group"
                id="price-range-group"
                style="display:none;"
            >

                <label>
                    Price Range <span>*</span>
                </label>


                <div
                    style="
                        display:grid;
                        grid-template-columns:1fr 1fr;
                        gap:10px;
                    "
                >

                    <input
                        type="number"
                        name="min_price"
                        id="min_price"
                        placeholder="Minimum price"
                        min="0"
                        step="0.01"
                        value="<?= htmlspecialchars(
                            $_POST["min_price"] ?? ""
                        ); ?>"
                    >


                    <input
                        type="number"
                        name="max_price"
                        id="max_price"
                        placeholder="Maximum price"
                        min="0"
                        step="0.01"
                        value="<?= htmlspecialchars(
                            $_POST["max_price"] ?? ""
                        ); ?>"
                    >

                </div>


                <span class="field-help">

                    Define the price range that should normally receive
                    the selected classification.

                </span>

            </div>




                <!-- ATTRIBUTE -->

                <div class="form-group">

                    <label for="attribute">

                        Attribute

                    </label>


                    <input
                        type="text"
                        name="attribute"
                        id="attribute"
                        placeholder="e.g. Luxury venue"
                        value="<?= htmlspecialchars(
                            $_POST["attribute"] ?? ""
                        ); ?>"
                    >


                    <span class="field-help">

                        Optional characteristic that helps describe the entity.

                    </span>

                </div>



                <!-- TIER -->

                <div class="form-group full-width">

                    <label>

                        Recommended Tier <span>*</span>

                    </label>


                    <div class="tier-options">


                        <div class="tier-option">

                            <input
                                type="radio"
                                name="recommended_tier"
                                id="tier_essentials"
                                value="Essentials"
                                <?= (
                                    ($_POST["recommended_tier"] ?? "")
                                    === "Essentials"
                                )
                                    ? "checked"
                                    : ""
                                ?>
                            >


                            <label for="tier_essentials">

                                <div class="tier-icon">

                                    <i class="fa-solid fa-star"></i>

                                </div>


                                <div class="tier-text">

                                    <strong>
                                        Essentials
                                    </strong>

                                    <span>
                                        Basic, practical and affordable.
                                    </span>

                                </div>

                            </label>

                        </div>



                        <div class="tier-option">

                            <input
                                type="radio"
                                name="recommended_tier"
                                id="tier_royals"
                                value="Royals"
                                <?= (
                                    ($_POST["recommended_tier"] ?? "")
                                    === "Royals"
                                )
                                    ? "checked"
                                    : ""
                                ?>
                            >


                            <label for="tier_royals">

                                <div class="tier-icon">

                                    <i class="fa-solid fa-crown"></i>

                                </div>


                                <div class="tier-text">

                                    <strong>
                                        Royals
                                    </strong>

                                    <span>
                                        Premium, luxury and high-quality.
                                    </span>

                                </div>

                            </label>

                        </div>


                    </div>

                </div>



                <!-- REASON -->

                <div class="form-group full-width">

                    <label for="reason">

                        Why this classification? <span>*</span>

                    </label>


                    <textarea
                        name="reason"
                        id="reason"
                        placeholder="Explain why Ultimate should normally recommend this tier for this entity..."
                        required
                    ><?= htmlspecialchars(
                        $_POST["reason"] ?? ""
                    ); ?></textarea>


                    <span class="field-help">

                        This explanation becomes part of Ultimate's
                        classification knowledge and can later help
                        recommendation systems understand the decision.

                    </span>

                </div>



                <!-- STATUS -->

                <div class="form-group">

                    <label for="status">

                        Status

                    </label>


                    <select
                        name="status"
                        id="status"
                    >

                        <option
                            value="Active"
                            <?= (
                                ($_POST["status"] ?? "Active")
                                === "Active"
                            )
                                ? "selected"
                                : ""
                            ?>
                        >
                            Active
                        </option>


                        <option
                            value="Inactive"
                            <?= (
                                ($_POST["status"] ?? "")
                                === "Inactive"
                            )
                                ? "selected"
                                : ""
                            ?>
                        >
                            Inactive
                        </option>

                    </select>


                    <span class="field-help">

                        Inactive knowledge will not be used for recommendations.

                    </span>

                </div>


            </div>



            <!-- FORM ACTIONS -->

            <div class="form-actions">

                <a
                    href="classification-knowledge.php"
                    class="cancel-btn"
                >

                    Cancel

                </a>


                <button
                    type="submit"
                    name="save_knowledge"
                    class="save-btn"
                >

                    <i class="fa-solid fa-brain"></i>

                    Save Knowledge

                </button>

            </div>


        </form>


    </div>


    <?php include "includes/footer.php"; ?>


</main>

<script>
    
const entityType = document.getElementById("entity_type");

const entityNameGroup = document.getElementById("entity-name-group");

const priceRangeGroup = document.getElementById("price-range-group");


entityType.addEventListener("change", function(){

    if(this.value === "Price"){

        entityNameGroup.style.display = "none";

        priceRangeGroup.style.display = "block";

    }else{

        entityNameGroup.style.display = "block";

        priceRangeGroup.style.display = "none";

    }

});


</script>


</body>

</html>
