							<dl class="DetDlPeriod clear_fix">
								<dt><?php echo Util::dispLang(Language::WORD_00382);/*販売期間*/?></dt>
								<dd><?php
if($productInfo->acceptType == 1){
	echo htmlspecialchars(sprintf('%04d年%02d月%02d日 %02d時%02d分～'
			, $productInfo->acceptStartDatetime->year, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day
			, $productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute
	));
}else if($productInfo->acceptType == 2){
	echo htmlspecialchars(sprintf('%04d年%02d月%02d日 %02d時%02d分～%04d年%02d月%02d日 %02d時%02d分まで'
			, $productInfo->acceptStartDatetime->year, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day
			, $productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute
			, $productInfo->acceptEndDatetime->year, $productInfo->acceptEndDatetime->month, $productInfo->acceptEndDatetime->day
			, $productInfo->acceptEndDatetime->hour, $productInfo->acceptEndDatetime->minute
	));
}else{
	echo htmlspecialchars(Util::dispLang(Language::WORD_00383));/*常時販売*/
}
?></dd>
							</dl>
