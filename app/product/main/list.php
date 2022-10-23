<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/session_check.php';

$pageNo = (isset($_GET['p'])?intval($_GET['p']):1);
$categoryId = (isset($_GET['c'])?intval($_GET['c']):0);
$productCategoryId = (isset($_GET['pc'])?intval($_GET['pc']):0);
$pageDispCntMax = 30;
$categoryGroupId = 1;

$firstDateStr = date('Y-m-d', mktime(0, 0, 0, intval(date('n')), intval(date('d')), intval(date('Y'))));

require_once dirname(__FILE__).'/../../core_sys/inc/sys/product/product_list.php';
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
</head>

<body class="prd_list fontFace">
<form method="post" action="<?php echo basename(__FILE__)?>" id="act">
<?php require dirname(__FILE__).'/../../system_parts/crt_block/head_sys_tag.php';?>
<!-- WRAPPER -->
<div id="wrapper">
<!-- HEAD -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/header/common/header_layout_001.php';?>
<!-- HEAD -->
<!-- HEAD SUB -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/headerSub/product/headerSub_layout_prd_li_001.php';?>
<!-- HEAD SUB -->
<!-- CONTENTS -->
	<div id="contents" class="clear_fix">
<?php require dirname(__FILE__).'/../../system_parts/layout_block/product/list/body_list_layout_001.php';?>
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
