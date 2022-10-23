							<dl class="DetDlPeriod clear_fix">
								<dt><?php echo Util::dispLang(Language::WORD_00164);/*申込期間*/?></dt>
								<dd><?php
if($seminarInfo->acceptType == 1){
	echo htmlspecialchars(sprintf('%04d/%02d/%02d %02d:%02d～'
			, $seminarInfo->acceptStartDatetime->year, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day
			, $seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute
	));
}else if($seminarInfo->acceptType == 2){
	echo htmlspecialchars(sprintf('%04d/%02d/%02d %02d:%02d～%04d/%02d/%02d %02d:%02d'
			, $seminarInfo->acceptStartDatetime->year, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day
			, $seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute
			, $seminarInfo->acceptEndDatetime->year, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day
			, $seminarInfo->acceptEndDatetime->hour, $seminarInfo->acceptEndDatetime->minute
	));
}else{
	echo htmlspecialchars(Util::dispLang(Language::WORD_00190));/*常時受付中*/
}
?></dd>
							</dl>
