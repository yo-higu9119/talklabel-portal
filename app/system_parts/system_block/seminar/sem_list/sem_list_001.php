<?php if(count($seminarInfoList) > 0){ ?>
<?php if (IS_SMART_PHONE) { ?>
					<div class="ListBox ListType1">
<?php
HtmlPartsSeminar::printList($seminarInfoList, $session, array(
	 'CategoryGroupId' => $categoryGroupId
	,'DisplayTagType' => 1
	,'DisplayColumnNum' => 1
	,'DisplayImage' => true
	,'DisplayEffect' => 1
	,'DisplayDescription' => false
	,'DisplayUpDate' => false
	,'DisplayTagLink' => true
	,'DisplayNewDays' => 1
	,'DisplayLankingMax' => 0
	,'CategoryId' => $categoryInfo->id
	,'DisplayKingaku' => true
	,'DisplayKaisaibi' => true
	,'DisplayKaisaibasyo' => true
	,'DisplayKigen' => true
	,'DisplayAki' => true
));
?>
					</div>
<?php } else { ?>
					<div class="ListBox ListType1">
<?php
HtmlPartsSeminar::printList($seminarInfoList, $session, array(
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
	,'DisplayKaisaibi' => false
	,'DisplayKaisaibasyo' => true
	,'DisplayKigen' => false
	,'DisplayAki' => false
));
?>
					</div>
<?php } ?>
<?php } else { ?>
					<p class="CautTxt Caution cnt mgt10 mgb10"><?php echo Util::dispLang(Language::WORD_00155);/*Œ»ÝŠJÃ‚Í‚ ‚è‚Ü‚¹‚ñ*/?></p>
<?php } ?>
