				<div class="comBox">
<?php
if($message !== '') {
		echo '<p class="Art mgt10 mgb10">'.htmlspecialchars($message).'</p>';
}
?>
					<section class="CautTxtW">
						<p><?php echo Util::dispLang(Language::WORD_00089);/* 登録時のメールアドレスを入力の上、「パスワード問合わせ」ボタンをクリックしてください。 */?></p>
					</section>
					<section class="comBoxInn InputFormT mgt30">
						<dl class="clear_fix">
							<dt class="clear_fix"><p><?php echo Util::dispLang(Language::WORD_00090);/* メールアドレス */?> <span class="IcoBox NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/* 必須 */?></span></p></dt>
							<dd><?php echo FormUtil::textBox('mailaddress', '', 10, 125, 'txt size100p', '-', 'required')?></dd>
						</dl>
					</section>
					<div class="BtM mglra clear_fix">
						<p><button type="submit" class="whBT mgt30 mgb30 mglra btWtN next" /><?php echo Util::dispLang(Language::WORD_00091);/* パスワード問合わせ */?></button></p>
					</div>
				</div>
