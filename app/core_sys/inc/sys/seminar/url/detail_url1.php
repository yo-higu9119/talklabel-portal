<?php
$semCateGroupData = new SeminarCategoryGroupData('');
$semCateGroupInfo = $semCateGroupData->getInfoToSeminarId($seminarInfo->id);
if($seminarInfo->pro_url1 != ""){
?>
							<dl class="DetProUrlArea clear_fix">
								<dt class="DetUrlTi"><?php echo $semCateGroupInfo->pro1_name;?></dt>
								<dd class="DetUrl"><a href="<?php echo $seminarInfo->pro_url1;?>" target="_blank"><?php echo $seminarInfo->pro_url1;?></a></dd>
							</dl>
<?php
}
unset($semCateGroupData);
unset($semCateGroupInfo);
?>
