<?php
/* パラメータなしの場合ここから下のコメントまで削除 */
/*
if(isset($_GET['c'])) {
	$inquiryNo = intval($_GET['c']);
} else if(isset($_POST['c'])) {
	$inquiryNo = intval($_POST['c']);
} else {
	$inquiryNo = 1;
}
*/
/* パラメータなしの場合ここから上のコメントまで削除 */

/*
お問合せ設定
$inquiryNo: お問合せ管理番号を指定
パラメータ有りの場合は$inquiryNoの行をコメントアウト。
*/
$inquiryNo = 1;


$SYS_MemId = $session->getMemberId();
$SYS_Message = '';

$info = $inquiryBaseData->getInfo($inquiryNo);
if($info->id === 0) {
	$SYS_FormTitle = "お問合せ";
	$SYS_Message = '指定されたお問合せは存在しません。';
}else{
	$SYS_FormTitle = $info->name;
	$inquiryData->setBaseNo($info->id,true);
	$inquiryList = $inquiryData->getList($info->id,0,0,$SYS_MemId);
	if(count($inquiryList) == 0){
		$SYS_Message = '過去のお問合せはありません。';
	}
}
?>
