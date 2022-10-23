<?php
$proCateGroupData = new ProductCategoryGroupData('');
$proCateGroupInfo = $proCateGroupData->getInfoToProductId($productInfo->id);
if($productInfo->mov_url2 != ""){
?>
							<dl class="DetMovUrlArea clear_fix">
								<dt class="DetUrlTi"><?php echo $proCateGroupInfo->mov2_name;?></dt>
								<dd class="DetUrl"><a href="<?php echo $productInfo->mov_url2;?>" target="_blank"><?php echo $productInfo->mov_url2;?></a></dd>
							</dl>
<?php
}
?>
