<?php
$itemId = 0;
if(isset($_POST['id']) && is_numeric($_POST['id'])){
	$itemId = intval($_POST['id']);
}
$nextId = 0;
if(isset($_POST['item']) && is_numeric($_POST['item'])){
	$nextId = intval($_POST['item']);
}
$nowItemInfo = $itemData->getInfo($itemId);
if($nowItemInfo->id === 0){
	header('HTTP/1.0 404 Not Found');
	exit();
}
$nexItemInfo = $itemData->getInfo($nextId);
if($nexItemInfo->id === 0 || $itemData->getIsOrder($session->getMemberId(),$nexItemInfo->id) > 0){
	header('HTTP/1.0 404 Not Found');
	exit();
}

$next_url = 'sv_change_check.php';
require_once dirname(__FILE__).'/../payment/input_payment_head_script.php';
?>
