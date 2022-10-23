			<div class="main_ti clear_fix">
				<h1 class="bsc_ti"><span><?php echo Util::dispLang(Language::WORD_00425);/*住所の削除*/?></span></h1>
			</div>
			<div class="popup_Box">
<?php
if($sErr !== '') {
?>
				<section class="ordDetBox">
					<div class="Art mgt20 mgb20"><?php echo htmlspecialchars($sErr);?></div>

					<div class="BtM mglra clear_fix mgb30">
						<p><button type="button" class="whBT mgt20 mgb10 mglra btWtM close_popup" /><?php echo Util::dispLang(Language::WORD_00011);/*ウィンドウを閉じる*/?></button></p>
					</div>
				</section>
<?php
}else{
?>
				<section class="ordDetBox">
					<div class="InputForm">
						<dl class="clear_fix">
							<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00420);/*氏名*/?><span class="NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
							<dd><p><?php echo htmlspecialchars($info->name); ?></p></dd>
						</dl>
						<dl class="clear_fix">
							<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00421);/*電話番号*/?><span class="NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
							<dd><p><?php echo htmlspecialchars($info->tel); ?></p></dd>
						</dl>
						<dl class="clear_fix">
							<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00422);/*住所*/?><span class="NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
							<dd><?php echo htmlspecialchars($info->zip); ?><br />
							<?php echo htmlspecialchars($info->area_name.$info->add1.$info->add2); ?></dd>
						</dl>
						<dl class="clear_fix">
							<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00423);/*会社名（オプション）*/?><span class="NewIcBg BgBlu"><?php echo Util::dispLang(Language::WORD_00059);/*任意*/?></span></p></dt>
							<dd><p><?php echo htmlspecialchars($info->company); ?></p></dd>
						</dl>
					</div>
				</section>

				<section class="CautTxt cnt mgt20">
					<p><?php echo Util::dispLang(Language::WORD_00426);/*上記内容の配送先を削除しても良いですか？*/?><br class="pc_only" />
					<?php echo Util::dispLang(Language::WORD_00427);/*問題なければ下の「配送先を削除する」のボタンをクリックしてください。*/?>
					</p>
				</section>
				<div class="BtM mglra clear_fix spBtM mgb30">
					<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 mglra btWtM close_popup" /><?php echo Util::dispLang(Language::WORD_00011);/*ウィンドウを閉じる*/?></button></p>
					<p class="LayoutR"><button type="submit" class="blBT mgt20 mgb10 mglra btWtM" /><?php echo Util::dispLang(Language::WORD_00428);/*配送先を削除する*/?></button></p>
				</div>
<?php
}
?>
			</div>