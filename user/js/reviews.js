
document.addEventListener("DOMContentLoaded", function(){

    const reviewModal =
        document.getElementById("reviewModal");

    const closeReviewModal =
        document.getElementById("closeReviewModal");

    const cancelReview =
        document.getElementById("cancelReview");


    const reviewButtons =
        document.querySelectorAll(
            ".write-review-btn, .edit-review-btn"
        );


    const ratingButtons =
        document.querySelectorAll(
            ".review-rating button"
        );


    const ratingText =
        document.getElementById("ratingText");


    const selectedRating =
        document.getElementById("selectedRating");


    /*
    =========================================
        OPEN MODAL
    =========================================
    */

    reviewButtons.forEach(function(button){

        button.addEventListener("click", function(){

            reviewModal.classList.add("active");

        });

    });


    /*
    =========================================
        CLOSE MODAL
    =========================================
    */

    function closeModal(){

        reviewModal.classList.remove("active");

    }


    closeReviewModal.addEventListener(
        "click",
        closeModal
    );


    cancelReview.addEventListener(
        "click",
        closeModal
    );


    reviewModal.addEventListener(
        "click",
        function(event){

            if(event.target === reviewModal){

                closeModal();

            }

        }
    );


    /*
    =========================================
        STAR RATING
    =========================================
    */

    const ratingLabels = {

        1: "Very poor",
        2: "Poor",
        3: "Good",
        4: "Very good",
        5: "Excellent"

    };


    ratingButtons.forEach(function(button){

        button.addEventListener(
            "click",
            function(){

                const rating =
                    Number(
                        button.dataset.rating
                    );


                /*
                    Save rating inside
                    hidden input.
                */

                selectedRating.value =
                    rating;


                /*
                    Highlight selected
                    stars.
                */

                ratingButtons.forEach(
                    function(starButton){

                        const starRating =
                            Number(
                                starButton.dataset.rating
                            );


                        if(
                            starRating <= rating
                        ){

                            starButton.classList.add(
                                "active"
                            );

                        }else{

                            starButton.classList.remove(
                                "active"
                            );

                        }

                    }
                );


                ratingText.textContent =
                    ratingLabels[rating];

            }
        );

    });

});

