	<div id="main" class="clear_fix">
<?php require dirname(__FILE__).'/../../../system_block/mypage/service/mysv_title.php';?>
		<div class="mypage_Box clear_fix">
			<div class="mainClnS">
<?php require dirname(__FILE__).'/../../../system_block/mypage/service/mypage_service.php';?>
			</div>
<?php if (IS_SMART_PHONE) { ?>
<?php } else { ?>
			<div class="sideClnS">
<?php require dirname(__FILE__).'/../../../layout_block/mypage/side/mypage_side.php';?>
			</div>
<?php } ?>
		</div>
	</div>
