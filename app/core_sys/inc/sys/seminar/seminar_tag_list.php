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

require_once dirname(__FILE__).'/../../../../../common/inc/data/seminar_category.php';
$seminarCategoryData = new SeminarCategoryData($session->getMemberName());
$seminarCategoryInfo = $seminarCategoryData->getInfo($seminarCategoryId);
if($seminarCategoryInfo->id > 0 && !$seminarCategoryInfo->isDisp) {
	$seminarCategoryInfo = new SeminarCategoryInfo();
	$seminarCategoryId = 0;
}

/* セミナーリスト抽出処理は記事一覧表示に移動 */

$searchInfoList['search_x_first_the_date_str'] = $firstDateStr;

$addParam = '';
if($categoryInfo->id > 0) {
	$addParam .= '&c='.$categoryId;
}
if($seminarCategoryId > 0) {
	$addParam .= '&sc='.$seminarCategoryId;
}

//パンくず
$breadcrumbList = $seminarCategoryData->getBreadcrumbListToCategory($seminarCategoryId);
?>
