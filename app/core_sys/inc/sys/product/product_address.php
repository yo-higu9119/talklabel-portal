<?php
$addressData = new DeliveryAddressData('会員本人');

$sErr = '';
$message = '';
$result = array();
$title = '新しい住所の追加';

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
	if($info->id > 0){
		$title = '住所の編集';
	}
	if(isset($_POST['id'])) {
		$info->name = $_POST['name'];
		$info->member_id = $mid;
		$info->tel = $_POST['tel'];
		$info->zip = $_POST['zip1'].'-'.$_POST['zip2'];
		$PrefectureToNameList = Master::getPrefectureToNameList();
		$info->area = array_key_exists($_POST['area'],$PrefectureToNameList)?$PrefectureToNameList[$_POST['area']]:0;
		$info->add1 = $_POST['add1'];
		$info->add2 = $_POST['add2'];
		$info->company = $_POST['company'];
		$result = $info->check();
		if(count($result) === 0) {
			if($info->id == 0){
				$id = $addressData->insert($info);
				$info->id = $id;
				if($info->id > 0) {
					$info = $addressData->getInfo($id);
					$message = '新しい住所の追加が完了しました。';
					$_POST = array();
				} else {
					$message = '新しい住所の追加に失敗しました。';
				}
			}else{
				if($addressData->update($info)) {
					$info = $addressData->getInfo($id);
					$message = '住所の編集が完了しました。';
					$_POST = array();
				} else {
					$message = '住所の編集に失敗しました。';
				}
			}
		} else {
			$message = Util::dispLang(Language::WORD_01549)/*入力内容に間違いがあります。*/;
		}
	}
}else{
	$sErr = '会員情報が取得できませんでした。';
}
?>
