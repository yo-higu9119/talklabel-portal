<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/session_check.php';
require_once dirname(__FILE__).'/../../core_sys/inc/sys/external/external_cooperation.php';
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require dirname(__FILE__).'/../../core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/../../system_parts/system_block/common/meta/user_meta.php';?>
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
<?php require dirname(__FILE__).'/../../system_parts/layout_block/header/common/header_layout_top.php';?>

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
										<img src="../../images/top/plan-pro.png" alt="料金表" class="pc">
										<img src="../../images/top/plan-pro-sp.png" alt="料金表" class="sp">
								</div>
						</div>
				</div>
		</section>

		<!-- <section class="simulation">
				<div class="simulation__title">
						<h2>料金シュミレーション</h2>
				</div>
				<div class="base-text">
						<p>あなたの現状のビジネスモデルに合わせて、<br>
								TalkLabelを利用した場合の運用費を算出できます<Br>
								公式LINE＠の運用費と合わせた金額</p>
				</div>
				<div class="btn">
						<a href="">料金を計算する</a>
				</div>
		</section> -->

		<!-- <section class="entry green-bg2">
				<div class="container">
						<div class="entry__title">
								<h2>お申込み</h2>
						</div>
						<ul>
								<li>
										<div class="plan-name">スタンダード</div>
										<div class="plan-box">
												<div class="entry-fee">4,980<span>円</span></div>
												<div class="btn navy">
														<a href="https://console.talklabel.com/registration">申し込みはこちらから</a>
												</div>
										</div>
								</li>
								<li>
										<div class="plan-name">プロ</div>
										<div class="plan-box">
												<div class="entry-fee">49,800<span>円</span></div>
												<div class="btn navy">
														<a href="https://console.talklabel.com/registration">申し込みはこちらから</a>
												</div>
										</div>
								</li>
								<li>
										<div class="plan-name">エンタープライズ</div>
										<div class="plan-box">
												<div class="entry-fee">要相談</div>
												<div class="btn navy nolink">
														<a href="">お問合せください</a>
												</div>
										</div>
								</li>
						</ul>
				</div>
		</section> -->
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
<?php require dirname(__FILE__).'/../../system_parts/layout_block/footer/common/footer_layout_top.php';?>

</div>
<!-- WRAPPER -->

<!-- MOBILE NAV -->
<!-- footer_sys_tag.php -->
</form>
</body>
</html>
