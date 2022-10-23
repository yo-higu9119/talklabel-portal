					<section class="myPhoto">
<?php
$MemImage = $session->getMemberImage();
if ($MemImage != "") {
	if (IS_SMART_PHONE) {
?>
						<figure class="photoArea"><a href="javascript:utilOpenFrame('../photo/photo_prev.php?id=9', false, 0, 320, 450);"><img src="../../core_sys/sys/file/get_member_file.php?id=9&type=_m" /></a></figure>
<?php } else { ?>
						<figure class="photoArea"><a href="javascript:utilOpenFrame('../photo/photo_prev.php?id=9', false, 50, 920, 700);"><img src="../../core_sys/sys/file/get_member_file.php?id=9&type=_m" /></a></figure>
<?php } ?>

<?php } else { ?>
						<figure class="photoArea"><img src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/images/sys/no_photo.gif" /></figure>
<?php } ?>

<?php if (IS_SMART_PHONE) { ?>
<?php } else { ?>
						<p class="myName"><?php echo (array_key_exists('INPUT00003',$SYS_MemInfo->data) && $SYS_MemInfo->data['INPUT00003'] !== "")?$SYS_MemInfo->data['INPUT00003']:''; ?></p>
<?php } ?>
					</section>