<?php
$message = '';
if(isset($_POST['mailaddress'])) {
	if(strlen($_POST['mailaddress']) <= 250 && preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['mailaddress']) === 1) {
		$memberId = $session->createReminderSession($_POST['mailaddress']);
		if($memberId > 0) {
			require_once dirname(__FILE__).'/../../../../../common/inc/data/tmp_password.php';
			$tmpPasswordData = new TmpPasswordData('');
			$tmpPasswordInfo = $tmpPasswordData->createAndGetInfo($memberId);
			if($tmpPasswordInfo->memberId > 0) {
				require_once dirname(__FILE__).'/../../../../../common/inc/util/my_mail_util.php';
				$myMailUtil = new MyMailUtil();
				$result = $myMailUtil->send(2, $tmpPasswordInfo);
				if($result > 0) {
					header('Location: ./sent.php');
					exit();
				} else {
					$message = 'メールの送信に失敗しました。('.$result.')';
				}
			} else {
				$message = '登録に失敗しました。';
			}
		} else {
			$message = '';
		}
	}else{
		$message = 'メールアドレスが正しくありません。';
	}
}
?>
