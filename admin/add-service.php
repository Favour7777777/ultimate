
<?php

session_start();

if(!isset($_SESSION["admin_id"])){
    header("Location: login.php");
    exit();
}

require_once "../config.php";

$currentPage = "services";

$pageTitle = "Add Service";
$pageDescription = "Add a new service to your Ultimate marketplace";


// ==========================================
// FETCH CATEGORIES
// ==========================================

$categoryQuery = "
    SELECT id, title
    FROM categories
    ORDER BY title ASC
";

$categoryResult = mysqli_query($conn, $categoryQuery);

if(!$categoryResult){
    die("Failed to load categories: " . mysqli_error($conn));
}


// ==========================================
// FETCH SERVICE TYPE ENUM VALUES
// ==========================================

$serviceTypeQuery = "
    SHOW COLUMNS FROM services LIKE 'service_type'
";

$serviceTypeResult = mysqli_query($conn, $serviceTypeQuery);

if(!$serviceTypeResult){
    die("Failed to load service types: " . mysqli_error($conn));
}

$serviceTypeColumn = mysqli_fetch_assoc($serviceTypeResult);

$serviceTypes = [];

if($serviceTypeColumn){

    preg_match_all(
        "/'([^']*)'/",
        $serviceTypeColumn["Type"],
        $matches
    );

    $serviceTypes = $matches[1];
}


// ==========================================
// FORM VARIABLES
// ==========================================

$categoryId = "";
$serviceName = "";
$description = "";
$price = "";
$discountPrice = "";
$duration = "";
$serviceType = "";
$status = "Active";

$errorMessage = "";
$showSuccessModal = false;


// ==========================================
// HANDLE FORM SUBMISSION
// ==========================================

if(isset($_POST["add_service"])){

    $categoryId = $_POST["category_id"] ?? "";
    $serviceName = trim($_POST["service_name"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $price = $_POST["price"] ?? "";
    $discountPrice = $_POST["discount_price"] ?? "";
    $duration = trim($_POST["duration"] ?? "");
    $serviceType = $_POST["service_type"] ?? "";
    $status = $_POST["status"] ?? "Active";


    // ======================================
    // VALIDATION
    // ======================================

    if(
        empty($categoryId) ||
        empty($serviceName) ||
        empty($description) ||
        $price === "" ||
        empty($serviceType)
    ){

        $errorMessage = "Please fill in all required fields.";

    }elseif(!is_numeric($categoryId)){

        $errorMessage = "Invalid category selected.";

    }elseif(!is_numeric($price) || $price < 0){

        $errorMessage = "Please enter a valid price.";

    }elseif(
        $discountPrice !== "" &&
        (!is_numeric($discountPrice) || $discountPrice < 0)
    ){

        $errorMessage = "Please enter a valid discount price.";

    }elseif(
        $discountPrice !== "" &&
        $discountPrice >= $price
    ){

        $errorMessage = "Discount price must be lower than the original price.";

    }elseif(!in_array($serviceType, $serviceTypes, true)){

        $errorMessage = "Invalid service type selected.";

    }elseif(!in_array($status, ["Active", "Inactive"], true)){

        $errorMessage = "Invalid service status.";

    }elseif(!isset($_FILES["image"]) || $_FILES["image"]["error"] === UPLOAD_ERR_NO_FILE){

        $errorMessage = "Please upload a service image.";

    }else{


        // ==================================
        // IMAGE UPLOAD
        // ==================================

        $uploadDirectory = __DIR__ . "/uploads/services/";

        if(!is_dir($uploadDirectory)){
            mkdir($uploadDirectory, 0777, true);
        }

        $image = $_FILES["image"];

        $allowedTypes = [
            "image/jpeg",
            "image/png",
            "image/webp",
            "image/gif"
        ];

        $maxFileSize = 5 * 1024 * 1024;


        if($image["error"] !== UPLOAD_ERR_OK){

            $errorMessage = "There was an error uploading the image.";

        }elseif($image["size"] > $maxFileSize){

            $errorMessage = "Image size must not exceed 5MB.";

        }else{

            $imageInfo = getimagesize($image["tmp_name"]);

            if($imageInfo === false){

                $errorMessage = "The uploaded file is not a valid image.";

            }elseif(!in_array($imageInfo["mime"], $allowedTypes, true)){

                $errorMessage = "Only JPG, PNG, WEBP and GIF images are allowed.";

            }else{


                // ==============================
                // CREATE UNIQUE IMAGE NAME
                // ==============================

                $extension = strtolower(
                    pathinfo($image["name"], PATHINFO_EXTENSION)
                );

                $fileName =
                    "service_" .
                    time() .
                    "_" .
                    uniqid() .
                    "." .
                    $extension;

                $targetPath = $uploadDirectory . $fileName;

                $databaseImagePath = "uploads/services/" . $fileName;


                if(!move_uploaded_file($image["tmp_name"], $targetPath)){

                    $errorMessage = "Failed to upload the service image.";

                }else{


                    // ==================================
                    // INSERT SERVICE INTO DATABASE
                    // ==================================

                    if($discountPrice === ""){

                        $insertQuery = "
                            INSERT INTO services
                            (
                                category_id,
                                service_name,
                                description,
                                price,
                                discount_price,
                                duration,
                                service_type,
                                image,
                                status
                            )
                            VALUES (?, ?, ?, ?, NULL, ?, ?, ?, ?)
                        ";

                        $stmt = mysqli_prepare($conn, $insertQuery);

                        if(!$stmt){

                            unlink($targetPath);

                            $errorMessage =
                                "Database error: " .
                                mysqli_error($conn);

                        }else{

                            mysqli_stmt_bind_param(
                                $stmt,
                                "issdssss",
                                $categoryId,
                                $serviceName,
                                $description,
                                $price,
                                $duration,
                                $serviceType,
                                $databaseImagePath,
                                $status
                            );

                            if(mysqli_stmt_execute($stmt)){

                                $showSuccessModal = true;

                                $categoryId = "";
                                $serviceName = "";
                                $description = "";
                                $price = "";
                                $discountPrice = "";
                                $duration = "";
                                $serviceType = "";
                                $status = "Active";

                            }else{

                                unlink($targetPath);

                                $errorMessage =
                                    "Failed to add service: " .
                                    mysqli_stmt_error($stmt);
                            }

                            mysqli_stmt_close($stmt);
                        }

                    }else{


                        // ==================================
                        // INSERT WITH DISCOUNT PRICE
                        // ==================================

                        $insertQuery = "
                            INSERT INTO services
                            (
                                category_id,
                                service_name,
                                description,
                                price,
                                discount_price,
                                duration,
                                service_type,
                                image,
                                status
                            )
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
                        ";

                        $stmt = mysqli_prepare($conn, $insertQuery);

                        if(!$stmt){

                            unlink($targetPath);

                            $errorMessage =
                                "Database error: " .
                                mysqli_error($conn);

                        }else{

                            mysqli_stmt_bind_param(
                                $stmt,
                                "issddssss",
                                $categoryId,
                                $serviceName,
                                $description,
                                $price,
                                $discountPrice,
                                $duration,
                                $serviceType,
                                $databaseImagePath,
                                $status
                            );

                            if(mysqli_stmt_execute($stmt)){

                                $showSuccessModal = true;

                                $categoryId = "";
                                $serviceName = "";
                                $description = "";
                                $price = "";
                                $discountPrice = "";
                                $duration = "";
                                $serviceType = "";
                                $status = "Active";

                            }else{

                                unlink($targetPath);

                                $errorMessage =
                                    "Failed to add service: " .
                                    mysqli_stmt_error($stmt);
                            }

                            mysqli_stmt_close($stmt);
                        }
                    }
                }
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

    <title><?= htmlspecialchars($pageTitle); ?></title>

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

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="assets/css/admin.css"
    >

    <style>

        .service-form-wrapper{
            max-width:1100px;
            margin:0 auto;
        }

        .service-form-card{
            background:rgba(255,255,255,0.035);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:24px;
            padding:35px;
            backdrop-filter:blur(18px);
            box-shadow:0 20px 60px rgba(0,0,0,0.25);
        }

        .form-grid{
            display:grid;
            grid-template-columns:repeat(2, 1fr);
            gap:24px;
        }

        .form-group{
            display:flex;
            flex-direction:column;
            gap:9px;
        }

        .form-group.full{
            grid-column:1 / -1;
        }

        .form-group label{
            font-size:14px;
            font-weight:500;
            color:#ddd;
        }

        .form-group label span{
            color:#a855f7;
        }

        .form-group input,
        .form-group select,
        .form-group textarea{
            width:100%;
            padding:14px 16px;
            border-radius:12px;
            border:1px solid rgba(255,255,255,0.10);
            background:rgba(255,255,255,0.045);
            color:#fff;
            font-family:'Poppins', sans-serif;
            font-size:14px;
            outline:none;
            transition:0.3s ease;
            box-sizing:border-box;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus{
            border-color:#8b5cf6;
            box-shadow:0 0 0 3px rgba(139,92,246,0.12);
        }

        .form-group select option{
            background:#171717;
            color:#fff;
        }

        .form-group textarea{
            min-height:150px;
            resize:vertical;
        }

        .form-hint{
            font-size:12px;
            color:#888;
        }

        .image-upload{
            border:1px dashed rgba(168,85,247,0.45);
            border-radius:16px;
            padding:25px;
            background:rgba(168,85,247,0.035);
        }

        .image-upload input{
            border:none;
            background:transparent;
            padding:5px 0;
        }

        .form-actions{
            display:flex;
            justify-content:flex-end;
            gap:14px;
            margin-top:30px;
            padding-top:25px;
            border-top:1px solid rgba(255,255,255,0.07);
        }

        .cancel-btn,
        .submit-btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            padding:13px 22px;
            border-radius:12px;
            text-decoration:none;
            font-family:'Poppins', sans-serif;
            font-size:14px;
            font-weight:500;
            cursor:pointer;
            transition:0.3s ease;
        }

        .cancel-btn{
            color:#ddd;
            background:rgba(255,255,255,0.06);
            border:1px solid rgba(255,255,255,0.08);
        }

        .cancel-btn:hover{
            background:rgba(255,255,255,0.10);
        }

        .submit-btn{
            color:#fff;
            background:linear-gradient(135deg,#7c3aed,#a855f7);
            border:none;
            box-shadow:0 10px 25px rgba(124,58,237,0.25);
        }

        .submit-btn:hover{
            transform:translateY(-2px);
            box-shadow:0 15px 30px rgba(124,58,237,0.35);
        }

        .error-message{
            margin-bottom:25px;
            padding:15px 18px;
            border-radius:12px;
            background:rgba(239,68,68,0.10);
            border:1px solid rgba(239,68,68,0.25);
            color:#fca5a5;
            font-size:14px;
        }

        /* SUCCESS MODAL */

        .success-modal{
            position:fixed;
            inset:0;
            background:rgba(0,0,0,0.72);
            backdrop-filter:blur(8px);
            display:flex;
            align-items:center;
            justify-content:center;
            padding:20px;
            z-index:9999;
        }

        .success-modal-box{
            width:100%;
            max-width:460px;
            padding:35px;
            text-align:center;
            border-radius:24px;
            background:#151515;
            border:1px solid rgba(168,85,247,0.25);
            box-shadow:0 30px 80px rgba(0,0,0,0.5);
        }

        .success-icon{
            width:70px;
            height:70px;
            margin:0 auto 20px;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            background:rgba(34,197,94,0.12);
            color:#4ade80;
            font-size:30px;
        }

        .success-modal-box h2{
            margin-bottom:10px;
            color:#fff;
        }

        .success-modal-box p{
            color:#999;
            font-size:14px;
            line-height:1.7;
            margin-bottom:25px;
        }

        .success-actions{
            display:flex;
            gap:12px;
            justify-content:center;
            flex-wrap:wrap;
        }

        .success-actions a{
            text-decoration:none;
            padding:12px 18px;
            border-radius:10px;
            font-size:13px;
            font-weight:500;
        }

        .view-services-btn{
            background:linear-gradient(135deg,#7c3aed,#a855f7);
            color:#fff;
        }

        .add-another-btn{
            background:rgba(255,255,255,0.06);
            color:#ddd;
            border:1px solid rgba(255,255,255,0.08);
        }


        /* TABLET */

        @media(max-width:900px){

            .form-grid{
                grid-template-columns:1fr;
            }

            .form-group.full{
                grid-column:auto;
            }

        }


        /* MOBILE */

        @media(max-width:600px){

            .service-form-card{
                padding:22px;
                border-radius:18px;
            }

            .form-actions{
                flex-direction:column;
            }

            .cancel-btn,
            .submit-btn{
                width:100%;
            }

            .success-modal-box{
                padding:28px 20px;
            }

            .success-actions{
                flex-direction:column;
            }

            .success-actions a{
                width:100%;
                box-sizing:border-box;
            }

        }

    </style>

</head>

<body>

    <?php include "includes/sidebar.php"; ?>


    <main class="admin-main">

        <?php include "includes/topbar.php"; ?>


        <section class="admin-content">

            <div class="service-form-wrapper">

                <!-- <div class="admin-page-header">

                    <div>

                        <h1>Add Service</h1>

                        <p>
                            Add a new service to your Ultimate marketplace.
                        </p>

                    </div> -->

                </div>


                <?php if(!empty($errorMessage)): ?>

                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <?= htmlspecialchars($errorMessage); ?>
                    </div>

                <?php endif; ?>


                <div class="service-form-card">

                    <form
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        <div class="form-grid">


                            <!-- CATEGORY -->

                            <div class="form-group">

                                <label>
                                    Category <span>*</span>
                                </label>

                                <select
                                    name="category_id"
                                    required
                                >

                                    <option value="">
                                        Select Category
                                    </option>

                                    <?php while($category = mysqli_fetch_assoc($categoryResult)): ?>

                                        <option
                                            value="<?= $category['id']; ?>"
                                            <?= ($categoryId == $category['id']) ? 'selected' : ''; ?>
                                        >
                                            <?= htmlspecialchars($category['title']); ?>
                                        </option>

                                    <?php endwhile; ?>

                                </select>

                            </div>


                            <!-- SERVICE NAME -->

                            <div class="form-group">

                                <label>
                                    Service Name <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="service_name"
                                    placeholder="Enter service name"
                                    value="<?= htmlspecialchars($serviceName); ?>"
                                    required
                                >

                            </div>


                            <!-- PRICE -->

                            <div class="form-group">

                                <label>
                                    Price <span>*</span>
                                </label>

                                <input
                                    type="number"
                                    name="price"
                                    placeholder="0.00"
                                    min="0"
                                    step="0.01"
                                    value="<?= htmlspecialchars($price); ?>"
                                    required
                                >

                            </div>


                            <!-- DISCOUNT PRICE -->

                            <div class="form-group">

                                <label>
                                    Discount Price
                                </label>

                                <input
                                    type="number"
                                    name="discount_price"
                                    placeholder="Optional"
                                    min="0"
                                    step="0.01"
                                    value="<?= htmlspecialchars($discountPrice); ?>"
                                >

                                <span class="form-hint">
                                    Leave empty if the service has no discount.
                                </span>

                            </div>


                            <!-- DURATION -->

                            <div class="form-group">

                                <label>
                                    Duration
                                </label>

                                <input
                                    type="text"
                                    name="duration"
                                    placeholder="e.g. 2 hours"
                                    value="<?= htmlspecialchars($duration); ?>"
                                >

                                <span class="form-hint">
                                    Example: 30 minutes, 2 hours, 3 days.
                                </span>

                            </div>


                            <!-- SERVICE TYPE -->

                            <div class="form-group">

                                <label>
                                    Service Type <span>*</span>
                                </label>

                                <select
                                    name="service_type"
                                    required
                                >

                                    <option value="">
                                        Select Service Type
                                    </option>

                                    <?php foreach($serviceTypes as $type): ?>

                                        <option
                                            value="<?= htmlspecialchars($type); ?>"
                                            <?= ($serviceType === $type) ? 'selected' : ''; ?>
                                        >
                                            <?= htmlspecialchars($type); ?>
                                        </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>


                            <!-- STATUS -->

                            <div class="form-group">

                                <label>
                                    Status <span>*</span>
                                </label>

                                <select
                                    name="status"
                                    required
                                >

                                    <option
                                        value="Active"
                                        <?= ($status === "Active") ? "selected" : ""; ?>
                                    >
                                        Active
                                    </option>

                                    <option
                                        value="Inactive"
                                        <?= ($status === "Inactive") ? "selected" : ""; ?>
                                    >
                                        Inactive
                                    </option>

                                </select>

                                <span class="form-hint">
                                    Inactive services remain in the database
                                    but won't appear to customers.
                                </span>

                            </div>


                            <!-- IMAGE -->

                            <div class="form-group">

                                <label>
                                    Service Image <span>*</span>
                                </label>

                                <div class="image-upload">

                                    <input
                                        type="file"
                                        name="image"
                                        accept="image/jpeg,image/png,image/webp,image/gif"
                                        required
                                    >

                                    <span class="form-hint">
                                        JPG, PNG, WEBP or GIF. Maximum 5MB.
                                    </span>

                                </div>

                            </div>


                            <!-- DESCRIPTION -->

                            <div class="form-group full">

                                <label>
                                    Description <span>*</span>
                                </label>

                                <textarea
                                    name="description"
                                    placeholder="Describe the service..."
                                    required
                                ><?= htmlspecialchars($description); ?></textarea>

                            </div>


                        </div>


                        <!-- ACTIONS -->

                        <div class="form-actions">

                            <a
                                href="services.php"
                                class="cancel-btn"
                            >
                                <i class="fa-solid fa-arrow-left"></i>
                                Cancel
                            </a>


                            <button
                                type="submit"
                                name="add_service"
                                class="submit-btn"
                            >
                                <i class="fa-solid fa-plus"></i>
                                Add Service
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </section>


        <?php include "includes/footer.php"; ?>

    </main>


    <!-- SUCCESS MODAL -->

    <?php if($showSuccessModal): ?>

        <div class="success-modal">

            <div class="success-modal-box">

                <div class="success-icon">

                    <i class="fa-solid fa-check"></i>

                </div>

                <h2>Service Added Successfully!</h2>

                <p>
                    Your service has been added to the Ultimate marketplace.
                </p>

                <div class="success-actions">

                    <a
                        href="services.php"
                        class="view-services-btn"
                    >
                        View Services
                    </a>

                    <a
                        href="add-service.php"
                        class="add-another-btn"
                    >
                        Add Another
                    </a>

                </div>

            </div>

        </div>

    <?php endif; ?>

</body>

</html>

