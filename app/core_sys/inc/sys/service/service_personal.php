<?php
$itemData = new ItemData($session->getMemberName());
$purchaseData = new PurchaseData($session->getMemberName());

$sErr = "";
$message= '';
$SYS_Message = '';

$itemId = 0;
if(isset($_GET['sv'])){
	$itemId = intval($_GET['sv']);
}else if(isset($_POST['sv'])){
	$itemId = intval($_POST['sv']);
}
if(isset($_GET['nl'])){
	$notLogin = intval($_GET['nl']);
}else if(isset($_POST['nl'])){
	$notLogin = intval($_POST['nl']);
}else{
	$notLogin = 1;
}
$notLogin = ($notLogin == 0)?false:true;


$itemInfo = $itemData->getInfo($itemId);
if($itemInfo->id === 0){
	$sErr = Util::dispLang(Language::WORD_00269);/* 選択された情報がありません */
}else if($itemData->getIsOrder($session->getMemberId(),$itemInfo->id) > 0){
	$sErr = "購入済みです。";
}

if($sErr == ""){
	if($itemInfo->type === 1){/* 1:都度 */
		$money = $itemInfo->money;
	}else if($itemInfo->type === 2){/* 2:継続 */
		if($itemInfo->pay_timing === 1){/* 即時課金 */
			$money = $itemInfo->money;
		}else if($itemInfo->pay_timing === 2){/* 申込月無料 */
			$money = $itemInfo->init_money;
		}
	}else if($itemInfo->type === 3){/* 3:分割 */
		$money = $itemInfo->spl[0];
	}
}

if($sErr == ""){
	require_once dirname(__FILE__).'/../common/is_robot_payment_use.php';
}

if($sErr == ""){
	$inputFuncData = new InputFunctionData('');
	$masterBaseData = new MasterBaseData('');
	$memberData = new MemberData('会員本人');
	
	$memberData->setBaseNo( 1, true, false, array(), false, 'base');
	
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
				if(isset($money) && $money > 0){
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
				if($itemId !== 0){
					$itemInfo = $itemData->getInfo($itemId);
					if($itemInfo->id === 0){
						$sErr = Util::dispLang(Language::WORD_00269);/* 選択された情報がありません */
					}else if($itemData->getIsOrder($session->getMemberId(),$itemInfo->id) > 0){
						$sErr = "購入済みです。";
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
