						<div class="TableBox">
<?php
	if(count($articleRespondList) == 0){
?>
							<p class="Art cnt mgt20 mgb10"><?php echo Util::dispLang(Language::WORD_00504);/*あなたがいいねしたコンテンツはありません。*/?></p>
<?php
	}else{
?>
							<table>
								<tr>
								<th class="size300"><?php echo Util::dispLang(Language::WORD_00505);/*コンテンツ名*/?></th>
								<th class="size150"><?php echo Util::dispLang(Language::WORD_00506);/*いいね登録日時*/?></th>
								<th class="size80"><?php echo Util::dispLang(Language::WORD_00186);/*詳細*/?></th>
								</tr>
<?php
		foreach ($articleRespondList as $key => $val){
?>
								<tr>
									<td class="lft"><?php echo htmlspecialchars($val->articleTitle); ?></td>
									<td class="nowrap"><?php echo $val->create_date->toString(); ?></td>
									<td class="nowrap"><p class="editBt"><a href="../../contents/main/index.php?s=<?php echo $val->articleUrlKey; ?>&c=<?php echo $categolyId; ?>"><?php echo Util::dispLang(Language::WORD_00186);/*詳細*/?></a></p></td>
								</tr>
<?php
		}
	}
?>
							</table>
						</div>
