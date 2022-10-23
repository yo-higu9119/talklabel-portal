<?php
/* 所属タグリスト */
require_once dirname(__FILE__).'/../../../../../common/inc/data/design.php';
$cmsMotionSettingData = new ContentsMotionSettingData($session->getMemberName());
$info1 = $cmsMotionSettingData->getInfo(1, 1, 2);
$info2 = $cmsMotionSettingData->getInfo(1, 2, 2);
if ((IS_SMART_PHONE && $info2->disp_tag) || (!IS_SMART_PHONE && $info1->disp_tag == 1)) { 
	$tagStr = '';
	foreach($info->categoryList as $_categoryId) {
		if(array_key_exists($_categoryId, $categoryInfoList)) {
			$aff_categoryInfo = $categoryInfoList[$_categoryId];
			if($aff_categoryInfo->isDisp && $aff_categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId())) {
				$target_str = '';
				$categoryGroupfileName = $aff_categoryInfo->categoryGroupfileName;
				if($categoryGroupfileName == 'contents/article/'){
					$categoryGroupfileName = 'contents/article/';
				}
				if($aff_categoryInfo->auto_link == 0){
					$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?c='.$aff_categoryInfo->id);
				}else if($aff_categoryInfo->auto_link == 1){
					if(count($aff_categoryInfo->contents) == 1){
						$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'index.php?c='.$aff_categoryInfo->id.'&s='.$aff_categoryInfo->contents[0]);
					}else{
						$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?c='.$aff_categoryInfo->id);
					}
				}else{
					if($aff_categoryInfo->auto_path == 0){
							$categoryGroupFilePath = '';
					}else{
							$categoryGroupFilePath = SYSTEM_TOP_URL;
					}
					if($aff_categoryInfo->link_url == ""){
						$link_str = htmlspecialchars($categoryGroupFilePath);
					}else{
						$link_str = htmlspecialchars($categoryGroupFilePath.$aff_categoryInfo->link_url);
						if($aff_categoryInfo->link_target == 1){
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
