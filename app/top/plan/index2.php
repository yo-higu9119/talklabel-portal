<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/session_check.php';
require_once dirname(__FILE__).'/../../core_sys/inc/sys/external/external_cooperation.php';
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php //require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta_2.php';?>
<link href="<?php echo SYSTEM_TOP_URL; ?>css/top/main.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
</head>

<body class="">
<!-- TAG MANAGER -->
<?php require dirname(__FILE__).'/../../system_parts/crt_block/body_tag.php';?>

<form method="post" action="#">
<?php require dirname(__FILE__).'/../../system_parts/crt_block/head_sys_tag.php';?>
<!-- WRAPPER -->
<div id="wrapper">
<!-- HEAD -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/header/common/header_layout_top_2.php';?>

<!-- HEAD SUB -->
<!-- headerSub_layout_con_det_001.php -->
<!-- CONTENTS -->
<main>
		<div class="sub-header">
				<h1>料金プラン</h1>
		</div>
		<section class="plan green-bg2">
				<div class="container">
						<div class="plan-img">
								<div class="plan-img__item">
										<img src="../../images/top/plan-pro-2.png" alt="料金表" class="pc">
										<img src="../../images/top/plan-pro-sp-2.png" alt="料金表" class="sp">
								</div>
						</div>
				</div>
		</section>

		<section class="introduction-flow">
				<div class="container mini">
					<h2>TalkLabel導入までの流れ</h2>
					<div class="flow-box">
						<div class="flow-box__item">
								<div class="flow-box__item--number"><div>STEP<span>01</span></div></div>
								<p>上記の各プランのリンクより、TalkLabelをお申込みください。</p>
						</div>
						<div class="flow-box__item">
								<div class="flow-box__item--number"><div>STEP<span>02</span></div></div>
								<p>登録が完了すると、ご登録時のメールアドレスが届きます。<br>
										メール内に記載のTalkLabelアカウント登録・決済に関するURLをクリックしていただき、情報の入力と決済をお願いします。</p>
						</div>
						<div class="flow-box__item">
								<div class="flow-box__item--number"><div>STEP<span>03</span></div></div>
								<p>LINE公式アカウントを準備お願いします。<br>
										（お持ちのアカウントがある場合、STEP３は飛ばしてください）</p>
						</div>
						<div class="flow-box__item">
								<div class="flow-box__item--number"><div>STEP<span>04</span></div></div>
								<p>TalkLabelとLINE公式を連携させます。<br>
										紐付けは数分で終わり、ご契約者様自身にやっていただく作業になります。</p>
						</div>
						<div class="flow-box__item">
								<div class="flow-box__item--number"><div>STEP<span>05</span></div></div>
								<p>TalkLabelの運用が可能になります。</p>
						</div>
					</div>
					<div class="btn">
							<a href="<?php echo $url_buy_pro;?>">申し込みはこちらから</a>
					</div>
				</div>
		</section>
		<!-- 資料請求 -->
		<?php require dirname(__FILE__).'/../../system_parts/layout_block/top/main/body_layout_contact_001.php';?>
</main>

<!-- FOOTER SUB -->
<!-- footerSub_layout_001.php -->

<!-- FOOTER -->
<?php require dirname(__FILE__).'/../../system_parts/layout_block/footer/common/footer_layout_top_2.php';?>

</div>
<!-- WRAPPER -->

<!-- MOBILE NAV -->
<!-- footer_sys_tag.php -->
</form>
</body>
</html>
