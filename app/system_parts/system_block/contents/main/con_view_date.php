<?php
/* アイコンエリア　ここから */
?>
										<div class="rank_date_c_area clear_fix">
											<p class="view"><?php echo $info->viewCnt; ?></p>
											<p class="like"><?php echo $info->empathy_cnt; ?></p>
											<p class="comment"><?php echo $info->comment_cnt; ?></p>
											<p class="cap"><?php echo htmlspecialchars($info->openDatetime->toDateString())?></p>
										</div>
<?php
/* アイコネリア　ここまで */
?>