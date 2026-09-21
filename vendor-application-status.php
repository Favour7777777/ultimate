<?php

session_start();

include "config.php";


/* =========================================
   CHECK USER LOGIN
========================================= */

if(!isset($_SESSION["user_id"])){

    header("Location: login.php");
    exit();

}

$user_id = $_SESSION["user_id"];


/* =========================================
   GET VENDOR APPLICATION
========================================= */

$query = "
    SELECT
        vendors.id,
        vendors.store_name,
        vendors.store_description,
        vendors.status,
        vendors.created_at,
        categories.title AS category_name
    FROM vendors

    INNER JOIN categories
        ON vendors.category_id = categories.id

    WHERE vendors.user_id = ?

    LIMIT 1
";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $user_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$vendor = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


/* =========================================
   NO APPLICATION
========================================= */

if(!$vendor){

    header("Location: become-vendor.php");
    exit();

}


/* =========================================
   STATUS DETAILS
========================================= */

$status = $vendor["status"];

$status_class = strtolower($status);

$status_title = "";
$status_message = "";


switch($status){

    case "Pending":

        $status_title = "Application Under Review";

        $status_message =
            "Your vendor application has been submitted successfully. " .
            "Our team is currently reviewing your application.";

        break;


    case "Approved":

        $status_title = "You're Approved!";

        $status_message =
            "Congratulations! Your vendor application has been approved. " .
            "You can now access your vendor center.";

        break;


    case "Dormant":

        $status_title = "Vendor Account Dormant";

        $status_message =
            "Your vendor account is currently dormant. " .
            "You may need to reactivate your vendor account to continue.";

        break;


    case "Suspended":

        $status_title = "Vendor Account Suspended";

        $status_message =
            "Your vendor account has been suspended. " .
            "Please contact Ultimate support for more information.";

        break;


    case "Rejected":

        $status_title = "Application Rejected";

        $status_message =
            "Unfortunately, your vendor application was not approved.";

        break;


    default:

        $status_title = "Application Status";

        $status_message =
            "Your vendor application status is currently being processed.";

}


/* =========================================
   APPROVED ACTION
========================================= */

$action_link = "";
$action_text = "";

if($status === "Approved"){

    $action_link = "Vendor dashboard/dashboard.php";
    $action_text = "Go to Vendor Center";

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

    <title>Vendor Application Status | Ultimate</title>

    <link
        rel="stylesheet"
        href="become-vendor.css"
    >

</head>


<body>

    <main>

        <h1>
            Vendor Application
        </h1>

        <p>
            Track the status of your Ultimate vendor application.
        </p>


        <section class="status-card">


            <!-- STATUS ICON -->

            <div class="status-icon <?= htmlspecialchars($status_class); ?>">

                <?php if($status === "Pending"): ?>

                    <i>⏳</i>

                <?php elseif($status === "Approved"): ?>

                    <i>✓</i>

                <?php elseif($status === "Rejected"): ?>

                    <i>×</i>

                <?php else: ?>

                    <i>!</i>

                <?php endif; ?>

            </div>


            <!-- STATUS -->

            <span class="status-label">

                <?= htmlspecialchars($status); ?>

            </span>


            <h2>

                <?= htmlspecialchars($status_title); ?>

            </h2>


            <p class="status-message">

                <?= htmlspecialchars($status_message); ?>

            </p>


            <!-- APPLICATION DETAILS -->

            <div class="application-details">


                <div class="detail">

                    <span>
                        Store Name
                    </span>

                    <strong>
                        <?= htmlspecialchars($vendor["store_name"]); ?>
                    </strong>

                </div>


                <div class="detail">

                    <span>
                        Category
                    </span>

                    <strong>
                        <?= htmlspecialchars($vendor["category_name"]); ?>
                    </strong>

                </div>


                <div class="detail">

                    <span>
                        Application Date
                    </span>

                    <strong>

                        <?= date(
                            "M d, Y",
                            strtotime($vendor["created_at"])
                        ); ?>

                    </strong>

                </div>


            </div>


            <!-- ACTION -->

            <?php if($status === "Approved"): ?>

                <a
                    href="<?= htmlspecialchars($action_link); ?>"
                    class="status-button"
                >
                    <?= htmlspecialchars($action_text); ?>
                </a>

            <?php elseif($status === "Pending"): ?>

                <div class="waiting-note">

                    Your application will be updated here
                    once an administrator reviews it.

                </div>

            <?php elseif($status === "Rejected"): ?>

                <a
                    href="become-vendor.php"
                    class="status-button"
                >
                    Review Application
                </a>

            <?php endif; ?>


        </section>

    </main>

</body>

</html>