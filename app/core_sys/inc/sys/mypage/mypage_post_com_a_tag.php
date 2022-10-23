						<div class="TableBox">
<?php
	if(count($articleCommentList) == 0){
?>
							<p class="Art cnt mgt20 mgb10"><?php echo Util::dispLang(Language::WORD_00509);/*あなたが投稿したコンテンツコメントはありません。*/?></p>
<?php
	}else{
?>
							<table class="ScrTable">
								<tr>
								<th class="size300 nowrap"><?php echo Util::dispLang(Language::WORD_00505);/*コンテンツ名*/?></th>
								<th class="size300 nowrap"><?php echo Util::dispLang(Language::WORD_00447);/*コメント*/?></th>
								<th class="size150 nowrap"><?php echo Util::dispLang(Language::WORD_00493);/*投稿日時*/?></th>
								<th class="size80 nowrap"><?php echo Util::dispLang(Language::WORD_00186);/*詳細*/?></th>
								</tr>
<?php
		foreach ($articleCommentList as $key => $val){
			$body = str_replace(array("\r\n","\n"),"<br />",htmlspecialchars(Util::mb_str_replace($prohibition, "***", $val->body)));
			$bodyCol = 'TableBgYel';
			if($val->auth_status == 0){
				$body = Util::dispLang(Language::WORD_00041);/* 承認待ちです*/
				$bodyCol = 'TableBgPnc';
			}else if($val->auth_status == 2){
				$body = Util::dispLang(Language::WORD_00042);/* 承認が拒否されました*/
				$bodyCol = 'TableBGbreakdown';
			}else if($val->status == 1){
				$body = Util::dispLang(Language::WORD_00040);/* 現在、閲覧できません*/
				$bodyCol = 'TableBGbreakdown';
			}
?>
								<tr>
								<td class="lft"><?php echo htmlspecialchars($val->articleTitle); ?></td>
								<td class="lft <?php echo $bodyCol; ?>"><?php echo $body; ?></td>
								<td class="nowrap"><?php echo $val->create_date->toString(); ?></td>
								<td class="nowrap"><p class="editBt"><a href="../../contents/main/index.php?s=<?php echo $val->articleUrlKey; ?>&c=<?php echo $categolyId; ?>"><?php echo Util::dispLang(Language::WORD_00186);/*詳細*/?></a></p></td>
								</tr>
<?php
		}
?>
							</table>
<?php
	}
?>
						</div>
