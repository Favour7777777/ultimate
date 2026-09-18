<?php

session_start();

if(!isset($_SESSION["admin_id"])){
    header("Location: login.php");
    exit();
}

require_once "../config.php";

$currentPage = "applications";

$vendor_id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

if($vendor_id <= 0){
    header("Location: admin-notifications.php");
    exit();
}


/* =========================
   HANDLE APPLICATION ACTION
========================= */

$updated = false;
$updatedStatus = "";


if($_SERVER["REQUEST_METHOD"] === "POST"){

    $decision = $_POST["decision"] ?? "";
    $rejection_reason = trim($_POST["rejection_reason"] ?? "");

    if($decision === "approve"){

        $status = "Approved";

        $updateQuery = "
            UPDATE vendors
            SET
                status = ?,
                rejection_reason = NULL,
                updated_at = CURRENT_TIMESTAMP
            WHERE id = ?
        ";

        $stmt = mysqli_prepare($conn, $updateQuery);

        mysqli_stmt_bind_param(
            $stmt,
            "si",
            $status,
            $vendor_id
        );

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        $updated = true;
        $updatedStatus = "approved";

    }

    elseif($decision === "reject"){

        $status = "Rejected";

        $updateQuery = "
            UPDATE vendors
            SET
                status = ?,
                rejection_reason = ?,
                updated_at = CURRENT_TIMESTAMP
            WHERE id = ?
        ";

        $stmt = mysqli_prepare($conn, $updateQuery);

        mysqli_stmt_bind_param(
            $stmt,
            "ssi",
            $status,
            $rejection_reason,
            $vendor_id
        );

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        $updated = true;
        $updatedStatus = "rejected";
    }


    /* =========================
       PREVENT FORM RESUBMISSION
    ========================= */

    if($updated){

        header(
            "Location: vendor-application.php?id=" .
            $vendor_id .
            "&updated=" .
            $updatedStatus
        );

        exit();
    }
}


/* =========================
   FETCH VENDOR APPLICATION
========================= */

$vendor = null;

$vendorQuery = "
    SELECT
        vendors.id,
        vendors.store_name,
        vendors.store_description,
        vendors.phone_number,
        vendors.business_email,
        vendors.business_address,
        vendors.status,
        vendors.rejection_reason,
        vendors.created_at,

        users.fullname,
        users.email,
        users.phone_number AS user_phone,

        categories.title AS category_name

    FROM vendors

    INNER JOIN users
        ON vendors.user_id = users.id

    INNER JOIN categories
        ON vendors.category_id = categories.id

    WHERE vendors.id = ?

    LIMIT 1
";

$stmt = mysqli_prepare($conn, $vendorQuery);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $vendor_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if($result){
    $vendor = mysqli_fetch_assoc($result);
}

mysqli_stmt_close($stmt);


if(!$vendor){
    header("Location: admin-notifications.php");
    exit();
}


/* =========================
   MARK APPLICATION
   NOTIFICATION AS READ
========================= */

$readQuery = "
    UPDATE admin_notifications
    SET is_read = 1
    WHERE type = 'vendor_application'
    AND reference_type = 'vendor'
    AND reference_id = ?
    AND is_read = 0
";

$stmt = mysqli_prepare($conn, $readQuery);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $vendor_id
);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);


/* =========================
   UPDATE MODAL
========================= */

$showModal = false;
$modalType = "";

if(isset($_GET["updated"])){

    if($_GET["updated"] === "approved"){
        $showModal = true;
        $modalType = "approved";
    }

    elseif($_GET["updated"] === "rejected"){
        $showModal = true;
        $modalType = "rejected";
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
        Vendor Application | Ultimate Admin
    </title>

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

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="assets/css/admin.css"
    >

    <link
        rel="stylesheet"
        href="assets/css/vendor-application.css"
    >

</head>


<body>


<?php include "includes/sidebar.php"; ?>


<main class="admin-main">


    <?php include "includes/topbar.php"; ?>


    <section class="admin-content">


        <!-- =========================
             PAGE HEADER
        ========================== -->

        <div class="application-header">

            <div>

                <span class="application-eyebrow">
                    VENDOR MANAGEMENT
                </span>

                <h1>
                    Vendor Application
                </h1>

                <p>
                    Review the submitted business information
                    and decide whether to approve the application.
                </p>

            </div>


            <a
                href="admin-notifications.php"
                class="back-btn"
            >

                <i class="fa-solid fa-arrow-left"></i>

                Back to Notifications

            </a>

        </div>



        <!-- =========================
             APPLICATION OVERVIEW
        ========================== -->

        <div class="application-overview">


            <div class="store-icon">

                <i class="fa-solid fa-store"></i>

            </div>


            <div class="store-heading">

                <span>
                    STORE APPLICATION
                </span>

                <h2>
                    <?= htmlspecialchars($vendor["store_name"]); ?>
                </h2>

                <p>
                    <?= htmlspecialchars($vendor["category_name"]); ?>
                </p>

            </div>


            <div class="application-status status-<?= strtolower($vendor["status"]); ?>">

                <?php if($vendor["status"] === "Pending"): ?>

                    <i class="fa-solid fa-clock"></i>

                <?php elseif($vendor["status"] === "Approved"): ?>

                    <i class="fa-solid fa-circle-check"></i>

                <?php elseif($vendor["status"] === "Rejected"): ?>

                    <i class="fa-solid fa-circle-xmark"></i>

                <?php else: ?>

                    <i class="fa-solid fa-circle"></i>

                <?php endif; ?>


                <?= htmlspecialchars($vendor["status"]); ?>

            </div>


        </div>



        <!-- =========================
             APPLICATION CONTENT
        ========================== -->

        <div class="application-layout">


            <!-- =========================
                 LEFT CONTENT
            ========================== -->

            <div class="application-details">


                <!-- APPLICANT -->

                <div class="detail-card">

                    <div class="detail-card-header">

                        <div class="detail-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <div>

                            <h3>
                                Applicant Information
                            </h3>

                            <p>
                                User account details
                            </p>

                        </div>

                    </div>


                    <div class="details-grid">


                        <div class="detail-item">

                            <span>
                                Full Name
                            </span>

                            <strong>
                                <?= htmlspecialchars($vendor["fullname"]); ?>
                            </strong>

                        </div>


                        <div class="detail-item">

                            <span>
                                Account Email
                            </span>

                            <strong>
                                <?= htmlspecialchars($vendor["email"]); ?>
                            </strong>

                        </div>


                        <div class="detail-item">

                            <span>
                                Account Phone
                            </span>

                            <strong>
                                <?= htmlspecialchars($vendor["user_phone"] ?: "Not provided"); ?>
                            </strong>

                        </div>


                        <div class="detail-item">

                            <span>
                                Application Date
                            </span>

                            <strong>
                                <?= date("F j, Y", strtotime($vendor["created_at"])); ?>
                            </strong>

                        </div>


                    </div>

                </div>



                <!-- BUSINESS -->

                <div class="detail-card">

                    <div class="detail-card-header">

                        <div class="detail-icon">
                            <i class="fa-solid fa-building"></i>
                        </div>

                        <div>

                            <h3>
                                Business Information
                            </h3>

                            <p>
                                Information submitted by the vendor
                            </p>

                        </div>

                    </div>


                    <div class="details-grid">


                        <div class="detail-item">

                            <span>
                                Store Name
                            </span>

                            <strong>
                                <?= htmlspecialchars($vendor["store_name"]); ?>
                            </strong>

                        </div>


                        <div class="detail-item">

                            <span>
                                Category
                            </span>

                            <strong>
                                <?= htmlspecialchars($vendor["category_name"]); ?>
                            </strong>

                        </div>


                        <div class="detail-item">

                            <span>
                                Business Email
                            </span>

                            <strong>
                                <?= htmlspecialchars($vendor["business_email"]); ?>
                            </strong>

                        </div>


                        <div class="detail-item">

                            <span>
                                Business Phone
                            </span>

                            <strong>
                                <?= htmlspecialchars($vendor["phone_number"]); ?>
                            </strong>

                        </div>


                        <div class="detail-item detail-full">

                            <span>
                                Business Address
                            </span>

                            <strong>
                                <?= nl2br(htmlspecialchars($vendor["business_address"])); ?>
                            </strong>

                        </div>


                    </div>

                </div>



                <!-- DESCRIPTION -->

                <div class="detail-card">

                    <div class="detail-card-header">

                        <div class="detail-icon">
                            <i class="fa-solid fa-align-left"></i>
                        </div>

                        <div>

                            <h3>
                                Store Description
                            </h3>

                            <p>
                                Description provided by the applicant
                            </p>

                        </div>

                    </div>


                    <div class="store-description">

                        <?php if(!empty($vendor["store_description"])): ?>

                            <?= nl2br(htmlspecialchars($vendor["store_description"])); ?>

                        <?php else: ?>

                            <span class="empty-description">
                                No store description was provided.
                            </span>

                        <?php endif; ?>

                    </div>

                </div>



                <!-- REJECTION REASON -->

                <?php if($vendor["status"] === "Rejected"): ?>

                    <div class="detail-card rejection-card">

                        <div class="detail-card-header">

                            <div class="detail-icon rejection-icon">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </div>

                            <div>

                                <h3>
                                    Rejection Reason
                                </h3>

                                <p>
                                    Reason provided by the administrator
                                </p>

                            </div>

                        </div>


                        <div class="rejection-message">

                            <?php if(!empty($vendor["rejection_reason"])): ?>

                                <?= nl2br(htmlspecialchars($vendor["rejection_reason"])); ?>

                            <?php else: ?>

                                No rejection reason was provided.

                            <?php endif; ?>

                        </div>

                    </div>

                <?php endif; ?>


            </div>



            <!-- =========================
                 DECISION PANEL
            ========================== -->

            <aside class="decision-panel">


                <div class="decision-header">

                    <div class="decision-icon">

                        <i class="fa-solid fa-gavel"></i>

                    </div>

                    <div>

                        <h3>
                            Application Decision
                        </h3>

                        <p>
                            Review this application carefully.
                        </p>

                    </div>

                </div>



                <?php if($vendor["status"] === "Pending"): ?>


                    <form
                        method="POST"
                        class="decision-form"
                    >

                        <label for="rejection_reason">

                            Rejection Reason

                            <span>
                                Optional
                            </span>

                        </label>


                        <textarea
                            id="rejection_reason"
                            name="rejection_reason"
                            placeholder="Explain why this application is being rejected..."
                        ></textarea>


                        <div class="decision-note">

                            <i class="fa-solid fa-circle-info"></i>

                            <p>
                                The reason will only be saved if you reject
                                the application.
                            </p>

                        </div>


                        <button
                            type="submit"
                            name="decision"
                            value="reject"
                            class="decision-btn reject-btn"
                        >

                            <i class="fa-solid fa-xmark"></i>

                            Reject Application

                        </button>


                        <button
                            type="submit"
                            name="decision"
                            value="approve"
                            class="decision-btn approve-btn"
                        >

                            <i class="fa-solid fa-check"></i>

                            Approve Application

                        </button>


                    </form>


                <?php elseif($vendor["status"] === "Approved"): ?>


                    <div class="decision-complete approved-complete">

                        <div class="complete-icon">

                            <i class="fa-solid fa-circle-check"></i>

                        </div>

                        <h4>
                            Application Approved
                        </h4>

                        <p>
                            This vendor has been approved and can
                            proceed with their vendor account.
                        </p>

                    </div>


                <?php elseif($vendor["status"] === "Rejected"): ?>


                    <div class="decision-complete rejected-complete">

                        <div class="complete-icon">

                            <i class="fa-solid fa-circle-xmark"></i>

                        </div>

                        <h4>
                            Application Rejected
                        </h4>

                        <p>
                            This vendor application has already
                            been rejected.
                        </p>

                    </div>


                <?php endif; ?>


            </aside>


        </div>


    </section>


    <?php include "includes/footer.php"; ?>


</main>



<!-- =========================
     SUCCESS MODAL
========================== -->

<?php if($showModal): ?>

    <div class="application-modal">

        <div class="application-modal-box">


            <?php if($modalType === "approved"): ?>


                <div class="modal-icon approved-modal-icon">

                    <i class="fa-solid fa-check"></i>

                </div>

                <h2>
                    Vendor Approved
                </h2>

                <p>
                    <strong>
                        <?= htmlspecialchars($vendor["store_name"]); ?>
                    </strong>
                    has been successfully approved.
                </p>


            <?php else: ?>


                <div class="modal-icon rejected-modal-icon">

                    <i class="fa-solid fa-xmark"></i>

                </div>

                <h2>
                    Application Rejected
                </h2>

                <p>
                    The application from
                    <strong>
                        <?= htmlspecialchars($vendor["store_name"]); ?>
                    </strong>
                    has been rejected.
                </p>


            <?php endif; ?>


            <div class="modal-actions">

                <a
                    href="admin-notifications.php"
                    class="modal-primary-btn"
                >
                    Back to Notifications
                </a>


                <a
                    href="vendor-application.php?id=<?= $vendor_id; ?>"
                    class="modal-secondary-btn"
                >
                    View Application
                </a>

            </div>


        </div>

    </div>

<?php endif; ?>


</body>

</html>