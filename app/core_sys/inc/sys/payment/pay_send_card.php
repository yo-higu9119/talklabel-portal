<?php
if($systemInfo->card_type == 1){/* PAY.JP */
	require_once dirname(__FILE__).'/pay_jp/pay_send_card.php';
}else if($systemInfo->card_type == 2){/* STRIPE */
	
}else if($systemInfo->card_type == 3){/* ROBOT PAYMENT */
	
}else if($systemInfo->card_type == 4){/* UNICA PAY */
	require_once dirname(__FILE__).'/univapay/pay_send_card.php';
}else{
}
?>