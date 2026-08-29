const menuToggle = document.querySelector(".menu-toggle");
const mobileMenu = document.querySelector(".mobile-menu");

if(menuToggle && mobileMenu){

    menuToggle.addEventListener("click", () => {

        const isOpen = mobileMenu.classList.toggle("active");

        menuToggle.setAttribute("aria-expanded", String(isOpen));

    });

}

const track = document.getElementById("eventsTrack");

if(track){

    const cards = [...track.children];

    cards.forEach(card => {
        const clone = card.cloneNode(true);
        track.appendChild(clone);
    });

    const eventsTrack = document.getElementById("eventsTrack");

    eventsTrack.addEventListener("click", function(){

        const currentState =
            getComputedStyle(eventsTrack).animationPlayState;

        if(currentState === "paused"){
            eventsTrack.style.animationPlayState = "running";
        }else{
            eventsTrack.style.animationPlayState = "paused";
        }

    });

}