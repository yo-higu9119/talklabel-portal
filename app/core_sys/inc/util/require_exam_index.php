<?php
if(isset($_SESSION['tmpSeminarOrderKey'])){
	unset($_SESSION['tmpSeminarOrderKey']);
}

require_once dirname(__FILE__).'/../../../../common/inc/data/seminar.php';
$seminarData = new SeminarData($session->getMemberName());
$info = $seminarData->getInfoFromUrlKey($urlKey);
if($info->id === 0
|| !$info->isOpen) {
	header('HTTP/1.0 404 Not Found');
	exit();
}

require_once dirname(__FILE__).'/../../../../common/inc/data/seminar_applicant.php';
$seminarApplicantData = new SeminarApplicantData($session->getMemberName());
$appInfo = $seminarApplicantData->getInfo($info->id, $session->getMemberId());

$seminarApplyStatus = $info->applyStatus($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId());
switch($seminarApplyStatus) {
	case 1:	//申込可
		if(!$seminarData->setViewCount($info->id, $session)) {
			echo 'DBアクセスエラー';
			exit();
		}
		if($mode === 'buy'){
			/* セッションに一時保持 */
			$_SESSION['tmpSeminarOrderKey'] = $urlKey;
			//if($session->isLogin()){//ログイン済み
				header('Location: '.SYSTEM_TOP_URL.'course/lec_elm_exam_order/index.php');
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
		if(!$seminarData->setViewCount($info->id, $session)) {
			echo 'DBアクセスエラー';
			exit();
		}
}
?>