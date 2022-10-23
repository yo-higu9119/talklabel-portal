<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
require_once dirname(__FILE__).'/../../../common/inc/util/util.php';
$session = new Session();

require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/pop_upload.php';
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
<?php require dirname(__FILE__).'/../inc/pop_up_js.php';?>
</head>

<body class="popup fontFace">
<form id="act" method="post" enctype="multipart/form-data" action="upload.php" target="up_frame">
<!-- WRAPPER -->
<div id="wrapper">
<!-- CONTENTS -->
	<div id="contents" class="clear_fix">
<?php require dirname(__FILE__).'/../../system_parts/layout_block/fileup/main/upload_layout.php';?>
	</div>
<!-- CONTENTS -->
</div>
<!-- WRAPPER -->
<iframe name="up_frame" id="up_frame" style="width: 1px; height: 1px; border: 0px;"></iframe>
</form>
<?php require dirname(__FILE__).'/../../system_parts/crt_block/body_tag.php';?>
</body>
</html>
