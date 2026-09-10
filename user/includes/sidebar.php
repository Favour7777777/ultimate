<aside class="sidebar">

    <div class="logo">
        <span>U</span>ltimate
    </div>

    <nav>

        <a href="user-dashboard.php" class="active">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <a href="#">
            <i class="fa-solid fa-user"></i>
            My Profile
        </a>

        <a href="#">
            <i class="fa-solid fa-heart"></i>
            Saved Items
        </a>

        <a href="#">
            <i class="fa-solid fa-star"></i>
            My Reviews
        </a>

        <a href="#">
            <i class="fa-solid fa-box"></i>
            Orders
        </a>

        <a href="#">
            <i class="fa-solid fa-calendar-check"></i>
            Bookings
        </a>

        <a href="logout.php" class="logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

    </nav>

</aside>

<style>

.sidebar{
position:fixed;
left:0;
top:0;
width:260px;
height:100%;
background:#0d0b16;
padding:25px;
border-right:1px solid rgba(255,255,255,.06);
}

.logo{
font-size:28px;
font-weight:bold;
margin-bottom:40px;
}

.logo span{
color:#a855f7;
}

.sidebar nav{
display:flex;
flex-direction:column;
gap:10px;
}

.sidebar a{
text-decoration:none;
color:#bbb;
padding:14px 16px;
border-radius:12px;
transition:.3s;
display:flex;
align-items:center;
gap:12px;
}

.sidebar a:hover,
.sidebar .active{
background:#1b1728;
color:#fff;
}

.logout{
margin-top:30px;
color:#ff6b81!important;
}

@media(max-width:900px){
.sidebar{
display:none;
}
}

</style>