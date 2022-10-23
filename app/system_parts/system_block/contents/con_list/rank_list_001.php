<?php 
$ser_view_rank_start = date("Y/m/d",strtotime("-7 day"));
$ser_view_rank_end = date("Y/m/d");
if (IS_SMART_PHONE) { ?>
		<div class="ListBox ListType2">
<?php
HtmlPartsArticle::printSimpleConditionList($session, array(
	 'CategoryGroupId' => 1
	,'CategoryId' => 0
	,'DisplayImage' => true
	,'DisplayMax' => 6
	,'SortType' => 5
	,'DisplayTagType' => 2
	,'DisplayDescription' => false
	,'DisplayUpDate' => true
	,'DisplayPersonInfo' => false
	,'DisplayCategory' => true
	,'DisplayTagLink' => true
	,'DisplayEffect' => 1
	,'DisplayColumnNum' => 2
	,'DisplayNewDays' => 6
	,'DisplayLankingMax' => 0
	,'DisplayView' => false
	,'DisplayLike' => false
	,'DisplayComment' => false
	,'view_count_date_start' => $ser_view_rank_start
	,'view_count_date_end' => $ser_view_rank_end
));
?>
		</div>
<?php } else { ?>
		<div class="ListBox ListType4">
<?php
HtmlPartsArticle::printSimpleConditionList($session, array(
	 'CategoryGroupId' => 1
	,'CategoryId' => 0
	,'DisplayImage' => true
	,'DisplayMax' => 6
	,'SortType' => 5
	,'DisplayTagType' => 4
	,'DisplayDescription' => false
	,'DisplayUpDate' => true
	,'DisplayPersonInfo' => false
	,'DisplayCategory' => true
	,'DisplayTagLink' => true
	,'DisplayEffect' => 1
	,'DisplayColumnNum' => 3
	,'DisplayNewDays' => 6
	,'DisplayLankingMax' => 10
	,'DisplayView' => true
	,'DisplayLike' => true
	,'DisplayComment' => true
	,'view_count_date_start' => $ser_view_rank_start
	,'view_count_date_end' => $ser_view_rank_end
));
?>
		</div>
<?php } ?>
