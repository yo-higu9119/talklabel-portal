<?php
	require_once dirname(__FILE__).'/../../../../common/inc/util/my_firebase_util.php';
	$firebaseUtil = new MyFirebaseUtil();
	if($firebaseUtil->isCanUsed()) {
?>
						<li class="contentsUnit" id="push-receive-btn-area" style="display:none;">
							<div class="pushNotificationBt linkBtm">
								<a href="#" id="push-receive-btn">-</a>
							</div>
						</li>
						<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-app.js"></script>
						<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-messaging.js"></script>
						<script src="<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/push/js/member-firebase-config.js"></script>
						<script src="<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/push/js/pwa-push.php<?php echo date("?YmdHis"); ?>"></script>
<?php
	}
?>
