// MOBILE SIDEBAR TOGGLE

const mobileMenuBtn = document.getElementById("mobileMenuBtn");
const vendorSidebar = document.querySelector(".vendor-sidebar");

if (mobileMenuBtn && vendorSidebar) {

    mobileMenuBtn.addEventListener("click", function () {

        vendorSidebar.classList.toggle("active");

    });

}