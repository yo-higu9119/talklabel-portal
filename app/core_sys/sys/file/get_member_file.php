<?php
require_once dirname(__FILE__).'/../../inc/util/session.php';
$session = new Session();

if(!$session->isLogin()) {
	header('HTTP/1.0 404 Not Found');
	exit();
}

require_once dirname(__FILE__).'/../../../../common/inc/data/path_info.php';

$filePath = null;
if(isset($_GET['id']) && is_numeric($_GET['id']) //ID
) {
	$id = intval($_GET['id']);
	$add_str = "";
	if(isset($_GET['type']) && trim($_GET['type']) !== ""){
		$add_str = trim($_GET['type']);
	}

	require_once dirname(__FILE__).'/../../../../common/inc/data/member_data.php';
	$memberData = new MemberData($session->getMemberName());
	$memberData->setBaseNo(1);
	$info = $memberData->getInfo($session->getMemberId());
	if($info->id === 0) {
		header('HTTP/1.0 404 Not Found');
		exit();
	}

	$filePath = PathInfo::getMemberFilePath(false, $session->getMemberId(), $id, 0, false, false, $add_str);
	if(is_file($filePath)) {
		$fileInfo = pathinfo(trim($info->data[sprintf("INPUT%05d",$id)]));
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