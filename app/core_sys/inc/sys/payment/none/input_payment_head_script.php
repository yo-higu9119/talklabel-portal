<?php
//POSTで戻る
$hiddenStr = "";
foreach ($_POST as $key => $value) {
	if($key != 'mode' && $key != 'pay_type'){
		$hiddenStr .= FormUtil::hidden($key,$value);
	}
}
?>