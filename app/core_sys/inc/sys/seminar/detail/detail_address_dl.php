<?php
if($seminarInfo->TypeNo == 1){
	if($seminarInfo->venue_id !== 0){
?>
							<dl class="DetDlAddress clear_fix">
								<dt><?php echo Util::dispLang(Language::WORD_00189);/*住所*/?></dt>
								<dd>〒<?php echo htmlspecialchars($VenueList[$seminarInfo->venue_id]->zip)?><br />
<?php
echo htmlspecialchars(Util::getStrFromList(Master::getPrefectureList(), $VenueList[$seminarInfo->venue_id]->area).$VenueList[$seminarInfo->venue_id]->add);
?></dd>
							</dl>
<?php
	}
}
?>
