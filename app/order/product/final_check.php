<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/session_check.php';

require_once dirname(__FILE__).'/../../../common/inc/util/form_util.php';
require_once dirname(__FILE__).'/../../../common/inc/data/path_info.php';
require_once dirname(__FILE__).'/../../../common/inc/util/file_util.php';
require_once dirname(__FILE__).'/../../../common/inc/data/input_function.php';
require_once dirname(__FILE__).'/../../../common/inc/data/master_base.php';
require_once dirname(__FILE__).'/../../../common/inc/data/member_data.php';
require_once dirname(__FILE__).'/../../../common/inc/data/product.php';
require_once dirname(__FILE__).'/../../../common/inc/data/product_applicant.php';
require_once dirname(__FILE__).'/../../../common/inc/data/delivery_address.php';

require_once dirname(__FILE__).'/../../core_sys/inc/sys/product/product_finalcheck.php';
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
<?php require dirname(__FILE__).'/../../core_sys/inc/sys/product/delivery_cart_js.php';?>
<?php require dirname(__FILE__).'/../../core_sys/inc/sys/payment/pay_input_check_js.php';?>
</head>

<body class="ordprd_det fontFace">
<?php require dirname(__FILE__).'/../../system_parts/crt_block/head_sys_tag.php';?>
<!-- WRAPPER -->
<div id="wrapper">
<!-- HEAD -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/header/common/header_layout_001.php';?>
<!-- HEAD -->
<!-- HEAD SUB -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/headerSub/product/headerSub_layout_prd_ord_001.php';?>
<!-- HEAD SUB -->
<!-- CONTENTS -->
	<div id="contents" class="clear_fix">
<?php require dirname(__FILE__).'/../../system_parts/layout_block/order/product/body_prdcheck_layout_001.php';?>
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
<?php require dirname(__FILE__).'/../../system_parts/crt_block/body_tag.php';?>
</body>
</html>
