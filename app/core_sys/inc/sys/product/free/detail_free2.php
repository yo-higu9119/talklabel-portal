<?php
$proCateGroupData = new ProductCategoryGroupData('');
$proCateGroupInfo = $proCateGroupData->getInfoToProductId($productInfo->id);
if($productInfo->free2 != ""){
?>
							<dl class="DetFreeArea clear_fix">
								<dt class="DetFreeTi"><?php echo $proCateGroupInfo->free2_name;?></dt>
								<dd class="DetFree"><?php echo $productInfo->free2;?></dd>
							</dl>
<?php
}
?>
