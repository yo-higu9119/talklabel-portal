/*
 * A2HSで最低限必要。中は空でも動作。
 */
self.addEventListener('fetch', function(e) {
});

/*
 * Firebase Cloud Messaging(Web push)関連
 */
// Firebase SDK インポート
importScripts('https://www.gstatic.com/firebasejs/7.14.4/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.14.4/firebase-messaging.js');

// Firebase設定ファイル読み込み
importScripts('/core_sys/inc/push/js/member-firebase-config.js');

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

// 通知がクリックされた場合の動作
self.addEventListener('notificationclick', function(event) {
	console.log('[sw.js] notificationclick ', event);

	event.notification.close();

	//[event.notification.data]をurlとして利用
	console.log('[sw.js] Received background message url ', event.notification.data);
	if (event.notification.data && event.notification.data!='') {
		//urlがあればクリック時、そのurlを開く
		event.waitUntil(clients.openWindow(event.notification.data));
	}
});

//バックグラウンドで受信
messaging.setBackgroundMessageHandler(function(payload) {
	console.log('[sw.js] Received background message ', payload);

	var options = {
		 //body: payload.data.body
		 body: payload.notification.body
		,icon: '/core_sys/inc/push/images/icon-192x192.png'
	};
	//if(payload.fcmOptions && payload.fcmOptions.link) {
	if(payload.notification.click_action!='') {
		//options['data'] = payload.fcmOptions && payload.fcmOptions.link;
		options['data'] = payload.notification.click_action;
	}

	return self.registration.showNotification(payload.notification.title, options);
});


