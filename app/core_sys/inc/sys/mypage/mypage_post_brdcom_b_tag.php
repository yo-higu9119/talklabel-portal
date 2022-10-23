						<div class="TableBox mgb30">
<?php
	if(count($boardCommenEmpathyList) == 0){
?>
							<p class="Art cnt mgt20 mgb10"><?php echo Util::dispLang(Language::WORD_00502);/*あなたが共感した掲示板コメントはありません。*/?></p>
<?php
	}else{
?>
							<table class="ScrTable">
								<tr>
								<th class="size200 nowrap"><?php echo Util::dispLang(Language::WORD_00492);/*トピックス名*/?></th>
								<th class="size300 nowrap"><?php echo Util::dispLang(Language::WORD_00493);/*コメント*/?></th>
								<th class="size100 nowrap"><?php echo Util::dispLang(Language::WORD_00493);/*投稿日時*/?></th>
								<th class="size80 nowrap"><?php echo Util::dispLang(Language::WORD_00495);/*いいね数*/?></th>
								<th class="size80 nowrap"><?php echo Util::dispLang(Language::WORD_00497);/*通報数*/?></th>
								<th class="size80 nowrap"><?php echo Util::dispLang(Language::WORD_00186);/*詳細*/?></th>
								</tr>
<?php
		foreach ($boardCommenEmpathyList as $key => $val){
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
								<td class="lft"><?php echo htmlspecialchars($val->board_title); ?></td>
								<td class="lft <?php echo $bodyCol; ?>"><?php echo $body; ?></td>
								<td class="nowrap"><?php echo $val->create_date->toString(); ?></td>
								<td class="TableBgGrn cnt nowrap"><?php echo $val->respond_cnt; ?></td>
								<td class="TableBgYel cnt nowrap"><?php echo $val->report_cnt; ?></td>
								<td class="nowrap"><p class="editBt"><a href="../../community/board/detail.php?b=<?php echo $val->board_id; ?>&c=<?php echo $categolyId; ?>"><?php echo Util::dispLang(Language::WORD_00186);/*詳細*/?></a></p></td>
								</tr>
<?php
		}
?>
							</table>
<?php
	}
?>
						</div>
