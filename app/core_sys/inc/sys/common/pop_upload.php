<?php
$fileId = 0;
$fileType = 0;
if(isset($_GET['sub'])) {
	$subKey = intval($_GET['sub']);
} else {
	$subKey = '';
}
if(isset($_GET['add'])) {
	$addKey = intval($_GET['add']);
} else {
	$addKey = 0;
}

if(isset($_GET['id']) && is_numeric($_GET['id']) //ID
&& isset($_GET['type']) && is_numeric($_GET['type']) //ファイル種別（1:記事キービジュアル/2:アカウントプロフ画像/3:商品写真/4:商品ダウンロードファイル）
) {
	$fileId = intval($_GET['id']);
	$fileType = intval($_GET['type']);
} else {
	header('HTTP/1.0 404 Not Found');
	exit();
}

$uploadMaxStr = ini_get('upload_max_filesize');
$postMaxStr = ini_get('post_max_size');
$uploadMax = Util::returnBytes($uploadMaxStr);
$postMax = Util::returnBytes($postMaxStr);
$maxSize = (($uploadMax > $postMax)?$postMaxStr:$uploadMaxStr);
?>
