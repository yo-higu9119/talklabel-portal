			<div class="main_ti clear_fix">
				<h1 class="bsc_ti"><span><?php echo Util::dispLang(Language::WORD_00442);/*商品情報（購入内容の確認）*/?></span></h1>
			</div>
			<div class="popup_Box">
				<section class="ordDetBoxPrd">
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/mypage/mypage_prd_order_detail.php';?>
				</section>
				<div class="BtM mglra clear_fix">
					<p><button type="submit" class="whBT mgt20 mgb10 mglra btWtM close_popup" /><?php echo Util::dispLang(Language::WORD_00011);/*ウィンドウを閉じる*/?></button></p>
				</div>
			</div>
