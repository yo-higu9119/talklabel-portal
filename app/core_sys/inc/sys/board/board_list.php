<?php
require_once dirname(__FILE__).'/../../../../../common/inc/data/board_category.php';
$boardCategoryData = new BoardCategoryData($session->getMemberName());
$boardCategoryInfo = $boardCategoryData->getInfo($boardCategoryId);
if($boardCategoryInfo->id > 0 && !$boardCategoryInfo->isDisp) {
	$boardCategoryInfo = new BoardCategoryInfo();
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
$boardInfoList = $boardData->getInfoList($searchInfoList, $boardSortType+6, $pageDispCntMax*$pageIndex, $pageDispCntMax);
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
$NBaddParam = '';
if($boardCategoryInfo->id > 0) {
	$NBaddParam = '&bc='.$boardCategoryId;
}
if($boardSortType !== 0) {
	$NBaddParam = '&bs='.$boardSortType;
}
if($categoryId !== 0){
	$addParam .= '&c='.$categoryId;
	$NBaddParam .= '&c='.$categoryId;
}


//パンくず
$breadcrumbList = $boardCategoryData->getBreadcrumbListToCategory($boardCategoryId);
?>
