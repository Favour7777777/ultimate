<header class="topbar">

    <div class="title">
        User Dashboard
    </div>

    <div class="top-right">

        <button class="icon-btn">
            <i class="fa-regular fa-bell"></i>
        </button>

        <div class="profile">

            <div class="img">
                <i class="fa-solid fa-user"></i>
            </div>

            <div>
                <h4><?php echo htmlspecialchars($_SESSION["user_name"]); ?></h4>
                <small>Ultimate Member</small>
            </div>

        </div>

    </div>

</header>

<style>

.topbar{
height:80px;
padding:0 30px;
display:flex;
justify-content:space-between;
align-items:center;
background:#0d0b16;
border-bottom:1px solid rgba(255,255,255,.06);
}

.title{
font-size:22px;
font-weight:bold;
}

.top-right{
display:flex;
align-items:center;
gap:18px;
}

.icon-btn{
width:45px;
height:45px;
border-radius:50%;
background:#171322;
border:none;
color:#fff;
cursor:pointer;
}

.profile{
display:flex;
align-items:center;
gap:12px;
}

.img{
width:45px;
height:45px;
border-radius:50%;
background:#7b2ff7;
display:flex;
justify-content:center;
align-items:center;
}

.profile small{
color:#999;
}

@media(max-width:600px){

.topbar{
padding:0 15px;
}

.profile h4{
font-size:14px;
}

}

</style>