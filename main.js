// BACKGROUND SLIDESHOW

const hero = document.querySelector(".hero");

const images = [

"https://images.unsplash.com/photo-1441986300917-64674bd600d8",

"https://images.unsplash.com/photo-1520607162513-77705c0f0d4a",

"https://images.unsplash.com/photo-1516321318423-f06f85e504b3",

"https://images.unsplash.com/photo-1497366754035-f200968a6e72"

];

let current = 0;

function changeBackground(){

if(!hero){

return;

}

hero.style.backgroundImage =
`url(${images[current]})`;

current++;

if(current >= images.length){

current = 0;

}

}

changeBackground();

if(hero){

setInterval(changeBackground,5000);

}


// STICKY NAV

window.addEventListener("scroll",()=>{

document
.querySelector(".navbar")
.classList.toggle(
"sticky",
window.scrollY > 50
);

});


// MOBILE MENU

const menuBtn =
document.querySelector(".menu-btn");

const mobileMenu =
document.querySelector(".mobile-menu");

if(menuBtn && mobileMenu){

menuBtn.addEventListener("click",()=>{

mobileMenu.classList.toggle("active");

});

}


// TYPING PLACEHOLDER

const input =
document.getElementById("searchInput");

const texts = [

"Search for sneakers...",

"Hire a web developer...",

"Rent a car...",

"Buy furniture...",

"Book a photographer...",

"Find home appliances..."

];

let textIndex = 0;
let charIndex = 0;

function typeEffect(){

let currentText = texts[textIndex];

input.setAttribute(
"placeholder",
currentText.substring(0,charIndex)
);

charIndex++;

if(charIndex > currentText.length){

setTimeout(()=>{

charIndex = 0;

textIndex++;

if(textIndex >= texts.length){

textIndex = 0;

}

},1500);

}

setTimeout(typeEffect,100);

}

typeEffect();

/*=========================================
CHOOSE YOUR EXPERIENCE ANIMATIONS
=========================================*/

const experienceCards = document.querySelectorAll(".experience-card");

const experienceObserver = new IntersectionObserver((entries)=>{

    entries.forEach(entry=>{

        if(entry.isIntersecting){

            entry.target.classList.add("show-card");

        }

    });

},{
    threshold:0.2
});


experienceCards.forEach(card=>{

    experienceObserver.observe(card);

});


/*=========================================
BUTTON RIPPLE EFFECT
=========================================*/

const experienceButtons =
document.querySelectorAll(".experience-btn");

experienceButtons.forEach(button=>{

    button.addEventListener("mousemove",(e)=>{

        const rect = button.getBoundingClientRect();

        const x = e.clientX - rect.left;

        const y = e.clientY - rect.top;

        button.style.setProperty("--x",`${x}px`);

        button.style.setProperty("--y",`${y}px`);

    });

});
/*====================================
    EXPLORE EVERYTHING ANIMATION
=====================================*/

const categoryCards = document.querySelectorAll(".category-card");

const categoryObserver = new IntersectionObserver((entries) => {

    entries.forEach((entry) => {

        if (entry.isIntersecting) {

            const index = [...categoryCards].indexOf(entry.target);

            setTimeout(() => {

                entry.target.classList.add("show-category");

            }, index * 120);

            categoryObserver.unobserve(entry.target);

        }

    });

}, {
    threshold: 0.2
});

categoryCards.forEach((card) => {

    categoryObserver.observe(card);

});
/*====================================
    HANDPICKED PRODUCTS ANIMATION
=====================================*/

const productCards = document.querySelectorAll(".product-card");

const productObserver = new IntersectionObserver((entries) => {

    entries.forEach((entry) => {

        if (entry.isIntersecting) {

            const index = [...productCards].indexOf(entry.target);

            setTimeout(() => {

                entry.target.classList.add("show-product");

            }, index * 150);

            productObserver.unobserve(entry.target);

        }

    });

}, {

    threshold:0.2

});

productCards.forEach((card)=>{

    productObserver.observe(card);

});
/*=========================================
        SERVICES SLIDER
==========================================*/

const servicesSlider = document.querySelector(".services-slider");

const nextBtn = document.querySelector(".next-btn");

const prevBtn = document.querySelector(".prev-btn");

const serviceCard = document.querySelector(".service-card");

const scrollAmount = serviceCard ? serviceCard.offsetWidth + 30 : 0;


/*=========================
      NEXT BUTTON
=========================*/

nextBtn.addEventListener("click", () => {

    servicesSlider.scrollBy({

        left: scrollAmount,

        behavior: "smooth"

    });

});


/*=========================
      PREVIOUS BUTTON
=========================*/

prevBtn.addEventListener("click", () => {

    servicesSlider.scrollBy({

        left: -scrollAmount,

        behavior: "smooth"

    });

});


/*=========================
      AUTO SLIDE
=========================*/

let autoSlide = setInterval(() => {

    if (

        servicesSlider.scrollLeft + servicesSlider.clientWidth >=

        servicesSlider.scrollWidth - 5

    ) {

        servicesSlider.scrollTo({

            left: 0,

            behavior: "smooth"

        });

    }

    else {

        servicesSlider.scrollBy({

            left: scrollAmount,

            behavior: "smooth"

        });

    }

}, 4000);


/*=========================
      PAUSE ON HOVER
=========================*/

servicesSlider.addEventListener("mouseenter", () => {

    clearInterval(autoSlide);

});


servicesSlider.addEventListener("mouseleave", () => {

    autoSlide = setInterval(() => {

        if (

            servicesSlider.scrollLeft + servicesSlider.clientWidth >=

            servicesSlider.scrollWidth - 5

        ) {

            servicesSlider.scrollTo({

                left: 0,

                behavior: "smooth"

            });

        }

        else {

            servicesSlider.scrollBy({

                left: scrollAmount,

                behavior: "smooth"

            });

        }

    }, 4000);

});
/*=========================================
        SCROLL REVEAL
==========================================*/

const serviceCards = document.querySelectorAll(".service-card");

const serviceObserver = new IntersectionObserver((entries)=>{

    entries.forEach(entry=>{

        if(entry.isIntersecting){

            const index = [...serviceCards].indexOf(entry.target);

            setTimeout(()=>{

                entry.target.classList.add("show-service");

            },index*150);

            serviceObserver.unobserve(entry.target);

        }

    });

},{
    threshold:0.2
});

serviceCards.forEach(card=>{

    serviceObserver.observe(card);

});

/*=========================================
        WHY CHOOSE ULTIMATE
==========================================*/

const whyCards = document.querySelectorAll(".why-card");

const whyObserver = new IntersectionObserver((entries)=>{

    entries.forEach(entry=>{

        if(entry.isIntersecting){

            const index = [...whyCards].indexOf(entry.target);

            setTimeout(()=>{

                entry.target.classList.add("show-why-card");

            },index * 180);

            whyObserver.unobserve(entry.target);

        }

    });

},{
    threshold:0.2
});

whyCards.forEach(card=>{

    whyObserver.observe(card);

});

/*=========================================
        TESTIMONIAL CAROUSEL
==========================================*/

const testimonialSlider = document.querySelector(".testimonial-slider");

const nextTestimonial = document.querySelector(".next-testimonial");

const prevTestimonial = document.querySelector(".prev-testimonial");

const testimonialCard = document.querySelector(".testimonial-card");

const testimonialScroll =
testimonialCard.offsetWidth + 35;


/*=========================================
        NEXT BUTTON
==========================================*/

nextTestimonial.addEventListener("click",()=>{

    testimonialSlider.scrollBy({

        left:testimonialScroll,

        behavior:"smooth"

    });

});


/*=========================================
        PREVIOUS BUTTON
==========================================*/

prevTestimonial.addEventListener("click",()=>{

    testimonialSlider.scrollBy({

        left:-testimonialScroll,

        behavior:"smooth"

    });

});


/*=========================================
        AUTO PLAY
==========================================*/

let testimonialAuto = setInterval(()=>{

    if(

        testimonialSlider.scrollLeft +
        testimonialSlider.clientWidth >=
        testimonialSlider.scrollWidth - 5

    ){

        testimonialSlider.scrollTo({

            left:0,

            behavior:"smooth"

        });

    }

    else{

        testimonialSlider.scrollBy({

            left:testimonialScroll,

            behavior:"smooth"

        });

    }

},4000);


/*=========================================
        PAUSE ON HOVER
==========================================*/

testimonialSlider.addEventListener("mouseenter",()=>{

    clearInterval(testimonialAuto);

});


testimonialSlider.addEventListener("mouseleave",()=>{

    testimonialAuto = setInterval(()=>{

        if(

            testimonialSlider.scrollLeft +
            testimonialSlider.clientWidth >=
            testimonialSlider.scrollWidth - 5

        ){

            testimonialSlider.scrollTo({

                left:0,

                behavior:"smooth"

            });

        }

        else{

            testimonialSlider.scrollBy({

                left:testimonialScroll,

                behavior:"smooth"

            });

        }

    },4000);

});

/*=========================================
        FEATURED VENDORS
==========================================*/

const vendorItems = document.querySelectorAll(".vendor-item");

const spotlightImage = document.getElementById("spotlightImage");
const spotlightLogo = document.getElementById("spotlightLogo");
const spotlightTitle = document.getElementById("spotlightTitle");

const productsCount = document.getElementById("productsCount");
const followersCount = document.getElementById("followersCount");
const cityName = document.getElementById("cityName");

let currentVendor = 0;


/*=========================================
        CHANGE VENDOR
==========================================*/

function changeVendor(index){

    vendorItems.forEach(item=>{

        item.classList.remove("active");

    });

    const vendor = vendorItems[index];

    vendor.classList.add("active");

    spotlightImage.classList.add("fade-out");
    spotlightLogo.classList.add("fade-out");
    spotlightTitle.classList.add("fade-out");

    setTimeout(()=>{

        spotlightImage.src = vendor.dataset.image;

        spotlightLogo.src = vendor.dataset.logo;

        spotlightTitle.textContent = vendor.dataset.title;

        productsCount.textContent = vendor.dataset.products;

        followersCount.textContent = vendor.dataset.followers;

        cityName.textContent = vendor.dataset.city;

        spotlightImage.classList.remove("fade-out");
        spotlightLogo.classList.remove("fade-out");
        spotlightTitle.classList.remove("fade-out");

    },250);

}


/*=========================================
        CLICK EVENT
==========================================*/

vendorItems.forEach((item,index)=>{

    item.addEventListener("click",()=>{

        currentVendor=index;

        changeVendor(currentVendor);

    });

});


/*=========================================
        AUTO ROTATE
==========================================*/

let vendorInterval = setInterval(nextVendor,5000);

function nextVendor(){

    currentVendor++;

    if(currentVendor >= vendorItems.length){

        currentVendor=0;

    }

    changeVendor(currentVendor);

}


/*=========================================
        PAUSE ON HOVER
==========================================*/

const vendorList=document.querySelector(".vendor-list");

vendorList.addEventListener("mouseenter",()=>{

    clearInterval(vendorInterval);

});

vendorList.addEventListener("mouseleave",()=>{

    vendorInterval=setInterval(nextVendor,5000);

});

/*=========================================
        TRENDING RIGHT NOW
==========================================*/

const trendingCards = document.querySelectorAll(".trend-card");

if ("IntersectionObserver" in window) {

const trendingObserver = new IntersectionObserver((entries)=>{

    entries.forEach(entry=>{

        if(entry.isIntersecting){

            const index = [...trendingCards].indexOf(entry.target);

            setTimeout(()=>{

                entry.target.classList.add("show-trend");

            }, index * 120);

            trendingObserver.unobserve(entry.target);

        }

    });

},{
    threshold:0.15
});

trendingCards.forEach(card=>{

    trendingObserver.observe(card);

});

} else {

trendingCards.forEach(card=>{

    card.classList.add("show-trend");

});

}


/*=========================================
        WISHLIST BUTTON
==========================================*/

const wishlistButtons = document.querySelectorAll(".wishlist-btn");

wishlistButtons.forEach(button=>{

    button.addEventListener("click",(e)=>{

        e.preventDefault();

        button.classList.toggle("liked");

        const icon = button.querySelector("i");

        if(button.classList.contains("liked")){

            icon.classList.remove("fa-regular");

            icon.classList.add("fa-solid");

        }

        else{

            icon.classList.remove("fa-solid");

            icon.classList.add("fa-regular");

        }

    });

});


/*=========================================
        CARD PARALLAX
==========================================*/

trendingCards.forEach(card=>{

    const image = card.querySelector("img");

    card.addEventListener("mousemove",(e)=>{

        const rect = card.getBoundingClientRect();

        const x = (e.clientX - rect.left) / rect.width - 0.5;

        const y = (e.clientY - rect.top) / rect.height - 0.5;

        image.style.transform = `scale(1.08) translate(${x*10}px, ${y*10}px)`;

    });

    card.addEventListener("mouseleave",()=>{

        image.style.transform = "";

    });

});

/*==================================================
        SELLER SECTION
===================================================*/

const sellerSection = document.querySelector(".seller-section");

const sellerObserver = new IntersectionObserver((entries)=>{

    entries.forEach(entry=>{

        if(entry.isIntersecting){

            sellerSection.classList.add("seller-show");

            animateCounters();

            animateBenefits();

            sellerObserver.unobserve(sellerSection);

        }

    });

},{
    threshold:0.2
});

sellerObserver.observe(sellerSection);


/*==================================================
        COUNTER ANIMATION
===================================================*/

function animateCounters(){

    const counters = document.querySelectorAll(".stat-box h3");

    counters.forEach(counter=>{

        const original = counter.innerText;

        const target = parseInt(original.replace(/[^0-9]/g,""));

        let current = 0;

        const speed = target / 70;

        const updateCounter = ()=>{

            current += speed;

            if(current < target){

                if(original.includes("%")){

                    counter.innerText = Math.floor(current) + "%";

                }

                else if(original.includes("K")){

                    counter.innerText = (current/1000).toFixed(1) + "K+";

                }

                else{

                    counter.innerText = Math.floor(current) + "+";

                }

                requestAnimationFrame(updateCounter);

            }

            else{

                counter.innerText = original;

            }

        };

        updateCounter();

    });

}


/*==================================================
        BENEFITS STAGGER
===================================================*/

function animateBenefits(){

    const benefits = document.querySelectorAll(".benefit");

    benefits.forEach((benefit,index)=>{

        setTimeout(()=>{

            benefit.classList.add("benefit-show");

        },index*150);

    });

}


/*==================================================
        DASHBOARD TILT
===================================================*/

const dashboard = document.querySelector(".dashboard-card");

dashboard.addEventListener("mousemove",(e)=>{

    const rect = dashboard.getBoundingClientRect();

    const x = e.clientX - rect.left;

    const y = e.clientY - rect.top;

    const rotateX = -(y - rect.height/2)/22;

    const rotateY = (x - rect.width/2)/22;

    dashboard.style.transform = `
    perspective(1200px)
    rotateX(${rotateX}deg)
    rotateY(${rotateY}deg)
    scale(1.03)
    `;

});

dashboard.addEventListener("mouseleave",()=>{

    dashboard.style.transform = "";

});


/*==================================================
        BUTTON PULSE
===================================================*/

const sellerButton = document.querySelector(".seller-btn");

setInterval(()=>{

    sellerButton.classList.add("pulse");

    setTimeout(()=>{

        sellerButton.classList.remove("pulse");

    },900);

},4000);

/*==================================================
        TAKE ULTIMATE EVERYWHERE
==================================================*/

const appSection = document.querySelector(".mobile-app-section");

const appObserver = new IntersectionObserver((entries)=>{

    entries.forEach(entry=>{

        if(entry.isIntersecting){

            appSection.classList.add("app-show");

            appObserver.unobserve(appSection);

        }

    });

},{
    threshold:0.2
});

appObserver.observe(appSection);


/*==================================================
        PHONE 3D TILT EFFECT
==================================================*/

const phones = document.querySelectorAll(".phone");

phones.forEach(phone=>{

    phone.addEventListener("mousemove",(e)=>{

        const rect = phone.getBoundingClientRect();

        const x = e.clientX - rect.left;

        const y = e.clientY - rect.top;

        const rotateY = (x - rect.width/2)/20;

        const rotateX = -(y - rect.height/2)/20;

        phone.style.transform = `
        perspective(1000px)
        rotateX(${rotateX}deg)
        rotateY(${rotateY}deg)
        scale(1.04)
        `;

    });

    phone.addEventListener("mouseleave",()=>{

        phone.style.transform = "";

    });

});


/*==================================================
        DOWNLOAD BUTTON PULSE
==================================================*/

const storeButtons = document.querySelectorAll(".store-btn");

setInterval(()=>{

    storeButtons.forEach((button,index)=>{

        setTimeout(()=>{

            button.classList.add("download-pulse");

            setTimeout(()=>{

                button.classList.remove("download-pulse");

            },900);

        },index*300);

    });

},5000);

/*==================================================
            PREMIUM FOOTER ANIMATIONS
==================================================*/

const footer = document.querySelector(".ultimate-footer");
const footerCards = document.querySelectorAll(".footer-card");
const newsletter = document.querySelector(".newsletter-box");
const footerBrand = document.querySelector(".footer-brand");
const footerLogo = document.querySelector(".footer-logo");
const footerEnding = document.querySelector(".footer-ending");

/*=========================================
        SCROLL REVEAL
=========================================*/

const footerObserver = new IntersectionObserver((entries)=>{

    entries.forEach(entry=>{

        if(entry.isIntersecting){

            footer.classList.add("footer-show");

            footerCards.forEach((card,index)=>{

                setTimeout(()=>{

                    card.classList.add("card-show");

                },index * 180);

            });

            setTimeout(()=>{

                newsletter.classList.add("newsletter-show");

            },900);

            setTimeout(()=>{

                footerEnding.classList.add("ending-show");

            },1200);

            footerObserver.unobserve(footer);

        }

    });

},{
    threshold:.2
});

footerObserver.observe(footer);

/*=========================================
        MOUSE GLOW
=========================================*/

const glow = document.createElement("div");

glow.className = "footer-mouse-glow";

footer.appendChild(glow);

footer.addEventListener("mousemove",(e)=>{

    const rect = footer.getBoundingClientRect();

    glow.style.left = `${e.clientX - rect.left}px`;

    glow.style.top = `${e.clientY - rect.top}px`;

});

/*=========================================
        LOGO GLOW
=========================================*/

setInterval(()=>{

    footerLogo.classList.add("logo-pulse");

    setTimeout(()=>{

        footerLogo.classList.remove("logo-pulse");

    },1200);

},5000);

/*=========================================
        NEWSLETTER FLOAT
=========================================*/

let newsletterDirection = 1;

setInterval(()=>{

    newsletter.style.transform =
    `translateY(${newsletterDirection * 6}px)`;

    newsletterDirection *= -1;

},3000);

/*=========================================
        BACK TO TOP
=========================================*/

const backToTop = document.querySelector(".footer-ending a");

backToTop.addEventListener("click",(e)=>{

    e.preventDefault();

    window.scrollTo({

        top:0,

        behavior:"smooth"

    });

});