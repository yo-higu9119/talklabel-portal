			<div class="main_ti clear_fix">
				<h1 class="bsc_ti"><span><?php echo Util::dispLang(Language::WORD_00374);/*新規セミナーの申込*/?></span></h1>
			</div>
			<div class="popup_Box">
<?php
if($sErr !== ""){
?>
				<section class="CautTxt cnt mgt20">
					<p><?php echo $sErr; ?></p>
				</section>

				<div class="BtM mglra clear_fix spBtM">
					<p><button type="button" class="whBT mgt20 mgb10 mglra btWtM close_popup" /><?php echo Util::dispLang(Language::WORD_00011);/*ウィンドウを閉じる*/?></button></p>
				</div>
<?php
}else{
?>
				<section class="ordDetBox">
					<table>
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00375);/*選択済みセミナー*/?></th>
<?php if (IS_SMART_PHONE) { ?>
						</tr>
						<tr>
<?php } else { ?>
<?php } ?>
							<td><?php echo htmlspecialchars($seminarInfo->name); ?></td>
						</tr>
					</table>
				</section>

<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/pay_select_bt.php';?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/pay_mypage_sm_input.php';?>
<?php
}
?>
			</div>
