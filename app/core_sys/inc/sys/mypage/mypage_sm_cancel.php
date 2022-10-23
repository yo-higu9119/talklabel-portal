<?php
if(isset($_GET['id'])){
	$seminarApplicantId = intval($_GET['id']);
}else if(isset($_POST['id'])){
	$seminarApplicantId = intval($_POST['id']);
}else{
	$seminarApplicantId = 0;
}

$seminarApplicantInfo = $seminarApplicantData->getInfo(0,0,$seminarApplicantId);
if($seminarApplicantInfo->id == 0){
	header('HTTP/1.0 404 Not Found');
	exit();
}
$seminarInfo = $seminarData->getInfo($seminarApplicantInfo->seminarId);
if($seminarInfo->id == 0){
	header('HTTP/1.0 404 Not Found');
	exit();
}
?>
