<?php

require "config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Ultimate Support</title>

    <link rel="stylesheet" href="styles.css">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="support.css"
    >

</head>

<body>

    <?php include "includes/navbar.php"; ?>


    <main class="support-page">

        <!-- CHATBOT WILL GO HERE -->
         <main class="support-page">

    <section class="support-chat">

        <!-- HEADER -->

        <div class="chat-header">

            <div class="chat-brand">

                <div class="chat-avatar">
                    <i class="fa-solid fa-sparkles"></i>
                </div>

                <div>
                    <span>ULTIMATE SUPPORT</span>
                    <h1>How can we help?</h1>
                </div>

            </div>

            <div class="online-status">

                <span class="status-dot"></span>

                Online

            </div>

        </div>


        <!-- CHAT AREA -->

        <div class="chat-body">

            <div class="welcome-message">

                <div class="bot-avatar">
                    <i class="fa-solid fa-sparkles"></i>
                </div>

                <div class="bot-message">

                    <span class="message-name">
                        Ultimate Support
                    </span>

                    <p>
                        Hi there! 👋
                    </p>

                    <p>
                        I'm here to help you with anything
                        related to Ultimate.
                    </p>

                    <p>
                        What can I help you with?
                    </p>

                </div>

            </div>


            <!-- QUICK OPTIONS -->

            <div class="quick-options">

                <button type="button">
                    <i class="fa-solid fa-bag-shopping"></i>
                    Buying on Ultimate
                </button>

                <button type="button">
                    <i class="fa-solid fa-store"></i>
                    Selling on Ultimate
                </button>

                <button type="button">
                    <i class="fa-solid fa-user"></i>
                    Account & Profile
                </button>

                <button type="button">
                    <i class="fa-solid fa-credit-card"></i>
                    Payments
                </button>

                <button type="button">
                    <i class="fa-solid fa-box"></i>
                    Orders & Delivery
                </button>

                <button type="button">
                    <i class="fa-solid fa-shield-halved"></i>
                    Safety & Reporting
                </button>

            </div>

        </div>


        <!-- MESSAGE INPUT -->

        <form class="chat-input-area">

            <input
                type="text"
                placeholder="Ask Ultimate Support anything..."
                autocomplete="off"
            >

            <button type="submit">

                <i class="fa-solid fa-arrow-up"></i>

            </button>

        </form>

    </section>

</main>

    </main>


    <?php include "includes/footer.php"; ?>


    <script>

const chatBody = document.querySelector(".chat-body");
const quickOptions = document.querySelectorAll(".quick-options button");
const chatInput = document.querySelector(".chat-input-area input");
const chatForm = document.querySelector(".chat-input-area");


/* =========================================
   ADD USER MESSAGE
========================================= */

function addUserMessage(message){

    const userMessage = document.createElement("div");

    userMessage.className = "user-message";

    userMessage.innerHTML = `
        <div class="user-avatar">
            <i class="fa-solid fa-user"></i>
        </div>

        <div class="user-message-bubble">
            ${message}
        </div>
    `;

    chatBody.appendChild(userMessage);

    chatBody.scrollTop = chatBody.scrollHeight;

}


/* =========================================
   TYPING INDICATOR
========================================= */

function showTyping(){

    const typing = document.createElement("div");

    typing.className = "bot-typing";

    typing.innerHTML = `
        <div class="bot-avatar">

            <i class="fa-solid fa-sparkles"></i>

        </div>

        <div class="typing-bubble">

            <span></span>
            <span></span>
            <span></span>

        </div>
    `;

    chatBody.appendChild(typing);

    chatBody.scrollTop = chatBody.scrollHeight;

    return typing;

}


/* =========================================
   ADD BOT MESSAGE
========================================= */

function addBotMessage(message, options = []){

    const botMessage = document.createElement("div");

    botMessage.className = "bot-response";


    let optionsHTML = "";


    if(options.length > 0){

        optionsHTML = `
            <div class="bot-options">

                ${options.map(option => `

                    <button
                        type="button"
                        class="bot-option"
                    >
                        ${option}
                    </button>

                `).join("")}

            </div>
        `;

    }


    botMessage.innerHTML = `

        <div class="bot-avatar">

            <i class="fa-solid fa-sparkles"></i>

        </div>


        <div class="bot-response-content">

            <div class="bot-message">

                <span class="message-name">
                    Ultimate Support
                </span>

                <p>
                    ${message}
                </p>

            </div>


            ${optionsHTML}

        </div>

    `;


    chatBody.appendChild(botMessage);

    chatBody.scrollTop = chatBody.scrollHeight;


    /* =========================================
       FOLLOW-UP BUTTONS
    ========================================= */

    const optionButtons =
        botMessage.querySelectorAll(".bot-option");


    optionButtons.forEach(button => {

        button.addEventListener("click", () => {

            const selectedOption =
                button.textContent.trim();

            sendMessage(selectedOption);

        });

    });

}


/* =========================================
   BOT RESPONSE LOGIC
========================================= */

function getBotResponse(message){

    const text = message.toLowerCase();


    /* =========================================
       SELLING
    ========================================= */

    if(
        text.includes("selling") ||
        text.includes("vendor")
    ){

        return "Sure! I can help you with selling on Ultimate. You can become a vendor, create listings, manage your products and services, and keep your listings available to customers.";

    }


    /* =========================================
       BUYING
    ========================================= */

    if(
        text.includes("buying") ||
        text.includes("shopping") ||
        text.includes("product")
    ){

        return "I can help you find products and services on Ultimate, understand listings, and guide you through the buying process.";

    }


    /* =========================================
       ACCOUNT
    ========================================= */

    if(
        text.includes("account") ||
        text.includes("profile") ||
        text.includes("login") ||
        text.includes("password")
    ){

        return "I can help you with your Ultimate account, including signing in, your profile, and password-related issues.";

    }


    /* =========================================
       PAYMENTS
    ========================================= */

    if(
        text.includes("payment") ||
        text.includes("pay") ||
        text.includes("transaction")
    ){

        return "I can help with payment and transaction questions on Ultimate. Tell me what happened and I'll guide you through it.";

    }


    /* =========================================
       ORDERS
    ========================================= */

    if(
        text.includes("order") ||
        text.includes("delivery") ||
        text.includes("shipping")
    ){

        return "I can help you with orders, shipping, and delivery questions. Tell me what you'd like to know.";

    }


    /* =========================================
       SAFETY
    ========================================= */

    if(
        text.includes("safety") ||
        text.includes("report") ||
        text.includes("scam") ||
        text.includes("fraud")
    ){

        return "If you've encountered something suspicious on Ultimate, I can guide you through reporting the listing, service, vendor, or activity.";

    }


    /* =========================================
       DEFAULT
    ========================================= */

    return "Thanks for reaching out! I'm here to help with Ultimate. Tell me a little more about what you need help with.";

}


/* =========================================
   GET FOLLOW-UP OPTIONS
========================================= */

function getFollowUpOptions(message){

    const text = message.toLowerCase();


    /* SELLING */

    if(
        text.includes("selling") ||
        text === "vendor" ||
        text.includes("become a vendor")
    ){

        return [

            "Become a Vendor",
            "Add a Product",
            "Add a Service",
            "Renew a Listing",
            "Vendor Verification"

        ];

    }


    /* BUYING */

    if(
        text.includes("buying") ||
        text.includes("shopping")
    ){

        return [

            "Find a Product",
            "Find a Service",
            "Contact a Vendor",
            "Buying Help"

        ];

    }


    /* ACCOUNT */

    if(
        text.includes("account") ||
        text.includes("profile")
    ){

        return [

            "Login Help",
            "Reset My Password",
            "Edit My Profile"

        ];

    }


    /* PAYMENTS */

    if(
        text.includes("payment") ||
        text.includes("transaction")
    ){

        return [

            "Payment Issue",
            "Transaction Help",
            "Refund Help"

        ];

    }


    /* ORDERS */

    if(
        text.includes("order") ||
        text.includes("delivery")
    ){

        return [

            "Check My Order",
            "Delivery Help",
            "Order Problem"

        ];

    }


    /* SAFETY */

    if(
        text.includes("safety") ||
        text.includes("report") ||
        text.includes("scam") ||
        text.includes("fraud")
    ){

        return [

            "Report a Vendor",
            "Report a Listing",
            "Report Suspicious Activity"

        ];

    }


    return [];

}


/* =========================================
   SEND MESSAGE
========================================= */

function sendMessage(message){

    addUserMessage(message);


    const typing = showTyping();


    setTimeout(() => {

        typing.remove();


        const response =
            getBotResponse(message);


        const options =
            getFollowUpOptions(message);


        addBotMessage(
            response,
            options
        );


    }, 1200);

}


/* =========================================
   QUICK QUESTIONS
========================================= */

quickOptions.forEach(button => {

    button.addEventListener("click", () => {

        const message =
            button.textContent.trim();


        /* Remove initial welcome */

        if(
            chatBody.querySelector(".welcome-message")
        ){

            chatBody.innerHTML = "";

        }


        sendMessage(message);

    });

});


/* =========================================
   TYPED MESSAGE
========================================= */

chatForm.addEventListener("submit", function(event){

    event.preventDefault();


    const message =
        chatInput.value.trim();


    if(message === ""){

        return;

    }


    /* Remove initial welcome */

    if(
        chatBody.querySelector(".welcome-message")
    ){

        chatBody.innerHTML = "";

    }


    chatInput.value = "";


    sendMessage(message);

});

</script>


</body>

</html>