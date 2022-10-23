					<div class="pan_navi">
						<nav class="pan_link">
							<ul class="clear_fix">
								<li><a href="<?php echo SYSTEM_TOP_URL; ?>">HOME</a></li>
								<li>｜</li>
								<li><a href="list.php"><?php echo Util::dispLang(Language::WORD_00152);/*セミナー一覧*/?></a></li>
								<li>｜</li>
								<li><?php echo htmlspecialchars($seminarInfo->name)?></li>
							</ul>
						</nav>
					</div>
