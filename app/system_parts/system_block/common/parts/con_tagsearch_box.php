<?php
function display_tag_list($session){
	require_once dirname(__FILE__).'/../../../../../common/inc/data/category.php';
	$categoryData = new CategoryData($session->getMemberName());
	$searchInfoList = array();
	$searchInfoList['search_category_group_id'] = 1;
	$searchInfoList['search_parent_category_id'] = -2;
	$searchInfoList['is_disp'] = true;

	$systemData = new SystemData('');
	$systemInfo = $systemData->getInfo();
	if($systemInfo->use_authority_group == 1){
		$searchInfoList['search_x_view_authority'] = $session->getMemberId();
	}
	if($systemInfo->use_language == 1){
		$StrToNumList = CorebloLanguage::getStrToNumList();
		if(isset($_SESSION['app_language'])){
			$langKey = $_SESSION['app_language'];
			$langId = array_key_exists($langKey,$StrToNumList)?$StrToNumList[$langKey]:0;
		}else{
			$langId = 0;
		}
		$searchInfoList['search_x_view_language'] = $langId;
	}

	$categoryTagList = $categoryData->getInfoList($searchInfoList, 3);

	if(count($categoryTagList) > 0){
?>
	<div class="tagSearch">
		<h3 class="tagSearchTi"><?php echo Util::dispLang(Language::WORD_00212);/*タグ検索*/?></h3>
		<section class="tagSearchInn">
<?php if (IS_SMART_PHONE) { ?>
<?php } else { ?>
		    <input id="trigger1" class="grad-trigger" type="checkbox">
		    <label class="grad-btn" for="trigger1"></label>
<?php } ?>
			<ul class="tagLink clear_fix">
<?php
		foreach($categoryTagList as $categoryInfo) {
			if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId())) {
?>
				<li><a href="<?php echo SYSTEM_TOP_URL; ?>contents/main/tag_list.php?c=<?php echo $categoryInfo->id; ?>"><?php echo $categoryInfo->name; ?></a></li>
<?php
			}
		}
?>
			</ul>
		</section>
	</div>
<?php
	}
}
display_tag_list($session);
?>
