<?php
$addressData = new DeliveryAddressData('会員本人');

$sErr = '';
$message = '';
$result = array();

if(isset($_GET['id'])){
	$id = intval($_GET['id']);
}else if(isset($_POST['id'])){
	$id = intval($_POST['id']);
}else{
	$id = 0;
}

$mid = $session->getMemberId();
if($mid !== 0){
	$info = $addressData->getInfo($id);
	if(isset($_POST['id'])) {
		if($addressData->delete($info->id)) {
			$info = $addressData->getInfo($id);
			$sErr = '住所の削除が完了しました。';
			$_POST = array();
		} else {
			$sErr = '住所の削除に失敗しました。';
		}
	}
}else{
	$sErr = '会員情報が取得できませんでした。';
}
?>
