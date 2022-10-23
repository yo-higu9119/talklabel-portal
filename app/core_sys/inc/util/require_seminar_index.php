<?php
if(isset($_SESSION['tmpSeminarOrderKey'])){
	unset($_SESSION['tmpSeminarOrderKey']);
}

require_once dirname(__FILE__).'/../../../../common/inc/data/seminar.php';
$seminarData = new SeminarData($session->getMemberName());
$seminarInfo = $seminarData->getInfoFromUrlKey($urlKey);
if($seminarInfo->id === 0
|| !$seminarInfo->isOpen) {
	header('HTTP/1.0 404 Not Found');
	exit();
}

require_once dirname(__FILE__).'/../../../../common/inc/data/seminar_applicant.php';
$seminarApplicantData = new SeminarApplicantData($session->getMemberName());
$appInfo = $seminarApplicantData->getInfo($seminarInfo->id, $session->getMemberId());

$seminarApplyStatus = $seminarInfo->applyStatus($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId());
switch($seminarApplyStatus) {
	case 1:	//申込可
		if(!$seminarData->setViewCount($seminarInfo->id, $session)) {
			echo 'DBアクセスエラー';
			exit();
		}
		if($mode === 'buy'){
			/* セッションに一時保持 */
			$_SESSION['tmpSeminarOrderKey'] = $urlKey;
			//if($session->isLogin()){//ログイン済み
				header('Location: '.SYSTEM_TOP_URL.'seminar/order/index.php');
				exit();
			//}else{//未ログイン
			//	header('Location: '.SYSTEM_TOP_URL.'users/login/index.php');
			//	exit();
			//}
		}
		break;
	case -1;	//受付期間外
	case -2:	//申込済み
	case -3:	//同一カテゴリ内別セミナー申込済
	case -4:	//表示のみ（申込不可）
		if(!$seminarData->setViewCount($seminarInfo->id, $session)) {
			echo 'DBアクセスエラー';
			exit();
		}
		break;
	default:
		header('HTTP/1.0 404 Not Found');
		exit();
		break;
}
?>