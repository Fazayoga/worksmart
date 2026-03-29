self.addEventListener('install', (event) => {
  console.log('Service Worker: Installing...');
});

self.addEventListener('fetch', (event) => {
  // Pass-through fetch for basic PWA functionality
  event.respondWith(fetch(event.request));
});
