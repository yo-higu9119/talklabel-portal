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
$hiddenStr1 = "";
$hiddenStr2 = "";
//POSTで戻る
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
?>
