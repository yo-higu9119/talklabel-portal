<?php
	if($seminarInfo->TypeNo == 1){
		if($seminarInfo->venue_id !== 0){
			$placeName = htmlspecialchars($VenueList[$seminarInfo->venue_id]->name);
			$placeName = '<a href="'.$VenueList[$seminarInfo->venue_id]->map.'" target="_blank">'.$placeName.'</a>';
		}else{
			$placeName = Util::dispLang(Language::WORD_00156);/* 会場未定*/
		}
	}else{
		$placeName = Util::dispLang(Language::WORD_00157);/* オンライン*/
	}
	$TypeList = $seminarInfo->getTypeList();
	$typeTag = '';
	if($seminarInfo->TypeNo == 1){
		$typeTag = '<span class="IcoBox NrIcBg BgPnc">'.$TypeList[$seminarInfo->TypeNo].'</span>';
	}else if($seminarInfo->TypeNo == 2){
		$typeTag = '<span class="IcoBox NrIcBg BgGrn">'.$TypeList[$seminarInfo->TypeNo].'</span>';
	}
?>
	<section class="mypageOrdBoxInn">
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00358);/*申込済セミナー*/?></dt>
			<dd><?php echo htmlspecialchars($seminarInfo->name); ?></dd>
		</dl>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00158);/*開催日*/?></dt>
			<dd><?php
	if($seminarInfo->eventType == 1){
		$eventDate = $seminarInfo->theDate->toString();
	}else if($seminarInfo->eventType == 2){
		$eventDate = Util::dispLang(Language::WORD_00159);/* 常時開催*/
	}else{
		$eventDate = $seminarInfo->lectureList[0]->theDate->toString();
	}
	echo $eventDate;
?></dd>
		</dl>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00183);/*会場*/?></dt>
			<dd><?php echo $placeName?></dd>
		</dl>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00359);/*価格*/?></dt>
			<dd><?php
	$amount = $seminarInfo->getCurrentAmount($session->isLogin(), $session->getMemberApplyService());
	if(is_numeric($amount)) {
		if(intval($amount) > 0){
			echo number_format($amount).Util::dispLang(Language::WORD_00161);/* 円（税込み）*/
		}else{
			echo Util::dispLang(Language::WORD_00162);/* 無料*/
		}
	} else {
		echo '-';
	}
?></dd>
		</dl>
	</section>
