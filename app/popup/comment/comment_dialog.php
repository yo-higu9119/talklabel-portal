<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
$session->check();

$sErr = "";

if(isset($_GET['id']) && is_numeric($_GET['id']) && isset($_GET['t']) && trim($_GET['t']) !== ""){
	$id = intval($_GET['id']);
	$type = trim($_GET['t']);
}else{
	$sErr = Util::dispLang(Language::WORD_00012);/* アクセス情報が不正です*/
}

if($sErr == ""){
	if($type == "ed"){//編集
	}else if($type == "de"){//削除
	}else if($type == "rs"){//コメント返信
	}else if($type == "rp"){//通報
	}else{
		$sErr = Util::dispLang(Language::WORD_00012);/* アクセス情報が不正です*/
	}
}
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
</head>

<body class="popup fontFace">
<form method="post" action="">
<input type="hidden" name="id" value="61">
<!-- WRAPPER -->
<div id="wrapper">
<!-- CONTENTS -->
	<div id="contents" class="clear_fix">
<?php require dirname(__FILE__).'/../../system_parts/layout_block/comment/main/comment_layout.php';?>
	</div>
<!-- CONTENTS -->
</div>
<!-- WRAPPER -->
</form>
<?php require dirname(__FILE__).'/../../system_parts/crt_block/body_tag.php';?>
</body>
</html>
