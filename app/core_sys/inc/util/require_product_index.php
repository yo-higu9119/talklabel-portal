<?php
if(isset($_SESSION['tmpProductOrderKey'])){
	unset($_SESSION['tmpProductOrderKey']);
}

require_once dirname(__FILE__).'/../../../../common/inc/data/product.php';
$productData = new ProductData($session->getMemberName());
$productInfo = $productData->getInfoFromUrlKey($urlKey);
if($productInfo->id === 0
|| !$productInfo->isOpen) {
	header('HTTP/1.0 404 Not Found');
	exit();
}

require_once dirname(__FILE__).'/../../../../common/inc/data/product_applicant.php';
$productApplicantData = new ProductApplicantData($session->getMemberName());
$appInfo = $productApplicantData->getInfo($productInfo->id, $session->getMemberId());

$productApplyStatus = $productInfo->applyStatus($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId());
switch($productApplyStatus) {
	case 1:	//申込可
		if(!$productData->setViewCount($productInfo->id, $session)) {
			echo 'DBアクセスエラー';
			exit();
		}
		if($mode === 'buy'){
			/* セッションに一時保持 */
			$_SESSION['tmpProductOrderKey'] = $urlKey;
			//if($session->isLogin()){//ログイン済み
				header('Location: '.SYSTEM_TOP_URL.'product/order/index.php');
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
		if(!$productData->setViewCount($productInfo->id, $session)) {
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