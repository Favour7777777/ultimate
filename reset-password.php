<?php

session_start();

require_once "config.php";

$message = "";
$messageType = "";
$validToken = false;
$resetRow = null;

$token = $_GET["token"] ?? "";

if(empty($token)){

    $message = "Invalid password reset link.";
    $messageType = "error";

}else{

    $tokenHash = hash("sha256", $token);

    $query = "
        SELECT
            password_resets.id,
            password_resets.user_id,
            password_resets.expires_at,
            password_resets.used_at
        FROM password_resets
        WHERE token_hash = ?
        LIMIT 1
    ";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $tokenHash);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $resetRow = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    if(!$resetRow){

        $message = "This reset link is invalid.";
        $messageType = "error";

    }elseif($resetRow["used_at"] !== null){

        $message = "This reset link has already been used.";
        $messageType = "error";

    }elseif(strtotime($resetRow["expires_at"]) < time()){

        $message = "This reset link has expired.";
        $messageType = "error";

    }else{

        $validToken = true;
    }
}

/*
=========================================
    UPDATE PASSWORD
=========================================
*/

if($validToken && isset($_POST["reset_password"])){

    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    if(strlen($password) < 8){

        $message = "Password must be at least 8 characters.";
        $messageType = "error";

    }elseif($password !== $confirmPassword){

        $message = "Passwords do not match.";
        $messageType = "error";

    }else{

        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        /*
        Update user password
        */

        $updateQuery = "
            UPDATE users
            SET password = ?
            WHERE id = ?
        ";

        $stmt = mysqli_prepare($conn, $updateQuery);

        mysqli_stmt_bind_param(
            $stmt,
            "si",
            $hashedPassword,
            $resetRow["user_id"]
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        /*
        Mark token as used
        */

        $usedQuery = "
            UPDATE password_resets
            SET used_at = NOW()
            WHERE id = ?
        ";

        $stmt = mysqli_prepare($conn, $usedQuery);

        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $resetRow["id"]
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        /*
        Force logout on every device
        */

        $deleteSessions = "
            DELETE FROM user_sessions
            WHERE user_id = ?
        ";

        $stmt = mysqli_prepare($conn, $deleteSessions);

        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $resetRow["user_id"]
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $_SESSION["password_reset_success"] = true;

        header("Location: login.php");

        exit();
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

<title>Reset Password</title>

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

    font-family:Arial,sans-serif;

    color:#fff;

    background:
    radial-gradient(
        circle at top left,
        rgba(139,92,246,.25),
        transparent 40%
    ),
    #08080c;

}

.card{

    width:100%;
    max-width:430px;

    padding:40px;

    border-radius:22px;

    backdrop-filter:blur(18px);

    background:rgba(255,255,255,.05);

    border:1px solid rgba(255,255,255,.08);

}

.logo{

    text-align:center;

    font-size:30px;

    color:#a855f7;

    font-weight:bold;

    margin-bottom:15px;

}

h2{

    text-align:center;

    margin-bottom:8px;

}

p{

    text-align:center;

    color:#aaa;

    font-size:14px;

    margin-bottom:25px;

}

.message{

    padding:12px;

    border-radius:10px;

    margin-bottom:18px;

    font-size:14px;

}

.success{

    background:rgba(34,197,94,.12);

    color:#86efac;

}

.error{

    background:rgba(239,68,68,.12);

    color:#fca5a5;

}

label{

    display:block;

    margin-bottom:8px;

    font-size:13px;

}

input{

    width:100%;

    padding:14px;

    border:none;

    outline:none;

    border-radius:10px;

    margin-bottom:18px;

    background:#12121a;

    color:#fff;

}

button{

    width:100%;

    padding:14px;

    border:none;

    border-radius:10px;

    background:#8b5cf6;

    color:#fff;

    font-weight:bold;

    cursor:pointer;

}

button:hover{

    background:#7c3aed;

}

.login-link{

    display:block;

    text-align:center;

    margin-top:18px;

    color:#bbb;

    text-decoration:none;

}

</style>

</head>

<body>

<div class="card">

<div class="logo">
Ultimate
</div>

<h2>Reset Password</h2>

<p>Create a brand new password for your account.</p>

<?php if($message): ?>

<div class="message <?= $messageType ?>">

<?= $message ?>

</div>

<?php endif; ?>

<?php if($validToken): ?>

<form method="POST">

<label>New Password</label>

<input
type="password"
name="password"
required
>

<label>Confirm Password</label>

<input
type="password"
name="confirm_password"
required
>

<button
type="submit"
name="reset_password"
>

Update Password

</button>

</form>

<?php endif; ?>

<a
href="login.php"
class="login-link"
>

Back to Login

</a>

</div>

</body>

</html>