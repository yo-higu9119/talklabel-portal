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
		require_once dirname(__FILE__).'/../../../common/inc/data/seminar.php';
		$seminarData = new SeminarData('Preview');
		$seminarInfo = $seminarData->getInfo($id);
		if($seminarInfo->id === 0) {
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

require_once dirname(__FILE__).'/../../../common/inc/data/seminar_category.php';
$categoryData = new SeminarCategoryData('Preview');
$searchInfoList = array();
$searchInfoList['search_parent_seminar_category_id'] = -2;
$searchInfoList['search_id'] = $seminarInfo->categoryList;
$categoryInfoList = $categoryData->getInfoList($searchInfoList, 3);

?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>プレビュー画面</title>
<?php require dirname(__FILE__).'/../inc/pre_meta.php';?>
</head>

<body class="prev">
<div id="wrapper">
<!-- CONTENTS START -->
	<div id="contents" class="clear_fix">
<!-- CONTENTS MAIN START -->
		<div id="main" class="clear_fix">
			<div class="contents_detaile">
<?php require dirname(__FILE__).'/../../system_parts/system_block/seminar/main/sem_title.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/seminar/main/sem_visual.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/seminar/main/sem_detail.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/seminar/main/sem_detail_oth.php';?>
				</article>
			</div>
		</div>
	</div>
<!-- CONTENTS END -->
</div>
</body>
</html>
