<?php
if($seminarInfo->TypeNo == 1){
	if($seminarInfo->venue_id !== 0){
?>
							<p class="DetAddress">〒<?php echo htmlspecialchars($VenueList[$seminarInfo->venue_id]->zip)?><br />
<?php
echo htmlspecialchars(Util::getStrFromList(Master::getPrefectureList(), $VenueList[$seminarInfo->venue_id]->area).$VenueList[$seminarInfo->venue_id]->add);
?></p>
<?php
	}
}
?>
