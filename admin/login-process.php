
<?php

session_start();

require_once "../config.php";



if($_SERVER["REQUEST_METHOD"] !== "POST"){

    header("Location: login.php");

    exit();

}


$email = trim($_POST["email"] ?? "");

$password = $_POST["password"] ?? "";



if($email === "" || $password === ""){

    header("Location: login.php?error=empty");

    exit();

}



$query = "
    SELECT
        id,
        name,
        email,
        password
    FROM admins
    WHERE email = ?
    LIMIT 1
";


$stmt = mysqli_prepare($conn, $query);


if(!$stmt){

    header("Location: login.php?error=system");

    exit();

}


mysqli_stmt_bind_param(
    $stmt,
    "s",
    $email
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);


if(mysqli_num_rows($result) !== 1){

    mysqli_stmt_close($stmt);

    header("Location: login.php?error=invalid");

    exit();

}


$admin = mysqli_fetch_assoc($result);



if(!password_verify($password, $admin["password"])){

    mysqli_stmt_close($stmt);

    header("Location: login.php?error=invalid");

    exit();

}

session_regenerate_id(true);


$_SESSION["admin_id"] = $admin["id"];

$_SESSION["admin_name"] = $admin["name"];

$_SESSION["admin_email"] = $admin["email"];


mysqli_stmt_close($stmt);


header("Location: dashboard.php");

exit();

?>

