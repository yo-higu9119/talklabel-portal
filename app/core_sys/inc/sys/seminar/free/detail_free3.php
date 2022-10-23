<?php
$semCateGroupData = new SeminarCategoryGroupData('');
$semCateGroupInfo = $semCateGroupData->getInfoToSeminarId($seminarInfo->id);
if($seminarInfo->free3 != ""){
?>
							<dl class="DetFreeArea clear_fix">
								<dt class="DetFreeTi"><?php echo $semCateGroupInfo->free3_name;?></dt>
								<dd class="DetFree"><?php echo $seminarInfo->free3;?></dd>
							</dl>
<?php
}
unset($semCateGroupData);
unset($semCateGroupInfo);
?>
