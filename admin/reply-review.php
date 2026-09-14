
<?php
$currentPage = "reviews";

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
   FETCH REVIEW
========================================= */

$query = "
    SELECT
        reviews.*,
        users.fullname,
        users.email
    FROM reviews

    INNER JOIN users
        ON reviews.user_id = users.id

    WHERE reviews.id = $review_id

    LIMIT 1
";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) === 0){

    header("Location: reviews.php");
    exit();

}

$review = mysqli_fetch_assoc($result);


/* =========================================
   SAVE ADMIN REPLY
========================================= */

if(isset($_POST["submit_reply"])){

    $admin_reply = trim($_POST["admin_reply"]);

    if(!empty($admin_reply)){

        $admin_reply = mysqli_real_escape_string($conn, $admin_reply);

        $update_query = "
            UPDATE reviews
            SET admin_reply = '$admin_reply'
            WHERE id = $review_id
        ";

        mysqli_query($conn, $update_query);

        header("Location: reviews.php");
        exit();

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Reply to Review | Ultimate Admin</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link rel="stylesheet" href="assets/css/admin.css">


<style>

.reply-wrapper{
    max-width:900px;
    margin:0 auto;
}

.page-header{
    margin-bottom:28px;
}

.page-header h1{
    font-size:28px;
    margin-bottom:8px;
}

.page-header p{
    color:#9ca3af;
    font-size:14px;
}

.review-preview{
    background:rgba(255,255,255,.035);
    border:1px solid rgba(255,255,255,.08);
    border-radius:20px;
    padding:24px;
    margin-bottom:25px;
}

.customer-info{
    margin-bottom:18px;
}

.customer-info h3{
    color:#fff;
    margin-bottom:5px;
}

.customer-info p{
    color:#9ca3af;
    font-size:13px;
    margin:3px 0;
}

.stars{
    display:flex;
    gap:5px;
    margin-bottom:15px;
}

.stars i{
    color:#444;
}

.stars .active{
    color:#facc15;
}

.review-content{
    color:#e5e7eb;
    line-height:1.8;
}

.reply-box{
    background:rgba(255,255,255,.035);
    border:1px solid rgba(255,255,255,.08);
    border-radius:20px;
    padding:24px;
}

.reply-box label{
    display:block;
    color:#fff;
    font-size:14px;
    font-weight:600;
    margin-bottom:10px;
}

.reply-box textarea{
    width:100%;
    min-height:180px;
    resize:vertical;
    padding:15px;
    border-radius:12px;
    border:1px solid rgba(255,255,255,.1);
    background:rgba(0,0,0,.25);
    color:#fff;
    font-family:Poppins,sans-serif;
    font-size:14px;
    outline:none;
}

.reply-box textarea:focus{
    border-color:#8b5cf6;
}

.reply-actions{
    display:flex;
    gap:12px;
    margin-top:18px;
    flex-wrap:wrap;
}

.submit-btn,
.cancel-btn{
    padding:11px 18px;
    border-radius:10px;
    text-decoration:none;
    border:none;
    font-family:Poppins,sans-serif;
    font-size:13px;
    font-weight:600;
    cursor:pointer;
    display:inline-flex;
    align-items:center;
    gap:8px;
}

.submit-btn{
    background:#7c3aed;
    color:#fff;
}

.submit-btn:hover{
    background:#6d28d9;
}

.cancel-btn{
    background:rgba(255,255,255,.08);
    color:#fff;
}

.cancel-btn:hover{
    background:rgba(255,255,255,.14);
}

@media(max-width:768px){

    .reply-actions{
        flex-direction:column;
    }

    .submit-btn,
    .cancel-btn{
        width:100%;
        justify-content:center;
    }

}

</style>

</head>

<body>

<?php include "includes/sidebar.php"; ?>

<main class="admin-main">

    <?php include "includes/topbar.php"; ?>


    <section class="admin-content">

        <div class="reply-wrapper">


            <div class="page-header">

                <h1>Reply to Review</h1>

                <p>Respond to your customer's review.</p>

            </div>


            <!-- REVIEW PREVIEW -->

            <div class="review-preview">

                <div class="customer-info">

                    <h3>
                        <?= htmlspecialchars($review["fullname"]); ?>
                    </h3>

                    <p>
                        <?= htmlspecialchars($review["email"]); ?>
                    </p>

                </div>


                <div class="stars">

                    <?php for($i = 1; $i <= 5; $i++): ?>

                        <i class="fa-solid fa-star <?= $i <= $review["rating"] ? "active" : ""; ?>"></i>

                    <?php endfor; ?>

                </div>


                <div class="review-content">

                    <?= nl2br(htmlspecialchars($review["review"])); ?>

                </div>

            </div>


            <!-- REPLY FORM -->

            <div class="reply-box">

                <form method="POST">

                    <label for="admin_reply">
                        Your Reply
                    </label>


                    <textarea
                        name="admin_reply"
                        id="admin_reply"
                        placeholder="Write your response to this customer..."
                        required
                    ><?= htmlspecialchars($review["admin_reply"] ?? ""); ?></textarea>


                    <div class="reply-actions">

                        <button
                            type="submit"
                            name="submit_reply"
                            class="submit-btn"
                        >

                            <i class="fa-solid fa-paper-plane"></i>

                            Save Reply

                        </button>


                        <a
                            href="reviews.php"
                            class="cancel-btn"
                        >

                            <i class="fa-solid fa-arrow-left"></i>

                            Cancel

                        </a>

                    </div>

                </form>

            </div>


        </div>

    </section>


    <?php include "includes/footer.php"; ?>

</main>

</body>

</html>

