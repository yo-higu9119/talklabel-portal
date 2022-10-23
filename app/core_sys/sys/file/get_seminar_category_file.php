<?php
require_once dirname(__FILE__).'/../../inc/util/session.php';
$session = new Session();

require_once dirname(__FILE__).'/../../../../common/inc/data/path_info.php';

$filePath = null;
if(isset($_GET['id']) && is_numeric($_GET['id']) //ID
) {
	$id = intval($_GET['id']);

	require_once dirname(__FILE__).'/../../../../common/inc/data/seminar_category.php';
	$seminarCategoryData = new SeminarCategoryData($session->getMemberName());
	$info = $seminarCategoryData->getInfo($id);
	if($info->id === 0) {
		header('HTTP/1.0 404 Not Found');
		exit();
	}
	if(!isset($_SESSION['preview']['key']) && !$info->isDisp($session->isLogin(), $session->getMemberPurchased())) {
		header('HTTP/1.0 404 Not Found');
		exit();
	}

	$filePath = PathInfo::getSeminarCategoryFilePath(false, $id, 0);
	if(is_file($filePath)) {
		$fileInfo = pathinfo(trim($info->fileName));
	} else {
		$filePath= dirname(__FILE__).'/../../../core_sys/common/images/sys/no_image.gif';
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