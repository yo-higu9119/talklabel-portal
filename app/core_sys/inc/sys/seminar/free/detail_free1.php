<?php
$semCateGroupData = new SeminarCategoryGroupData('');
$semCateGroupInfo = $semCateGroupData->getInfoToSeminarId($seminarInfo->id);
if($seminarInfo->free1 != ""){
?>
							<dl class="DetFreeArea clear_fix">
								<dt class="DetFreeTi"><?php echo $semCateGroupInfo->free1_name;?></dt>
								<dd class="DetFree"><?php echo $seminarInfo->free1;?></dd>
							</dl>
<?php
}
unset($semCateGroupData);
unset($semCateGroupInfo);
?>
