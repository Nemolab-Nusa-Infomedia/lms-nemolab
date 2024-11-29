// 1. Pengaturan global dan elemen utama
pdfjsLib.GlobalWorkerOptions.workerSrc = '/nemolab/member/js/pdf.worker.min.js';
const ebookElement = document.getElementById('ebook');
const url = ebookElement.getAttribute('data-pdf');
const canvas = document.getElementById('pdf-render');
const ctx = canvas.getContext('2d');

let pdfDoc = null;
let pageNum = 1;
let scale = window.innerWidth < 768 ? 0.7 : 1.8;
const minScale = window.innerWidth < 768 ? 0.7 : 0.9;
const maxScale = 2.5;
let totalPages = 0;
let isRendering = false;

// 2. Pengambilan dokumen PDF// 2. Pengambilan dokumen PDF
pdfjsLib.getDocument(url).promise.then(pdf => {
    console.log('PDF berhasil dimuat');
    pdfDoc = pdf;
    totalPages = pdf.numPages;
    console.log(`Menampilkan ${totalPages} halaman`);
    renderPage(pageNum);
}).catch(error => {
    console.error('Error loading PDF:', error);
    // alert('Gagal memuat eBook. Periksa koneksi atau matikan ekstensi browser anda.');
    console.log(`Total halaman PDF: ${totalPages}`);
});

// 3. Fungsi untuk rendering halaman
const renderPage = (num) => {
    if (isRendering) return;
    isRendering = true;

    const pdfHeightElement = document.querySelector('.pdf-height');
    if (window.innerWidth < 768) { 
        pdfHeightElement.style.height = '760px';
    } else {
        pdfHeightElement.style.height = '100vh';
    }
    document.getElementById('pdf-loading').style.display = 'block';
    canvas.style.display = 'none';

    pdfDoc.getPage(num).then((page) => {
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
        document.getElementById('page-input').value = num;
        document.getElementById('page-count').textContent = totalPages;
    }).catch(error => {
        alert('Failed to load the page.');
    }).finally(() => {
        isRendering = false;
        document.getElementById('pdf-loading').style.display = 'none';
        canvas.style.display = 'block';
        pdfHeightElement.style.height = 'auto';
    });
};



// 4. Zoom dan scale
const updateZoom = (factor) => {
    if (factor === 0) {
        scale = window.innerWidth < 768 ? 0.7 : 1.8;
    } else {
        scale = Math.max(minScale, Math.min(maxScale, scale + factor));
    }
    console.log('Current scale:', scale);
    
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

// Event listeners untuk tombol panah dan fullscreen dengan keyboard
document.addEventListener('keydown', (e) => {
    // Left arrow for previous page
    if (e.key === 'ArrowLeft') {
        if (pageNum > 1) {
            pageNum--;
            renderPage(pageNum);
        }
    }
    // Right arrow for next page
    else if (e.key === 'ArrowRight') {
        if (pageNum < totalPages) {
            pageNum++;
            renderPage(pageNum);
        }
    }
    // 'F' for fullscreen toggle
    else if (e.key.toLowerCase() === 'f') {
        const elem = document.getElementById('ebook');
        if (!document.fullscreenElement) {
            elem.requestFullscreen().catch(err => console.error(`Fullscreen mode error: ${err.message}`));
        } else {
            document.exitFullscreen();
        }
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