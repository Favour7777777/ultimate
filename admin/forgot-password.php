<?php

session_start();

require_once "../config.php";
require_once "../vendor/autoload.php";
require_once "../mail-config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$message = "";
$messageType = "";


if(isset($_POST["submit"])){

    $email = trim($_POST["email"]);


    // CHECK EMAIL

    if(empty($email)){

        $message = "Please enter your email address.";
        $messageType = "error";


    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){

        $message = "Please enter a valid email address.";
        $messageType = "error";


    } else {


        // FIND ADMIN

        $query = "
            SELECT
                id,
                name,
                email
            FROM admins
            WHERE email = ?
            LIMIT 1
        ";


        $stmt = mysqli_prepare(
            $conn,
            $query
        );


        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $email
        );


        mysqli_stmt_execute($stmt);


        $result = mysqli_stmt_get_result($stmt);

        $admin = mysqli_fetch_assoc($result);


        mysqli_stmt_close($stmt);


        // ALWAYS SHOW A GENERIC MESSAGE

        $message =
            "If an admin account with that email exists, " .
            "a password reset link has been sent.";

        $messageType = "success";


        // CONTINUE ONLY IF ADMIN EXISTS

        if($admin){


            // GENERATE SECURE TOKEN

            $token = bin2hex(
                random_bytes(32)
            );


            // HASH TOKEN FOR DATABASE

            $tokenHash = hash(
                "sha256",
                $token
            );


            // TOKEN EXPIRES IN 30 MINUTES

            $expiresAt = date(
                "Y-m-d H:i:s",
                time() + (30 * 60)
            );


            // DELETE OLD RESET TOKENS

            $deleteQuery = "
                DELETE FROM admin_password_resets
                WHERE admin_id = ?
            ";


            $stmt = mysqli_prepare(
                $conn,
                $deleteQuery
            );


            mysqli_stmt_bind_param(
                $stmt,
                "i",
                $admin["id"]
            );


            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);


            // SAVE NEW RESET TOKEN

            $insertQuery = "
                INSERT INTO admin_password_resets
                (
                    admin_id,
                    token_hash,
                    expires_at
                )
                VALUES (?, ?, ?)
            ";


            $stmt = mysqli_prepare(
                $conn,
                $insertQuery
            );


            mysqli_stmt_bind_param(
                $stmt,
                "iss",
                $admin["id"],
                $tokenHash,
                $expiresAt
            );


            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);


            // BUILD RESET LINK

            $protocol = (
                !empty($_SERVER["HTTPS"])
                && $_SERVER["HTTPS"] !== "off"
            )
            ? "https"
            : "http";


            $host = $_SERVER["HTTP_HOST"];


            $resetLink =
                $protocol .
                "://" .
                $host .
                dirname($_SERVER["PHP_SELF"]) .
                "/reset-password.php?token=" .
                urlencode($token);


            // SEND EMAIL

            try{

                $mail = new PHPMailer(true);

                $mail->isSMTP();

                $mail->Host = SMTP_HOST;

                $mail->SMTPAuth = true;

                $mail->Username = SMTP_USERNAME;

                $mail->Password = SMTP_PASSWORD;

                $mail->SMTPSecure =
                    PHPMailer::ENCRYPTION_SMTPS;

                $mail->Port = SMTP_PORT;


                $mail->setFrom(
                    SMTP_USERNAME,
                    "Ultimate Admin"
                );


                $mail->clearAddresses();

                $mail->addAddress(
                    $email,
                    $admin["name"]
                );


                $mail->isHTML(true);


                $mail->Subject =
                    "Reset Your Ultimate Admin Password";


                $mail->Body = "

                    <h2>Ultimate Admin Password Reset</h2>

                    <p>
                        Hello {$admin["name"]},
                    </p>

                    <p>
                        We received a request to reset
                        your Ultimate administrator password.
                    </p>

                    <p>
                        Click the button below to create
                        a new password:
                    </p>

                    <p>
                        <a
                            href='{$resetLink}'
                            style='
                                display:inline-block;
                                padding:12px 20px;
                                background:#7c3aed;
                                color:#ffffff;
                                text-decoration:none;
                                border-radius:8px;
                            '
                        >
                            Reset Admin Password
                        </a>
                    </p>

                    <p>
                        This link expires in 30 minutes.
                    </p>

                    <p>
                        If you did not request this reset,
                        you can safely ignore this email.
                    </p>

                    <p>
                        — Ultimate Security
                    </p>

                ";


                $mail->AltBody =
                    "Hello " .
                    $admin["name"] .
                    ",\n\n" .

                    "We received a request to reset " .
                    "your Ultimate administrator password.\n\n" .

                    "Reset your password here:\n" .
                    $resetLink .
                    "\n\n" .

                    "This link expires in 30 minutes.";


                $mail->send();


            } catch(Exception $e){

                // REMOVE TOKEN IF EMAIL FAILED

                $deleteQuery = "
                    DELETE FROM admin_password_resets
                    WHERE admin_id = ?
                ";


                $stmt = mysqli_prepare(
                    $conn,
                    $deleteQuery
                );


                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $admin["id"]
                );


                mysqli_stmt_execute($stmt);

                mysqli_stmt_close($stmt);


                $message =
                    "Email error: " .
                    $e->getMessage();

                $messageType = "error";
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

    <title>Forgot Password | Ultimate Admin</title>


    <!-- GOOGLE FONT -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

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

            padding:20px;

            font-family:'Poppins', sans-serif;

            background:
                radial-gradient(
                    circle at top left,
                    rgba(124,58,237,0.25),
                    transparent 35%
                ),
                radial-gradient(
                    circle at bottom right,
                    rgba(88,28,135,0.25),
                    transparent 35%
                ),
                #080808;

            color:#ffffff;

        }


        .forgot-card{

            width:100%;

            max-width:500px;

            padding:45px 40px;

            background:rgba(255,255,255,0.06);

            border:1px solid rgba(255,255,255,0.12);

            border-radius:24px;

            backdrop-filter:blur(20px);

            -webkit-backdrop-filter:blur(20px);

            box-shadow:
                0 25px 70px rgba(0,0,0,0.55),
                0 0 40px rgba(124,58,237,0.08);

        }


        .icon{

            width:70px;

            height:70px;

            margin:0 auto 25px;

            display:flex;

            align-items:center;

            justify-content:center;

            border-radius:20px;

            background:rgba(124,58,237,0.15);

            border:1px solid rgba(124,58,237,0.3);

            color:#a855f7;

            font-size:28px;

        }


        .heading{

            text-align:center;

            margin-bottom:30px;

        }


        .heading span{

            display:block;

            margin-bottom:8px;

            color:#a855f7;

            font-size:12px;

            font-weight:600;

            letter-spacing:2px;

        }


        .heading h1{

            margin-bottom:10px;

            font-size:30px;

            font-weight:600;

        }


        .heading p{

            color:#aaa;

            font-size:14px;

            line-height:1.7;

        }


        .message{

            margin-bottom:20px;

            padding:14px 16px;

            border-radius:12px;

            font-size:13px;

            line-height:1.5;

        }


        .message.success{

            color:#d8ffd8;

            background:rgba(34,197,94,0.10);

            border:1px solid rgba(34,197,94,0.25);

        }


        .message.error{

            color:#ffd4d4;

            background:rgba(239,68,68,0.10);

            border:1px solid rgba(239,68,68,0.25);

        }


        .input-group{

            position:relative;

            margin-bottom:20px;

        }


        .input-group i{

            position:absolute;

            left:18px;

            top:50%;

            transform:translateY(-50%);

            color:#a855f7;

        }


        .input-group input{

            width:100%;

            padding:16px 18px 16px 50px;

            border:none;

            outline:none;

            border-radius:14px;

            background:rgba(255,255,255,0.07);

            border:1px solid rgba(255,255,255,0.10);

            color:#ffffff;

            font-family:inherit;

            font-size:14px;

        }


        .input-group input:focus{

            border-color:rgba(168,85,247,0.6);

            box-shadow:
                0 0 0 3px rgba(168,85,247,0.08);

        }


        .input-group input::placeholder{

            color:#888;

        }


        .reset-btn{

            width:100%;

            padding:16px;

            border:none;

            border-radius:14px;

            background:linear-gradient(
                135deg,
                #7c3aed,
                #a855f7
            );

            color:#ffffff;

            font-family:inherit;

            font-size:14px;

            font-weight:600;

            cursor:pointer;

            transition:0.3s ease;

        }


        .reset-btn:hover{

            transform:translateY(-2px);

            box-shadow:
                0 12px 30px rgba(124,58,237,0.30);

        }


        .back-login{

            display:block;

            margin-top:25px;

            text-align:center;

            color:#aaa;

            font-size:13px;

            text-decoration:none;

            transition:0.3s ease;

        }


        .back-login:hover{

            color:#a855f7;

        }


        @media(max-width:600px){

            body{

                padding:15px;

            }


            .forgot-card{

                padding:35px 25px;

                border-radius:20px;

            }


            .heading h1{

                font-size:25px;

            }

        }

    </style>

</head>


<body>


    <main class="forgot-card">


        <!-- ICON -->

        <div class="icon">

            <i class="fa-solid fa-key"></i>

        </div>


        <!-- HEADING -->

        <div class="heading">

            <span>ADMIN PORTAL</span>

            <h1>Forgot Password?</h1>

            <p>

                Enter your administrator email address
                and we'll send you a secure password
                reset link.

            </p>

        </div>


        <!-- MESSAGE -->

        <?php if(!empty($message)): ?>

            <div class="message <?= $messageType ?>">

                <?= htmlspecialchars($message) ?>

            </div>

        <?php endif; ?>


        <!-- FORM -->

        <form
            action=""
            method="POST"
        >


            <div class="input-group">

                <i class="fa-solid fa-envelope"></i>

                <input
                    type="email"
                    name="email"
                    placeholder="Admin Email"
                    autocomplete="email"
                    required
                >

            </div>


            <button
                type="submit"
                name="submit"
                class="reset-btn"
            >

                Send Reset Link

            </button>


        </form>


        <!-- BACK TO LOGIN -->

        <a
            href="login.php"
            class="back-login"
        >

            <i class="fa-solid fa-arrow-left"></i>

            Back to Admin Login

        </a>


    </main>


</body>

</html>