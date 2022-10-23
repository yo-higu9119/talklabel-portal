	<div id="main" class="clear_fix">
<?php require dirname(__FILE__).'/../../../system_block/mypage/post/mypost_title.php';?>
<?php require dirname(__FILE__).'/../../../system_block/mypage/post/mypost_navi04_sp.php';?>
		<div class="mypage_Box clear_fix">
			<div class="mainClnS">
<?php require dirname(__FILE__).'/../../../system_block/mypage/post/mypost_navi04_pc.php';?>
<?php require dirname(__FILE__).'/../../../system_block/mypage/post/mypage_postcom.php';?>
			</div>
<?php if (IS_SMART_PHONE) { ?>
<?php } else { ?>
			<div class="sideClnS">
<?php require dirname(__FILE__).'/../../../layout_block/mypage/side/mypage_side.php';?>
			</div>
<?php } ?>
		</div>
	</div>
