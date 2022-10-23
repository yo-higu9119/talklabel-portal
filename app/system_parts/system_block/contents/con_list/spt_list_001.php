<?php if (IS_SMART_PHONE) { ?>
		<div class="ListBox ListType1">
<?php
HtmlPartsArticle::printSimpleConditionList($session, array(
	 'CategoryGroupId' => 1
	,'CategoryId' => 0
	,'DisplayImage' => 1
	,'DisplayMax' => 6
	,'SortType' => 3
	,'DisplayTagType' => 1
	,'DisplayDescription' => true
	,'DisplayUpDate' => true
	,'DisplayPersonInfo' => true
	,'DisplayCategory' => true
	,'DisplayTagLink' => true
	,'DisplayEffect' => 1
	,'DisplayColumnNum' => 3
	,'DisplayNewDays' => 6
	,'DisplayLankingMax' => 0
	,'DisplayView' => false
	,'DisplayLike' => false
	,'DisplayComment' => false
	,'top_new_list' => true
));
?>
		</div>
<?php } else { ?>
		<div class="ListBox ListType1">
<?php
HtmlPartsArticle::printSimpleConditionList($session, array(
	 'CategoryGroupId' => 1
	,'CategoryId' => 0
	,'DisplayImage' => 1
	,'DisplayMax' => 6
	,'SortType' => 3
	,'DisplayTagType' => 1
	,'DisplayDescription' => true
	,'DisplayUpDate' => true
	,'DisplayPersonInfo' => true
	,'DisplayCategory' => true
	,'DisplayTagLink' => true
	,'DisplayEffect' => 1
	,'DisplayColumnNum' => 3
	,'DisplayNewDays' => 6
	,'DisplayLankingMax' => 0
	,'DisplayView' => false
	,'DisplayLike' => false
	,'DisplayComment' => false
	,'top_new_list' => true
));
?>
		</div>
<?php } ?>
