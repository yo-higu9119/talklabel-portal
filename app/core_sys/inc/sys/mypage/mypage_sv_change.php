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
}else{
	$itemId = 0;
}
if(isset($_GET['nid']) && is_numeric($_GET['nid'])){
	$itemNId = intval($_GET['nid']);
}else if(isset($_POST['nid']) && is_numeric($_POST['nid'])){
	$itemNId = intval($_POST['nid']);
}else{
	$itemNId = 0;
}
if($itemId == $itemNId){
	$itemNId = 0;
}
$itemInfo = $itemData->getInfo($itemId);
if($itemInfo->id === 0){
	header('HTTP/1.0 404 Not Found');
	exit();
}

if($itemInfo->plan_behavior == 1){
	header('HTTP/1.0 404 Not Found');
	exit();
}

$orderList = $purchaseData->getListOrder($session->getMemberId(),$itemInfo->plan_id,0,false);
if(count($orderList) != 1){
	header('HTTP/1.0 404 Not Found');
	exit();
}

$orderInfo = current($orderList);
$Info = $itemData->getInfo($orderInfo->item_id);

$itemList = $itemData->getListIsParent($Info->plan_id);
$itemList2 = $itemList;
?>
