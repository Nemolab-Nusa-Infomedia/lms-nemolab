if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/nemolab/member/js/service-worker.js')
            .then((registration) => {
                // console.log('ServiceWorker registered:', registration);

                // Pastikan service worker siap sebelum melanjutkan
                navigator.serviceWorker.ready.then((registration) => {
                    // console.log('ServiceWorker is active and ready');
                }).catch((error) => {
                    console.error('ServiceWorker is not ready:', error);
                });
            })
            .catch((error) => {
                console.error('ServiceWorker registration failed:', error);
            });
    });
}

// Set workerSrc ke path yang benar
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.worker.min.js';

// Ambil nama PDF dari atribut data
const ebookElement = document.getElementById('ebook');
const pdfFilename = ebookElement.getAttribute('data-pdf');

// Set URL PDF ke path storage
const url = `/storage/pdfs/${encodeURIComponent(pdfFilename)}`;

// Ambil canvas dan context
const canvas = document.getElementById('pdf-render');
const ctx = canvas.getContext('2d');
// Ambil elemen kontrol
const zoomInBtn = document.getElementById('zoom-in');
const zoomOutBtn = document.getElementById('zoom-out');
const resetZoomBtn = document.getElementById('reset-zoom');
const prevPageBtn = document.getElementById('prev-page');
const nextPageBtn = document.getElementById('next-page');
const pageInput = document.getElementById('page-input');
const pageCountEl = document.getElementById('page-count');
const fullScreenBtn = document.getElementById('pdf-fullscreen');
let pdfDoc = null;
let pageNum = 1;
let pageIsRendering = false;
let pageNumIsPending = null;
let scale = 1.5;
let zoomStep = 0.1;
let totalPages = 0;
// Render halaman
const renderPage = (num) => {
    pageIsRendering = true;
    // Ambil halaman
    pdfDoc.getPage(num).then((page) => {
        const viewport = page.getViewport({ scale });
        canvas.height = viewport.height;
        canvas.width = viewport.width;
        const renderCtx = {
            canvasContext: ctx,
            viewport,
        };
        page.render(renderCtx).promise.then(() => {
            // console.log('Page rendered:', num);
            pageIsRendering = false;

            if (pageNumIsPending !== null) {
                renderPage(pageNumIsPending);
                pageNumIsPending = null;
            }
        });
        // Update input halaman dan total halaman
        pageInput.value = num;
        pageCountEl.textContent = totalPages;
    });
};

// Cek apakah halaman sedang dirender
const queueRenderPage = (num) => {
    if (pageIsRendering) {
        pageNumIsPending = num;
    } else {
        renderPage(num);
    }
};

// Tampilkan halaman sebelumnya
const showPrevPage = () => {
    if (pageNum <= 1) return;
    pageNum--;
    queueRenderPage(pageNum);
};

// Tampilkan halaman berikutnya
const showNextPage = () => {
    if (pageNum >= totalPages) return;
    pageNum++;
    queueRenderPage(pageNum);
};

// Zoom In
const zoomIn = () => {
    scale += zoomStep;
    queueRenderPage(pageNum);
};

// Zoom Out
const zoomOut = () => {
    if (scale > 0.5) {
        scale -= zoomStep;
        queueRenderPage(pageNum);
    }
};

// Reset Zoom
const resetZoom = () => {
    scale = 1.5;
    queueRenderPage(pageNum);
};

// Mode Fullscreen
const toggleFullscreen = () => {
    const elem = document.getElementById('ebook');
    if (!document.fullscreenElement) {
        // Masuk ke mode fullscreen
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen();
        }
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        }
    }
};


// Load PDF
pdfjsLib.getDocument(url).promise.then((pdfDoc_) => {
    pdfDoc = pdfDoc_;
    totalPages = pdfDoc.numPages;
    pageCountEl.textContent = totalPages;
    renderPage(pageNum);
}).catch((error) => {
    console.error('Error loading PDF:', error);
    alert('Gagal memuat PDF. Silakan coba lagi nanti.');
});

// Tambahkan event listeners
prevPageBtn.addEventListener('click', showPrevPage);
nextPageBtn.addEventListener('click', showNextPage);
zoomInBtn.addEventListener('click', zoomIn);
zoomOutBtn.addEventListener('click', zoomOut);
resetZoomBtn.addEventListener('click', resetZoom);
fullScreenBtn.addEventListener('click', toggleFullscreen);

// Ganti halaman melalui input
pageInput.addEventListener('change', (e) => {
    const pageNumber = parseInt(e.target.value);
    if (pageNumber >= 1 && pageNumber <= totalPages) {
        pageNum = pageNumber;
        queueRenderPage(pageNum);
    }
});

// Zoom dengan scroll + Ctrl (Desktop)
canvas.addEventListener('wheel', (e) => {
    if (e.ctrlKey) {
        e.preventDefault();
        if (e.deltaY < 0) {
            zoomIn();
        } else {
            zoomOut();
        }
    }
});

// Zoom dengan pinch (Mobile)
let initialDistance = null;

canvas.addEventListener('touchstart', (e) => {
    if (e.touches.length === 2) {
        initialDistance = Math.hypot(
            e.touches[0].pageX - e.touches[1].pageX,
            e.touches[0].pageY - e.touches[1].pageY
        );
    }
});

canvas.addEventListener('touchmove', (e) => {
    if (e.touches.length === 2 && initialDistance !== null) {
        const newDistance = Math.hypot(
            e.touches[0].pageX - e.touches[1].pageX,
            e.touches[0].pageY - e.touches[1].pageY
        );
        if (newDistance > initialDistance) {
            zoomIn();
        } else if (newDistance < initialDistance) {
            zoomOut();
        }
        initialDistance = newDistance;
    }
});

canvas.addEventListener('touchend', () => {
    initialDistance = null;
});
