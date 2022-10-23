<?php
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