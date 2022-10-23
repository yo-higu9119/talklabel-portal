	<div id="main" class="clear_fix">
<?php require dirname(__FILE__).'/../../../system_block/board/main/board_cate_title.php';?>
		<div class="board_Box clear_fix">
			<div class="mainClnS">
<?php require dirname(__FILE__).'/../../../system_block/board/main/board_input.php';?>
			</div>
<?php if (IS_SMART_PHONE) { ?>
<?php } else { ?>
			<div class="sideClnS">
<?php require dirname(__FILE__).'/../../../layout_block/board/side/board_side.php';?>
			</div>
<?php } ?>
		</div>
	</div>
