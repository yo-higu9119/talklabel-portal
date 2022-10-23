<div class="clear_fix">
	<section class="myPhoto">
<?php
$MemImage = $session->getMemberImage();
if ($MemImage != "") {
if (IS_SMART_PHONE) {
?>
		<figure class="photoArea"><a href="javascript:utilOpenFrame('../photo/photo_prev.php?id=9', false, 0, 320, 450);"><img src="../../../core_sys/sys/file/get_member_file.php?id=9&type=_m" /></a></figure>
<?php } else { ?>
		<figure class="photoArea"><a href="javascript:utilOpenFrame('../photo/photo_prev.php?id=9', false, 50, 920, 700);"><img src="../../../core_sys/sys/file/get_member_file.php?id=9&type=_m" /></a></figure>
<?php } ?>

<?php } else { ?>
		<figure class="photoArea"><img src="<?php echo SYSTEM_TOP_URL; ?>images/site/mypage/no_photo.png" /></figure>
<?php } ?>

<?php if (IS_SMART_PHONE) { ?>
<?php } else { ?>
		<p class="myName"><?php echo (array_key_exists('INPUT00003',$SYS_MemInfo->data) && $SYS_MemInfo->data['INPUT00003'] !== "")?$SYS_MemInfo->data['INPUT00003']:''; ?></p>
<?php } ?>
	</section>
	<div class="mypagenav">
		<nav>
			<ul class="clear_fix">
				<li><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/top/" class="">マイページトップ</a></li>
				<li><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/prof/" class="">プロフィール編集</a></li>
				<li><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/prof/password.php" class="">パスワード変更</a></li>
				<li><a href="<?php echo SYSTEM_TOP_URL; ?>users/logout/" class="">ログアウト</a></li>
			</ul>
		</nav>
	</div>
</div>
