			<div class="main_ti clear_fix">
				<h1 class="bsc_ti"><span><?php echo Util::dispLang(Language::WORD_00371);/*申込済みセミナーのキャンセル*/?></span></h1>
			</div>
			<div class="popup_Box">
				<section class="ordDetBox">
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/mypage/mypage_sm_cancel_detail.php';?>
				</section>
				<section class="CautTxt cnt mgt20">
					<p><?php echo Util::dispLang(Language::WORD_00372);/*上記セミナーをプラン変更しても問題ありませんか？*/?><br class="pc_only" />
					<?php echo Util::dispLang(Language::WORD_00344);/*問題なければ下記「キャンセルする」ボタンをクリックしてキャンセルを完了させてください。*/?>
					</p>
				</section>
				<div class="BtM mglra clear_fix spBtM mgb30">
					<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 mglra btWtM close_popup" /><?php echo Util::dispLang(Language::WORD_00011);/*ウィンドウを閉じる*/?></button></p>
					<p class="LayoutR"><button type="submit" class="blBT mgt20 mgb10 mglra btWtM" /><?php echo Util::dispLang(Language::WORD_00345);/*キャンセルする*/?></button></p>
				</div>
			</div>
