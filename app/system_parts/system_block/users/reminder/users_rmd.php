				<div class="comBox">
<?php
if($message !== '') {
		echo '<p class="Art mgt10 mgb10">'.htmlspecialchars($message).'</p>';
}
?>
					<section class="CautTxtW">
						<p><?php echo Util::dispLang(Language::WORD_00089);/* �o�^���̃��[���A�h���X����͂̏�A�u�p�X���[�h�⍇�킹�v�{�^�����N���b�N���Ă��������B */?></p>
					</section>
					<section class="comBoxInn InputFormT mgt30">
						<dl class="clear_fix">
							<dt class="clear_fix"><p><?php echo Util::dispLang(Language::WORD_00090);/* ���[���A�h���X */?> <span class="IcoBox NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/* �K�{ */?></span></p></dt>
							<dd><?php echo FormUtil::textBox('mailaddress', '', 10, 125, 'txt size100p', '-', 'required')?></dd>
						</dl>
					</section>
					<div class="BtM mglra clear_fix">
						<p><button type="submit" class="whBT mgt30 mgb30 mglra btWtN next" /><?php echo Util::dispLang(Language::WORD_00091);/* �p�X���[�h�⍇�킹 */?></button></p>
					</div>
				</div>
