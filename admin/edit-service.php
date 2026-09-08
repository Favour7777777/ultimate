
<?php

session_start();

if(!isset($_SESSION["admin_id"])){
    header("Location: login.php");
    exit();
}

require_once "../config.php";

$currentPage = "services";

$pageTitle = "Edit Service";
$pageDescription = "Update service information";


// GET SERVICE ID
if(!isset($_GET["id"]) || !is_numeric($_GET["id"])){
    header("Location: services.php");
    exit();
}

$serviceId = (int) $_GET["id"];


// FETCH SERVICE
$serviceQuery = "
    SELECT *
    FROM services
    WHERE id = ?
";

$stmt = mysqli_prepare($conn, $serviceQuery);

if(!$stmt){
    die("Database error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $serviceId);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$service = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


if(!$service){
    header("Location: services.php");
    exit();
}


// FETCH CATEGORIES
$categoryQuery = "
    SELECT id, title
    FROM categories
    ORDER BY title ASC
";

$categoryResult = mysqli_query($conn, $categoryQuery);

if(!$categoryResult){
    die("Failed to load categories: " . mysqli_error($conn));
}


// FETCH SERVICE TYPE ENUM VALUES
$serviceTypeQuery = "
    SHOW COLUMNS FROM services LIKE 'service_type'
";

$serviceTypeResult = mysqli_query($conn, $serviceTypeQuery);

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


// FORM PROCESSING
if(isset($_POST["update_service"])){

    $categoryId = $_POST["category_id"] ?? "";
    $serviceName = trim($_POST["service_name"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $price = $_POST["price"] ?? "";
    $discountPrice = $_POST["discount_price"] ?? "";
    $duration = trim($_POST["duration"] ?? "");
    $serviceType = $_POST["service_type"] ?? "";
    $status = $_POST["status"] ?? "";

    $errors = [];


    // VALIDATION

    if(!is_numeric($categoryId)){
        $errors[] = "Please select a category.";
    }

    if($serviceName === ""){
        $errors[] = "Service name is required.";
    }

    if($description === ""){
        $errors[] = "Service description is required.";
    }

    if($price === "" || !is_numeric($price) || $price < 0){
        $errors[] = "Please enter a valid price.";
    }

    if($discountPrice !== ""){

        if(!is_numeric($discountPrice) || $discountPrice < 0){
            $errors[] = "Please enter a valid discount price.";

        }elseif($discountPrice >= $price){
            $errors[] = "Discount price must be lower than the original price.";
        }
    }

    if(!in_array($serviceType, $serviceTypes)){
        $errors[] = "Please select a valid service type.";
    }

    if(!in_array($status, ["Active", "Inactive"])){
        $errors[] = "Please select a valid status.";
    }


    // IMAGE HANDLING

    $newImageUploaded = false;
    $newImagePath = $service["image"];


    if(isset($_FILES["image"]) && $_FILES["image"]["error"] !== UPLOAD_ERR_NO_FILE){

        if($_FILES["image"]["error"] !== UPLOAD_ERR_OK){

            $errors[] = "There was a problem uploading the image.";

        }else{

            $imageTmp = $_FILES["image"]["tmp_name"];
            $imageName = $_FILES["image"]["name"];
            $imageSize = $_FILES["image"]["size"];


            // Check image
            $imageInfo = getimagesize($imageTmp);

            if($imageInfo === false){

                $errors[] = "Uploaded file must be a valid image.";

            }else{

                $allowedTypes = [
                    "image/jpeg" => "jpg",
                    "image/png" => "png",
                    "image/webp" => "webp",
                    "image/gif" => "gif"
                ];

                $mimeType = $imageInfo["mime"];


                if(!isset($allowedTypes[$mimeType])){

                    $errors[] = "Only JPG, PNG, WEBP and GIF images are allowed.";

                }elseif($imageSize > 5 * 1024 * 1024){

                    $errors[] = "Image size must not exceed 5MB.";

                }else{

                    $uploadDirectory = __DIR__ . "/uploads/services/";

                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0777, true);
                    }


                    $extension = $allowedTypes[$mimeType];

                    $newFileName =
                        "service_" .
                        time() .
                        "_" .
                        uniqid() .
                        "." .
                        $extension;


                    $newFullPath = $uploadDirectory . $newFileName;

                    $newImagePath = "uploads/services/" . $newFileName;


                    if(!move_uploaded_file($imageTmp, $newFullPath)){

                        $errors[] = "Failed to save the uploaded image.";

                    }else{

                        $newImageUploaded = true;
                    }
                }
            }
        }
    }


    // UPDATE DATABASE

    if(empty($errors)){

        if($discountPrice === ""){

            $updateQuery = "
                UPDATE services
                SET
                    category_id = ?,
                    service_name = ?,
                    description = ?,
                    price = ?,
                    discount_price = NULL,
                    duration = ?,
                    service_type = ?,
                    image = ?,
                    status = ?
                WHERE id = ?
            ";

            $stmt = mysqli_prepare($conn, $updateQuery);

            if(!$stmt){
                die("Database error: " . mysqli_error($conn));
            }

            mysqli_stmt_bind_param(
                $stmt,
                "issdssssi",
                $categoryId,
                $serviceName,
                $description,
                $price,
                $duration,
                $serviceType,
                $newImagePath,
                $status,
                $serviceId
            );

        }else{

            $updateQuery = "
                UPDATE services
                SET
                    category_id = ?,
                    service_name = ?,
                    description = ?,
                    price = ?,
                    discount_price = ?,
                    duration = ?,
                    service_type = ?,
                    image = ?,
                    status = ?
                WHERE id = ?
            ";

            $stmt = mysqli_prepare($conn, $updateQuery);

            if(!$stmt){
                die("Database error: " . mysqli_error($conn));
            }

            mysqli_stmt_bind_param(
                $stmt,
                "issddssssi",
                $categoryId,
                $serviceName,
                $description,
                $price,
                $discountPrice,
                $duration,
                $serviceType,
                $newImagePath,
                $status,
                $serviceId
            );
        }


        if(mysqli_stmt_execute($stmt)){

            mysqli_stmt_close($stmt);


            // DELETE OLD IMAGE ONLY AFTER SUCCESSFUL UPDATE

            if($newImageUploaded && !empty($service["image"])){

                $oldImagePath = __DIR__ . "/" . $service["image"];

                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
            }


            $success = true;

        }else{

            mysqli_stmt_close($stmt);


            // Delete newly uploaded image if database update failed

            if($newImageUploaded){

                $failedImagePath = __DIR__ . "/" . $newImagePath;

                if(file_exists($failedImagePath)){
                    unlink($failedImagePath);
                }
            }


            $errors[] = "Failed to update service.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($pageTitle); ?></title>

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet"
          href="assets/css/admin.css">


<style>

.edit-service-wrapper{
    max-width:1000px;
    margin:0 auto;
}

.edit-service-card{
    background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.08);
    backdrop-filter:blur(18px);
    -webkit-backdrop-filter:blur(18px);
    border-radius:22px;
    padding:30px;
    box-shadow:0 20px 50px rgba(0,0,0,0.25);
}

.form-grid{
    display:grid;
    grid-template-columns:repeat(2, 1fr);
    gap:22px;
}

.form-group{
    display:flex;
    flex-direction:column;
}

.form-group.full{
    grid-column:1 / -1;
}

.form-group label{
    margin-bottom:8px;
    font-size:14px;
    font-weight:500;
    color:#ddd;
}

.form-group input,
.form-group select,
.form-group textarea{
    width:100%;
    padding:14px 16px;
    border-radius:12px;
    border:1px solid rgba(255,255,255,0.1);
    background:rgba(255,255,255,0.05);
    color:#fff;
    outline:none;
    font-family:Poppins,sans-serif;
    transition:0.3s;
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
    min-height:140px;
    resize:vertical;
}

.current-image{
    margin-top:10px;
}

.current-image img{
    width:150px;
    height:110px;
    object-fit:cover;
    border-radius:14px;
    border:1px solid rgba(255,255,255,0.1);
}

.image-note{
    margin-top:8px;
    font-size:12px;
    color:#999;
}

.form-actions{
    display:flex;
    justify-content:flex-end;
    gap:12px;
    margin-top:28px;
    padding-top:25px;
    border-top:1px solid rgba(255,255,255,0.08);
}

.btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    padding:13px 22px;
    border-radius:12px;
    text-decoration:none;
    border:none;
    cursor:pointer;
    font-family:Poppins,sans-serif;
    font-size:14px;
    font-weight:600;
    transition:0.3s;
}

.btn-cancel{
    background:rgba(255,255,255,0.06);
    color:#ddd;
    border:1px solid rgba(255,255,255,0.08);
}

.btn-cancel:hover{
    background:rgba(255,255,255,0.1);
}

.btn-save{
    background:linear-gradient(135deg,#7c3aed,#a855f7);
    color:#fff;
    box-shadow:0 10px 25px rgba(124,58,237,0.25);
}

.btn-save:hover{
    transform:translateY(-2px);
    box-shadow:0 15px 30px rgba(124,58,237,0.35);
}

.error-box{
    background:rgba(239,68,68,0.1);
    border:1px solid rgba(239,68,68,0.3);
    color:#fca5a5;
    padding:15px 18px;
    border-radius:12px;
    margin-bottom:22px;
}

.error-box ul{
    margin:0;
    padding-left:20px;
}

.success-modal{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.75);
    backdrop-filter:blur(8px);
    display:flex;
    align-items:center;
    justify-content:center;
    z-index:9999;
}

.success-modal-box{
    width:min(420px,90%);
    background:#171717;
    border:1px solid rgba(168,85,247,0.3);
    border-radius:22px;
    padding:35px;
    text-align:center;
    box-shadow:0 30px 80px rgba(0,0,0,0.5);
}

.success-icon{
    width:65px;
    height:65px;
    margin:0 auto 18px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    background:rgba(168,85,247,0.12);
    color:#c084fc;
    font-size:28px;
}

.success-modal-box h3{
    margin-bottom:10px;
}

.success-modal-box p{
    color:#aaa;
    font-size:14px;
    margin-bottom:25px;
}

.modal-actions{
    display:flex;
    gap:10px;
    justify-content:center;
    flex-wrap:wrap;
}

@media(max-width:768px){

    .edit-service-card{
        padding:20px;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

    .form-group.full{
        grid-column:auto;
    }

    .form-actions{
        flex-direction:column;
    }

    .form-actions .btn{
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

        <div class="edit-service-wrapper">


            <!-- <div class="admin-page-header">

                <div>

                    <h1>
                        Edit Service
                    </h1>

                    <p>
                        Update the information for this service.
                    </p>

                </div> -->

            </div>


            <?php if(!empty($errors)): ?>

                <div class="error-box">

                    <ul>

                        <?php foreach($errors as $error): ?>

                            <li>
                                <?= htmlspecialchars($error); ?>
                            </li>

                        <?php endforeach; ?>

                    </ul>

                </div>

            <?php endif; ?>


            <div class="edit-service-card">

                <form method="POST"
                      enctype="multipart/form-data">


                    <div class="form-grid">


                        <!-- CATEGORY -->

                        <div class="form-group">

                            <label>
                                Category
                            </label>

                            <select name="category_id" required>

                                <option value="">
                                    Select Category
                                </option>

                                <?php while($category = mysqli_fetch_assoc($categoryResult)): ?>

                                    <option
                                        value="<?= $category['id']; ?>"
                                        <?= ($category['id'] == ($service['category_id'] ?? '')) ? 'selected' : ''; ?>
                                    >

                                        <?= htmlspecialchars($category['title']); ?>

                                    </option>

                                <?php endwhile; ?>

                            </select>

                        </div>


                        <!-- SERVICE NAME -->

                        <div class="form-group">

                            <label>
                                Service Name
                            </label>

                            <input
                                type="text"
                                name="service_name"
                                value="<?= htmlspecialchars($service['service_name']); ?>"
                                required
                            >

                        </div>


                        <!-- PRICE -->

                        <div class="form-group">

                            <label>
                                Price
                            </label>

                            <input
                                type="number"
                                name="price"
                                step="0.01"
                                min="0"
                                value="<?= htmlspecialchars($service['price']); ?>"
                                required
                            >

                        </div>


                        <!-- DISCOUNT PRICE -->

                        <div class="form-group">

                            <label>
                                Discount Price
                                <small>(Optional)</small>
                            </label>

                            <input
                                type="number"
                                name="discount_price"
                                step="0.01"
                                min="0"
                                value="<?= htmlspecialchars($service['discount_price'] ?? ''); ?>"
                            >

                        </div>


                        <!-- DURATION -->

                        <div class="form-group">

                            <label>
                                Duration
                                <small>(Optional)</small>
                            </label>

                            <input
                                type="text"
                                name="duration"
                                value="<?= htmlspecialchars($service['duration'] ?? ''); ?>"
                                placeholder="e.g. 2 hours"
                            >

                        </div>


                        <!-- SERVICE TYPE -->

                        <div class="form-group">

                            <label>
                                Service Type
                            </label>

                            <select name="service_type" required>

                                <option value="">
                                    Select Service Type
                                </option>

                                <?php foreach($serviceTypes as $type): ?>

                                    <option
                                        value="<?= htmlspecialchars($type); ?>"
                                        <?= ($service['service_type'] === $type) ? 'selected' : ''; ?>
                                    >

                                        <?= htmlspecialchars($type); ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>


                        <!-- STATUS -->

                        <div class="form-group">

                            <label>
                                Status
                            </label>

                            <select name="status" required>

                                <option
                                    value="Active"
                                    <?= ($service['status'] === 'Active') ? 'selected' : ''; ?>
                                >
                                    Active
                                </option>

                                <option
                                    value="Inactive"
                                    <?= ($service['status'] === 'Inactive') ? 'selected' : ''; ?>
                                >
                                    Inactive
                                </option>

                            </select>

                        </div>


                        <!-- IMAGE -->

                        <div class="form-group">

                            <label>
                                Replace Image
                                <small>(Optional)</small>
                            </label>

                            <input
                                type="file"
                                name="image"
                                accept="image/jpeg,image/png,image/webp,image/gif"
                            >

                            <div class="image-note">
                                Leave this empty to keep the current image.
                            </div>

                        </div>


                        <!-- DESCRIPTION -->

                        <div class="form-group full">

                            <label>
                                Description
                            </label>

                            <textarea
                                name="description"
                                required
                            ><?= htmlspecialchars($service['description']); ?></textarea>

                        </div>


                        <!-- CURRENT IMAGE -->

                        <div class="form-group full">

                            <label>
                                Current Image
                            </label>

                            <div class="current-image">

                                <img
                                    src="<?= htmlspecialchars($service['image']); ?>"
                                    alt="<?= htmlspecialchars($service['service_name']); ?>"
                                >

                            </div>

                        </div>


                    </div>


                    <div class="form-actions">

                        <a
                            href="services.php"
                            class="btn btn-cancel"
                        >
                            <i class="fa-solid fa-arrow-left"></i>
                            Cancel
                        </a>


                        <button
                            type="submit"
                            name="update_service"
                            class="btn btn-save"
                        >
                            <i class="fa-solid fa-floppy-disk"></i>
                            Update Service
                        </button>

                    </div>


                </form>

            </div>


        </div>

    </section>


    <?php include "includes/footer.php"; ?>

</main>


<?php if(isset($success) && $success): ?>

    <div class="success-modal"
         id="successModal">

        <div class="success-modal-box">

            <div class="success-icon">

                <i class="fa-solid fa-check"></i>

            </div>

            <h3>
                Service Updated
            </h3>

            <p>
                The service has been successfully updated.
            </p>


            <div class="modal-actions">

                <a
                    href="services.php"
                    class="btn btn-save"
                >
                    View Services
                </a>

                <button
                    type="button"
                    class="btn btn-cancel"
                    onclick="closeSuccessModal()"
                >
                    Continue Editing
                </button>

            </div>

        </div>

    </div>

<?php endif; ?>


<script>

function closeSuccessModal(){

    const modal = document.getElementById("successModal");

    if(modal){
        modal.remove();
    }

}

</script>


</body>

</html>

