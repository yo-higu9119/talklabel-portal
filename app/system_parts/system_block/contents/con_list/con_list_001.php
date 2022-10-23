<?php
require_once dirname(__FILE__).'/../../../../../common/inc/data/article.php';
$articleData = new ArticleData($session->getMemberName());
$searchInfoList = array();
$searchInfoList['search_is_auth'] = 1;
$searchInfoList['search_x_open_contents'] = true;
if($categoryId > 0){
	$searchInfoList['search_x_category_id'] = $categoryId;
}else{
	$searchInfoList['search_x_ignore_all'] = true;
}
if($categoryGroupId > 0) {
	$searchInfoList['search_x_category_group_id'] = $categoryGroupId;
}
if(isset($searchStr) && $searchStr !== ""){
	$searchInfoList['search_x_text_search'] = $searchStr;
}

/* 閲覧権限、閲覧制限指定（条件を満たさない物を除外） */
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();

if($systemInfo->permission_article == 1){
	/* ********************** */
	/* 閲覧権限、閲覧制限指定（条件を満たさない物を除外） */
	$isLogin = $session->isLogin();
	if(!$isLogin) {
		$searchInfoList['search_x_permission_not_login'] = true;
	} else if($isLogin) {
		if(count($session->getMemberPurchased()) === 0) {
			$searchInfoList['search_x_permission_free_member'] = $session->getMemberId();
		} else {
			$searchInfoList['search_x_permission_toll_member'] = $session->getMemberId();
			$searchInfoList['search_x_permission_input_function'] = $session->getMemberId();
		}
	}
	/* ********************** */
}
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
?>

<?php if (IS_SMART_PHONE) { ?>
<?php $pageDispCntMax = 6; ?>
<?php
$totalCnt = $articleData->getCount($searchInfoList);
$pageMax = intval(ceil($totalCnt / $pageDispCntMax));
if($pageNo >= $pageMax) {
	$pageNo = $pageMax;
}
if($pageNo < 1) {
	$pageNo = 1;
}
$pageIndex = $pageNo-1;
$articleInfoList = $articleData->getInfoList($searchInfoList, 3, $pageDispCntMax*$pageIndex, $pageDispCntMax);
$listCnt = count($articleInfoList);
$listDispCntMin = $pageIndex * $pageDispCntMax + 1;
if($listCnt < $pageIndex * $pageDispCntMax + $pageDispCntMax) {
	$listDispCntMax = $pageIndex * $pageDispCntMax + $listCnt - $pageIndex * $pageDispCntMax ;
}else{
	$listDispCntMax = $pageDispCntMax + $pageIndex * $pageDispCntMax ;
}
?>
					<div class="ListBox ListType1">
<?php
HtmlPartsArticle::printList($articleInfoList, $session, array(
	 'CategoryGroupId' => $categoryGroupId
	,'DisplayImage' => true
	,'DisplayMax' => 6
	,'SortType' => 3
	,'DisplayTagType' => 1
	,'DisplayDescription' => true
	,'DisplayUpDate' => true
	,'DisplayPersonInfo' => true
	,'DisplayCategory' => true
	,'DisplayTagLink' => true
	,'DisplayEffect' => 1
	,'DisplayColumnNum' => 3
	,'DisplayNewDays' => 6
	,'DisplayLankingMax' => 0
	,'DisplayView' => true
	,'DisplayLike' => true
	,'DisplayComment' => true
));
?>
					</div>
<?php } else { ?>
<?php $pageDispCntMax = 6; ?>
<?php
$totalCnt = $articleData->getCount($searchInfoList);
$pageMax = intval(ceil($totalCnt / $pageDispCntMax));
if($pageNo >= $pageMax) {
	$pageNo = $pageMax;
}
if($pageNo < 1) {
	$pageNo = 1;
}
$pageIndex = $pageNo-1;
$articleInfoList = $articleData->getInfoList($searchInfoList, 3, $pageDispCntMax*$pageIndex, $pageDispCntMax);
$listCnt = count($articleInfoList);
$listDispCntMin = $pageIndex * $pageDispCntMax + 1;
if($listCnt < $pageIndex * $pageDispCntMax + $pageDispCntMax) {
	$listDispCntMax = $pageIndex * $pageDispCntMax + $listCnt - $pageIndex * $pageDispCntMax ;
}else{
	$listDispCntMax = $pageDispCntMax + $pageIndex * $pageDispCntMax ;
}
?>
					<div class="ListBox ListType4">
<?php
HtmlPartsArticle::printList($articleInfoList, $session, array(
	 'CategoryGroupId' => $categoryGroupId
	,'DisplayImage' => true
	,'DisplayMax' => 6
	,'SortType' => 3
	,'DisplayTagType' => 4
	,'DisplayDescription' => true
	,'DisplayUpDate' => false
	,'DisplayPersonInfo' => false
	,'DisplayCategory' => false
	,'DisplayTagLink' => false
	,'DisplayEffect' => 1
	,'DisplayColumnNum' => 3
	,'DisplayNewDays' => 6
	,'DisplayLankingMax' => 0
	,'DisplayView' => false
	,'DisplayLike' => false
	,'DisplayComment' => false
));
?>
					</div>
<?php } ?>
