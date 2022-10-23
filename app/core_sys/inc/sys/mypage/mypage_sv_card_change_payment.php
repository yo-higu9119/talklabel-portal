<?php
$purchaseId = 0;
if(isset($_POST['id']) && is_numeric($_POST['id'])){
	$purchaseId = intval($_POST['id']);
}
$purchaseInfo = $purchaseData->getInfo($purchaseId);
if($purchaseInfo->id === 0){
	header('HTTP/1.0 404 Not Found');
	exit();
}
$itemInfo = $itemData->getInfo($purchaseInfo->item_id);
if($itemInfo->id === 0){
	header('HTTP/1.0 404 Not Found');
	exit();
}

$next_url = 'sv_card_change_save.php';
require_once dirname(__FILE__).'/../payment/input_payment_head_script.php';
?>
