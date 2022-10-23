							<dl class="DetDlDate clear_fix">
								<dt><?php echo Util::dispLang(Language::WORD_00158);/*開催日*/?></dt>
								<dd><?php
				if($seminarInfo->eventType === 1){
					echo htmlspecialchars(sprintf('%04d/%02d/%02d %02d:%02d～%02d:%02d'
							, $seminarInfo->theDate->year, $seminarInfo->theDate->month, $seminarInfo->theDate->day
							, $seminarInfo->startTime->hour, $seminarInfo->startTime->minute
							, $seminarInfo->endTime->hour, $seminarInfo->endTime->minute
					));
				}else if($seminarInfo->eventType === 3){
					if(count($seminarInfo->lectureList) > 0){
						foreach($seminarInfo->lectureList as $lect) {
?>
									<dl class="clear_fix dlinner">
										<dt><?php echo $lect->name; ?></dt>
										<dd><?php
							echo htmlspecialchars(sprintf('%04d/%02d/%02d %02d/%02d～%02d/%02d'
									, $lect->theDate->year, $lect->theDate->month, $lect->theDate->day
									, $lect->startTime->hour, $lect->startTime->minute
									, $lect->endTime->hour, $lect->endTime->minute
							));
										?></dd>
									</dl>
<?php
						}
					}else{
						echo "-";
					}
				}else{
					echo htmlspecialchars(Util::dispLang(Language::WORD_00159));/*常時開催*/
				}
?></dd>
							</dl>
