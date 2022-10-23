<?php
class HtmlPartsArticle {
	/**
	 * 簡易条件指定のデータを取得し、リスト表示する
	 * @param array $session セッション情報
	 * @param object $settings 簡易条件、表示設定
	 *     CategoryGroupId ：表示する記事が所属するカテゴリグループ番号を指定（0:串刺し）
	 *     CategoryId      ：表示する記事が所属するカテゴリ番号を指定（0:串刺し）
	 *     DisplayMax      ：表示最大件数を指定（NULL:全件表示）
	 *     SortType        ：表示順指定（1：登録降順/2：登録昇順/3：公開日が新しい順/4：ランダム/5：閲覧件数降順/6:コメント件数降順/7:いいね件数降順）
	 *     ExcludeArticleId:リストから除外する記事ID（0：除外対象無し）
	 *     top_new_list:TOP新着一覧への表示の設定（true：有効/false：無視して全件表示）
	 *     ignore_all:一覧(ALL)への表示の設定（true：有効/false：無視して全件表示）
	 *     ignore_lanking:ランキングへの表示の設定（true：有効/false：無視して全件表示）
	 *     ※表示設定はHtmlPartsArticle::printList()参照
	 */
	static function printSimpleConditionList($session, $settings) {
		$defaultSettings = Array(
			 'CategoryGroupId' => 0
			,'CategoryId' => 0
			,'DisplayMax' => NULL
			,'SortType' => 1
			,'ExcludeArticleId' => 0
			,'top_new_list' => false
			,'ignore_all' => false
			,'ignore_lanking' => false
			,'view_count_date_start' => ""
			,'view_count_date_end' => ""
		);
		$settings = array_merge($defaultSettings, $settings);

		require_once dirname(__FILE__).'/../../../../common/inc/data/article.php';
		$articleData = new ArticleData($session->getMemberName());

		$searchInfoList = array();
		$searchInfoList['search_is_auth'] = 1;
		$searchInfoList['search_x_open_contents'] = true;
		$searchInfoList['search_x_top_new_list'] = $settings['top_new_list'];
		$searchInfoList['search_x_ignore_all'] = $settings['ignore_all'];
		$searchInfoList['search_x_ignore_lanking'] = $settings['ignore_lanking'];
		$searchInfoList['search_x_category_none_tag'] = true;
		if($settings['CategoryGroupId'] > 0) {
			$searchInfoList['search_x_category_group_id'] = $settings['CategoryGroupId'];
		}
		if($settings['CategoryId'] > 0) {
			$searchInfoList['search_x_category_id'] = $settings['CategoryId'];
		}
		if($settings['ExcludeArticleId'] > 0) {
			$searchInfoList['search_not_id'] = $settings['ExcludeArticleId'];
		}
		if($settings['view_count_date_start']!="") {
			if(intval($settings['SortType']) == 5){//閲覧件数降順
				$searchInfoList['search_x_view_count_date_start'] = $settings['view_count_date_start'];
			}else if(intval($settings['SortType']) == 6){//コメント件数降順
				$searchInfoList['search_x_comment_count_date_start'] = $settings['view_count_date_start'];
			}else if(intval($settings['SortType']) == 7){//いいね件数降順
				$searchInfoList['search_x_empathy_count_date_start'] = $settings['view_count_date_start'];
			}
		}
		if($settings['view_count_date_end']!="") {
			if(intval($settings['SortType']) == 5){//閲覧件数降順
				$searchInfoList['search_x_view_count_date_end'] = $settings['view_count_date_end'];
			}else if(intval($settings['SortType']) == 6){//コメント件数降順
				$searchInfoList['search_x_comment_count_date_end'] = $settings['view_count_date_end'];
			}else if(intval($settings['SortType']) == 7){//いいね件数降順
				$searchInfoList['search_x_empathy_count_date_end'] = $settings['view_count_date_end'];
			}
		}
		
		/* 閲覧権限、閲覧制限指定（条件を満たさない物を除外） */
		require dirname(__FILE__).'/../parts/search_article_permission.php';
		
		$articleInfoList = $articleData->getInfoList($searchInfoList, $settings['SortType'], 0, $settings['DisplayMax']);

		self::printList($articleInfoList, $session, $settings);
	}

	/**
	 * 簡易条件指定のデータを取得し、リストから指定記事の前後のリンクを取得する
	 * @param array $session セッション情報
	 * @param object $settings 簡易条件、表示設定
	 *     CategoryGroupId ：表示する記事が所属するカテゴリグループ番号を指定（0:串刺し）
	 *     CategoryId      ：表示する記事が所属するカテゴリ番号を指定（0:串刺し）
	 *     DisplayMax      ：表示最大件数を指定（NULL:全件表示）
	 *     SortType        ：表示順指定（1：登録降順/2：登録昇順/3：公開日が新しい順/4：ランダム/5：閲覧件数降順/6:コメント件数降順/7:いいね件数降順）
	 *     ExcludeArticleId:リストから除外する記事ID（0：除外対象無し）
	 *     top_new_list:TOP新着一覧への表示の設定（true：有効/false：無視して全件表示）
	 *     ignore_all:一覧(ALL)への表示の設定（true：有効/false：無視して全件表示）
	 *     ignore_lanking:ランキングへの表示の設定（true：有効/false：無視して全件表示）
	 *     ※表示設定はHtmlPartsArticle::printList()参照
	 */
	static function printSimpleConditionListPrevAndNext($session, $settings, $ArticleId) {
		$defaultSettings = Array(
			 'CategoryGroupId' => 0
			,'CategoryId' => 0
			,'DisplayMax' => NULL
			,'SortType' => 1
			,'ExcludeArticleId' => 0
			,'top_new_list' => false
			,'ignore_all' => false
			,'ignore_lanking' => false
		);
		$settings = array_merge($defaultSettings, $settings);

		require_once dirname(__FILE__).'/../../../../common/inc/data/article.php';
		$articleData = new ArticleData($session->getMemberName());

		$searchInfoList = array();
		$searchInfoList['search_is_auth'] = 1;
		$searchInfoList['search_x_open_contents'] = true;
		$searchInfoList['search_x_top_new_list'] = $settings['top_new_list'];
		$searchInfoList['search_x_ignore_all'] = $settings['ignore_all'];
		$searchInfoList['search_x_ignore_lanking'] = $settings['ignore_lanking'];
		$searchInfoList['search_x_category_none_tag'] = true;
		$searchInfoList['search_link_type'] = 0;
		if($settings['CategoryGroupId'] > 0) {
			$searchInfoList['search_x_category_group_id'] = $settings['CategoryGroupId'];
		}
		if($settings['CategoryId'] > 0) {
			$searchInfoList['search_x_category_id'] = $settings['CategoryId'];
		}
		if($settings['ExcludeArticleId'] > 0) {
			$searchInfoList['search_not_id'] = $settings['ExcludeArticleId'];
		}
		
		/* 閲覧権限、閲覧制限指定（条件を満たさない物を除外） */
		require dirname(__FILE__).'/../parts/search_article_permission.php';
		
		$articleInfoList = $articleData->getInfoList($searchInfoList, $settings['SortType'], 0, $settings['DisplayMax']);
		
		$res = array();
		$res["prev"] = self::prev_key($articleInfoList,$ArticleId);
		if($res["prev"] != ""){$res["prev"] = $articleInfoList[intval($res["prev"])]->urlKey;}
		$res["next"] = self::next_key($articleInfoList,$ArticleId);
		if($res["next"] != ""){$res["next"] = $articleInfoList[intval($res["next"])]->urlKey;}
		
		return $res;
	}
	
	private static function prev_key($array,$key){
		$tmp = "";
		foreach($array as $k => $v){
			if($k == $key){
				return $tmp;
			}
			$tmp = $k;
		}
		return "";
	}
	
	private static function next_key($array,$key){
		$tmp = "";
		foreach($array as $k => $v){
			if($k == $key){
				$tmp = $k;
			}elseif($tmp !== ""){
				return $k;
			}
		}
		return "";
	}
	
	/**
	 * リスト表示する
	 * @param array $articleInfoList 表示する記事一覧
	 * @param object $session セッション情報
	 * @param array $settings 表示設定
	 *      CategoryGroupId   ：詳細ページへのリンクとして利用するURLのカテゴリグループ（0:一番若いIDを自動検索）
	 *      DisplayTagType    ：デザインを指定（1～5）
	 *      DisplayColumnNum  ：1行の表示上限数の指定(1～6)　※DisplayTagType 1,2,4
	 *      DisplayTitle      ：メインタイトルを表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      DisplayImage      ：画像を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,4
	 *      DisplayEffect     ：ロールオーバー時のアニメーション指定(0:なし)　※DisplayTagType 1,2,4
	 *      DisplayDescription：ディスクリプションを表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      DisplayUpDate     ：更新日を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      DisplayTagLink    ：タグリンクを表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      DisplayNewDays    ：NEWを表示する期間（登録日時から指定日数、0:表示なし）　※DisplayTagType 1,2,3,4,5
	 *      DisplayLankingMax ：順位を表示する最大（0:表示なし）　※DisplayTagType 1,2,4
	 *      DisplayPersonInfo ：公開投稿者表示設定（false:非表示 true:表示）　※DisplayTagType 1,2,3,4,5
	 *      DisplayCategory   ：所属カテゴリリスト表示設定（false:非表示 true:表示）　※DisplayTagType 1,2,3,4,5
	 *      DisplayView       ：ページビュー表示設定（false:非表示 true:表示）　※DisplayTagType 1,2,3,4,5
	 *      DisplayLike       ：いいね数表示設定（false:非表示 true:表示）　※DisplayTagType 1,2,3,4,5
	 *      DisplayComment    ：コメント数表示設定（false:非表示 true:表示）　※DisplayTagType 1,2,3,4,5
	 *      DisplayLinkBt     ：詳細リンクボタンの表示設定（false:非表示 true:表示）　※DisplayTagType 1,2,3,4,5
	 *      view_count_date_start：ビュー表示時のカウント（開始年月日を設定するとそれ以降全てを抽出）
	 *      view_count_date_end  ：ビュー表示時のカウント（終了年月日を設定するとそれ以前全てを抽出）
	 *      titleTag          ：一覧の記事タイトルのタグ(1-5:h1-h5,6:Pタグ,7:divタグ)
	 *      gridLayoutType    ：グリッドレイアウトの場合のタイプ指定（1-2：タイプ,0:個別カスタム）※DisplayTagType 6
	 *      gridCustom        ：グリッドレイアウト時のそれぞれの要素のカスタム
	 */
	static function printList($articleInfoList, $session, $settings) {
		$add_query = "";
		if(isset($_GET['c']) && is_numeric($_GET['c'])){
			$add_query = "&c=".intval($_GET['c']);
		}
		
		require_once dirname(__FILE__).'/../../../../common/inc/data/admin.php';
		$adminData = new AdminData($session->getMemberName());
		
		$defaultSettings = Array(
			 'CategoryGroupId' => 0
			,'DisplayTagType' => 1
			,'DisplayColumnNum' => 1
			,'DisplayTitle' => true
			,'DisplayImage' => true
			,'DisplayEffect' => 0
			,'DisplayDescription' => true
			,'DisplayUpDate' => true
			,'DisplayTagLink' => false
			,'DisplayNewDays' => 7
			,'DisplayLankingMax' => 0
			,'DisplayPersonInfo' => false
			,'DisplayCategory' => true
			,'DisplayView' => true
			,'DisplayLike' => true
			,'DisplayComment' => true
			,'DisplayLinkBt' => true
			,'view_count_date_start' => ""
			,'view_count_date_end' => ""
			,'titleTag' => 2
			,'gridLayoutType' => 1
			,'gridCustom' => Array(
				 'columns' => '1em 1fr auto auto 1em'
				,'rows' => 'auto'
				,'image' => '1 / 1 / 3 / 6'
				,'rankIco' => '1 / 1 / 2 / 2'
				,'cateName' => '3 / 2 / 4 / 5'
				,'tagLink' => '8 / 2 / 9 / 4'
				,'listTitle' => '4 / 2 / 5 / 5'
				,'distxt' => '5 / 2 / 6 / 5'
				,'person' => '6 / 2 / 7 / 5'
				,'rank_area' => '7 / 2 / 8 / 3'
				,'update_area' => '7 / 4 / 8 / 5'
				,'new_ico_area' => '7 / 3 / 8 / 4'
			)
		);
		$settings = array_merge($defaultSettings, $settings);

		require_once dirname(__FILE__).'/../../../../common/inc/data/category.php';
		$categoryData = new CategoryData($session->getMemberName());
		/* タグリスト取得 */
		$searchInfoList = array();
		$searchInfoList['search_parent_category_id'] = -2;
		$searchInfoList['search_is_disp'] = true;

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

		$categoryInfoList = $categoryData->getInfoList($searchInfoList, 3, 0, 9);
		/* タグリスト取得 */
		/* カテゴリリスト取得 */
		$searchInfoList = array();
		$searchInfoList['search_not_parent_category_id'] = -2;
		$searchInfoList['search_is_disp'] = true;

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

		$categoryInfoList2 = $categoryData->getInfoList($searchInfoList, 3, 0, 9);
		/* カテゴリリスト取得 */

		$categoryGroupPath = self::getCategoryGroupPath($settings['CategoryGroupId']);

		if(!self::getIsUseTag($settings['CategoryGroupId'])){
			$settings['DisplayTagLink'] = false;
		}

		$limitDatetime = new CommonDateTime();
		$limitDatetime->setFromStr(date('Y-m-d H:i', strtotime('-'.$settings['DisplayNewDays'].' day')));

		$cnt = 1;
		
		switch($settings['titleTag']){
				case 1: $titleTag = 'h1'; break;
				case 2: $titleTag = 'h2'; break;
				case 3: $titleTag = 'h3'; break;
				case 4: $titleTag = 'h4'; break;
				case 5: $titleTag = 'h5'; break;
				case 6: $titleTag = 'p'; break;
				case 7: $titleTag = 'div'; break;
		}
		if(count($articleInfoList) == 0){
			echo '<p class="CautTxt Caution cnt mgt10 mgb10">'.Util::dispLang(Language::WORD_00584)/*コンテンツ記事はありません*/.'</p>';
		}else if($settings['DisplayTagType'] === 1){
?>
					<article class="tpl-contents-block tpl-contents-block-type01">
						<div class="tpl-flexcolumn<?php echo $settings['DisplayColumnNum'];?> clear_fix">
							<div class="tpl-contents-block-inn sldYblock">
<?php
			if(count($articleInfoList) > 0) {
				foreach($articleInfoList as $articleInfo) {
					$articleInfoCnt = self::_articleInfoCnt($articleInfo, $categoryGroupPath, $add_query, $settings);
?>
								<section class="column article_<? echo $articleInfo->id?>">
									<div class="tpl-contents-block-inn-image">
<?php
					if($settings['DisplayImage']){
?>
										<figure class="image">
											<a href="<?php echo $articleInfoCnt['url']?>"<?php echo $articleInfoCnt['target']?>><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_article_file.php?id='.$articleInfo->id.'&type=_m')?>" alt="">
												<?php if($settings['DisplayEffect'] > 0){?>
												<figcaption class="mouseAnimeType<?php echo sprintf('%02d', $settings['DisplayEffect'])?>">
													<section>
														<p class="nextRead"><?php echo Util::dispLang(Language::WORD_00144);/*続きを見る*/?></p>
														<p class="figureCap"><?php 
												  switch($articleInfo->meta_descriptin){
													  case '':
													  	echo Util::emptyStr(mb_substr(strip_tags($articleInfo->body),0,150));
													  break;
													  default :
													    echo Util::emptyStr($articleInfo->meta_descriptin);
												  }?></p>
													</section>
												</figcaption>
												<?php }?>
											</a>
<?php
						if($cnt <= $settings['DisplayLankingMax']) {
?>
											<p class="rankIco"><?php echo $cnt?></p>
<?php
						}
?>
										</figure>
<?php
					}
?>
										<div class="clmDetail">
<?php
					if($settings['DisplayCategory']){
						$tagStr = '';
						foreach($articleInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList2)) {
								$categoryInfo = $categoryInfoList2[$categoryId];
								if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId()) && $categoryInfo->parentCategoryId !== -2) {
									$color = ($categoryInfo->color == '')?'':' style="background:'.$categoryInfo->color.'"';
									$tagStr .= '<li><span class="cateIco cateIco'.$categoryInfo->id.'"'.$color.'>'.htmlspecialchars(trim($categoryInfo->shortName)===''?$categoryInfo->name:$categoryInfo->shortName).'</span></li>';
								}
							}
						}
						if(trim($tagStr) !== '') {
?>
											<ul class="cateName clear_fix"><?php echo $tagStr;?></ul>
<?php
						}
					}
?>
<?php
					if($settings['DisplayTitle']){
?>
											<<?php echo $titleTag;?> class="ListMainTitle"><a href="<?php echo $articleInfoCnt['url']?>"<?php echo $articleInfoCnt['target']?>><?php echo htmlspecialchars($articleInfo->title)?></a></<?php echo $titleTag;?>>
<?php
					}
					if($settings['DisplayDescription'] && ($articleInfo->meta_descriptin !== "" || $articleInfo->body !== "")){
?>
											<div class="distxt"><p class="txt"><?php 
												if($articleInfo->meta_descriptin !== ""){
													echo $articleInfo->meta_descriptin;
												}else{
												echo Util::emptyStr(mb_substr(strip_tags($articleInfo->body),0,150));
												}?></p></div>
<?php
					}
					if($settings['DisplayPersonInfo']) {
						$adminInfo = $adminData->getInfo($articleInfo->accountId);
						$adminImg ='';
						if($adminInfo->img_name !== ""){
							$adminImg = '<figure><img src="'.SYSTEM_TOP_URL.'core_sys/sys/file/get_prof_file.php?id='.$adminInfo->id.'"></figure>';
						}
						$adminProf ='';
						if(trim($adminInfo->profile) !== ""){
							$adminProf = '<p class="prof">'.$adminInfo->profile.'</p>';
						}
?>
											<div class="person clear_fix">
												<div class="person_ph clear_fix">
													<?php echo $adminImg; ?>
													<div class="name_area">
														<div class="clear_fix">
															<p class="name"><?php echo htmlspecialchars($adminInfo->name); ?></p>
															<p class="work"><?php echo htmlspecialchars($adminInfo->aff); ?></p>
														</div>
													</div>
												</div>
												<?php echo $adminProf; ?>
											</div>
<?php
					}
?>
										</div>
<?php
/* アイコンエリア　ここから */
					if($articleInfoCnt['viewCnt'] || $articleInfoCnt['empathyCnt'] || $articleInfoCnt['commentCnt'] || $settings['DisplayUpDate'] || $settings['DisplayNewDays']){
?>
										<div class="rank_date_area">
											<div class="rank_date_area_inn clear_fix">
<?php
						if($articleInfoCnt['viewCnt']){
?>
												<p class="view"><?php echo $articleInfoCnt['viewCnt']; ?></p>
<?php
						}
						if($articleInfoCnt['empathyCnt']){
?>
												<p class="like"><?php echo $articleInfoCnt['empathyCnt']; ?></p>
<?php
						}
						if($articleInfoCnt['commentCnt']){
?>
												<p class="comment"><?php echo $articleInfoCnt['commentCnt']; ?></p>
<?php
						}
						if($settings['DisplayUpDate']){
?>
												<p class="cap"><?php echo htmlspecialchars($articleInfo->openDatetime->toDateString())?></p>
<?php
						}
						if($settings['DisplayNewDays']) {
							if($limitDatetime->toValue() < $articleInfo->openDatetime->toValue()) {
?>
												<p class="ico"><span class="IcoBox NewIcBg BgPnc">NEW</span></p>
<?php
							}
						}
?>
											</div>
										</div>
<?php
					}
/* アイコンエリア　ここまで */
?>
<?php
					if($settings['DisplayTagLink']){
						$tagStr = '';
						foreach($articleInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList)) {
								$categoryInfo = $categoryInfoList[$categoryId];
								if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId())) {
									$target_str = '';
									$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
									if($categoryGroupfileName == 'contents/article/'){
										$categoryGroupfileName = 'contents/article/';
									}
									if($categoryInfo->auto_link == 0){
										$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?c='.$categoryInfo->id);
									}else if($categoryInfo->auto_link == 1){
										if(count($categoryInfo->contents) == 1){
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'index.php?c='.$categoryInfo->id.'&s='.$categoryInfo->contents[0]);
										}else{
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?c='.$categoryInfo->id);
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
									
									$tagStr .= '<li><a href="'.$link_str.'"'.$target_str.'>'.htmlspecialchars(trim($categoryInfo->shortName)===''?$categoryInfo->name:$categoryInfo->shortName).'</a></li>';
								}
							}
						}
						if(trim($tagStr) !== '') {
?>
										<ul class="tagLink clear_fix"><?php echo $tagStr;?></ul>
<?php
						}
					}
?>
<?php
					if($settings['DisplayLinkBt']){
?>
											<p class="BtM"><a href="<?php echo $articleInfoCnt['url']?>"<?php echo $articleInfoCnt['target']?> class="ListLinkBt next"><?php echo Util::dispLang(Language::WORD_00694);/*詳細を見る*/?></a></p>
<?php
					}
?>
									</div>
								</section>
<?php
					$cnt++;
				}
			}
?>
							</div>
						</div>
					</article>
<?php
		}else if($settings['DisplayTagType'] === 2){
?>
					<div class="sldYblock">
<?php
			if(count($articleInfoList) > 0) {
				foreach($articleInfoList as $articleInfo) {
					$articleInfoCnt = self::_articleInfoCnt($articleInfo, $categoryGroupPath, $add_query, $settings);
?>
						<article class="tpl-contents-block clmDetail clear_fix">
							<div class="tpl-flexcolumn<?php echo $settings['DisplayColumnNum'];?> clear_fix">
								<div class="tpl-contents-block-inn clear_fix">
									<section class="column">
										<div class="tpl-contents-block-inn-image">
<?php
					if($settings['DisplayImage']){
?>
											<figure class="image">
												<a href="<?php echo $articleInfoCnt['url']?>"<?php echo $articleInfoCnt['target']?>>
													<img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_article_file.php?id='.$articleInfo->id.'&type=_m')?>" alt="">
													<?php if($settings['DisplayEffect'] > 0){?>
													<figcaption class="mouseAnimeType<?php echo sprintf('%02d', $settings['DisplayEffect'])?>">
														<section>
															<p class="nextRead"><?php echo Util::dispLang(Language::WORD_00144);/*続きを見る*/?></p>
															<p class="figureCap"><?php 
													  switch($articleInfo->meta_descriptin){
														  case '':
														  	echo Util::emptyStr(mb_substr(strip_tags($articleInfo->body),0,150));
														  break;
														  default :
														    echo Util::emptyStr($articleInfo->meta_descriptin);
													  }?></p>
														</section>
													</figcaption>
													<?php }?>
												</a>
<?php
						if($cnt <= $settings['DisplayLankingMax']) {
?>
												<p class="rankIco"><?php echo $cnt?></p>
<?php
						}
?>
											</figure>
<?php
					}
?>
										</div>
									</section>

									<section class="column col<?php echo $settings['DisplayColumnNum']-1;?>">
<?php
					if($settings['DisplayCategory']){
						$tagStr = '';
						foreach($articleInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList2)) {
								$categoryInfo = $categoryInfoList2[$categoryId];
								if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId()) && $categoryInfo->parentCategoryId !== -2) {
									$color = ($categoryInfo->color == '')?'':' style="background:'.$categoryInfo->color.'"';
									$tagStr .= '<li><span class="cateIco cateIco'.$categoryInfo->id.'"'.$color.'>'.htmlspecialchars(trim($categoryInfo->shortName)===''?$categoryInfo->name:$categoryInfo->shortName).'</span></li>';
								}
							}
						}
						if(trim($tagStr) !== '') {
?>
										<ul class="cateName clear_fix"><?php echo $tagStr;?></ul>
<?php
						}
					}
?>
<?php
					if($settings['DisplayTitle']){
?>
										<<?php echo $titleTag;?> class="ListMainTitle"><a href="<?php echo $articleInfoCnt['url']?>"<?php echo $articleInfoCnt['target']?>><?php echo htmlspecialchars($articleInfo->title)?></a></<?php echo $titleTag;?>>
<?php
					}
					if($settings['DisplayDescription'] && ($articleInfo->meta_descriptin !== "" || $articleInfo->body !== "")){
?>
										<div class="distxt"><p class="txt"><?php 
											if($articleInfo->meta_descriptin !== ""){
												echo $articleInfo->meta_descriptin;
											}else{
												echo Util::emptyStr(mb_substr(strip_tags($articleInfo->body),0,150));
											}?></p></div>
<?php
					}
					if($settings['DisplayPersonInfo']) {
						$adminInfo = $adminData->getInfo($articleInfo->accountId);
						$adminImg ='';
						if($adminInfo->img_name !== ""){
							$adminImg = '<figure><img src="'.SYSTEM_TOP_URL.'core_sys/sys/file/get_prof_file.php?id='.$adminInfo->id.'"></figure>';
						}
						$adminProf ='';
						if(trim($adminInfo->profile) !== ""){
							$adminProf = '<p class="prof">'.$adminInfo->profile.'</p>';
						}
?>
										<div class="person clear_fix">
											<div class="person_ph clear_fix">
												<?php echo $adminImg; ?>
												<div class="name_area">
													<div class="clear_fix">
														<p class="name"><?php echo htmlspecialchars($adminInfo->name); ?></p>
														<p class="work"><?php echo htmlspecialchars($adminInfo->aff); ?></p>
													</div>
													<?php echo $adminProf; ?>
												</div>
											</div>
										</div>
<?php
					}
?>
<?php
/* アイコンエリア　ここから */
					if($articleInfoCnt['viewCnt'] || $articleInfoCnt['empathyCnt'] || $articleInfoCnt['commentCnt'] || $settings['DisplayUpDate'] || $settings['DisplayNewDays']){
?>
										<div class="rank_date_area">
											<div class="rank_date_area_inn clear_fix">
<?php
						if($articleInfoCnt['viewCnt']){
?>
												<p class="view"><?php echo $articleInfoCnt['viewCnt']; ?></p>
<?php
						}
						if($articleInfoCnt['empathyCnt']){
?>
												<p class="like"><?php echo $articleInfoCnt['empathyCnt']; ?></p>
<?php
						}
						if($articleInfoCnt['commentCnt']){
?>
												<p class="comment"><?php echo $articleInfoCnt['commentCnt']; ?></p>
<?php
						}
						if($settings['DisplayUpDate']){
?>
												<p class="cap"><?php echo htmlspecialchars($articleInfo->openDatetime->toDateString())?></p>
<?php
						}
						if($settings['DisplayNewDays']) {
							if($limitDatetime->toValue() < $articleInfo->openDatetime->toValue()) {
?>
												<p class="ico"><span class="IcoBox NewIcBg BgPnc">NEW</span></p>
<?php
							}
						}
?>
											</div>
										</div>
<?php
					}
/* アイコンエリア　ここまで */
?>
<?php
					if($settings['DisplayTagLink']){
						$tagStr = '';
						foreach($articleInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList)) {
								$categoryInfo = $categoryInfoList[$categoryId];
								if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId())) {
									$target_str = '';
									$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
									if($categoryGroupfileName == 'contents/article/'){
										$categoryGroupfileName = 'contents/article/';
									}
									if($categoryInfo->auto_link == 0){
										$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?c='.$categoryInfo->id);
									}else if($categoryInfo->auto_link == 1){
										if(count($categoryInfo->contents) == 1){
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'index.php?c='.$categoryInfo->id.'&s='.$categoryInfo->contents[0]);
										}else{
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?c='.$categoryInfo->id);
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
									$tagStr .= '<li class="LayoutL"><a href="'.$link_str.'"'.$target_str.'>'.htmlspecialchars(trim($categoryInfo->shortName)===''?$categoryInfo->name:$categoryInfo->shortName).'</a></li>';
								}
							}
						}
						if(trim($tagStr) !== '') {
?>
										<ul class="tagLink clear_fix"><?php echo $tagStr;?></ul>
<?php
						}
					}
?>
<?php
						if($settings['DisplayLinkBt']){
?>
										<p class="BtM"><a href="<?php echo $articleInfoCnt['url']?>"<?php echo $articleInfoCnt['target']?> class="ListLinkBt next"><?php echo Util::dispLang(Language::WORD_00694);/*詳細を見る*/?></a></p>
<?php
						}
?>
									</section>
								</div>
							</div>
						</article>
<?php
					$cnt++;
				}
			}
?>
					</div>
<?php
		}else if($settings['DisplayTagType'] === 3){
?>
					<article class="tpl-1st-block ListTSgle">
						<section class="sldTblock sldYblock">
<?php
			if(count($articleInfoList) > 0) {
				foreach($articleInfoList as $articleInfo) {
					$articleInfoCnt = self::_articleInfoCnt($articleInfo, $categoryGroupPath, $add_query, $settings);
?>
							<dl class="clmDetail clear_fix">
								<dd class="timeArea">
<?php
					if($settings['DisplayUpDate']) {
?>
								<p class="time"><?php echo htmlspecialchars($articleInfo->openDatetime->toDateString())?></p>
<?php
					}
?>
<?php
					if($settings['DisplayNewDays']) {
						if($limitDatetime->toValue() < $articleInfo->openDatetime->toValue()) {
?>
								<p class="ico"><span class="IcoBox NewIcBg BgPnc">NEW</span></p>
<?php
					}
?>
								</dd>
<?php
					}
					if($settings['DisplayCategory']){
						$tagStr = '';
						foreach($articleInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList2)) {
								$categoryInfo = $categoryInfoList2[$categoryId];
								if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId()) && $categoryInfo->parentCategoryId !== -2) {
									$color = ($categoryInfo->color == '')?'':' style="background:'.$categoryInfo->color.'"';
									$tagStr .= '<li><span class="cateIco cateIco'.$categoryInfo->id.'"'.$color.'>'.htmlspecialchars(trim($categoryInfo->shortName)===''?$categoryInfo->name:$categoryInfo->shortName).'</span></li>';
								}
							}
						}
						if(trim($tagStr) !== '') {
?>
								<dd class="cate_area">
									<ul class="cateName clear_fix"><?php echo $tagStr;?></ul>
								</dd>
<?php
						}
					}
?>
								<dd class="title_area">
									<<?php echo $titleTag;?> class="ListMainTitle"><a href="<?php echo $articleInfoCnt['url']?>"<?php echo $articleInfoCnt['target']?>><?php echo htmlspecialchars($articleInfo->title)?></a></<?php echo $titleTag;?>>
<?php
					if($settings['DisplayDescription'] && ($articleInfo->meta_descriptin !== "" || $articleInfo->body !== "")){
?>
									<p class="txt"><?php 
												  switch($articleInfo->meta_descriptin){
													  case '':
													  	echo Util::emptyStr(mb_substr(strip_tags($articleInfo->body),0,150));
													  break;
													  default :
													    echo Util::emptyStr($articleInfo->meta_descriptin);
												  }?></p>
<?php
					}
?>
								</dd>
<?php
					if($settings['DisplayPersonInfo']) {
						$adminInfo = $adminData->getInfo($articleInfo->accountId);
						$adminImg ='';
						if($adminInfo->img_name !== ""){
							$adminImg = '<figure><img src="'.SYSTEM_TOP_URL.'core_sys/sys/file/get_prof_file.php?id='.$adminInfo->id.'"></figure>';
						}
						$adminProf ='';
						if(trim($adminInfo->profile) !== ""){
							$adminProf = '<p class="prof">'.$adminInfo->profile.'</p>';
						}
?>
								<dd class="person_area column">
									<section class="person clear_fix">
										<div class="person_ph clear_fix">
											<?php echo $adminImg; ?>
											<div class="name_area">
												<div class="clear_fix">
													<p class="name"><?php echo htmlspecialchars($adminInfo->name); ?></p>
													<p class="work"><?php echo htmlspecialchars($adminInfo->aff); ?></p>
												</div>
												<?php echo $adminProf; ?>
											</div>
										</div>
									</section>
								</dd>
<?php
					}
?>
<?php
/* アイコンエリア　ここから */
					if($articleInfoCnt['viewCnt'] || $articleInfoCnt['empathyCnt'] || $articleInfoCnt['commentCnt']){
?>
								<dd class="rank_date_area">
									<div class="rank_date_area_inn clear_fix">
<?php
						if($articleInfoCnt['viewCnt']){
?>
										<p class="view"><?php echo $articleInfoCnt['viewCnt']; ?></p>
<?php
						}
						if($articleInfoCnt['empathyCnt']){
?>
										<p class="like"><?php echo $articleInfoCnt['empathyCnt']; ?></p>
<?php
						}
						if($articleInfoCnt['commentCnt'] && $articleInfo->link_type == 0){
?>
										<p class="comment"><?php echo $articleInfo->comment_cnt; ?></p>
<?php
					}
?>
									</div>
								</dd>
<?php
					}
/* アイコンエリア　ここまで */
?>
<?php
					if($settings['DisplayTagLink']){
						$tagStr = '';
						foreach($articleInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList)) {
								$categoryInfo = $categoryInfoList[$categoryId];
								if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId())) {
									$target_str = '';
									$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
									if($categoryGroupfileName == 'contents/article/'){
										$categoryGroupfileName = 'contents/article/';
									}
									if($categoryInfo->auto_link == 0){
										$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?c='.$categoryInfo->id);
									}else if($categoryInfo->auto_link == 1){
										if(count($categoryInfo->contents) == 1){
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'index.php?c='.$categoryInfo->id.'&s='.$categoryInfo->contents[0]);
										}else{
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?c='.$categoryInfo->id);
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
									
									$tagStr .= '<li><a href="'.$link_str.'"'.$target_str.'>'.htmlspecialchars(trim($categoryInfo->shortName)===''?$categoryInfo->name:$categoryInfo->shortName).'</a></li>';
								}
							}
						}
						if(trim($tagStr) !== '') {
?>
								<dd class="tagLinkArea">
									<ul class="tagLink clear_fix"><?php echo $tagStr;?></ul>
								</dd>
<?php
						}
					}
?>
<?php
						if($settings['DisplayLinkBt']){
?>
								<dd class="ListLinkBtArea">
									<p class="BtM"><a href="<?php echo $articleInfoCnt['url']?>"<?php echo $articleInfoCnt['target']?> class="ListLinkBt next"><?php echo Util::dispLang(Language::WORD_00694);/*詳細を見る*/?></a></p>
								</dd>
<?php
						}
?>
							</dl>
<?php
					$cnt++;
				}
			}
?>
						</section>
					</article>
<?php
		}else if($settings['DisplayTagType'] === 4){
?>
					<div class="sldYblock">
<?php
			if(count($articleInfoList) > 0) {
				foreach($articleInfoList as $articleInfo) {
					$articleInfoCnt = self::_articleInfoCnt($articleInfo, $categoryGroupPath, $add_query, $settings);
					?>
						<article class="tpl-contents-block link_box clmDetail clear_fix">
							<div class="tpl-flexcolumn<?php echo $settings['DisplayColumnNum'];?> clear_fix">
								<div class="tpl-contents-block-inn">
									<section class="column">
										<div class="tpl-contents-block-inn-image">
<?php
					if($settings['DisplayImage']){
?>
											<figure class="image">
												<img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_article_file.php?id='.$articleInfo->id.'&type=_m')?>" alt="">
<?php
						if($cnt <= $settings['DisplayLankingMax']) {
?>
												<p class="rankIco"><?php echo $cnt?></p>
<?php
						}
?>
											</figure>
<?php
					}
?>
										</div>
									</section>

									<section class="column col<?php echo $settings['DisplayColumnNum']-1;?>">
<?php
					if($settings['DisplayCategory']){
						$tagStr = '';
						foreach($articleInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList2)) {
								$categoryInfo = $categoryInfoList2[$categoryId];
								if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId()) && $categoryInfo->parentCategoryId !== -2) {
									$color = ($categoryInfo->color == '')?'':' style="background:'.$categoryInfo->color.'"';
									$tagStr .= '<li><span class="cateIco cateIco'.$categoryInfo->id.'"'.$color.'>'.htmlspecialchars(trim($categoryInfo->shortName)===''?$categoryInfo->name:$categoryInfo->shortName).'</span></li>';
								}
							}
						}
						if(trim($tagStr) !== '') {
?>
										<ul class="cateName clear_fix"><?php echo $tagStr;?></ul>
<?php
						}
					}
?>
<?php
					if($settings['DisplayTitle']){
?>
										<<?php echo $titleTag;?> class="ListMainTitle"><?php echo htmlspecialchars($articleInfo->title)?></<?php echo $titleTag;?>>
<?php
					}
					if($settings['DisplayDescription'] && ($articleInfo->meta_descriptin !== "" || $articleInfo->body !== "")){
?>
										<div class="distxt"><p class="txt"><?php 
											if($articleInfo->meta_descriptin !== ""){
												echo $articleInfo->meta_descriptin;
											}else{
												echo Util::emptyStr(mb_substr(strip_tags($articleInfo->body),0,150));
											}?></p></div>
<?php
					}
					if($settings['DisplayPersonInfo']) {
						$adminInfo = $adminData->getInfo($articleInfo->accountId);
						$adminImg ='';
						if($adminInfo->img_name !== ""){
							$adminImg = '<figure><img src="'.SYSTEM_TOP_URL.'core_sys/sys/file/get_prof_file.php?id='.$adminInfo->id.'"></figure>';
						}
						$adminProf ='';
						if(trim($adminInfo->profile) !== ""){
							$adminProf = '<p class="prof">'.$adminInfo->profile.'</p>';
						}
?>
											<div class="person clear_fix">
												<div class="person_ph clear_fix">
													<?php echo $adminImg; ?>
													<div class="name_area">
														<div class="clear_fix">
															<p class="name"><?php echo htmlspecialchars($adminInfo->name); ?></p>
															<p class="work"><?php echo htmlspecialchars($adminInfo->aff); ?></p>
														</div>
														<?php echo $adminProf; ?>
													</div>
												</div>
											</div>
<?php
					}
?>
<?php
/* アイコンエリア　ここから */
					if($articleInfoCnt['viewCnt'] || $articleInfoCnt['empathyCnt'] || $articleInfoCnt['commentCnt'] || $settings['DisplayUpDate'] || $settings['DisplayNewDays']){
?>
										<div class="rank_date_area">
											<div class="rank_date_area_inn clear_fix">
<?php
						if($articleInfoCnt['viewCnt']){
?>
												<p class="view"><?php echo $articleInfoCnt['viewCnt']; ?></p>
<?php
						}
						if($articleInfoCnt['empathyCnt']){
?>
												<p class="like"><?php echo $articleInfoCnt['empathyCnt']; ?></p>
<?php
						}
						if($articleInfoCnt['commentCnt']){
?>
												<p class="comment"><?php echo $articleInfoCnt['commentCnt']; ?></p>
<?php
						}
						if($settings['DisplayUpDate']){
?>
												<p class="cap"><?php echo htmlspecialchars($articleInfo->openDatetime->toDateString())?></p>
<?php
						}
						if($settings['DisplayNewDays']) {
							if($limitDatetime->toValue() < $articleInfo->openDatetime->toValue()) {
?>
												<p class="ico"><span class="IcoBox NewIcBg BgPnc">NEW</span></p>
<?php
							}
						}
?>
											</div>
										</div>
<?php
					}
/* アイコンエリア　ここまで */
?>
<?php
						if($settings['DisplayLinkBt']){
?>
											<p class="BtM"><span class="ListLinkBt next"><?php echo Util::dispLang(Language::WORD_00694);/*詳細を見る*/?></span></p>
									</section>
<?php
						}
?>
									<a href="<?php echo $articleInfoCnt['url']?>"<?php echo $articleInfoCnt['target']?>>リンク</a>
								</div>
							</div>
						</article>
<?php
					$cnt++;
				}
			}
?>
					</div>
<?php
		}else if($settings['DisplayTagType'] === 5){
?>
					<article class="tpl-1st-block ListTSgle">
						<section class="sldTblock sldYblock">
<?php
			if(count($articleInfoList) > 0) {
				foreach($articleInfoList as $articleInfo) {
					$articleInfoCnt = self::_articleInfoCnt($articleInfo, $categoryGroupPath, $add_query, $settings);
?>
							<div class="clmDetail">
								<div class="clmDetailCate">
<?php
/* 公開日エリア　ここから */
					if($settings['DisplayUpDate'] || $settings['DisplayNewDays']){
?>
									<div class="timeArea">
<?php
					if($settings['DisplayUpDate']) {
?>
										<p class="time"><?php echo htmlspecialchars($articleInfo->openDatetime->toDateString())?></p>
<?php
					}
					if($settings['DisplayNewDays']) {
						if($limitDatetime->toValue() < $articleInfo->openDatetime->toValue()) {
?>
										<p class="ico"><span class="IcoBox NewIcBg BgPnc">NEW</span></p>
<?php
					}
?>
									</div>
<?php
					}
/* 公開日エリア　ここまで */
?>
<?php
					if($settings['DisplayCategory']){
						$tagStr = '';
						foreach($articleInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList2)) {
								$categoryInfo = $categoryInfoList2[$categoryId];
								if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId()) && $categoryInfo->parentCategoryId !== -2) {
									$color = ($categoryInfo->color == '')?'':' style="background:'.$categoryInfo->color.'"';
									$tagStr .= '<li><span class="cateIco cateIco'.$categoryInfo->id.'"'.$color.'>'.htmlspecialchars(trim($categoryInfo->shortName)===''?$categoryInfo->name:$categoryInfo->shortName).'</span></li>';
								}
							}
						}
						if(trim($tagStr) !== '') {
?>
										<div class="cate_area">
											<ul class="cateName clear_fix"><?php echo $tagStr;?></ul>
										</div>
<?php
						}
					}
?>
								</div>
<?php
					}
?>
								<div class="clmDetailLi">
									<dl class="clear_fix">
										<dd class="title_area">
											<<?php echo $titleTag;?> class="ListMainTitle"><a href="<?php echo $articleInfoCnt['url']?>"<?php echo $articleInfoCnt['target']?>><?php echo htmlspecialchars($articleInfo->title)?></a></<?php echo $titleTag;?>>
<?php
					if($settings['DisplayDescription'] && ($articleInfo->meta_descriptin !== "" || $articleInfo->body !== "")){
?>
											<p class="txt"><?php 
														  switch($articleInfo->meta_descriptin){
															  case '':
															  	echo Util::emptyStr(mb_substr(strip_tags($articleInfo->body),0,150));
															  break;
															  default :
															    echo Util::emptyStr($articleInfo->meta_descriptin);
														  }?></p>
<?php
					}
?>
										</dd>
<?php
					if($settings['DisplayPersonInfo']) {
						$adminInfo = $adminData->getInfo($articleInfo->accountId);
						$adminImg ='';
						if($adminInfo->img_name !== ""){
							$adminImg = '<figure><img src="'.SYSTEM_TOP_URL.'core_sys/sys/file/get_prof_file.php?id='.$adminInfo->id.'"></figure>';
						}
						$adminProf ='';
						if(trim($adminInfo->profile) !== ""){
							$adminProf = '<p class="prof">'.$adminInfo->profile.'</p>';
						}
?>
										<dd class="person_area column">
											<section class="person clear_fix">
												<div class="person_ph clear_fix">
													<?php echo $adminImg; ?>
													<div class="name_area">
														<div class="clear_fix">
															<p class="name"><?php echo htmlspecialchars($adminInfo->name); ?></p>
															<p class="work"><?php echo htmlspecialchars($adminInfo->aff); ?></p>
														</div>
														<?php echo $adminProf; ?>
													</div>
												</div>
											</section>
										</dd>
<?php
					}
?>
<?php
/* アイコンエリア　ここから */
					if($articleInfoCnt['viewCnt'] || $settings['DisplayLike'] || $articleInfoCnt['commentCnt']){
?>
										<dd class="rank_date_area">
											<div class="rank_date_area_inn clear_fix">
<?php
						if($articleInfoCnt['viewCnt']){
?>
												<p class="view"><?php echo $articleInfoCnt['viewCnt']; ?></p>
<?php
						}
						if($articleInfoCnt['empathyCnt']){
?>
												<p class="like"><?php echo $articleInfoCnt['empathyCnt']; ?></p>
<?php
						}
						if($articleInfoCnt['commentCnt']){
?>
												<p class="comment"><?php echo $articleInfoCnt['commentCnt']; ?></p>
<?php
					}
?>
											</div>
										</dd>
<?php
					}
/* アイコンエリア　ここまで */
?>
<?php
					if($settings['DisplayTagLink']){
						$tagStr = '';
						foreach($articleInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList)) {
								$categoryInfo = $categoryInfoList[$categoryId];
								if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId())) {
									$target_str = '';
									$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
									if($categoryGroupfileName == 'contents/article/'){
										$categoryGroupfileName = 'contents/article/';
									}
									if($categoryInfo->auto_link == 0){
										$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?c='.$categoryInfo->id);
									}else if($categoryInfo->auto_link == 1){
										if(count($categoryInfo->contents) == 1){
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'index.php?c='.$categoryInfo->id.'&s='.$categoryInfo->contents[0]);
										}else{
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?c='.$categoryInfo->id);
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
									
									$tagStr .= '<li><a href="'.$link_str.'"'.$target_str.'>'.htmlspecialchars(trim($categoryInfo->shortName)===''?$categoryInfo->name:$categoryInfo->shortName).'</a></li>';
								}
							}
						}
						if(trim($tagStr) !== '') {
?>
										<dd class="tagLinkArea">
											<ul class="tagLink clear_fix"><?php echo $tagStr;?></ul>
										</dd>
<?php
						}
					}
?>
<?php
						if($settings['DisplayLinkBt']){
?>
										<dd class="ListLinkBtArea">
											<p class="BtM"><a href="<?php echo $articleInfoCnt['url']?>"<?php echo $articleInfoCnt['target']?> class="ListLinkBt next"><?php echo Util::dispLang(Language::WORD_00694);/*詳細を見る*/?></a></p>
										</dd>
<?php
					}
?>
									</dl>
								</div>
							</div>
<?php
					$cnt++;
				}
			}
?>
						</section>
					</article>
<?php
		}else if($settings['DisplayTagType'] === 6){
?>
					<article class="tpl-contents-block tpl-contents-block-type06">
						<div class="tpl-flexcolumn<?php echo $settings['DisplayColumnNum'];?> clear_fix">
							<div class="tpl-contents-block-inn sldYblock">
<?php
			if(count($articleInfoList) > 0) {
				foreach($articleInfoList as $articleInfo) {
					$articleInfoCnt = self::_articleInfoCnt($articleInfo, $categoryGroupPath, $add_query, $settings);
?>
								<section class="column article_<?php echo $articleInfo->id?>">
									<div class="tpl-contents-grid-inn gridlayout-type-<?php echo $settings['gridLayoutType'];
									if($settings['DisplayImage']){echo ' gridlayout-hasImage';}?>"<?php
									if(!$settings['gridLayoutType']){echo ' style="grid-template-columns: '.$settings['gridCustom']['columns'].';grid-template-rows: '.$settings['gridCustom']['rows'].';"';}?>>
<?php
					if($settings['DisplayImage']){
?>
										<figure class="image"<?php if(!$settings['gridLayoutType']){echo ' style="grid-area: '.$settings['gridCustom']['image'].';"';}?>>
											<a href="<?php echo $articleInfoCnt['url']?>"<?php echo $articleInfoCnt['target']?>><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_article_file.php?id='.$articleInfo->id.'&type=_m')?>" alt="">
												<?php if($settings['DisplayEffect'] > 0){?>
												<figcaption class="mouseAnimeType<?php echo sprintf('%02d', $settings['DisplayEffect'])?>">
													<section>
														<p class="nextRead"><?php echo Util::dispLang(Language::WORD_00144);/*続きを見る*/?></p>
														<p class="figureCap"><?php 
												  switch($articleInfo->meta_descriptin){
													  case '':
													  	echo Util::emptyStr(mb_substr(strip_tags($articleInfo->body),0,150));
													  break;
													  default :
													    echo Util::emptyStr($articleInfo->meta_descriptin);
												  }?></p>
													</section>
												</figcaption>
												<?php }?>
											</a>
										</figure>
<?php
						if($cnt <= $settings['DisplayLankingMax']) {
?>
										<p class="rankIco"<?php if(!$settings['gridLayoutType']){echo ' style="grid-area: '.$settings['gridCustom']['rankIco'].';"';}?>><?php echo $cnt?></p>
<?php
						}
					}
					if($settings['DisplayCategory']){
						$tagStr = '';
						foreach($articleInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList2)) {
								$categoryInfo = $categoryInfoList2[$categoryId];
								if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId()) && $categoryInfo->parentCategoryId !== -2) {
									$color = ($categoryInfo->color == '')?'':' style="background:'.$categoryInfo->color.'"';
									$tagStr .= '<li><span class="cateIco cateIco'.$categoryInfo->id.'"'.$color.'>'.htmlspecialchars(trim($categoryInfo->shortName)===''?$categoryInfo->name:$categoryInfo->shortName).'</span></li>';
								}
							}
						}
						if(trim($tagStr) !== '') {
?>
										<ul class="cateName clear_fix"<?php if(!$settings['gridLayoutType']){echo ' style="grid-area: '.$settings['gridCustom']['cateName'].';"';}?>><?php echo $tagStr;?></ul>
<?php
						}
					}
?>
<?php
					if($settings['DisplayTitle']){
?>
										<<?php echo $titleTag;?> class="listTitle"<?php if(!$settings['gridLayoutType']){echo ' style="grid-area: '.$settings['gridCustom']['listTitle'].';"';}?>><a href="<?php echo $articleInfoCnt['url']?>"<?php echo $articleInfoCnt['target']?>><?php echo htmlspecialchars($articleInfo->title)?></a></<?php echo $titleTag;?>>
<?php
					}
?>
<?php
					if($settings['DisplayDescription'] && ($articleInfo->meta_descriptin !== "" || $articleInfo->body !== "")){
?>
										<div class="distxt"<?php if(!$settings['gridLayoutType']){echo ' style="grid-area: '.$settings['gridCustom']['distxt'].';"';}?>><p class="txt"><?php 
											if($articleInfo->meta_descriptin !== ""){
												echo $articleInfo->meta_descriptin;
											}else{
											echo Util::emptyStr(mb_substr(strip_tags($articleInfo->body),0,150));
											}
										?></p></div>
<?php
					}
					if($settings['DisplayPersonInfo']) {
						$adminInfo = $adminData->getInfo($articleInfo->accountId);
						$adminImg ='';
						if($adminInfo->img_name !== ""){
							$adminImg = '<figure><img src="'.SYSTEM_TOP_URL.'core_sys/sys/file/get_prof_file.php?id='.$adminInfo->id.'"></figure>';
						}
						$adminProf ='';
						if(trim($adminInfo->profile) !== ""){
							$adminProf = '<p class="prof">'.$adminInfo->profile.'</p>';
						}
?>
										<div class="person clear_fix"<?php if(!$settings['gridLayoutType']){echo ' style="grid-area: '.$settings['gridCustom']['person'].';"';}?>>
											<div class="person_ph clear_fix">
												<?php echo $adminImg; ?>
												<div class="name_area">
													<div class="clear_fix">
														<p class="name"><?php echo htmlspecialchars($adminInfo->name); ?></p>
														<p class="work"><?php echo htmlspecialchars($adminInfo->aff); ?></p>
													</div>
												</div>
											</div>
											<?php echo $adminProf; ?>
										</div>
<?php
					}
?>
<?php
/* アイコンエリア　ここから */
					if($articleInfoCnt['viewCnt'] || $articleInfoCnt['empathyCnt'] || $articleInfoCnt['commentCnt'] ){
?>
										<div class="rank_area"<?php if(!$settings['gridLayoutType']){echo ' style="grid-area: '.$settings['gridCustom']['rank_area'].';"';}?>>
<?php
						if($articleInfoCnt['viewCnt'] && $articleInfo->link_type == 0){
?>
											<p class="view"><?php echo $articleInfoCnt['viewCnt']; ?></p>
<?php
						}
						if($articleInfoCnt['empathyCnt']){
?>
											<p class="like"><?php echo $articleInfoCnt['empathyCnt']; ?></p>
<?php
						}
						if($articleInfoCnt['commentCnt']){
?>
											<p class="comment"><?php echo $articleInfoCnt['commentCnt']; ?></p>
<?php
						}
?>
										</div>
<?php
					}
?>
<?php
					if($settings['DisplayUpDate']){
?>
										<div class="update_area"<?php if(!$settings['gridLayoutType']){echo ' style="grid-area: '.$settings['gridCustom']['update_area'].';"';}?>>
											<p class="cap"><?php echo htmlspecialchars($articleInfo->openDatetime->toDateString())?></p>
										</div>
<?php
					}
					if($settings['DisplayNewDays']) {
?>
<?php
						if($limitDatetime->toValue() < $articleInfo->openDatetime->toValue()) {
?>
										<div class="new_ico_area"<?php if(!$settings['gridLayoutType']){echo ' style="grid-area: '.$settings['gridCustom']['new_ico_area'].';"';}?>>
											<p class="ico"><span class="IcoBox NewIcBg BgPnc">NEW</span></p>
										</div>
<?php
						}
?>
<?php
					}
/* アイコンエリア　ここまで */
?>
<?php
					if($settings['DisplayTagLink']){
						$tagStr = '';
						foreach($articleInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList)) {
								$categoryInfo = $categoryInfoList[$categoryId];
								if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId())) {
									$target_str = '';
									$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
									if($categoryGroupfileName == 'contents/article/'){
										$categoryGroupfileName = 'contents/article/';
									}
									if($categoryInfo->auto_link == 0){
										$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?c='.$categoryInfo->id);
									}else if($categoryInfo->auto_link == 1){
										if(count($categoryInfo->contents) == 1){
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'index.php?c='.$categoryInfo->id.'&s='.$categoryInfo->contents[0]);
										}else{
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?c='.$categoryInfo->id);
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
									
									$tagStr .= '<li><a href="'.$link_str.'"'.$target_str.'>'.htmlspecialchars(trim($categoryInfo->shortName)===''?$categoryInfo->name:$categoryInfo->shortName).'</a></li>';
								}
							}
						}
						if(trim($tagStr) !== '') {
?>
										<ul class="tagLink clear_fix"<?php if(!$settings['gridLayoutType']){echo ' style="grid-area: '.$settings['gridCustom']['tagLink'].';"';}?>><?php echo $tagStr;?></ul>
<?php
						}
					}
?>
									</div>
								</section>
<?php
					$cnt++;
				}
			}
?>
							</div>
						</div>
					</article>
<?php
		}
	}

	/**
	 * 簡易条件指定のデータを取得し、リスト表示する
	 * @param array $session セッション情報
	 * @param object $settings 簡易条件、表示設定
	 *     CategoryGroupId ：表示する記事が所属するカテゴリグループ番号を指定（0:串刺し）
	 *     CategoryId      ：表示する記事が所属するカテゴリ番号を指定（0:串刺し）
	 *     DisplayTagType  ：デザインを指定（1～2）
	 *     DisplayMax      ：表示最大件数を指定（NULL:全件表示）
	 *     SortType        ：表示順指定（1：登録降順/2：登録昇順/3：公開日が新しい順/4：ランダム/5：表示件数降順）
	 *     ExcludeArticleId:リストから除外する記事ID（0：除外対象無し）
	 *     ※表示設定はHtmlPartsArticle::printList()参照
	 */
	static function printBunnerList($session, $settings) {
		$defaultSettings = Array(
			 'CategoryGroupId' => 0
			,'CategoryId' => 0
			,'DisplayTagType' => 1
			,'DisplayMax' => NULL
			,'SortType' => 1
			,'ExcludeArticleId' => 0
		);
		$settings = array_merge($defaultSettings, $settings);

		require_once dirname(__FILE__).'/../../../../common/inc/data/article.php';
		$articleData = new ArticleData($session->getMemberName());

		$searchInfoList = array();
		$searchInfoList['search_is_auth'] = 1;
		$searchInfoList['search_x_open_contents'] = true;
		$searchInfoList['search_x_ignore_bunner'] = true;
		$searchInfoList['search_x_category_none_tag'] = true;
		if($settings['CategoryGroupId'] > 0) {
			$searchInfoList['search_x_category_group_id'] = $settings['CategoryGroupId'];
		}
		if($settings['CategoryId'] > 0) {
			$searchInfoList['search_x_category_id'] = $settings['CategoryId'];
		}
		if($settings['ExcludeArticleId'] > 0) {
			$searchInfoList['search_not_id'] = $settings['ExcludeArticleId'];
		}
		
		/* 閲覧権限、閲覧制限指定（条件を満たさない物を除外） */
		require dirname(__FILE__).'/../parts/search_article_permission.php';
		
		$articleInfoList = $articleData->getInfoList($searchInfoList, $settings['SortType'], 0, $settings['DisplayMax']);

		self::_printBunnerList($articleInfoList, $session, $settings);
	}

	/**
	 * リスト表示する
	 * @param array $articleInfoList 表示する記事一覧
	 * @param object $session セッション情報
	 * @param array $settings 表示設定
	 *      CategoryGroupId   ：詳細ページへのリンクとして利用するURLのカテゴリグループ（0:一番若いIDを自動検索）
	 *      DisplayTagType    ：デザインを指定（1～2）
	 */
	static function _printBunnerList($articleInfoList, $session, $settings) {
		$add_query = "";
		if(isset($_GET['c']) && is_numeric($_GET['c'])){
			$add_query = "&c=".intval($_GET['c']);
		}
		
		require_once dirname(__FILE__).'/../../../../common/inc/data/admin.php';
		$adminData = new AdminData($session->getMemberName());
		
		$defaultSettings = Array(
			 'CategoryGroupId' => 0
		);
		$settings = array_merge($defaultSettings, $settings);

		require_once dirname(__FILE__).'/../../../../common/inc/data/category.php';
		$categoryData = new CategoryData($session->getMemberName());
		$searchInfoList = array();
		$searchInfoList['search_parent_category_id'] = -2;
		$searchInfoList['search_is_disp'] = true;

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

		$categoryInfoList = $categoryData->getInfoList($searchInfoList, 3, 0, 9);

		$categoryGroupPath = self::getCategoryGroupPath($settings['CategoryGroupId']);

		if($settings['DisplayTagType'] === 1){

			if(count($articleInfoList) > 0) {
?>
		<section class="slideDf_area">
			<div class="slideDf_box clear_fix">
<?php
				foreach($articleInfoList as $articleInfo) {
					if($articleInfo->link_type !== 0){
						if($articleInfo->link_type == 3){
							$auto_level = '';
							$target = ' target="_blank"';
							$url = htmlspecialchars(SYSTEM_TOP_URL.'pdf/web/con_viewer.php?s='.$articleInfo->urlKey.'&file=./readfile.php?i='.$articleInfo->site_url);
						}else{
							$auto_level = ($articleInfo->link_type == 1)?SYSTEM_TOP_URL:'';
							$target = ($articleInfo->link_window_type == 0)?'':' target="_blank"';
							$url = htmlspecialchars($auto_level.$articleInfo->site_url);
						}
					}else{
						$target = '';
						$url = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupPath.'index.php?s='.$articleInfo->urlKey.$add_query);
					}

					?>
				<div class="slideDfInn link_box">
					<p class="ph" style="background-image:url(<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_article_file.php?id='.$articleInfo->id.'&type=_m')?>)"><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_article_file.php?id='.$articleInfo->id.'&type=')?>" alt=""></p>
					<h2><?php echo htmlspecialchars($articleInfo->title)?></h2>
					<p class="cap"><?php echo htmlspecialchars($articleInfo->openDatetime->toDateString())?></p>
					<a href="<?php echo $url?>"<?php echo $target?>>リンク</a>
				</div>
<?php
				}
?>
			</div>
		</section>
<?php
			}
		}else if($settings['DisplayTagType'] === 2){

			if(count($articleInfoList) > 0) {
?>
		<section class="slideDfN_area">
			<div class="slideDfN_box clear_fix">
<?php
				foreach($articleInfoList as $articleInfo) {
					if($articleInfo->link_type !== 0){
						if($articleInfo->link_type == 3){
							$auto_level = '';
							$target = ' target="_blank"';
							$url = htmlspecialchars(SYSTEM_TOP_URL.'pdf/web/con_viewer.php?s='.$articleInfo->urlKey.'&file=./readfile.php?i='.$articleInfo->site_url);
						}else{
							$auto_level = ($articleInfo->link_type == 1)?SYSTEM_TOP_URL:'';
							$target = ($articleInfo->link_window_type == 0)?'':' target="_blank"';
							$url = htmlspecialchars($auto_level.$articleInfo->site_url);
						}
					}else{
						$target = '';
						$url = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupPath.'index.php?s='.$articleInfo->urlKey.$add_query);
					}

?>
				<div><a href="<?php echo $url?>"<?php echo $target?>><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_article_file.php?id='.$articleInfo->id.'&type=')?>" alt=""></a></div>
<?php
				}
?>
			</div>
		</section>
<?php
			}
		}
	}

	/**
	 * カテゴリグループの「公開側対象ファイル」を取得する。
	 * @param integer $categoryGroupId カテゴリグループID
	 * @return string 「公開側対象ファイル」（指定カテゴリグループIDが無い、または公開側対象ファイル未設定時は「contents/article/」）
	 */
	static function getCategoryGroupPath($categoryGroupId) {
		require_once dirname(__FILE__).'/../../../../common/inc/data/category_group.php';
		$categoryGroupData = new CategoryGroupData('');
		$categoryGroupInfo = $categoryGroupData->getInfo($categoryGroupId);

		if(trim($categoryGroupInfo->fileName)==='') {
			return 'contents/article/';
		} else {
			return $categoryGroupInfo->fileName;
		}
	}

	static function getIsUseTag($categoryGroupId) {
		require_once dirname(__FILE__).'/../../../../common/inc/data/category_group.php';
		$categoryGroupData = new CategoryGroupData('');
		$categoryGroupInfo = $categoryGroupData->getInfo($categoryGroupId);
		return $categoryGroupInfo->isUseTag;
	}

	/**
	 * サブナビを表示する
	 * @param object $session セッション
	 * @param integer $categoryGroupId 絞り込むカテゴリグループID（0:絞込無し）
	 * @param boolean $isMulti true:多階層 false:1階層
	 */
	static function printSubNavi($session, $categoryGroupId, $isMulti=true, $categoryId=0, $isFixed=true) {
		require_once dirname(__FILE__).'/../../../../common/inc/data/category_group.php';
		$categoryGroupData = new CategoryGroupData('');
		$categoryGroupInfo = $categoryGroupData->getInfo($categoryGroupId);
		
		require_once dirname(__FILE__).'/../../../../common/inc/data/category.php';
		$categoryData = new CategoryData('');
		$categoryTreeInfoList = $categoryData->getTreeList($categoryGroupId);
		$categoryIdList = array();
		
		if($categoryId > 0){
			$categoryInfo = $categoryData->getInfo($categoryId);
			if($categoryInfo->id > 0){
				if($isFixed){
					/* categoryIdを第1階層に固定 */
					if($categoryInfo->parentCategoryId == -1){/* categoryIdが第1階層の場合はそのまま通す */
					}else{/* categoryIdが第1階層でない場合は、親IDをcategoryIdに代入 */
						$categoryInfoParent = $categoryData->getInfo($categoryInfo->parentCategoryId);
						if($categoryInfoParent->id > 0 && $categoryInfoParent->parentCategoryId == -1){
							$categoryId = $categoryInfoParent->id;
						}else{
							$categoryId = 0;
						}
					}
					/* 第2階層にカテゴリが存在しない場合は非表示 */
				}else{
					/* 指定カテゴリの下に子供がいるか？ */
					$categoryTreeInfoListSub = $categoryData->getTreeList($categoryGroupId);
					$TreeInfoListSub = self::_getArrayList($categoryTreeInfoListSub[-1]->subInfoList, $categoryInfo->id);
					if(is_array($TreeInfoListSub) || count($TreeInfoListSub) === 0) {
						/* いない場合は、親IDをcategoryIdに代入 */
						$categoryId = $categoryInfo->parentCategoryId;
					}else{
						/* いる場合はそのまま通す */
					}
				}
			}
		}
		
		if($categoryId > 0){
			$TreeInfoList = self::_getArrayList($categoryTreeInfoList[-1]->subInfoList, $categoryId);
		}else{
			$TreeInfoList = $categoryTreeInfoList[-1]->subInfoList;
		}
		if(is_array($TreeInfoList) && count($TreeInfoList) === 0) {
			return;
		}
		
		if($isMulti){
?>
		<div class="widget">
<?php
			if($categoryGroupInfo->id > 0) {
?>
			<h2><?php echo htmlspecialchars($categoryGroupInfo->name)?></h2>
<?php
			}
		}
?>
			<nav>
				<ul><?php self::_printSubNaviArticleCategory($session, $categoryGroupId, $isMulti, $categoryId); ?></ul>
			</nav>
<?php
		if($isMulti){
?>
		</div>
<?php
		}
	}
	/**
	 * ビュー数/コメント数/いいね数/URL表示制御
	 * @param $articleInfo 表示する記事情報
	 * @param $categoryGroupPath カテゴリグループのリンクURL
	 * @param $add_query url付加パラメータ
	 * @param array $settings 表示設定
	 */
	static function _articleInfoCnt($articleInfo, $categoryGroupPath, $add_query, $settings) {
		$info = array();
		$info['viewCnt'] = 0;
		$info['empathyCnt'] = 0;
		$info['commentCnt'] = 0;
		$info['url'] = 0;
		$info['target'] = '';
		
		if($settings['DisplayView'] && $articleInfo->viewCnt > 0 && $articleInfo->link_type == 0){
			$info['viewCnt'] = $articleInfo->viewCnt;
		}
		if($settings['DisplayLike'] && $articleInfo->empathy_cnt > 0 && $articleInfo->link_type == 0){
			$info['empathyCnt'] = $articleInfo->empathy_cnt;
		}
		if($settings['DisplayComment'] && $articleInfo->comment_cnt > 0 && $articleInfo->link_type == 0){
			$info['commentCnt'] = $articleInfo->comment_cnt;
		}
		if($articleInfo->link_type !== 0){
			if($articleInfo->link_type == 3){
				$auto_level = '';
				$info['target'] = '3';//' target="_blank"';
				$info['url'] = htmlspecialchars(SYSTEM_TOP_URL.'pdf/web/con_viewer.php?s='.$articleInfo->urlKey.'&file=./readfile.php?i='.$articleInfo->site_url);
			}else{
				$auto_level = ($articleInfo->link_type == 1)?SYSTEM_TOP_URL:'';
				$info['target'] = ($articleInfo->link_window_type == 0)?'':' target="_blank"';
				$info['url'] = htmlspecialchars($auto_level.$articleInfo->site_url);
			}
		}else{
			$info['target'] = '';
			$info['url'] = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupPath.'index.php?s='.$articleInfo->urlKey.$add_query);
		}
		return $info;
	}
	private static function _printSubNaviGetArticleCategoryTag($session, $categoryTreeInfoList, $categoryInfoList, $level, $categoryGroupId, $isMulti) {
		$classList = array('fir', 'sec', 'the', 'for');
		$tagStr = '';
		if(count($categoryTreeInfoList) > 0) {
			foreach($categoryTreeInfoList as $categoryTreeInfo) {
				if(array_key_exists($categoryTreeInfo->id, $categoryInfoList)){
					$categoryInfo = $categoryInfoList[$categoryTreeInfo->id];
					if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId())) {
						if(count($classList) <= $level) {
							$level = count($classList)-1;
						}
						$target_str = '';
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
						if(isset($_GET['c'])){
							$c = intval($_GET['c']);
						}else if(isset($_POST['c'])){
							$c = intval($_POST['c']);
						}else{
							$c = 0;
						}
						if($c == $categoryInfo->id){
							$ctr = ' crt';
						}else{
							$ctr = '';
						}
						//$tagStr .= '<li class="contentsNav_'.$classList[$level].'">';
						$tagStr .= '<li class="ctno'.$categoryInfo->id.$ctr.'">';
						$tagStr .= '<a href="'.$link_str.'"'.$target_str.' class="ctno'.$categoryInfo->id.$ctr.'">'.htmlspecialchars(($categoryTreeInfo->shortName !== "")?$categoryTreeInfo->shortName:$categoryTreeInfo->name).'</a>';
						if($isMulti){
							$subTagStr = self::_printSubNaviGetArticleCategoryTag($session, $categoryTreeInfo->subInfoList, $categoryInfoList, $level+1, $categoryGroupId, $isMulti);
							if($subTagStr !== '') {
								$tagStr .= '<ul class="children">'.$subTagStr.'</ul>';
							}
						}
						$tagStr .= '</li>';
					}
				}
			}
		}
		return $tagStr;
	}
	private static function _printSubNaviGetSubCategoryIdList($categoryTreeInfoList, $categoryId) {
		$categoryIdList = array();
		if(count($categoryTreeInfoList) > 0) {
			foreach($categoryTreeInfoList as $categoryTreeInfo) {
				if($categoryId == 0){
					$categoryIdList[$categoryTreeInfo->id] = $categoryTreeInfo->id;
					$categoryIdList += self::_printSubNaviGetSubCategoryIdList($categoryTreeInfo->subInfoList, 0);
				}else if($categoryTreeInfo->id == $categoryId){
					$categoryIdList += self::_printSubNaviGetSubCategoryIdList($categoryTreeInfo->subInfoList, 0);
				}else{
					$categoryIdList += self::_printSubNaviGetSubCategoryIdList($categoryTreeInfo->subInfoList, $categoryId);
				}
			}
		}
		return $categoryIdList;
	}
	private static function _getArrayList($List, $categoryId) {
		if($categoryId == 0){
			return  $List;
		}else if(is_array($List) && count($List) > 0) {
			foreach($List as $TreeInfo) {
				if($TreeInfo->id == $categoryId){
					return  $TreeInfo->subInfoList;
				}else{
					$tmpList = self::_getArrayList($TreeInfo->subInfoList, $categoryId);
					if(is_array($tmpList) && count($tmpList) > 0){
						return $tmpList;
					}
				}
			}
		}else{
			return array();
		}
	}
	private static function _printSubNaviArticleCategory($session, $categoryGroupId, $isMulti, $categoryId) {
		require_once dirname(__FILE__).'/../../../../common/inc/data/category.php';
		$categoryData = new CategoryData('');
		$categoryTreeInfoList = $categoryData->getTreeList($categoryGroupId);
		$categoryIdList = array();
		if($categoryId > 0){
			$TreeInfoList = self::_getArrayList($categoryTreeInfoList[-1]->subInfoList, $categoryId);
			foreach($categoryTreeInfoList[-1]->subInfoList as $categoryTreeInfo) {
				if($categoryTreeInfo->id == $categoryId){
					$categoryIdList += self::_printSubNaviGetSubCategoryIdList($categoryTreeInfo->subInfoList, 0);
				}else{
					$categoryIdList += self::_printSubNaviGetSubCategoryIdList($categoryTreeInfo->subInfoList, $categoryId);
				}
			}
		}else{
			$TreeInfoList = $categoryTreeInfoList[-1]->subInfoList;
			foreach($TreeInfoList as $categoryTreeInfo) {
				$categoryIdList[$categoryTreeInfo->id] = $categoryTreeInfo->id;
				$categoryIdList += self::_printSubNaviGetSubCategoryIdList($categoryTreeInfo->subInfoList, 0);
			}
		}
		if(count($categoryIdList) === 0) {
			return;
		}

		$searchInfoList = array();
		$searchInfoList['search_id'] = $categoryIdList;

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

		$categoryInfoList = $categoryData->getInfoList($searchInfoList, 1);
		echo self::_printSubNaviGetArticleCategoryTag($session, $TreeInfoList, $categoryInfoList, 0, $categoryGroupId, $isMulti);
	}
}
?>