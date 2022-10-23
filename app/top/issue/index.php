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
							<h1>TalkLabel使い方詳細</h1>
			</div>

			<section class="howto">
							<div class="container">
											<div class="howto__box">
															<div class="item">
																			<img src="../../images/top/icon-howto-1.png" alt="" class="icon">
																			<div class="item__text">
																							<h3>LINE公式アカウントをハブ的利用</h3>
																							<p>SNSや資料請求といった検討段階が浅い層をLINE公式アカウントに誘導することで、コミュニケーションを取れる機会が増える。</p>
																			</div>
															</div>
															<div class="item">
																			<img src="../../images/top/icon-howto-2.png" alt="" class="icon">
																			<div class="item__text">
																							<h3>LINE公式アカウントで<br class="sp">コミュニケーション改善</h3>
																							<p>電話や対面での営業だと口頭でのやりとりが基本で、伝えるべき情報量が多くなりがち。LINE公式アカウントのチャットを利用することでHPのURLを送ったり、画像や動画を利用するなど工夫で効率よく情報を送ることもできるし、文字のコミュニケーションなら読み直しもできるので、相手に情報の消化不良を起こさせずにアプローチができる。</p>
																			</div>
															</div>
															<div class="item">
																			<img src="../../images/top/icon-howto-3.png" alt="" class="icon">
																			<div class="item__text">
																							<h3>LINE公式アカウントの個別対応で<br class="sp">オーダーメイド感を演出</h3>
																							<p>メルマガだと1対多数という感じが強いし、SMSだと企業からの緊急連絡感が強く、どちらも一方的に連絡が来るというイメージが強い。しかしLINE公式アカウントは1対1感が強く、お互いにメッセージのやりとりをするという前提イメージがあるためコミュニケーションを取りやすい。</p>
																			</div>
															</div>
											</div>
							</div>
			</section>

			<section class="anxiety">
							<div class="container">
											<div class="anxiety__title">
															<h2>でも、<br class="sp">LINE公式アカウントって…</h2>
											</div>
											<ul>
															<li>
																	<div class="anxiety__img">
																			<img src="../../images/top/icon-anxiety-1.png" alt="" class="icon">
																	</div>
																	<p>友だち登録数が少ないと<br>意味ないんじゃないの？</p>
															</li>
															<li>
																	<div class="anxiety__img">
																			<img src="../../images/top/icon-anxiety-2.png" alt="" class="icon">
																	</div>
																	<p>メッセージ数によっては<br>コストが高くなるんじゃない？</p>
															</li>
															<li>
																	<div class="anxiety__img">
																			<img src="../../images/top/icon-anxiety-3.png" alt="" class="icon">
																	</div>
																	<p>ブロックされ<br>やすいんじゃないの？</p>
															</li>
											</ul>
							</div>
			</section>

			<section class="solution">
							<div class="container">
											<div class="solution__title">
															<h2>そんなLINE公式アカウントで<br>抱えがちな問題を解決するのが<br class="nb">TalkLabelです！</h2>
											</div>
											<ul>
															<li>個別対応により成約率アップ</li>
															<li>段階に合わせて必要なメッセージを必要な分だけ送ればいいから無駄が減る</li>
															<li>見込み客の状態にあったメッセージを届けられるのでブロック率が減る</li>
											</ul>
							</div>
			</section>

			<section class="map">
							<div class="map__title">
											<h2>一人一人のお客様に<br class="sp">合わせた配信ができる<br>マーケティングツール</h2>
											<img src="../../images/top/tool-image.png" alt="">
							</div>
							<div class="map-bg">
									<div class="container mini">
											<div class="map__image">
															<h3>TalkLabelを使った<br class="sp">配信設定のイメージ</h3>
															<img src="../../images/top/map-image.png" alt="" class="pc">
															<img src="../../images/top/map-image-sp.png" alt="" class="sp">
											</div>
											<div class="map__function">
													<h3>メッセージ配信系の機能</h3>
													<ul>
															<li>
																	<div class="map__function__img">
																			<img src="../../images/top/icon-map-1.png" alt="自動応答" class="icon">
																	</div>
																	<p>指定のキーワードや時間帯を設定して、自動で返信することができる機能です。</p>
															</li>
															<li>
																	<div class="map__function__img">
																			<img src="../../images/top/icon-map-4.png" alt="タグ付け" class="icon">
																	</div>
																	<p>URLクリックなど、行動履歴を残すための目印を付けることができる機能です。</p>
															</li>
															<li>
																	<div class="map__function__img">
																			<img src="../../images/top/icon-map-2.png" alt="回答フォーム" class="icon">
																	</div>
																	<p>フォームの回答者、未回答者に対して、配信内容を分けることができる機能です。</p>
															</li>
															<li>
																	<div class="map__function__img">
																			<img src="../../images/top/icon-map-5.png" alt="シナリオ配信" class="icon">
																	</div>
																	<p>事前に作成しておいたメッセージを指定のタイミングに自動配信する機能です。</p>
															</li>
															<li>
																	<div class="map__function__img">
																			<img src="../../images/top/icon-map-3.png" alt="リマインダ" class="icon">
																	</div>
																	<p>予定の時刻や予定時刻の時間前に、お知らせメッセージを送る機能です。</p>
															</li>
															<li>
																	<div class="map__function__img">
																			<img src="../../images/top/icon-map-6.png" alt="スケジュール配信" class="icon">
																	</div>
																	<p>毎日や毎週など決まったスケジュールに対して自動でメッセージ送信をする機能です。</p>
															</li>
													</ul>
											</div>
									</div>
							</div>

							<div class="rich-menu blue-bg">
									<div class="container">
											<div class="rich-menu__box">
													<div class="rich-menu__text">
															<h3>お客様の行動に合わせて<br>リッチメニューが切替わります</h3>
															<p class="small">表示するリッチメニューは、性別、年齢などのユーザー属性ごとに変更することができます。またアンケートフォーム回答後など、行動に合わせても切り替わるため、お客様の状態に合わせて、最適なリッチメニューを表示することができます。</p>
													</div>
													<div class="rich-menu__img">
															<div class="rich-menu__img--item">
																	<img src="../../images/top/rich-menu-image.png" alt="リッチメニュー切り替わり">
															</div>
													</div>
											</div>
											<div class="btn grn2">
													<a href="../function/?s=message">その他の機能も見る</a>
											</div>
									</div>
							</div>
			</section>

			<section class="up">
							<div class="container">
											<div class="up__box">
															<div class="item">
																			<div class="item__title">効率UP</div>
																			<p class="small">メッセージを事前に設定しておけば、自動でメッセージ配信することができます。</p>
															</div>
															<div class="item">
																			<div class="item__title">売上UP</div>
																			<p class="small">全ての配信データ、お客様の様々な行動データを取得し、売上を伸ばすための戦略が立てやすくなります。</p>
															</div>
															<div class="item">
																			<div class="item__title">特別感UP</div>
																			<p class="small">お客様の状態に合った自動の個別対応、表示画面の切替により、個別で対応しているような特別感を演出できます。</p>
															</div>
											</div>
							</div>
			</section>

			<!-- <section class="consultant-support grade-bg">
							<div class="container">
									<div class="consultant-support_content">
											<div class="consultant-support_content_left">
													<h2>専属コンサルタントによる<br>事業計画サポート</h2>
													<div class="btn dt">
															<a href="">コンサルタントに相談する</a>
													</div>
											</div>
											<div class="consultant-support_content_right">
													<div class="content_box">
															<img src="../../images/top/icon-consul-1.png" alt="" class="icon">
															<div class="content_box_text">
																			<h3>マーケティング戦略</h3>
																	<p class="small">LINEを貴社のマーケティングに組み込んだ戦略の提案</p>
															</div>
													</div>
													<div class="content_box vertical">
															<img src="../../images/top/icon-consul-2.png" alt="" class="icon">
															<div class="content_box_text">
																			<h3>導入のサポート</h3>
																	<p class="small">貴社のマーケティングに合わせたTalkLabelの設定支援</p>
															</div>
													</div>
													<div class="content_box">
															<img src="../../images/top/icon-consul-3.png" alt="" class="icon">
															<div class="content_box_text">
																			<h3>データ分析・改善</h3>
																	<p class="small">見込み客の行動データに基づいて問題発見、解決案の提案</p>
															</div>
													</div>
											</div>
											<div class="btn nb">
													<a href="">コンサルタントに相談する</a>
											</div>
									</div>
							</div>
					</section> -->

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
