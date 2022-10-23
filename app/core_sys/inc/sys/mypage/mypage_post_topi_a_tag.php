						<div class="TableBox">
<?php
	if(count($boardList) == 0){
?>
							<p class="Art cnt mgt20 mgb10"><?php echo Util::dispLang(Language::WORD_00500);/*あなたが投稿した掲示板トピックスはありません。*/?></p>
<?php
	}else{
?>
							<table class="ScrTable">
								<tr>
								<th class=""><?php echo Util::dispLang(Language::WORD_00492);/*トピックス名*/?></th>
								<th class="size150"><?php echo Util::dispLang(Language::WORD_00493);/*投稿日時*/?></th>
								<th class="size80"><?php echo Util::dispLang(Language::WORD_00494);/*閲覧数*/?></th>
								<th class="size80"><?php echo Util::dispLang(Language::WORD_00495);/*いいね数*/?></th>
								<th class="size100"><?php echo Util::dispLang(Language::WORD_00496);/*コメント数*/?></th>
								<th class="size80"><?php echo Util::dispLang(Language::WORD_00186);/*詳細*/?></th>
								</tr>
<?php
		foreach ($boardList as $key => $val){
?>
								<tr>
								<td class="lft"><?php echo htmlspecialchars($val->title); ?></td>
								<td class="nowrap"><?php echo $val->registTimestamp->toString(); ?></td>
								<td class="TableBgBlu cnt nowrap"><?php echo $val->viewCnt; ?></td>
								<td class="TableBgGrn cnt nowrap"><?php echo $val->empathy_cnt; ?></td>
								<td class="TableBgYel cnt nowrap"><?php echo $val->comment_cnt; ?></td>
								<td class="nowrap"><p class="editBt"><a href="../../community/board/detail.php?b=<?php echo $val->id; ?>&c=<?php echo $categolyId; ?>"><?php echo Util::dispLang(Language::WORD_00186);/*詳細*/?></a></p></td>
								</tr>
<?php
		}
?>
							</table>
<?php
	}
?>
						</div>
