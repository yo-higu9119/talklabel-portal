			<div class="memberAraType02">
				<nav class="mnavi clear_fix">
					<ul class="mnaviInn clear_fix">
<?php
if($session->isLogin()) {
?>
						<li class="mem_mypage"><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/top/"><?php echo Util::dispLang(Language::WORD_00119);/*�}�C�y�[�W*/?></a></li>
						<li class="mem_logout"><a href="<?php echo SYSTEM_TOP_URL; ?>users/logout/"><?php echo Util::dispLang(Language::WORD_00120);/*���O�A�E�g*/?></a></li>
<?php
} else {
?>
						<li class="mem_login"><a href="<?php echo SYSTEM_TOP_URL; ?>users/login/"><?php echo Util::dispLang(Language::WORD_00121);/*���O�C��*/?></a></li>
						<li class="new_reg"><a href="<?php echo SYSTEM_TOP_URL; ?>users/new_member/"><?php echo Util::dispLang(Language::WORD_00122);/*�V�K����o�^*/?></a></li>
<?php
}
?>
					</ul>
				</nav>
			</div>
