<?php if (IS_SMART_PHONE) { ?>
<?php } else { ?>
						<nav class="catenavY WidW">
							<ul class="ct3 clear_fix">
								<li><a href="./" class="crt"><?php echo Util::dispLang(Language::WORD_00511);/*紹介URL*/?></a></li>
								<li><a href="./payee.php"><?php echo Util::dispLang(Language::WORD_00512);/*振込先情報*/?></a></li>
								<li><a href="./reward.php"><?php echo Util::dispLang(Language::WORD_00513);/*報酬情報*/?></a></li>
							</ul>
						</nav>
<?php } ?>
