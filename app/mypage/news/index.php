<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/session_check.php';

require_once dirname(__FILE__).'/../../../common/inc/data/input_function.php';
require_once dirname(__FILE__).'/../../../common/inc/data/member_data.php';
require_once dirname(__FILE__).'/../../../common/inc/data/item_data.php';
require_once dirname(__FILE__).'/../../../common/inc/data/purchase_data.php';
require_once dirname(__FILE__).'/../../../common/inc/data/purchase_ch_data.php';
require_once dirname(__FILE__).'/../../../common/inc/data/seminar.php';
require_once dirname(__FILE__).'/../../../common/inc/data/seminar_applicant.php';
require_once dirname(__FILE__).'/../../core_sys/inc/sys/mypage/mypage_common.php';

require_once dirname(__FILE__).'/../../core_sys/inc/sys/contents/contents.php';
$submit_action =  htmlspecialchars(basename(__FILE__).'?s='.$urlKey.'&c='.$categoryId);
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
<?php require dirname(__FILE__).'/../../core_sys/inc/sys/comment/comment_js.php';?>
</head>
<body>
<!-- TAG MANAGER -->
<?php require dirname(__FILE__).'/../../system_parts/crt_block/body_tag.php';?>

<!-- HEAD -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/header/common/header_layout_top.php';?>

<main class="">
  <div class="sub-header">
			<h1>マイページ</h1>
	</div>
  <div id="main" class="clear_fix">
    <div class="main_ti clear_fix">
      <h2 class="bsc_ti"><span>TalkLabelの禁止事項</span></h2>
    </div>
    <div class="mypage_Box clear_fix">
      <div class="mainClnS">
        <!-- 記事の中身 -->
        <div class="qa-contents">
          <?php require dirname(__FILE__).'/../../system_parts/layout_block/contents/main/body_layout_006.php';?>
        </div>


      </div>
<?php if (IS_SMART_PHONE) { ?>
<?php } else { ?>
      <div class="sideClnS">
<?php require dirname(__FILE__).'/../../system_parts/layout_block/mypage/side/mypage_side.php';?>
      </div>
<?php } ?>
    </div>
  </div>

</main>

<!-- FOOTER -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/footer/common/footer_layout_top.php';?>

</body>
</html>
