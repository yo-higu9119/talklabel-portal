<?php
require_once dirname(__FILE__).'/../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../core_sys/inc/sys/common/session_check.php';

require_once dirname(__FILE__).'/../core_sys/inc/sys/contents/contents.php';
$submit_action =  htmlspecialchars(basename(__FILE__).'?s='.$urlKey.'&c='.$categoryId);
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../system_parts/system_block/common/meta/user_meta.php';?>
<?php require dirname(__FILE__).'/../core_sys/inc/sys/comment/comment_js.php';?>
<link href="<?php echo SYSTEM_TOP_URL; ?>css/top/main.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>css/company/company.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
</head>

<body class="body_compnay">
<!-- TAG MANAGER -->
<?php require dirname(__FILE__).'/../system_parts/crt_block/body_tag.php';?>

<form method="post" action="#">
<?php require dirname(__FILE__).'/../system_parts/crt_block/head_sys_tag.php';?>
<!-- WRAPPER -->
<div id="wrapper">
<!-- HEAD -->
<?php require dirname(__FILE__).'/../system_parts/layout_block/header/common/header_layout_top.php';?>

<!-- HEAD SUB -->
<!-- headerSub_layout_con_det_001.php -->
	<div class="sub-header">
			<h1><?php echo htmlspecialchars($info->title)?></h1>
	</div>
<!-- CONTENTS -->
	<div id="contents" class="clear_fix">
		<?php require dirname(__FILE__).'/../system_parts/layout_block/contents/main/body_layout_004.php';?>
	</div>

<!-- FOOTER SUB -->
<!-- footerSub_layout_001.php -->

<!-- FOOTER -->
<?php require dirname(__FILE__).'/../system_parts/layout_block/footer/common/footer_layout_top.php';?>

</div>
<!-- WRAPPER -->

<!-- MOBILE NAV -->
<!-- footer_sys_tag.php -->
</form>
</body>
</html>
