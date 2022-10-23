<?php
require_once dirname(__FILE__).'/../../../../common/inc/data/article.php';
$articleData = new ArticleData($session->getMemberName());
$info = $articleData->getInfoFromUrlKey($urlKey);
if($info->id === 0
|| !$info->isOpen
|| $info->link_type !== 0) {
	header('Location: '.SYSTEM_TOP_URL.'core_sys/error/no_page.php');
	exit();
}

$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();

$_SYS_META_TITLE = $info->title;
$_SYS_META_ARRAY = array();
$_SYS_META_ARRAY['description'] = $info->meta_descriptin;
$_SYS_META_ARRAY['keywords'] = $info->meta_keyword;
$_SYS_META_ARRAY['og:image'] = htmlspecialchars($systemInfo->public_url.'core_sys/sys/file/get_article_file.php?id='.$info->id.'&type=_m');
$_SYS_META_ARRAY['og:description'] = $info->meta_descriptin;


$isDisp = $info->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId());
if($isDisp) {
	if(!$articleData->setViewCount($info->id, $session)) {
		echo 'DBアクセスエラー';
		exit();
	}
}else{
	if($systemInfo->permission_article == 1){
		header('Location: '.SYSTEM_TOP_URL.'core_sys/error/no_page.php');
		exit();
	}
}

//パンくず
require_once dirname(__FILE__).'/../../../../common/inc/data/category.php';
$categoryData = new CategoryData('Preview');
$breadcrumbList = $categoryData->getBreadcrumbListToArticle($categoryId, $info->id);
if(count($breadcrumbList) > 0) {
	$last = end($breadcrumbList);
	$categoryId = intval($last['id']);
}
?>