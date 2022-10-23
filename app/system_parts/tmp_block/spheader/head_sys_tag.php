<?php if($session->isNativeApp()){ ?>
<div class="spview">
<?php }else{ ?>
<?php if (IS_SMART_PHONE) { ?>
<div class="spHeadNavi spview">
	<section id="spheader" class="sphead Dez001">
<?php require dirname(__FILE__).'/../system_block/common/navi/spheader_001.php';?>
	</section>
<?php }else{ ?>
<div class="spHeadNavi pcview">
<?php } ?>
<?php } ?>
