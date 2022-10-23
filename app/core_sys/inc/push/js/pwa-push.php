<?php
require_once dirname(__FILE__).'/../../util/session.php';
$session = new Session(true);
?>
$(function() {
	if ('serviceWorker' in navigator && 'PushManager' in window) {
		// Firebase初期化
		firebase.initializeApp(firebaseConfig);

		// Firebase Messagingオブジェクトを取得します。
		const messaging = firebase.messaging();

		//コンソールから生成された公開鍵を追加
		messaging.usePublicVapidKey(firebasePublicVapidKey);

		function registToken(token) {
			$.ajax({
				 'url': '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/push/php/token_set.php'
				,'cache': false
				,'type': 'POST'
				,'data': {'token': token}
				,'error': function(XMLHttpRequest, textStatus, errorThrown) {
					alert('<?php echo Util::dispLang(Language::WORD_00608);/*セッションが切断された可能性があります。ログインしなおして下さい。*/?>');
					console.log('set<?php echo Util::dispLang(Language::WORD_00609);/*リクエストエラー*/?>[XMLHttpRequest:'+XMLHttpRequest.status+'][textStatus:'+textStatus+'][errorThrown:'+errorThrown.message+']');
				}
				, beforeSend: function(xhr){
					xhr.overrideMimeType("text/html;charset=UTF-8");
				 }
				,'success': function(data) {
					if(data.result==1) {
						$('#push-receive-btn-area').show();
						$('#push-receive-btn').removeClass('is-disable').addClass('push-receiving').text('<?php echo Util::dispLang(Language::WORD_00606);/*PUSH通知を受け取らない設定にする*/?>');
						fmcSubscribe('granted');
					} else {
						alert('<?php echo Util::dispLang(Language::WORD_00607);/*通知設定に失敗しました。ブラウザの通知設定を「確認」に戻して設定しなおして下さい。*/?>');
						console.log(data.result);
					}
					isClicked = false;
				}
				,'dataType':'json'
			});
		}

		var isClicked = false;

		var nowToken = null;
		function setTokenToServer(token) {
			console.log(token);
			if(nowToken == token) {
				return;
			} else if(nowToken != null) {
				// 自システム(Appサーバー)から旧token削除など
				$.ajax({
					 'url': '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/push/php/token_del.php'
					,'cache': false
					,'type': 'POST'
					,'data': {'token': nowToken}
					,'error': function(XMLHttpRequest, textStatus, errorThrown) {
						alert('<?php echo Util::dispLang(Language::WORD_00608);/*セッションが切断された可能性があります。ログインしなおして下さい。*/?>');
						console.log('del<?php echo Util::dispLang(Language::WORD_00609);/*リクエストエラー*/?>[XMLHttpRequest:'+XMLHttpRequest.status+'][textStatus:'+textStatus+'][errorThrown:'+errorThrown.message+']');
					}
					, beforeSend: function(xhr){
						xhr.overrideMimeType("text/html;charset=UTF-8");
					 }
					,'success': function(data) {
						if(data.result==1) {
							registToken(token);
						} else {
							alert('<?php echo Util::dispLang(Language::WORD_00610);/*サーバーエラー*/?>2');
							console.log(data.result);
							isClicked = false;
						}
					}
					,'dataType':'json'
				});
			} else {
				$('.disp-token').text(token);
				fmcSubscribe('granted');

				nowToken = token;

				registToken(token);
			}
		}

		function delTokenFromServer() {
			if(nowToken) {
				// 自システム(Appサーバー)からtoken削除など
				$.ajax({
					 'url': '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/push/php/token_del.php'
					,'cache': false
					,'type': 'POST'
					,'data': {'token': nowToken}
					,'error': function(XMLHttpRequest, textStatus, errorThrown) {
						alert('<?php echo Util::dispLang(Language::WORD_00608);/*セッションが切断された可能性があります。ログインしなおして下さい。*/?>');
						console.log('del<?php echo Util::dispLang(Language::WORD_00609);/*リクエストエラー*/?>[XMLHttpRequest:'+XMLHttpRequest.status+'][textStatus:'+textStatus+'][errorThrown:'+errorThrown.message+']');
					}
					, beforeSend: function(xhr){
						xhr.overrideMimeType("text/html;charset=UTF-8");
					 }
					,'success': function(data) {
						if(data.result==1) {
						} else {
							alert('<?php echo Util::dispLang(Language::WORD_00610);/*サーバーエラー*/?>3');
							console.log(data.result);
						}
						isClicked = false;
					}
					,'dataType':'json'
				});

				messaging.deleteToken(nowToken);
				nowToken = null;
			}
			fmcSubscribe('default');
			$('#push-receive-btn-area').show();
			$('#push-receive-btn').removeClass('is-disable push-receiving').text('PUSH通知を受け取る設定にする');
			isClicked = false;
		}

		var isSend = false;
		function checkPermissionpermission(permission) {
			if(!isSend) {
				isSend = true;
				switch (permission) {
					case 'granted': // 許可された場合、トークン取得
						messaging.getToken()
							.then(function(currentToken) {
								if(currentToken) {
									setTokenToServer(currentToken);
									fmcSubscribe('granted');
								} else {
									$('#fmcsub').removeClass('granted').addClass('denied').removeClass('default')
									console.log('<?php echo Util::dispLang(Language::WORD_00611);/*使用可能なインスタンスIDトークンはありません。 生成する許可を要求します。*/?>');
								}
								isSend = false;
							})
							.catch(function(err) {
								console.log('<?php echo Util::dispLang(Language::WORD_00612);/*トークンの取得中にエラーが発生しました。*/?>', err);
								isSend = false;
							});
						break;
					case 'denied':	// ブロックされた場合
						$('#push-receive-btn-area').show();
						$('#push-receive-btn').removeClass('is-disable push-receiving').text('<?php echo Util::dispLang(Language::WORD_00614);/*PUSH通知を受け取る設定にする*/?>');
						fmcSubscribe('denied');
						alert('<?php echo Util::dispLang(Language::WORD_00613);/*ブラウザの設定で通知がブロックされています。設定を変更して下さい。*/?>');
						isSend = false;
						break;
					case 'default':	// 無視された場合
					default:
						$('#push-receive-btn-area').show();
						$('#push-receive-btn').removeClass('is-disable push-receiving').text('<?php echo Util::dispLang(Language::WORD_00614);/*PUSH通知を受け取る設定にする*/?>');
						isSend = false;
						fmcSubscribe('default');
						break;
				}
			}
		}

		// サービスワーカーの登録
		navigator.serviceWorker.register('<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/push/js/sw.js').then(function(registration) {
			// サービスワーカー登録成功
			console.log('<?php echo Util::dispLang(Language::WORD_00615);/*サービスワーカー登録成功*/?> scope: ', registration.scope);
			// サービスワーカーを指定
			messaging.useServiceWorker(registration);

			//トークンが更新された通知
			messaging.onTokenRefresh(function() {
				console.log('<?php echo Util::dispLang(Language::WORD_00616);/*トークンの更新が通知されました。*/?>');
				this.messaging.getToken().then(function(refreshedToken) {
					setTokenToServer(refreshedToken);
				}).catch(function(err) {
					console.log('<?php echo Util::dispLang(Language::WORD_00617);/*更新されたトークンの取得中にエラーが発生しました。*/?>', err);
				});
			});

			//ブラウザ起動時の受信。SWでは設定できない。
			messaging.onMessage(function(payload) {
				console.log('onMessage:Message received. ', payload);

				var options = {
					 //body: payload.data.body
					 body: payload.notification.body
					,icon: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/push/images/icon-192x192.png'
				};
				//if(payload.fcmOptions && payload.fcmOptions.link) {
				if(payload.notification.click_action!='') {
					//options['data'] = payload.fcmOptions && payload.fcmOptions.link;
					options['data'] = payload.notification.click_action;
				}

				//registration.showNotification(payload.data.title, options);
				registration.showNotification(payload.notification.title, options);
			});


			//現在の通知状態チェック
			switch (Notification.permission) {
			case 'granted': // 許可された場合、自システム(Appサーバー)のtoken登録状況チェック
				messaging.getToken().then(function(currentToken) {
					if(currentToken) {
						$.ajax({
							 'url': '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/push/php/token_check.php'
							,'cache': false
							,'type': 'POST'
							,'data': {'token': currentToken}
							,'error': function(XMLHttpRequest, textStatus, errorThrown) {
								alert('<?php echo Util::dispLang(Language::WORD_00608);/*セッションが切断された可能性があります。ログインしなおして下さい。*/?>');
								console.log('check<?php echo Util::dispLang(Language::WORD_00609);/*リクエストエラー*/?>[XMLHttpRequest:'+XMLHttpRequest.status+'][textStatus:'+textStatus+'][errorThrown:'+errorThrown.message+']');
							}
							, beforeSend: function(xhr){
								xhr.overrideMimeType("text/html;charset=UTF-8");
							}
							,'success': function(data) {
								if(data.result==1) {
									nowToken = currentToken;
									$('#push-receive-btn').addClass('push-receiving').text('<?php echo Util::dispLang(Language::WORD_00618);/*PUSH通知を受け取らない設定にする*/?>');
									fmcSubscribe('granted');
								} else {
									$('#push-receive-btn').removeClass('push-receiving').text('<?php echo Util::dispLang(Language::WORD_00614);/*PUSH通知を受け取る設定にする*/?>');
									fmcSubscribe('default');
								}
								$('#push-receive-btn').removeClass('is-disable');
								$('#push-receive-btn-area').show();
							}
							,'dataType':'json'
						});
					} else {
						console.log('<?php echo Util::dispLang(Language::WORD_00619);/*使用可能なインスタンスIDトークンはありません。生成する許可を要求します。*/?>');
					}
				})
				.catch(function(err) {
					console.log('<?php echo Util::dispLang(Language::WORD_00612);/*トークンの取得中にエラーが発生しました。*/?>', err);
				});
				break;
			case 'denied':	// ブロックされた場合
					fmcSubscribe('denied');
					break;
			case 'default':	// 無視された場合
			default:
					fmcSubscribe('default');
				$('#push-receive-btn-area').show();
				$('#push-receive-btn').removeClass('is-disable push-receiving').text('<?php echo Util::dispLang(Language::WORD_00614);/*PUSH通知を受け取る設定にする*/?>');
				break;
			}

			$('#push-receive-btn').on('click', function() {
				if(!isClicked) {
					isClicked = true;
					if($('#push-receive-btn').hasClass('push-receiving')) {
						if(window.confirm('<?php echo Util::dispLang(Language::WORD_00620);/*通知の受け取りを停止しますか？*/?>')) {
							$('#push-receive-btn').addClass('is-disable');
							delTokenFromServer();
						} else {
							isClicked = false;
						}
					} else {
						if(window.confirm('<?php echo Util::dispLang(Language::WORD_00621);/*通知を受け取りますか？*/?>')) {
							$('#push-receive-btn').addClass('is-disable');
							// messaging.requestPermission() は非推奨
							//ブラウザの通知設定チェック
							Notification.requestPermission().then(function(permission) {
								checkPermissionpermission(permission);
								isClicked = false;
							});
						} else {
							isClicked = false;
						}
					}
				}
				return false;
			});
		}).catch(function(err) {
			// サービスワーカー登録失敗
			console.log('ServiceWorker <?php echo Util::dispLang(Language::WORD_00622);/*登録失敗*/?>: ', err);
		});
	} else {
		console.log('<?php echo Util::dispLang(Language::WORD_00623);/*Pushは利用できません。*/?>');
		fmcSubscribe('disable');
	}
	function fmcSubscribe(result){
console.log(result);
		if(result == 'granted'){
			$('#fmcsub').addClass('granted').removeClass('denied').removeClass('default');
			$('#fmctxt').text('<?php echo Util::dispLang(Language::WORD_00624);/*通知は有効です*/?>');
		}else if(result == 'denied'){
			$('#fmcsub').removeClass('granted').addClass('denied').removeClass('default');
			$('#fmctxt').text('<?php echo Util::dispLang(Language::WORD_00625);/*通知はブロック中です*/?>');
		}else if(result == 'default'){
			$('#fmcsub').removeClass('granted').removeClass('denied').addClass('default');
			$('#fmctxt').text('<?php echo Util::dispLang(Language::WORD_00626);/*通知は無効です*/?>');
		}else if(result == 'disallow'){
			$('#fmcsub').removeClass('granted').addClass('denied').removeClass('default');
			$('#fmctxt').text('<?php echo Util::dispLang(Language::WORD_00627);/*通知は利用きないブラウザです*/?>');
		}else if(result == 'disable'){
			$('#fmcsub').removeClass('granted').addClass('denied').removeClass('default');
			$('#fmctxt').text('<?php echo Util::dispLang(Language::WORD_00628);/*通知は利用できません*/?>');
		}
	}
});