<?php

session_start();

require_once "config.php";
require_once "vendor/autoload.php";
require_once "mail-config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = "";
$messageType = "";

if(isset($_POST["submit"])){

    $email = trim($_POST["email"]);


    /*
    ----------------------------------------
    VALIDATE EMAIL
    ----------------------------------------
    */

    if(empty($email)){

        $message = "Please enter your email address.";
        $messageType = "error";

    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){

        $message = "Please enter a valid email address.";
        $messageType = "error";

    } else {


        /*
        ----------------------------------------
        FIND USER
        ----------------------------------------
        */

        $query = "
            SELECT id, fullname, email
            FROM users
            WHERE email = ?
            AND status = 'Active'
            LIMIT 1
        ";

        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $email
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $user = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);


        /*
        ----------------------------------------
        GENERIC MESSAGE
        ----------------------------------------
        
        We don't tell the person whether the
        email actually exists.
        */

        $message =
            "If an account with that email exists, " .
            "a password reset link has been sent.";

        $messageType = "success";


        /*
        ----------------------------------------
        ONLY CREATE RESET TOKEN IF USER EXISTS
        ----------------------------------------
        */

        if($user){

            /*
            Generate a secure random token
            */

            $token = bin2hex(
                random_bytes(32)
            );


            /*
            Hash the token before storing it
            */

            $tokenHash = hash(
                "sha256",
                $token
            );


            /*
            Token expires after 30 minutes
            */

            $expiresAt = date(
                "Y-m-d H:i:s",
                time() + (30 * 60)
            );


            /*
            ----------------------------------------
            DELETE OLD RESET TOKENS
            ----------------------------------------
            */

            $deleteQuery = "
                DELETE FROM password_resets
                WHERE user_id = ?
            ";

            $stmt = mysqli_prepare(
                $conn,
                $deleteQuery
            );

            mysqli_stmt_bind_param(
                $stmt,
                "i",
                $user["id"]
            );

            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);


            /*
            ----------------------------------------
            SAVE NEW RESET TOKEN
            ----------------------------------------
            */

            $insertQuery = "
                INSERT INTO password_resets
                (
                    user_id,
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
                $user["id"],
                $tokenHash,
                $expiresAt
            );

            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);


            /*
            ----------------------------------------
            CREATE RESET LINK
            ----------------------------------------
            */

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


            /*
            ----------------------------------------
            SEND EMAIL WITH PHPMailer
            ----------------------------------------
            */

            try{

                $mail = new PHPMailer(true);

                /*
                SMTP settings
                */

                $mail->isSMTP();

                $mail->Host = SMTP_HOST;

                $mail->SMTPAuth = true;

                $mail->Username = SMTP_USERNAME;

                $mail->Password = SMTP_PASSWORD;

                $mail->SMTPSecure =
                    PHPMailer::ENCRYPTION_SMTPS;

                $mail->Port = SMTP_PORT;


                /*
                Sender
                */

                $mail->setFrom(
                    SMTP_USERNAME,
                    "Ultimate"
                );


                /*
                Recipient
                */

                $mail->addAddress(
                    $user["email"],
                    $user["fullname"]
                );


                /*
                HTML email
                */

                $mail->isHTML(true);

                $mail->Subject =
                    "Reset Your Ultimate Password";


                $mail->Body = "

                    <div style='
                        font-family: Arial, sans-serif;
                        background:#08080c;
                        padding:40px 20px;
                    '>

                        <div style='
                            max-width:600px;
                            margin:auto;
                            background:#15151d;
                            padding:35px;
                            border-radius:18px;
                            color:#ffffff;
                        '>

                            <h1 style='
                                color:#a855f7;
                                margin-bottom:10px;
                            '>
                                Ultimate
                            </h1>

                            <h2>
                                Password Reset
                            </h2>

                            <p>
                                Hello
                                " . htmlspecialchars(
                                    $user["fullname"]
                                ) . ",
                            </p>

                            <p>
                                We received a request to
                                reset your Ultimate account
                                password.
                            </p>

                            <p>
                                Click the button below to
                                create a new password.
                            </p>

                            <div style='
                                margin:30px 0;
                            '>

                                <a
                                    href='" . $resetLink . "'
                                    style='
                                        display:inline-block;
                                        padding:14px 25px;
                                        background:#8b5cf6;
                                        color:#ffffff;
                                        text-decoration:none;
                                        border-radius:10px;
                                        font-weight:bold;
                                    '
                                >
                                    Reset My Password
                                </a>

                            </div>

                            <p>
                                This link will expire in
                                <strong>
                                    30 minutes
                                </strong>.
                            </p>

                            <p>
                                If you did not request a
                                password reset, you can
                                safely ignore this email.
                            </p>

                            <hr style='
                                border:none;
                                border-top:1px solid #333;
                                margin:30px 0;
                            '>

                            <p style='
                                color:#999;
                                font-size:13px;
                            '>
                                © Ultimate Marketplace
                            </p>

                        </div>

                    </div>

                ";


                /*
                Plain-text version
                */

                $mail->AltBody =
                    "Hello " .
                    $user["fullname"] .
                    ",\n\n" .

                    "We received a request to reset " .
                    "your Ultimate password.\n\n" .

                    "Reset your password here:\n" .
                    $resetLink .
                    "\n\n" .

                    "This link expires in 30 minutes.";


                /*
                Send email
                */

                $mail->send();


            } catch(Exception $e){

                /*
                If email fails, remove the token
                we just created.
                */

                $deleteQuery = "
                    DELETE FROM password_resets
                    WHERE user_id = ?
                ";

                $stmt = mysqli_prepare(
                    $conn,
                    $deleteQuery
                );

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $user["id"]
                );

                mysqli_stmt_execute($stmt);

                mysqli_stmt_close($stmt);


                $message =
                    "We couldn't send the reset email " .
                    "right now. Please try again later.";

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

    <title>
        Forgot Password - Ultimate
    </title>


    <style>

        *{
            box-sizing:border-box;
            margin:0;
            padding:0;
        }


        body{

            min-height:100vh;

            display:flex;

            align-items:center;

            justify-content:center;

            padding:20px;

            background:
                radial-gradient(
                    circle at top right,
                    rgba(139,92,246,.25),
                    transparent 35%
                ),
                #08080c;

            font-family:Arial,sans-serif;

            color:white;
        }


        .forgot-container{

            width:100%;

            max-width:450px;

            padding:40px;

            background:rgba(255,255,255,.06);

            border:1px solid rgba(255,255,255,.1);

            border-radius:24px;

            backdrop-filter:blur(15px);

            box-shadow:
                0 20px 60px rgba(0,0,0,.4);
        }


        .logo{

            text-align:center;

            font-size:32px;

            font-weight:bold;

            color:#a855f7;

            margin-bottom:10px;
        }


        h2{

            text-align:center;

            margin-bottom:10px;
        }


        .subtitle{

            text-align:center;

            color:#aaa;

            font-size:14px;

            line-height:1.6;

            margin-bottom:30px;
        }


        label{

            display:block;

            margin-bottom:8px;

            font-size:14px;
        }


        input{

            width:100%;

            padding:14px 15px;

            border-radius:10px;

            border:1px solid #333;

            background:#101017;

            color:white;

            outline:none;

            margin-bottom:20px;
        }


        input:focus{

            border-color:#8b5cf6;
        }


        button{

            width:100%;

            padding:14px;

            border:none;

            border-radius:10px;

            background:#8b5cf6;

            color:white;

            font-size:16px;

            font-weight:bold;

            cursor:pointer;

            transition:.3s;
        }


        button:hover{

            background:#7c3aed;

            transform:translateY(-2px);
        }


        .message{

            padding:12px;

            border-radius:10px;

            margin-bottom:20px;

            font-size:14px;

            line-height:1.5;
        }


        .success{

            background:
                rgba(34,197,94,.12);

            border:
                1px solid rgba(34,197,94,.3);

            color:#86efac;
        }


        .error{

            background:
                rgba(239,68,68,.12);

            border:
                1px solid rgba(239,68,68,.3);

            color:#fca5a5;
        }


        .back-login{

            display:block;

            text-align:center;

            margin-top:22px;

            color:#aaa;

            text-decoration:none;

            font-size:14px;
        }


        .back-login:hover{

            color:#a855f7;
        }


        @media(max-width:500px){

            .forgot-container{

                padding:28px 20px;
            }
        }

    </style>

</head>


<body>


    <div class="forgot-container">


        <div class="logo">
            Ultimate
        </div>


        <h2>
            Forgot Your Password?
        </h2>


        <p class="subtitle">

            Enter the email address connected
            to your Ultimate account and we'll
            send you a password reset link.

        </p>


        <?php if(!empty($message)): ?>

            <div class="
                message
                <?= $messageType ?>
            ">

                <?= htmlspecialchars($message) ?>

            </div>

        <?php endif; ?>


        <form
            method="POST"
            action=""
        >

            <label for="email">
                Email Address
            </label>


            <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
                required
            >


            <button
                type="submit"
                name="submit"
            >
                Send Reset Link
            </button>

        </form>


        <a
            href="login.php"
            class="back-login"
        >
            ← Back to Login
        </a>


    </div>


</body>

</html>