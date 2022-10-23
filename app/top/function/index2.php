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
<?php //require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta_2.php';?>
<?php require dirname(__FILE__).'/../../core_sys/inc/sys/comment/comment_js.php';?>
<link href="<?php echo SYSTEM_TOP_URL; ?>css/tab/tab.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>css/top/main.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">

</head>
<body>
  <!-- TAG MANAGER -->
  <?php require dirname(__FILE__).'/../../system_parts/crt_block/body_tag.php';?>

  <!-- HEAD -->
  <?php require dirname(__FILE__).'/../../system_parts/layout_block/header/common/header_layout_top_2.php';?>

<main class="body_function">

  <div class="sub-header">
			<h1>TalkLabel機能詳細</h1>
	</div>
  <!-- 記事の中身 -->
  <div id="contents" class="clear_fix">
    <?php require dirname(__FILE__).'/../../system_parts/layout_block/contents/main/body_layout_004.php';?>
  </div>

  <section class="function green-bg2">
      <div class="container">
          <div class="function__title black">
              <h2>その他の機能を見る</h2>
          </div>
          <ul>
              <li>
                  <a href="../../top/function/index2.php?s=message">
                      <p>メッセージ配信</p>
                      <div class="function__img">
                          <img src="../../images/top/icon-function-1.png" alt="" class="icon">
                      </div>
                  </a>
              </li>
              <li>
                  <a href="../../top/function/index2.php?s=action">
                      <p>アクション編集</p>
                      <div class="function__img">
                          <img src="../../images/top/icon-function-2.png" alt="" class="icon">
                      </div>
                  </a>
              </li>
              <li>
                  <a href="../../top/function/index2.php?s=analytics">
                      <p>データ分析</p>
                      <div class="function__img">
                          <img src="../../images/top/icon-function-3.png" alt="" class="icon">
                      </div>
                  </a>
              </li>
              <li>
                  <a href="../../top/function/index2.php?s=manage">
                      <p>アカウント管理</p>
                      <div class="function__img">
                          <img src="../../images/top/icon-function-4.png" alt="" class="icon">
                      </div>
                  </a>
              </li>
          </ul>
      </div>
  </section>

  <!-- 資料請求 -->
  <?php require dirname(__FILE__).'/../../system_parts/layout_block/top/main/body_layout_contact_001.php';?>

</main>

<!-- FOOTER -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/footer/common/footer_layout_top_2.php';?>

<script src="/../../js/tab.js"></script>
</body>
</html>
