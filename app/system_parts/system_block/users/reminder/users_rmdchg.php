				<div class="comBox">
<?php
if($message !== '') {
		echo '<p class="art_box mgt10 mgb10">'.htmlspecialchars($message).'</p>';
}
?>
					<section class="CautTxtW">
						<p><?php echo Util::dispLang(Language::WORD_00096);/* 新しいパスワードを設定してください。 */?></p>
					</section>

					<section class="comBoxInn InputFormT mgt30">
						<dl class="clear_fix">
							<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00078);/* パスワード */?> <span class="NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/* 必須 */?></span></p></dt>
							<dd><input type="password" name="password" size="10" maxlength="125" class="txt size100p"  placeholder="-" required /></dd>
						</dl>
					</section>
					<div class="BtM mglra clear_fix">
						<input type="hidden" name="regist_check" value="<?php echo $registCheckKey; ?>">
						<p><button type="submit" class="bkBT mgt30 mgb30 mglra btWtN next" /><?php echo Util::dispLang(Language::WORD_00098);/* パスワード再設定 */?></button></p>
					</div>
				</div>
