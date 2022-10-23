<?php
/* 所属タグリスト */
require_once dirname(__FILE__).'/../../../../../common/inc/data/design.php';
$cmsMotionSettingData = new ContentsMotionSettingData($session->getMemberName());
$info1 = $cmsMotionSettingData->getInfo(1, 1, 2);
$info2 = $cmsMotionSettingData->getInfo(1, 2, 2);
if ((IS_SMART_PHONE && $info2->disp_tag) || (!IS_SMART_PHONE && $info1->disp_tag == 1)) { 
	$tagStr = '';
	foreach($productInfo->categoryList as $categoryId) {
		if(array_key_exists($categoryId, $categoryInfoList)) {
			$aff_categoryInfo = $categoryInfoList[$categoryId];
			if($categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased())) {
				$target_str = '';
				$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
				if($categoryGroupfileName == 'product/main/'){
					$categoryGroupfileName = 'product/main/';
				}
				if($categoryInfo->auto_link == 0){
					$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?pc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
				}else if($categoryInfo->auto_link == 1){
					if(count($categoryInfo->product) == 1){
						$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'index.php?pc='.$categoryInfo->id.'&s='.$categoryInfo->product[0].'&c='.$settings['CategoryId']);
					}else{
						$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?pc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
					}
				}else{
					if($categoryInfo->auto_path == 0){
							$categoryGroupFilePath = '';
					}else{
							$categoryGroupFilePath = SYSTEM_TOP_URL;
					}
					if($categoryInfo->link_url == ""){
						$link_str = htmlspecialchars($categoryGroupFilePath);
					}else{
						$link_str = htmlspecialchars($categoryGroupFilePath.$categoryInfo->link_url);
						if($categoryInfo->link_target == 1){
							$target_str = ' target="_blank"';
						}
					}
				}
				$tagStr .= '<li><a href="'.$link_str.'"'.$target_str.'>'.htmlspecialchars(trim($aff_categoryInfo->shortName)===''?$aff_categoryInfo->name:$aff_categoryInfo->shortName).'</a></li>';
			}
		}
	}
	if(trim($tagStr) !== '') {
?>
					<ul class="detTagLink clear_fix"><?php echo $tagStr;?></ul>
<?php
	}
}
/* 所属タグリスト */
?>
