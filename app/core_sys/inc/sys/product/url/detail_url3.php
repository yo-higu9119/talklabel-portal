<?php
$proCateGroupData = new ProductCategoryGroupData('');
$proCateGroupInfo = $proCateGroupData->getInfoToProductId($productInfo->id);
if($productInfo->mov_url1 != ""){
?>
							<dl class="DetMovUrlArea clear_fix">
								<dt class="DetUrlTi"><?php echo $proCateGroupInfo->mov1_name;?></dt>
								<dd class="DetUrl"><a href="<?php echo $productInfo->mov_url1;?>" target="_blank"><?php echo $productInfo->mov_url1;?></a></dd>
							</dl>
<?php
}
?>
