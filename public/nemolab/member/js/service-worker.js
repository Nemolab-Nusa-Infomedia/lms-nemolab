
//BUAT CACHE FILE STATIS

const CACHE_NAME = 'ebook-cache-v1';
// const MAX_CACHE_FILES = 50;
// berisi file statis yang bisa dicache
const STATIC_FILES_TO_CACHE = [
    '/nemolab/member/css/ebook.css',
    '/nemolab/member/js/ebook.js',
    '/nemolab/member/img/zoomin.png',
    '/nemolab/member/img/zoomout.png',
    '/nemolab/member/img/reset.png',
    '/nemolab/member/img/fullscreen.png',
    '/nemolab/member/img/chevron-left-white.png',
    '/nemolab/member/img/chevron-right-white.png',
];

// Install event
self.addEventListener('install', (event) => {
    // console.log('[Service Worker] Install event');
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            // console.log('[Service Worker] Caching static files');
            return cache.addAll(STATIC_FILES_TO_CACHE);
        }).catch((error) => {
            console.error('[Service Worker] Failed to cache static files:', error);
        })
    );
    self.skipWaiting();
});

// Activate event
self.addEventListener('activate', (event) => {
    // console.log('[Service Worker] Activate event');
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (!cacheWhitelist.includes(cacheName)) {
                        // console.log('[Service Worker] Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => {
            // console.log('[Service Worker] Activation complete');
        })
    );
    self.clients.claim();
});

// Fetch event
self.addEventListener('fetch', (event) => {
    const requestUrl = new URL(event.request.url);

    if (requestUrl.pathname.startsWith('/storage/pdfs/')) {
        event.respondWith(
            caches.open(CACHE_NAME).then((cache) => {
                return cache.match(event.request).then((cachedResponse) => {
                    if (cachedResponse) {
                        return cachedResponse;
                    }
                    return fetch(event.request).then((networkResponse) => {
                        if (networkResponse && networkResponse.status === 200) {
                            cache.put(event.request, networkResponse.clone());
                        }
                        return networkResponse;
                    });
                });
            }).catch((error) => {
                console.error('[Service Worker] Fetch failed for PDF:', error);
                return new Response('PDF tidak dapat dimuat.', {
                    status: 500,
                    statusText: 'Internal Server Error',
                });
            })
        );
    } else {
        event.respondWith(
            caches.match(event.request).then((cachedResponse) => {
                return cachedResponse || fetch(event.request);
            })
        );
    }
});
