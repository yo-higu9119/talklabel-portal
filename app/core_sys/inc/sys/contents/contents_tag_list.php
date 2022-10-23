<?php
require_once dirname(__FILE__).'/../../../../../common/inc/data/category.php';
$categoryData = new CategoryData($session->getMemberName());
$categoryInfo = $categoryData->getInfo($categoryId);
if($categoryInfo->id > 0 && (!$categoryInfo->isDisp || !$categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId()))) {
	//$categoryInfo = new CategoryInfo();
	//$categoryId = 0;
	header('Location: '.SYSTEM_TOP_URL.'core_sys/error/no_page.php');
	exit();
}

/* コンテンツリスト抽出処理は記事一覧表示に移動 */

$searchInfoList = array();
$searchInfoList['search_parent_category_id'] = -2;

$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();
if($systemInfo->use_authority_group == 1){
	$searchInfoList['search_x_view_authority'] = $session->getMemberId();
}
if($systemInfo->use_language == 1){
	$StrToNumList = CorebloLanguage::getStrToNumList();
	if(isset($_SESSION['app_language'])){
		$langKey = $_SESSION['app_language'];
		$langId = array_key_exists($langKey,$StrToNumList)?$StrToNumList[$langKey]:0;
	}else{
		$langId = 0;
	}
	$searchInfoList['search_x_view_language'] = $langId;
}

$categoryInfoList = $categoryData->getInfoList($searchInfoList, 3);

$addParam = '';
if($categoryInfo->id > 0) {
	$addParam = '&c='.$categoryId;
}

//パンくず
$breadcrumbList = $categoryData->getBreadcrumbListToCategory($categoryId);
?>
