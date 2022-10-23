<?php
$message = '';
$result = array();

$memberAccData = new MemberAccData($session->getMemberName());
$searchInfoList = array();
$searchInfoList['search_member_id'] = $SYS_MemInfo->id;
$accInfo = $memberAccData->getInfo($searchInfoList);
if(isset($_POST['mode'])){
	$accInfo->member_id       = $SYS_MemInfo->id;
	$accInfo->financial_name  = isset($_POST['financial_name'])?$_POST['financial_name']:'';
	$accInfo->financial_code  = isset($_POST['financial_code'])?$_POST['financial_code']:'';
	$accInfo->branch_name     = isset($_POST['branch_name'])?$_POST['branch_name']:'';
	$accInfo->branch_code     = isset($_POST['branch_code'])?$_POST['branch_code']:'';
	$accInfo->acc_type        = isset($_POST['acc_type'])?intval($_POST['acc_type']):1;
	$accInfo->acc_no          = isset($_POST['acc_no'])?$_POST['acc_no']:'';
	$accInfo->name            = isset($_POST['name'])?$_POST['name']:'';
	$accInfo->name_kana       = isset($_POST['name_kana'])?$_POST['name_kana']:'';
	$result = $accInfo->check();
	if(count($result) === 0) {
		if($accInfo->id > 0) {
			if($memberAccData->update($accInfo)) {
				$accInfo = $memberAccData->getInfo($searchInfoList);
				$message = '編集が完了しました';
				$_POST = array();
			} else {
				$message = '編集に失敗しました。';
			}
		} else {
			$accInfo->id = $memberAccData->insert($accInfo);
			if($accInfo->id > 0) {
				$accInfo = $memberAccData->getInfo($searchInfoList);
				$message = '登録が完了しました';
				$_POST = array();
			} else {
				$message = '登録に失敗しました。';
			}
		}
	} else {
		$message = '入力内容に間違いがあります。';
	}
}
?>
