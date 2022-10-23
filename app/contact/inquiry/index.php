<?php
ini_set('display_errors', "On");
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/session_check.php';

require_once dirname(__FILE__).'/../../../common/inc/util/form_util.php';
require_once dirname(__FILE__).'/../../../common/inc/data/path_info.php';
require_once dirname(__FILE__).'/../../../common/inc/util/file_util.php';
require_once dirname(__FILE__).'/../../../common/inc/data/input_function.php';
require_once dirname(__FILE__).'/../../../common/inc/data/master_base.php';
require_once dirname(__FILE__).'/../../../common/inc/data/member_data.php';
require_once dirname(__FILE__).'/../../../common/inc/data/inquiry_data.php';
require_once dirname(__FILE__).'/../../../common/inc/data/inquiry_input_function.php';
require_once dirname(__FILE__).'/../../../common/inc/data/inquiry_base.php';
require_once dirname(__FILE__).'/../../../common/inc/util/spl_lib.php';
// $submit_action =  htmlspecialchars(basename(__FILE__).'?s='.$urlKey);
// $inquiryNo = echo $urlKey;
$inquiryNo = 5;
require_once dirname(__FILE__).'/../../core_sys/inc/sys/external/external_cooperation.php';
require_once dirname(__FILE__).'/../../core_sys/inc/sys/contact/contact_sys.php';
require_once dirname(__FILE__).'/../../core_sys/inc/sys/contact/contact.php';
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
<script type="text/javascript">
	function pre_submit(){
		$('input:hidden[name="mode"]').val("pre");
		$('#act').submit();
	}
</script>
</head>

<body class="cnt_det fontFace">
<form id="act" method="post" action="<?php echo htmlspecialchars(basename(__FILE__))?>">
<?php require dirname(__FILE__).'/../../system_parts/crt_block/head_sys_tag.php';?>
<!-- WRAPPER -->
<div id="wrapper">
<!-- HEAD -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/header/common/header_layout_001.php';?>
<!-- HEAD -->
<!-- HEAD SUB -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/headerSub/contact/headerSub_layout_contact_001.php';?>
<!-- HEAD SUB -->
<!-- CONTENTS -->
	<div id="contents" class="clear_fix">
<?php require dirname(__FILE__).'/../../system_parts/layout_block/contact/main/body_layout_001.php';?>
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
