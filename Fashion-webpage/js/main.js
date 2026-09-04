const menuToggle = document.getElementById("menuToggle");

const mobileMenu = document.getElementById("mobileMenu");

const mobileClose = document.getElementById("mobileClose");


menuToggle.addEventListener("click",()=>{

    mobileMenu.classList.add("active");

});


mobileClose.addEventListener("click",()=>{

    mobileMenu.classList.remove("active");

});


window.addEventListener("click",(event)=>{

    if(event.target===mobileMenu){

        mobileMenu.classList.remove("active");

    }

});

/* =========================================
   BATCH 2
   3D FASHION HOUSES
========================================= */

const fashionHouses = [

{
tag:"HAUTE COUTURE",
title:"Midnight Atelier",
description:"Dramatic silhouettes, handcrafted evening wear and runway couture designed for unforgettable entrances.",
designers:"42",
pieces:"680",
rating:"4.9",
image:"images/house-haute.jpg"
},

{
tag:"MENSWEAR",
title:"Noir Homme",
description:"Luxury tailoring, sharp suits and contemporary menswear for modern gentlemen.",
designers:"28",
pieces:"520",
rating:"4.8",
image:"images/house-men.jpg"
},

{
tag:"WOMENSWEAR",
title:"Étoile Femme",
description:"Elegant dresses, elevated essentials and statement fashion curated for confident women.",
designers:"51",
pieces:"760",
rating:"4.9",
image:"images/house-women.jpg"
},

{
tag:"LUXURY ACCESSORIES",
title:"The Violet Vault",
description:"Designer handbags, watches, jewelry and premium accessories that complete every outfit.",
designers:"36",
pieces:"410",
rating:"4.9",
image:"images/house-accessories.jpg"
},

{
tag:"FOOTWEAR",
title:"Velvet Soles",
description:"Luxury heels, handcrafted loafers and iconic footwear collections from elite brands.",
designers:"22",
pieces:"300",
rating:"4.8",
image:"images/house-footwear.jpg"
},

{
tag:"BESPOKE TAILORING",
title:"Maison Stitch",
description:"Custom-made garments created by master tailors with precision measurements and premium fabrics.",
designers:"18",
pieces:"240",
rating:"5.0",
image:"images/house-tailor.jpg"
}

];

const houseItems=document.querySelectorAll(".house-item");

const editorialImage=document.getElementById("editorialImage");
const houseTag=document.getElementById("houseTag");
const houseTitle=document.getElementById("houseTitle");
const houseDescription=document.getElementById("houseDescription");
const houseDesigners=document.getElementById("houseDesigners");
const housePieces=document.getElementById("housePieces");
const houseRating=document.getElementById("houseRating");

const prevHouse=document.getElementById("prevHouse");
const nextHouse=document.getElementById("nextHouse");

let currentHouse=0;

function renderHouse(){

    houseItems.forEach((item,index)=>{

        const offset=(index-currentHouse+houseItems.length)%houseItems.length;

        let x=0, scale=.75, opacity=.35, z=0;

        if(offset===0){
            x=0; scale=1; opacity=1; z=5;
            item.classList.add("active");
        }else if(offset===1){
            x=160; scale=.82; opacity=.6; z=3;
            item.classList.remove("active");
        }else if(offset===2){
            x=280; scale=.65; opacity=.3; z=2;
            item.classList.remove("active");
        }else if(offset===5){
            x=-160; scale=.82; opacity=.6; z=3;
            item.classList.remove("active");
        }else if(offset===4){
            x=-280; scale=.65; opacity=.3; z=2;
            item.classList.remove("active");
        }else{
            x=0; scale=.45; opacity=0; z=1;
            item.classList.remove("active");
        }

        item.style.transform=
        `translate(-50%,-50%) translateX(${x}px) scale(${scale})`;

        item.style.opacity=opacity;
        item.style.zIndex=z;

    });

    const house=fashionHouses[currentHouse];

    editorialImage.style.opacity=0;

    setTimeout(()=>{
        editorialImage.src=house.image;
        editorialImage.style.opacity=1;
    },180);

    houseTag.textContent=house.tag;
    houseTitle.textContent=house.title;
    houseDescription.textContent=house.description;
    houseDesigners.textContent=house.designers;
    housePieces.textContent=house.pieces;
    houseRating.textContent=house.rating;

}

nextHouse.addEventListener("click",()=>{

    currentHouse=(currentHouse+1)%fashionHouses.length;

    renderHouse();

});

prevHouse.addEventListener("click",()=>{

    currentHouse=
    (currentHouse-1+fashionHouses.length)%fashionHouses.length;

    renderHouse();

});

setInterval(()=>{

    currentHouse=(currentHouse+1)%fashionHouses.length;

    renderHouse();

},5000);

renderHouse();

/*==================================
BATCH 3 - VOGUE WALL
==================================*/

const looks = [

{
tag:"HAUTE COUTURE",
season:"FW26",
title:"Midnight Atelier",
designer:"Amina Cole",
description:"Sculptural evening wear crafted for modern luxury and unforgettable entrances.",
looks:"42",
rating:"4.9",
pieces:"680",
image:"images/vogue1.jpg"
},

{
tag:"MENSWEAR",
season:"SS26",
title:"Noir Homme",
designer:"Daniel Hart",
description:"Sharp tailoring and elevated menswear designed for powerful silhouettes.",
looks:"36",
rating:"4.8",
pieces:"520",
image:"images/vogue2.jpg"
},

{
tag:"WOMENSWEAR",
season:"FW26",
title:"Violet Muse",
designer:"Elena Royce",
description:"Fluid dresses and contemporary couture celebrating feminine elegance.",
looks:"54",
rating:"4.9",
pieces:"760",
image:"images/vogue3.jpg"
},

{
tag:"AVANT GARDE",
season:"LIMITED",
title:"Chrome Dreams",
designer:"Kai Moreau",
description:"Experimental luxury fashion pushing the boundaries of editorial design.",
looks:"29",
rating:"5.0",
pieces:"410",
image:"images/vogue4.jpg"
}

];

const featuredImage=document.getElementById("featuredImage");
const coverSeason=document.getElementById("coverSeason");
const coverTitle=document.getElementById("coverTitle");
const coverDesigner=document.getElementById("coverDesigner");

const detailTag=document.getElementById("detailTag");
const detailTitle=document.getElementById("detailTitle");
const detailDescription=document.getElementById("detailDescription");

const detailLooks=document.getElementById("detailLooks");
const detailRating=document.getElementById("detailRating");
const detailPieces=document.getElementById("detailPieces");

const miniCovers=document.querySelectorAll(".mini-cover");

function updateLook(index){

    const data=looks[index];

    featuredImage.style.opacity=0;

    setTimeout(()=>{

        featuredImage.src=data.image;
        featuredImage.style.opacity=1;

    },180);

    coverSeason.textContent=data.season;
    coverTitle.textContent=data.title;
    coverDesigner.textContent="by "+data.designer;

    detailTag.textContent=data.tag;
    detailTitle.textContent=data.title;
    detailDescription.textContent=data.description;

    detailLooks.textContent=data.looks;
    detailRating.textContent=data.rating;
    detailPieces.textContent=data.pieces;

    miniCovers.forEach(card=>card.classList.remove("active"));
    miniCovers[index].classList.add("active");

}

miniCovers.forEach((card,index)=>{

    card.addEventListener("click",()=>{

        updateLook(index);

    });

});

updateLook(0);

/* =========================================
   BATCH 4 - VIRTUAL WARDROBE
========================================= */

const blazerLayer=document.getElementById("blazerLayer");
const trouserLayer=document.getElementById("trouserLayer");
const shoeLayer=document.getElementById("shoeLayer");

const outfitName=document.getElementById("outfitName");
const outfitDesc=document.getElementById("outfitDesc");
const outfitPrice=document.getElementById("outfitPrice");

const wardrobeButtons=document.querySelectorAll(".wardrobe-btn");

const wardrobe={

blazer:[
"images/blazer1.png",
"images/blazer2.png",
"images/blazer3.png"
],

trouser:[
"images/trouser1.png",
"images/trouser2.png",
"images/trouser3.png"
],

shoe:[
"images/shoe1.png",
"images/shoe2.png",
"images/shoe3.png"
]

};

const outfits=[
{
name:"Midnight Executive",
desc:"Luxury tailored blazer with modern black trousers and handcrafted loafers.",
price:"₦285,000"
},
{
name:"Ivory Elegance",
desc:"Soft cream tailoring with feminine editorial styling.",
price:"₦248,000"
},
{
name:"Velvet Rebel",
desc:"Bold velvet outerwear with leather inspired fashion.",
price:"₦312,000"
}
];

let blazer=0;
let trouser=0;
let shoe=0;

function fadeSwap(layer,newImage){

layer.style.opacity=0;

setTimeout(()=>{
layer.src=newImage;
layer.style.opacity=1;
},150);

}

function refreshOutfit(){

fadeSwap(blazerLayer,wardrobe.blazer[blazer]);
fadeSwap(trouserLayer,wardrobe.trouser[trouser]);
fadeSwap(shoeLayer,wardrobe.shoe[shoe]);

const look=outfits[blazer];

outfitName.textContent=look.name;
outfitDesc.textContent=look.desc;
outfitPrice.textContent=look.price;

}

wardrobeButtons.forEach(btn=>{

btn.addEventListener("click",()=>{

const category=btn.dataset.category;
const index=Number(btn.dataset.index);

wardrobeButtons.forEach(b=>{
if(b.dataset.category===category){
b.classList.remove("active");
}
});

btn.classList.add("active");

if(category==="blazer") blazer=index;
if(category==="trouser") trouser=index;
if(category==="shoe") shoe=index;

refreshOutfit();

});

});

refreshOutfit();


/* =========================================
   RUNWAY CYLINDER
========================================= */

const runwayModels = document.querySelectorAll(".runway-model");

const runwayPrev = document.getElementById("runwayPrev");
const runwayNext = document.getElementById("runwayNext");

const collectionTag = document.getElementById("collectionTag");
const collectionName = document.getElementById("collectionName");
const collectionDesc = document.getElementById("collectionDesc");
const pieces = document.getElementById("pieces");
const designer = document.getElementById("designer");
const season = document.getElementById("season");

const runwayLooks = [
    {
        tag: "HAUTE COUTURE",
        title: "Midnight Eclipse",
        description: "Sculpted silhouettes inspired by modern luxury and timeless elegance.",
        pieces: "42",
        designer: "Amina Cole",
        season: "FW26"
    },
    {
        tag: "MENSWEAR",
        title: "Noir Homme",
        description: "Sharp tailoring and elevated menswear designed for powerful silhouettes.",
        pieces: "36",
        designer: "Daniel Hart",
        season: "SS26"
    },
    {
        tag: "WOMENSWEAR",
        title: "Violet Muse",
        description: "Fluid dresses and contemporary couture celebrating feminine elegance.",
        pieces: "54",
        designer: "Elena Royce",
        season: "FW26"
    },
    {
        tag: "AVANT GARDE",
        title: "Chrome Dreams",
        description: "Experimental luxury fashion pushing the boundaries of editorial design.",
        pieces: "29",
        designer: "Kai Moreau",
        season: "LIMITED"
    }
];

let currentRunway = 0;

function renderRunway() {

    runwayModels.forEach((model, index) => {

        const position =
            (index - currentRunway + runwayModels.length)
            % runwayModels.length;

        if (position === 0) {

            model.style.transform =
                "translate(-50%, -50%) translateZ(260px) scale(1)";

            model.style.opacity = "1";
            model.style.zIndex = "5";

        } else if (position === 1) {

            model.style.transform =
                "translate(-50%, -50%) rotateY(-55deg) translateZ(180px) scale(.82)";

            model.style.opacity = ".55";
            model.style.zIndex = "3";

        } else if (position === 2) {

            model.style.transform =
                "translate(-50%, -50%) rotateY(180deg) translateZ(120px) scale(.7)";

            model.style.opacity = ".25";
            model.style.zIndex = "1";

        } else {

            model.style.transform =
                "translate(-50%, -50%) rotateY(55deg) translateZ(180px) scale(.82)";

            model.style.opacity = ".55";
            model.style.zIndex = "3";
        }

    });

    const look = runwayLooks[currentRunway];

    collectionTag.textContent = look.tag;
    collectionName.textContent = look.title;
    collectionDesc.textContent = look.description;
    pieces.textContent = look.pieces;
    designer.textContent = look.designer;
    season.textContent = look.season;
}


runwayNext.addEventListener("click", () => {

    currentRunway =
        (currentRunway + 1) % runwayLooks.length;

    renderRunway();

});


runwayPrev.addEventListener("click", () => {

    currentRunway =
        (currentRunway - 1 + runwayLooks.length)
        % runwayLooks.length;

    renderRunway();

});


setInterval(() => {

    currentRunway =
        (currentRunway + 1) % runwayLooks.length;

    renderRunway();

}, 5000);


renderRunway();

/* =========================================
   BATCH 6 - STYLE CONCIERGE
========================================= */

const conciergeLooks = {

"Gala-Royal-Black":{
title:"Velvet Monarch",
label:"ROYAL GALA",
price:"₦425,000",
image:"images/concierge1.jpg",
description:"Command attention in handcrafted velvet tailoring with luxurious finishing."
},

"Office-Minimal-White":{
title:"Ivory Executive",
label:"POWER OFFICE",
price:"₦268,000",
image:"images/concierge2.jpg",
description:"Clean minimal tailoring for confident professionals."
},

"Wedding-Royal-Gold":{
title:"Golden Duchess",
label:"LUXURY WEDDING",
price:"₦395,000",
image:"images/concierge3.jpg",
description:"Elegant couture designed for unforgettable celebrations."
},

"Casual-Street-Violet":{
title:"Urban Violet",
label:"STREET LUXE",
price:"₦185,000",
image:"images/concierge4.jpg",
description:"Relaxed luxury infused with contemporary street fashion."
}

};

let occasion="Gala";
let style="Royal";
let color="Black";

const styleButtons=document.querySelectorAll(".style-option");
const colorButtons=document.querySelectorAll(".color-btn");

const conciergeImage=document.getElementById("conciergeImage");
const lookTitle=document.getElementById("lookTitle");
const lookLabel=document.getElementById("lookLabel");
const lookDescription=document.getElementById("lookDescription");
const lookPrice=document.getElementById("lookPrice");

styleButtons.forEach(btn=>{

btn.addEventListener("click",()=>{

const type=btn.dataset.type;

document.querySelectorAll(`[data-type="${type}"]`)
.forEach(b=>b.classList.remove("active"));

btn.classList.add("active");

if(type==="occasion") occasion=btn.dataset.value;
if(type==="style") style=btn.dataset.value;

});

});

colorButtons.forEach(btn=>{

btn.addEventListener("click",()=>{

colorButtons.forEach(b=>b.classList.remove("active"));

btn.classList.add("active");

color=btn.dataset.value;

});

});

document.getElementById("generateLook")
.addEventListener("click",()=>{

const key=`${occasion}-${style}-${color}`;

const look=
conciergeLooks[key] || conciergeLooks["Gala-Royal-Black"];

conciergeImage.style.opacity=0;

setTimeout(()=>{

conciergeImage.src=look.image;

lookTitle.textContent=look.title;
lookLabel.textContent=look.label;
lookDescription.textContent=look.description;
lookPrice.textContent=look.price;

conciergeImage.style.opacity=1;

},180);

});

/*=========================================
BATCH 7 - ACCESSORIES VAULT
=========================================*/

const vaultProducts={

bags:[

{
tag:"PREMIUM LEATHER",
title:"Royal Noir Handbag",
desc:"Italian handcrafted leather with polished gold detailing.",
price:"₦185,000",
image:"images/bag1.jpg"
},

{
tag:"LIMITED EDITION",
title:"Ivory Duchess Bag",
desc:"Elegant luxury handbag with minimalist sophistication.",
price:"₦215,000",
image:"images/bag2.jpg"
},

{
tag:"RUNWAY ICON",
title:"Velvet Luxe Tote",
desc:"Oversized premium tote crafted for modern fashion lovers.",
price:"₦248,000",
image:"images/bag3.jpg"
}

],

watches:[

{
tag:"SWISS LUXURY",
title:"Celestial Chronograph",
desc:"Swiss precision watch with sapphire crystal.",
price:"₦420,000",
image:"images/watch1.jpg"
},

{
tag:"ROSE GOLD",
title:"Aurora Elite",
desc:"Luxury rose gold timepiece for timeless elegance.",
price:"₦385,000",
image:"images/watch2.jpg"
},

{
tag:"AUTOMATIC",
title:"Imperial Motion",
desc:"Mechanical masterpiece engineered for excellence.",
price:"₦460,000",
image:"images/watch3.jpg"
}

],

jewelry:[

{
tag:"DIAMOND EDITION",
title:"Elysian Necklace",
desc:"Brilliant diamond necklace crafted for gala nights.",
price:"₦295,000",
image:"images/jewel1.jpg"
},

{
tag:"EMERALD",
title:"Verde Royale",
desc:"Luxury emerald jewelry with handcrafted detailing.",
price:"₦335,000",
image:"images/jewel2.jpg"
},

{
tag:"PLATINUM",
title:"Stellar Halo Set",
desc:"Premium platinum earrings and pendant collection.",
price:"₦370,000",
image:"images/jewel3.jpg"
}

],

heels:[

{
tag:"SIGNATURE HEELS",
title:"Velvet Stiletto",
desc:"Elegant runway heels blending luxury and comfort.",
price:"₦165,000",
image:"images/heel1.jpg"
},

{
tag:"CRYSTAL EDITION",
title:"Luna Crystal Heel",
desc:"Evening heels finished with sparkling crystal accents.",
price:"₦192,000",
image:"images/heel2.jpg"
},

{
tag:"COUTURE",
title:"Golden Muse Heel",
desc:"Luxury designer heels inspired by Paris couture.",
price:"₦210,000",
image:"images/heel3.jpg"
}

]

};

const vaultCategories=document.querySelectorAll(".vault-category");
const vaultThumbs=document.querySelectorAll(".vault-thumb");

const vaultImage=document.getElementById("vaultImage");
const vaultTag=document.getElementById("vaultTag");
const vaultTitle=document.getElementById("vaultTitle");
const vaultDescription=document.getElementById("vaultDescription");
const vaultPrice=document.getElementById("vaultPrice");

let currentCategory="bags";
let currentIndex=0;

function renderVault(){

const item=vaultProducts[currentCategory][currentIndex];

vaultImage.src=item.image;
vaultTag.textContent=item.tag;
vaultTitle.textContent=item.title;
vaultDescription.textContent=item.desc;
vaultPrice.textContent=item.price;

vaultThumbs.forEach((thumb,i)=>{

thumb.src=vaultProducts[currentCategory][i].image;

thumb.classList.toggle("active",i===currentIndex);

});

}

vaultCategories.forEach(btn=>{

btn.addEventListener("click",()=>{

vaultCategories.forEach(b=>b.classList.remove("active"));

btn.classList.add("active");

currentCategory=btn.dataset.category;

currentIndex=0;

renderVault();

});

});

vaultThumbs.forEach((thumb,i)=>{

thumb.addEventListener("click",()=>{

currentIndex=i;

renderVault();

});

});

document.getElementById("vaultNext").onclick=()=>{

currentIndex=(currentIndex+1)%3;

renderVault();

};

document.getElementById("vaultPrev").onclick=()=>{

currentIndex=(currentIndex-1+3)%3;

renderVault();

};

renderVault();

