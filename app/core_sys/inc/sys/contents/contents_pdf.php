<?php
$urlKey = (isset($_GET['s'])?$_GET['s']:'');
$getFile = (isset($_GET['file'])?$_GET['file']:'');
require_once dirname(__FILE__).'/../../../../../common/inc/data/article.php';
$articleData = new ArticleData($session->getMemberName());
$info = $articleData->getInfoFromUrlKey($urlKey);

$getFile = str_replace("?i=","",strstr($getFile, '?i='));
if($info->id === 0
|| !$info->isOpen
|| $info->link_type !== 3
|| $info->site_url !== $getFile) {
	header('HTTP/1.0 404 Not Found');
	exit();
}

$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();

$isDisp = $info->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId());
if($isDisp) {
	if(!$articleData->setViewCount($info->id, $session)) {
		echo 'DBアクセスエラー';
		exit();
	}
}else{
	if($systemInfo->permission_article == 1){
		header('HTTP/1.0 404 Not Found');
		exit();
	}
}
?>
