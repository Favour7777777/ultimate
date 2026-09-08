
<?php

session_start();


// MAKE SURE ADMIN IS LOGGED IN

if(!isset($_SESSION["admin_id"])){

    header("Location: login.php");
    exit();

}


require_once "../config.php";


// CHECK SERVICE ID

if(!isset($_GET["id"]) || !is_numeric($_GET["id"])){

    header("Location: services.php");
    exit();

}


$serviceId = (int) $_GET["id"];


// GET SERVICE IMAGE BEFORE DELETING

$selectQuery = "
    SELECT image
    FROM services
    WHERE id = ?
";


$stmt = mysqli_prepare($conn, $selectQuery);


if(!$stmt){

    die("Database error: " . mysqli_error($conn));

}


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $serviceId
);


mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);

$service = mysqli_fetch_assoc($result);


mysqli_stmt_close($stmt);


// SERVICE DOES NOT EXIST

if(!$service){

    header("Location: services.php");
    exit();

}


// DELETE SERVICE FROM DATABASE

$deleteQuery = "
    DELETE FROM services
    WHERE id = ?
";


$stmt = mysqli_prepare($conn, $deleteQuery);


if(!$stmt){

    die("Database error: " . mysqli_error($conn));

}


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $serviceId
);


if(mysqli_stmt_execute($stmt)){


    mysqli_stmt_close($stmt);


    // DELETE SERVICE IMAGE

    if(!empty($service["image"])){

        $imagePath = __DIR__ . "/" . $service["image"];


        if(file_exists($imagePath)){

            unlink($imagePath);

        }

    }


    // RETURN TO SERVICES PAGE

    header("Location: services.php");
    exit();


}else{


    mysqli_stmt_close($stmt);

    die(
        "Failed to delete service: " .
        mysqli_error($conn)
    );

}

?>
