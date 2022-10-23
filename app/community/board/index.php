<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/session_check.php';

$pageNo = (isset($_GET['p'])?intval($_GET['p']):1);
$categoryId = (isset($_GET['c'])?intval($_GET['c']):0);
$boardCategoryId = (isset($_GET['bc'])?intval($_GET['bc']):0);
$boardSortType = (isset($_GET['bs'])?intval($_GET['bs']):0);
$pageDispCntMax = 20;
$boardCategoryGroupId = 1;

require_once dirname(__FILE__).'/../../core_sys/inc/sys/board/board_list.php';
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
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
<?php require dirname(__FILE__).'/../../system_parts/layout_block/board/main/body_layout_001.php';?>
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
