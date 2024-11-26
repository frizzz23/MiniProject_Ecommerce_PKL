function showLoader() {
    document.body.classList.remove("loaded");
    sessionStorage.setItem("loading", "true"); // Menyimpan status loading
}

// Fungsi untuk menyembunyikan loader setelah halaman selesai dimuat
function hideLoader() {
    document.body.classList.add("loaded");
    sessionStorage.removeItem("loading"); // Menghapus status loading
}

// Cek status loading saat halaman dimuat
window.addEventListener("load", function () {
    // Jika halaman sebelumnya sudah dimuat dan status loading ada, tetap tunjukkan loader
    if (sessionStorage.getItem("loading")) {
        showLoader();
        hideLoader();
    } else {
        hideLoader();
    }
});

// Menampilkan loader saat sebelum halaman berpindah atau direfresh
window.addEventListener("beforeunload", function () {
    showLoader();
});