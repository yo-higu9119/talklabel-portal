<?php if($session->isNativeApp()){ ?>
<div class="spview">
<?php }else{ ?>
<?php if (IS_SMART_PHONE) { ?>
<div class="spFootNavi spview">
<?php }else{ ?>
<div class="spFootNavi pcview">
<?php } ?>
<?php } ?>