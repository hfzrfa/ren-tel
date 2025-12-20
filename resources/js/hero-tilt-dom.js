// Simple vanilla tilt effect for hero card

function mountHeroTilt() {
    const card = document.getElementById("hero-tilt-card");
    if (!card) return;

    const maxRotate = 10; // degrees
    const scaleOnHover = 1.03;

    function handleMove(e) {
        const rect = card.getBoundingClientRect();
        const offsetX = e.clientX - rect.left - rect.width / 2;
        const offsetY = e.clientY - rect.top - rect.height / 2;

        const rotateX = (-offsetY / (rect.height / 2)) * maxRotate;
        const rotateY = (offsetX / (rect.width / 2)) * maxRotate;

        card.style.transform = `perspective(800px) rotateX(${rotateX.toFixed(
            2
        )}deg) rotateY(${rotateY.toFixed(
            2
        )}deg) scale(${scaleOnHover})`;
    }

    function reset() {
        card.style.transform = "perspective(800px) rotateX(0deg) rotateY(0deg) scale(1)";
    }

    reset();

    card.addEventListener("mousemove", handleMove);
    card.addEventListener("mouseleave", reset);
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", mountHeroTilt);
} else {
    mountHeroTilt();
}
