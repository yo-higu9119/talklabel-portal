<?php if (IS_SMART_PHONE) { ?>
		<div class="ListBox ListType1">
<?php
HtmlPartsArticle::printSimpleConditionList($session, array(
	 'CategoryGroupId' => $categoryGroupId
	,'CategoryId' => $categoryId
	,'ExcludeArticleId' => $info->id
	,'DisplayImage' => true
	,'DisplayMax' => 6
	,'SortType' => 3
	,'DisplayTagType' => 1
	,'DisplayDescription' => false
	,'DisplayUpDate' => true
	,'DisplayPersonInfo' => false
	,'DisplayCategory' => false
	,'DisplayTagLink' => false
	,'DisplayEffect' => 1
	,'DisplayColumnNum' => 2
	,'DisplayNewDays' => 6
	,'DisplayLankingMax' => 0
	,'DisplayView' => false
	,'DisplayLike' => false
	,'DisplayComment' => false
));
?>
		</div>
<?php } else { ?>
		<div class="ListBox ListType1">
<?php
HtmlPartsArticle::printSimpleConditionList($session, array(
	 'CategoryGroupId' => $categoryGroupId
	,'CategoryId' => $categoryId
	,'ExcludeArticleId' => $info->id
	,'DisplayImage' => true
	,'DisplayMax' => 6
	,'SortType' => 3
	,'DisplayTagType' => 1
	,'DisplayDescription' => false
	,'DisplayUpDate' => false
	,'DisplayPersonInfo' => false
	,'DisplayCategory' => false
	,'DisplayTagLink' => false
	,'DisplayEffect' => 1
	,'DisplayColumnNum' => 3
	,'DisplayNewDays' => 6
	,'DisplayLankingMax' => 0
	,'DisplayView' => true
	,'DisplayLike' => true
	,'DisplayComment' => true
));
?>
		</div>
<?php } ?>
