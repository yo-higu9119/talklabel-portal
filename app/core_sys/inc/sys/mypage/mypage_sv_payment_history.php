<?php
$purchaseId = 0;
if(isset($_GET['id']) && is_numeric($_GET['id'])){
	$purchaseId = intval($_GET['id']);
}
$purchaseInfo = $purchaseData->getInfo($purchaseId);
if($purchaseInfo->id === 0){
	header('HTTP/1.0 404 Not Found');
	exit();
}
?>
