				<div class="comBox order_Box">
					<h2 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00226);/*選択内容を確認してください*/?></h2>
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
					<section class="selectBt">
						<h2 class="fotm_ti">支払い方法を選択</h2>
						<ul class="clear_fix cl3">
<?php
	$payment_type_list = explode(",",$productCategoryGroupInfo->payment_type_list);
	$settle_checked = ' checked="checked"';
	if(in_array(1,$payment_type_list)){
?>
							<li><input type="radio" name="settle_type" value="0"<?php echo $settle_checked;?> onclick="ch_type(false)" id="settle_type0" /><label class="tab_item" for="settle_type0">代金引換</label></li>
<?php
		$settle_checked = '';
	}
	if(in_array(2,$payment_type_list)){
?>
							<li><input type="radio" name="settle_type" value="1"<?php echo $settle_checked;?> onclick="ch_type(false)" id="settle_type1" /><label class="tab_item" for="settle_type1">銀行振込</label></li>
<?php
		$settle_checked = '';
	}
	if(in_array(3,$payment_type_list)){
?>
							<li><input type="radio" name="settle_type" value="2"<?php echo $settle_checked;?> onclick="ch_type(false)" id="settle_type2" /><label class="tab_item" for="settle_type2">クレジットカード</label></li>
<?php
		$settle_checked = '';
	}
?>
						</ul>
					</section>
<?php
	if(in_array(1,$payment_type_list)){
?>

					<div id="form0">
						<form method="post" action="" id="payment-form0">
						<?php echo $hiddenStr;?>
						<input type="hidden" name="pay_type" id="pay_type0" value="" />
						<section class="selectBox">
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/pay_cash_tag.php';?>
							<div class="BtM mglra clear_fix spBtM spLR">
								<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 btWtM back" onclick="$('#payment-form0').attr('action', 'delivery.php');$('#payment-form0').submit();" />前の画面に戻る</button></p>
								<p class="LayoutR"><button type="button" class="blBT mgt20 mgb10 btWtM next" onclick="$('#payment-form0').attr('action', 'final_check.php');$('#payment-form0').submit();" />最終確認へ進む</button></p>
							</div>
						</section>
						</form>
					</div>
<?php
	}
	if(in_array(2,$payment_type_list)){
?>
					<div id="form1">
						<form method="post" action="" id="payment-form1">
						<?php echo $hiddenStr;?>
						<input type="hidden" name="pay_type" id="pay_type1" value="" />
						<section class="selectBox">
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/pay_bank_tag.php';?>
							<div class="BtM mglra clear_fix spBtM spLR">
								<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 btWtM back" onclick="$('#payment-form1').attr('action', 'delivery.php');$('#payment-form1').submit();" />前の画面に戻る</button></p>
								<p class="LayoutR"><button type="button" class="blBT mgt20 mgb10 btWtM next" onclick="$('#payment-form1').attr('action', 'final_check.php');$('#payment-form1').submit();" />最終確認へ進む</button></p>
							</div>
						</section>
						</form>
					</div>
<?php
	}
	if(in_array(3,$payment_type_list)){
?>
					<div id="form2">
						<form method="post" action="payment.php" id="payment-form2">
						<?php echo $hiddenStr;?>
						<input type="hidden" name="pay_type" id="pay_type2" value="" />
						<p class="Art mgt10 mgb10 payment-errors fontOtshin" style="display:none;"></p>
						<section class="selectBox">
							<h2 class="fotm_ti">支払い方法(クレジットカードを選択された方へ)</h2>
							<div class="comBoxInn mgt10 mgb10">
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/pay_input.php';?>
							</div>
							<div class="comBoxInn mgt10 mgb10">
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/card.php';?>
							</div>

							<section class="CautTxt mgt10 cnt">
								<p>上記内容で問題ありませんか？<br />
								問題なければ「最終確認へ進む」ボタンをクリックして進んでください。
								</p>
							</section>

							<div class="cardAjx" style="text-align:center;display:none;" id="loading">
								<p><img src="../../core_sys/common/images/sys/ajax-loader.gif" /></p><p>Loading...</p>
							</div>
							<div class="BtM mglra clear_fix spBtM spLR">
								<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 btWtM back" onclick="$('#payment-form2').attr('action', 'personal.php');$('#payment-form2').submit();" />前の画面に戻る</button></p>
								<?php if($sErr == ""){ ?><p class="LayoutR"><button type="button" class="blBT mgt20 mgb10 btWtM next" onclick="load_efect();" />最終確認へ進む</button></p><?php } ?>
								
							</div>
						</section>
						</form>
					</div>
<?php
	}
?>
				</div>
<?php
}
?>
