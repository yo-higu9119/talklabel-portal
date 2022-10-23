<?php if (IS_SMART_PHONE) { ?>
<?php } else { ?>
						<nav class="catenavY WidW">
							<ul class="ct4 clear_fix">
								<li><a href="./"><?php echo Util::dispLang(Language::WORD_00482);/*掲示板トピックス*/?></a></li>
								<li><a href="./board_comment.php"><?php echo Util::dispLang(Language::WORD_00483);/*掲示板コメント*/?></a></li>
								<li><a href="./contents_share.php" class="crt"><?php echo Util::dispLang(Language::WORD_00484);/*コンテンツいいね*/?></a></li>
								<li><a href="./contents_comment.php"><?php echo Util::dispLang(Language::WORD_00485);/*コンテンツコメント*/?></a></li>
							</ul>
						</nav>
<?php } ?>