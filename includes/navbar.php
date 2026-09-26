

<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$vendorApproved = false;
$vendorStatus = "";
$vendorRejectionReason = "";

if(isset($_SESSION["user_id"])){

    require_once "config.php";

    $user_id = $_SESSION["user_id"];

    $vendorQuery = "
        SELECT status, rejection_reason
        FROM vendors
        WHERE user_id = ?
        LIMIT 1
    ";

    $stmt = mysqli_prepare($conn, $vendorQuery);

    mysqli_stmt_bind_param($stmt, "i", $user_id);

    mysqli_stmt_execute($stmt);

    $vendorResult = mysqli_stmt_get_result($stmt);

    if($vendorResult && $vendor = mysqli_fetch_assoc($vendorResult)){

        $vendorStatus = $vendor["status"];
        $vendorRejectionReason = $vendor["rejection_reason"] ?? "";

        if($vendor["status"] === "Approved"){
            $vendorApproved = true;
        }

    }

    mysqli_stmt_close($stmt);
}
?>


<!-- NAVBAR -->

<nav class="navbar">

<div class="logo">

Ultimate

</div>

<ul class="nav-links">

<li><a href="index.php">Home</a></li>

<li><a href="view-categories.php">Categories</a></li>



<li>

    <?php if($vendorApproved): ?>

        <a href="vendor-dashboard-entry.php">
            Vendor Dashboard
        </a>

    <?php elseif($vendorStatus === "Pending" || $vendorStatus === "Rejected"): ?>

        <a href="#vendor-status-modal" class="vendor-status-trigger">
            Vendor Application
        </a>

    <?php else: ?>

        <a href="become-vendor.php">
            Vendor login/signup
        </a>

    <?php endif; ?>

</li>

<li><a href="support.php">Support</a></li>

<li>
    <?php if(isset($_SESSION["user_id"])): ?>

        <a href="user/dashboard.php">
            Dashboard
        </a>

    <?php else: ?>

        <a href="login.php?return_to=user/dashboard.php">
            Dashboard
        </a>

    <?php endif; ?>
</li>

<li><a href="signup.php">Sign Up</a></li>



</ul>

<div class="menu-btn">

<i class="fa-solid fa-bars"></i>

</div>

</nav>

<!-- MOBILE MENU -->

<div class="mobile-menu">

<a href="#">Home</a>
<a href="view-categories.php">Categories</a>
<a href="services.php">Services</a>
<li>

    <?php if($vendorApproved): ?>

        <a href="vendor-dashboard-entry.php">
            Vendor Dashboard
        </a>

    <?php elseif($vendorStatus === "Pending" || $vendorStatus === "Rejected"): ?>

        <a href="#vendor-status-modal" class="vendor-status-trigger">
            Vendor Application
        </a>

    <?php else: ?>

        <a href="become-vendor.php">
            Vendor login/signup
        </a>

    <?php endif; ?>

</li>
<a href="#">Support</a>
<a href="<?= isset($_SESSION["user_id"])
    ? 'user/dashboard.php'
    : 'login.php?return_to=user/dashboard.php'
?>">
    Dashboard
</a>
<a href="login.php">Sign In</a>

</div>

<?php if($vendorStatus === "Pending" || $vendorStatus === "Rejected"): ?>

    <div
        class="vendor-status-modal"
        id="vendor-status-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="vendor-status-title"
        aria-hidden="true"
    >
        <div class="vendor-status-dialog">
            <button
                type="button"
                class="vendor-status-close"
                aria-label="Close vendor application status"
            >&times;</button>

            <?php if($vendorStatus === "Pending"): ?>
                <div class="vendor-status-icon pending">&#8987;</div>
                <p class="vendor-status-eyebrow">Vendor application</p>
                <h2 id="vendor-status-title">Your application is under review</h2>
                <p>
                    Thanks for applying to become an Ultimate vendor. Our admin team
                    is reviewing your application and will update you when a decision
                    has been made.
                </p>
            <?php else: ?>
                <div class="vendor-status-icon rejected">&times;</div>
                <p class="vendor-status-eyebrow">Vendor application</p>
                <h2 id="vendor-status-title">Your application was rejected</h2>
                <p>
                    The admin team could not approve your vendor application at this time.
                </p>

                <div class="vendor-rejection-reason">
                    <span>Admin's reason</span>
                    <p>
                        <?= !empty($vendorRejectionReason)
                            ? nl2br(htmlspecialchars($vendorRejectionReason))
                            : "No reason was provided. Please contact Ultimate support." ?>
                    </p>
                </div>
            <?php endif; ?>

            <a class="vendor-status-action" href="vendor-application-status.php">
                View application status
            </a>
        </div>
    </div>

    <script>
        (function(){
            const modal = document.getElementById("vendor-status-modal");
            const triggers = document.querySelectorAll(".vendor-status-trigger");

            if(!modal || !triggers.length){
                return;
            }

            const closeButton = modal.querySelector(".vendor-status-close");

            function closeModal(){
                modal.classList.remove("is-visible");
                modal.setAttribute("aria-hidden", "true");
            }

            triggers.forEach(function(trigger){
                trigger.addEventListener("click", function(event){
                    event.preventDefault();
                    modal.classList.add("is-visible");
                    modal.setAttribute("aria-hidden", "false");
                    closeButton.focus();
                });
            });

            closeButton.addEventListener("click", closeModal);

            modal.addEventListener("click", function(event){
                if(event.target === modal){
                    closeModal();
                }
            });

            document.addEventListener("keydown", function(event){
                if(event.key === "Escape" && modal.classList.contains("is-visible")){
                    closeModal();
                }
            });
        }());
    </script>

<?php endif; ?>

    <!-- <script src="main.js"></script> -->

