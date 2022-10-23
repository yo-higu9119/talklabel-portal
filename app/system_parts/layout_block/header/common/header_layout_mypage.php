<header class="mypage">

	<!--パソコン -->
	<div class="nb">
		<div class="pc-menu">
			<div class="pc-menu__logo">
				<a href="<?php echo SYSTEM_TOP_URL; ?>mypage/">
					<img src="<?php echo SYSTEM_TOP_URL; ?>images/nav/logo.png" alt="共通ロゴマーク">
				</a>
			</div>
			<div class="pc-menu__nav">
				<ul>
					<li><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/">
						<img src="<?php echo SYSTEM_TOP_URL; ?>images/site/mypage/parts/nav-course.png" alt="コースのアイコン">
						<span>講座一覧</span>
					</a></li>
					<li><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/account/">
						<img src="<?php echo SYSTEM_TOP_URL; ?>images/site/mypage/parts/nav-account.png" alt="アカウントのアイコン">
						<span>アカウント</span>
					</a></li>
					<li><a href="<?php echo SYSTEM_TOP_URL; ?>users/logout/">
						<img src="<?php echo SYSTEM_TOP_URL; ?>images/site/mypage/parts/nav-logout.png" alt="ログアウトのアイコン">
						<span>ログアウト</span>
					</a></li>
				</ul>
			</div>
		</div>
	</div>

	<!--モバイル -->
	<div class="tb">
		<div class="sp-menu">
			<div class="open-menu">
				<div class="top-bar-open">
						<div class="top-bar-open__head">
								<div class="top-bar-open__head--logo">
										<a href="<?php echo SYSTEM_TOP_URL; ?>mypage/">
											<img src="<?php echo SYSTEM_TOP_URL; ?>images/nav/logo.png" alt="共通ロゴマーク">
										</a>
								</div>
								<div class="top-bar-open__click" id="spNav">
										<span></span>
										<span></span>
										<p>MENU</p>
								</div>
						</div>
				</div>
			</div>

			<div class="close-menu" id="close">
				<div class="close-menu__top">
					<!-- <p>ユーザー名</p> -->
				</div>

				<div class="menu">
					<div class="menu__nav">
						<div class="menu__nav--title">コース</div>
						<div class="menu__nav--list">
							<ul>
								<li><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/">講座一覧</a></li>
							</ul>
						</div>
					</div>
					<div class="menu__nav">
						<div class="menu__nav--title">アカウント</div>
						<div class="menu__nav--list">
							<ul>
								<li><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/account/">アカウントトップ</a></li>
								<li><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/news/list.php">皆様へのお知らせ</a></li>
								<li><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/prof/">基本情報の編集</a></li>
								<li><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/prof/password.php">パスワードの変更</a></li>
								<li><a href="<?php echo SYSTEM_TOP_URL; ?>mypage/service/">サービス購入履歴</a></li>
							</ul>
						</div>
					</div>
					<div class="menu__nav">
						<div class="menu__nav--list">
							<ul>
								<li><a href="<?php echo SYSTEM_TOP_URL; ?>users/logout/">ログアウト</a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</header>
