function fakeLoad() {
    var loadingBar = document.getElementById('loading-bar');
    var width = 0;
    var interval = setInterval(function() {
        if (width >= 100) {
            clearInterval(interval);
            var loadingContainer = document.getElementById('loading-container');
            var content = document.getElementById('content');

            loadingContainer.style.display = 'none';
            content.style.display = 'block';
        } 
        else {
            width++;
            loadingBar.style.width = width + '%';
        }
    }, 30);
}

// Fungsi untuk menyembunyikan elemen loading dan menampilkan konten
function showContent() {
    var loadingContainer = document.getElementById('loading-container');
    var content = document.getElementById('content');
    loadingContainer.style.display = 'none';
    content.style.display = 'block';
}

// Jalankan fungsi fakeLoad saat DOMContentLoaded
window.addEventListener('DOMContentLoaded', function () {
    var loadingContainer = document.getElementById('loading-container');
    loadingContainer.style.display = 'block';
    fakeLoad();
});

// Periksa apakah halaman dimuat dari cache atau tidak
if (performance.navigation.type === 1) {
    // Halaman dimuat untuk pertama kalinya, maka tampilkan loading
    var loadingContainer = document.getElementById('loading-container');
    loadingContainer.style.display = 'block';
} else {
    // Halaman dimuat dari cache, maka langsung tampilkan konten
    showContent();
}