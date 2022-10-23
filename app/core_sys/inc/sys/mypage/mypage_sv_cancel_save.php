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
$purchaseData->setIsOrderCansel($purchaseInfo->item_id,$session->getMemberId());
?>
