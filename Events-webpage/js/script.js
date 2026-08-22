const track = document.getElementById("eventsTrack");

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