<?php
if(isset($_SESSION['tmpSeminarOrderKey'])){
	unset($_SESSION['tmpSeminarOrderKey']);
}

require_once dirname(__FILE__).'/../../../../common/inc/data/seminar.php';
$seminarData = new SeminarData($session->getMemberName());
$seminarInfo = $seminarData->getInfoFromUrlKey($urlKey);
if($seminarInfo->id === 0
|| !$seminarInfo->isOpen) {
	header('HTTP/1.0 404 Not Found');
	exit();
}

require_once dirname(__FILE__).'/../../../../common/inc/data/seminar_applicant.php';
$seminarApplicantData = new SeminarApplicantData($session->getMemberName());
$appInfo = $seminarApplicantData->getInfo($seminarInfo->id, $session->getMemberId());
?>