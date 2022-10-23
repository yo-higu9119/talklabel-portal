<?php if (IS_SMART_PHONE) { ?>
						<nav class="catenavSl">
							<ul class="clear_fix">
								<li class="crt"><a href="./"><?php echo Util::dispLang(Language::WORD_00486);/*トピックス*/?></a></li>
								<li><a href="./board_comment.php"><?php echo Util::dispLang(Language::WORD_00483);/*掲示板コメント*/?></a></li>
								<li><a href="./contents_share.php"><?php echo Util::dispLang(Language::WORD_00487);/*いいね*/?></a></li>
								<li><a href="./contents_comment.php"><?php echo Util::dispLang(Language::WORD_00488);/*コメント*/?></a></li>
							</ul>
						</nav>
<?php } else { ?>
<?php } ?>