<?php
$purchaseId = 0;
if(isset($_GET['id']) && is_numeric($_GET['id'])){
	$purchaseId = intval($_GET['id']);
}else if(isset($_POST['id']) && is_numeric($_POST['id'])){
	$purchaseId = intval($_POST['id']);
}
$purchaseInfo = $purchaseData->getInfo($purchaseId);
if($purchaseInfo->id === 0){
	header('HTTP/1.0 404 Not Found');
	exit();
}
$itemInfo = $itemData->getInfo($purchaseInfo->item_id);
$gmo_order = new gmo_order($session->getMemberName());
$gmo_orderInfo = $gmo_order->getInfoOrder(1,$session->getMemberId(),$purchaseId);
?>
