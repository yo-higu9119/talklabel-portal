<?php
$hiddenStr = "";

$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();
$public_secrett = $systemInfo->getPkKey();

if($systemInfo->card_type == 1){/* PAY.JP */
	require_once dirname(__FILE__).'/pay_jp/input_payment_head_script.php';
}else if($systemInfo->card_type == 2){/* STRIPE */
	
}else if($systemInfo->card_type == 3){/* ROBOT PAYMENT */
	require_once dirname(__FILE__).'/robot_payment/input_payment_head_script.php';
}else if($systemInfo->card_type == 4){/* UNIVA PAY */
	require_once dirname(__FILE__).'/univapay/input_payment_head_script.php';
}else{
	require_once dirname(__FILE__).'/none/input_payment_head_script.php';
}
?>