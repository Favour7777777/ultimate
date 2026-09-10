
<?php

session_start();

require_once "../config.php";

/*
=========================================
    DELETE PERSISTENT LOGIN SESSION
=========================================
*/

if(isset($_COOKIE["ultimate_session"])){

    $token = $_COOKIE["ultimate_session"];

    $tokenHash = hash(
        "sha256",
        $token
    );

    $deleteQuery = "
        DELETE FROM user_sessions
        WHERE token_hash = ?
    ";

    $stmt = mysqli_prepare(
        $conn,
        $deleteQuery
    );

    if($stmt){

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $tokenHash
        );

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }

    /*
        Remove persistent login cookie
    */

    setcookie(
        "ultimate_session",
        "",
        time() - 3600,
        "/",
        "",
        isset($_SERVER["HTTPS"]),
        true
    );
}

/*
=========================================
    DESTROY PHP SESSION
=========================================
*/

$_SESSION = [];

session_destroy();

/*
=========================================
    RETURN TO HOMEPAGE
=========================================
*/

header("Location: ../index.php");
exit();

?>

