<?php

session_start();

require_once "config.php";

/*
=========================================
    USER ALREADY LOGGED IN?
=========================================
*/

if(isset($_SESSION["user_id"])){
    return;
}

/*
=========================================
    CHECK PERSISTENT LOGIN COOKIE
=========================================
*/

if(isset($_COOKIE["ultimate_session"])){

    $token = $_COOKIE["ultimate_session"];

    $tokenHash = hash("sha256", $token);

    $query = "
        SELECT
            users.id,
            users.fullname,
            users.email,
            users.status,
            user_sessions.id AS session_id

        FROM user_sessions

        INNER JOIN users
            ON users.id = user_sessions.user_id

        WHERE user_sessions.token_hash = ?
        AND user_sessions.expires_at > NOW()

        LIMIT 1
    ";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $tokenHash
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $user = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);


    /*
    =========================================
        VALID TOKEN
    =========================================
    */

    if($user && $user["status"] === "Active"){

        session_regenerate_id(true);

        $_SESSION["user_id"] = $user["id"];

        $_SESSION["user_name"] = $user["fullname"];

        $_SESSION["user_email"] = $user["email"];


        /*
            Update last active time
        */

        $update = "
            UPDATE user_sessions

            SET last_used_at = NOW()

            WHERE id = ?
        ";

        $stmt = mysqli_prepare($conn, $update);

        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $user["session_id"]
        );

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        return;

    }

}

/*
=========================================
    NOT LOGGED IN
=========================================
*/

$currentPage = $_SERVER["REQUEST_URI"];

header(
    "Location: login.php?return_to=" .
    urlencode($currentPage)
);

exit;

?>