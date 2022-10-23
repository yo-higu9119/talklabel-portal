<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../../common/inc/util/form_util.php';
require_once dirname(__FILE__).'/../../../common/inc/data/path_info.php';
require_once dirname(__FILE__).'/../../../common/inc/util/file_util.php';
require_once dirname(__FILE__).'/../../../common/inc/data/input_function.php';
require_once dirname(__FILE__).'/../../../common/inc/data/master_base.php';
require_once dirname(__FILE__).'/../../../common/inc/data/member_data.php';

require_once dirname(__FILE__).'/../../../common/inc/data/item_data.php';
require_once dirname(__FILE__).'/../../../common/inc/data/purchase_data.php';
require_once dirname(__FILE__).'/../../../common/inc/data/purchase_ch_data.php';

require_once dirname(__FILE__).'/../../core_sys/inc/sys/external/external_cooperation.php';
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/new_reg.php';

?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
</head>

<body class="reg_det fontFace">
<form id="act" method="post" action="<?php echo htmlspecialchars(basename(__FILE__))?>">
<?php require dirname(__FILE__).'/../../system_parts/crt_block/head_sys_tag.php';?>
<!-- WRAPPER -->
<div id="wrapper">
<!-- HEAD -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/header/common/header_layout_001.php';?>
<!-- HEAD -->
<!-- HEAD SUB -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/headerSub/users/headerSub_layout_newreg_001.php';?>
<!-- HEAD SUB -->
<!-- CONTENTS -->
	<div id="contents" class="clear_fix">
<?php require dirname(__FILE__).'/../../system_parts/layout_block/users/new_member/newreg_layout.php';?>
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
