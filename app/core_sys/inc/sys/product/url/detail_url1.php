<?php
$proCateGroupData = new ProductCategoryGroupData('');
$proCateGroupInfo = $proCateGroupData->getInfoToProductId($productInfo->id);
if($productInfo->mapUrl != ""){
?>
							<dl class="DetMapUrlArea clear_fix">
								<dt class="DetUrlTi"><?php echo $proCateGroupInfo->pro1_name;?></dt>
								<dd class="DetUrl"><a href="<?php echo $productInfo->mapUrl;?>" target="_blank"><?php echo $productInfo->mapUrl;?></a></dd>
							</dl>
<?php
}
?>
