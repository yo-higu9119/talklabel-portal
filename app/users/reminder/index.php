<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/reminder.php';
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
</head>

<body class="rmd_det fontFace">
<form method="post" action="<?php echo basename(__FILE__)?>">
<?php require dirname(__FILE__).'/../../system_parts/crt_block/head_sys_tag.php';?>
<!-- WRAPPER -->
<div id="wrapper">
<!-- HEAD -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/header/common/header_layout_001.php';?>
<!-- HEAD -->
<!-- HEAD SUB -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/headerSub/users/headerSub_layout_rmd_001.php';?>
<!-- HEAD SUB -->
<!-- CONTENTS -->
	<div id="contents" class="clear_fix">
<?php require dirname(__FILE__).'/../../system_parts/layout_block/users/reminder/rmd_layout.php';?>
	</div>
<!-- CONTENTS -->
<!-- FOOTER SUB -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/footerSub/common/footerSub_layout_001.php';?>
<!-- FOOTER SUB -->
<!-- FOOTER -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/footer/common/footer_layout_001.php';?>
<!-- FOOTER -->
</div>
<!-- WRAPPER -->
<?php require dirname(__FILE__).'/../../system_parts/crt_block/footer_sys_tag.php';?>
</form>
<?php require dirname(__FILE__).'/../../system_parts/crt_block/body_tag.php';?>
</body>
</html>