<?php
require_once dirname(__FILE__).'/../../inc/util/session.php';
$session = new Session();

if(!$session->isLogin()) {
	header('HTTP/1.0 404 Not Found');
	exit();
}

$filePath = Config::PRIVATE_DIR.'/up_files/tokuten/';

if(isset($_GET['file']) && trim($_GET['file']) !== ""
) {
	$file = trim($_GET['file']);

	$filePath .= $file;
	if(is_file($filePath)) {
		$fileInfo = pathinfo($file);
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
	case 'pdf':
		$contentType = 'application/pdf';
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