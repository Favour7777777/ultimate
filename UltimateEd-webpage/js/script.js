const menuToggle = document.querySelector("#menuToggle");
const navLinks = document.querySelector("#navLinks");

if(menuToggle && navLinks){

    menuToggle.onclick = function(){

        navLinks.classList.toggle("active");

    };

}

/* =========================================
   INSTITUTION SPOTLIGHT SLIDER
========================================= */

const institutionSlides =
    document.querySelectorAll(".institution-slide");

const institutionDots =
    document.querySelectorAll(".institution-dot");

const institutionPrev =
    document.querySelector(".institution-prev");

const institutionNext =
    document.querySelector(".institution-next");

const currentSlide =
    document.querySelector(".current-slide");


let institutionIndex = 0;


/* SHOW SLIDE */

function showInstitutionSlide(index){

    institutionSlides.forEach((slide) => {

        slide.classList.remove("active");

    });


    institutionDots.forEach((dot) => {

        dot.classList.remove("active");

    });


    institutionSlides[index].classList.add("active");

    institutionDots[index].classList.add("active");


    currentSlide.textContent =
        String(index + 1).padStart(2,"0");

}


/* NEXT */

institutionNext.addEventListener("click", () => {

    institutionIndex++;

    if(institutionIndex >= institutionSlides.length){

        institutionIndex = 0;

    }

    showInstitutionSlide(institutionIndex);

});


/* PREVIOUS */

institutionPrev.addEventListener("click", () => {

    institutionIndex--;

    if(institutionIndex < 0){

        institutionIndex =
            institutionSlides.length - 1;

    }

    showInstitutionSlide(institutionIndex);

});


/* DOT NAVIGATION */

institutionDots.forEach((dot,index) => {

    dot.addEventListener("click", () => {

        institutionIndex = index;

        showInstitutionSlide(institutionIndex);

    });

});


/* AUTO SLIDE */

setInterval(() => {

    institutionIndex++;

    if(institutionIndex >= institutionSlides.length){

        institutionIndex = 0;

    }

    showInstitutionSlide(institutionIndex);

},5000);

/* =========================================
   EXPERT INSTRUCTOR SLIDER
========================================= */

const expertSlides =
    document.querySelectorAll(".expert-slide");

const expertPrev =
    document.querySelector(".expert-prev");

const expertNext =
    document.querySelector(".expert-next");

const expertCurrent =
    document.querySelector(".expert-progress-current");

const expertProgress =
    document.querySelector(".expert-progress-line span");


let expertIndex = 0;


/* SHOW SLIDE */

function showExpertSlide(index){

    expertSlides.forEach((slide) => {

        slide.classList.remove("active");

    });


    expertSlides[index].classList.add("active");


    expertCurrent.textContent =
        String(index + 1).padStart(2,"0");


    const progress =
        ((index + 1) / expertSlides.length) * 100;

    expertProgress.style.width =
        progress + "%";

}


/* NEXT */

expertNext.addEventListener("click", () => {

    expertIndex++;

    if(expertIndex >= expertSlides.length){

        expertIndex = 0;

    }

    showExpertSlide(expertIndex);

});


/* PREVIOUS */

expertPrev.addEventListener("click", () => {

    expertIndex--;

    if(expertIndex < 0){

        expertIndex =
            expertSlides.length - 1;

    }

    showExpertSlide(expertIndex);

});


/* AUTO SLIDE */

setInterval(() => {

    expertIndex++;

    if(expertIndex >= expertSlides.length){

        expertIndex = 0;

    }

    showExpertSlide(expertIndex);

},5000);

/* =========================================
   STUDENT SUCCESS SLIDER
========================================= */

const successSlides =
    document.querySelectorAll(".success-slide");

const successPrev =
    document.querySelector(".success-prev");

const successNext =
    document.querySelector(".success-next");

const successCurrent =
    document.querySelector(".success-current");

const successProgress =
    document.querySelector(".success-progress-line span");


let successIndex = 0;


/* SHOW SLIDE */

function showSuccessSlide(index){

    successSlides.forEach((slide) => {

        slide.classList.remove("active");

    });


    successSlides[index].classList.add("active");


    successCurrent.textContent =
        String(index + 1).padStart(2,"0");


    const progress =
        ((index + 1) / successSlides.length) * 100;


    successProgress.style.width =
        progress + "%";

}


/* NEXT */

successNext.addEventListener("click", () => {

    successIndex++;

    if(successIndex >= successSlides.length){

        successIndex = 0;

    }

    showSuccessSlide(successIndex);

});


/* PREVIOUS */

successPrev.addEventListener("click", () => {

    successIndex--;

    if(successIndex < 0){

        successIndex =
            successSlides.length - 1;

    }

    showSuccessSlide(successIndex);

});


/* AUTO SLIDE */

setInterval(() => {

    successIndex++;

    if(successIndex >= successSlides.length){

        successIndex = 0;

    }

    showSuccessSlide(successIndex);

},5000);

/* =========================================
   EDUCATION MARKETPLACE TABS
========================================= */

const marketplaceTabs =
    document.querySelectorAll(".marketplace-tab");

const marketplacePanels =
    document.querySelectorAll(".marketplace-panel");


marketplaceTabs.forEach(tab => {

    tab.addEventListener("click", () => {

        marketplaceTabs.forEach(item => {

            item.classList.remove("active");

        });


        tab.classList.add("active");


        marketplacePanels.forEach(panel => {

            panel.classList.remove("active");

        });


        const selectedMarket =
            tab.dataset.market;


        const selectedPanel =
            document.getElementById(
                selectedMarket + "-panel"
            );


        selectedPanel.classList.add("active");

    });

});



/* =========================================
   MARKETPLACE CAROUSEL FUNCTION
========================================= */

// function createMarketplaceCarousel(
//     panelId,
//     prevClass,
//     nextClass,
//     dotsClass
// ){

//     const panel =
//         document.getElementById(panelId);

//     const track =
//         panel.querySelector(".marketplace-track");

//     const slides =
//         panel.querySelectorAll(".marketplace-slide");

//     const prev =
//         panel.querySelector("." + prevClass);

//     const next =
//         panel.querySelector("." + nextClass);

//     const dotsContainer =
//         panel.querySelector("." + dotsClass);


//     let currentIndex = 0;


//     /* CREATE DOTS */

//     slides.forEach((slide, index) => {

//         const dot =
//             document.createElement("button");

//         dot.classList.add("carousel-dot");


//         if(index === 0){

//             dot.classList.add("active");

//         }


//         dot.addEventListener("click", () => {

//             currentIndex = index;

//             updateCarousel();

//         });


//         dotsContainer.appendChild(dot);

//     });


//     const dots =
//         dotsContainer.querySelectorAll(".carousel-dot");


//     /* UPDATE */

//     function updateCarousel(){

//         const slideWidth =
//             slides[0].getBoundingClientRect().width;


//         const gap = 20;


//         track.style.transform =
//             `translateX(-${
//                 currentIndex *
//                 (slideWidth + gap)
//             }px)`;


//         dots.forEach(dot => {

//             dot.classList.remove("active");

//         });


//         dots[currentIndex]
//             .classList.add("active");

//     }


//     /* NEXT */

//     next.addEventListener("click", () => {

//         currentIndex++;


//         if(currentIndex >= slides.length){

//             currentIndex = 0;

//         }


//         updateCarousel();

//     });


//     /* PREVIOUS */

//     prev.addEventListener("click", () => {

//         currentIndex--;


//         if(currentIndex < 0){

//             currentIndex =
//                 slides.length - 1;

//         }


//         updateCarousel();

//     });


//     /* AUTO SLIDE */

//     setInterval(() => {

//         currentIndex++;


//         if(currentIndex >= slides.length){

//             currentIndex = 0;

//         }


//         updateCarousel();

//     },5000);


//     window.addEventListener(
//         "resize",
//         updateCarousel
//     );

// }



// /* =========================================
//    INITIALIZE CAROUSELS
// ========================================= */

// createMarketplaceCarousel(
//     "courses-panel",
//     "course-prev",
//     "course-next",
//     "course-dots"
// );


// createMarketplaceCarousel(
//     "tutors-panel",
//     "tutor-prev",
//     "tutor-next",
//     "tutor-dots"
// );


// createMarketplaceCarousel(
//     "institutions-panel",
//     "institution-prev",
//     "institution-next",
//     "institution-dots"
// );

/* =========================================
   MARKETPLACE CAROUSEL
========================================= */

function createMarketplaceCarousel(
    panelId,
    prevClass,
    nextClass,
    dotsClass
){

    const panel =
        document.getElementById(panelId);

    const track =
        panel.querySelector(".marketplace-track");

    const slides =
        panel.querySelectorAll(".marketplace-slide");

    const prev =
        panel.querySelector("." + prevClass);

    const next =
        panel.querySelector("." + nextClass);

    const dotsContainer =
        panel.querySelector("." + dotsClass);


    let currentIndex = 0;


    /* CREATE DOTS */

    slides.forEach((slide, index) => {

        const dot =
            document.createElement("button");

        dot.classList.add("carousel-dot");


        if(index === 0){

            dot.classList.add("active");

        }


        dot.addEventListener("click", () => {

            currentIndex = index;

            updateCarousel();

        });


        dotsContainer.appendChild(dot);

    });


    const dots =
        dotsContainer.querySelectorAll(".carousel-dot");


    /* =====================================
       FIND LAST VALID POSITION
    ====================================== */

    function getVisibleSlides(){

        if(window.innerWidth <= 600){

            return 1;

        }

        if(window.innerWidth <= 900){

            return 2;

        }

        return 3;

    }


    function getMaxIndex(){

        return Math.max(
            0,
            slides.length - getVisibleSlides()
        );

    }


    /* =====================================
       UPDATE CAROUSEL
    ====================================== */

    function updateCarousel(){

        const slideWidth =
            slides[0].getBoundingClientRect().width;

        const gap = 20;

        const maxIndex =
            getMaxIndex();


        /* PREVENT EMPTY SPACE */

        if(currentIndex > maxIndex){

            currentIndex = maxIndex;

        }


        track.style.transform =
            `translateX(-${
                currentIndex *
                (slideWidth + gap)
            }px)`;


        /* UPDATE DOTS */

        dots.forEach(dot => {

            dot.classList.remove("active");

        });


        dots[currentIndex]
            ?.classList.add("active");

    }


    /* =====================================
       NEXT
    ====================================== */

    function goNext(){

        const maxIndex =
            getMaxIndex();


        if(currentIndex >= maxIndex){

            currentIndex = 0;

        }else{

            currentIndex++;

        }


        updateCarousel();

    }


    /* =====================================
       PREVIOUS
    ====================================== */

    function goPrevious(){

        const maxIndex =
            getMaxIndex();


        if(currentIndex <= 0){

            currentIndex = maxIndex;

        }else{

            currentIndex--;

        }


        updateCarousel();

    }


    next.addEventListener(
        "click",
        goNext
    );


    prev.addEventListener(
        "click",
        goPrevious
    );


    /* =====================================
       AUTO SLIDE
    ====================================== */

    setInterval(() => {

        goNext();

    },5000);


    window.addEventListener(
        "resize",
        updateCarousel
    );


    updateCarousel();

}



/* =========================================
   INITIALIZE
========================================= */

createMarketplaceCarousel(
    "courses-panel",
    "course-prev",
    "course-next",
    "course-dots"
);


createMarketplaceCarousel(
    "tutors-panel",
    "tutor-prev",
    "tutor-next",
    "tutor-dots"
);


createMarketplaceCarousel(
    "institutions-panel",
    "institution-prev",
    "institution-next",
    "institution-dots"
);