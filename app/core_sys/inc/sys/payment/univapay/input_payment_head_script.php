<?php
$message = '';

if(isset($_POST['crd_num']) && isset($_POST['crd_name']) && $_POST['crd_m'] !== "" && $_POST['crd_y'] !== "" && $_POST['crd_sec'] !== ""){
	//POSTで戻る
	$hiddenStr = "";
	foreach ($_POST as $key => $value) {
		if($key != 'mode' && $key != 'crd_num' && $key != 'crd_name' && $key != 'crd_m' && $key != 'crd_y' && $key != 'crd_sec'){
			$hiddenStr .= FormUtil::hidden($key,$value);
		}
	}
	
	$memberData = new MemberData('');
	$memberData->setBaseNo(1,false);
	if($session->isLogin()){
		$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
		if($SYS_MemInfo->id == 0){
			$message = Util::dispLang(Language::WORD_00276);/* 会員が取得できません */
		}
	}else{
		$message = Util::dispLang(Language::WORD_00276);/* 会員が取得できません */
	}
	
	if($message == ""){
		require_once '/var/www/univapay/vendor/autoload.php';
		//use Univapay\UnivapayClient;
		//use Univapay\Enums\RefundReason;
		//use Univapay\Resources\Authentication\AppJWT; 
		//use Univapay\Resources\PaymentData\Address;
		//use Univapay\Resources\PaymentData\PhoneNumber;
		//use Univapay\Resources\PaymentMethod\CardPayment;
		//use Money\Money;
		
		$systemData = new SystemData('');
		$systemInfo = $systemData->getInfo();
		$pk = $systemInfo->getPkKey();
		$sk = $systemInfo->getSkKey();
		
		try {
			$client = new Univapay\UnivapayClient(Univapay\Resources\Authentication\AppJWT::createToken($pk, $sk));
		} catch (Exception $e) {
			$message = '決済会社情報が正しくないか、使用できない決済会社です。';
		}
		
		if($message == ""){
			$paymentMethod = new Univapay\Resources\PaymentMethod\CardPayment(
				$SYS_MemInfo->mail,
				$_POST['crd_name'],
				$_POST['crd_num'],
				sprintf("%02d",intval($_POST['crd_m'])),
				sprintf("20%02d",intval($_POST['crd_y'])),
				$_POST['crd_sec'],
				Univapay\Enums\TokenType::RECURRING(),
				null
			);
			//print_r($paymentMethod);
			try {
				$token = $client->createToken($paymentMethod);
				$hiddenStr .= FormUtil::hidden('Token',$token->id);
				$tag = <<< EOM
<!DOCTYPE html>
<head>
<meta charset='utf-8'>
</head>
<html lang='ja'>
<body onload='document.returnForm.submit();'>
<form name='returnForm' method='post' action='{$next_url}'>
{$hiddenStr}
</form>
</body>
</html>
EOM;
				echo $tag;
				exit();
			} catch (Exception $e) {
				//print_r($e->code.'('.implode(',',$e->errors[0]).')');
				$message = 'カード情報が正しくないか、使用できないカードです。';
			}
		}
		
		/*
		if($message == ""){
			try {
				$charge = $client->createCharge($token->id, Money\Money::JPY(1000))->awaitResult();
				print_r($charge);
			} catch (Exception $e) {
				print_r($e->code.'('.implode(',',$e->errors[0]).')');
				$message;
			}
		}
		*/
	}
}else{
	//POSTで戻る
	$hiddenStr = "";
	foreach ($_POST as $key => $value) {
		if($key != 'mode' && $key != 'pay_type'){
			$hiddenStr .= FormUtil::hidden($key,$value);
		}
	}
}
?>