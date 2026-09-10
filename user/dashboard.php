<?php
require_once "../auth.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard | Ultimate</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial, Helvetica, sans-serif;
}

body{
background:#05030b;
color:#fff;
}

.dashboard{
display:flex;
min-height:100vh;
}

/* SIDEBAR SPACE */

.main{
flex:1;
margin-left:260px;
display:flex;
flex-direction:column;
min-height:100vh;
}

/* CONTENT */

.content{
padding:30px;
flex:1;
}

.welcome{
background:linear-gradient(135deg,#7b2ff7,#290044);
border-radius:25px;
padding:35px;
display:flex;
justify-content:space-between;
align-items:center;
flex-wrap:wrap;
gap:20px;
margin-bottom:30px;
}

.welcome h1{
font-size:32px;
margin-bottom:10px;
}

.welcome p{
opacity:.9;
line-height:1.6;
max-width:500px;
}

.avatar{
width:90px;
height:90px;
border-radius:50%;
background:rgba(255,255,255,.15);
display:flex;
align-items:center;
justify-content:center;
font-size:34px;
border:2px solid rgba(255,255,255,.2);
}

/* STATS */

.stats{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
margin-bottom:30px;
}

.card{
background:#12101d;
border:1px solid rgba(255,255,255,.06);
border-radius:20px;
padding:22px;
transition:.3s;
}

.card:hover{
transform:translateY(-5px);
border-color:#8b5cf6;
}

.card i{
font-size:26px;
color:#a855f7;
margin-bottom:15px;
}

.card h2{
font-size:30px;
margin-bottom:6px;
}

.card span{
color:#aaa;
font-size:14px;
}

/* QUICK ACTIONS */

.section-title{
font-size:22px;
margin-bottom:18px;
}

.actions{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
}

.action-box{
background:#12101d;
border-radius:18px;
padding:22px;
text-align:center;
border:1px solid rgba(255,255,255,.06);
transition:.3s;
cursor:pointer;
}

.action-box:hover{
background:#1b1728;
transform:translateY(-5px);
}

.action-box i{
font-size:28px;
color:#a855f7;
margin-bottom:15px;
}

.action-box h3{
font-size:16px;
margin-bottom:8px;
}

.action-box p{
font-size:13px;
color:#999;
line-height:1.5;
}

/* RESPONSIVE */

@media(max-width:1100px){

.stats,
.actions{
grid-template-columns:repeat(2,1fr);
}

}

@media(max-width:900px){

.main{
margin-left:0;
}

}

@media(max-width:600px){

.content{
padding:18px;
}

.welcome h1{
font-size:24px;
}

.stats,
.actions{
grid-template-columns:1fr;
}

.avatar{
width:70px;
height:70px;
font-size:26px;
}

}

</style>

</head>
<body>

<div class="dashboard">

    <!-- SIDEBAR -->
    <?php include "includes/sidebar.php"; ?>

    <div class="main">

        <!-- TOPBAR -->
    <?php include "includes/topbar.php"; ?>

        <div class="content">

            <!-- WELCOME -->

            <section class="welcome">

                <div>

                    <h1>
                        Welcome,
                        <?php echo htmlspecialchars($_SESSION["user_name"]); ?> 👋
                    </h1>

                    <p>
                        Manage your profile, reviews, bookings, saved products and
                        everything across Ultimate from one beautiful dashboard.
                    </p>

                </div>

                <div class="avatar">
                    <i class="fa-solid fa-user"></i>
                </div>

            </section>

            <!-- STATS -->

            <div class="stats">

                <div class="card">
                    <i class="fa-solid fa-star"></i>
                    <h2>0</h2>
                    <span>Reviews Given</span>
                </div>

                <div class="card">
                    <i class="fa-solid fa-heart"></i>
                    <h2>0</h2>
                    <span>Saved Items</span>
                </div>

                <div class="card">
                    <i class="fa-solid fa-calendar-check"></i>
                    <h2>0</h2>
                    <span>Bookings</span>
                </div>

                <div class="card">
                    <i class="fa-solid fa-box"></i>
                    <h2>0</h2>
                    <span>Orders</span>
                </div>

            </div>

            <!-- QUICK ACTIONS -->

            <h2 class="section-title">Quick Actions</h2>

            <div class="actions">

                <div class="action-box">
                    <i class="fa-solid fa-star-half-stroke"></i>
                    <h3>Leave Review</h3>
                    <p>Share your experience with Ultimate.</p>
                </div>

                <div class="action-box">
                    <i class="fa-solid fa-user-pen"></i>
                    <h3>Edit Profile</h3>
                    <p>Update your personal information.</p>
                </div>

                <div class="action-box">
                    <i class="fa-solid fa-bookmark"></i>
                    <h3>Saved Items</h3>
                    <p>Access products you've saved.</p>
                </div>

                <div class="action-box">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <h3>Recent Activity</h3>
                    <p>Continue where you left off.</p>
                </div>

            </div>

        </div>

        <!-- FOOTER -->
        <?php include "includes/footer.php"; ?>

    </div>

</div>

</body>
</html>