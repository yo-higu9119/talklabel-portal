<?php
if($session->isLogin()) {
?>
				<ul class="dropdwn member_info_pd">
					<li>
						<div class="member_info_thumbnail"><?php
$MemImage = $session->getMemberImage();
if ($MemImage != "") {
?>
							<img src="<?php echo SYSTEM_TOP_URL; ?>core_sys/sys/file/get_member_file.php?id=9" />
<?php } else { ?>
							<img src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/images/sys/no_photo.gif" />
<?php } ?></div>
						<div class="member_info_pd_txt">
							<p class="LoginName"><?php echo $session->getMemberName(); ?></p>
							<p class="LoginCourse"><?php echo $session->getMemberNumber(); ?></p>
						</div>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/push/member_fmcicon.php';?>
						<ul class="dropdwn_menu member_info_pd_menu">
<?php require dirname(__FILE__).'/../../../../core_sys/inc/push/pwa-push_pd.php';?>
<?php
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();
if($systemInfo->common_id == 0){
?>
							<li><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/top/"><?php echo Util::dispLang(Language::WORD_00119);/*マイページ*/?></a></li>
<?php } ?>
							<li><a href="<?php echo SYSTEM_TOP_URL; ?>users/logout/"><?php echo Util::dispLang(Language::WORD_00120);/*ログアウト*/?></a>
						<ul>
					</li>
				</ul>
<?php
}
?>
