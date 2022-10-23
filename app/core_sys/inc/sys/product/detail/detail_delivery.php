<?php
$mapUrl = '';
if($productInfo->TypeNo == 1){
	$placeName = Util::dispLang(Language::WORD_00380);/*配送販売*/
}else{
	$placeName = Util::dispLang(Language::WORD_00381);/*オンライン販売*/
}
?>
								<p class="DetDelivery"><?php
	echo htmlspecialchars($placeName);
?></p>
