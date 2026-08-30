const menuToggle = document.getElementById("menuToggle");

const mobileMenu = document.getElementById("mobileMenu");

const mobileClose = document.getElementById("mobileClose");


menuToggle.addEventListener("click", () => {

    mobileMenu.classList.add("active");

});


mobileClose.addEventListener("click", () => {

    mobileMenu.classList.remove("active");

});


window.addEventListener("click", (event) => {

    if(
        event.target === mobileMenu
    ){

        mobileMenu.classList.remove("active");

    }

});

/* =========================================
   BATCH 2
   CUISINE RING
========================================= */

const cuisineItems = document.querySelectorAll(".cuisine-item");

const cuisineTitle = document.getElementById("cuisineTitle");
const cuisineDesc = document.getElementById("cuisineDesc");

const nextCuisine = document.getElementById("nextCuisine");
const prevCuisine = document.getElementById("prevCuisine");

const cuisines = [
  {
    title: "Nigerian Cuisine",
    desc: "Rich local flavours, smoky grills, delicious soups, rice dishes and premium Nigerian dining experiences."
  },
  {
    title: "Pizza & Italian",
    desc: "Stone-baked pizzas, creamy pasta and handcrafted Italian favourites."
  },
  {
    title: "Chinese Cuisine",
    desc: "Noodles, stir fry, dumplings and authentic Asian restaurant experiences."
  },
  {
    title: "Sweet Desserts",
    desc: "Luxury cakes, pastries, ice cream and irresistible dessert creations."
  },
  {
    title: "Drinks & Beverages",
    desc: "Fresh juices, cocktails, coffee, smoothies and premium beverage vendors."
  },
  {
    title: "Buffet & Catering",
    desc: "Elegant buffet services, event catering and unforgettable celebrations."
  }
];

let currentCuisine = 0;

function renderCuisine(){

    cuisineItems.forEach((item,index)=>{

        const offset = (index-currentCuisine+cuisineItems.length)%cuisineItems.length;

        let x=0;
        let scale=.75;
        let z=0;
        let opacity=.35;

        if(offset===0){
            x=0; scale=1; z=120; opacity=1;
            item.classList.add("active");
        }else if(offset===1){
            x=170; scale=.82; z=40; opacity=.6;
            item.classList.remove("active");
        }else if(offset===2){
            x=290; scale=.65; z=-40; opacity=.35;
            item.classList.remove("active");
        }else if(offset===5){
            x=-170; scale=.82; z=40; opacity=.6;
            item.classList.remove("active");
        }else if(offset===4){
            x=-290; scale=.65; z=-40; opacity=.35;
            item.classList.remove("active");
        }else{
            x=0; scale=.45; z=-120; opacity=0;
            item.classList.remove("active");
        }

        item.style.transform =
        `translate(-50%,-50%) translateX(${x}px) scale(${scale})`;

        item.style.zIndex = Math.round(z+200);
        item.style.opacity = opacity;
    });

    cuisineTitle.textContent = cuisines[currentCuisine].title;
    cuisineDesc.textContent = cuisines[currentCuisine].desc;
}

nextCuisine.addEventListener("click",()=>{

    currentCuisine = (currentCuisine+1)%cuisines.length;
    renderCuisine();

});

prevCuisine.addEventListener("click",()=>{

    currentCuisine =
    (currentCuisine-1+cuisines.length)%cuisines.length;

    renderCuisine();

});

setInterval(()=>{

    currentCuisine = (currentCuisine+1)%cuisines.length;
    renderCuisine();

},4500);

renderCuisine();

/* =========================================
   BATCH 3
   RESTAURANT SPOTLIGHT
========================================= */

const restaurantCards =
document.querySelectorAll(".restaurant-card");

const restaurantPrev =
document.getElementById("restaurantPrev");

const restaurantNext =
document.getElementById("restaurantNext");

const panelName =
document.getElementById("panelName");

const panelDesc =
document.getElementById("panelDesc");

const panelCuisine =
document.getElementById("panelCuisine");

const panelDelivery =
document.getElementById("panelDelivery");

const panelRating =
document.getElementById("panelRating");


const restaurants = [

{
name:"Velvet Grill",
desc:"An award-winning luxury restaurant serving elevated Nigerian cuisine with handcrafted cocktails and an unforgettable atmosphere.",
cuisine:"Nigerian",
delivery:"18 mins",
rating:"4.9"
},

{
name:"Maison Rouge",
desc:"A contemporary continental restaurant offering premium steaks, seafood and elegant fine dining.",
cuisine:"Continental",
delivery:"24 mins",
rating:"4.8"
},

{
name:"Dragon Wok",
desc:"Authentic Chinese flavours prepared by master chefs with signature noodles and stir fry dishes.",
cuisine:"Chinese",
delivery:"20 mins",
rating:"4.9"
},

{
name:"Amore Pizza",
desc:"Handcrafted wood-fired pizzas baked with imported Italian ingredients and artisan cheeses.",
cuisine:"Italian",
delivery:"30 mins",
rating:"5.0"
}

];


let currentRestaurant = 0;


function renderRestaurants(){

restaurantCards.forEach((card,index)=>{

const offset =
(index-currentRestaurant+restaurantCards.length)
% restaurantCards.length;

let x=0;
let scale=.7;
let rotate=0;
let opacity=.25;
let z=0;

if(offset===0){
x=0;
scale=1;
rotate=0;
opacity=1;
z=5;
}
else if(offset===1){
x=280;
scale=.82;
rotate=-8;
opacity=.55;
z=3;
}
else if(offset===restaurantCards.length-1){
x=-280;
scale=.82;
rotate=8;
opacity=.55;
z=3;
}
else{
x=0;
scale=.5;
opacity=0;
z=1;
}

card.style.transform=
`translate(-50%,-50%) translateX(${x}px) rotate(${rotate}deg) scale(${scale})`;

card.style.opacity=opacity;
card.style.zIndex=z;

});

panelName.textContent=
restaurants[currentRestaurant].name;

panelDesc.textContent=
restaurants[currentRestaurant].desc;

panelCuisine.textContent=
restaurants[currentRestaurant].cuisine;

panelDelivery.textContent=
restaurants[currentRestaurant].delivery;

panelRating.textContent=
restaurants[currentRestaurant].rating;

}


restaurantNext.addEventListener("click",()=>{

currentRestaurant =
(currentRestaurant+1)%restaurants.length;

renderRestaurants();

});


restaurantPrev.addEventListener("click",()=>{

currentRestaurant =
(currentRestaurant-1+restaurants.length)
% restaurants.length;

renderRestaurants();

});


setInterval(()=>{

currentRestaurant =
(currentRestaurant+1)%restaurants.length;

renderRestaurants();

},5000);


renderRestaurants();

/* =========================================
   BATCH 4
   EDITORIAL CHEF GALLERY
========================================= */

const chefs = [

{
name:"Chef Amara",
role:"Luxury Private Chef",
rating:"4.9",
events:"240+",
price:"₦85k",
cuisine:"Fine Nigerian Dining",
description:"Award-winning chef specializing in luxury Nigerian cuisine, private dinners and celebrity events.",
main:"images/chef-amara.jpg",
left:"images/chef-kemi.jpg",
right:"images/chef-daniel.jpg"
},

{
name:"Chef Kemi",
role:"Home Gourmet Cook",
rating:"4.8",
events:"180+",
price:"₦55k",
cuisine:"Family & Comfort Meals",
description:"Expert in premium home dining, weekly meal preparation and intimate family gatherings.",
main:"images/chef-kemi.jpg",
left:"images/chef-daniel.jpg",
right:"images/chef-zara.jpg"
},

{
name:"Chef Daniel",
role:"Executive Buffet Chef",
rating:"5.0",
events:"320+",
price:"₦120k",
cuisine:"Buffet & Event Catering",
description:"Luxury buffet specialist serving weddings, corporate events and large celebrations.",
main:"images/chef-daniel.jpg",
left:"images/chef-zara.jpg",
right:"images/chef-amara.jpg"
},

{
name:"Chef Zara",
role:"Pastry & Dessert Artist",
rating:"4.9",
events:"210+",
price:"₦68k",
cuisine:"Desserts & Pastries",
description:"Creative pastry chef producing elegant cakes, desserts and unforgettable sweet experiences.",
main:"images/chef-zara.jpg",
left:"images/chef-amara.jpg",
right:"images/chef-kemi.jpg"
}

];

const mainChefImage=document.getElementById("mainChefImage");
const leftChefImage=document.getElementById("leftChefImage");
const rightChefImage=document.getElementById("rightChefImage");

const chefName=document.getElementById("chefName");
const chefRole=document.getElementById("chefRole");
const chefRating=document.getElementById("chefRating");
const chefEvents=document.getElementById("chefEvents");
const chefPrice=document.getElementById("chefPrice");
const chefCuisine=document.getElementById("chefCuisine");
const chefDescription=document.getElementById("chefDescription");

const chefButtons=document.querySelectorAll(".chef-btn");

let currentChef=0;
let chefTimer;

function updateChef(){

const chef=chefs[currentChef];

mainChefImage.style.opacity=0;

setTimeout(()=>{

mainChefImage.src=chef.main;
leftChefImage.src=chef.left;
rightChefImage.src=chef.right;

chefName.textContent=chef.name;
chefRole.textContent=chef.role;
chefRating.textContent=chef.rating;
chefEvents.textContent=chef.events;
chefPrice.textContent=chef.price;
chefCuisine.textContent=chef.cuisine;
chefDescription.textContent=chef.description;

mainChefImage.style.opacity=1;

},200);

chefButtons.forEach(btn=>btn.classList.remove("active"));
chefButtons[currentChef].classList.add("active");

}

function nextChef(){

currentChef=(currentChef+1)%chefs.length;

updateChef();

resetChefTimer();

}

chefButtons.forEach((btn,index)=>{

btn.addEventListener("click",()=>{

currentChef=index;

updateChef();

resetChefTimer();

});

});

function startChefTimer(){

chefTimer=setInterval(()=>{

currentChef=(currentChef+1)%chefs.length;

updateChef();

},5000);

}

function resetChefTimer(){

clearInterval(chefTimer);

startChefTimer();

}

updateChef();
startChefTimer();

/* =========================================
   BATCH 5
   INTERACTIVE BUFFET TABLESCAPE
========================================= */

const buffetServices = [

{
    image:"images/buffet-wedding.jpg",
    label:"💍 Wedding Catering",
    tag:"EVENT SERVICE",
    title:"Luxury Wedding Buffet",
    description:"Elegant buffet experiences with gourmet meals, live chefs, dessert stations and premium guest service for weddings.",
    guests:"300+",
    price:"₦450k",
    prep:"48 hrs"
},

{
    image:"images/buffet-birthday.jpg",
    label:"🎉 Birthday Buffet",
    tag:"PRIVATE EVENTS",
    title:"Birthday Celebration Catering",
    description:"Creative birthday menus, grill stations, desserts and colorful buffet experiences for memorable celebrations.",
    guests:"150+",
    price:"₦180k",
    prep:"24 hrs"
},

{
    image:"images/buffet-corporate.jpg",
    label:"🏢 Corporate Banquet",
    tag:"BUSINESS EVENTS",
    title:"Executive Corporate Catering",
    description:"Professional buffet setups for conferences, office launches, seminars and executive meetings.",
    guests:"500+",
    price:"₦650k",
    prep:"72 hrs"
},

{
    image:"images/buffet-outdoor.jpg",
    label:"🌴 Outdoor Party",
    tag:"OUTDOOR EXPERIENCE",
    title:"Luxury Outdoor Catering",
    description:"Garden parties, beach celebrations and outdoor luxury dining with complete buffet service.",
    guests:"220+",
    price:"₦320k",
    prep:"36 hrs"
}

];

const buffetImage = document.getElementById("buffetImage");

const hotspots = document.querySelectorAll(".hotspot");

const serviceLabel = document.getElementById("serviceLabel");
const serviceTag = document.getElementById("serviceTag");
const serviceTitle = document.getElementById("serviceTitle");
const serviceDescription = document.getElementById("serviceDescription");

const guestCount = document.getElementById("guestCount");
const startingPrice = document.getElementById("startingPrice");
const prepTime = document.getElementById("prepTime");

let currentService = 0;
let buffetTimer;


function updateBuffet(){

    const service = buffetServices[currentService];

    buffetImage.style.opacity = 0;

    setTimeout(()=>{

        buffetImage.src = service.image;

        buffetImage.style.opacity = 1;

    },180);

    serviceLabel.textContent = service.label;
    serviceTag.textContent = service.tag;
    serviceTitle.textContent = service.title;
    serviceDescription.textContent = service.description;

    guestCount.textContent = service.guests;
    startingPrice.textContent = service.price;
    prepTime.textContent = service.prep;

    hotspots.forEach(spot=>spot.classList.remove("active"));
    hotspots[currentService].classList.add("active");

}


function nextBuffet(){

    currentService = (currentService + 1) % buffetServices.length;

    updateBuffet();

}


function startBuffetTimer(){

    buffetTimer = setInterval(nextBuffet,5000);

}


function resetBuffetTimer(){

    clearInterval(buffetTimer);

    startBuffetTimer();

}


hotspots.forEach((spot,index)=>{

    spot.addEventListener("click",()=>{

        currentService = index;

        updateBuffet();

        resetBuffetTimer();

    });

});


updateBuffet();
startBuffetTimer();

/* =========================================
   BATCH 6
   IMPROVED FOOD DELIVERY NETWORK
========================================= */

const deliveryModes = [

{
title:"Express Bike Delivery",
description:"Perfect for meals within the city. Average arrival time is under 25 minutes with insulated food carriers.",
time:"22 mins",
cost:"₦1,500",
speed:"Fastest",
emoji:"🛵",
destinationIcon:"🏠",
destinationLabel:"Customer",
x:"82%",
y:"82%"
},

{
title:"Comfort Car Delivery",
description:"Ideal for larger family orders with secure temperature-controlled transportation.",
time:"35 mins",
cost:"₦2,800",
speed:"Standard",
emoji:"🚗",
destinationIcon:"🏠",
destinationLabel:"Customer",
x:"82%",
y:"82%"
},

{
title:"Luxury Van Delivery",
description:"Designed for buffet trays, corporate lunches and premium bulk food deliveries.",
time:"55 mins",
cost:"₦8,500",
speed:"Large Orders",
emoji:"🚐",
destinationIcon:"🏠",
destinationLabel:"Customer",
x:"82%",
y:"82%"
},

{
title:"Catering Logistics",
description:"Professional event logistics including equipment, buffet setup and serving coordination.",
time:"2 hrs",
cost:"Custom",
speed:"Event Priority",
emoji:"🚚",
destinationIcon:"🏛",
destinationLabel:"Event Venue",
x:"82%",
y:"82%"
}

];

const rider = document.getElementById("deliveryRider");

const deliveryTitle = document.getElementById("deliveryTitle");
const deliveryDescription = document.getElementById("deliveryDescription");

const deliveryTime = document.getElementById("deliveryTime");
const deliveryCost = document.getElementById("deliveryCost");
const deliverySpeed = document.getElementById("deliverySpeed");

const destinationIcon = document.getElementById("destinationIcon");
const destinationLabel = document.getElementById("destinationLabel");

const deliveryButtons = document.querySelectorAll(".delivery-btn");

let currentDelivery = 0;
let deliveryTimer;

function animateRoute(mode){

    /* Start at Delivery Hub */

    rider.style.left = "46%";
    rider.style.top = "48%";
    rider.style.transform = "translate(-50%,-50%) scale(.9)";

    /* Travel along the road */

    setTimeout(()=>{

        rider.style.left = "63%";
        rider.style.top = "60%";
        rider.style.transform = "translate(-50%,-50%) scale(1.05)";

    },350);

    /* Reach destination */

    setTimeout(()=>{

        rider.style.left = mode.x;
        rider.style.top = mode.y;
        rider.style.transform = "translate(-50%,-50%) scale(1)";

    },1050);

}

function updateDelivery(){

    const mode = deliveryModes[currentDelivery];

    rider.textContent = mode.emoji;

    deliveryTitle.textContent = mode.title;
    deliveryDescription.textContent = mode.description;

    deliveryTime.textContent = mode.time;
    deliveryCost.textContent = mode.cost;
    deliverySpeed.textContent = mode.speed;

    destinationIcon.textContent = mode.destinationIcon;
    destinationLabel.textContent = mode.destinationLabel;

    deliveryButtons.forEach(btn =>
        btn.classList.remove("active")
    );

    deliveryButtons[currentDelivery]
        .classList.add("active");

    animateRoute(mode);

}

function nextDelivery(){

    currentDelivery =
    (currentDelivery + 1) % deliveryModes.length;

    updateDelivery();

    resetDeliveryTimer();

}

deliveryButtons.forEach((btn,index)=>{

    btn.addEventListener("click",()=>{

        currentDelivery = index;

        updateDelivery();

        resetDeliveryTimer();

    });

});

function startDeliveryTimer(){

    deliveryTimer = setInterval(()=>{

        currentDelivery =
        (currentDelivery + 1) % deliveryModes.length;

        updateDelivery();

    },5000);

}

function resetDeliveryTimer(){

    clearInterval(deliveryTimer);

    startDeliveryTimer();

}

updateDelivery();
startDeliveryTimer();

/* =========================================
   BATCH 7
   TRUST ORBIT
========================================= */

const orbitItems = document.querySelectorAll(".orbit-item");

const orbitTag = document.getElementById("orbitTag");
const orbitTitle = document.getElementById("orbitTitle");
const orbitDesc = document.getElementById("orbitDesc");

const orbitData = [

{
tag:"VERIFIED VENDORS",
title:"Every vendor is carefully verified.",
desc:"Restaurants, chefs and catering professionals undergo identity and quality verification before appearing on Ultimate."
},

{
tag:"REAL CUSTOMER REVIEWS",
title:"Reviews come from completed orders only.",
desc:"Ratings are tied to genuine bookings, giving customers authentic dining feedback."
},

{
tag:"SECURE PAYMENTS",
title:"Your bookings are protected.",
desc:"Ultimate safeguards transactions for restaurants, private chefs and catering services."
},

{
tag:"FAST RESPONSE",
title:"Instant confirmations & rapid support.",
desc:"Customers receive quick booking responses, delivery updates and event coordination."
}

];

let currentOrbit = 0;
let orbitTimer;

function renderOrbit(){

    const radius = 175;

    orbitItems.forEach((item,index)=>{

        const angle =
        ((index-currentOrbit)*90-90)*Math.PI/180;

        const x = Math.cos(angle)*radius;
        const y = Math.sin(angle)*radius;

        item.style.left =
        `calc(50% + ${x}px - 32px)`;

        item.style.top =
        `calc(50% + ${y}px - 32px)`;

        item.classList.remove("active");

    });

    orbitItems[0].classList.add("active");

    const data = orbitData[currentOrbit];

    orbitTag.textContent = data.tag;
    orbitTitle.textContent = data.title;
    orbitDesc.textContent = data.desc;

}

function nextOrbit(){

    currentOrbit =
    (currentOrbit+1)%orbitData.length;

    orbitData.push(orbitData.shift());

    renderOrbit();

}

orbitItems.forEach((item,index)=>{

    item.addEventListener("click",()=>{

        while(index!==0){

            orbitData.push(orbitData.shift());

            currentOrbit =
            (currentOrbit+1)%4;

        }

        renderOrbit();

        clearInterval(orbitTimer);

        startOrbit();

    });

});

function startOrbit(){

    orbitTimer =
    setInterval(nextOrbit,4500);

}

renderOrbit();
startOrbit();