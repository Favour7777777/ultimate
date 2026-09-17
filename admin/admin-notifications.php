```php
<?php

session_start();

if(!isset($_SESSION["admin_id"])){
    header("Location: login.php");
    exit();
}

require_once "../config.php";


/* =========================================
   PAGE INFORMATION
========================================= */

$currentPage = "notifications";

$pageTitle = "Notifications";

$pageDescription = "View and manage your Ultimate marketplace notifications";


/* =========================================
   DELETE NOTIFICATION
========================================= */

if(isset($_GET["delete"])){

    $notificationId = (int) $_GET["delete"];

    if($notificationId > 0){

        $deleteQuery = "
            DELETE FROM admin_notifications
            WHERE id = ?
        ";

        $deleteStmt = mysqli_prepare(
            $conn,
            $deleteQuery
        );

        if($deleteStmt){

            mysqli_stmt_bind_param(
                $deleteStmt,
                "i",
                $notificationId
            );

            mysqli_stmt_execute($deleteStmt);

            mysqli_stmt_close($deleteStmt);
        }
    }

    header("Location: admin-notifications.php");
    exit();
}


/* =========================================
   GET ALL NOTIFICATIONS
========================================= */

$notificationQuery = "
    SELECT
        id,
        type,
        title,
        message,
        reference_id,
        reference_type,
        is_read,
        created_at
    FROM admin_notifications
    ORDER BY created_at DESC
";

$notificationResult = mysqli_query(
    $conn,
    $notificationQuery
);

if(!$notificationResult){

    die(
        "Notification database error: " .
        mysqli_error($conn)
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
        Notifications | Ultimate
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
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >


    <!-- ADMIN CSS -->

    <link
        rel="stylesheet"
        href="assets/css/admin.css"
    >


    <style>

        /* =========================================
           NOTIFICATIONS PAGE
        ========================================= */

        .notifications-page{

            width:100%;

        }


        .notifications-heading{

            margin-bottom:25px;

        }


        .notifications-heading h2{

            margin:0;

            color:#ffffff;

            font-size:24px;

            font-weight:600;

        }


        .notifications-heading p{

            margin:8px 0 0;

            color:#888894;

            font-size:13px;

        }


        /* =========================================
           NOTIFICATION LIST
        ========================================= */

        .notifications-list{

            display:flex;

            flex-direction:column;

            gap:15px;

            width:100%;

        }


        /* =========================================
           NOTIFICATION
        ========================================= */

        .admin-notification{

            position:relative;

            display:flex;

            align-items:flex-start;

            gap:16px;

            width:100%;

            padding:20px;

            background:#121218;

            border:1px solid rgba(255,255,255,0.08);

            border-radius:16px;

            box-sizing:border-box;

        }


        .admin-notification.unread{

            border-color:rgba(168,85,247,0.35);

            background:

                linear-gradient(
                    90deg,
                    rgba(124,58,237,0.12),
                    #121218
                );

        }


        /* =========================================
           ICON
        ========================================= */

        .admin-notification-icon{

            width:48px;

            height:48px;

            flex-shrink:0;

            display:flex;

            align-items:center;

            justify-content:center;

            border-radius:13px;

            background:rgba(168,85,247,0.12);

            color:#a855f7;

            font-size:17px;

        }


        /* =========================================
           CONTENT
        ========================================= */

        .admin-notification-content{

            flex:1;

            min-width:0;

            padding-right:35px;

        }


        .admin-notification-title{

            display:flex;

            align-items:center;

            gap:9px;

            flex-wrap:wrap;

            margin:0;

            color:#ffffff;

            font-size:14px;

            font-weight:600;

        }


        .notification-badge{

            padding:4px 8px;

            border-radius:20px;

            background:rgba(168,85,247,0.12);

            color:#c8a8ff;

            font-size:8px;

            font-weight:600;

            letter-spacing:1px;

        }


        .admin-notification-message{

            margin:8px 0;

            color:#9999a5;

            font-size:12px;

            line-height:1.6;

        }


        .admin-notification-date{

            color:#666672;

            font-size:10px;

        }


        /* =========================================
           VIEW BUTTON
        ========================================= */

        .notification-view-button{

            display:inline-flex;

            align-items:center;

            gap:7px;

            margin-top:14px;

            padding:9px 13px;

            border-radius:9px;

            background:rgba(168,85,247,0.10);

            border:1px solid rgba(168,85,247,0.18);

            color:#c8a8ff;

            text-decoration:none;

            font-size:10px;

            font-weight:600;

        }


        .notification-view-button:hover{

            background:rgba(168,85,247,0.18);

            color:#ffffff;

        }


        /* =========================================
           DELETE BUTTON
        ========================================= */

        .notification-delete-button{

            position:absolute;

            top:18px;

            right:18px;

            width:30px;

            height:30px;

            display:flex;

            align-items:center;

            justify-content:center;

            border-radius:8px;

            background:rgba(255,255,255,0.04);

            color:#666672;

            text-decoration:none;

        }


        .notification-delete-button:hover{

            background:rgba(239,68,68,0.10);

            color:#f87171;

        }


        /* =========================================
           EMPTY STATE
        ========================================= */

        .notifications-empty{

            width:100%;

            padding:70px 20px;

            box-sizing:border-box;

            text-align:center;

            background:#121218;

            border:1px solid rgba(255,255,255,0.08);

            border-radius:18px;

        }


        .notifications-empty-icon{

            width:60px;

            height:60px;

            margin:0 auto 18px;

            display:flex;

            align-items:center;

            justify-content:center;

            border-radius:50%;

            background:rgba(168,85,247,0.10);

            color:#a855f7;

            font-size:23px;

        }


        .notifications-empty h3{

            margin:0 0 8px;

            color:#ffffff;

            font-size:17px;

        }


        .notifications-empty p{

            margin:0;

            color:#777783;

            font-size:12px;

        }


        /* =========================================
           MOBILE
        ========================================= */

        @media(max-width:600px){

            .admin-notification{

                padding:16px;

                gap:12px;

            }


            .admin-notification-icon{

                width:42px;

                height:42px;

                font-size:14px;

            }


            .admin-notification-title{

                font-size:13px;

            }


            .admin-notification-message{

                font-size:11px;

            }

        }

    </style>

</head>


<body>


    <!-- =========================================
         SIDEBAR
    ========================================= -->

    <?php include "includes/sidebar.php"; ?>


    <main class="admin-main">


        <!-- =========================================
             TOPBAR
        ========================================= -->

        <?php include "includes/topbar.php"; ?>


        <!-- =========================================
             NOTIFICATIONS CONTENT
        ========================================= -->

        <section class="admin-content">


            <div class="notifications-page">


                <div class="notifications-heading">

                    

                    <p>
                        Stay updated with activity across your Ultimate marketplace.
                    </p>

                </div>


                <?php if(mysqli_num_rows($notificationResult) > 0): ?>


                    <div class="notifications-list">


                        <?php while($notification = mysqli_fetch_assoc($notificationResult)): ?>


                            <article
                                class="admin-notification <?= ((int)$notification["is_read"] === 0) ? "unread" : ""; ?>"
                            >


                                <!-- ICON -->

                                <div class="admin-notification-icon">

                                    <?php if(
                                        $notification["type"] === "vendor_application"
                                    ): ?>

                                        <i class="fa-solid fa-store"></i>

                                    <?php else: ?>

                                        <i class="fa-regular fa-bell"></i>

                                    <?php endif; ?>

                                </div>


                                <!-- CONTENT -->

                                <div class="admin-notification-content">


                                    <h3 class="admin-notification-title">

                                        <?= htmlspecialchars(
                                            $notification["title"]
                                        ); ?>


                                        <?php if(
                                            (int)$notification["is_read"] === 0
                                        ): ?>

                                            <span class="notification-badge">
                                                NEW
                                            </span>

                                        <?php endif; ?>

                                    </h3>


                                    <p class="admin-notification-message">

                                        <?= htmlspecialchars(
                                            $notification["message"]
                                        ); ?>

                                    </p>


                                    <span class="admin-notification-date">

                                        <?= date(
                                            "M d, Y • h:i A",
                                            strtotime(
                                                $notification["created_at"]
                                            )
                                        ); ?>

                                    </span>


                                    <?php if(
                                        $notification["reference_type"] === "vendor"
                                        &&
                                        !empty($notification["reference_id"])
                                    ): ?>

                                        <br>

                                        <a
                                            href="vendor-application.php?id=<?= (int)$notification["reference_id"]; ?>"
                                            class="notification-view-button"
                                        >

                                            <i class="fa-solid fa-arrow-right"></i>

                                            View Application

                                        </a>

                                    <?php endif; ?>


                                </div>


                                <!-- DELETE -->

                                <a
                                    href="admin-notifications.php?delete=<?= (int)$notification["id"]; ?>"
                                    class="notification-delete-button"
                                    title="Delete notification"
                                    onclick="return confirm('Delete this notification?');"
                                >

                                    <i class="fa-solid fa-xmark"></i>

                                </a>


                            </article>


                        <?php endwhile; ?>


                    </div>


                <?php else: ?>


                    <div class="notifications-empty">


                        <div class="notifications-empty-icon">

                            <i class="fa-regular fa-bell-slash"></i>

                        </div>


                        <h3>
                            No Notifications
                        </h3>


                        <p>
                            You don't have any notifications right now.
                        </p>


                    </div>


                <?php endif; ?>


            </div>


        </section>


        <!-- FOOTER -->

        <?php include "includes/footer.php"; ?>


    </main>


</body>

</html>
```
