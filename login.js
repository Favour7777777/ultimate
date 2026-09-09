const password = document.getElementById("password");
const toggle = document.getElementById("togglePassword");

toggle.addEventListener("click", ()=>{

    if(password.type === "password"){

        password.type = "text";

        toggle.innerHTML =
        '<i class="fa-regular fa-eye-slash"></i>';

    }else{

        password.type = "password";

        toggle.innerHTML =
        '<i class="fa-regular fa-eye"></i>';

    }

});


/* =========================================
        LOGIN SUCCESS MODAL
========================================= */

function closeLoginSuccessModal(){

    const modal = document.getElementById("loginSuccessModal");

    if(modal){

        modal.style.display = "none";

    }

}


document.addEventListener("DOMContentLoaded", function(){

    const modal = document.getElementById("loginSuccessModal");

    if(modal){

        // document.body.style.overflow = "hidden";

    }

});


