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

require_once dirname(__FILE__).'/../../../../../common/inc/data/product.php';
$productData = new ProductData($session->getMemberName());
$searchInfoList = array();
$searchInfoList['search_x_is_open'] = true;
$searchInfoList['search_x_ignore_all'] = true;

if(!$session->isLogin()){
	$permission_type = 1;
	$searchInfoList['search_x_permission'] = array('type'=>$permission_type);
}else{
	$PurchasedList = $session->getMemberPurchased();
	if(count($PurchasedList) > 0){
		$permission_type = 3;
		$permission_item = implode(',', $PurchasedList);
		$searchInfoList['search_x_permission'] = array('type'=>$permission_type,'item'=>$permission_item);
	}else{
		$permission_type = 2;
		$searchInfoList['search_x_permission'] = array('type'=>$permission_type);
	}
}

if($productCategoryId > 0) {
	$searchInfoList['search_x_category_id'] = $productCategoryId;
}
if($categoryGroupId > 0) {
	$searchInfoList['search_x_category_group_id'] = $categoryGroupId;
}
$searchInfoList['search_x_first_the_date_str'] = $firstDateStr;

$totalCnt = $productData->getCount($searchInfoList);
$pageMax = intval(ceil($totalCnt / $pageDispCntMax));
if($pageNo >= $pageMax) {
	$pageNo = $pageMax;
}
if($pageNo < 1) {
	$pageNo = 1;
}
$pageIndex = $pageNo-1;
$productInfoList = $productData->getInfoList($searchInfoList, 7, $pageDispCntMax*$pageIndex, $pageDispCntMax);

$listCnt = count($productInfoList);
$listDispCntMin = $pageIndex * $pageDispCntMax + 1;
if($listCnt < $pageIndex * $pageDispCntMax + $pageDispCntMax) {
	$listDispCntMax = $pageIndex * $pageDispCntMax + $listCnt - $pageIndex * $pageDispCntMax ;
}else{
	$listDispCntMax = $pageDispCntMax + $pageIndex * $pageDispCntMax ;
}

$addParam = '';
if($categoryInfo->id > 0) {
	$addParam .= '&c='.$categoryId;
}
if($productCategoryId > 0) {
	$addParam .= '&pc='.$productCategoryId;
}
?>
