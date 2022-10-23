<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/session_check_mypage.php';

require_once dirname(__FILE__).'/../../../common/inc/data/input_function.php';
require_once dirname(__FILE__).'/../../../common/inc/data/member_data.php';
require_once dirname(__FILE__).'/../../../common/inc/data/item_data.php';
require_once dirname(__FILE__).'/../../../common/inc/data/purchase_data.php';
require_once dirname(__FILE__).'/../../../common/inc/data/purchase_ch_data.php';
require_once dirname(__FILE__).'/../../../common/inc/data/seminar.php';
require_once dirname(__FILE__).'/../../../common/inc/data/seminar_applicant.php';
require_once dirname(__FILE__).'/../../core_sys/inc/sys/mypage/mypage_common.php';

$searchStr = (isset($_GET['sr'])?$_GET['sr']:'');
$pageNo = (isset($_GET['p'])?intval($_GET['p']):1);
$categoryId = (isset($_GET['c'])?intval($_GET['c']):0);
$pageDispCntMax = 8;
$categoryGroupId = 4;

require_once dirname(__FILE__).'/../../core_sys/inc/sys/contents/contents_list.php';
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>

</head>

<body class="">
<!-- TAG MANAGER -->
<?php require dirname(__FILE__).'/../../system_parts/crt_block/body_tag.php';?>
<form method="post" action="#">

<!-- HEAD -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/header/common/header_layout_top.php';?>

<!-- HEAD SUB -->
<div class="sub-header">
		<h1>マイページ</h1>
</div>

<!-- CONTENTS -->
	<div id="main" class="clear_fix">
		<div class="main_ti clear_fix">
			<h2 class="bsc_ti"><span>マイページトップ</span></h2>
		</div>
		<div class="mypage_Box clear_fix">
			<div class="mainClnS">
				<?php $categoryId = 27;?>
				<?php require dirname(__FILE__).'/../../system_parts/system_block/contents/con_list/con_list_002.php';?>

				<?php require dirname(__FILE__).'/../../system_parts/system_block/mypage/top/mypage_top.php';?>


			</div>
<?php if (IS_SMART_PHONE) { ?>
<?php } else { ?>
			<div class="sideClnS">
<?php require dirname(__FILE__).'/../../system_parts/layout_block/mypage/side/mypage_side.php';?>
			</div>
<?php } ?>
		</div>
	</div>
<!-- CONTENTS -->

<!-- FOOTER -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/footer/common/footer_layout_top.php';?>

</form>
</body>
</html>
