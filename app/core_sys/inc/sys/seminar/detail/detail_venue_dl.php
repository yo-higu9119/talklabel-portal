<?php
require_once dirname(__FILE__).'/../../../../../../common/inc/data/venue_data.php';
if(isset($previewKeyData)){/* プレビュー用処理 */
	$VenueData = new VenueData('preview');
}else{
	$VenueData = new VenueData($session->getMemberName());
}
$VenueList = $VenueData->getList();
$mapUrl = '';
if($seminarInfo->TypeNo == 1){
	if($seminarInfo->venue_id !== 0){
		$placeName = $VenueList[$seminarInfo->venue_id]->name;
		$mapUrl = $VenueList[$seminarInfo->venue_id]->map;
	}else{
		$placeName = Util::dispLang(Language::WORD_00156);/*会場未定*/
	}
}else{
	$placeName = Util::dispLang(Language::WORD_00157);/*オンライン*/
}
?>
							<dl class="DetDlVenue clear_fix">
								<dt><?php echo Util::dispLang(Language::WORD_00183);/*会場*/?></dt>
								<dd><?php
if(trim($mapUrl) === '') {
	echo htmlspecialchars($placeName);
} else {
	echo '<a href="'.htmlspecialchars($mapUrl).'" class="arrow_circle" target="_blank">'.htmlspecialchars($placeName).'</a>';
}
?></dd>
							</dl>
