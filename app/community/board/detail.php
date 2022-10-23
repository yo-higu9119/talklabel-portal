<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/session_check.php';

require_once dirname(__FILE__).'/../../core_sys/inc/sys/board/board.php';
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
<?php require dirname(__FILE__).'/../../core_sys/inc/sys/board/board_comment_js.php';?>
</head>

<body class="brd_det fontFace">
<?php require dirname(__FILE__).'/../../system_parts/crt_block/head_sys_tag.php';?>
<!-- WRAPPER -->
<div id="wrapper">
<!-- HEAD -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/header/common/header_layout_top.php';?>
<!-- HEAD -->
<!-- CONTENTS -->
	<div id="contents" class="clear_fix">
<?php require dirname(__FILE__).'/../../system_parts/layout_block/board/main/body_detail_layout_001.php';?>
	</div>
<!-- CONTENTS -->
<!-- FOOTER -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/footer/common/footer_layout_top.php';?>
<!-- FOOTER -->
</div>
<!-- WRAPPER -->
<?php require dirname(__FILE__).'/../../system_parts/crt_block/footer_sys_tag.php';?>
<?php require dirname(__FILE__).'/../../system_parts/crt_block/body_tag.php';?>
</body>
</html>
