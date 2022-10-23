<?php
require_once dirname(__FILE__) . '/../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__) . '/../../core_sys/inc/sys/common/session_check.php';
require_once dirname(__FILE__) . '/../../../common/inc/util/form_util.php';

require_once dirname(__FILE__) . '/../../core_sys/inc/sys/contents/contents.php';

$submit_action =  htmlspecialchars(basename(__FILE__) . '?s=' . $urlKey . '&step=2');
$submit_action_before =  htmlspecialchars(basename(__FILE__) . '?s=' . $urlKey . '&step=1');
$submit_action_after =  htmlspecialchars(basename(__FILE__) . '?s=' . $urlKey . '&step=3');
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?php //require dirname(__FILE__) . '/../../core_sys/inc/meta/sys_meta.php'; ?>
  <?php require dirname(__FILE__) . '/../../system_parts/system_block/common/meta/user_meta_2.php'; ?>
  <?php require dirname(__FILE__) . '/../../core_sys/inc/sys/comment/comment_js.php'; ?>
  <link href="<?php echo SYSTEM_TOP_URL; ?>css/top/main.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
  <link href="../../css/top/contact.css" rel="stylesheet">
</head>

<body>
<form method="post" id="act" action="<?php echo $submit_action?>">
  <!-- TAG MANAGER -->
  <?php require dirname(__FILE__) . '/../../system_parts/crt_block/body_tag.php'; ?>

  <!-- HEAD -->
  <?php require dirname(__FILE__) . '/../../system_parts/layout_block/header/common/header_layout_top_2.php'; ?>

  <main class="">

    <div class="sub-header">
      <h1>資料請求フォーム</h1>
    </div>

    <div class="container">
      <div class="qa-main">
        <!-- 記事の中身 -->
        <?php require dirname(__FILE__) . '/../../system_parts/layout_block/contents/main/body_layout_005.php'; ?>
      </div>

      <div class="ptLayoutInn">
        <?php require dirname(__FILE__) . '/../../core_sys_custom/inc/sys/contact/form.php'; ?>
      </div>
    </div>
  <!--
  </div>
-->

  </main>

  <!-- FOOTER -->
  <?php require dirname(__FILE__) . '/../../system_parts/layout_block/footer/common/footer_layout_top_2.php'; ?>

</form>
</body>

</html>
