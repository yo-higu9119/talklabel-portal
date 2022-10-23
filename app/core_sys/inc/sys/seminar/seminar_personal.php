<?php
$seminarData = new SeminarData('');
$seminarApplicantData = new SeminarApplicantData('');

$sErr = "";
$message= '';
$SYS_Message = '';

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
}

if($sErr == ""){
	require_once dirname(__FILE__).'/../common/is_robot_payment_use.php';
}

if($sErr == ""){
	$inputFuncData = new InputFunctionData('');
	$masterBaseData = new MasterBaseData('');
	$memberData = new MemberData('会員本人');
	
	$memberData->setBaseNo(1,true,false,array(),false,'base');
	
	$SYS_BaseList = $inputFuncData->getBase();
	$SYS_Result = array();
	$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
	if(isset($_POST['mode']) && $_POST['mode'] == "save") {
		$SYS_MemInfo = $memberData->getInputValue($SYS_MemInfo);
		$SYS_Result = $memberData->check($SYS_MemInfo);
		if(count($SYS_Result) === 0) {
			if($SYS_MemInfo->id == 0){
				$SYS_MemInfo = $session->getOutArgument($SYS_MemInfo);
				$id = $memberData->insert($SYS_MemInfo);
				if($id > 0) {
					$memberData->setBaseNo(1,false);
					$SYS_MemInfo = $memberData->getInfo($id);
					$session->login($SYS_MemInfo->data['INPUT00001'], $SYS_MemInfo->data['INPUT00002']);
				}else{
					$sErr = Util::dispLang(Language::WORD_00278);/* 会員情報の登録に失敗しました */
				}
			}else{
				if(!$memberData->update($SYS_MemInfo)) {
					$sErr = Util::dispLang(Language::WORD_00277);/* 会員情報の更新に失敗しました */
				}
			}
			if($sErr == ""){
			    //POSTで戻る
				$postVal = "";
				foreach ($_POST as $key => $value) {
					$postVal .= FormUtil::hidden($key,$value);
				}
				
				if(intval($seminarInfo->dispAmount) > 0){
					$next_url = 'payment.php';
				}else{
					$next_url = 'final_check.php';
				}
				
				$tag = <<< EOM
<!DOCTYPE html>
<head>
<meta charset='utf-8'>
</head>
<html lang='ja'>
<body onload='document.returnForm.submit();'>
<form name='returnForm' method='post' action='{$next_url}'>
{$postVal}
</form>
</body>
</html>
EOM;
				echo $tag;
				exit();
			}
		} else {
			$SYS_Message = Util::dispLang(Language::WORD_00114);/* 入力内容に間違いがあります */
		}
	}else if(isset($_POST['mode']) && $_POST['mode'] == "login") {
		if(isset($_POST['account'])) {
			$message = $session->login($_POST['account'], $_POST['password']);
			if($message === '') {
				$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
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
			}
		} else {
			$message = $session->getErrorMsg();
		}
	}
}
?>
