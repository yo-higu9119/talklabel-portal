<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/session_check.php';

require_once dirname(__FILE__).'/../../core_sys/inc/sys/contents/contents.php';
$submit_action =  htmlspecialchars(basename(__FILE__).'?s='.$urlKey.'&c='.$categoryId);
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
<?php require dirname(__FILE__).'/../../core_sys/inc/sys/comment/comment_js.php';?>
<link href="<?php echo SYSTEM_TOP_URL; ?>css/top/main.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">

</head>
<body>
  <!-- TAG MANAGER -->
  <?php require dirname(__FILE__).'/../../system_parts/crt_block/body_tag.php';?>

  <!-- HEAD -->
  <?php require dirname(__FILE__).'/../../system_parts/layout_block/header/common/header_layout_top.php';?>

<main class="">

  <div class="sub-header">
			<h1>よくある質問</h1>
	</div>
  <div class="qa-header first">
      <div class="container">
        <h2><a href="../faq/?s=first_reminder">＜&nbsp;はじめにお読み下さい</a></h2>
      </div>
  </div>

    <div class="container">
      <div class="qa-main">
        <!-- 記事の中身 -->
        <div class="qa-contents">
          <?php require dirname(__FILE__).'/../../system_parts/layout_block/contents/main/body_layout_005.php';?>
        </div>
      </div>
    </div>

</main>

<!-- FOOTER -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/footer/common/footer_layout_top.php';?>

</body>
</html>
