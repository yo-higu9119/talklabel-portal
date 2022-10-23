							<dl class="DetDlSituation clear_fix">
								<dt><?php echo Util::dispLang(Language::WORD_00166);/*空き状況*/?></dt>
								<dd><?php
$rest = max($seminarInfo->capacity-$seminarInfo->applicant, 0);
//if($rest > 0)$rest = max($seminarInfo->web_capacity-$seminarInfo->applicant_web, 0);

if(
	($seminarInfo->acceptType == 1
	&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
	)
	|| ($seminarInfo->acceptType == 2
	&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
	&& mktime($seminarInfo->acceptEndDatetime->hour, $seminarInfo->acceptEndDatetime->minute, 0, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day, $seminarInfo->acceptEndDatetime->year) >= time()
	)
	|| $seminarInfo->acceptType == 3
){
	if($rest > 5) {
		echo '<span class="IcoBox MdIcBg BgBlu">'.Util::dispLang(Language::WORD_00167).'</span>';/* 空きあり */
	} else if($rest > 0) {
		echo '<span class="IcoBox MdIcBg BgPnc">'.Util::dispLang(Language::WORD_00168).'</span>';/* あとわずか */
	} else if($seminarInfo->cancel_to_wait === 1) {
		echo '<span class="IcoBox MdIcBg BgGry">'.Util::dispLang(Language::WORD_00169).'</span>';/* キャンセル待ち */
	} else {
		echo '<span class="IcoBox MdIcBg BgGry">'.Util::dispLang(Language::WORD_00170).'</span>';/* 満席 */
	}
}else{
	echo '<span class="NrIcBg MdIcBg BgGry">'.Util::dispLang(Language::WORD_00171).'</span>';/* 受付終了 */
}
							?></dd>
							</dl>
