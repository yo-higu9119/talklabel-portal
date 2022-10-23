<?php
$proCateGroupData = new ProductCategoryGroupData('');
$proCateGroupInfo = $proCateGroupData->getInfoToProductId($productInfo->id);
if($productInfo->free5 != ""){
?>
							<dl class="DetFreeArea clear_fix">
								<dt class="DetFreeTi"><?php echo $proCateGroupInfo->free5_name;?></dt>
								<dd class="DetFree"><?php echo $productInfo->free5;?></dd>
							</dl>
<?php
}
?>
