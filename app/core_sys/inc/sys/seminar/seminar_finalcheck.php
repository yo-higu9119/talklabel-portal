<?php
$seminarData = new SeminarData('');
$seminarApplicantData = new SeminarApplicantData('');

$sErr = "";
$message= '';
$SYS_Message = '';
$hiddenStr1 = "";
$hiddenStr2 = "";
$fromPage ="";

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
		$sErr = Util::dispLang(Language::WORD_00269);/* 選択された情報がありません */
	}else{
		$seminarApplyStatus = $seminarInfo->applyStatus($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId());
		if($seminarApplyStatus == -2 || $seminarApplyStatus == -3) {
			$sErr = Util::dispLang(Language::WORD_00270);/* 申込済みです */
		}else if($seminarApplyStatus == -1){
			$sErr = Util::dispLang(Language::WORD_00271);/* 受付を行っておりません */
		}else if($seminarApplyStatus == 0 || $seminarApplyStatus == -4){
			$sErr = Util::dispLang(Language::WORD_00272);/* 申し込みできません */
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
				$sErr = Util::dispLang(Language::WORD_00273);/* 受付が終了しています */
			}
		}
	}
}else{
	$sErr = Util::dispLang(Language::WORD_00269);/* 選択された情報がありません */
}
if($sErr == ""){
	$amount = $seminarInfo->getCurrentAmount($session->isLogin(), $session->getMemberPurchased());
	
	$inputFuncData = new InputFunctionData('');
	$masterBaseData = new MasterBaseData('');
	$memberData = new MemberData('会員本人');
	
	$useList = array();
	$useList['INPUT00003'] = true;//氏名
	$useList['INPUT00004'] = false;//氏名(フリガナ)
	$useList['INPUT00005'] = false;//電話番号
	$useList['INPUT00001'] = true;//アドレス
	//$useList['INPUT00006'] = true;//アドレス2
	//$useList['INPUT00002'] = true;//パスワード
	$useList['INPUT00007'] = false;//住所
	//$useList['INPUT00008'] = true;//生年月日
	
	$memberData->setBaseNo(1,false,false,$useList);
	
	$SYS_BaseList = $inputFuncData->getBase();
	$SYS_Result = array();
	$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
	
    //POSTで戻る
    if($amount > 0){
    	$fromPage ="payment.php";
		foreach ($_POST as $key => $value) {
			if($key !== "mode"){
				if($key != 'Token' && $key != 'cardfinger' && $key != 'fingerprint'){
					$hiddenStr1 .= FormUtil::hidden($key,$value);
				}
				$hiddenStr2 .= FormUtil::hidden($key,$value);
			}
		}
    }else{
    	$fromPage ="personal.php";
		foreach ($_POST as $key => $value) {
			if($key !== "mode"){
				$hiddenStr1 .= FormUtil::hidden($key,$value);
				$hiddenStr2 .= FormUtil::hidden($key,$value);
			}
		}
    }
}
?>
