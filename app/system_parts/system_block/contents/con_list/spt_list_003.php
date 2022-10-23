<?php if (IS_SMART_PHONE) { ?>
		<div class="ListBox ListType1">
<?php
HtmlPartsArticle::printSimpleConditionList($session, array(
	 'CategoryGroupId' => 1
	,'CategoryId' => 0
	,'DisplayCategory' => true
	,'DisplayMax' => 3
	,'SortType' => 3
	,'DisplayTagType' => 1
	,'DisplayColumnNum' => 1
	,'DisplayImage' => 1
	,'DisplayEffect' => 8
	,'DisplayDescription' => true
	,'DisplayUpDate' => true
	,'DisplayTagLink' => true
	,'DisplayNewDays' => true
	,'DisplayLankingMax' => 0
	,'DisplayPersonInfo' => 0
	,'DisplayView' => true
	,'DisplayLike' => true
	,'DisplayComment' => true
));
?>
		</div>
<?php } else { ?>
		<div class="ListBox ListType1">
<?php
HtmlPartsArticle::printSimpleConditionList($session, array(
	 'CategoryGroupId' => 1
	,'CategoryId' => 0
	,'DisplayCategory' => true
	,'DisplayMax' => 8
	,'SortType' => 3
	,'DisplayTagType' => 1
	,'DisplayColumnNum' => 1
	,'DisplayImage' => 1
	,'DisplayEffect' => 8
	,'DisplayDescription' => true
	,'DisplayUpDate' => true
	,'DisplayTagLink' => true
	,'DisplayNewDays' => true
	,'DisplayLankingMax' => 0
	,'DisplayPersonInfo' => 0
	,'DisplayView' => true
	,'DisplayLike' => true
	,'DisplayComment' => true
));
?>
		</div>
<?php } ?>
