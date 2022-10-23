<?php
$proCateGroupData = new ProductCategoryGroupData('');
$proCateGroupInfo = $proCateGroupData->getInfoToProductId($productInfo->id);
if($productInfo->pro_url != ""){
?>
							<dl class="DetProUrlArea clear_fix">
								<dt class="DetUrlTi"><?php echo $proCateGroupInfo->pro2_name;?></dt>
								<dd class="DetUrl"><a href="<?php echo $productInfo->pro_url;?>" target="_blank"><?php echo $productInfo->pro_url;?></a></dd>
							</dl>
<?php
}
?>
