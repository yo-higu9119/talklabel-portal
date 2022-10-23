<?php
$mapUrl = '';
if($productInfo->TypeNo == 1){
	$placeName = Util::dispLang(Language::WORD_00380);/*配送販売*/
}else{
	$placeName = Util::dispLang(Language::WORD_00381);/*オンライン販売*/
}
?>
							<dl class="DetDlDelivery clear_fix">
								<dt><?php echo Util::dispLang(Language::WORD_00384);/*販売方法*/?></dt>
								<dd><?php
	echo htmlspecialchars($placeName);
?></dd>
							</dl>

