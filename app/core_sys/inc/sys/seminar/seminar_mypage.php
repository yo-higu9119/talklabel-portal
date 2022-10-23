<?php
$urlKey = (isset($_GET['s'])?$_GET['s']:'');
$categoryId = (isset($_GET['c'])?intval($_GET['c']):0);
$mode = "";
if($urlKey === ""){
	$urlKey = (isset($_POST['s'])?$_POST['s']:'');
	$categoryId = (isset($_POST['c'])?intval($_POST['c']):0);
	$mode = "buy";
}

/***********************************************************
 * セミナー情報・セミナー申込情報取得用require file
 ***********************************************************
 * 必須変数
 * $urlKey
 * $categoryId
 * $mode
 *---------------------------------------
 * 呼び出しファイル
 * common/inc/data/seminar.php
 * common/inc/data/seminar_applicant.php
 *---------------------------------------
 * 参照可能変数
 * セミナー情報オブジェクト：$seminarInfo
 * セミナー表示状態：$isDisp
 * セミナー申込情報：$appInfo
 */
require_once dirname(__FILE__).'/../../../inc/util/require_seminar_index_mypage.php';

require_once dirname(__FILE__).'/../../../../../common/inc/data/seminar_category.php';
$categoryData = new SeminarCategoryData($session->getMemberName());
$searchInfoList = array();
$searchInfoList['search_id'] = $seminarInfo->categoryList;
$categoryInfoList = $categoryData->getInfoList($searchInfoList, 3);
if(count($categoryInfoList) === 1){
	$categoryInfo = reset($categoryInfoList);
	$categoryName = $categoryInfo->name;
	$categoryNo = $categoryInfo->dispNo;
}else{
	$categoryName = "";
	$categoryNo = 0;
}
?>
