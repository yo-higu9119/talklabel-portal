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

$categolyId = 3;/* コンテンツのCMS categoly ID */

$systemData = new SystemData($session->getMemberName());
$systemInfo = $systemData->getInfo();
$prohibition = explode(',',str_replace("\r\n",",",$systemInfo->cms_prohibition));

require_once dirname(__FILE__).'/../../../common/inc/data/article_comment_data.php';
$articleCommentData = new ArticleCommentData($session->getMemberName());

$searchInfoList = array();
$searchInfoList['search_member_id'] = $session->getMemberId();
$searchInfoList['search_not_status'] = 2;
$articleCommentList = $articleCommentData->getInfoList($searchInfoList,1);

$searchInfoList = array();
$searchInfoList['search_x_my_empathy_member_id'] = $session->getMemberId();
$searchInfoList['search_not_status'] = 2;
$articleCommentEmpathyList = $articleCommentData->getInfoList($searchInfoList,1);


?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
</head>

<body class="mypost_det fontFace">
<form method="post" action="#">
<?php require dirname(__FILE__).'/../../system_parts/crt_block/head_sys_tag.php';?>
<!-- WRAPPER -->
<div id="wrapper">
<!-- HEAD -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/header/common/header_layout_001.php';?>
<!-- HEAD -->
<!-- HEAD SUB -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/headerSub/mypage/headerSub_layout_mypost_001.php';?>
<!-- HEAD SUB -->
<!-- CONTENTS -->
	<div id="contents" class="clear_fix">
<?php require dirname(__FILE__).'/../../system_parts/layout_block/mypage/post/mypostcom_layout.php';?>
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
