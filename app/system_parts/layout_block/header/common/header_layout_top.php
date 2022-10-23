<!-- 資料請求LINE -->
<div class="ctaBox">
		<a href="<?php echo $url_contact;?>">
			<img src="<?php echo SYSTEM_TOP_URL; ?>images/top/cta_line.png" alt="資料請求はこちらから">
		</a>
</div>

<!-- トップナビ -->
<header class="top">
	<!-- パソコン -->
	<div class="pc-menu">
		<div class="pc-menu__logo">
			<a href="<?php echo SYSTEM_TOP_URL; ?>">
				<!-- トップページロゴ -->
				<img src="<?php echo SYSTEM_TOP_URL; ?>images/nav/logo.png" alt="共通ロゴマーク">
			</a>
		</div>
		<div class="pc-menu__nav">
		<!-- グローバルメニュー -->
		<?php printContentsNaviType1($session, 1,false,false);?>

		<?php
		if($session->isLogin()) {
		?>
		<div class="btn__contact">
				<a href="<?php echo SYSTEM_TOP_URL; ?>mypage/top/">マイページ</a>
		</div>

		<?php
		} else {
		?>
		<!-- <div class="btn__contact">
				<a href="mypage/top/">ログイン</a>
		</div> -->

		<?php
		}
		?>

		</div>
	</div>

	<!-- モバイル -->
	<div class="sp-menu">

		<div class="open-menu">
			<div class="open-menu__logo">
				<!-- トップページロゴ -->
				<!-- <img src="<?php echo SYSTEM_TOP_URL; ?>images/nav/logo.png" alt="共通ロゴマーク"> -->
			</div>
			<div class="open-menu__click" id="spNav">
				<span></span>
				<span></span>
				<p>MENU</p>
			</div>
		</div>

		<div class="close-menu" id="close">

			<?php
			if($session->isLogin()) {
			?>
						<div class="loginNavBox">
							<div class="loginNav__title">
								マイページ
							</div>
							<!-- マイページナビ -->
							<nav>
								<ul class="clear_fix">
									<li class="navi"><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/top/">マイページトップ</a></li>
									<li class="navi"><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/prof/">プロフィール編集</a></li>
									<li class="navi"><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/prof/password.php">パスワード変更</a></li>
									<li class="navi"><a href="<?php echo SYSTEM_TOP_URL; ?>users/logout/">ログアウト</a></li>
								</ul>
							</nav>

							<div class="loginNav__title">
								サイト
							</div>
							<!-- グローバルメニュー -->
							<?php printContentsNaviType1($session, 1,false,false);?>
						</div>
			<?php
			} else {
			?>

			<!-- グローバルメニュー -->
			<?php printContentsNaviType1($session, 1,false,false);?>

			<!-- <div class="btn__contact">
					<a href="mypage/top/">ログイン</a>
			</div> -->

			<?php
			}
			?>

			<!-- <div class="btn__contact">
				<a href="">お問合せ</a>
			</div> -->
		</div>
	</div>
</header>
