<?php
$itemId = 0;
if(isset($_POST['id']) && is_numeric($_POST['id'])){
	$itemId = intval($_POST['id']);
}
$itemInfo = $itemData->getInfo($itemId);
if($itemInfo->id === 0 || $itemData->getIsOrder($session->getMemberId(),$itemInfo->id) > 0){
	header('HTTP/1.0 404 Not Found');
	exit();
}

$next_url = 'sv_input_check.php';
require_once dirname(__FILE__).'/../payment/input_payment_head_script.php';
?>
