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
$next_url = 'final_check.php';
require_once dirname(__FILE__).'/../payment/input_payment_head_script.php';
}
?>
