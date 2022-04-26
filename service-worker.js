const cache_ver = 'v1'

self.addEventListener('install', event => {
	event.waitUntil(caches.open(cache_ver).then(cache => {
		return cache.addAll([
			'/site/style/font/DroidNaskh-Regular.woff2',
			'/service-worker.js'
		])
	}))
})

self.addEventListener('activate', event => {
	const cacheWhitelist = [cache_ver]
	event.waitUntil(caches.keys().then(keyList => {
		return Promise.all(keyList.map(key => {
			if(cacheWhitelist.indexOf(key) === -1)
				return caches.delete(key)
		}))
	}))
})

self.addEventListener('fetch', event => {
	event.respondWith(caches.match(event.request).then(resp => {
		return resp || fetch(event.request).then(_ => _)
	}).catch(() => ''))
})
