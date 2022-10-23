<?php
function contentsNaviGetSubCategoryIdListType1($categoryTreeInfoList) {
	$categoryIdList = array();
	if(count($categoryTreeInfoList) > 0) {
		foreach($categoryTreeInfoList as $categoryTreeInfo) {
			$categoryIdList[$categoryTreeInfo->id] = $categoryTreeInfo->id;
			$categoryIdList += contentsNaviGetSubCategoryIdListType1($categoryTreeInfo->subInfoList);
		}
	}
	return $categoryIdList;
}
/////////////////
//本体
function printContentsNaviType1($session, $categoryGroupId, $dispImg=false, $crtColor=false,$subnavi=false) {
//	if($crtColor){$borderClass = "cate"}
	$uladdClass = "clear_fix";
	$uladdJs = "";
	if($subnavi){
		$uladdClass .= " dropdown";
		switch($subnavi){
			case 1:
				break;
			case 2:
				$uladdClass .= " wrap";
				break;
			case 3:
				$uladdClass .= " nowrap";
				$uladdJs = "<script>
$(function(){
	const navi = $('.dropdown.nowrap>li');
	navi.each(function(){
		const ddNav = $(this).find('nav');
		ddNav.css({display:'block'})
		const ddNavLi = ddNav.find('li');
		let navMax = $(this).width();
		ddNavLi.each(function(){
			const linkWidth = $(this).find('a').outerWidth();
			if(navMax < linkWidth){
				navMax = linkWidth;
			}
		})
		ddNav.css({display:'none',width:navMax});
	})
})
				</script>";
				break;
			case 4:
				$uladdClass .= " wide";
				break;
		}
	}
?>
		<nav>
			<ul class="<?php echo $uladdClass;?>">
<?php
	require_once dirname(__FILE__).'/../../../../common/inc/data/category.php';
	$categoryData = new CategoryData($session->getMemberName());
	$categoryTreeInfoList = $categoryData->getTreeList($categoryGroupId);
	$categoryIdList = array();
	foreach($categoryTreeInfoList[-1]->subInfoList as $categoryTreeInfo) {
		$categoryIdList[$categoryTreeInfo->id] = $categoryTreeInfo->id;
		$categoryIdList += contentsNaviGetSubCategoryIdListType1($categoryTreeInfo->subInfoList);
	}
	if(count($categoryIdList) > 0) {

		$searchInfoList = array();
		$searchInfoList['search_id'] = $categoryIdList;
		$categoryInfoList = $categoryData->getInfoList($searchInfoList, 1);
		/* Get Last Category  */
		$lastCategoryId = 0;
		foreach($categoryTreeInfoList[-1]->subInfoList as $categoryTreeInfo) {
			$categoryInfo = $categoryInfoList[$categoryTreeInfo->id];
			if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId())) {
				$lastCategoryId = $categoryInfo->id;
			}
		}

		foreach($categoryTreeInfoList[-1]->subInfoList as $categoryTreeInfo) {
			$categoryInfo = $categoryInfoList[$categoryTreeInfo->id];
			if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId())) {
				if($lastCategoryId == $categoryInfo->id){
					$end_class = '_end';
				}else{
					$end_class = '';
				}
				if(isset($_GET['c']) && intval($_GET['c']) == $categoryInfo->id){
					$crt_class = ' class="crt"';
				}else{
					$crt_class = '';
				}
				
				$target_str = '';
				//$categoryInfo->categoryGroupName
				//$categoryInfo->categoryGroupfileName
				$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
				if($categoryInfo->auto_link == 0){
					$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'list.php?c='.$categoryInfo->id);
				}else if($categoryInfo->auto_link == 1){
					if(count($categoryInfo->contents) == 1){
						$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'index.php?c='.$categoryInfo->id.'&s='.$categoryInfo->contents[0]);
					}else{
						$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'list.php?c='.$categoryInfo->id);
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
				
				$categoryImg ='';
				if($dispImg){
					$categoryImg = '<img src="'.SYSTEM_TOP_URL.'sys/file/get_article_category_file.php?id='.$categoryInfo->id.'">';
				}
				$crtBarStyle = '';
				if($crtColor){
					$crtBarStyle = ' style="background:'.$categoryInfo->color.'"';
				}
				$name = ($categoryInfo->shortName !== "")?$categoryInfo->shortName:$categoryInfo->name;
				$subInfoLists = $categoryTreeInfo->subInfoList;
?>
				<li class="navi<?php echo $end_class; ?>">
					<?php echo $categoryImg; ?>
					<a href="<?php echo $link_str; ?>"<?php echo $target_str; ?><?php echo $crt_class; ?>><span class="naviBar"<?php echo $crtBarStyle;?>></span><?php echo htmlspecialchars($name);?></a>
<?php
					if($subnavi && count($subInfoLists) > 0){
						HtmlPartsArticle::printSubNavi($session, $categoryGroupId, false, $categoryInfo->id);
					}
?>
				</li>
<?php
			}
		}
	}
?>
			</ul>
		</nav>
<?php
	echo $uladdJs;
}
//printContentsNaviType1($session, 1);
?>