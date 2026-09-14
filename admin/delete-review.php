
<?php

session_start();

if(!isset($_SESSION["admin_id"])){
    header("Location: login.php");
    exit();
}

require_once "../config.php";


/* =========================================
   CHECK REVIEW ID
========================================= */

if(!isset($_GET["id"]) || !is_numeric($_GET["id"])){

    header("Location: reviews.php");
    exit();

}

$review_id = intval($_GET["id"]);


/* =========================================
   DELETE REVIEW
========================================= */

$query = "
    DELETE FROM reviews
    WHERE id = $review_id
    LIMIT 1
";

mysqli_query($conn, $query);


/* =========================================
   RETURN TO REVIEWS
========================================= */

header("Location: reviews.php");
exit();

?>

