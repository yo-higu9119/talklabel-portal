<?php
$proCateGroupData = new ProductCategoryGroupData('');
$proCateGroupInfo = $proCateGroupData->getInfoToProductId($productInfo->id);
if($productInfo->free3 != ""){
?>
							<dl class="DetFreeArea clear_fix">
								<dt class="DetFreeTi"><?php echo $proCateGroupInfo->free3_name;?></dt>
								<dd class="DetFree"><?php echo $productInfo->free3;?></dd>
							</dl>
<?php
}
?>
