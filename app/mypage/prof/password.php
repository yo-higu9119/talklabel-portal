<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/session_check_mypage.php';

require_once dirname(__FILE__).'/../../../common/inc/util/form_util.php';
require_once dirname(__FILE__).'/../../../common/inc/data/path_info.php';
require_once dirname(__FILE__).'/../../../common/inc/util/file_util.php';
require_once dirname(__FILE__).'/../../../common/inc/data/input_function.php';
require_once dirname(__FILE__).'/../../../common/inc/data/master_base.php';
require_once dirname(__FILE__).'/../../../common/inc/data/member_data.php';
require_once dirname(__FILE__).'/../../../common/inc/util/spl_lib.php';
require_once dirname(__FILE__).'/../../core_sys/inc/sys/mypage/mypage_prof_password.php';
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
<?php require dirname(__FILE__).'/../../core_sys/inc/sys/mypage/mypage_member_edit_js.php';?>
</head>

<body class="myprf_det fontFace">
<form method="post" action="#">
<?php require dirname(__FILE__).'/../../system_parts/crt_block/head_sys_tag.php';?>

<!-- HEAD -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/header/common/header_layout_top.php';?>

<!-- HEAD SUB -->
<div class="sub-header">
		<h1>マイページ</h1>
</div>

<!-- CONTENTS -->
<div id="main" class="clear_fix">
	<div class="main_ti clear_fix">
		<h2 class="bsc_ti"><span>パスワードの変更</span></h2>
	</div>
	<div class="mypage_Box clear_fix">
		<div class="mainClnS">
<?php require dirname(__FILE__).'/../../system_parts/system_block/mypage/prof/mypage_pass.php';?>
		</div>
<?php if (IS_SMART_PHONE) { ?>
<?php } else { ?>
		<div class="sideClnS">
<?php require dirname(__FILE__).'/../../system_parts/layout_block/mypage/side/mypage_side.php';?>
		</div>
<?php } ?>
	</div>
</div>

<!-- FOOTER -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/footer/common/footer_layout_top.php';?>

</form>
</body>
</html>
