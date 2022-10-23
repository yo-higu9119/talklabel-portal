<?php

if($session->getMemberVeto() == 1){
	header('HTTP/1.0 404 Not Found');
	exit();
}
/*****************************************
 * 掲示板情報・パンくず取得用require file
 *****************************************
 * 必須変数
 * $boardId
 * $boardCategoryId
 *---------------------------------------
 * 呼び出しファイル
 * common/inc/data/board.php
 * common/inc/data/board_category.php
 *---------------------------------------
 * 参照可能変数
 * 記事情報オブジェクト：$info
 * 記事表示状態：$isDisp
 * パンくず配列：$breadcrumbList
 */
require_once dirname(__FILE__).'/../../../../../common/inc/data/board_category.php';
$boardCategoryData = new BoardCategoryData('Preview');
$boardCategoryTreeInfoList = $boardCategoryData->getTreeList($boardCategoryGroupId);

require_once dirname(__FILE__).'/../../../../../common/inc/data/board_category_group.php';
$boardCategoryGroupData = new BoardCategoryGroupData($session->getMemberName());
$boardCategoryGroupInfo = $boardCategoryGroupData->getInfo($boardCategoryGroupId );

require_once dirname(__FILE__).'/../../../../../common/inc/data/board.php';
$boardData = new BoardData($session->getMemberName());
$info = $boardData->getInfo($boardId);
$result = array();
$message = '';
$sErr = '';
if(isset($_POST['regist_check'])){
	$info->title = !isset($_POST['title'])?'':$_POST['title'];
	$info->nickname = !isset($_POST['nickname'])?'':$_POST['nickname'];
	$info->body = !isset($_POST['body'])?'':$_POST['body'];
	$info->postType = 0;
	$info->comment_is_accept = 1;
	$info->memberId = $session->getMemberId();
	if($boardCategoryGroupInfo->topicsAuthDisp === true){
		$info->commentAuthDefoult = 0;
	}else{
		$info->commentAuthDefoult = 1;
	}
	$info->status = 1;
	
	$info->categoryList = array();
	foreach($boardCategoryTreeInfoList as $boardCategoryTreeInfo) {
		if(isset($_POST['categoryId']) && $boardCategoryTreeInfo->id == intval($_POST['categoryId'])) {
			$info->categoryList[$boardCategoryTreeInfo->id] = $boardCategoryTreeInfo->id;
		}
	}
	$result = $info->check();
	if(count($result) === 0) {
		if(isset($_SESSION['regist_check']) && $_SESSION['regist_check'] === $_POST['regist_check']) {
			$info->id = $boardData->insert($info);
			if($info->id > 0) {
				require_once dirname(__FILE__).'/../../../../../common/inc/data/member_data.php';
				$memberData = new MemberData($session->getMemberName());
				$memberData->setBaseNo(1);
				$memberInfo = $memberData->getInfo($session->getMemberId());
				$memberInfo->nickname = $info->nickname;
				$memberData->update($memberInfo);
				
				$sErr = Util::dispLang(Language::WORD_00148);/*トピックスの登録が完了しました*/
			} else {
				$message = Util::dispLang(Language::WORD_00149);/*カテゴリの登録に失敗しました*/
			}
		} else {
			$sErr = Util::dispLang(Language::WORD_00150);/*ブラウザの更新ボタンがクリックされました。一度画面を閉じて再度登録内容をご確認ください。*/
			$info = new BoardInfo();
			$isInput = false;
		}
	}else{
		$message = Util::dispLang(Language::WORD_00114);/*入力内容に間違いがあります*/
	}
}else{
	$info->nickname = $session->getMemberNickname();
}
$registCheckKey = Util::randomStr(104);
$_SESSION['regist_check'] = $registCheckKey;

//パンくず
$breadcrumbList = $boardCategoryData->getBreadcrumbListToArticle($boardCategoryId, $info->id);
if(count($breadcrumbList) > 0) {
	$last = end($breadcrumbList);
	$boardCategoryId = intval($last['id']);
}

$boardCategoryInfo = $boardCategoryData->getInfo($boardCategoryId);

$addParam = '';
if($categoryId !== 0){
	$addParam .= '&c='.$categoryId;
}

$searchInfoList = array();
$searchInfoList['search_parent_category_id'] = -2;
$searchInfoList['search_id'] = $info->categoryList;
$boardCategoryInfoList = $boardCategoryData->getInfoList($searchInfoList, 3);
?>
