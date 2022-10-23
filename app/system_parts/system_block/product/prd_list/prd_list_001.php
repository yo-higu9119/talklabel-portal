<?php if(count($productInfoList) > 0){ ?>
<?php if (IS_SMART_PHONE) { ?>
					<div class="ListBox ListType1">
<?php
HtmlPartsProduct::printList($productInfoList, $session, array(
	 'CategoryGroupId' => $categoryGroupId
	,'DisplayTagType' => 1
	,'DisplayColumnNum' => 2
	,'DisplayImage' => true
	,'DisplayEffect' => 8
	,'DisplayDescription' => false
	,'DisplayUpDate' => false
	,'DisplayTagLink' => true
	,'DisplayNewDays' => true
	,'DisplayLankingMax' => 0
	,'CategoryId' => $categoryInfo->id
	,'DisplayKingaku' => true
	,'DisplayHanbaibi' => true
	,'DisplayHanbaiMth' => false
	,'DisplayZaiko' => true
));
?>
					</div>
<?php } else { ?>
					<div class="ListBox PrdList ListType1">
<?php
HtmlPartsProduct::printList($productInfoList, $session, array(
	 'CategoryGroupId' => $categoryGroupId
	,'DisplayTagType' => 1
	,'DisplayColumnNum' => 3
	,'DisplayImage' => true
	,'DisplayEffect' => 8
	,'DisplayDescription' => false
	,'DisplayUpDate' => false
	,'DisplayTagLink' => true
	,'DisplayNewDays' => true
	,'DisplayLankingMax' => 0
	,'CategoryId' => $categoryInfo->id
	,'DisplayKingaku' => true
	,'DisplayHanbaibi' => true
	,'DisplayHanbaiMth' => false
	,'DisplayZaiko' => true
));
?>
					</div>
<?php } ?>
<?php } else { ?>
					<p class="CautTxt Caution cnt mgt10 mgb10"><?php echo Util::dispLang(Language::WORD_00391);/*現在販売している商品はありません。*/?></p>
<?php } ?>
