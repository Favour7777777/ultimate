// =========================================
// PASSWORD VISIBILITY
// =========================================

const passwordInput = document.getElementById("password");
const passwordToggle = document.getElementById("passwordToggle");

passwordToggle.addEventListener("click", function () {

    if (passwordInput.type === "password") {

        passwordInput.type = "text";

        passwordToggle.innerHTML =
            '<i class="fa-regular fa-eye-slash"></i>';

        passwordToggle.setAttribute(
            "aria-label",
            "Hide password"
        );

    } else {

        passwordInput.type = "password";

        passwordToggle.innerHTML =
            '<i class="fa-regular fa-eye"></i>';

        passwordToggle.setAttribute(
            "aria-label",
            "Show password"
        );

    }

});


// =========================================
// PASSWORD STRENGTH
// =========================================

const strengthBars =
    document.querySelectorAll(".strength-bars span");

const strengthText =
    document.getElementById("strengthText");


passwordInput.addEventListener("input", function () {

    const password = passwordInput.value;

    let strength = 0;


    if (password.length >= 8) {
        strength++;
    }

    if (/[A-Z]/.test(password)) {
        strength++;
    }

    if (/[0-9]/.test(password)) {
        strength++;
    }

    if (/[^A-Za-z0-9]/.test(password)) {
        strength++;
    }


    strengthBars.forEach(function (bar, index) {

        if (index < strength) {
            bar.style.background = "#9b5cff";
        } else {
            bar.style.background = "#292930";
        }

    });


    if (password.length === 0) {

        strengthText.textContent =
            "Use 8 or more characters";

    } else if (strength === 1) {

        strengthText.textContent =
            "Weak password";

    } else if (strength === 2) {

        strengthText.textContent =
            "Fair password";

    } else if (strength === 3) {

        strengthText.textContent =
            "Good password";

    } else {

        strengthText.textContent =
            "Strong password";

    }

});