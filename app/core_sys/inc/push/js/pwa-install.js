var defferedPrompt = null;
window.addEventListener('beforeinstallprompt', function(event) {
	console.log('beforeinstallprompt');
	event.preventDefault();
	defferedPrompt = event;
	$('#pwa-install').show();
	return false;
});
$(function() {
	//インストールしたもので表示している場合
	if (window.matchMedia('(display-mode: standalone)').matches
	|| window.navigator.standalone) {
		console.log('appinstalled');
		$('#pwa-install').hide();
	}

	if('https:' != document.location.protocol) {
		console.log('httpsでのアクセスが必要です。');
	} else if('serviceWorker' in navigator) {
		navigator.serviceWorker.register('./sw.js')
			.then((reg) => {
				console.log('Service worker registered.', reg);
			});

		// イベントを意図的に発火
		$('#pwa-install-btn').on('click', function() {
			console.log('pwaInstall Click.');
			if (defferedPrompt) {
				defferedPrompt.prompt();
				defferedPrompt.userChoice.then(function(choiceResult) {
					if (choiceResult.outcome === 'dismissed') {
						console.log('pwaInstall Click.');
					} else {
						window.alert('インストールありがとうございます。');
						location.reload();
					}
				});
				defferedPrompt = null;
			} else {
				console.log('defferedPrompt null');
			}
		});
	} else {
		console.log('実行できない環境です');
	}
});