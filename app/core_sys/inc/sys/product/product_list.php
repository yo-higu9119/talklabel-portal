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

require_once dirname(__FILE__).'/../../../../../common/inc/data/product_category.php';
$productCategoryData = new ProductCategoryData($session->getMemberName());
$productCategoryInfo = $productCategoryData->getInfo($productCategoryId);
if($productCategoryInfo->id > 0 && !$productCategoryInfo->isDisp) {
	$productCategoryInfo = new ProductCategoryInfo();
	$productCategoryId = 0;
}

/* 商品リスト抽出処理は記事一覧表示に移動 */

$searchInfoList['search_x_first_the_date_str'] = $firstDateStr;

$addParam = '';
if($categoryInfo->id > 0) {
	$addParam .= '&c='.$categoryId;
}
if($productCategoryId > 0) {
	$addParam .= '&pc='.$productCategoryId;
}

//パンくず
$breadcrumbList = $productCategoryData->getBreadcrumbListToCategory($productCategoryId);

?>
