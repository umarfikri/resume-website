// Create Typing Effect
function runTypingEffect() {
    const text = "AHMAD UMAR FIKRI";
    const typingElement = document.getElementById("typing-text");
    const typingDelay = 100;

    typeText(text, typingElement, typingDelay);
}

function typeText(text, typingElement, delay) {
    for (let i = 0; i < text.length; i++) {
        setTimeout(() => {
            typingElement.textContent += text.charAt(i);
        }, delay * i);
    }
}

document.addEventListener("DOMContentLoaded", runTypingEffect);

// Create navbar scroll
function userScroll() {
    const navbar = document.querySelector(".navbar");

    window.addEventListener("scroll", () => {
        if (window.scrollY > 50) {
            navbar.classList.add("bg-primary");
            navbar.classList.add("navbar-sticky");
        } else {
            navbar.classList.remove("bg-primary");
            navbar.classList.remove("navbar-sticky");
        }
    });
}

document.addEventListener("DOMContentLoaded", userScroll);

// Enlarge Picture
function openFullscreenImage(src) {
    const overlay = document.getElementById("fullscreenOverlay");
    const image = document.getElementById("fullscreenImage");
    image.src = src;
    overlay.classList.add("active");
}

function closeFullscreenImage() {
    const overlay = document.getElementById("fullscreenOverlay");
    overlay.classList.remove("active");
}

// Attach to all images inside carousel
document.addEventListener("DOMContentLoaded", function () {
    const imgs = document.querySelectorAll(".fullscreen-modal-img img");
    imgs.forEach((img) => {
        img.addEventListener("click", function () {
            openFullscreenImage(this.src);
        });
    });
});
