```php
<?php

session_start();

require_once "../config.php";


/* =========================
   LOGIN CHECK
========================= */

if(!isset($_SESSION["user_id"])){

    header("Location: ../login.php");

    exit();

}


/* =========================
   GET VENDOR ID
========================= */

$vendor_id = isset($_GET["id"])
    ? (int)$_GET["id"]
    : 0;


if($vendor_id <= 0){

    header("Location: dashboard.php");

    exit();

}


/* =========================
   FETCH VERIFIED VENDOR
========================= */

$vendorQuery = "
    SELECT
        id,
        store_name,
        is_verified,
        verification_notice_seen

    FROM vendors

    WHERE id = ?

    AND user_id = ?

    LIMIT 1
";

$stmt = mysqli_prepare($conn, $vendorQuery);

mysqli_stmt_bind_param(
    $stmt,
    "ii",
    $vendor_id,
    $_SESSION["user_id"]
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$vendor = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


/* =========================
   VALIDATE VENDOR
========================= */

if(
    !$vendor ||
    (int)$vendor["is_verified"] !== 1
){

    header("Location: dashboard.php");

    exit();

}


/* =========================
   CONTINUE BUTTON
========================= */

if(isset($_POST["continue_dashboard"])){

    $updateQuery = "
        UPDATE vendors

        SET verification_notice_seen = 1

        WHERE id = ?

        AND user_id = ?

        AND is_verified = 1
    ";

    $stmt = mysqli_prepare($conn, $updateQuery);

    mysqli_stmt_bind_param(
        $stmt,
        "ii",
        $vendor_id,
        $_SESSION["user_id"]
    );

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);


    header("Location: dashboard.php");

    exit();

}


/* =========================
   IF ALREADY SEEN
========================= */

if((int)$vendor["verification_notice_seen"] === 1){

    header("Location: dashboard.php");

    exit();

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

    <title>Verified Vendor | Ultimate</title>


    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >


    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }


        body{

            min-height:100vh;

            display:flex;
            align-items:center;
            justify-content:center;

            padding:25px;

            font-family:"Poppins",sans-serif;

            background:
                radial-gradient(
                    circle at top,
                    rgba(168,85,247,.18),
                    transparent 40%
                ),
                #08080c;

            color:#fff;
        }


        .verification-welcome{

            width:100%;
            max-width:620px;

            padding:55px 45px;

            text-align:center;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.07),
                    rgba(255,255,255,.025)
                );

            border:1px solid rgba(255,255,255,.09);

            border-radius:28px;

            box-shadow:
                0 30px 80px rgba(0,0,0,.5),
                0 0 60px rgba(168,85,247,.08);

            backdrop-filter:blur(18px);
        }


        .verified-icon{

            width:90px;
            height:90px;

            margin:0 auto 28px;

            display:flex;
            align-items:center;
            justify-content:center;

            border-radius:50%;

            background:
                linear-gradient(
                    135deg,
                    #7c3aed,
                    #a855f7
                );

            box-shadow:
                0 0 45px rgba(168,85,247,.35);
        }


        .verified-icon i{

            font-size:38px;
        }


        .eyebrow{

            display:inline-block;

            margin-bottom:12px;

            font-size:10px;
            font-weight:600;

            letter-spacing:2px;

            color:#a855f7;
        }


        h1{

            margin-bottom:15px;

            font-size:32px;
            line-height:1.2;
        }


        h1 span{

            background:
                linear-gradient(
                    90deg,
                    #fff,
                    #a855f7
                );

            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }


        .welcome-text{

            max-width:470px;

            margin:0 auto 30px;

            color:#9999a5;

            font-size:13px;

            line-height:1.8;
        }


        .vendor-name{

            margin-bottom:30px;

            padding:14px 20px;

            display:inline-flex;
            align-items:center;
            gap:9px;

            border-radius:12px;

            background:rgba(168,85,247,.08);

            border:1px solid rgba(168,85,247,.15);

            color:#d8b4fe;

            font-size:13px;
            font-weight:600;
        }


        .vendor-name i{

            color:#a855f7;
        }


        .continue-btn{

            width:100%;

            padding:15px 22px;

            border:0;

            border-radius:13px;

            background:
                linear-gradient(
                    135deg,
                    #7c3aed,
                    #a855f7
                );

            color:#fff;

            font-family:inherit;

            font-size:13px;
            font-weight:600;

            cursor:pointer;

            transition:.25s ease;

            box-shadow:
                0 12px 30px rgba(124,58,237,.25);
        }


        .continue-btn:hover{

            transform:translateY(-2px);

            box-shadow:
                0 16px 35px rgba(124,58,237,.4);
        }


        .continue-btn i{

            margin-left:8px;
        }


        .verification-note{

            margin-top:18px;

            font-size:9px;

            color:#5f5f6b;
        }


        @media(max-width:600px){

            body{
                padding:15px;
            }


            .verification-welcome{

                padding:40px 25px;

                border-radius:22px;
            }


            .verified-icon{

                width:75px;
                height:75px;
            }


            .verified-icon i{
                font-size:30px;
            }


            h1{
                font-size:26px;
            }


            .welcome-text{
                font-size:12px;
            }

        }

    </style>

</head>


<body>


    <main class="verification-welcome">


        <div class="verified-icon">

            <i class="fa-solid fa-shield-check"></i>

        </div>


        <span class="eyebrow">
            ULTIMATE VENDOR VERIFICATION
        </span>


        <h1>
            Congratulations, <span>You're Verified!</span>
        </h1>


        <p class="welcome-text">

            Your store has officially been recognized as a
            <strong>Verified Vendor</strong> on Ultimate.

            This means your marketplace performance has met
            Ultimate's verification requirements.

        </p>


        <div class="vendor-name">

            <i class="fa-solid fa-store"></i>

            <?= htmlspecialchars($vendor["store_name"]); ?>

        </div>


        <form method="POST">

            <button
                type="submit"
                name="continue_dashboard"
                class="continue-btn"
            >

                Continue to Vendor Dashboard

                <i class="fa-solid fa-arrow-right"></i>

            </button>

        </form>


        <p class="verification-note">

            Your verified status will now appear across your
            Ultimate vendor experience.

        </p>


    </main>


</body>

</html>
```
