// 1. Pengaturan global dan elemen utama
pdfjsLib.GlobalWorkerOptions.workerSrc = '/nemolab/member/js/pdf.worker.min.js';
const ebookElement = document.getElementById('ebook');
const url = ebookElement.getAttribute('data-pdf');
const canvas = document.getElementById('pdf-render');
const ctx = canvas.getContext('2d');

let pdfDoc = null;
let pageNum = 1;
let scale = window.innerWidth < 768 ? 0.8 : 1.8;
const minScale = 0.8;
const maxScale = 2.5;
let totalPages = 0;
let isRendering = false;

console.log(url); // Debugging URL

// 2. Pengambilan dokumen PDF// 2. Pengambilan dokumen PDF
pdfjsLib.getDocument(url).promise.then(pdf => {
    console.log('PDF berhasil dimuat:', url);
    pdfDoc = pdf;
    totalPages = pdf.numPages;
    console.log(`Total halaman PDF: ${totalPages}`);
    renderPage(pageNum);
}).catch(error => {
    console.error('Error loading PDF:', error);
    alert('Failed to load PDF.');
    console.log(`Total halaman PDF: ${totalPages}`);
});

// 3. Fungsi untuk rendering halaman
const renderPage = (num) => {
    if (isRendering) return;
    isRendering = true;

    console.log(`Rendering halaman ${num} dengan skala ${scale}`); // Log saat memulai rendering halaman

    document.getElementById('pdf-loading').style.display = 'block';
    canvas.style.display = 'none';

    pdfDoc.getPage(num).then((page) => {
        console.log(`Halaman ${num} berhasil diambil dari PDF.`); // Log jika halaman berhasil diambil
        const viewport = page.getViewport({ scale });
        const outputScale = window.devicePixelRatio || 1;

        canvas.width = Math.floor(viewport.width * outputScale);
        canvas.height = Math.floor(viewport.height * outputScale);
        canvas.style.width = `${viewport.width}px`;
        canvas.style.height = `${viewport.height}px`;

        const transform = outputScale !== 1 ? [outputScale, 0, 0, outputScale, 0, 0] : null;
        const renderContext = { canvasContext: ctx, viewport: viewport, transform: transform };

        return page.render(renderContext).promise;
    }).then(() => {
        console.log(`Halaman ${num} berhasil dirender.`); // Log jika rendering halaman berhasil
        document.getElementById('page-input').value = num;
        document.getElementById('page-count').textContent = totalPages;
    }).catch(error => {
        console.error(`Error rendering halaman ${num}:`, error); // Log jika ada error saat rendering halaman
        alert('Failed to load the page.');
    }).finally(() => {
        isRendering = false;
        document.getElementById('pdf-loading').style.display = 'none';
        canvas.style.display = 'block';
    });
};


// 4. Zoom dan scale
const updateZoom = (factor) => {
    if (factor === 0) {
        scale = window.innerWidth < 768 ? 0.8 : 1.6;
    } else {
        scale = Math.max(minScale, Math.min(maxScale, scale + factor));
    }
    renderPage(pageNum);
};

// 5. Event listeners untuk navigasi, zoom, dan input
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

document.getElementById('zoom-in').addEventListener('click', () => updateZoom(0.1));
document.getElementById('zoom-out').addEventListener('click', () => updateZoom(-0.1));
document.getElementById('reset-zoom').addEventListener('click', () => updateZoom(0));

document.getElementById('page-input').addEventListener('change', (e) => {
    const pageNumber = parseInt(e.target.value);
    if (pageNumber >= 1 && pageNumber <= totalPages) {
        pageNum = pageNumber;
        renderPage(pageNum);
    }
});

// Fungsi untuk fullscreen mode
document.getElementById('pdf-fullscreen').addEventListener('click', () => {
    const elem = document.getElementById('ebook');
    if (!document.fullscreenElement) {
        elem.requestFullscreen().catch(err => console.error(`Fullscreen mode error: ${err.message}`));
    } else {
        document.exitFullscreen();
    }
});

// 6. Pinch-to-zoom untuk perangkat mobile
let initialDistance = null;

const handleTouchStart = (e) => {
    if (e.touches.length === 2) {
        initialDistance = Math.hypot(
            e.touches[0].pageX - e.touches[1].pageX,
            e.touches[0].pageY - e.touches[1].pageY
        );
    }
};

const handleTouchMove = (e) => {
    if (e.touches.length === 2 && initialDistance) {
        const newDistance = Math.hypot(
            e.touches[0].pageX - e.touches[1].pageX,
            e.touches[0].pageY - e.touches[1].pageY
        );
        const zoomFactor = newDistance > initialDistance ? 0.05 : -0.05;
        updateZoom(zoomFactor);
        initialDistance = newDistance;
    }
};

const handleTouchEnd = () => {
    initialDistance = null;
};

canvas.addEventListener('touchstart', handleTouchStart);
canvas.addEventListener('touchmove', handleTouchMove);
canvas.addEventListener('touchend', handleTouchEnd);
