<?php
if($session->isLogin()) {
?>
				<div class="member_info">
					<div class="member_info_thumbnail"><?php
$MemImage = $session->getMemberImage();
if ($MemImage != "") {
?>
						<img src="<?php echo SYSTEM_TOP_URL; ?>core_sys/sys/file/get_member_file.php?id=9" />
<?php } else { ?>
						<img src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/images/sys/no_photo.gif" />
<?php } ?></div>
					<div class="member_info_txt">
						<p class="LoginName"><?php echo $session->getMemberName(); ?></p>
						<p class="LoginCourse"><?php echo $session->getMemberNumber(); ?></p>
					</div>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/push/member_fmcicon.php';?>
				</div>
				<ul class="pwa_pushBt">
<?php require dirname(__FILE__).'/../../../../core_sys/inc/push/pwa-push.php';?>
				</ul>
<?php
}
?>
