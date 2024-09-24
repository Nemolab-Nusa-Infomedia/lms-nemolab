if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/nemolab/member/js/service-worker.js')
            .catch((error) => console.error('ServiceWorker registration failed:', error));
    });
}

// Set workerSrc ke path yang benar
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.worker.min.js';

// Ambil nama PDF dari atribut data
const ebookElement = document.getElementById('ebook');
const pdfFilename = ebookElement.getAttribute('data-pdf');
const url = `/storage/pdfs/${encodeURIComponent(pdfFilename)}`;
const canvas = document.getElementById('pdf-render');
const ctx = canvas.getContext('2d');

let pdfDoc = null;
let pageNum = 1;
let scale = 1.6;
const minScale = 1; 
const maxScale = 2.5;
let totalPages = 0;

let isRendering = false;
const renderPage = (num) => {
    if (isRendering) return;
    isRendering = true;
    pdfDoc.getPage(num).then((page) => {
        const viewport = page.getViewport({ scale });
        canvas.height = viewport.height;
        canvas.width = viewport.width;
        return page.render({ canvasContext: ctx, viewport }).promise;
    }).then(() => {
        document.getElementById('page-input').value = num;
        document.getElementById('page-count').textContent = totalPages;
    }).catch(error => {
        console.error('Error rendering page:', error);
        alert('Gagal memuat halaman. Silakan coba lagi.');
    }).finally(() => {
        isRendering = false;
    });
};

pdfjsLib.getDocument(url).promise.then(pdf => {
    pdfDoc = pdf;
    totalPages = pdf.numPages;
    renderPage(pageNum);
}).catch(error => {
    console.error('Error loading PDF:', error);
    alert('Gagal memuat PDF. Silakan coba lagi.');
});

// Event Listeners
document.getElementById('prev-page').addEventListener('click', () => {
    if (pageNum > 1) {
        pageNum--;
        renderPage(pageNum);
    }
});
document.getElementById('next-page').addEventListener('click', () => {
    if (pageNum < totalPages) {
        pageNum++;
        renderPage(pageNum);
    }
});
document.getElementById('zoom-in').addEventListener('click', () => {
    if (scale < maxScale) {
        scale += 0.1;
        renderPage(pageNum);
    }
});
document.getElementById('zoom-out').addEventListener('click', () => {
    if (scale > minScale) {
        scale -= 0.1;
        renderPage(pageNum);
    }
});
document.getElementById('reset-zoom').addEventListener('click', () => {
    scale = 1.6;
    renderPage(pageNum);
});
document.getElementById('pdf-fullscreen').addEventListener('click', () => {
    const elem = document.getElementById('ebook');
    if (!document.fullscreenElement) {
        elem.requestFullscreen().catch(err => console.error(`Error attempting to enable full-screen mode: ${err.message}`));
    } else {
        document.exitFullscreen();
    }
});
document.getElementById('page-input').addEventListener('change', (e) => {
    const pageNumber = parseInt(e.target.value);
    if (pageNumber >= 1 && pageNumber <= totalPages) {
        pageNum = pageNumber;
        renderPage(pageNum);
    }
});

// Zoom with scroll + Ctrl (Desktop)
canvas.addEventListener('wheel', (e) => {
    if (e.ctrlKey) {
        e.preventDefault();
        scale += e.deltaY < 0 ? 0.1 : -0.1;
        scale = Math.max(minScale, Math.min(maxScale, scale));
        
        renderPage(pageNum);
    }
});


// Zoom with pinch (Mobile)
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
    if (e.touches.length === 2 && initialDistance) {
        const newDistance = Math.hypot(
            e.touches[0].pageX - e.touches[1].pageX,
            e.touches[0].pageY - e.touches[1].pageY
        );
        scale += newDistance > initialDistance ? 0.1 : -0.1;
        scale = Math.max(0.5, scale);
        renderPage(pageNum);
        initialDistance = newDistance;
    }
});

canvas.addEventListener('touchend', () => {
    initialDistance = null;
});
