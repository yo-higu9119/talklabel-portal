<?php
if(isset($_GET['id'])){
	$seminarApplicantId = intval($_GET['id']);
}else if(isset($_POST['id'])){
	$seminarApplicantId = intval($_POST['id']);
}else{
	$seminarApplicantId = 0;
}

$seminarApplicantData = new SeminarApplicantData($session->getMemberName());

$seminarApplicantInfo = $seminarApplicantData->getInfo(0,0,$seminarApplicantId);
if($seminarApplicantInfo->id == 0){
	header('HTTP/1.0 404 Not Found');
	exit();
}
if(!$seminarApplicantData->updateCancelRepayment($seminarApplicantId, 3, "", "")){
	header('HTTP/1.0 404 Not Found');
	exit();
}
?>
