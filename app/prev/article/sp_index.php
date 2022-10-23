<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
if(!isset($_SESSION)) {
	session_start();
}
if(!defined("SYSTEM_ACCESS_DATETIME")){
	define('SYSTEM_ACCESS_DATETIME', date("?YmdHis"));
}

define('SYSTEM_TOP_URL', '../../');

$accountId = intval($_GET['a']);
$key = $_GET['key'];
$id = intval($_GET['id']);
$type = intval($_GET['type']);

require_once dirname(__FILE__).'/../../../common/inc/data/preview_key.php';
$previewKeyData = new PreviewKeyData('Preview');

if(isset($_SESSION['preview']['account_id'])
&& isset($_SESSION['preview']['key'])) {
	if($_SESSION['preview']['account_id'] === $accountId
	&& $_SESSION['preview']['key'] === $key) {
		$previewKeyInfo = new PreviewKeyInfo();
		$previewKeyInfo->accountId = intval($_SESSION['preview']['account_id']);
		$previewKeyInfo->keyStr = $_SESSION['preview']['key'];
		$previewKeyInfo->isSession = false;
	} else {
		$previewKeyInfo = $previewKeyData->getInfo($accountId);
	}
} else {
	$previewKeyInfo = $previewKeyData->getInfo($accountId);
}

if($previewKeyInfo->accountId === $accountId
&& $previewKeyInfo->keyStr === $key
&& !$previewKeyInfo->isSession) {
	if($previewKeyData->setIsSession($previewKeyInfo->accountId)) {
		require_once dirname(__FILE__).'/../../../common/inc/data/article.php';
		$articleData = new ArticleData('Preview');
		$info = $articleData->getInfo($id);
		if($info->id === 0) {
			header('HTTP/1.0 404 Not Found');
			exit();
		}
		$_SESSION['preview']['account_id'] = $accountId;
		$_SESSION['preview']['key'] = $key;
	} else {
		header('HTTP/1.0 404 Not Found');
		exit();
	}
} else {
	header('HTTP/1.0 404 Not Found');
	exit();
}

require_once dirname(__FILE__).'/../../../common/inc/data/category.php';
$categoryData = new CategoryData('Preview');
$breadcrumbList = $categoryData->getBreadcrumbListToArticle(0, $info->id);
if(count($breadcrumbList) > 0) {
	$last = end($breadcrumbList);
	$categoryId = intval($last['id']);
}
$categoryInfo = $categoryData->getInfo($categoryId);

$searchInfoList = array();
$searchInfoList['search_parent_category_id'] = -2;
$searchInfoList['search_id'] = $info->categoryList;
$categoryInfoList = $categoryData->getInfoList($searchInfoList, 3);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>プレビュー画面</title>
<meta name="robots" content="nofollow,noindex">
<?php require dirname(__FILE__).'/../inc/sp_pre_meta.php';?>
</head>

<body class="prev sp_prev">
<form method="post" action="#">
<div id="wrapper">

<!-- CONTENTS START -->
	<div id="contents" class="clear_fix">
<!-- CONTENTS MAIN START -->
		<div id="main" class="clear_fix">

			<div class="contents_detaile">
				<h1 class="det_ti"><?php echo htmlspecialchars($info->title)?></h1>
<?php
if($info->fileName !== ""){
?>
				<figure class="mainVisual"><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_article_file.php?id='.$info->id)?>"></figure>
<?php
}
?>

				<article class="articleBox">
<?php
if($type===1) {
	echo $info->body;
} else {
	echo $info->disableComment;
}
?>
				</article>
			</div>
		</div>
<!-- CONTENTS MAIN END -->
	</div>
<!-- CONTENTS END -->
</div>

</form>
</body>
</html>
