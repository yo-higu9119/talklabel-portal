				<div class="comBox order_Box">
					<h2 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00226);/*�I����e���m�F���Ă�������*/?></h2>
<?php
if($sErr !== ""){
?>
					<p class="Art mgt10 mgb10 cnt"><?php echo htmlspecialchars($sErr);?></p>
<?php
}else{
	if($message !== '') {
?>
					<p class="Art mgt10 mgb10 cnt"><?php echo $message;?></p>
<?php
	}
?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/pay_select_bt.php';?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/pay_sm_input.php';?>
				</div>
<?php
}
?>
