								<p class="DetSituation"><?php
if($productInfo->stock_type == 1){
	$rest = max($productInfo->capacity-$productInfo->applicant, 0);
}else{
	$rest = 99;
}
if(
	($productInfo->acceptType == 1
	&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
	)
	|| ($productInfo->acceptType == 2
	&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
	&& mktime($productInfo->acceptEndDatetime->hour, $productInfo->acceptEndDatetime->minute, 0, $productInfo->acceptEndDatetime->month, $productInfo->acceptEndDatetime->day, $productInfo->acceptEndDatetime->year) >= time()
	)
	|| $productInfo->acceptType == 3
){
	if($rest > 5) {
		echo '<span class="IcoBox MdIcBg BgBlu">'.Util::dispLang(Language::WORD_00387).'</span>';/* 在庫あり */
	} else if($rest > 0) {
		echo '<span class="IcoBox MdIcBg BgPnc">'.Util::dispLang(Language::WORD_00168).'</span>';/* あとわずか */
	} else if($productInfo->cancel_to_wait === 1) {
		echo '<span class="IcoBox MdIcBg BgGry">'.Util::dispLang(Language::WORD_00388).'</span>';/* 入荷待ち */
	} else {
		echo '<span class="IcoBox MdIcBg BgGry">'.Util::dispLang(Language::WORD_00389).'</span>';/* 完売 */
	}
}else{
	echo '<span class="IcoBox MdIcBg BgGry">'.Util::dispLang(Language::WORD_00390).'</span>';/* 販売終了 */
}
							?></p>
