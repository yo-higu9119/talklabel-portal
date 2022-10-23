<?php
$semCateGroupData = new SeminarCategoryGroupData('');
$semCateGroupInfo = $semCateGroupData->getInfoToSeminarId($seminarInfo->id);
if($seminarInfo->pro_url2 != ""){
?>
							<dl class="DetProUrlArea clear_fix">
								<dt class="DetUrlTi"><?php echo $semCateGroupInfo->pro2_name;?></dt>
								<dd class="DetUrl"><a href="<?php echo $seminarInfo->pro_url2;?>" target="_blank"><?php echo $seminarInfo->pro_url2;?></a></dd>
							</dl>
<?php
}
unset($semCateGroupData);
unset($semCateGroupInfo);
?>
