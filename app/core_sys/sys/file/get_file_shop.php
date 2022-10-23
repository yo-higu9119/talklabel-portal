<?php
require_once dirname(__FILE__).'/../../shop_admin/inc/util/session.php';
require_once dirname(__FILE__).'/../../../../common/inc/data/path_info.php';
$session = new Session();

if(!$session->isLogin()) {
	header('HTTP/1.0 404 Not Found');
	exit();
}

$filePath = null;
if(isset($_GET['type']) && is_numeric($_GET['type']) //ファイル種別（1:記事キービジュアル/2:アカウントプロフ画像/3:商品写真/4:商品ダウンロードファイル）
&& isset($_GET['id']) && is_numeric($_GET['id']) //ID
&& isset($_GET['r']) && is_numeric($_GET['r']) //登録先種別（1:保存済/2:一時領域）
&& isset($_GET['f'])	//ファイル名
) {
	switch(intval($_GET['type'])) {
		case 1:
			$filePath = PathInfo::getArticleFilePathS(intval($_GET['r'])===2, $_GET['id'], $session->getMemberId());
			break;
		case 5:
			$filePath = PathInfo::getSeminarFilePathS(intval($_GET['r'])===2, $_GET['id'], $session->getMemberId());
			break;
		case 8:
			$filePath = PathInfo::getMemberFilePathPub(intval($_GET['r'])===2, $session->getMemberId(), $_GET['sub'], $session->getMemberId());
			break;
		case 12:
			$filePath = PathInfo::getProductFilePathS(intval($_GET['r'])===2, $_GET['id'], $session->getMemberId());
			break;
		case 13:
			$filePath = PathInfo::getProductFilePathS2(intval($_GET['r'])===2, $_GET['id'], $_GET['sub'], $session->getMemberId());
			break;
		default:
			header('HTTP/1.0 404 Not Found');
			exit();
	}

	if(is_file($filePath)) {
		$fileInfo = pathinfo($_GET['f']);
	} else {
		header('HTTP/1.0 404 Not Found');
		exit();
	}
} else {
	header('HTTP/1.0 404 Not Found');
	exit();
}

switch(strtolower($fileInfo['extension'])) {
	case 'jpg';
	case 'jpeg':
		$contentType = 'image/jpeg';
		break;
	case 'gif':
		$contentType = 'image/gif';
		break;
	case 'png':
		$contentType = 'image/png';
		break;
	default:
		$contentType = 'application/octet-stream';
		break;
}

header('Cache-Control: private, must-revalidate');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-type: {$contentType}");
header("Content-Disposition: inline; filename={$fileInfo['basename']}");
header("Content-Transfer-Encoding: binary");
header('Content-Length: '.filesize($filePath));
header('Pragma: private');
header("Last-Modified: ".date('r'));
header('Connection: close');
ob_end_clean();
readfile($filePath);
exit();
?>