				<div class="NBLink clear_fix">
<?php
	$PrevAndNextInfo = HtmlPartsArticle::printSimpleConditionListPrevAndNext($session, array(
		 'CategoryGroupId' => $categoryGroupId
		,'CategoryId' => $categoryId
//		,'DisplayMax' => 10
		,'SortType' => 3
		,'DisplayTagType' => 1
		,'DisplayColumnNum' => 5
		,'DisplayImage' => true
		,'DisplayEffect' => 6
		,'DisplayDescription' => 0
		,'DisplayUpDate' => true
		,'DisplayTagLink' => false
		,'DisplayNewDays' => false
		,'DisplayLankingMax' => 0
		,'ExcludeArticleId' => 0
	), $info->id);

	if($PrevAndNextInfo["next"] !== ""){
?>
					<p class="NBNext BtM"><button type="button" class="NBLinkBt back" onclick="location.href='./<?php echo HtmlParts::getMyPage(); ?>?s=<?php echo $PrevAndNextInfo["next"]; ?>&c=<?php echo $categoryId;?>'" /><?php echo Util::dispLang(Language::WORD_00008);/* 前の記事 */?></button></p>
<?php
	}
	if($PrevAndNextInfo["prev"] !== ""){
?>
					<p class="NBBack BtM"><button type="button" class="NBLinkBt next" onclick="location.href='./<?php echo HtmlParts::getMyPage(); ?>?s=<?php echo $PrevAndNextInfo["prev"]; ?>&c=<?php echo $categoryId;?>'" /><?php echo Util::dispLang(Language::WORD_00009);/* 次の記事 */?></button></p>
<?php
	}
?>
				</div>
