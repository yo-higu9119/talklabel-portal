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
					<p class="CautTxt cnt"><?php echo Util::dispLang(Language::WORD_00377);/*セミナーの申込が完了いたしました。*/?></p>
				</section>

				<div class="BtM mglra clear_fix">
					<p><button type="submit" class="whBT mgt20 mgb10 mglra btWtM close_popup" /><?php echo Util::dispLang(Language::WORD_00011);/*ウィンドウを閉じる*/?></button></p>
				</div>
<?php
}
?>
			</div>
