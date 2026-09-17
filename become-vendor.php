<?php

session_start();

include "config.php";


/* =========================================
   CHECK USER LOGIN
========================================= */

$user_id = $_SESSION["user_id"] ?? 0;


/* =========================================
   GET EXISTING CATEGORIES
========================================= */

$categories = [];

$query = "
    SELECT id, title
    FROM categories
    ORDER BY title ASC
";

$result = mysqli_query($conn, $query);

if($result){
    while($row = mysqli_fetch_assoc($result)){
        $categories[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Become a Vendor | Ultimate</title>

   
    <link rel="stylesheet" href="become-vendor.css">

</head>

<body>

    <main>

        <h1>Become a Vendor</h1>

        <p>
            Join Ultimate and start selling your products and services.
        </p>


        <?php if($user_id === 0): ?>

            <div>

                <h2>Create an Ultimate account first</h2>

                <p>
                    You need an Ultimate account before you can apply
                    to become a vendor.
                </p>

                <a href="signup.php">
                    Sign Up
                </a>

                <a href="login.php">
                    Login
                </a>

            </div>


        <?php else: ?>


            <form action="submit-vendor-application.php" method="POST">

                <input
                    type="hidden"
                    name="user_id"
                    value="<?= $user_id; ?>"
                >


                <div>

                    <label for="store_name">
                        Store Name
                    </label>

                    <input
                        type="text"
                        id="store_name"
                        name="store_name"
                        required
                    >

                </div>


                <div>

                    <label for="category_id">
                        Category
                    </label>

                    <select
                        id="category_id"
                        name="category_id"
                        required
                    >

                        <option value="">
                            Select a category
                        </option>

                        <?php foreach($categories as $category): ?>

                            <option value="<?= $category["id"]; ?>">

                                <?= htmlspecialchars($category["title"]); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <div>

                    <label for="store_description">
                        Store Description
                    </label>

                    <textarea
                        id="store_description"
                        name="store_description"
                        rows="5"
                    ></textarea>

                </div>


                <div>

                    <label for="phone_number">
                        Phone Number
                    </label>

                    <input
                        type="tel"
                        id="phone_number"
                        name="phone_number"
                        required
                    >

                </div>


                <div>

                    <label for="business_email">
                        Business Email
                    </label>

                    <input
                        type="email"
                        id="business_email"
                        name="business_email"
                        required
                    >

                </div>


                <div>

                    <label for="business_address">
                        Business Address
                    </label>

                    <textarea
                        id="business_address"
                        name="business_address"
                        rows="4"
                        required
                    ></textarea>

                </div>


                <button type="submit">
                    Submit Vendor Application
                </button>

            </form>

        <?php endif; ?>

    </main>

</body>

</html>