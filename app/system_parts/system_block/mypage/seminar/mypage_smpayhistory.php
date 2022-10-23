			<div class="main_ti clear_fix">
				<h1 class="bsc_ti"><span><?php echo Util::dispLang(Language::WORD_00309);/*決済履歴*/?></span></h1>
			</div>
			<div class="popup_Box">
				<div class="comBox cnt clear_fix TableBox">
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/mypage/mypage_sm_pay_history_detail.php';?>
				</div>
				<div class="BtM mglra clear_fix">
					<p><button type="submit" class="whBT mgt20 mgb10 mglra btWtM close_popup" /><?php echo Util::dispLang(Language::WORD_00011);/*ウィンドウを閉じる*/?></button></p>
				</div>
			</div>
