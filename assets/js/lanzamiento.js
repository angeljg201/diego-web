document.addEventListener('DOMContentLoaded', function() {
    const launchDateStr = window.launchDateGlobal;
    if (!launchDateStr) return;

    const launchDate = new Date(launchDateStr.replace(/-/g, "/")).getTime(); // Replace for Safari compatibility
    const timerElement = document.getElementById("countdown-timer");
    const ctaElement = document.getElementById("countdown-cta");

    if (!timerElement || !ctaElement) return;

    const countdownTimer = setInterval(function() {
        const now = new Date().getTime();
        const distance = launchDate - now;

        if (distance < 0) {
            clearInterval(countdownTimer);
            document.getElementById("days").innerText = "00";
            document.getElementById("hours").innerText = "00";
            document.getElementById("minutes").innerText = "00";
            document.getElementById("seconds").innerText = "00";
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerText = days < 10 ? "0" + days : days;
        document.getElementById("hours").innerText = hours < 10 ? "0" + hours : hours;
        document.getElementById("minutes").innerText = minutes < 10 ? "0" + minutes : minutes;
        document.getElementById("seconds").innerText = seconds < 10 ? "0" + seconds : seconds;
    }, 1000);
});
