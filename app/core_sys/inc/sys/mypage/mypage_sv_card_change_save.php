<?php
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();

$sErr = "";
$purchaseId = 0;
if(isset($_POST['id']) && is_numeric($_POST['id'])){
	$purchaseId = intval($_POST['id']);
}
$PurInfo = $purchaseData->getInfo($purchaseId);
if($PurInfo->id === 0){
	header('HTTP/1.0 404 Not Found');
	exit();
}

if($systemInfo->card_type == 1 && isset($_POST['cardfinger']) && $_POST['cardfinger'] !== ''){
}else if($systemInfo->card_type == 1 && isset($_POST['fingerprint']) && $_POST['fingerprint'] !== '' && isset($_POST['Token']) && $_POST['Token'] !== ''){
}else if($systemInfo->card_type == 3 && isset($_POST['cardfinger']) && $_POST['cardfinger'] !== ''){
}else if($systemInfo->card_type == 4 &&  isset($_POST['Token']) && $_POST['Token'] !== ''){
}else{
	header('HTTP/1.0 404 Not Found');
	exit();
}

require_once dirname(__FILE__).'/../../../../../common/inc/data/member_data.php';
$memberData = new MemberData('本人');
$memberData->setBaseNo(1,false);
$SYS_MemInfo = $memberData->getInfo($session->getMemberId());

if($PurInfo->id !== 0){
	$PurInfo->pay_type = $systemInfo->getPayTypeNo($systemInfo->card_type);

	/* クレカ決済情報登録 */
	$CreditMes = "";
	$settle_type = 1;/* 0：なし 1：サービス 2：セミナー 3：商品 4:決済リンク */
	if($systemInfo->card_type == 1){/* PAY.JP */
		$user_tkn = $session->getMemberNumber();
		$Token = isset($_POST['Token'])?$_POST['Token']:'';
		$fingerprint = isset($_POST['fingerprint'])?$_POST['fingerprint']:'';
		$cardfinger = isset($_POST['cardfinger'])?$_POST['cardfinger']:'';
		$buy_id = $PurInfo->id;
	}else if($systemInfo->card_type == 2){/* STRIPE */
		
	}else if($systemInfo->card_type == 3){/* ROBOT PAYMENT */
		
	}else if($systemInfo->card_type == 4){/* UNIVA PAY */
		$user_tkn = $session->getMemberNumber();
		$Token = isset($_POST['Token'])?$_POST['Token']:'';
		$buy_id = $PurInfo->id;
	}else{
	}
	
require_once dirname(__FILE__).'/../payment/pay_send_card.php';

	/* クレカ決済情報登録 */
	if($CreditMes !== ""){
		$sErr = $CreditMes;
	}
	
	if($sErr == ""){
		/* 入金情報の登録（カード変更） */
		$purChList = $purchaseChData->getListOrder($PurInfo->id,1);
		$purChInfo = reset($purChList);
		$purChInfo->id = 0;
		$purChInfo->split = $purChInfo->split+1;
		$purChInfo->retry = 2;
		$purChInfo->set = 1;
		$purChInfo->pay_date = date("Y/m/d 00:00:00");
		if($purchaseChData->insert($purChInfo) == 0){
			$sErr = '決済カード情報の追加に失敗しました。';
		}
	}
}else{
	$sErr = '決済カード情報の変更に失敗しました';
}

if($sErr == ""){
	$sErr = '決済カード情報の変更が完了いたしました。';
}
?>
