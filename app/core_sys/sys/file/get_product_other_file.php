<?php
require_once dirname(__FILE__).'/../../inc/util/session.php';
$session = new Session();

require_once dirname(__FILE__).'/../../../../common/inc/data/path_info.php';

$filePath = null;
if(
	isset($_GET['id']) && is_numeric($_GET['id']) //ID
	&& isset($_GET['n']) && is_numeric($_GET['n']) //その他画像番号
) {
	$id = intval($_GET['id']);
	$sub = intval($_GET['n']) + 1;
	$add_str = "";
	if(isset($_GET['type']) && trim($_GET['type']) !== ""){
		$add_str = trim($_GET['type']);
	}

	require_once dirname(__FILE__).'/../../../../common/inc/data/product.php';
	$productData = new ProductData($session->getMemberName());
	$info = $productData->getInfo($id);
	if($info->id === 0) {
		header('HTTP/1.0 404 Not Found');
		exit();
	}
	if(!isset($_SESSION['preview']['key']) && !$info->isOpen) {
		header('HTTP/1.0 404 Not Found');
		exit();
	}
	
	$filePath = PathInfo::getProductFilePath2(false, $id, $sub, 0, false, false, $add_str);
	if(is_file($filePath)) {
		if($sub == 2){
			$fileInfo = pathinfo(trim($info->fileName2));
		}else if($sub == 3){
			$fileInfo = pathinfo(trim($info->fileName3));
		}else if($sub == 4){
			$fileInfo = pathinfo(trim($info->fileName4));
		}else if($sub == 5){
			$fileInfo = pathinfo(trim($info->fileName5));
		}else{
			header('HTTP/1.0 404 Not Found');
			exit();
		}
	} else {
		$filePath= dirname(__FILE__).'/../../common/images/sample_photo/sample_img.jpg';
		$fileInfo = pathinfo('no_image.gif');
	}

	DataAccessBase::closeDb();
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