<?php
$proCateGroupData = new ProductCategoryGroupData('');
$proCateGroupInfo = $proCateGroupData->getInfoToProductId($productInfo->id);
if($productInfo->free1 != ""){
?>
							<dl class="DetFreeArea clear_fix">
								<dt class="DetFreeTi"><?php echo $proCateGroupInfo->free1_name;?></dt>
								<dd class="DetFree"><?php echo $productInfo->free1;?></dd>
							</dl>
<?php
}
?>
