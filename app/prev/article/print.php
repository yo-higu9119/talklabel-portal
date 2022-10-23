<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
if(!isset($_SESSION)) {
	session_start();
}
if(!defined("SYSTEM_ACCESS_DATETIME")){
	define('SYSTEM_ACCESS_DATETIME', date("?YmdHis"));
}

define('SYSTEM_TOP_URL', '../../');

$accountId = intval($_POST['a']);
$key = $_POST['key'];
$idList = $_POST['idList'];
$column = $_POST['column'];
$print_type = $_POST['print_type'];

$systemData = new SystemData('');
$sysInfo = $systemData->getPublicInfo();
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
		$infoList = array();
		foreach($idList as $id){
			$info = $articleData->getInfo($id);
			array_push($infoList,$info);
			if($info->id === 0) {
				$ngList .= $id." ";
			}
		}
//		$info = $articleData->getInfo($id);
//		if($info->id === 0) {
//			header('HTTP/1.0 404 Not Found');
//			exit();
//		}
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
<title><?php echo $sysInfo["name"];?></title>
<meta name="robots" content="nofollow,noindex">
<?php require dirname(__FILE__).'/../inc/pre_meta.php';?>
<style>
header{
	position: fixed;
	width: 100%;
	top:0;
	background-color: var(--app-glnv-cr);
}
.header_inner{
	display: flex;
	justify-content: space-between;
	width: var(--app-main-width-con);
	height: 46px;
	margin: auto;
	padding: 8px 0;
}	
.header_inner div{display: flex;align-items: center;}
.header_inner img {max-height: 100%;}
.ttlWrap button {
    display: flex;
    margin: 0 8px;
    justify-content: center;
    align-items: center;
}
* {
	box-sizing: border-box;
	max-width: 100%!important;
	line-height: 1.25!important;
}
.articleBox h2,
.articleBox h3,
.articleBox h4,
.articleBox h5,
.articleBox h6 {
    margin: 1em auto;
    padding: 0.5em 0.5em;
	page-break-inside:avoid;
}
.previewArticleArea .articleBox p {
    margin: 1em auto;
    padding: 1em;
    font-size: 16px;
}
.previewArticleArea .articleBox p:not([class]) {
    padding: 0;
}
/*縦書き
	:root{
		--app-main-width-con:auto;
	}
	#main_inn{
		-ms-writing-mode: tb-rl;
		writing-mode: vertical-rl;
	}
	*{width: auto!important;max-width: 100%!important;}*/
/*段組み*/
	.articleBox {column-count: <?php echo $column;?>;}

@media print{
	@page {
	  size: A4 <?php echo $print_type;?>;
	  margin: 8mm 8mm;
	}
<?php if($print_type == 'landscape'){?>
	.mainVisual{page-break-after: always;}
<?php }?>
	:root{
		--app-main-width-con:100%;
	}
	* {
		box-sizing: border-box;
		max-width: 100%!important;
		line-height: 1.25!important;
	}
	body {
		-webkit-print-color-adjust: exact;
		color-adjust: exact;
	}
	p,table{page-break-inside:avoid;}
	p:not([class]){page-break-inside:auto;}
	.previewArticleArea{page-break-after: always;}
	header{display:none;}
	#main_inn{padding: 0;}
}
</style>
<script>$(function(){window.print();});</script>
</head>

<body class="prev">
<form method="post" action="#">
<div id="wrapper">
<header>
	<div class="header_inner">
		<?php require dirname(__FILE__).'/../../core_sys/inc/sys/common/site_logo.php';?>
		<div><?php echo $sysInfo["name"];?> 印刷プレビュー</div>
		<div class="ttlWrap">
			<button class="orBT" type="button" onClick="window.print();">印刷</p>
			<button class="bkBT" type="button" onClick="window.close();">とじる</p>
		</div>
	</div>
</header>
<!-- CONTENTS START -->
	<div id="contents" class="clear_fix">
<!-- CONTENTS MAIN START -->
		<div id="main" class="clear_fix">

			<div class="contents_detaile">
<?php foreach($infoList as $info){?>
				<div class="previewArticleArea">
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
	echo $info->body;
?>
					</article>
				</div>
<?php
}
?>
			</div>
		</div>
<!-- CONTENTS MAIN END -->
	</div>
<!-- CONTENTS END -->
</div>

</form>
</body>
</html>
