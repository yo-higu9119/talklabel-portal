<?php
$urlKey = (isset($_GET['s'])?$_GET['s']:'');
$categoryId = (isset($_GET['c'])?intval($_GET['c']):0);

unset($_SESSION['RespondCount']);

/*****************************************
 * 記事情報・パンくず取得用require file
 *****************************************
 * 必須変数
 * $urlKey
 * $categoryId
 *---------------------------------------
 * 呼び出しファイル
 * common/inc/data/article.php
 * common/inc/data/category.php
 *---------------------------------------
 * 参照可能変数
 * 記事情報オブジェクト：$info
 * 記事表示状態：$isDisp
 * パンくず配列：$breadcrumbList
 */
require_once dirname(__FILE__).'/../../../../core_sys/inc/util/require_article_index.php';
$categoryInfo = $categoryData->getInfo($categoryId);
$categoryGroupId = $categoryInfo->categoryGroupId;
require_once dirname(__FILE__).'/../../../../../common/inc/data/category.php';
$categoryData = new CategoryData($session->getMemberName());
/* タグリスト取得 */
$searchInfoList = array();
$searchInfoList['search_parent_category_id'] = -2;
$searchInfoList['search_id'] = $info->categoryList;

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
/* タグリスト取得 */
/* カテゴリリスト取得 */
$searchInfoList = array();
$searchInfoList['search_not_parent_category_id'] = -2;
$searchInfoList['search_id'] = $info->categoryList;

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

$categoryInfoList2 = $categoryData->getInfoList($searchInfoList, 3);
/* カテゴリリスト取得 */
?>
