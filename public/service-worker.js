const CACHE_NAME = 'syncjornada-v1';
const STATIC_CACHE = 'syncjornada-static-v1';
const DYNAMIC_CACHE = 'syncjornada-dynamic-v1';

const STATIC_ASSETS = [
  '/',
  '/dashboard',
  '/css/app.css',
  '/js/app.js',
  '/images/logo/logo.svg',
  '/images/logo/logo-icon.svg',
  '/images/favicon.svg',
  'https://fonts.bunny.net/css?family=figtree:400,500,600',
  'https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap',
  'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css'
];

// Instalación del Service Worker
self.addEventListener('install', (event) => {
  console.log('[Service Worker] Instalando...');
  event.waitUntil(
    caches.open(STATIC_CACHE).then((cache) => {
      console.log('[Service Worker] Pre-cacheando recursos estáticos');
      return cache.addAll(STATIC_ASSETS.map(url => new Request(url, {credentials: 'same-origin'})))
        .catch(err => {
          console.error('[Service Worker] Error al cachear:', err);
        });
    })
  );
  self.skipWaiting();
});

// Activación del Service Worker
self.addEventListener('activate', (event) => {
  console.log('[Service Worker] Activando...');
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames
          .filter((cacheName) => {
            return cacheName !== STATIC_CACHE && cacheName !== DYNAMIC_CACHE;
          })
          .map((cacheName) => {
            console.log('[Service Worker] Eliminando caché antigua:', cacheName);
            return caches.delete(cacheName);
          })
      );
    })
  );
  return self.clients.claim();
});

// Estrategia de caché: Network First con fallback a Cache
self.addEventListener('fetch', (event) => {
  const { request } = event;
  const url = new URL(request.url);

  // Ignorar solicitudes no HTTP/HTTPS
  if (!request.url.startsWith('http')) {
    return;
  }

  // Ignorar solicitudes POST/PUT/DELETE (solo cachear GET)
  if (request.method !== 'GET') {
    return;
  }

  // Network First para rutas de la aplicación
  if (url.origin === location.origin) {
    event.respondWith(
      fetch(request)
        .then((response) => {
          // Solo cachear respuestas exitosas
          if (response.status === 200) {
            const responseClone = response.clone();
            caches.open(DYNAMIC_CACHE).then((cache) => {
              cache.put(request, responseClone);
            });
          }
          return response;
        })
        .catch(() => {
          // Si falla la red, intentar desde caché
          return caches.match(request).then((cachedResponse) => {
            if (cachedResponse) {
              return cachedResponse;
            }
            // Si no está en caché, mostrar página offline
            return caches.match('/offline.html');
          });
        })
    );
  } else {
    // Cache First para recursos externos (CDN)
    event.respondWith(
      caches.match(request).then((cachedResponse) => {
        if (cachedResponse) {
          return cachedResponse;
        }
        return fetch(request).then((response) => {
          if (response.status === 200) {
            const responseClone = response.clone();
            caches.open(STATIC_CACHE).then((cache) => {
              cache.put(request, responseClone);
            });
          }
          return response;
        });
      })
    );
  }
});

// Notificaciones Push
self.addEventListener('push', (event) => {
  console.log('[Service Worker] Push recibido:', event);
  
  let notificationData = {
    title: 'SyncJornada',
    body: 'Nueva notificación',
    icon: '/images/logo/logo-icon.svg',
    badge: '/images/logo/logo-icon.svg',
    vibrate: [200, 100, 200],
    tag: 'syncjornada-notification',
    requireInteraction: false
  };

  if (event.data) {
    const data = event.data.json();
    notificationData = {
      ...notificationData,
      ...data
    };
  }

  event.waitUntil(
    self.registration.showNotification(notificationData.title, {
      body: notificationData.body,
      icon: notificationData.icon,
      badge: notificationData.badge,
      vibrate: notificationData.vibrate,
      tag: notificationData.tag,
      requireInteraction: notificationData.requireInteraction,
      data: notificationData.data || {}
    })
  );
});

// Click en notificación
self.addEventListener('notificationclick', (event) => {
  console.log('[Service Worker] Click en notificación:', event);
  event.notification.close();

  event.waitUntil(
    clients.matchAll({ type: 'window', includeUncontrolled: true }).then((clientList) => {
      // Si ya hay una ventana abierta, enfocarla
      for (let i = 0; i < clientList.length; i++) {
        const client = clientList[i];
        if (client.url.includes(self.location.origin) && 'focus' in client) {
          return client.focus();
        }
      }
      // Si no hay ventana abierta, abrir una nueva
      if (clients.openWindow) {
        return clients.openWindow(event.notification.data.url || '/dashboard');
      }
    })
  );
});

// Sincronización en segundo plano
self.addEventListener('sync', (event) => {
  console.log('[Service Worker] Sincronización:', event.tag);
  
  if (event.tag === 'sync-time-entries') {
    event.waitUntil(
      // Aquí puedes sincronizar fichajes pendientes cuando se recupere la conexión
      syncPendingEntries()
    );
  }
});

async function syncPendingEntries() {
  // Implementar lógica de sincronización de fichajes offline
  console.log('[Service Worker] Sincronizando fichajes pendientes...');
  // TODO: Obtener fichajes pendientes del IndexedDB y enviarlos al servidor
}
