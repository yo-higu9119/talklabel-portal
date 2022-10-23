<?php if($session->isNativeApp()){ ?>
<?php }else{ ?>
	<footer id="footer" class="footDez001">
		<div class="footer_innT clear_fix">
			<div class="footer_innTM">
<?php require dirname(__FILE__).'/../../../system_block/common/tag_parts/pagetop_block.php';?>
			</div>
		</div>
		<div class="footer_innM clear_fix">
			<div class="footer_innML">
<?php require dirname(__FILE__).'/../../../system_block/common/tag_parts/address_block.php';?>
			</div>
			<div class="footer_innMR">
			</div>
		</div>
		<div class="footer_innU clear_fix">
			<div class="footer_innUM">
<?php require dirname(__FILE__).'/../../../system_block/common/tag_parts/copy_block.php';?>
			</div>
		</div>
	</footer>
<?php } ?>
