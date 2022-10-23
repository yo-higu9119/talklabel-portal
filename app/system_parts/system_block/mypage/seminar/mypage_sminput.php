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
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/mypage/mypage_sm_input_detail.php';?>
				</section>
<?php
	if(isset($ammount) && $ammount > 0){/* 有料 */
?>
				<section class="CautTxt cnt mgt20">
					<p><?php echo Util::dispLang(Language::WORD_00376);/*上記セミナーに申込しても問題ありませんか？*/?><br class="pc_only" />
					<?php echo Util::dispLang(Language::WORD_00349);/*問題なければ下記「購入手続きに進む」ボタンをクリックしてください。*/?>
					</p>
				</section>

				<div class="BtM mglra clear_fix spBtM mgb30">
					<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 mglra btWtM close_popup" /><?php echo Util::dispLang(Language::WORD_00011);/*ウィンドウを閉じる*/?></button></p>
					<p class="LayoutR"><button type="submit" class="grBT mgt20 mgb10 mglra btWtM next" onclick="$('#input-form').attr('action', 'sm_input_payment.php');$('#input-form').submit();" /><?php echo Util::dispLang(Language::WORD_00350);/*購入手続きに進む*/?></button></p>
				</div>

<?php
	}else{/* 無料 */
?>
				<section class="CautTxt cnt mgt20">
					<p><?php echo Util::dispLang(Language::WORD_00376);/*上記セミナーに申込しても問題ありませんか？*/?><br class="pc_only" />
					<?php echo Util::dispLang(Language::WORD_00265);/*問題なければ下記「申込を完了する」ボタンをクリックしてください。*/?>
					</p>
				</section>

				<div class="BtM mglra clear_fix spBtM">
					<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 mglra btWtM close_popup" /><?php echo Util::dispLang(Language::WORD_00011);/*ウィンドウを閉じる*/?></button></p>
					<p class="LayoutR"><button type="submit" class="orBT mgt20 mgb10 mglra btWtM" onclick="$('#input-form').attr('action', 'sm_input_save.php');$('#input-form').submit();" /><?php echo Util::dispLang(Language::WORD_00266);/*申込を完了する*/?></button></p>
				</div>
<?php
	}
}
?>
			</div>
