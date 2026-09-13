<?php

session_start();


// DESTROY ADMIN SESSION

session_unset();

session_destroy();


// RETURN TO ADMIN LOGIN

header("Location: login.php");
exit();

?>