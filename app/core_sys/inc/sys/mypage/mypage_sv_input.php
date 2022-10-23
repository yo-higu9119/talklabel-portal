<?php

$sErr = "";
require_once dirname(__FILE__).'/../common/is_robot_payment_use.php';
if($sErr !== ""){
	header('HTTP/1.0 404 Not Found');
	exit();
}

$itemId = 0;
if(isset($_GET['id']) && is_numeric($_GET['id'])){
	$itemId = intval($_GET['id']);
}else if(isset($_POST['id']) && is_numeric($_POST['id'])){
	$itemId = intval($_POST['id']);
}
$itemInfo = $itemData->getInfo($itemId);
if($itemInfo->id === 0 || $itemData->getIsOrder($session->getMemberId(),$itemInfo->id) > 0){
	header('HTTP/1.0 404 Not Found');
	exit();
}
?>
