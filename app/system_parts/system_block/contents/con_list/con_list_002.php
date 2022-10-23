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
<?php
if(count($articleInfoList) == 0){
	// 割引ユーザー以外は禁止事項を表示
} else {
?>
	<div class="">
		<div class="qa-top__mypageListBox">
			<div class="htibrd clear_fix">
				<h2>TalkLabelの<span>禁止事項</span></h2>
			</div>
			<div class="qa-top__ListBox--contents">
				<p>ツールを安全にお使いいただくために、以下の禁止事項を守ってのご利用をお願い致します。</p>

					<div class="ListBox ListType1">
<?php
HtmlPartsArticle::printList($articleInfoList, $session, array(
	'CategoryGroupId' => 4
 ,'CategoryId' => $categoryId
 ,'DisplayCategory' => false
 ,'DisplayMax' => 3
 ,'SortType' => 3
 ,'DisplayTagType' => 3
 ,'DisplayColumnNum' => 2
 ,'DisplayImage' => 1
 ,'DisplayEffect' => 6
 ,'DisplayDescription' => false
 ,'DisplayUpDate' => false
 ,'DisplayTagLink' => false
 ,'DisplayNewDays' => false
 ,'DisplayLankingMax' => 0
 ,'DisplayPersonInfo' => 0
 ,'DisplayView' => true
 ,'DisplayLike' => true
 ,'DisplayComment' => true
));
?>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	?>

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

<?php
if(count($articleInfoList) == 0){
	// 割引ユーザー以外は禁止事項を表示
} else {
?>
	<div class="">
		<div class="qa-top__mypageListBox">
			<div class="htibrd clear_fix">
				<h2>TalkLabelの<span>禁止事項</span></h2>
			</div>
			<div class="qa-top__ListBox--contents">
				<p>ツールを安全にお使いいただくために、以下の禁止事項を守ってのご利用をお願い致します。</p>

				<div class="ListBox ListType4">
<?php
HtmlPartsArticle::printList($articleInfoList, $session, array(
	'CategoryGroupId' => 4
 ,'CategoryId' => $categoryId
 ,'DisplayCategory' => false
 ,'DisplayMax' => 8
 ,'SortType' => 3
 ,'DisplayTagType' => 3
 ,'DisplayColumnNum' => 2
 ,'DisplayImage' => 1
 ,'DisplayEffect' => 8
 ,'DisplayDescription' => false
 ,'DisplayUpDate' => false
 ,'DisplayTagLink' => false
 ,'DisplayNewDays' => false
 ,'DisplayLankingMax' => 0
 ,'DisplayPersonInfo' => 0
 ,'DisplayView' => true
 ,'DisplayLike' => true
 ,'DisplayComment' => true
));
?>
				</div>

			</div>
		</div>
	</div>
<?php
}
?>

<?php } ?>
