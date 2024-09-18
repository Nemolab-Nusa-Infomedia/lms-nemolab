const CACHE_NAME = 'ebook-cache-v1';
const FILES_TO_CACHE = [
    '/pdf-proxy',
    '/nemolab/member/css/ebook.css',
    '/nemolab/member/js/ebook.js',
];

// Install event
self.addEventListener('install', (event) => {
    console.log('[Service Worker] Install event');
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            console.log('[Service Worker] Caching files');
            return cache.addAll(FILES_TO_CACHE);
        }).catch((error) => {
            console.error('[Service Worker] Failed to cache files:', error);
        })
    );
});

// Activate event
self.addEventListener('activate', (event) => {
    console.log('[Service Worker] Activate event');
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (!cacheWhitelist.includes(cacheName)) {
                        console.log('[Service Worker] Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => {
            console.log('[Service Worker] Activation complete');
        })
    );
});

// Fetch event
self.addEventListener('fetch', (event) => {
    console.log('[Service Worker] Fetch event for:', event.request.url);
    event.respondWith(
        caches.match(event.request).then((response) => {
            if (response) {
                console.log('[Service Worker] Cache hit for:', event.request.url);
                return response;
            }
            console.log('[Service Worker] Cache miss for:', event.request.url);
            return fetch(event.request).then((response) => {
                if (!response || response.status !== 200 || response.type !== 'basic') {
                    return response;
                }
                const responseToCache = response.clone();
                caches.open(CACHE_NAME).then((cache) => {
                    cache.put(event.request, responseToCache);
                });
                return response;
            });
        }).catch((error) => {
            console.error('[Service Worker] Fetch failed:', error);
            throw error;
        })
    );
});
