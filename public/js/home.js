// Ambil tautan Features berdasarkan ID
const featuresLink = document.getElementById('features-link');

// Ambil elemen tempat Anda ingin menampilkan konten Features
const featuresContainer = document.getElementById('features-container');

// Tambahkan event listener untuk menghandle klik pada tautan Features
featuresLink.addEventListener('click', (e) => {
    e.preventDefault(); // Menghentikan perilaku default tautan

    // Gunakan Ajax atau Fetch API untuk memuat konten Features dari server
    fetch('feature') // Gantilah 'url_ke_halaman_features' dengan URL yang sesuai
        .then((response) => response.text())
        .then((data) => {
            // Tampilkan konten Features dalam elemen container
            featuresContainer.innerHTML = data;
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});
