/* =========================
   MOBILE MENU
========================= */

const menuToggle = document.getElementById("menuToggle");
const mobileMenu = document.getElementById("mobileMenu");

menuToggle.addEventListener("click", () => {

    mobileMenu.classList.toggle("active");

});


/* =========================
   CLOSE MOBILE MENU
   WHEN LINK IS CLICKED
========================= */

const mobileLinks = mobileMenu.querySelectorAll("a");

mobileLinks.forEach(link => {

    link.addEventListener("click", () => {

        mobileMenu.classList.remove("active");

    });

});


/* =========================
   HEART BUTTONS
========================= */

const heartButtons = document.querySelectorAll(".heart-btn");

heartButtons.forEach(button => {

    button.addEventListener("click", () => {

        if (button.textContent.trim() === "♡") {

            button.textContent = "♥";

        } else {

            button.textContent = "♡";

        }

    });

});


/* =========================
   SEARCH BUTTON
========================= */

const searchButton = document.querySelector(".search-btn");

searchButton.addEventListener("click", () => {

    const originalText = searchButton.textContent;

    searchButton.textContent = "Searching...";

    setTimeout(() => {

        searchButton.textContent = originalText;

    }, 1200);

});