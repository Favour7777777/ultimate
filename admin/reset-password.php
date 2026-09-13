
<?php

session_start();

require_once "../config.php";


$message = "";
$messageType = "";


// TRACK WHETHER THE TOKEN IS VALID

$tokenValid = false;


// GET RESET TOKEN

$token = $_GET["token"] ?? "";


// CHECK TOKEN EXISTS

if(empty($token)){

    $message =
        "This password reset link is invalid.";

    $messageType = "error";

}


// CHECK TOKEN

if(!empty($token)){

    $tokenHash = hash(
        "sha256",
        $token
    );


    $query = "
        SELECT
            id,
            admin_id,
            expires_at,
            used_at
        FROM admin_password_resets
        WHERE token_hash = ?
        LIMIT 1
    ";


    $stmt = mysqli_prepare(
        $conn,
        $query
    );


    if(!$stmt){

        $message =
            "A system error occurred.";

        $messageType = "error";


    }else{

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $tokenHash
        );


        mysqli_stmt_execute($stmt);


        $result =
            mysqli_stmt_get_result($stmt);


        $reset =
            mysqli_fetch_assoc($result);


        mysqli_stmt_close($stmt);


        // INVALID TOKEN

        if(!$reset){

            $message =
                "This password reset link is invalid.";

            $messageType = "error";


        // TOKEN ALREADY USED

        }elseif(!empty($reset["used_at"])){

            $message =
                "This password reset link has already been used.";

            $messageType = "error";


        // TOKEN EXPIRED

        }elseif(strtotime($reset["expires_at"]) < time()){

            $message =
                "This password reset link has expired.";

            $messageType = "error";


        }else{

            // TOKEN IS VALID

            $tokenValid = true;

        }

    }

}


// PROCESS NEW PASSWORD

if(
    $_SERVER["REQUEST_METHOD"] === "POST"
    && $tokenValid
){

    $password =
        $_POST["password"] ?? "";


    $confirmPassword =
        $_POST["confirm_password"] ?? "";


    // PASSWORD LENGTH

    if(strlen($password) < 8){

        $message =
            "Password must be at least 8 characters.";

        $messageType = "error";


    // PASSWORD MATCH

    }elseif($password !== $confirmPassword){

        $message =
            "Passwords do not match.";

        $messageType = "error";


    }else{


        // HASH PASSWORD

        $hashedPassword =
            password_hash(
                $password,
                PASSWORD_DEFAULT
            );


        // UPDATE ADMIN PASSWORD

        $updateQuery = "
            UPDATE admins
            SET password = ?
            WHERE id = ?
        ";


        $stmt = mysqli_prepare(
            $conn,
            $updateQuery
        );


        if(!$stmt){

            $message =
                "A system error occurred.";

            $messageType = "error";


        }else{

            mysqli_stmt_bind_param(
                $stmt,
                "si",
                $hashedPassword,
                $reset["admin_id"]
            );


            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_close($stmt);


                // MARK RESET TOKEN AS USED

                $usedQuery = "
                    UPDATE admin_password_resets
                    SET used_at = NOW()
                    WHERE id = ?
                ";


                $stmt = mysqli_prepare(
                    $conn,
                    $usedQuery
                );


                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $reset["id"]
                );


                mysqli_stmt_execute($stmt);

                mysqli_stmt_close($stmt);


                // DESTROY CURRENT ADMIN SESSION

                session_unset();

                session_destroy();


                // SEND ADMIN BACK TO LOGIN

                header(
                    "Location: login.php?reset=success"
                );

                exit();


            }else{

                mysqli_stmt_close($stmt);


                $message =
                    "Failed to update password.";

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

    <title>Reset Password | Ultimate Admin</title>


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


        .reset-card{

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


            .reset-card{

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


    <main class="reset-card">


        <!-- ICON -->

        <div class="icon">

            <i class="fa-solid fa-lock"></i>

        </div>


        <!-- HEADING -->

        <div class="heading">

            <span>ADMIN PORTAL</span>

            <h1>Create New Password</h1>

            <p>

                Choose a strong new password for your
                Ultimate administrator account.

            </p>

        </div>


        <!-- MESSAGE -->

        <?php if(!empty($message)): ?>

            <div class="message <?= $messageType ?>">

                <?= htmlspecialchars($message) ?>

            </div>

        <?php endif; ?>


        <?php if($tokenValid): ?>


            <!-- RESET FORM -->

            <form
                action="?token=<?= urlencode($token) ?>"
                method="POST"
            >


                <div class="input-group">

                    <i class="fa-solid fa-lock"></i>

                    <input
                        type="password"
                        name="password"
                        placeholder="New Password"
                        autocomplete="new-password"
                        required
                    >

                </div>


                <div class="input-group">

                    <i class="fa-solid fa-shield-halved"></i>

                    <input
                        type="password"
                        name="confirm_password"
                        placeholder="Confirm New Password"
                        autocomplete="new-password"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="reset-btn"
                >

                    Update Password

                </button>


            </form>


        <?php endif; ?>


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