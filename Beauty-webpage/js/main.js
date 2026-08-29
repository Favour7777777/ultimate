/* =========================================
   BEAUTY MOBILE MENU
========================================= */

const menuToggle = document.getElementById("menuToggle");
const mobileMenu = document.getElementById("mobileMenu");
const mobileClose = document.getElementById("mobileClose");


// Open menu
menuToggle.addEventListener("click", () => {
    mobileMenu.classList.add("active");
});


// Close menu
mobileClose.addEventListener("click", () => {
    mobileMenu.classList.remove("active");
});


// Close menu when a link is clicked
const mobileLinks = mobileMenu.querySelectorAll("a");

mobileLinks.forEach(link => {

    link.addEventListener("click", () => {
        mobileMenu.classList.remove("active");
    });

});

/* =========================================
   FEATURED BEAUTY SERVICES SLIDER
========================================= */

const beautyServices = [

    {
        image: "images/service-facials.jpg",
        category: "SKINCARE",
        title: "Luxury <em>HydraFacial</em>",
        description: "A deep cleansing and hydration experience designed to leave your skin visibly refreshed.",
        price: "₦25,000"
    },

    {
        image: "images/service-makeups.jpg",
        category: "MAKEUP",
        title: "Signature <em>Glam</em>",
        description: "A polished beauty experience created for special occasions, celebrations and unforgettable moments.",
        price: "₦18,000"
    },

    {
        image: "images/service-hair.jpg",
        category: "HAIR",
        title: "Signature <em>Styling</em>",
        description: "Professional hair styling designed to give you a refined, confident and effortless look.",
        price: "₦15,000"
    },

    {
        image: "images/service-spa.jpg",
        category: "WELLNESS",
        title: "Deep Tissue <em>Massage</em>",
        description: "Release tension and reconnect with yourself through a deeply relaxing wellness experience.",
        price: "₦30,000"
    },

    {
        image: "images/service-nails.jpg",
        category: "NAILS",
        title: "Luxury <em>Nail Art</em>",
        description: "Detailed nail artistry combined with premium care for a polished finish that stands out.",
        price: "₦12,000"
    },

    {
        image: "images/service-bridal.jpg",
        category: "BRIDAL",
        title: "Bridal <em>Beauty</em>",
        description: "An elegant beauty experience curated to make your most important day even more unforgettable.",
        price: "₦50,000"
    }

];


let currentServiceIndex = 0;


const serviceImage =
    document.getElementById("serviceImage");

const serviceCategory =
    document.getElementById("serviceCategory");

const serviceTitle =
    document.getElementById("serviceTitle");

const serviceDescription =
    document.getElementById("serviceDescription");

const servicePrice =
    document.getElementById("servicePrice");

const currentService =
    document.getElementById("currentService");

const serviceProgress =
    document.getElementById("serviceProgress");

const serviceNext =
    document.getElementById("serviceNext");

const servicePrev =
    document.getElementById("servicePrev");


function showBeautyService(index){

    const service =
        beautyServices[index];


    serviceImage.style.opacity = "0";


    setTimeout(() => {

        serviceImage.src =
            service.image;

        serviceImage.alt =
            service.category;


        serviceCategory.textContent =
            service.category;

        serviceTitle.innerHTML =
            service.title;

        serviceDescription.textContent =
            service.description;

        servicePrice.textContent =
            service.price;


        currentService.textContent =
            String(index + 1).padStart(2, "0");


        const progress =
            ((index + 1) / beautyServices.length) * 100;

        serviceProgress.style.width =
            `${progress}%`;


        serviceImage.style.opacity =
            "1";

    }, 250);

}


/* Next */

serviceNext.addEventListener("click", () => {

    currentServiceIndex++;

    if(
        currentServiceIndex >=
        beautyServices.length
    ){
        currentServiceIndex = 0;
    }

    showBeautyService(
        currentServiceIndex
    );

});


/* Previous */

servicePrev.addEventListener("click", () => {

    currentServiceIndex--;

    if(
        currentServiceIndex < 0
    ){
        currentServiceIndex =
            beautyServices.length - 1;
    }

    showBeautyService(
        currentServiceIndex
    );

});


/* Automatic Slider */

setInterval(() => {

    currentServiceIndex++;

    if(
        currentServiceIndex >=
        beautyServices.length
    ){
        currentServiceIndex = 0;
    }

    showBeautyService(
        currentServiceIndex
    );

}, 5000);

/* =========================================
   BATCH 4
   TOP SALONS & SPAS
========================================= */

const salonSets = [

    {
        left: {
            image: "images/salon-aura.jpg",
            badge: "FEATURED",
            number: "01",
            category: "LUXURY SALON",
            name: "Aura Beauty",
            nameStyle: "Lounge",
            location: "Victoria Island, Lagos",
            rating: "4.9",
            title: "Your beauty,",
            titleStyle: "elevated.",
            services: [
                "Hair Styling",
                "Signature Facials",
                "Nail Art",
                "Bridal Beauty"
            ]
        },

        right: {
            image: "images/spa-serenity.jpg",
            badge: "WELLNESS",
            number: "02",
            category: "PREMIUM SPA",
            name: "Serenity",
            nameStyle: "Spa",
            location: "Ikoyi, Lagos",
            rating: "4.8",
            title: "Slow down.",
            titleStyle: "Feel renewed.",
            services: [
                "Deep Tissue Massage",
                "Body Treatments",
                "Luxury Facials",
                "Wellness Therapy"
            ]
        }
    },


    {
        left: {
            image: "images/salon-mane.jpg",
            badge: "TRENDING",
            number: "03",
            category: "HAIR STUDIO",
            name: "The Mane",
            nameStyle: "House",
            location: "Lekki, Lagos",
            rating: "4.8",
            title: "Hair that",
            titleStyle: "defines you.",
            services: [
                "Hair Styling",
                "Braids & Locs",
                "Hair Treatments",
                "Extensions"
            ]
        },

        right: {
            image: "images/spa-glow.jpg",
            badge: "TOP RATED",
            number: "04",
            category: "WELLNESS SPA",
            name: "Glow",
            nameStyle: "Wellness",
            location: "Ikoyi, Lagos",
            rating: "4.9",
            title: "Relax.",
            titleStyle: "Recharge.",
            services: [
                "Hot Stone Massage",
                "Luxury Facials",
                "Body Scrubs",
                "Aromatherapy"
            ]
        }
    },


    {
        left: {
            image: "images/salon-house-glow.jpg",
            badge: "EDITOR'S PICK",
            number: "05",
            category: "BEAUTY STUDIO",
            name: "House of",
            nameStyle: "Glow",
            location: "Yaba, Lagos",
            rating: "4.7",
            title: "Discover your",
            titleStyle: "glow.",
            services: [
                "Makeup",
                "Lash Extensions",
                "Brow Styling",
                "Beauty Treatments"
            ]
        },

        right: {
            image: "images/spa-velvet.jpg",
            badge: "EXCLUSIVE",
            number: "06",
            category: "LUXURY SPA",
            name: "Velvet",
            nameStyle: "Beauty",
            location: "Victoria Island, Lagos",
            rating: "4.9",
            title: "Indulge in",
            titleStyle: "luxury.",
            services: [
                "Luxury Massage",
                "Facials",
                "Body Therapy",
                "Wellness Rituals"
            ]
        }
    }

];


/* =========================================
   VARIABLES
========================================= */

let currentFlip = 0;

let isFlipped = false;

let autoFlipTimer;


const flipCards =
    document.querySelectorAll(".beauty-card-inner");

const flipPrevious =
    document.getElementById("flipPrevious");

const flipNext =
    document.getElementById("flipNext");

const flipCurrent =
    document.getElementById("flipCurrent");


/* =========================================
   UPDATE CARD CONTENT
========================================= */

function updateSalonCards(){

    const currentSet =
        salonSets[currentFlip];


    const cards = [
        currentSet.left,
        currentSet.right
    ];


    flipCards.forEach((card, index) => {

        const salon = cards[index];


        /* =========================
           FRONT
        ========================= */

        const frontImage =
            card.querySelector(
                ".beauty-card-front img"
            );

        frontImage.src = salon.image;

        frontImage.alt =
            salon.name + " " + salon.nameStyle;


        card.querySelector(
            ".card-badge"
        ).textContent = salon.badge;


        card.querySelector(
            ".card-number"
        ).textContent = salon.number;


        card.querySelector(
            ".card-category"
        ).textContent = salon.category;


        card.querySelector(
            ".card-front-content h3"
        ).innerHTML =
            salon.name +
            " <em>" +
            salon.nameStyle +
            "</em>";


        card.querySelector(
            ".card-location"
        ).innerHTML =
            "<span>⌖</span>" +
            salon.location;


        /* =========================
           BACK
        ========================= */

        card.querySelector(
            ".back-top span"
        ).textContent =
            salon.name +
            " " +
            salon.nameStyle;


        card.querySelector(
            ".back-top strong"
        ).textContent =
            "★ " +
            salon.rating;


        card.querySelector(
            ".back-content h3"
        ).innerHTML =
            salon.title +
            " <em>" +
            salon.titleStyle +
            "</em>";


        const serviceList =
            card.querySelectorAll(
                ".back-content li"
            );


        serviceList.forEach(
            (item, serviceIndex) => {

                item.innerHTML =
                    "<span>✦</span>" +
                    salon.services[serviceIndex];

            }
        );

    });


    flipCurrent.textContent =
        String(currentFlip + 1)
        .padStart(2, "0");

}


/* =========================================
   FLIP FORWARD
========================================= */

function flipForward(){

    flipCards.forEach(card => {

        card.style.transform =
            "rotateY(180deg)";

    });

    isFlipped = true;

}


/* =========================================
   FLIP BACK
========================================= */

function flipBack(){

    flipCards.forEach(card => {

        card.style.transform =
            "rotateY(0deg)";

    });

    isFlipped = false;

}


/* =========================================
   NEXT
========================================= */

function nextSalonSet(){

    currentFlip++;

    if(currentFlip >= salonSets.length){

        currentFlip = 0;

    }


    updateSalonCards();

    flipBack();

}


/* =========================================
   PREVIOUS
========================================= */

function previousSalonSet(){

    currentFlip--;

    if(currentFlip < 0){

        currentFlip =
            salonSets.length - 1;

    }


    updateSalonCards();

    flipBack();

}


/* =========================================
   NEXT BUTTON
========================================= */

flipNext.addEventListener(
    "click",
    () => {

        nextSalonSet();

        resetAutoFlip();

    }
);


/* =========================================
   PREVIOUS BUTTON
========================================= */

flipPrevious.addEventListener(
    "click",
    () => {

        previousSalonSet();

        resetAutoFlip();

    }
);


/* =========================================
   AUTOMATIC FLIP
========================================= */

function startAutoFlip(){

    autoFlipTimer =
        setInterval(() => {

            if(isFlipped){

                nextSalonSet();

            }else{

                flipForward();

            }

        }, 5000);

}


/* =========================================
   RESET AUTOMATIC TIMER
========================================= */

function resetAutoFlip(){

    clearInterval(autoFlipTimer);

    startAutoFlip();

}


/* =========================================
   INITIAL LOAD
========================================= */

updateSalonCards();

startAutoFlip();

/* =========================================
   BATCH 5
   MAKEUP ARTISTS & HAIR STYLISTS
========================================= */

const artists = [

    {
        image: "images/artist-amara.jpg",
        category: "MAKEUP ARTIST",
        name: "Amara",
        nameStyle: "Beauty",
        description:
            "Creating timeless bridal looks, editorial glam and effortless beauty transformations.",
        specialty: "Bridal & Editorial",
        location: "Victoria Island, Lagos",
        rating: "4.9"
    },

    {
        image: "images/artist-zara.jpg",
        category: "HAIR STYLIST",
        name: "Zara",
        nameStyle: "Crown",
        description:
            "Crafting signature hairstyles, luxury braids and modern looks designed around you.",
        specialty: "Hair & Styling",
        location: "Lekki, Lagos",
        rating: "4.8"
    },

    {
        image: "images/artist-nia.jpg",
        category: "MAKEUP ARTIST",
        name: "Nia",
        nameStyle: "Glam",
        description:
            "Known for soft glam, red carpet makeup and beautifully refined beauty finishes.",
        specialty: "Soft Glam",
        location: "Ikoyi, Lagos",
        rating: "4.9"
    },

    {
        image: "images/artist-lyra.jpg",
        category: "HAIR STYLIST",
        name: "Lyra",
        nameStyle: "Studio",
        description:
            "Transforming everyday hair into polished, expressive styles with a luxury finish.",
        specialty: "Cuts & Styling",
        location: "Yaba, Lagos",
        rating: "4.7"
    }

];


/* =========================================
   VARIABLES
========================================= */

let currentArtist = 0;

let artistTimer;


/* =========================================
   ELEMENTS
========================================= */

const artistImage =
    document.getElementById("artistImage");

const artistNumber =
    document.getElementById("artistNumber");

const artistCategory =
    document.getElementById("artistCategory");

const artistName =
    document.getElementById("artistName");

const artistNameStyle =
    document.getElementById("artistNameStyle");

const artistDescription =
    document.getElementById("artistDescription");

const artistSpecialty =
    document.getElementById("artistSpecialty");

const artistLocation =
    document.getElementById("artistLocation");

const artistRating =
    document.getElementById("artistRating");

const artistProgress =
    document.getElementById("artistProgress");

const artistProgressBar =
    document.getElementById("artistProgressBar");

const artistPrevious =
    document.getElementById("artistPrevious");

const artistNext =
    document.getElementById("artistNext");


/* =========================================
   UPDATE ARTIST
========================================= */

function updateArtist(){

    const artist =
        artists[currentArtist];


    /* Image */

    artistImage.style.opacity = "0";

    setTimeout(() => {

        artistImage.src =
            artist.image;

        artistImage.alt =
            artist.name +
            " " +
            artist.nameStyle;

        artistImage.style.opacity = "1";

    }, 250);


    /* Text */

    artistNumber.textContent =
        String(currentArtist + 1)
        .padStart(2, "0");


    artistCategory.textContent =
        artist.category;


    artistName.textContent =
        artist.name;


    artistNameStyle.textContent =
        artist.nameStyle;


    artistDescription.textContent =
        artist.description;


    artistSpecialty.textContent =
        artist.specialty;


    artistLocation.textContent =
        artist.location;


    artistRating.textContent =
        "★ " +
        artist.rating;


    /* Progress */

    artistProgress.textContent =
        String(currentArtist + 1)
        .padStart(2, "0");


    const progress =
        ((currentArtist + 1) / artists.length) * 100;


    artistProgressBar.style.width =
        progress + "%";

}


/* =========================================
   NEXT ARTIST
========================================= */

function nextArtist(){

    currentArtist++;

    if(currentArtist >= artists.length){

        currentArtist = 0;

    }

    updateArtist();

    resetArtistTimer();

}


/* =========================================
   PREVIOUS ARTIST
========================================= */

function previousArtist(){

    currentArtist--;

    if(currentArtist < 0){

        currentArtist =
            artists.length - 1;

    }

    updateArtist();

    resetArtistTimer();

}


/* =========================================
   BUTTON EVENTS
========================================= */

artistNext.addEventListener(
    "click",
    nextArtist
);


artistPrevious.addEventListener(
    "click",
    previousArtist
);


/* =========================================
   AUTOMATIC SLIDER
========================================= */

function startArtistTimer(){

    artistTimer =
        setInterval(() => {

            currentArtist++;

            if(currentArtist >= artists.length){

                currentArtist = 0;

            }

            updateArtist();

        }, 5000);

}


/* =========================================
   RESET TIMER
========================================= */

function resetArtistTimer(){

    clearInterval(artistTimer);

    startArtistTimer();

}


/* =========================================
   INITIAL LOAD
========================================= */

updateArtist();

startArtistTimer();

/* =========================================
   BATCH 6
   BEAUTY PRODUCTS — THE BEAUTY SHELF
========================================= */

const beautyProducts = [

    {
        category: "Skincare",
        name: "Lumière",
        type: "Radiance Serum",
        description:
            "A lightweight radiance serum designed to deeply hydrate the skin while leaving a luminous finish.",
        price: "₦38,000",
        rating: "4.9",
        image: "images/essentials.png"
    },

    {
        category: "Makeup",
        name: "Velvet",
        type: "Silk Foundation",
        description:
            "A breathable foundation with a smooth, natural finish created for effortless everyday beauty.",
        price: "₦29,500",
        rating: "4.8",
        image: "images/product-foundation.png"
    },

    {
        category: "Haircare",
        name: "Élan",
        type: "Nourishing Hair Oil",
        description:
            "A lightweight nourishing oil designed to restore softness, shine and healthy-looking hair.",
        price: "₦24,000",
        rating: "4.9",
        image: "images/product-hair-oil.png"
    },

    {
        category: "Fragrance",
        name: "Noir",
        type: "Signature Eau de Parfum",
        description:
            "A sophisticated fragrance blending warm florals, subtle woods and an unforgettable finish.",
        price: "₦52,000",
        rating: "4.9",
        image: "images/product-perfume.png"
    },

    {
        category: "Body",
        name: "Serein",
        type: "Silk Body Butter",
        description:
            "A rich body butter created to deeply nourish the skin and leave it soft, smooth and radiant.",
        price: "₦21,500",
        rating: "4.8",
        image: "images/product-body-butter.png"
    }

];


/* =========================================
   VARIABLES
========================================= */

let currentProduct = 0;

let productTimer;


/* =========================================
   ELEMENTS
========================================= */

const beautyProductImage =
    document.getElementById("beautyProductImage");

const productCategory =
    document.getElementById("productCategory");

const productNumber =
    document.getElementById("productNumber");

const beautyProductName =
    document.getElementById("beautyProductName");

const beautyProductType =
    document.getElementById("beautyProductType");

const beautyProductDescription =
    document.getElementById("beautyProductDescription");

const beautyProductRating =
    document.getElementById("beautyProductRating");

const beautyProductPrice =
    document.getElementById("beautyProductPrice");

const productCurrent =
    document.getElementById("productCurrent");

const productProgressBar =
    document.getElementById("productProgressBar");

const productPrevious =
    document.getElementById("productPrevious");

const productNext =
    document.getElementById("productNext");

const productCategoryButtons =
    document.querySelectorAll(".product-category");


/* =========================================
   UPDATE PRODUCT
========================================= */

function updateProduct(){

    const product =
        beautyProducts[currentProduct];


    /* Fade image */

    beautyProductImage.style.opacity = "0";

    beautyProductImage.style.transform =
        "scale(.92)";


    setTimeout(() => {

        beautyProductImage.src =
            product.image;

        beautyProductImage.alt =
            product.name +
            " " +
            product.type;

        beautyProductImage.style.opacity = "1";

        beautyProductImage.style.transform =
            "scale(1)";

    }, 250);


    /* Product information */

    productCategory.textContent =
        product.category.toUpperCase();


    productNumber.textContent =
        String(currentProduct + 1).padStart(2, "0")
        + " / "
        + String(beautyProducts.length).padStart(2, "0");


    beautyProductName.textContent =
        product.name;


    beautyProductType.textContent =
        product.type;


    beautyProductDescription.textContent =
        product.description;


    beautyProductRating.textContent =
        product.rating;


    beautyProductPrice.textContent =
        product.price;


    /* Progress */

    productCurrent.textContent =
        String(currentProduct + 1)
        .padStart(2, "0");


    const progress =
        ((currentProduct + 1) /
        beautyProducts.length) * 100;


    productProgressBar.style.width =
        progress + "%";


    /* Category buttons */

    productCategoryButtons.forEach(
        button => {

            button.classList.remove("active");

            if(
                button.dataset.category ===
                product.category
            ){

                button.classList.add("active");

            }

        }
    );

}


/* =========================================
   NEXT PRODUCT
========================================= */

function nextProduct(){

    currentProduct++;

    if(
        currentProduct >=
        beautyProducts.length
    ){

        currentProduct = 0;

    }

    updateProduct();

    resetProductTimer();

}


/* =========================================
   PREVIOUS PRODUCT
========================================= */

function previousProduct(){

    currentProduct--;

    if(currentProduct < 0){

        currentProduct =
            beautyProducts.length - 1;

    }

    updateProduct();

    resetProductTimer();

}


/* =========================================
   ARROW BUTTONS
========================================= */

productNext.addEventListener(
    "click",
    nextProduct
);


productPrevious.addEventListener(
    "click",
    previousProduct
);


/* =========================================
   CATEGORY BUTTONS
========================================= */

productCategoryButtons.forEach(
    button => {

        button.addEventListener(
            "click",
            () => {

                const selectedCategory =
                    button.dataset.category;


                const selectedIndex =
                    beautyProducts.findIndex(
                        product =>
                            product.category ===
                            selectedCategory
                    );


                if(selectedIndex !== -1){

                    currentProduct =
                        selectedIndex;

                    updateProduct();

                    resetProductTimer();

                }

            }
        );

    }
);


/* =========================================
   AUTOMATIC ROTATION
========================================= */

function startProductTimer(){

    productTimer =
        setInterval(() => {

            currentProduct++;

            if(
                currentProduct >=
                beautyProducts.length
            ){

                currentProduct = 0;

            }

            updateProduct();

        }, 5000);

}


/* =========================================
   RESET TIMER
========================================= */

function resetProductTimer(){

    clearInterval(productTimer);

    startProductTimer();

}


/* =========================================
   INITIAL LOAD
========================================= */

updateProduct();

startProductTimer();

/* =========================================
   BATCH 7
   BEFORE & AFTER TRANSFORMATION
========================================= */

const transformations = [

    {
        category: "BRIDAL MAKEUP",
        name: "Soft Glam",
        description:
            "A refined bridal transformation created with soft tones, radiant skin and timeless definition.",
        artist: "Amara Beauty",
        before: "images/before.jpg",
        after: "images/after.jpg"
    },

    {
        category: "HAIR TRANSFORMATION",
        name: "Silk Revival",
        description:
            "A complete hair transformation focused on volume, shine and effortless movement.",
        artist: "Élan Hair Studio",
        before: "images/before-hair.jpg",
        after: "images/after-hair.jpg"
    },

    {
        category: "BRIDAL LOOK",
        name: "Timeless Bride",
        description:
            "An elegant bridal look combining glowing skin, delicate definition and sophisticated styling.",
        artist: "Luxe Faces",
        before: "images/before-bride.jpg",
        after: "images/after-bride.jpg"
    },

    {
        category: "SKIN GLOW",
        name: "Luminous Skin",
        description:
            "A radiant skincare transformation designed to restore hydration and bring out natural luminosity.",
        artist: "Glow Lab",
        before: "images/before-face.jpg",
        after: "images/after-face.jpg"
    }

];


/* =========================================
   VARIABLES
========================================= */

let currentTransformation = 0;
let isDragging = false;


/* =========================================
   ELEMENTS
========================================= */

const transformationStage =
    document.querySelector(".transformation-stage");

const afterSide =
    document.getElementById("afterSide");

const comparisonDivider =
    document.getElementById("comparisonDivider");

const beforeImage =
    document.getElementById("beforeImage");

const afterImage =
    document.getElementById("afterImage");

const transformationCategory =
    document.getElementById("transformationCategory");

const transformationName =
    document.getElementById("transformationName");

const transformationDescription =
    document.getElementById("transformationDescription");

const transformationArtist =
    document.getElementById("transformationArtist");

const transformationOptions =
    document.querySelectorAll(".transformation-option");


/* =========================================
   UPDATE TRANSFORMATION
========================================= */

function updateTransformation(){

    const transformation =
        transformations[currentTransformation];

    beforeImage.src = transformation.before;
    afterImage.src = transformation.after;

    beforeImage.alt =
        transformation.name + " Before";

    afterImage.alt =
        transformation.name + " After";

    transformationCategory.textContent =
        transformation.category;

    transformationName.textContent =
        transformation.name;

    transformationDescription.textContent =
        transformation.description;

    transformationArtist.textContent =
        transformation.artist;

    transformationOptions.forEach(option =>
        option.classList.remove("active")
    );

    transformationOptions[currentTransformation]
        .classList.add("active");

    setComparisonPosition(50);

    playComparisonHint();

}


/* =========================================
   COMPARISON POSITION
========================================= */

function setComparisonPosition(position){

    position = Math.max(
        0,
        Math.min(100, position)
    );

    afterSide.style.clipPath =
        `inset(0 ${100 - position}% 0 0)`;

    comparisonDivider.style.left =
        position + "%";

}


/* =========================================
   MOVE COMPARISON
========================================= */

function moveComparison(clientX){

    const rect =
        transformationStage.getBoundingClientRect();

    const position =
        ((clientX - rect.left) / rect.width) * 100;

    setComparisonPosition(position);

}


/* =========================================
   ONE-TIME HINT ANIMATION
========================================= */

function playComparisonHint(){

    const positions = [50, 44, 56, 50];

    positions.forEach((position, index) => {

        setTimeout(() => {

            setComparisonPosition(position);

        }, 350 * (index + 1));

    });

}


/* =========================================
   POINTER EVENTS
========================================= */

comparisonDivider.addEventListener(
    "pointerdown",
    event => {

        isDragging = true;

        comparisonDivider.setPointerCapture(
            event.pointerId
        );

        moveComparison(event.clientX);

    }
);

comparisonDivider.addEventListener(
    "pointermove",
    event => {

        if(!isDragging) return;

        moveComparison(event.clientX);

    }
);

comparisonDivider.addEventListener(
    "pointerup",
    event => {

        isDragging = false;

        comparisonDivider.releasePointerCapture(
            event.pointerId
        );

    }
);


/* =========================================
   CLICK ANYWHERE ON SHOWCASE
========================================= */

transformationStage.addEventListener(
    "click",
    event => {

        if(
            event.target.closest(".comparison-divider")
        ) return;

        moveComparison(event.clientX);

    }
);


/* =========================================
   SELECT TRANSFORMATION
========================================= */

transformationOptions.forEach(option => {

    option.addEventListener(
        "click",
        () => {

            currentTransformation =
                Number(option.dataset.index);

            updateTransformation();

        }
    );

});


/* =========================================
   INITIAL LOAD
========================================= */

updateTransformation();