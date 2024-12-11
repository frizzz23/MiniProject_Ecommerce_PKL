document.addEventListener("DOMContentLoaded", function () {
    const nextDon = document.getElementById("next");
    const prevDon = document.getElementById("prev");
    const carouselDon = document.querySelector(".carousel");
    const ListItemDon = document.querySelector(".carousel .list");
    const thumbnailDon = document.querySelector(".carousel .thumbnail");

    let timeRunning = 3500;
    let timeout;

    nextDon.onclick = () => showSlider("next");
    prevDon.onclick = () => showSlider("prev");

    function showSlider(type) {
        const itemSlider = document.querySelectorAll(".carousel .list .item");
        const itemThumbnail = document.querySelectorAll(".carousel .thumbnail .item");

        if (type === "next") {
            ListItemDon.appendChild(itemSlider[0]);
            thumbnailDon.appendChild(itemThumbnail[0]);
            carouselDon.classList.add("next");
        } else if (type === "prev") {
            const lastIndex = itemSlider.length - 1;
            ListItemDon.prepend(itemSlider[lastIndex]);
            thumbnailDon.prepend(itemThumbnail[lastIndex]);
            carouselDon.classList.add("prev");
        }

        // Hapus kelas setelah animasi selesai
        setTimeout(() => {
            carouselDon.classList.remove("next", "prev");
        }, 500); // Sesuaikan durasi animasi CSS
    }

    // Slider otomatis
    function autoSlide() {
        timeout = setInterval(() => {
            showSlider("next");
        }, timeRunning);
    }

    // Jalankan slider otomatis
    autoSlide();

    // Hentikan slider otomatis saat mouse berada di carousel
    carouselDon.addEventListener("mouseenter", () => clearInterval(timeout));
    carouselDon.addEventListener("mouseleave", autoSlide);
});


const container = document.querySelector('.container');
const registerBtn = document.querySelector('.register-btn');
const loginBtn = document.querySelector('.login-btn');

registerBtn.addEventListener('click', () => {
    container.classList.add('active');
});

loginBtn.addEventListener('click', () => {
    container.classList.remove('active');
});

