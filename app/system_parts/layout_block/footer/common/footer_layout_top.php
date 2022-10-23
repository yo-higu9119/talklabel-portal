<footer class="top">
	<div class="footerBox">
		<div class="footer__logo">
				<img src="<?php echo SYSTEM_TOP_URL; ?>images/nav/logo-gry.png" alt="共通ロゴマーク">
				<div class="copywrite"><?php echo $copywrite; ?></div>
		</div>
		<!-- フッターナビゲーション -->
		<?php printContentsNaviType1($session, 2,false,false);?>
	</div>
</footer>

<!-- jsタグ -->
<script src="<?php echo SYSTEM_TOP_URL; ?>js/nav.js"></script>
