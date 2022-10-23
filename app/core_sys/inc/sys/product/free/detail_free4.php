<?php
$proCateGroupData = new ProductCategoryGroupData('');
$proCateGroupInfo = $proCateGroupData->getInfoToProductId($productInfo->id);
if($productInfo->free4 != ""){
?>
							<dl class="DetFreeArea clear_fix">
								<dt class="DetFreeTi"><?php echo $proCateGroupInfo->free4_name;?></dt>
								<dd class="DetFree"><?php echo $productInfo->free4;?></dd>
							</dl>
<?php
}
?>
