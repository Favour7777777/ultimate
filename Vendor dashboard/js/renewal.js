const renewalCountdowns = document.querySelectorAll(".renewal-countdown");

renewalCountdowns.forEach(function (countdown) {

    const renewalDue = countdown.dataset.renewalDue;
    const countdownTime = countdown.querySelector(".countdown-time");

    function updateCountdown() {

        const dueDate = new Date(renewalDue).getTime();
        const now = new Date().getTime();

        const difference = dueDate - now;

        if (difference <= 0) {

            countdownTime.textContent = "00:00:00";

            return;
        }

        const hours = Math.floor(difference / (1000 * 60 * 60));

        const minutes = Math.floor(
            (difference % (1000 * 60 * 60)) /
            (1000 * 60)
        );

        const seconds = Math.floor(
            (difference % (1000 * 60)) /
            1000
        );

        countdownTime.textContent =
            String(hours).padStart(2, "0") + ":" +
            String(minutes).padStart(2, "0") + ":" +
            String(seconds).padStart(2, "0");
    }

    updateCountdown();

    setInterval(updateCountdown, 1000);

});