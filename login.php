```php
<?php

session_start();

require_once "config.php";

$error = "";
$loginSuccess = false;


/*
    =========================================
        PERSISTENT LOGIN SETTINGS
    =========================================
*/

$rememberDays = 30;


/*
    =========================================
        RETURN TO PREVIOUS ACTIVITY
    =========================================
*/

$returnTo = $_GET["return_to"] ?? $_SESSION["return_to"] ?? "index.php";


if(
    !preg_match(
        '/^[a-zA-Z0-9_\-\/]+\.php(\?.*)?$/',
        $returnTo
    )
){

    $returnTo = "index.php";

}


$_SESSION["return_to"] = $returnTo;


/*
    =========================================
        CHECK EXISTING PERSISTENT LOGIN
    =========================================
*/

if(
    !isset($_SESSION["user_id"]) &&
    isset($_COOKIE["ultimate_session"])
){

    $persistentToken = $_COOKIE["ultimate_session"];

    $tokenHash = hash(
        "sha256",
        $persistentToken
    );


    $restoreQuery = "
        SELECT
            user_sessions.id AS session_id,
            users.id,
            users.fullname,
            users.email,
            users.status
        FROM user_sessions

        INNER JOIN users
            ON user_sessions.user_id = users.id

        WHERE user_sessions.token_hash = ?
        AND user_sessions.expires_at > NOW()

        LIMIT 1
    ";


    $stmt = mysqli_prepare(
        $conn,
        $restoreQuery
    );


    if($stmt){

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $tokenHash
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $user = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);


        if($user){

            if($user["status"] === "Active"){

                session_regenerate_id(true);


                $_SESSION["user_id"] =
                    $user["id"];

                $_SESSION["user_name"] =
                    $user["fullname"];

                $_SESSION["user_email"] =
                    $user["email"];


                /*
                    Update last used time
                */

                $updateSessionQuery = "
                    UPDATE user_sessions

                    SET last_used_at = NOW()

                    WHERE id = ?
                ";


                $updateStmt = mysqli_prepare(
                    $conn,
                    $updateSessionQuery
                );


                if($updateStmt){

                    mysqli_stmt_bind_param(
                        $updateStmt,
                        "i",
                        $user["session_id"]
                    );

                    mysqli_stmt_execute(
                        $updateStmt
                    );

                    mysqli_stmt_close(
                        $updateStmt
                    );

                }

            }else{

                /*
                    Account is inactive.
                    Remove persistent login.
                */

                $deleteSessionQuery = "
                    DELETE FROM user_sessions
                    WHERE id = ?
                ";


                $deleteStmt = mysqli_prepare(
                    $conn,
                    $deleteSessionQuery
                );


                if($deleteStmt){

                    mysqli_stmt_bind_param(
                        $deleteStmt,
                        "i",
                        $user["session_id"]
                    );

                    mysqli_stmt_execute(
                        $deleteStmt
                    );

                    mysqli_stmt_close(
                        $deleteStmt
                    );

                }


                setcookie(
                    "ultimate_session",
                    "",
                    time() - 3600,
                    "/"
                );

            }

        }else{

            /*
                Invalid or expired token.
                Remove it from browser.
            */

            setcookie(
                "ultimate_session",
                "",
                time() - 3600,
                "/"
            );

        }

    }

}


/*
    =========================================
        LOGIN PROCESS
    =========================================
*/

if(isset($_POST["login"])){

    $email =
        trim($_POST["email"] ?? "");

    $password =
        $_POST["password"] ?? "";


    /*
        Validate fields
    */

    if(
        empty($email) ||
        empty($password)
    ){

        $error =
            "Please enter your email and password.";

    }elseif(
        !filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        )
    ){

        $error =
            "Please enter a valid email address.";

    }else{


        /*
            Find user by email
        */

        $query = "
            SELECT
                id,
                fullname,
                email,
                password,
                status
            FROM users
            WHERE email = ?
            LIMIT 1
        ";


        $stmt = mysqli_prepare(
            $conn,
            $query
        );


        if(!$stmt){

            die(
                "Database error: " .
                mysqli_error($conn)
            );

        }


        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $email
        );


        mysqli_stmt_execute($stmt);


        $result =
            mysqli_stmt_get_result($stmt);


        $user =
            mysqli_fetch_assoc($result);


        mysqli_stmt_close($stmt);


        /*
            =========================================
                CHECK USER
            =========================================
        */

        if(!$user){

            $error =
                "Invalid email or password.";

        }elseif(
            $user["status"] !== "Active"
        ){

            $error =
                "Your account is currently inactive. Please contact support.";

        }elseif(
            !password_verify(
                $password,
                $user["password"]
            )
        ){

            $error =
                "Invalid email or password.";

        }else{


            /*
                =========================================
                    LOGIN SUCCESS
                =========================================
            */


            /*
                Create a fresh PHP session ID
            */

            session_regenerate_id(true);


            /*
                Store user information
                inside the PHP session
            */

            $_SESSION["user_id"] =
                $user["id"];

            $_SESSION["user_name"] =
                $user["fullname"];

            $_SESSION["user_email"] =
                $user["email"];


            /*
                =========================================
                    CREATE PERSISTENT LOGIN TOKEN
                =========================================
            */


            /*
                Generate a secure random token
            */

            $persistentToken =
                bin2hex(
                    random_bytes(32)
                );


            /*
                Hash the token before
                storing it in the database
            */

            $tokenHash =
                hash(
                    "sha256",
                    $persistentToken
                );


            /*
                Calculate expiration date
            */

            $expiresAt =
                date(
                    "Y-m-d H:i:s",
                    time() +
                    ($rememberDays * 24 * 60 * 60)
                );


            /*
                Remove any previous
                persistent session for
                this user on this browser.

                This keeps the current login
                clean if the user logs in again.
            */

            $deleteOldQuery = "
                DELETE FROM user_sessions
                WHERE user_id = ?
            ";


            $deleteOldStmt =
                mysqli_prepare(
                    $conn,
                    $deleteOldQuery
                );


            if($deleteOldStmt){

                mysqli_stmt_bind_param(
                    $deleteOldStmt,
                    "i",
                    $user["id"]
                );

                mysqli_stmt_execute(
                    $deleteOldStmt
                );

                mysqli_stmt_close(
                    $deleteOldStmt
                );

            }


            /*
                Store the hashed token
            */

            $insertSessionQuery = "
                INSERT INTO user_sessions
                (
                    user_id,
                    token_hash,
                    expires_at
                )
                VALUES
                (?, ?, ?)
            ";


            $insertSessionStmt =
                mysqli_prepare(
                    $conn,
                    $insertSessionQuery
                );


            if(!$insertSessionStmt){

                die(
                    "Database error: " .
                    mysqli_error($conn)
                );

            }


            mysqli_stmt_bind_param(
                $insertSessionStmt,
                "iss",
                $user["id"],
                $tokenHash,
                $expiresAt
            );


            if(
                mysqli_stmt_execute(
                    $insertSessionStmt
                )
            ){

                mysqli_stmt_close(
                    $insertSessionStmt
                );


                /*
                    =========================================
                        CREATE PERSISTENT COOKIE
                    =========================================
                */

                setcookie(
                    "ultimate_session",
                    $persistentToken,
                    [
                        "expires" => time() +
                            ($rememberDays * 24 * 60 * 60),

                        "path" => "/",

                        "secure" =>
                            isset($_SERVER["HTTPS"]) &&
                            $_SERVER["HTTPS"] !== "off",

                        "httponly" => true,

                        "samesite" => "Lax"
                    ]
                );


                $loginSuccess = true;


            }else{

                mysqli_stmt_close(
                    $insertSessionStmt
                );


                /*
                    The normal PHP session
                    still exists, but the
                    persistent login failed.
                */

                $error =
                    "Login successful, but we could not keep you signed in. Please try again.";

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

    <title>Login | Ultimate</title>


    <link
        rel="stylesheet"
        href="
        login.css"
    >


    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

</head>


<body>


<main class="login-page">


    <!-- =========================================
            BACKGROUND
    ========================================== -->

    <div class="bg-grid"></div>

    <div class="glow glow1"></div>

    <div class="glow glow2"></div>



    <!-- =========================================
            WELCOME SIDE
    ========================================== -->

    <section class="welcome-side">


        <a
            href="index.php"
            class="logo"
        >

            <span>U</span>ltimate

        </a>



        <div class="welcome-content">


            <span class="tag">

                WELCOME BACK

            </span>


            <h1>

                Continue your

                <span>
                    Ultimate Journey.
                </span>

            </h1>


            <p>

                Sign in to continue shopping,
                booking services, joining communities
                and managing your Ultimate account.

            </p>



            <!-- =========================================
                    STATS
            ========================================== -->

            <div class="stats">


                <div class="stat">

                    <h3>
                        100+
                    </h3>

                    <span>
                        Categories
                    </span>

                </div>


                <div class="stat">

                    <h3>
                        24/7
                    </h3>

                    <span>
                        Services
                    </span>

                </div>


                <div class="stat">

                    <h3>
                        ∞
                    </h3>

                    <span>
                        Possibilities
                    </span>

                </div>


            </div>


        </div>


    </section>



    <!-- =========================================
            LOGIN SIDE
    ========================================== -->

    <section class="login-side">


        <div class="login-card">


            <h2>
                Sign In
            </h2>


            <p>
                Welcome back. Enter your details to continue.
            </p>



            <!-- =========================================
                    ERROR MESSAGE
            ========================================== -->

            <?php if(!empty($error)): ?>

                <div class="login-error">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <span>

                        <?= htmlspecialchars($error); ?>

                    </span>

                </div>

            <?php endif; ?>



            <!-- =========================================
                    LOGIN FORM
            ========================================== -->

            <form
                action=""
                method="POST"
            >


                <!-- EMAIL -->

                <div class="input-group">


                    <label for="email">

                        Email Address

                    </label>


                    <div class="input-box">


                        <i class="fa-regular fa-envelope"></i>


                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            autocomplete="email"
                            value="<?= htmlspecialchars($_POST["email"] ?? ""); ?>"
                            required
                        >


                    </div>


                </div>



                <!-- PASSWORD -->

                <div class="input-group">


                    <div class="password-header">


                        <label for="password">

                            Password

                        </label>


                        <a href="forgot-password.php">

                            Forgot Password?

                        </a>


                    </div>



                    <div class="input-box">


                        <i class="fa-solid fa-lock"></i>


                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >


                        <button
                            type="button"
                            id="togglePassword"
                            aria-label="Show password"
                        >

                            <i class="fa-regular fa-eye"></i>

                        </button>


                    </div>


                </div>



                <!-- REMEMBER ME -->

                <div class="remember-row">


                    <label class="remember">


                        <input
                            type="checkbox"
                            name="remember"
                        >


                        <span>

                            Stay signed in

                        </span>


                    </label>


                </div>



                <!-- LOGIN BUTTON -->

                <button
                    type="submit"
                    name="login"
                    class="login-btn"
                >

                    <span>

                        Login to Ultimate

                    </span>


                    <i class="fa-solid fa-arrow-right"></i>

                </button>


            </form>



            <!-- =========================================
                    DIVIDER
            ========================================== -->

            <div class="divider">

                <span>
                    OR
                </span>

            </div>



            <!-- =========================================
                    SIGNUP LINK
            ========================================== -->

            <p class="signup-link">

                New to Ultimate?


                <a href="signup.php">

                    Create an account

                </a>

            </p>


        </div>


    </section>


</main>



<!-- =========================================
        LOGIN SUCCESS MODAL
========================================== -->

<?php if($loginSuccess): ?>

<div
    class="success-modal-overlay"
    id="loginSuccessModal"
>


    <div class="success-modal">


        <button
            type="button"
            class="success-close"
            onclick="closeLoginSuccessModal()"
            aria-label="Close"
        >

            <i class="fa-solid fa-xmark"></i>

        </button>



        <div class="success-icon">

            <i class="fa-solid fa-check"></i>

        </div>



        <span class="success-label">

            LOGIN SUCCESSFUL

        </span>



        <h2>

            Welcome back,

            <span>

                <?= htmlspecialchars(
                    $user["fullname"]
                ); ?>

            </span>

        </h2>



        <p>

            You have successfully signed in to Ultimate.
            Continue to your dashboard or return to what
            you were doing.

        </p>



        <div class="success-actions">


            <a
                href="user-dashboard.php"
                class="success-primary-btn"
            >

                <span>

                    Continue to User Dashboard

                </span>

                <i class="fa-solid fa-arrow-right"></i>

            </a>



            <a
                href="<?= htmlspecialchars(
                    $_SESSION["return_to"] ?? "index.php"
                ); ?>"
                class="success-secondary-btn"
            >

                <i class="fa-solid fa-compass"></i>

                <span>

                    Resume User Activity

                </span>

            </a>


        </div>


    </div>


</div>

<?php endif; ?>



<script src="login.js"></script>


</body>

</html>

