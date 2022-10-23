<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
$session->check();

require_once dirname(__FILE__).'/../../../common/inc/data/delivery_address.php';
require_once dirname(__FILE__).'/../../core_sys/inc/sys/product/product_address_del.php';

?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
<?php require dirname(__FILE__).'/../../core_sys/inc/sys/product/product_address_js.php';?>
</head>

<body class="popup fontFace">
<form method="post" action="">
<input type="hidden" name="id" value="<?php echo $id?>">
<!-- WRAPPER -->
<div id="wrapper">
<!-- CONTENTS -->
	<div id="contents" class="clear_fix">
<?php require dirname(__FILE__).'/../../system_parts/layout_block/order/product/prdadddel_layout.php';?>
	</div>
<!-- CONTENTS -->
</div>
<!-- WRAPPER -->
</form>
<?php require dirname(__FILE__).'/../../system_parts/crt_block/body_tag.php';?>
</body>
</html>
