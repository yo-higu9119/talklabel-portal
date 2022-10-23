<?php
require_once dirname(__FILE__).'/../../inc/util/session.php';
$session = new Session();

if(!$session->isLogin()) {
	header('HTTP/1.0 404 Not Found');
	exit();
}

require_once dirname(__FILE__).'/../../../../common/inc/data/path_info.php';

$filePath = null;
if(
	isset($_GET['id']) && is_numeric($_GET['id']) //ID
) {
	$id = intval($_GET['id']);
	$sub = 6;

	require_once dirname(__FILE__).'/../../../../common/inc/data/product.php';
	$productData = new ProductData($session->getMemberName());
	$info = $productData->getInfo($id);
	if($info->id === 0 || $info->TypeNo !== 2 || $info->dl_file_name === "" ) {
		header('HTTP/1.0 404 Not Found');
		exit();
	}
	if(!isset($_SESSION['preview']['key']) && !$info->isOpen) {
		header('HTTP/1.0 404 Not Found');
		exit();
	}
	$filePath = PathInfo::getProductFilePath2(false, $id, $sub, 0);
	if(is_file($filePath)) {
		$fileInfo = pathinfo(trim($info->dl_file_name));
	} else {
		header('HTTP/1.0 404 Not Found');
		exit();
	}

	require_once dirname(__FILE__).'/../../../../common/inc/data/product_applicant.php';
	$productApplicantData = new ProductApplicantData($session->getMemberName());
	$productApplicantInfo = $productApplicantData->getInfo($info->id,$session->getMemberId());
	if($productApplicantInfo->id === 0) {
		header('HTTP/1.0 404 Not Found');
		exit();
	}
	
	require_once dirname(__FILE__).'/../../../../common/inc/data/product_payment.php';
	$productPaymentData = new ProductPaymentData($session->getMemberName());
	$productPaymentInfoList = $productPaymentData->getInfoList($productApplicantInfo->id, 2);
	$productPaymentInfo = current($productPaymentInfoList);
	if(!$productPaymentInfo->isPaid) {	//TODO
		header('HTTP/1.0 404 Not Found');
		exit();
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