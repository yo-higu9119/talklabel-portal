			<div class="main_ti clear_fix">
				<h1 class="bsc_ti"><span><?php echo Util::dispLang(Language::WORD_00347);/*新規サービスの購入*/?></span></h1>
			</div>
			<div class="popup_Box">
				<section class="ordDetBox">
					<table>
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00351);/*選択済みサービス*/?></th>
<?php if (IS_SMART_PHONE) { ?>
						</tr>
						<tr>
<?php } else { ?>
<?php } ?>
							<td><?php echo $itemInfo->name; ?></td>
						</tr>
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00264);/*支払い方法*/?></th>
<?php if (IS_SMART_PHONE) { ?>
						</tr>
						<tr>
<?php } else { ?>
<?php } ?>
							<td><?php
if(isset($_POST['pay_type']) && intval($_POST['pay_type']) == 1){
	echo Util::dispLang(Language::WORD_00337);/* 銀行振込*/
}else{
	echo Util::dispLang(Language::WORD_00338);/* クレジットカード*/
}
?></td>
						</tr>
					</table>
				</section>

				<section class="CautTxt cnt mgt20">
					<p><?php echo Util::dispLang(Language::WORD_00348);/*上記サービスに申込しても問題ありませんか？*/?><br class="pc_only" />
					<?php echo Util::dispLang(Language::WORD_00265);/*問題なければ下記「申込を完了する」ボタンをクリックしてください。*/?>
					</p>
				</section>

<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/pay_loader.php';?>

				<div class="BtM mglra clear_fix spBtM mgb30">
					<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 btWtM back" onclick="$('#from_page').submit();" /><?php echo Util::dispLang(Language::WORD_00064);/*前の画面に戻る*/?></button></p>
					<p class="LayoutR"><button type="button" class="orBT mgt20 mgb10 btWtM next" id="setting_submit" onclick="load_efect();$('#to_page').submit();" /><?php echo Util::dispLang(Language::WORD_00266);/*申込を完了する*/?></button></p>
				</div>
<form method="post" action="sv_input_payment.php" id="from_page">
<?php echo $hiddenStr1;?>
</form>
<form method="post" action="sv_input_save.php" id="to_page">
<?php echo $hiddenStr2;?>
</form>
			</div>
