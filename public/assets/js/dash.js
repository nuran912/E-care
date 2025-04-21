document.addEventListener("DOMContentLoaded", () => {
    const animateNumbers = (element, targetValue, duration) => {
        let startValue = 0;
        const increment = targetValue / (duration / 10);
        const interval = setInterval(() => {
            startValue += increment;
            if (startValue >= targetValue) {
                element.textContent = Math.floor(targetValue);
                clearInterval(interval);
            } else {
                element.textContent = Math.floor(startValue);
            }
        }, 10);
    };

    document.querySelectorAll(".stat-card h2").forEach((stat) => {
        const targetValue = parseInt(stat.textContent, 10);
        animateNumbers(stat, targetValue, 2000); // 2 seconds animation
    });

    document.querySelectorAll(".stat-card img").forEach((img) => {
        setTimeout(() => {
            img.classList.add("animated");
        }, 500); // Delay to ensure smooth animation
    });
});
