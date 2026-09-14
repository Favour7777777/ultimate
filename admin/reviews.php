<?php

session_start();

if(!isset($_SESSION["admin_id"])){
    header("Location: login.php");
    exit();
}

require_once "../config.php";

$currentPage = "reviews";
$pageTitle = "Customer Reviews";
$pageDescription = "View, approve, reply and manage customer reviews";


/* =========================================
   FETCH ALL REVIEWS
========================================= */

$query = "
    SELECT
        reviews.*,
        users.fullname,
        users.email
    FROM reviews

    INNER JOIN users
        ON reviews.user_id = users.id

    ORDER BY reviews.created_at DESC
";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Customer Reviews | Ultimate Admin</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link rel="stylesheet" href="assets/css/admin.css">

<style>

.reviews-wrapper{
max-width:1100px;
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

.review-list{
display:flex;
flex-direction:column;
gap:22px;
}

.review-card{
background:rgba(255,255,255,.035);
border:1px solid rgba(255,255,255,.08);
border-radius:22px;
padding:24px;
backdrop-filter:blur(18px);
}

.review-top{
display:flex;
justify-content:space-between;
align-items:flex-start;
gap:20px;
margin-bottom:16px;
flex-wrap:wrap;
}

.user-info h3{
font-size:19px;
margin-bottom:6px;
color:#fff;
}

.user-info p{
font-size:13px;
color:#9ca3af;
margin:3px 0;
}

.status{
padding:7px 14px;
border-radius:30px;
font-size:12px;
font-weight:600;
}

.pending{
background:rgba(245,158,11,.12);
color:#fbbf24;
}

.approved{
background:rgba(34,197,94,.12);
color:#4ade80;
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

.review-text{
line-height:1.8;
color:#e5e7eb;
margin-bottom:18px;
}

.admin-reply{
background:rgba(139,92,246,.08);
border-left:4px solid #8b5cf6;
padding:16px;
border-radius:12px;
margin-bottom:18px;
}

.admin-reply strong{
display:block;
margin-bottom:8px;
}

.review-footer{
display:flex;
justify-content:space-between;
align-items:center;
gap:15px;
flex-wrap:wrap;
}

.review-date{
font-size:13px;
color:#9ca3af;
}

.actions{
display:flex;
gap:10px;
flex-wrap:wrap;
}

.btn{
padding:10px 15px;
border-radius:10px;
text-decoration:none;
font-size:13px;
font-weight:600;
display:inline-flex;
align-items:center;
gap:8px;
transition:.3s;
}

.approve-btn{
background:#15803d;
color:#fff;
}

.approve-btn:hover{
background:#166534;
}

.reply-btn{
background:#7c3aed;
color:#fff;
}

.reply-btn:hover{
background:#6d28d9;
}

.delete-btn{
background:#b91c1c;
color:#fff;
}

.delete-btn:hover{
background:#991b1b;
}

.empty-state{
text-align:center;
padding:70px 20px;
background:rgba(255,255,255,.03);
border:1px solid rgba(255,255,255,.06);
border-radius:22px;
}

.empty-state i{
font-size:48px;
color:#8b5cf6;
margin-bottom:18px;
}

.empty-state h3{
margin-bottom:8px;
}

.empty-state p{
color:#9ca3af;
}

/* =========================================
   DELETE CONFIRMATION MODAL
========================================= */

.delete-modal-overlay{
    position:fixed;
    inset:0;

    background:rgba(0,0,0,.72);
    backdrop-filter:blur(10px);
    -webkit-backdrop-filter:blur(10px);

    display:flex;
    align-items:center;
    justify-content:center;

    padding:20px;

    opacity:0;
    visibility:hidden;

    transition:.3s ease;

    z-index:9999;
}

.delete-modal-overlay.active{
    opacity:1;
    visibility:visible;
}


.delete-modal{
    position:relative;

    width:100%;
    max-width:430px;

    padding:35px 30px;

    text-align:center;

    background:
        linear-gradient(
            145deg,
            rgba(30,20,45,.96),
            rgba(10,10,15,.98)
        );

    border:1px solid rgba(139,92,246,.25);

    border-radius:24px;

    box-shadow:
        0 25px 80px rgba(0,0,0,.55),
        0 0 40px rgba(139,92,246,.08);

    transform:scale(.9) translateY(20px);

    transition:.3s ease;
}

.delete-modal-overlay.active .delete-modal{
    transform:scale(1) translateY(0);
}


/* CLOSE BUTTON */

.modal-close{
    position:absolute;

    top:15px;
    right:15px;

    width:34px;
    height:34px;

    border:none;
    border-radius:50%;

    background:rgba(255,255,255,.06);

    color:#9ca3af;

    cursor:pointer;

    transition:.3s;
}

.modal-close:hover{
    background:rgba(255,255,255,.12);
    color:#fff;
}


/* DELETE ICON */

.delete-icon{
    width:75px;
    height:75px;

    margin:0 auto 20px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:50%;

    background:rgba(239,68,68,.10);

    border:1px solid rgba(239,68,68,.20);

    box-shadow:
        0 0 30px rgba(239,68,68,.10);
}

.delete-icon i{
    font-size:30px;
    color:#f87171;
}


/* TEXT */

.delete-modal h2{
    font-size:24px;
    color:#fff;

    margin-bottom:10px;
}

.delete-modal p{
    color:#9ca3af;

    font-size:14px;

    line-height:1.7;

    margin-bottom:26px;
}


/* BUTTONS */

.modal-actions{
    display:flex;

    gap:12px;

    justify-content:center;
}

.cancel-delete,
.confirm-delete{
    flex:1;

    min-height:46px;

    border-radius:11px;

    display:flex;

    align-items:center;
    justify-content:center;

    gap:8px;

    font-family:Poppins,sans-serif;

    font-size:13px;

    font-weight:600;

    text-decoration:none;

    cursor:pointer;

    transition:.3s;
}


/* CANCEL */

.cancel-delete{
    border:1px solid rgba(255,255,255,.08);

    background:rgba(255,255,255,.05);

    color:#d1d5db;
}

.cancel-delete:hover{
    background:rgba(255,255,255,.10);

    color:#fff;
}


/* CONFIRM DELETE */

.confirm-delete{
    border:1px solid rgba(239,68,68,.25);

    background:linear-gradient(
        135deg,
        #dc2626,
        #b91c1c
    );

    color:#fff;

    box-shadow:
        0 8px 20px rgba(220,38,38,.18);
}

.confirm-delete:hover{
    transform:translateY(-2px);

    box-shadow:
        0 12px 25px rgba(220,38,38,.28);

    background:linear-gradient(
        135deg,
        #ef4444,
        #dc2626
    );
}


/* MOBILE */

@media(max-width:500px){

    .delete-modal{
        padding:32px 22px;
    }

    .modal-actions{
        flex-direction:column;
    }

    .cancel-delete,
    .confirm-delete{
        width:100%;
    }

}

@media(max-width:768px){

.review-top,
.review-footer{
flex-direction:column;
align-items:flex-start;
}

.actions{
width:100%;
}

.btn{
flex:1;
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

        <div class="reviews-wrapper">

            

            <?php if(mysqli_num_rows($result) > 0): ?>

                <div class="review-list">

                    <?php while($review = mysqli_fetch_assoc($result)): ?>

                        <div class="review-card">

                            <div class="review-top">

                                <div class="user-info">

                                    <h3>
                                        <?= htmlspecialchars($review["fullname"]); ?>
                                    </h3>

                                    <p>
                                        <?= htmlspecialchars($review["email"]); ?>
                                    </p>

                                    <p>
                                        User ID: #<?= $review["user_id"]; ?>
                                    </p>

                                </div>

                                <span class="status <?= strtolower($review["status"]); ?>">
                                    <?= $review["status"]; ?>
                                </span>

                            </div>


                            <div class="stars">

                                <?php for($i=1;$i<=5;$i++): ?>

                                    <i class="fa-solid fa-star <?= $i <= $review["rating"] ? "active" : ""; ?>"></i>

                                <?php endfor; ?>

                            </div>


                            <div class="review-text">

                                <?= nl2br(htmlspecialchars($review["review"])); ?>

                            </div>


                            <?php if(!empty($review["admin_reply"])): ?>

                                <div class="admin-reply">

                                    <strong>Admin Reply</strong>

                                    <?= nl2br(htmlspecialchars($review["admin_reply"])); ?>

                                </div>

                            <?php endif; ?>


                            <div class="review-footer">

                                <span class="review-date">

                                    <?= date("F j, Y • g:i A", strtotime($review["created_at"])); ?>

                                </span>

                                <div class="actions">

                                    <?php if($review["status"] === "Pending"): ?>

                                        <a href="approve-review.php?id=<?= $review["id"]; ?>" class="btn approve-btn">

                                            <i class="fa-solid fa-check"></i>

                                            Approve

                                        </a>

                                    <?php endif; ?>


                                    <a href="reply-review.php?id=<?= $review["id"]; ?>" class="btn reply-btn">

                                        <i class="fa-solid fa-reply"></i>

                                        Reply

                                    </a>

                                        
                                    <button
                                        type="button"
                                        class="btn delete-btn"
                                        onclick="openDeleteModal(<?= $review["id"]; ?>)"
                                    >
                                        <i class="fa-solid fa-trash"></i>
                                        Delete
                                    </button>
                                </div>

                            </div>

                        </div>

                    <?php endwhile; ?>

                </div>

            <?php else: ?>

                <div class="empty-state">

                    <i class="fa-regular fa-comment-dots"></i>

                    <h3>No Reviews Yet</h3>

                    <p>Customer reviews will appear here.</p>

                </div>

            <?php endif; ?>

        </div>

    </section>

    <?php include "includes/footer.php"; ?>

</main>

<!-- DELETE CONFIRMATION MODAL -->

<div class="delete-modal-overlay" id="deleteModal">

    <div class="delete-modal">

        <button
            type="button"
            class="modal-close"
            onclick="closeDeleteModal()"
        >
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="delete-icon">
            <i class="fa-solid fa-trash-can"></i>
        </div>

        <h2>Delete Review?</h2>

        <p>
            Are you sure you want to permanently delete this review?
            This action cannot be undone.
        </p>

        <div class="modal-actions">

            <button
                type="button"
                class="cancel-delete"
                onclick="closeDeleteModal()"
            >
                Cancel
            </button>

            <a
                href="#"
                id="confirmDeleteBtn"
                class="confirm-delete"
            >
                <i class="fa-solid fa-trash"></i>
                Delete Review
            </a>

        </div>

    </div>

</div>

<script>

function openDeleteModal(reviewId){

    const modal = document.getElementById("deleteModal");

    const confirmButton = document.getElementById("confirmDeleteBtn");

    confirmButton.href = "delete-review.php?id=" + reviewId;

    modal.classList.add("active");

}


function closeDeleteModal(){

    const modal = document.getElementById("deleteModal");

    modal.classList.remove("active");

}


/* CLOSE WHEN CLICKING OUTSIDE THE MODAL */

document.getElementById("deleteModal").addEventListener("click", function(event){

    if(event.target === this){

        closeDeleteModal();

    }

});


/* CLOSE WITH ESCAPE KEY */

document.addEventListener("keydown", function(event){

    if(event.key === "Escape"){

        closeDeleteModal();

    }

});

</script>

</body>
</html>