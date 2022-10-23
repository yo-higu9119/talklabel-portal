<?php
$inquiryBaseData = new InquiryBaseData('本人');
$inquiryInputFuncData = new InquiryInputFunctionData('本人');
$inquiryData = new InquiryData('本人');
$inputFuncData = new InputFunctionData('本人');
$masterBaseData = new MasterBaseData('本人');
$memberData = new MemberData('本人');

$sErrCon = "";
/*
お問合せ設定
$inquiryNo: お問合せ管理番号を指定
*/
if(!isset($inquiryNo)){
$inquiryNo = 1;
}

$inquiryBaseInfo = $inquiryBaseData->getInfo($inquiryNo);
$inquiryData->setBaseNo($inquiryBaseInfo->id,true);
$inquiryInfo = $inquiryData->getInfo(0);

$memberData->setBaseNo(1,false,$inquiryBaseInfo->id);

if($session->isLogin()){
	$m = $memberData->getAC($session->getMemberId());
	$inquiryInfo->base_no  = $inquiryNo;
	$inquiryInfo->mem_id   = $session->getMemberId();
}else{
	$inquiryInfo->base_no  = $inquiryNo;
	$inquiryInfo->mem_id   = 0;
	if(isset($_GET["m"])){
		$m = $_GET["m"];
	}else if(isset($_POST["m"])){
		$m = $_POST["m"];
	}else{
		$m = '';
	}
}

$nowTime = time();
if($inquiryBaseInfo->accept_type == 3){/* 受付しない */
	if(!$comReq){
		header('Location: ./stop.php');
		exit();
	}else{
		$sErrCon = "err";
	}
}else if($inquiryBaseInfo->accept_type == 1){/* 開始日のみ指定 */
	$accept_start_timestamp = mktime($inquiryBaseInfo->accept_start_timestamp->hour, $inquiryBaseInfo->accept_start_timestamp->minute, 0, $inquiryBaseInfo->accept_start_timestamp->month, $inquiryBaseInfo->accept_start_timestamp->day, $inquiryBaseInfo->accept_start_timestamp->year);
	if($accept_start_timestamp > $nowTime){
		if(!$comReq){
			header('Location: ./before.php');
			exit();
		}else{
			$sErrCon = "err";
		}
	}
}else{/* 期間指定 */
	$accept_start_timestamp = mktime($inquiryBaseInfo->accept_start_timestamp->hour, $inquiryBaseInfo->accept_start_timestamp->minute, 0, $inquiryBaseInfo->accept_start_timestamp->month, $inquiryBaseInfo->accept_start_timestamp->day, $inquiryBaseInfo->accept_start_timestamp->year);
	$accept_end_timestamp = mktime($inquiryBaseInfo->accept_end_timestamp->hour, $inquiryBaseInfo->accept_end_timestamp->minute, 0, $inquiryBaseInfo->accept_end_timestamp->month, $inquiryBaseInfo->accept_end_timestamp->day, $inquiryBaseInfo->accept_end_timestamp->year);
	if($accept_start_timestamp > $nowTime){
		if(!$comReq){
			header('Location: ./before.php');
			exit();
		}else{
			$sErrCon = "err";
		}
	}else if($accept_end_timestamp < $nowTime){
		if(!$comReq){
			header('Location: ./close.php');
			exit();
		}else{
			$sErrCon = "err";
		}
	}
}

if($sErrCon == ""){
	if(isset($_POST['mode'])) {
		$mode = $_POST['mode'];
	}else{
		$mode = "input";
	}
	$SYS_Message = '';
	$SYS_MemResult = array();
	$SYS_InqResult = array();

	/* ログイン状態取得 */
	if($session->isLogin()){
		$SYS_MemId = $session->getMemberId();
	}else{
		$SYS_MemId = 0;
	}

	$SYS_MemInfo = $memberData->getInfo($SYS_MemId);
}
?>