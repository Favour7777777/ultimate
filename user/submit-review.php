
<?php

session_start();

require_once "../config.php";


/*
=========================================
    MAKE SURE USER IS LOGGED IN
=========================================
*/

if(!isset($_SESSION["user_id"])){

    header("Location: login.php");
    exit();

}


$userId = $_SESSION["user_id"];


/*
=========================================
    ONLY ACCEPT POST REQUEST
=========================================
*/

if($_SERVER["REQUEST_METHOD"] !== "POST"){

    header("Location: reviews.php");
    exit();

}


/*
=========================================
    GET FORM DATA
=========================================
*/

$rating = (int) ($_POST["rating"] ?? 0);

$review = trim(
    $_POST["review"] ?? ""
);


/*
=========================================
    VALIDATE RATING
=========================================
*/

if($rating < 1 || $rating > 5){

    header("Location: reviews.php?error=rating");
    exit();

}


/*
=========================================
    VALIDATE REVIEW TEXT
=========================================
*/

if(empty($review)){

    header("Location: reviews.php?error=empty");
    exit();

}


/*
=========================================
    CHECK IF USER ALREADY HAS A REVIEW
=========================================
*/

$checkQuery = "
    SELECT id
    FROM reviews
    WHERE user_id = ?
    LIMIT 1
";


$stmt = mysqli_prepare(
    $conn,
    $checkQuery
);


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $userId
);


mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);


$existingReview =
    mysqli_fetch_assoc($result);


mysqli_stmt_close($stmt);


/*
=========================================
    UPDATE EXISTING REVIEW
=========================================
*/

if($existingReview){

    $updateQuery = "
        UPDATE reviews

        SET
            rating = ?,
            review = ?,
            admin_reply = NULL,
            replied_at = NULL

        WHERE user_id = ?
    ";


    $stmt = mysqli_prepare(
        $conn,
        $updateQuery
    );


    mysqli_stmt_bind_param(
        $stmt,
        "isi",
        $rating,
        $review,
        $userId
    );


    mysqli_stmt_execute($stmt);


    mysqli_stmt_close($stmt);


    header("Location: reviews.php?success=updated");
    exit();

}


/*
=========================================
    INSERT NEW REVIEW
=========================================
*/

$insertQuery = "
    INSERT INTO reviews
    (
        user_id,
        rating,
        review
    )

    VALUES
    (?, ?, ?)
";


$stmt = mysqli_prepare(
    $conn,
    $insertQuery
);


mysqli_stmt_bind_param(
    $stmt,
    "iis",
    $userId,
    $rating,
    $review
);


mysqli_stmt_execute($stmt);


mysqli_stmt_close($stmt);


/*
=========================================
    RETURN TO REVIEWS PAGE
=========================================
*/

header("Location: reviews.php?success=submitted");
exit();

?>
