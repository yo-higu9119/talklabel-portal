<?php
$sErr = "";
require_once dirname(__FILE__).'/../common/is_robot_payment_use.php';
if($sErr !== ""){
	header('HTTP/1.0 404 Not Found');
	exit();
}

if(isset($_GET['si'])){
	$seminarId = intval($_GET['si']);
}else if(isset($_POST['si'])){
	$seminarId = intval($_POST['si']);
}else{
	$seminarId = 0;
}
if($seminarId !== 0){
	$seminarInfo = $seminarData->getInfo($seminarId);
	if($seminarInfo->id == 0){
		header('HTTP/1.0 404 Not Found');
		exit();
	}else{
		$seminarApplyStatus = $seminarInfo->applyStatus($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId());
		if($seminarApplyStatus == -2 || $seminarApplyStatus == -3) {
			$sErr = "申込済みです。";
		}else if($seminarApplyStatus == -1){
			$sErr = "受付を行っておりません。";
		}else if($seminarApplyStatus == 0 || $seminarApplyStatus == -4){
			$sErr = "申し込みできません。";
		}else{
			$rest = max($seminarInfo->capacity-$seminarInfo->applicant, 0);
			//if($rest > 0)$rest = max($seminarInfo->web_capacity-$seminarInfo->applicant_web, 0);
			
			if(
				($seminarInfo->acceptType == 1
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				)
				|| ($seminarInfo->acceptType == 2
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				&& mktime($seminarInfo->acceptEndDatetime->hour, $seminarInfo->acceptEndDatetime->minute, 0, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day, $seminarInfo->acceptEndDatetime->year) >= time()
				)
				|| $seminarInfo->acceptType == 3
			){
			}else{
				$sErr = "受付が終了しています。";
			}
		}
	}
}else{
	header('HTTP/1.0 404 Not Found');
	exit();
}

if($sErr == ""){
	$amount = $seminarInfo->getCurrentAmount($session->isLogin(), $session->getMemberPurchased());
}
?>
