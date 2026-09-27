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


    ```html
<script>

const chatBody = document.querySelector(".chat-body");
const quickOptions = document.querySelectorAll(".quick-options button");
const chatInput = document.querySelector(".chat-input-area input");
const chatForm = document.querySelector(".chat-input-area");


/* =========================================================
   ULTIMATE SUPPORT — MANUAL KNOWLEDGE BASE

   THIS IS WHERE WE TEACH THE CHATBOT.

   Each topic contains:

   1. TOPIC NAME
   2. POSSIBLE WORDS / PHRASES
   3. MANUALLY WRITTEN ANSWER

   The chatbot does NOT need the user to ask the question
   in one exact way.

   If the important words match a topic, that topic's
   answer will be returned.
========================================================= */


/* =========================================================
   VENDOR APPLICATION / APPROVAL
========================================================= */

/*
   POSSIBLE WORDS / PHRASES:

   vendor
   application
   approval
   approved
   verification
   verified
   seller
   become a vendor

   MANUALLY WRITTEN ANSWER:

   This is the answer Ultimate has approved for this topic.
*/

const vendorApplicationKeywords = [
    "vendor application",
    "vendor approval",
    "vendor approved",
    "vendor verification",
    "vendor verified",
    "verification",
    "verified",
    "seller application",
    "seller approval"
];

const vendorApplicationAnswer =
"If you have recently submitted your vendor application, you have to wait for the admin's approval. You will be notified via email when your application has been approved. To be verified by the admin, you must meet certain verification criteria, which includes, engagemts, algorithms, etc.";
    


/* =========================================================
   GENERAL SELLING / VENDOR
========================================================= */

const sellingKeywords = [
    "selling",
    "sell",
    "sell on ultimate",
    "vendor",
    "seller",
    "store",
    "become a vendor"
];

const sellingAnswer =
"To become a vendor on ultimate, follow these steps. 1) Click on the Vendor signup/login on the navbar 2) Signup/login then return to the homepage 3) Click on vendor dashboard on the navbar 4)Submit your application 5)Wait for the admin's apporoval(this might take 2 to 3 days). You will be notified once your application has been approved. You can then access your vendor dashboard.";
   

/* =========================================================
   BUYING
========================================================= */

const buyingKeywords = [
    "buying",
    "buy",
    "shopping",
    "shop",
    "find a product",
    "find a service",
    "purchase"
];

const buyingAnswer =
    "In ultimate you can find various categories such as tech, education, products, events, services and thousands more.Just go to the categories section on your navbar and explore ultimate's categories."


/* =========================================================
   ACCOUNT / PROFILE
========================================================= */

const accountKeywords = [
    "account",
    "profile",
    "login",
    "log in",
    "sign in",
    "password",
    "username"
];

const accountAnswer =
    "If you have any problem signing in to your account, consider a password reset. You can also click on your user profile in the user dashboard to make name or profile changes.";


/* =========================================================
   PAYMENTS
========================================================= */

const paymentKeywords = [
    "payment",
    "pay",
    "paid",
    "customercare",
    // "customer care",
    "transaction",
    "charge",
    "refund"
];

const paymentAnswer =
    "If you have a specific payment issue or other issues, consider contacting Ultimate's customer careline(+234 9068687656 or send an email to 'oluwatobilobakadri@gmail.com'";


/* =========================================================
   ORDERS / DELIVERY
========================================================= */

const orderKeywords = [
    "order",
    "delivery",
    "shipping",
    "deliver",
    "shipment",
    "tracking"
];

const orderAnswer =
    "You can track your order from the tracking panel in your user dashboard. If you are experiencing other issues, consider contacting the ultimate customer care line (+234 9068687656 or send an email to 'oluwatobilobakadri@gmail.com";


/* =========================================================
   SAFETY / REPORTING
========================================================= */

const safetyKeywords = [
    "safety",
    "report",
    "scammed by a vendor",
    "scam",
    "fraud",
    "fraudulent",
    "suspicious",
    "fake"
];

const safetyAnswer =
    "If you've encountered something suspicious on Ultimate, consider contacting the ultimate customer care line (+234 9068687656 or send an email to 'oluwatobilobakadri@gmail.com)', you will be attended to shortly.";


/* =========================================================
   UNKNOWN QUESTION
========================================================= */

const unknownAnswer =
    "I'm sorry, but I have not been programmed to answer this question yet. Please send an email to Ultimate Support and you will receive a response within a short period of time. Thank you.";


/* =========================================================
   CHECK KEYWORDS
========================================================= */

function containsKeyword(text, keywords){

    return keywords.some(keyword => {

        return text.includes(keyword);

    });

}


/* =========================================================
   GET BOT RESPONSE
========================================================= */

function getBotResponse(message){

    const text = message.toLowerCase().trim();


    /* =====================================================
       VENDOR APPLICATION / APPROVAL

       IMPORTANT:

       This comes BEFORE general vendor/selling because
       "vendor" is also inside this topic.

       We want:

       "How long does vendor approval take?"

       to receive the vendor approval answer instead of
       the general selling answer.
    ===================================================== */

    if(
        containsKeyword(
            text,
            vendorApplicationKeywords
        )
    ){

        return vendorApplicationAnswer;

    }


    /* =====================================================
       GENERAL SELLING
    ===================================================== */

    if(
        containsKeyword(
            text,
            sellingKeywords
        )
    ){

        return sellingAnswer;

    }


    /* =====================================================
       BUYING
    ===================================================== */

    if(
        containsKeyword(
            text,
            buyingKeywords
        )
    ){

        return buyingAnswer;

    }


    /* =====================================================
       ACCOUNT
    ===================================================== */

    if(
        containsKeyword(
            text,
            accountKeywords
        )
    ){

        return accountAnswer;

    }


    /* =====================================================
       PAYMENTS
    ===================================================== */

    if(
        containsKeyword(
            text,
            paymentKeywords
        )
    ){

        return paymentAnswer;

    }


    /* =====================================================
       ORDERS
    ===================================================== */

    if(
        containsKeyword(
            text,
            orderKeywords
        )
    ){

        return orderAnswer;

    }


    /* =====================================================
       SAFETY
    ===================================================== */

    if(
        containsKeyword(
            text,
            safetyKeywords
        )
    ){

        return safetyAnswer;

    }


    /* =====================================================
       NOTHING MATCHED

       The chatbot does NOT invent an answer.
    ===================================================== */

    return unknownAnswer;

}


/* =========================================================
   FOLLOW-UP OPTIONS
========================================================= */

function getFollowUpOptions(message){

    const text = message.toLowerCase().trim();


    /* =====================================================
       VENDOR APPLICATION
    ===================================================== */

    if(
        containsKeyword(
            text,
            vendorApplicationKeywords
        )
    ){

        return [

            "Become a Vendor",
            "Vendor Approval",
            "Vendor Verification"

        ];

    }


    /* =====================================================
       GENERAL SELLING
    ===================================================== */

    if(
        containsKeyword(
            text,
            sellingKeywords
        )
    ){

        return [

            "Become a Vendor",
            "Add a Product",
            "Add a Service",
            "Renew a Listing",
            "Vendor Verification"

        ];

    }


    /* =====================================================
       BUYING
    ===================================================== */

    if(
        containsKeyword(
            text,
            buyingKeywords
        )
    ){

        return [

            "Find a Product",
            "Find a Service",
            "Contact a Vendor",
            "Buying Help"

        ];

    }


    /* =====================================================
       ACCOUNT
    ===================================================== */

    if(
        containsKeyword(
            text,
            accountKeywords
        )
    ){

        return [

            "Login Help",
            "Reset My Password",
            "Edit My Profile"

        ];

    }


    /* =====================================================
       PAYMENTS
    ===================================================== */

    if(
        containsKeyword(
            text,
            paymentKeywords
        )
    ){

        return [

            "Payment Issue",
            "Transaction Help",
            "Refund Help"

        ];

    }


    /* =====================================================
       ORDERS
    ===================================================== */

    if(
        containsKeyword(
            text,
            orderKeywords
        )
    ){

        return [

            "Check My Order",
            "Delivery Help",
            "Order Problem"

        ];

    }


    /* =====================================================
       SAFETY
    ===================================================== */

    if(
        containsKeyword(
            text,
            safetyKeywords
        )
    ){

        return [

            "Report a Vendor",
            "Report a Listing",
            "Report Suspicious Activity"

        ];

    }


    return [];

}


/* =========================================================
   ADD USER MESSAGE
========================================================= */

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

    chatBody.scrollTop =
        chatBody.scrollHeight;

}


/* =========================================================
   TYPING INDICATOR
========================================================= */

function showTyping(){

    const typing =
        document.createElement("div");

    typing.className =
        "bot-typing";

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

    chatBody.scrollTop =
        chatBody.scrollHeight;

    return typing;

}


/* =========================================================
   ADD BOT MESSAGE
========================================================= */

function addBotMessage(
    message,
    options = []
){

    const botMessage =
        document.createElement("div");

    botMessage.className =
        "bot-response";


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

    chatBody.scrollTop =
        chatBody.scrollHeight;


    /* =====================================================
       FOLLOW-UP BUTTONS
    ===================================================== */

    const optionButtons =
        botMessage.querySelectorAll(
            ".bot-option"
        );


    optionButtons.forEach(button => {

        button.addEventListener(
            "click",
            () => {

                const selectedOption =
                    button.textContent.trim();

                sendMessage(
                    selectedOption
                );

            }
        );

    });

}


/* =========================================================
   SEND MESSAGE
========================================================= */

function sendMessage(message){

    addUserMessage(message);


    const typing =
        showTyping();


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


/* =========================================================
   QUICK OPTIONS
========================================================= */

quickOptions.forEach(button => {

    button.addEventListener(
        "click",
        () => {

            const message =
                button.textContent.trim();


            /*
                Remove the original welcome message
                when the user starts chatting.
            */

            if(
                chatBody.querySelector(
                    ".welcome-message"
                )
            ){

                chatBody.innerHTML = "";

            }


            sendMessage(message);

        }
    );

});


/* =========================================================
   TYPED MESSAGE
========================================================= */

chatForm.addEventListener(
    "submit",
    function(event){

        event.preventDefault();


        const message =
            chatInput.value.trim();


        if(message === ""){

            return;

        }


        /*
            Remove the original welcome message
            when the user starts chatting.
        */

        if(
            chatBody.querySelector(
                ".welcome-message"
            )
        ){

            chatBody.innerHTML = "";

        }


        chatInput.value = "";


        sendMessage(message);

    }
);

</script>



</body>

</html>