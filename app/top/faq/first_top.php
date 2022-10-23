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

  <div class="container">
    <div class="qa-top">
      <div class="qa-top__ListBox first">
        <h2>はじめにお読み下さい</h2>
        <div class="qa-top__ListBox--contents">
          <?php $categoryId = 23;?>
          <?php require dirname(__FILE__).'/../../system_parts/system_block/contents/con_list/qa_list_001.php';?>
        </div>
      </div>

      <div class="qa-top__ListBox">
        <h2>使い方</h2>

        <div class="qa-top__ListBox--contents">
          <?php $categoryId = 13; $topUrlKey = 'rich';?>
          <h3>リッチメニュー</h3>
          <?php require dirname(__FILE__).'/../../system_parts/system_block/contents/con_list/qa_list_002.php';?>
          <div class="qa-top__ListBox--button">
            <a href="../faq-tool/?s=<?php echo $topUrlKey;?>&c=<?php echo $categoryId;?>">詳細を見る</a>
          </div>
        </div>

        <div class="qa-top__ListBox--contents">
          <?php $categoryId = 12; $topUrlKey = 'staff';?>
          <h3>スタッフ設定 </h3>
          <?php require dirname(__FILE__).'/../../system_parts/system_block/contents/con_list/qa_list_002.php';?>
          <div class="qa-top__ListBox--button">
            <a href="tool.php?s=<?php echo $topUrlKey;?>&c=<?php echo $categoryId;?>">詳細を見る</a>
          </div>
        </div>

        <div class="qa-top__ListBox--contents">
          <?php $categoryId = 17; $topUrlKey = 'answer_form';?>
          <h3>回答フォーム</h3>
          <?php require dirname(__FILE__).'/../../system_parts/system_block/contents/con_list/qa_list_002.php';?>
          <div class="qa-top__ListBox--button">
            <a href="tool.php?s=<?php echo $topUrlKey;?>&c=<?php echo $categoryId;?>">詳細を見る</a>
          </div>
        </div>

        <div class="qa-top__ListBox--contents">
          <?php $categoryId = 18; $topUrlKey = 'template_messages';?>
          <h3>テンプレートメッセージ</h3>
          <?php require dirname(__FILE__).'/../../system_parts/system_block/contents/con_list/qa_list_002.php';?>
          <div class="qa-top__ListBox--button">
            <a href="tool.php?s=<?php echo $topUrlKey;?>&c=<?php echo $categoryId;?>">詳細を見る</a>
          </div>
        </div>

        <div class="qa-top__ListBox--contents">
          <?php $categoryId = 20; $topUrlKey = 'friend_add_action';?>
          <h3>友達追加時設定</h3>
          <?php require dirname(__FILE__).'/../../system_parts/system_block/contents/con_list/qa_list_002.php';?>
          <div class="qa-top__ListBox--button">
            <a href="tool.php?s=<?php echo $topUrlKey;?>&c=<?php echo $categoryId;?>">詳細を見る</a>
          </div>
        </div>

        <div class="qa-top__ListBox--contents">
          <?php $categoryId = 21; $topUrlKey = 'channel_settings';?>
          <h3>チャネル設定</h3>
          <?php require dirname(__FILE__).'/../../system_parts/system_block/contents/con_list/qa_list_002.php';?>
          <div class="qa-top__ListBox--button">
            <a href="tool.php?s=<?php echo $topUrlKey;?>&c=<?php echo $categoryId;?>">詳細を見る</a>
          </div>
        </div>

      </div>

    </div>
  </div>

</main>

<!-- FOOTER -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/footer/common/footer_layout_top.php';?>

</body>
</html>
