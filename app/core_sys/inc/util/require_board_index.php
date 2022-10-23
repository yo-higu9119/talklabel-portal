<?php
require_once dirname(__FILE__).'/../../../../common/inc/data/board.php';
$boardData = new BoardData($session->getMemberName());
$info = $boardData->getInfo($boardId);
if($info->id === 0
|| $info->status === 0) {
	header('HTTP/1.0 404 Not Found');
	exit();
}

if(!$boardData->setViewCount($info->id)) {
	echo 'DBアクセスエラー';
	exit();
}

//パンくず
require_once dirname(__FILE__).'/../../../../common/inc/data/board_category.php';
$boardCategoryData = new BoardCategoryData('Preview');
$breadcrumbList = $boardCategoryData->getBreadcrumbListToArticle($boardCategoryId, $info->id);
if(count($breadcrumbList) > 0) {
	$last = end($breadcrumbList);
	$boardCategoryId = intval($last['id']);
}
?>