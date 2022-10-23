<?php
$urlKey = (isset($_GET['s'])?$_GET['s']:'');
$categoryId = (isset($_GET['c'])?intval($_GET['c']):0);
$productCategoryId = (isset($_GET['pc'])?intval($_GET['pc']):0);
$mode = "";
if($urlKey === ""){
	$urlKey = (isset($_POST['s'])?$_POST['s']:'');
	$categoryId = (isset($_POST['c'])?intval($_POST['c']):0);
	$mode = "buy";
}

/***********************************************************
 * 商品情報・商品購入情報取得用require file
 ***********************************************************
 * 必須変数
 * $urlKey
 * $categoryId
 * $mode
 *---------------------------------------
 * 呼び出しファイル
 * common/inc/data/product.php
 * common/inc/data/product_applicant.php
 *---------------------------------------
 * 参照可能変数
 * 商品情報オブジェクト：$productInfo
 * 商品表示状態：$isDisp
 * 商品購入情報：$appInfo
 */
require_once dirname(__FILE__).'/../../../inc/util/require_product_index.php';

require_once dirname(__FILE__).'/../../../../../common/inc/data/product_category.php';
$categoryData = new ProductCategoryData($session->getMemberName());
$searchInfoList = array();
$searchInfoList['search_id'] = $productInfo->categoryList;
$categoryInfoList = $categoryData->getInfoList($searchInfoList, 3);
if(count($categoryInfoList) > 0){
	$categoryInfo = reset($categoryInfoList);
	$categoryName = $categoryInfo->name;
	$categoryNo = $categoryInfo->dispNo;
}else{
	$categoryName = "";
	$categoryNo = 0;
}

//パンくず
$breadcrumbList = $categoryData->getBreadcrumbListToCategory($productCategoryId);

?>
