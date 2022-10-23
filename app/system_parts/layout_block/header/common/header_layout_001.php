<?php if($session->isNativeApp()){ ?>
<?php }else{ ?>
<?php if (IS_SMART_PHONE) { ?>
<?php } else { ?>
	<header id="header" class="headDez002">
		<section class="scroll-nml">
			<div class="header_innT clear_fix">
				<div class="header_innTL">
<?php require dirname(__FILE__).'/../../../dez_block/h1txt.php';?>
				</div>
				<div class="header_innTR">
<?php require dirname(__FILE__).'/../../../system_block/common/navi/snavi_001.php';?>
				</div>
			</div>
			<div class="header_innM clear_fix">
				<div class="header_innML">
<?php require dirname(__FILE__).'/../../../system_block/common/parts/site_logo.php';?>
				</div>
				<div class="header_innMR">
<?php require dirname(__FILE__).'/../../../dez_block/headmem.php';?>
				</div>
			</div>
			<div class="header_innU clear_fix">
				<div class="header_innUM">
<?php require dirname(__FILE__).'/../../../system_block/common/navi/gnavi_001.php';?>
				</div>
			</div>
		</section>
		<section class="scroll-fix">
			<div class="header_innST clear_fix">
				<div class="header_innSTL">
<?php require dirname(__FILE__).'/../../../system_block/common/navi/gnavis_001.php';?>
				</div>
				<div class="header_innSTR">
<?php require dirname(__FILE__).'/../../../system_block/common/navi/mnavi_002.php';?>
				</div>
			</div>
		</section>
		</div>
	</header>
<?php } ?>
<?php } ?>
