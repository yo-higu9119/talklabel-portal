<?php
$semCateGroupData = new SeminarCategoryGroupData('');
$semCateGroupInfo = $semCateGroupData->getInfoToSeminarId($seminarInfo->id);
if($seminarInfo->mov_url2 != ""){
?>
							<dl class="DetMovUrlArea clear_fix">
								<dt class="DetUrlTi"><?php echo $semCateGroupInfo->mov2_name;?></dt>
								<dd class="DetUrl"><a href="<?php echo $seminarInfo->mov_url2;?>" target="_blank"><?php echo $seminarInfo->mov_url2;?></a></dd>
							</dl>
<?php
}
unset($semCateGroupData);
unset($semCateGroupInfo);
?>
