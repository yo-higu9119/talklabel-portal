<?php
$categoryId = (isset($_GET['c'])?intval($_GET['c']):0);
$boardId = (isset($_GET['b'])?$_GET['b']:0);
$boardCategoryId = (isset($_GET['bc'])?$_GET['bc']:0);
$boardCategoryGroupId = 1;

/*****************************************
 * 掲示板情報・パンくず取得用require file
 *****************************************
 * 必須変数
 * $boardId
 * $boardCategoryId
 *---------------------------------------
 * 呼び出しファイル
 * common/inc/data/board.php
 * common/inc/data/board_category.php
 *---------------------------------------
 * 参照可能変数
 * 記事情報オブジェクト：$info
 * 記事表示状態：$isDisp
 * パンくず配列：$breadcrumbList
 */
require_once dirname(__FILE__).'/../../../inc/util/require_board_index.php';
$boardCategoryInfo = $boardCategoryData->getInfo($boardCategoryId);

$addParam = '';
$NBaddParam = '';
if($boardCategoryInfo->id > 0) {
	$NBaddParam = '&bc='.$boardCategoryId;
}
if($categoryId !== 0){
	$addParam .= '&c='.$categoryId;
	$NBaddParam .= '&c='.$categoryId;
}

require_once dirname(__FILE__).'/../../../../../common/inc/data/board_category.php';
$boardCategoryData = new BoardCategoryData($session->getMemberName());
$searchInfoList = array();
$searchInfoList['search_parent_category_id'] = -2;
$searchInfoList['search_id'] = $info->categoryList;
$boardCategoryInfoList = $boardCategoryData->getInfoList($searchInfoList, 3);
?>
