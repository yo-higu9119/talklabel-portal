<?php
/* 所属カテゴリリスト */
if($info->category_list_is_display == 1){
	$tagStr = '';
	foreach($info->categoryList as $categoryId) {
		if(array_key_exists($categoryId, $categoryInfoList2)) {
			$categoryInfo = $categoryInfoList2[$categoryId];
			if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId()) && $categoryInfo->parentCategoryId !== -2) {
				$color = ($categoryInfo->color === '')?'':' style="background:'.$categoryInfo->color.'"';
				$tagStr .= '<li><span class="DetcateIco DetcateIco'.$categoryInfo->id.'"'.$color.'>'.htmlspecialchars(trim($categoryInfo->shortName)===''?$categoryInfo->name:$categoryInfo->shortName).'</span></li>';
			}
		}
	}
	if(trim($tagStr) !== '') {
?>
				<ul class="DetcateName clear_fix"><?php echo $tagStr;?></ul>
<?php
	}
}
/* 所属カテゴリリスト */
?>
