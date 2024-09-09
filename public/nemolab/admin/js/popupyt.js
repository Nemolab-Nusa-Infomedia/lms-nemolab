        // POPUP YOUTUBE
        document.addEventListener("DOMContentLoaded", function() {
            const youtubePopup = document.getElementById('youtube-popup');
            const closeBtn = document.getElementById('close-btn');
            const youtubeIframe = document.getElementById('youtube-iframe');

            // URL YouTube video yang ingin ditampilkan
            const youtubeURL = 'https://www.youtube.com/embed/jYuAmonOUvU?si=SJ51Cy_KCkZrH5b0';

            // Membuka popup secara otomatis saat halaman dimuat dengan animasi
            setTimeout(() => {
                youtubeIframe.src = youtubeURL;
                youtubePopup.classList.remove('hidden', 'close');
                youtubePopup.classList.add('open');
            }, 500); // Delay sedikit untuk memastikan transisi terlihat

            closeBtn.addEventListener('click', function() {
                youtubePopup.classList.remove('open');
                youtubePopup.classList.add('close');

                // Menghapus iframe src setelah animasi selesai
                setTimeout(() => {
                    youtubeIframe.src = '';
                    youtubePopup.classList.add('hidden');
                }, 500); // Delay sesuai durasi animasi keluar
            });
        });