if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/nemolab/member/js/service-worker.js')
            .then((registration) => {
                console.log('ServiceWorker registered:', registration);

                // Ensure service worker is ready before proceeding
                navigator.serviceWorker.ready.then((registration) => {
                    console.log('ServiceWorker is active and ready');
                }).catch((error) => {
                    console.error('ServiceWorker is not ready:', error);
                });
            })
            .catch((error) => {
                console.error('ServiceWorker registration failed:', error);
            });
    });
}

// Set the workerSrc to point to the correct path
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.worker.min.js';

const url = '/pdf-proxy';
const canvas = document.getElementById('pdf-render');
const ctx = canvas.getContext('2d');

const zoomInBtn = document.getElementById('zoom-in');
const zoomOutBtn = document.getElementById('zoom-out');
const resetZoomBtn = document.getElementById('reset-zoom');
const prevPageBtn = document.getElementById('prev-page');
const nextPageBtn = document.getElementById('next-page');
const pageInput = document.getElementById('page-input');
const pageCountEl = document.getElementById('page-count');
const searchInput = document.getElementById('search');
const fullScreenBtn = document.getElementById('pdf-fullscreen');

let pdfDoc = null;
let pageNum = 1;
let pageIsRendering = false;
let pageNumIsPending = null;
let scale = 1.5;
let zoomStep = 0.1;
let totalPages = 0;

// Render the page
const renderPage = (num) => {
    pageIsRendering = true;

    // Get page
    pdfDoc.getPage(num).then((page) => {
        const viewport = page.getViewport({ scale });
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        const renderCtx = {
            canvasContext: ctx,
            viewport,
        };

        page.render(renderCtx).promise.then(() => {
            console.log('Page rendered:', num);
            pageIsRendering = false;

            if (pageNumIsPending !== null) {
                renderPage(pageNumIsPending);
                pageNumIsPending = null;
            }
        });

        // Update page input and page count
        pageInput.value = num;
        pageCountEl.textContent = totalPages;
    });
};

// Check for pages rendering
const queueRenderPage = (num) => {
    if (pageIsRendering) {
        pageNumIsPending = num;
    } else {
        renderPage(num);
    }
};

// Show Prev Page
const showPrevPage = () => {
    if (pageNum <= 1) return;
    pageNum--;
    queueRenderPage(pageNum);
};

// Show Next Page
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

// Fullscreen Mode
const toggleFullscreen = () => {
    const elem = document.getElementById('ebook');
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.msRequestFullscreen) {
        elem.msRequestFullscreen();
    } else if (elem.mozRequestFullScreen) {
        elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) {
        elem.webkitRequestFullscreen();
    }
};

// Load the PDF
pdfjsLib.getDocument(url).promise.then((pdfDoc_) => {
    pdfDoc = pdfDoc_;
    totalPages = pdfDoc.numPages;
    pageCountEl.textContent = totalPages;
    renderPage(pageNum);
}).catch((error) => {
    console.error('Error loading PDF:', error);
});

// Event listeners
prevPageBtn.addEventListener('click', showPrevPage);
nextPageBtn.addEventListener('click', showNextPage);
zoomInBtn.addEventListener('click', zoomIn);
zoomOutBtn.addEventListener('click', zoomOut);
resetZoomBtn.addEventListener('click', resetZoom);
fullScreenBtn.addEventListener('click', toggleFullscreen);

// Input Page Change
pageInput.addEventListener('change', (e) => {
    const pageNumber = parseInt(e.target.value);
    if (pageNumber >= 1 && pageNumber <= totalPages) {
        pageNum = pageNumber;
        queueRenderPage(pageNum);
    }
});

// Scroll Zoom with Ctrl + Scroll (Desktop)
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

// Touch Zoom (Pinch Gesture) for mobile devices
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
