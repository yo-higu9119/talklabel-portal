			<div class="main_ti clear_fix">
				<h1 class="bsc_ti"><span><?php echo Util::dispLang(Language::WORD_00352);/*購入サービスのプラン変更*/?></span></h1>
			</div>
			<div class="popup_Box">
				<section class="ordDetBox">
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/mypage/mypage_sv_change_detail.php';?>
				</section>
				<section class="CautTxt cnt mgt20">
					<p><?php echo Util::dispLang(Language::WORD_00348);/*上記サービスに申込しても問題ありませんか？*/?><br class="pc_only" />
					<?php echo Util::dispLang(Language::WORD_00349);/*問題なければ下記「購入手続きに進む」ボタンをクリックしてください。*/?>
					</p>
				</section>
				<div class="BtM mglra clear_fix spBtM mgb30">
					<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 mglra btWtM close_popup" /><?php echo Util::dispLang(Language::WORD_00011);/*ウィンドウを閉じる*/?></button></p>
					<p class="LayoutR"><button type="submit" class="grBT mgt20 mgb10 mglra btWtM next" /><?php echo Util::dispLang(Language::WORD_00350);/*購入手続きに進む*/?></button></p>
				</div>
			</div>
