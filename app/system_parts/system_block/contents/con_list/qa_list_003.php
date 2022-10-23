<?php if (IS_SMART_PHONE) { ?>
		<div class="ListBox">
<?php
HtmlPartsArticle::printSimpleConditionList($session, array(
	 'CategoryGroupId' => 4
	,'CategoryId' => $categoryId
	,'DisplayCategory' => false
	,'DisplayMax' => 3
	,'SortType' => 3
	,'DisplayTagType' => 3
	,'DisplayColumnNum' => 2
	,'DisplayImage' => 1
	,'DisplayEffect' => 6
	,'DisplayDescription' => false
	,'DisplayUpDate' => false
	,'DisplayTagLink' => false
	,'DisplayNewDays' => false
	,'DisplayLankingMax' => 0
	,'DisplayPersonInfo' => 0
	,'DisplayView' => true
	,'DisplayLike' => true
	,'DisplayComment' => true
));
?>
		</div>
<?php } else { ?>
		<div class="ListBox">
<?php
HtmlPartsArticle::printSimpleConditionList($session, array(
	 'CategoryGroupId' => 4
	,'CategoryId' => $categoryId
	,'DisplayCategory' => false
	,'DisplayMax' => 8
	,'SortType' => 3
	,'DisplayTagType' => 3
	,'DisplayColumnNum' => 2
	,'DisplayImage' => 1
	,'DisplayEffect' => 8
	,'DisplayDescription' => false
	,'DisplayUpDate' => false
	,'DisplayTagLink' => false
	,'DisplayNewDays' => false
	,'DisplayLankingMax' => 0
	,'DisplayPersonInfo' => 0
	,'DisplayView' => true
	,'DisplayLike' => true
	,'DisplayComment' => true
));
?>
		</div>
<?php } ?>
