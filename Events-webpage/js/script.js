const menuToggle = document.querySelector(".menu-toggle");
const mobileMenu = document.querySelector(".mobile-menu");
const mobileMenuClose = document.querySelector(".mobile-menu-close");

if(menuToggle && mobileMenu){

    const setMenuState = (isOpen) => {
        mobileMenu.classList.toggle("active", isOpen);
        menuToggle.setAttribute("aria-expanded", String(isOpen));
    };

    menuToggle.addEventListener("click", () => {

        const isOpen = !mobileMenu.classList.contains("active");
        setMenuState(isOpen);

    });

    mobileMenuClose?.addEventListener("click", () => {

        setMenuState(false);

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