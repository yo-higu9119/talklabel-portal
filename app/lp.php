<?php
require_once dirname(__FILE__).'/core_sys/inc/util/session.php';
$session = new Session(true);
require_once dirname(__FILE__).'/core_sys/inc/sys/common/session_check.php';
require_once dirname(__FILE__).'/core_sys/inc/sys/external/external_cooperation.php';
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php //require dirname(__FILE__).'/core_sys/inc/meta/sys_meta.php';?>
<?php require dirname(__FILE__).'/system_parts/system_block/common/meta/user_meta_2.php';?>
<link href="<?php echo SYSTEM_TOP_URL; ?>css/top/main.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
</head>

<body id="top" class="top grade-bg">
<form method="post" action="#">
<?php require dirname(__FILE__).'/./system_parts/crt_block/head_sys_tag.php';?>
<!-- WRAPPER -->
<div id="wrapper">
<!-- HEAD -->
<?php require dirname(__FILE__).'/./system_parts/layout_block/header/common/header_layout_top_2.php';?>
<!-- HEAD -->
<!-- CONTENTS -->
<main class="top-bg">
		<div class="header-wide">
				<div class="top-header">
						<div class="top-header__img">
								<img src="images/top/header.png" alt="">
						</div>
						<div class="head-copy">
								<h1>商品が売れ続ける仕組みを作り、<br><span>売上の最大化</span>を実現させる</h1>
								<div class="logo">
										<img src="images/top/logo-wht.png" alt="">
										<p>トークラベル</p>
								</div>
						</div>
				</div>
		</div>

		<div class="header-mini">
				<div class="top-header">
						<h1>商品が売れ続ける仕組みを作り<br><span>売上の最大化</span>を実現させる</h1>
						<div class="top-header__img">
								<img src="images/top/header.png" alt="">
						</div>
						<div class="logo">
								<img src="images/top/logo-wht.png" alt="">
								<p>トークラベル</p>
						</div>
				</div>
		</div>

		<section class="result">
				<div class="container">
						<div class="result__title">
								<img src="images/top/icon-crown.png" alt="" class="icon">
								<h2>TalkLabelの導入で<br>こんな成果が出ています</h2>
						</div>
						<div class="result__box">
								<div class="item">
										<h3>アカウントの<br>ブロック率が激減！</h3>
										<div class="funciton">セグメント配信機能</div>
										<img src="images/top/result-img-1.png" alt="セグメント配信機能">
										<p>配信対象を絞ってメッセージ配信<br>することができます</p>
								</div>
								<div class="item">
										<h3>セミナーやイベントなどの<br>予約キャンセル数が減少！</h3>
										<div class="funciton">リマインド配信機能</div>
										<img src="images/top/result-img-2.png" alt="リマインド配信機能">
										<p>イベントの予約後にリマインド<br>メッセージ配信することができます</p>
								</div>
								<div class="item">
										<h3>サービス購入率や<br>リピート率が上昇！</h3>
										<div class="funciton">シナリオ配信機能</div>
										<img src="images/top/result-img-3.png" alt="シナリオ配信機能">
										<p>お客様の行動に合わせて段階的に<br>アプローチをすることができます</p>
								</div>
						</div>
				</div>
		</section>

		<section class="probrem">
				<div class="container">
						<div class="probrem__title">
								<h2>非効率な<br class="sp">アプローチを<br>していませんか？</h2>
						</div>
						<ul>
								<li>
										<div class="probrem__img">
												<img src="images/top/icon-call.png" alt="" class="icon">
										</div>
										<p>電話対応に<br>多くの時間をとられて<br>しまっている。</p>
								</li>
								<li>
										<div class="probrem__img">
												<img src="images/top/icon-message.png" alt="" class="icon">
										</div>
										<p>見込み客だけにメッセージ<br>配信したいのに違う人にも<br>配信してしまう</p>
								</li>
								<li>
										<div class="probrem__img">
												<img src="images/top/icon-block.png" alt="" class="icon">
										</div>
										<p>一斉配信のせいで<br>ブロック数が増えている</p>
								</li>
								<li class="under">
										<div class="probrem__img">
												<img src="images/top/icon-cost.png" alt="" class="icon">
										</div>
										<p>配信数が増えると<br>公式LINEの運用費が高く<br>なってしまう</p>
								</li>
								<li class="under">
										<div class="probrem__img">
												<img src="images/top/icon-group.png" alt="" class="icon">
										</div>
										<p>新規客、見込み客、既存客<br>など友達の整理が<br>できていない</p>
								</li>
								<li class="under">
										<div class="probrem__img">
												<img src="images/top/icon-judg.png" alt="" class="icon">
										</div>
										<p>配信した内容が<br>効果的なのか判断できなく<br>なってしまう。</p>
								</li>
						</ul>
				</div>
		</section>

		<section class="point">
				<div class="container">
						<div class="point__title">
								<h2>TalkLabelで顧客への<br>効率的なアプローチを<br class="sp">実現します</h2>
						</div>
						<div class="point__box">
								<div class="item">
										<div class="item__text">
												<div class="item--mark">
														<img src="images/top/mark.png" alt="">POINT1
												</div>
												<h3>LINEの友達をグループ分けして、<br>グループごとに適切なメッセージ<br class="sp">送信が可能！</h3>
												<div class="item__image nb">
														<img src="images/top/point-image-1.png" alt="年代と地域で配信対象を絞り込む">
												</div>
												<p>LINEの友達を性別・年齢・地域・趣味など…<br>
														顧客情報をもとに、グループ分けをすることができます。<br class="pc">グループごとに適切なメッセージを送信することが可能です。</p>
										</div>
										<div class="item__image dt">
												<img src="images/top/point-image-1.png" alt="年代と地域で配信対象を絞り込む">
										</div>
								</div>
								<div class="item">
										<div class="item__text">
												<div class="item--mark">
														<img src="images/top/mark.png" alt="">POINT2
												</div>
												<h3>細かい分析データを元に<br class="sp">配信内容を改善！</h3>
												<div class="item__image nb">
														<img src="images/top/point-image-2.png" alt="">
												</div>
												<p>どのようなメッセージ内容がよかったのか、<br>
														どのようなお客様に反応が良かったのか、<br>
														配信データを分析することで、お客様の行動に合わせて、<br class="pc">より効果的なメッセージ配信に改善できます！</p>
										</div>
										<div class="item__image dt">
												<img src="images/top/point-image-2.png" alt="">
										</div>
								</div>
								<div class="item">
										<div class="item__text">
												<div class="item--mark">
														<img src="images/top/mark.png" alt="">POINT3
												</div>
												<h3>お客様との<br class="sp">コミュニケーションが途切れない<br>メッセージ自動配信システム</h3>
												<div class="item__image nb">
														<img src="images/top/point-image-3.png" alt="">
												</div>
												<p>友達追加してから、○日後の○時にメッセージを送信する<br class="pc">というシナリオを組むことができます。シナリオを組むことで、<br class="pc">顧客と滞りなくやりとりすることが可能です！</p>
										</div>
										<div class="item__image dt">
												<img src="images/top/point-image-3.png" alt="">
										</div>
								</div>
						</div>
				</div>
		</section>

		<section class="use">
				<div class="container">
						<div class="use__box">
								<div class="item use__img">
										<img src="images/top/use-image.png" alt="" class="dt">
										<img src="images/top/use-image-sp.png" alt="" class="nb">
								</div>
								<div class="item use__text">
										<p>TalkLabel活用方法</p>
										<div class="btn">
												<a href="top/issue/index2.php">使い方の詳細はこちら</a>
										</div>
								</div>
						</div>
				</div>
		</section>

		<section class="function">
        <div class="container">
            <div class="function__title">
                <h2>TalkLabel 機能詳細</h2>
            </div>
            <ul>
                <li>
                    <a href="top/function/index2.php?s=message">
                        <p>メッセージ配信</p>
                        <div class="function__img">
                            <img src="images/top/icon-function-1.png" alt="" class="icon">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="top/function/index2.php?s=action">
                        <p>アクション編集</p>
                        <div class="function__img">
                            <img src="images/top/icon-function-2.png" alt="" class="icon">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="top/function/index2.php?s=analytics">
                        <p>データ分析</p>
                        <div class="function__img">
                            <img src="images/top/icon-function-3.png" alt="" class="icon">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="top/function/index2.php?s=manage">
                        <p>アカウント管理</p>
                        <div class="function__img">
                            <img src="images/top/icon-function-4.png" alt="" class="icon">
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </section>
		<section class="plan">
				<div class="container">
						<h2>料金プラン</h2>
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

		<section class="contact">
				<div class="container">
					<div class="contact_Box">
						<h2>資料請求・お問い合わせ</h2>
						<div class="contact-img">
								<img src="images/top/contact.png" alt="" class="pc">
								<img src="images/top/contact-sp.png" alt="" class="sp">
						</div>
						<p>資料請求、お問い合わせを希望の方は、<br class="pc">
								下記フォームから必要事項をご入力いただき、送信ボタンを押してください。<br>
								<br class="sp">
								ちょっとした疑問、質問でも構いません。どうぞお気軽にお問合せください！</p>
						<div class="btn__box">
								<div class="btn yellow">
										<a href="<?php echo $url_contact;?>">資料請求・お問合せ</a>
								</div>
								<!-- <div class="btn blue">
										<a href="https://talk-label.com/top/plan/">料金プラン・お申込み</a>
								</div> -->
						</div>
					</div>
				</div>
		</section>
</main>
<!-- CONTENTS -->
<!-- FOOTER -->
<?php require dirname(__FILE__).'/./system_parts/layout_block/footer/common/footer_layout_top_2.php';?>
<!-- FOOTER -->
</div>
<!-- WRAPPER -->
</form>
<?php require dirname(__FILE__).'/./system_parts/crt_block/body_tag.php';?>
</body>
</html>
