<?php
$semCateGroupData = new SeminarCategoryGroupData('');
$semCateGroupInfo = $semCateGroupData->getInfoToSeminarId($seminarInfo->id);
if($seminarInfo->free4 != ""){
?>
							<dl class="DetFreeArea clear_fix">
								<dt class="DetFreeTi"><?php echo $semCateGroupInfo->free4_name;?></dt>
								<dd class="DetFree"><?php echo $seminarInfo->free4;?></dd>
							</dl>
<?php
}
unset($semCateGroupData);
unset($semCateGroupInfo);
?>
