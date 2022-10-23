<?php
require_once dirname(__FILE__).'/../../../../common/inc/data/path_info.php';
require_once dirname(__FILE__).'/../../../../common/inc/data/design.php';
$desSettingData = new DesignSettingData('');
$info = $desSettingData->getInfo(1);

$filePath = null;
if($info->file_name1 !== "") {
	$filePath = PathInfo::getSiteLogoFilePath(false,0);

	if(is_file($filePath)) {
		$fileInfo = pathinfo($info->file_name1);
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