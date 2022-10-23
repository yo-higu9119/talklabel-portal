<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/session_check_mypage.php';

require_once dirname(__FILE__).'/../../../common/inc/data/seminar.php';
require_once dirname(__FILE__).'/../../../common/inc/data/seminar_applicant.php';
require_once dirname(__FILE__).'/../../../common/inc/data/venue_data.php';
require_once dirname(__FILE__).'/../../core_sys/inc/sys/mypage/mypage_sm_common.php';
require_once dirname(__FILE__).'/../../core_sys/inc/sys/mypage/mypage_sm_input_payment.php';

?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
<?php require dirname(__FILE__).'/../../core_sys/inc/sys/payment/pay_scrp.php';?>
<?php require dirname(__FILE__).'/../../core_sys/inc/sys/payment/pay_input_payment_js.php';?>
</head>

<body class="popup fontFace">
<!-- WRAPPER -->
<div id="wrapper">
<!-- CONTENTS -->
	<div id="contents" class="clear_fix">
<?php require dirname(__FILE__).'/../../system_parts/layout_block/mypage/seminar/mysminputpay_layout.php';?>
	</div>
<!-- CONTENTS -->
</div>
<!-- WRAPPER -->
<?php require dirname(__FILE__).'/../../system_parts/crt_block/body_tag.php';?>
</body>
</html>
