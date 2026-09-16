<?php

include "../config.php";


/* =========================================
   EXPIRE PRODUCTS
========================================= */

$productQuery = "
    UPDATE products
    SET availability_status = 'Unavailable'
    WHERE
        approval_status = 'Approved'
        AND availability_status = 'Available'
        AND last_availability_renewal IS NOT NULL
        AND availability_renewal_due IS NOT NULL
       AND last_availability_renewal <= DATE_SUB(NOW(), INTERVAL 48 HOUR)
";

mysqli_query($conn, $productQuery);

/* =========================================
   EXPIRE SERVICES
========================================= */

$serviceQuery = "
    UPDATE services
    SET availability_status = 'Unavailable'
    WHERE
        approval_status = 'Approved'
        AND availability_status = 'Available'
        AND last_availability_renewal IS NOT NULL
        AND availability_renewal_due IS NOT NULL
        AND last_availability_renewal <= DATE_SUB(NOW(), INTERVAL 48 HOUR)
";

mysqli_query($conn, $serviceQuery);

?>