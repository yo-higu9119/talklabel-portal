<?php
$itemData = new ItemData($session->getMemberName());
$purchaseData = new PurchaseData($session->getMemberName());

$sErr = "";
$hiddenStr1 = "";
$hiddenStr2 = "";
$fromPage ="";

$itemId = 0;
if(isset($_GET['sv'])){
	$itemId = intval($_GET['sv']);
}else if(isset($_POST['sv'])){
	$itemId = intval($_POST['sv']);
}

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
	$inputFuncData = new InputFunctionData('');
	$masterBaseData = new MasterBaseData('');
	$memberData = new MemberData('会員本人');
	
	$useList = array();
	
	$memberData->setBaseNo(1,true,false,array(),false,'base');
	
	$SYS_BaseList = $inputFuncData->getBase();
	$SYS_Result = array();
	$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
	
	//POSTで戻る
	$fromPage ="payment.php";
	if(isset($_POST['pay_type']) && intval($_POST['pay_type']) == 2){
		foreach ($_POST as $key => $value) {
			if($key !== "mode"){
				if($key != 'Token' && $key != 'cardfinger' && $key != 'fingerprint'){
					$hiddenStr1 .= FormUtil::hidden($key,$value);
				}
				$hiddenStr2 .= FormUtil::hidden($key,$value);
			}
		}
	}else{
		foreach ($_POST as $key => $value) {
			if($key !== "mode"){
				$hiddenStr1 .= FormUtil::hidden($key,$value);
				$hiddenStr2 .= FormUtil::hidden($key,$value);
			}
		}
	}
}
?>
