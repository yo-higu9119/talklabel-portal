<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();

require_once dirname(__FILE__).'/../../core_sys/inc/util/language.php';
$isUsetLanguage = CorebloLanguage::isUsetLanguage();
if($isUsetLanguage == 1){
	if(isset($_POST['language'])){
		CorebloLanguage::setLanguageType($_POST['language']);
	}
	CorebloLanguage::getLanguageType();
}else{
	CorebloLanguage::setLanguageType('jp');
	CorebloLanguage::getLanguageType();
}

$message= '';
require_once dirname(__FILE__).'/../../core_sys/inc/sys/external/external_cooperation.php';
require_once dirname(__FILE__).'/../../core_sys/sso/inc/login.php';
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/login.php';
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
</head>

<body class="login_det">
<form method="post" action="<?php echo htmlspecialchars(basename(__FILE__))?>">
<?php require dirname(__FILE__).'/../../system_parts/crt_block/head_sys_tag.php';?>
<!-- TAG MANAGER -->
<?php require dirname(__FILE__).'/../../system_parts/crt_block/body_tag.php';?>

<!-- HEAD -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/header/common/header_layout_top.php';?>

<div class="sub-header">
		<h1>ログイン</h1>
</div>

<!-- CONTENTS -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/users/login/login_layout.php';?>
<!-- CONTENTS -->

<!-- FOOTER -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/footer/common/footer_layout_top.php';?>

</form>
</body>
</html>
