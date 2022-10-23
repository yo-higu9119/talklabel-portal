<?php
class HtmlPartsBoard {
	/**
	 * リスト表示する
	 * @param array $boardInfoList 表示する記事一覧
	 * @param object $session セッション情報
	 * @param array $settings 表示設定
	 *      CategoryGroupId   ：詳細ページへのリンクとして利用するURLのカテゴリグループ（0:一番若いIDを自動検索）
	 *      DisplayColumnNum  ：1行の表示上限数の指定(1～6)　※DisplayTagType 1,2,4
	 *      DisplayUpDate     ：更新日を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,4
	 *      DisplayTagLink    ：タグリンクを表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2
	 *      DisplayNewDays    ：NEWを表示する期間（登録日時から指定日数、0:表示なし）　※DisplayTagType 3
	 *      DisplayLankingMax ：順位を表示する最大（0:表示なし）　※DisplayTagType 1,2,4
	 *      DisplayPersonInfo ：公開投稿者表示設定（false:非表示 true:表示）
	 */
	static function printList($boardInfoList, $session, $settings) {
		$add_query = "";
		if(isset($_GET['c']) && is_numeric($_GET['c'])){
			$add_query .= "&c=".intval($_GET['c']);
		}
		if(isset($_GET['bc']) && is_numeric($_GET['bc'])){
			$add_query .= "&bc=".intval($_GET['bc']);
		}
		
		require_once dirname(__FILE__).'/../../../../common/inc/data/admin.php';
		$adminData = new AdminData($session->getMemberName());
		
		$defaultSettings = Array(
			 'CategoryGroupId' => 0
		);
		$settings = array_merge($defaultSettings, $settings);

		require_once dirname(__FILE__).'/../../../../common/inc/data/board_category.php';
		$boardCategoryData = new BoardCategoryData($session->getMemberName());
		$searchInfoList = array();
		$searchInfoList['search_parent_category_id'] = -2;
		$searchInfoList['search_is_disp'] = true;
		$boardCategoryInfoList = $boardCategoryData->getInfoList($searchInfoList, 3, 0, 9);

		$boardCategoryGroupPath = self::getCategoryGroupPath($settings['CategoryGroupId']);

		if(count($boardInfoList) > 0) {
			foreach($boardInfoList as $boardInfo) {
				$url = htmlspecialchars(SYSTEM_TOP_URL.$boardCategoryGroupPath.'detail.php?b='.$boardInfo->id.$add_query);

				if($boardInfo->postType == 0){
					$imgSrc = SYSTEM_TOP_URL.'core_sys/sys/file/get_com_mem_file.php?id='.$boardInfo->memberId;
				}else{
					$imgSrc = SYSTEM_TOP_URL.'core_sys/sys/file/get_com_admin_file.php?id='.$boardInfo->accountId;
				}
?>
							<section class="boardListLink link_box clear_fix">
<?php
				if($boardInfo->commentAuthDefoult == 1){
?>
								<div class="boardListProf clear_fix">
									<p class="commentPh"><img src="<?php echo $imgSrc; ?>" /></p>
									<h2><?php echo htmlspecialchars($boardInfo->title)?></h2>
								</div>
								<div class="boardListDet clear_fix">
									<div class="boardListBt clear_fix">
										<p class="BrdSiteAcs"><span><?php echo $boardInfo->viewCnt?></span></p>
										<p class="BrdSiteShare"><span><?php echo $boardInfo->empathy_cnt?></span></p>
										<p class="BrdSiteRes"><span><?php echo $boardInfo->comment_cnt?></span></p>
									</div>
									<div class="boardListName clear_fix">
										<p class="boardTopicsTime"><?php echo htmlspecialchars($boardInfo->registTimestamp->toString())?></p>
										<p class="boardTopicsName"><?php echo Util::dispLang(Language::WORD_00145);/*投稿者*/?> ： <?php echo htmlspecialchars($boardInfo->nickname)?><span class="boardNameS">【 <?php echo htmlspecialchars($boardInfo->referral_id)?> 】</span></p>
									</div>
								</div>
<?php
				} else {
?>
								<div class="boardListProf clear_fix">
									<p class="commentPh"><img src="<?php echo $imgSrc; ?>" /></p>
									<h2><?php echo Util::dispLang(Language::WORD_00041);/*承認待ちです*/?></h2>
								</div>
								<div class="boardListDet clear_fix">
									<div class="boardListName clear_fix">
										<p class="boardTopicsTime"><?php echo htmlspecialchars($boardInfo->registTimestamp->toString())?></p>
									</div>
								</div>
<?php
				}
?>
								<a href="<?php echo $url?>"></a>
							</section>
<?php
			}
		}
	}

	/**
	 * カテゴリグループの「公開側対象ファイル」を取得する。
	 * @param integer $categoryGroupId カテゴリグループID
	 * @return string 「公開側対象ファイル」（指定カテゴリグループIDが無い、または公開側対象ファイル未設定時は「community/board/」）
	 */
	static function getCategoryGroupPath($categoryGroupId) {
		require_once dirname(__FILE__).'/../../../../common/inc/data/board_category_group.php';
		$categoryGroupData = new BoardCategoryGroupData('');
		$categoryGroupInfo = $categoryGroupData->getInfo($categoryGroupId);

		if(trim($categoryGroupInfo->fileName)==='') {
			return 'community/board/';
		} else {
			return $categoryGroupInfo->fileName;
		}
	}

	/**
	 * サブナビを表示する
	 * @param object $session セッション
	 * @param integer $categoryGroupId 絞り込むカテゴリグループID（0:絞込無し）
	 */
	static function printSubNavi($session, $categoryGroupId, $addParam='') {
		require_once dirname(__FILE__).'/../../../../common/inc/data/board_category_group.php';
		$categoryGroupData = new BoardCategoryGroupData('');
		$categoryGroupInfo = $categoryGroupData->getInfo($categoryGroupId);
		$crt = (isset($_GET['bc']) && intval($_GET['bc']) == 0 || !isset($_GET['bc']))?' class="crt"':'';
?>
					<nav class="clear_fix">
						<ul>
							<li><a href="./"<?php echo $crt; ?>"><?php echo Util::dispLang(Language::WORD_00139);/*全ての掲示板*/?></a></li>
<?php
		self::_printSubNaviBoardCategory($session, $categoryGroupId, $addParam);
?>

						</ul>
					</nav>
<?php
	}

	private static function _printSubNaviGetBoardCategoryTag($session, $categoryTreeInfoList, $categoryInfoList, $level, $categoryGroupId, $addParam) {
		$classList = array('fir', 'sec', 'the', 'for');
		$tagStr = '';
		if(count($categoryTreeInfoList) > 0) {
			foreach($categoryTreeInfoList as $categoryTreeInfo) {
				$categoryInfo = $categoryInfoList[$categoryTreeInfo->id];
				if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased())) {
					if(count($classList) <= $level) {
						$level = count($classList)-1;
					}
					$target_str = '';
					$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
					if($categoryInfo->auto_link == 0){
						$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'?bc='.$categoryInfo->id.$addParam);
					}else if($categoryInfo->auto_link == 1){
						if(count($categoryInfo->contents) == 1){
							$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'detail.php?bc='.$categoryInfo->id.'&b='.$categoryInfo->contents[0].$addParam);
						}else{
							$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'?bc='.$categoryInfo->id.$addParam);
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
					if($categoryTreeInfo->shortName !== ""){
						$categoryName = $categoryTreeInfo->shortName;
					}else{
						$categoryName = $categoryTreeInfo->name;
					}
					$crt = (isset($_GET['bc']) && intval($_GET['bc']) == $categoryInfo->id)?' class="crt"':'';
					$tagStr .= '<li class="contentsNav_'.$classList[$level].'">';
					$tagStr .= '<a href="'.$link_str.'"'.$target_str.$crt.'>'.htmlspecialchars($categoryName).'</a>';
					$subTagStr = self::_printSubNaviGetBoardCategoryTag($session, $categoryTreeInfo->subInfoList, $categoryInfoList, $level+1, $categoryGroupId, $addParam);
					if($subTagStr !== '') {
						$tagStr .= '<ul class="children">'.$subTagStr.'</ul>';
					}
					$tagStr .= '</li>';
				}
			}
		}
		return $tagStr;
	}
	private static function _printSubNaviGetSubCategoryIdList($categoryTreeInfoList) {
		$categoryIdList = array();
		if(count($categoryTreeInfoList) > 0) {
			foreach($categoryTreeInfoList as $categoryTreeInfo) {
				$categoryIdList[$categoryTreeInfo->id] = $categoryTreeInfo->id;
				$categoryIdList += self::_printSubNaviGetSubCategoryIdList($categoryTreeInfo->subInfoList);
			}
		}
		return $categoryIdList;
	}
	private static function _printSubNaviBoardCategory($session, $categoryGroupId, $addParam) {
		require_once dirname(__FILE__).'/../../../../common/inc/data/board_category.php';
		$categoryData = new BoardCategoryData('');
		$categoryTreeInfoList = $categoryData->getTreeList($categoryGroupId);
		$categoryIdList = array();
		foreach($categoryTreeInfoList[-1]->subInfoList as $categoryTreeInfo) {
			$categoryIdList[$categoryTreeInfo->id] = $categoryTreeInfo->id;
			$categoryIdList += self::_printSubNaviGetSubCategoryIdList($categoryTreeInfo->subInfoList);
		}
		if(count($categoryIdList) === 0) {
			return;
		}

		$searchInfoList = array();
		$searchInfoList['search_id'] = $categoryIdList;
		$categoryInfoList = $categoryData->getInfoList($searchInfoList, 1);
		echo self::_printSubNaviGetBoardCategoryTag($session, $categoryTreeInfoList[-1]->subInfoList, $categoryInfoList, 0, $categoryGroupId, $addParam);
	}
}
?>