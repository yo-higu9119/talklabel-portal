<?php
require_once dirname(__FILE__).'/../../../../../common/inc/data/board_category.php';
$boardCategoryData = new CategoryData($session->getMemberName());
$boardCategoryInfo = $boardCategoryData->getInfo($boardCategoryId);
if($boardCategoryInfo->id > 0 && !$boardCategoryInfo->isDisp) {
	$boardCategoryInfo = new CategoryInfo();
	$boardCategoryId = 0;
}

require_once dirname(__FILE__).'/../../../../../common/inc/data/board.php';
$boardData = new BoardData($session->getMemberName());
$searchInfoList = array();
$searchInfoList['search_status'] = 1;
if($boardCategoryId > 0){
	$searchInfoList['search_x_category_id'] = $boardCategoryId;
}
if($boardCategoryGroupId > 0) {
	$searchInfoList['search_x_category_group_id'] = $boardCategoryGroupId;
}
$totalCnt = $boardData->getCount($searchInfoList);
$pageMax = intval(ceil($totalCnt / $pageDispCntMax));
if($pageNo >= $pageMax) {
	$pageNo = $pageMax;
}
if($pageNo < 1) {
	$pageNo = 1;
}
$pageIndex = $pageNo-1;
$boardInfoList = $boardData->getInfoList($searchInfoList, 3, $pageDispCntMax*$pageIndex, $pageDispCntMax);
$listCnt = count($boardInfoList);
$listDispCntMin = $pageIndex * $pageDispCntMax + 1;
if($listCnt < $pageIndex * $pageDispCntMax + $pageDispCntMax) {
	$listDispCntMax = $pageIndex * $pageDispCntMax + $listCnt - $pageIndex * $pageDispCntMax ;
}else{
	$listDispCntMax = $pageDispCntMax + $pageIndex * $pageDispCntMax ;
}

$searchInfoList = array();
$searchInfoList['search_parent_category_id'] = -2;
$boardCategoryInfoList = $boardCategoryData->getInfoList($searchInfoList, 3);

$addParam = '';
if($categoryId > 0) {
	$addParam = '&c='.$categoryId;
}

//パンくず
$breadcrumbList = $boardCategoryData->getBreadcrumbListToCategory($boardCategoryId);
?>
