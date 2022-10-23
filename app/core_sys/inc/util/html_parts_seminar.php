<?php
class HtmlPartsSeminar {
	/**
	 * 簡易条件指定のデータを取得し、リスト表示する
	 * @param array $session セッション情報
	 * @param object $settings 簡易条件、表示設定
	 *     CategoryGroupId ：表示する記事が所属するカテゴリグループ番号を指定（0:串刺し）
	 *     CategoryId      ：表示する記事が所属するカテゴリ番号を指定（0:串刺し）
	 *     DisplayMax      ：表示最大件数を指定（NULL:全件表示）
	 *     SortType        ：表示順指定（1：登録降順/2：登録昇順/3：公開日が新しい順/4：ランダム/5：表示件数降順）
	 *     ExcludeSeminarId:リストから除外する記事ID（0：除外対象無し）
	 *     ※表示設定はHtmlPartsSeminar::printList()参照
	 */
	static function printSimpleConditionList($session, $settings) {
		$defaultSettings = Array(
			 'CategoryGroupId' => 0
			,'CategoryId' => 0
			,'DisplayMax' => NULL
			,'SortType' => 1
			,'ExcludeSeminarId' => 0
		);
		$settings = array_merge($defaultSettings, $settings);

		require_once dirname(__FILE__).'/../../../../common/inc/data/seminar.php';
		$seminarData = new SeminarData($session->getMemberName());
		$searchInfoList = array();
		$searchInfoList['search_x_is_open'] = true;
		$searchInfoList['search_x_ignore_all'] = true;

		$systemData = new SystemData('');
		$systemInfo = $systemData->getInfo();

		if($systemInfo->permission_seminar == 1){
			if(!$session->isLogin()){
				$permission_type = 1;
				$searchInfoList['search_x_permission'] = array('type'=>$permission_type);
			}else{
				$PurchasedList = $session->getMemberPurchased();
				if(count($PurchasedList) > 0){
					$permission_type = 3;
					$permission_item = implode(',', $PurchasedList);
					$searchInfoList['search_x_permission'] = array('type'=>$permission_type,'item'=>$permission_item);
				}else{
					$permission_type = 2;
					$searchInfoList['search_x_permission'] = array('type'=>$permission_type);
				}
			}
		}

		$searchInfoList['search_x_top_new_list'] = true;
		if($settings['CategoryGroupId'] > 0) {
			$searchInfoList['search_x_category_group_id'] = $settings['CategoryGroupId'];
		}
		$firstDateStr = date('Y-m-d', mktime(0, 0, 0, intval(date('n')), intval(date('d')), intval(date('Y'))));
		$searchInfoList['search_x_first_the_date_str'] = $firstDateStr;
		if($settings['CategoryId'] > 0) {
			$searchInfoList['search_x_category_id'] = $settings['CategoryId'];
		}
		if($settings['ExcludeSeminarId'] > 0) {
			$searchInfoList['search_not_id'] = $settings['ExcludeSeminarId'];
		}
		$seminarInfoList = $seminarData->getInfoList($searchInfoList, $settings['SortType'], 0, $settings['DisplayMax']);

		self::printList($seminarInfoList, $session, $settings);
	}
	/**
	 * リスト表示する
	 * @param array $seminarInfoList 表示する記事一覧
	 * @param object $session セッション情報
	 * @param array $settings 表示設定
	 *      CategoryGroupId   ：詳細ページへのリンクとして利用するURLのカテゴリグループ（0:一番若いIDを自動検索）
	 *      DisplayTagType    ：デザインを指定（1～4）
	 *      DisplayColumnNum  ：1行の表示上限数の指定(1～6)　※DisplayTagType 1,2,4
	 *      DisplayTitle      ：メインタイトルを表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      DisplayImage      ：画像を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,4
	 *      DisplayEffect     ：ロールオーバー時のアニメーション指定(0:なし)　※DisplayTagType 1,2,4
	 *      DisplayDescription：ディスクリプションを表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,4
	 *      DisplayUpDate     ：更新日を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      DisplayTagLink    ：タグリンクを表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      DisplayNewDays    ：NEWを表示する期間（登録日時から指定日数、0:表示なし）　※DisplayTagType 1,2,3,4,5
	 *      DisplayLankingMax ：順位を表示する最大（0:表示なし）　※DisplayTagType 1,2,4
	 *      DisplayPersonInfo ：公開投稿者表示設定（false:非表示 true:表示）　※DisplayTagType 1,2,3,4,5
	 *      DisplayView       ：ページビュー表示設定（false:非表示 true:表示）　※DisplayTagType 1,2,3,4,5
	 *      CategoryId        ：グローバルナビのカテゴリ番号指定
	 *      DisplayKingaku    ：販売価格を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      DisplayKaisaibi   ：開催日を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      DisplayKaisaibasyo：開催日を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      DisplayKigen      ：申込期限を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      DisplayAki        ：空き状況を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      SeminarCategoryId ：セミナーナビのカテゴリ番号指定
	 *      DisplayLinkBt     ：詳細リンクボタンの表示設定（false:非表示 true:表示）　※DisplayTagType 1,2,3,4,5
	 *      view_count_date_start：ビュー表示時のカウント（開始年月日を設定するとそれ以降全てを抽出）
	 *      view_count_date_end  ：ビュー表示時のカウント（終了年月日を設定するとそれ以前全てを抽出）
	 *      titleTag          ：一覧の記事タイトルのタグ(1-5:h1-h5,6:Pタグ,7:divタグ)　※DisplayTagType 1,2,3,4,5
	 */
	static function printList($seminarInfoList, $session, $settings) {

		require_once dirname(__FILE__).'/../../../../common/inc/data/admin.php';
		$adminData = new AdminData($session->getMemberName());

		$defaultSettings = Array(
			 'CategoryGroupId' => 0
			,'CategoryId' => 0
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
			,'DisplayView' => true
			,'DisplayKingaku' => true
			,'DisplayKaisaibi' => true
			,'DisplayKaisaibasyo' => true
			,'DisplayKigen' => true
			,'DisplayAki' => true
			,'SeminarCategoryId' => 0
			,'DisplayLinkBt' => true
			,'view_count_date_start' => ""
			,'view_count_date_end' => ""
			,'titleTag' => 2
		);
		$settings = array_merge($defaultSettings, $settings);

		require_once dirname(__FILE__).'/../../../../common/inc/data/venue_data.php';
		$VenueData = new VenueData($session->getMemberName());
		$VenueList = $VenueData->getList();

		require_once dirname(__FILE__).'/../../../../common/inc/data/seminar_category.php';
		$categoryData = new SeminarCategoryData($session->getMemberName());
		$searchInfoList = array();
		$searchInfoList['search_parent_seminar_category_id'] = -2;
		$searchInfoList['search_is_disp'] = true;
		$categoryInfoList = $categoryData->getInfoList($searchInfoList, 3, 0, 9);

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

		if($settings['DisplayTagType'] === 1){
?>
					<article class="tpl-contents-block tpl-contents-block-type01">
						<div class="tpl-flexcolumn<?php echo $settings['DisplayColumnNum'];?> clear_fix">
							<div class="tpl-contents-block-inn sldYblock">
<?php
			if(count($seminarInfoList) > 0) {
				foreach($seminarInfoList as $seminarInfo) {
					if($seminarInfo->TypeNo == 1){
						if($seminarInfo->venue_id !== 0){
							$placeName = htmlspecialchars($VenueList[$seminarInfo->venue_id]->name);
							$placeName = '<a href="'.$VenueList[$seminarInfo->venue_id]->map.'" target="_blank">'.$placeName.'</a>';
						}else{
							$placeName = Util::dispLang(Language::WORD_00156);/*会場未定*/
						}
					}else{
						$placeName = Util::dispLang(Language::WORD_00157);/*オンライン*/
					}

					$url = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupPath.'?s='.$seminarInfo->urlKey.'&c='.$settings['CategoryId'].'&sc='.$settings['SeminarCategoryId']);
?>
								<section class="column sem_<? echo $seminarInfo->id?>">
									<div class="tpl-contents-block-inn-image">
<?php
					if($settings['DisplayImage']){
?>
										<figure class="image">
											<a href="<?php echo $url?>"><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_seminar_file.php?id='.$seminarInfo->id)?>&type=_m" alt="">
												<figcaption class="mouseAnimeType<?php echo sprintf('%02d', $settings['DisplayEffect'])?>">
													<section>
														<p class="nextRead"><?php echo Util::dispLang(Language::WORD_00144);/*続きを見る*/?></p>
														<p class="figureCap"><?php echo Util::emptyStr($seminarInfo->metaDescription)?></p>
													</section>
												</figcaption>
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
					if($settings['DisplayTitle']){
?>
											<<?php echo $titleTag;?> class="ListMainTitle"><a href="<?php echo $url?>"><?php echo htmlspecialchars($seminarInfo->name)?></a></<?php echo $titleTag;?>>
<?php
					}
					if($settings['DisplayDescription']){
?>
											<div class="distxt"><p class="txt"><?php echo Util::emptyStr($seminarInfo->metaDescription)?></p></div>
<?php
					}
					if($settings['DisplayPersonInfo']) {
						$adminInfo = $adminData->getInfo($seminarInfo->accountId);
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
					if($settings['DisplayView'] || $settings['DisplayUpDate'] || $settings['DisplayNewDays']){
?>
										<div class="rank_date_area">
											<div class="rank_date_area_inn clear_fix">
<?php
						if($settings['DisplayView']){
?>
												<p class="view"><?php echo $seminarInfo->viewCnt; ?></p>
<?php
						}
						if($settings['DisplayUpDate']){
?>
												<p class="cap"><?php echo htmlspecialchars($seminarInfo->openDatetime->toDateString())?></p>
<?php
						}
						if($settings['DisplayNewDays']) {
							if($limitDatetime->toValue() < $seminarInfo->openDatetime->toValue()) {
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
/* 価格エリア　ここから */
					if($settings['DisplayKingaku'] || $settings['DisplayKaisaibi'] || $settings['DisplayKaisaibasyo'] || $settings['DisplayKigen'] || $settings['DisplayAki']){
?>
										<div class="ListSubhDet ListSemDet">
<?php
					if($settings['DisplayKingaku']){
?>
											<dl class="sem_kinagaku clear_fix">
												<dt><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00160);/*販売価格*/?></span></dt>
												<dd><?php
					$amount = $seminarInfo->getCurrentAmount($session->isLogin(), $session->getMemberApplyService());
					if(is_numeric($amount)) {
						if(intval($amount) > 0){
							echo "<span class='kinagakuTxt'>".number_format($amount)."</span>".Util::dispLang(Language::WORD_00161);/* 円（税込み） */
						}else{
							echo Util::dispLang(Language::WORD_00162);/*無料*/
						}
					} else {
						echo '-';
					}
												?></dd>
											</dl>
<?php
					}
					if($settings['DisplayKaisaibi']){
?>
											<dl class="sem_kaisaibi clear_fix">
												<dt><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00158);/*開催日*/?></span></dt>
												<dd><?php
					if($seminarInfo->eventType == 1){
						echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $seminarInfo->theDate->year, $seminarInfo->theDate->month, $seminarInfo->theDate->day));
					}else if($seminarInfo->eventType == 3){
						if(count($seminarInfo->lectureList) > 0){
							$lect = array_shift($seminarInfo->lectureList);
							echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $lect->theDate->year, $lect->theDate->month, $lect->theDate->day));
						}else{
							echo "-";
						}
					}else{
						echo htmlspecialchars(Util::dispLang(Language::WORD_00159));/*常時開催*/
					}
?></dd>
											</dl>
<?php
					}
					if($settings['DisplayKaisaibasyo']){
?>
											<dl class="sem_kaisaibasyo clear_fix">
												<dt><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00163);/*開催場所*/?></span></dt>
												<dd><?php echo $placeName?></dd>
											</dl>
<?php
					}
					if($settings['DisplayKigen']){
?>
											<dl class="sem_kigen clear_fix">
												<dt><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00164);/*申込期間*/?></span></dt>
												<dd><?php
					if($seminarInfo->acceptType == 2){
						echo htmlspecialchars(sprintf('%04d/%02d/%02d', $seminarInfo->acceptEndDatetime->year, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day));
					}else{
						echo htmlspecialchars(Util::dispLang(Language::WORD_00165));/*申込期限なし*/
					}
?></dd>
											</dl>
<?php
					}
					if($settings['DisplayAki']){
?>
											<dl class="sem_aki clear_fix">
												<dt><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00166);/*空き状況*/?></span></dt>
												<dd><?php echo self::getAcceptStatusIconStr2($seminarInfo);?></dd>
											</dl>
<?php
					}
?>
										</div>
<?php
					}
/* 価格エリア　ここまで */
?>
<?php
					if($settings['DisplayTagLink']){
						$tagStr = '';
						foreach($seminarInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList)) {
								$categoryInfo = $categoryInfoList[$categoryId];
								if($categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased())) {
									
									$target_str = '';
									$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
									if($categoryGroupfileName == 'seminar/main/'){
										$categoryGroupfileName = 'seminar/main/';
									}
									if($categoryInfo->auto_link == 0){
										$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?sc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
									}else if($categoryInfo->auto_link == 1){
										if(count($categoryInfo->seminar) == 1){
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'?sc='.$categoryInfo->id.'&s='.$categoryInfo->seminar[0].'&c='.$settings['CategoryId']);
										}else{
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?sc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
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
										<p class="BtM"><a href="<?php echo $url?>" class="ListLinkBt next"><?php echo Util::dispLang(Language::WORD_00694);/*詳細を見る*/?></a></p>
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
			if(count($seminarInfoList) > 0) {
				foreach($seminarInfoList as $seminarInfo) {
					if($seminarInfo->TypeNo == 1){
						if($seminarInfo->venue_id !== 0){
							$placeName = htmlspecialchars($VenueList[$seminarInfo->venue_id]->name);
							$placeName = '<a href="'.$VenueList[$seminarInfo->venue_id]->map.'" target="_blank">'.$placeName.'</a>';
						}else{
							$placeName = Util::dispLang(Language::WORD_00156);/*会場未定*/
						}
					}else{
						$placeName = Util::dispLang(Language::WORD_00157);/*オンライン*/
					}
					$url = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupPath.'?s='.$seminarInfo->urlKey.'&c='.$settings['CategoryId'].'&sc='.$settings['SeminarCategoryId']);

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
											<a href="<?php echo $url?>">
												<img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_seminar_file.php?id='.$seminarInfo->id)?>&type=_m" alt="">
												<figcaption class="mouseAnimeType<?php echo sprintf('%02d', $settings['DisplayEffect'])?>">
													<section>
														<p class="nextRead"><?php echo Util::dispLang(Language::WORD_00144);/*続きを見る*/?></p>
														<p class="figureCap"><?php echo Util::emptyStr($seminarInfo->metaDescription)?></p>
													</section>
												</figcaption>
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

								<section class="column col<?php echo $settings['DisplayColumnNum']-1;?> sp-col<?php echo $settings['DisplayColumnNum']-1;?>-t">
<?php
					if($settings['DisplayTitle']){
?>
									<<?php echo $titleTag;?> class="ListMainTitle"><a href="<?php echo $url?>"><?php echo htmlspecialchars($seminarInfo->name)?></a></<?php echo $titleTag;?>>
<?php
					}
					if($settings['DisplayDescription']){
?>
									<div class="distxt"><p class="txt"><?php echo Util::emptyStr($seminarInfo->metaDescription)?></p></div>
<?php
					}
					if($settings['DisplayPersonInfo']) {
						$adminInfo = $adminData->getInfo($seminarInfo->accountId);
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
					if($settings['DisplayView'] || $settings['DisplayUpDate'] || $settings['DisplayNewDays']){
?>
										<div class="rank_date_area">
											<div class="rank_date_area_inn clear_fix">
<?php
						if($settings['DisplayView']){
?>
												<p class="view"><?php echo $seminarInfo->viewCnt; ?></p>
<?php
						}
						if($settings['DisplayUpDate']){
?>
												<p class="cap"><?php echo htmlspecialchars($seminarInfo->openDatetime->toDateString())?></p>
<?php
						}
						if($settings['DisplayNewDays']) {
							if($limitDatetime->toValue() < $seminarInfo->openDatetime->toValue()) {
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
/* 価格エリア　ここから */
					if($settings['DisplayKingaku'] || $settings['DisplayKaisaibi'] || $settings['DisplayKaisaibasyo'] || $settings['DisplayKigen'] || $settings['DisplayAki']){
?>
									<div class="ListSubhDet ListSemDet">
<?php
					if($settings['DisplayKingaku']){
?>
										<dl class="sem_kinagaku clear_fix">
											<dt><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00160);/*販売価格*/?></span></dt>
											<dd><?php
					$amount = $seminarInfo->getCurrentAmount($session->isLogin(), $session->getMemberApplyService());
					if(is_numeric($amount)) {
						if(intval($amount) > 0){
							echo "<span class='kinagakuTxt'>".number_format($amount)."</span>".Util::dispLang(Language::WORD_00161);/* 円（税込み） */
						}else{
							echo Util::dispLang(Language::WORD_00162);/*無料*/
						}
					} else {
						echo '-';
					}
											?></dd>
										</dl>
<?php
					}
					if($settings['DisplayKaisaibi']){
?>
										<dl class="sem_kaisaibi clear_fix">
											<dt><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00158);/*開催日*/?></span></dt>
											<dd><?php
					if($seminarInfo->eventType == 1){
						echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $seminarInfo->theDate->year, $seminarInfo->theDate->month, $seminarInfo->theDate->day));
					}else if($seminarInfo->eventType == 3){
						if(count($seminarInfo->lectureList) > 0){
							$lect = array_shift($seminarInfo->lectureList);
							echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $lect->theDate->year, $lect->theDate->month, $lect->theDate->day));
						}else{
							echo "-";
						}
					}else{
						echo htmlspecialchars(Util::dispLang(Language::WORD_00159));/*常時開催*/
					}
?></dd>
										</dl>
<?php
					}
					if($settings['DisplayKaisaibasyo']){
?>
										<dl class="sem_kaisaibasyo clear_fix">
											<dt><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00163);/*開催場所*/?></span></dt>
											<dd><?php echo $placeName?></dd>
										</dl>
<?php
					}
					if($settings['DisplayKigen']){
?>
										<dl class="sem_kigen clear_fix">
											<dt><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00164);/*申込期間*/?></span></dt>
											<dd><?php
					if($seminarInfo->acceptType == 2){
						echo htmlspecialchars(sprintf('%04d/%02d/%02d', $seminarInfo->acceptEndDatetime->year, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day));
					}else{
						echo htmlspecialchars(Util::dispLang(Language::WORD_00165));/*申込期限なし*/
					}
?></dd>
										</dl>
<?php
					}
					if($settings['DisplayAki']){
?>
										<dl class="sem_aki clear_fix">
											<dt><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00166);/*空き状況*/?></span></dt>
											<dd><?php echo self::getAcceptStatusIconStr2($seminarInfo);?></dd>
										</dl>
<?php
					}
?>
									</div>
<?php
					}
/* 価格エリア　ここまで */
?>
<?php
					if($settings['DisplayTagLink']){
						$tagStr = '';
						foreach($seminarInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList)) {
								$categoryInfo = $categoryInfoList[$categoryId];
								if($categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased())) {
									$target_str = '';
									$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
									if($categoryGroupfileName == 'seminar/main/'){
										$categoryGroupfileName = 'seminar/main/';
									}
									if($categoryInfo->auto_link == 0){
										$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?sc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
									}else if($categoryInfo->auto_link == 1){
										if(count($categoryInfo->seminar) == 1){
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'?sc='.$categoryInfo->id.'&s='.$categoryInfo->seminar[0].'&c='.$settings['CategoryId']);
										}else{
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?sc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
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
									<p class="BtM"><a href="<?php echo $url?>" class="ListLinkBt next"><?php echo Util::dispLang(Language::WORD_00694);/*詳細を見る*/?></a></p>
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
			if(count($seminarInfoList) > 0) {
				foreach($seminarInfoList as $seminarInfo) {
					if($seminarInfo->TypeNo == 1){
						if($seminarInfo->venue_id !== 0){
							$placeName = htmlspecialchars($VenueList[$seminarInfo->venue_id]->name);
							$placeName = $placeName;
						}else{
							$placeName = Util::dispLang(Language::WORD_00156);/*会場未定*/
						}
					}else{
						$placeName = Util::dispLang(Language::WORD_00157);/*オンライン*/
					}
					$url = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupPath.'?s='.$seminarInfo->urlKey.'&c='.$settings['CategoryId'].'&sc='.$settings['SeminarCategoryId']);

					?>
							<dl class="clmDetail clear_fix">
								<dd class="timeArea">
<?php
					if($settings['DisplayUpDate']) {
?>
								<p class="time"><?php echo htmlspecialchars($seminarInfo->openDatetime->toDateString())?></p>
<?php
					}
?>
<?php
					if($settings['DisplayNewDays']) {
						if($limitDatetime->toValue() < $seminarInfo->acceptStartDatetime->toValue()) {
?>
								<p class="ico"><span class="IcoBox NewIcBg BgPnc">NEW</span></p>
<?php
					}
?>
								</dd>
<?php
					}
?>
								<dd class="title_area">
									<<?php echo $titleTag;?> class="ListMainTitle"><a href="<?php echo $url?>"><?php echo htmlspecialchars($seminarInfo->name)?></a></<?php echo $titleTag;?>>
<?php
					if($settings['DisplayDescription']){
?>
									<p class="txt"><?php echo Util::emptyStr($seminarInfo->metaDescription)?></p>
<?php
					}
?>
								</dd>
<?php
					if($settings['DisplayPersonInfo']) {
						$adminInfo = $adminData->getInfo($seminarInfo->accountId);
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
					if($settings['DisplayView']){
?>
								<dd class="rank_date_area">
									<div class="rank_date_area_inn clear_fix">
<?php
						if($settings['DisplayView']){
?>
										<p class="view"><?php echo $seminarInfo->viewCnt; ?></p>
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
/* 価格エリア　ここから */
					if($settings['DisplayKingaku'] || $settings['DisplayKaisaibi'] || $settings['DisplayKaisaibasyo'] || $settings['DisplayKigen'] || $settings['DisplayAki']){
?>
								<dd class="ListSubhDetTpF ListSemDet">
<?php
					if($settings['DisplayKingaku']){
?>
									<section class="sem_kinagaku clear_fix">
										<p class="SubhDetTi"><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00160);/*販売価格*/?></span></p>
										<p class="SubhDetTxt"><?php
					$amount = $seminarInfo->getCurrentAmount($session->isLogin(), $session->getMemberApplyService());
					if(is_numeric($amount)) {
						if(intval($amount) > 0){
							echo "<span class='kinagakuTxt'>".number_format($amount)."</span>".Util::dispLang(Language::WORD_00161);/* 円（税込み） */
						}else{
							echo Util::dispLang(Language::WORD_00162);/*無料*/
						}
					} else {
						echo '-';
					}
											?></p>
									</section>
<?php
					}
					if($settings['DisplayKaisaibi']){
?>
									<section class="sem_kaisaibi clear_fix">
										<p class="SubhDetTi"><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00158);/*開催日*/?></span></p>
										<p class="SubhDetTxt"><?php
					if($seminarInfo->eventType == 1){
						echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $seminarInfo->theDate->year, $seminarInfo->theDate->month, $seminarInfo->theDate->day));
					}else if($seminarInfo->eventType == 3){
						if(count($seminarInfo->lectureList) > 0){
							$lect = array_shift($seminarInfo->lectureList);
							echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $lect->theDate->year, $lect->theDate->month, $lect->theDate->day));
						}else{
							echo "-";
						}
					}else{
						echo htmlspecialchars(Util::dispLang(Language::WORD_00159));/*常時開催*/
					}
?></p>
									</section>
<?php
					}
					if($settings['DisplayKaisaibasyo']){
?>
									<section class="sem_kaisaibasyo clear_fix">
										<p class="SubhDetTi"><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00163);/*開催場所*/?></span></p>
										<p class="SubhDetTxt"><?php echo $placeName?></p>
									</section>
<?php
					}
					if($settings['DisplayKigen']){
?>
									<section class="sem_kigen clear_fix">
										<p class="SubhDetTi"><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00164);/*申込期間*/?></span></p>
										<p class="SubhDetTxt"><?php
					if($seminarInfo->acceptType == 2){
						echo htmlspecialchars(sprintf('%04d/%02d/%02d', $seminarInfo->acceptEndDatetime->year, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day));
					}else{
						echo htmlspecialchars(Util::dispLang(Language::WORD_00165));/*申込期限なし*/
					}
?></p>
									</section>
<?php
					}
					if($settings['DisplayAki']){
?>
									<section class="sem_aki clear_fix">
										<p class="SubhDetTi"><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00166);/*空き状況*/?></span></p>
										<p class="SubhDetTxt"><?php echo self::getAcceptStatusIconStr2($seminarInfo);?></p>
									</section>
<?php
					}
?>
								</dd>
<?php
					}
/* 価格エリア　ここまで */
?>
<?php
					if($settings['DisplayTagLink']){
						$tagStr = '';
						foreach($seminarInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList)) {
								$categoryInfo = $categoryInfoList[$categoryId];
								if($categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased())) {
									$target_str = '';
									$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
									if($categoryGroupfileName == 'seminar/main/'){
										$categoryGroupfileName = 'seminar/main/';
									}
									if($categoryInfo->auto_link == 0){
										$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?sc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
									}else if($categoryInfo->auto_link == 1){
										if(count($categoryInfo->seminar) == 1){
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'?sc='.$categoryInfo->id.'&s='.$categoryInfo->seminar[0].'&c='.$settings['CategoryId']);
										}else{
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?sc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
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
									<p class="BtM"><a href="<?php echo $url?>" class="ListLinkBt next"><?php echo Util::dispLang(Language::WORD_00694);/*詳細を見る*/?></a></p>
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
			if(count($seminarInfoList) > 0) {
				foreach($seminarInfoList as $seminarInfo) {
					if($seminarInfo->TypeNo == 1){
						if($seminarInfo->venue_id !== 0){
							$placeName = htmlspecialchars($VenueList[$seminarInfo->venue_id]->name);
							$placeName = $placeName;
						}else{
							$placeName = Util::dispLang(Language::WORD_00156);/*会場未定*/
						}
					}else{
						$placeName = Util::dispLang(Language::WORD_00157);/*オンライン*/
					}
					$url = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupPath.'?s='.$seminarInfo->urlKey.'&c='.$settings['CategoryId'].'&sc='.$settings['SeminarCategoryId']);

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
											<img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_seminar_file.php?id='.$seminarInfo->id)?>&type=_m" alt="">
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
					if($settings['DisplayTitle']){
?>
									<<?php echo $titleTag;?> class="ListMainTitle"><?php echo htmlspecialchars($seminarInfo->name)?></<?php echo $titleTag;?>>
<?php
					}
					if($settings['DisplayDescription']){
?>
									<div class="distxt"><p class="txt"><?php echo Util::emptyStr($seminarInfo->metaDescription)?></p></div>
<?php
					}
					if($settings['DisplayPersonInfo']) {
						$adminInfo = $adminData->getInfo($seminarInfo->accountId);
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
					if($settings['DisplayView'] || $settings['DisplayUpDate'] || $settings['DisplayNewDays']){
?>
										<div class="rank_date_area">
											<div class="rank_date_area_inn clear_fix">
<?php
						if($settings['DisplayView']){
?>
												<p class="view"><?php echo $seminarInfo->viewCnt; ?></p>
<?php
						}
						if($settings['DisplayUpDate']){
?>
												<p class="cap"><?php echo htmlspecialchars($seminarInfo->openDatetime->toDateString())?></p>
<?php
						}
						if($settings['DisplayNewDays']) {
							if($limitDatetime->toValue() < $seminarInfo->openDatetime->toValue()) {
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
/* 価格エリア　ここから */
					if($settings['DisplayKingaku'] || $settings['DisplayKaisaibi'] || $settings['DisplayKaisaibasyo'] || $settings['DisplayKigen'] || $settings['DisplayAki']){
?>
									<div class="ListSubhDet ListSemDet">
<?php
					if($settings['DisplayKingaku']){
?>
										<dl class="sem_kinagaku clear_fix">
											<dt><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00160);/*販売価格*/?></span></dt>
											<dd><?php
					$amount = $seminarInfo->getCurrentAmount($session->isLogin(), $session->getMemberApplyService());
					if(is_numeric($amount)) {
						if(intval($amount) > 0){
							echo "<span class='kinagakuTxt'>".number_format($amount)."</span>".Util::dispLang(Language::WORD_00161);/* 円（税込み） */
						}else{
							echo Util::dispLang(Language::WORD_00162);/*無料*/
						}
					} else {
						echo '-';
					}
											?></dd>
										</dl>
<?php
					}
					if($settings['DisplayKaisaibi']){
?>
										<dl class="sem_kaisaibi clear_fix">
											<dt><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00158);/*開催日*/?></span></dt>
											<dd><?php
					if($seminarInfo->eventType == 1){
						echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $seminarInfo->theDate->year, $seminarInfo->theDate->month, $seminarInfo->theDate->day));
					}else if($seminarInfo->eventType == 3){
						if(count($seminarInfo->lectureList) > 0){
							$lect = array_shift($seminarInfo->lectureList);
							echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $lect->theDate->year, $lect->theDate->month, $lect->theDate->day));
						}else{
							echo "-";
						}
					}else{
						echo htmlspecialchars(Util::dispLang(Language::WORD_00159));/*常時開催*/
					}
?></dd>
										</dl>
<?php
					}
					if($settings['DisplayKaisaibasyo']){
?>
										<dl class="sem_kaisaibasyo clear_fix">
											<dt><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00163);/*開催場所*/?></span></dt>
											<dd><?php echo $placeName?></dd>
										</dl>
<?php
					}
					if($settings['DisplayKigen']){
?>
										<dl class="sem_kigen clear_fix">
											<dt><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00164);/*申込期間*/?></span></dt>
											<dd><?php
					if($seminarInfo->acceptType == 2){
						echo htmlspecialchars(sprintf('%04d/%02d/%02d', $seminarInfo->acceptEndDatetime->year, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day));
					}else{
						echo htmlspecialchars(Util::dispLang(Language::WORD_00165));/*申込期限なし*/
					}
?></dd>
										</dl>
<?php
					}
					if($settings['DisplayAki']){
?>
										<dl class="sem_aki clear_fix">
											<dt><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00166);/*空き状況*/?></span></dt>
											<dd><?php echo self::getAcceptStatusIconStr2($seminarInfo);?></dd>
										</dl>
<?php
					}
?>
									</div>
<?php
					}
/* 価格エリア　ここまで */
?>
<?php
					if($settings['DisplayLinkBt']){
?>
											<p class="BtM"><span class="ListLinkBt next"><?php echo Util::dispLang(Language::WORD_00694);/*詳細を見る*/?></span></p>
<?php
					}
?>
								</section>
								<a href="<?php echo $url?>">LINK</a>
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
			if(count($seminarInfoList) > 0) {
				foreach($seminarInfoList as $seminarInfo) {
					if($seminarInfo->TypeNo == 1){
						if($seminarInfo->venue_id !== 0){
							$placeName = htmlspecialchars($VenueList[$seminarInfo->venue_id]->name);
							$placeName = $placeName;
						}else{
							$placeName = Util::dispLang(Language::WORD_00156);/*会場未定*/
						}
					}else{
						$placeName = Util::dispLang(Language::WORD_00157);/*オンライン*/
					}
					$url = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupPath.'?s='.$seminarInfo->urlKey.'&c='.$settings['CategoryId'].'&sc='.$settings['SeminarCategoryId']);

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
										<p class="time"><?php echo htmlspecialchars($seminarInfo->openDatetime->toDateString())?></p>
<?php
					}
					if($settings['DisplayNewDays']) {
						if($limitDatetime->toValue() < $seminarInfo->acceptStartDatetime->toValue()) {
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
								</div>
<?php
					}
?>
								<div class="clmDetailLi">
									<dl class="clear_fix">
										<dd class="title_area">
											<<?php echo $titleTag;?> class="ListMainTitle"><a href="<?php echo $url?>"><?php echo htmlspecialchars($seminarInfo->name)?></a></<?php echo $titleTag;?>>
<?php
					if($settings['DisplayDescription']){
?>
											<p class="txt"><?php echo Util::emptyStr($seminarInfo->metaDescription)?></p>
<?php
					}
?>
										</dd>
<?php
					if($settings['DisplayPersonInfo']) {
						$adminInfo = $adminData->getInfo($seminarInfo->accountId);
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
					if($settings['DisplayView']){
?>
										<dd class="rank_date_area">
											<div class="rank_date_area_inn clear_fix">
<?php
						if($settings['DisplayView']){
?>
											<p class="view"><?php echo $seminarInfo->viewCnt; ?></p>
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
/* 価格エリア　ここから */
					if($settings['DisplayKingaku'] || $settings['DisplayKaisaibi'] || $settings['DisplayKaisaibasyo'] || $settings['DisplayKigen'] || $settings['DisplayAki']){
?>
										<dd class="ListSubhDetTpF ListSemDet">
<?php
					if($settings['DisplayKingaku']){
?>
											<section class="sem_kinagaku clear_fix">
												<p class="SubhDetTi"><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00160);/*販売価格*/?></span></p>
												<p class="SubhDetTxt"><?php
					$amount = $seminarInfo->getCurrentAmount($session->isLogin(), $session->getMemberApplyService());
					if(is_numeric($amount)) {
						if(intval($amount) > 0){
							echo "<span class='kinagakuTxt'>".number_format($amount)."</span>".Util::dispLang(Language::WORD_00161);/* 円（税込み） */
						}else{
							echo Util::dispLang(Language::WORD_00162);/*無料*/
						}
					} else {
						echo '-';
					}
												?></p>
											</section>
<?php
					}
					if($settings['DisplayKaisaibi']){
?>
											<section class="sem_kaisaibi clear_fix">
												<p class="SubhDetTi"><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00158);/*開催日*/?></span></p>
												<p class="SubhDetTxt"><?php
					if($seminarInfo->eventType == 1){
						echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $seminarInfo->theDate->year, $seminarInfo->theDate->month, $seminarInfo->theDate->day));
					}else if($seminarInfo->eventType == 3){
						if(count($seminarInfo->lectureList) > 0){
							$lect = array_shift($seminarInfo->lectureList);
							echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $lect->theDate->year, $lect->theDate->month, $lect->theDate->day));
						}else{
							echo "-";
						}
					}else{
						echo htmlspecialchars(Util::dispLang(Language::WORD_00159));/*常時開催*/
					}
?></p>
											</section>
<?php
					}
					if($settings['DisplayKaisaibasyo']){
?>
											<section class="sem_kaisaibasyo clear_fix">
												<p class="SubhDetTi"><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00163);/*開催場所*/?></span></p>
												<p class="SubhDetTxt"><?php echo $placeName?></p>
											</section>
<?php
					}
					if($settings['DisplayKigen']){
?>
											<section class="sem_kigen clear_fix">
												<p class="SubhDetTi"><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00164);/*申込期間*/?></span></p>
												<p class="SubhDetTxt"><?php
					if($seminarInfo->acceptType == 2){
						echo htmlspecialchars(sprintf('%04d/%02d/%02d', $seminarInfo->acceptEndDatetime->year, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day));
					}else{
						echo htmlspecialchars(Util::dispLang(Language::WORD_00165));/*申込期限なし*/
					}
?></p>
											</section>
<?php
					}
					if($settings['DisplayAki']){
?>
											<section class="sem_aki clear_fix">
												<p class="SubhDetTi"><span class="SubhIco SemIco"><?php echo Util::dispLang(Language::WORD_00166);/*空き状況*/?></span></p>
												<p class="SubhDetTxt"><?php echo self::getAcceptStatusIconStr2($seminarInfo);?></p>
											</section>
<?php
					}
?>
										</dd>
<?php
					}
/* 価格エリア　ここまで */
?>
<?php
					if($settings['DisplayTagLink']){
						$tagStr = '';
						foreach($seminarInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList)) {
								$categoryInfo = $categoryInfoList[$categoryId];
								if($categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased())) {
									$target_str = '';
									$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
									if($categoryGroupfileName == 'seminar/main/'){
										$categoryGroupfileName = 'seminar/main/';
									}
									if($categoryInfo->auto_link == 0){
										$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?sc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
									}else if($categoryInfo->auto_link == 1){
										if(count($categoryInfo->seminar) == 1){
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'?sc='.$categoryInfo->id.'&s='.$categoryInfo->seminar[0].'&c='.$settings['CategoryId']);
										}else{
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?sc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
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
											<p class="BtM"><a href="<?php echo $url?>" class="ListLinkBt next"><?php echo Util::dispLang(Language::WORD_00694);/*詳細を見る*/?></a></p>
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
		}
	}
	/**
	 * カテゴリグループの「公開側対象ファイル」を取得する。
	 * @param integer $categoryGroupId カテゴリグループID
	 * @return string 「公開側対象ファイル」（指定カテゴリグループIDが無い、または公開側対象ファイル未設定時は「seminar/main/」）
	 */
	static function getCategoryGroupPath($categoryGroupId) {
		require_once dirname(__FILE__).'/../../../../common/inc/data/seminar_category_group.php';
		$categoryGroupData = new SeminarCategoryGroupData('');
		$categoryGroupInfo = $categoryGroupData->getInfo($categoryGroupId);

		if(trim($categoryGroupInfo->fileName)==='') {
			return 'seminar/main/';
		} else {
			return $categoryGroupInfo->fileName;
		}
	}

	static function getIsUseTag($categoryGroupId) {
		require_once dirname(__FILE__).'/../../../../common/inc/data/seminar_category_group.php';
		$categoryGroupData = new SeminarCategoryGroupData('');
		$categoryGroupInfo = $categoryGroupData->getInfo($categoryGroupId);
		return $categoryGroupInfo->isUseTag;
	}

	/**
	 * サブナビを表示する
	 * @param object $session セッション
	 * @param integer $categoryGroupId 絞り込むカテゴリグループID（0:絞込無し）
	 * @param boolean $isMulti true:多階層 false:1階層
	 */
	static function printSubNavi($session, $categoryGroupId, $categoryId, $isMulti=true) {
		require_once dirname(__FILE__).'/../../../../common/inc/data/seminar_category_group.php';
		$categoryGroupData = new SeminarCategoryGroupData('');
		$categoryGroupInfo = $categoryGroupData->getInfo($categoryGroupId);
		
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
				<ul>
<?php
		self::_printSubNaviSeminarCategory($session, $categoryGroupId, $categoryId, $isMulti);
?>				</ul>
			</nav>
<?php
		if($isMulti){
?>
		</div>
<?php
		}
	}

	private static function _printSubNaviGetSeminarCategoryTag($session, $categoryTreeInfoList, $categoryInfoList, $level, $categoryId, $isMulti) {
		$classList = array('fir', 'sec', 'the');
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
					if($categoryGroupfileName == 'seminar/main/'){
						$categoryGroupfileName = 'seminar/main/';
					}
					if($categoryInfo->auto_link == 0){
						$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'list.php?sc='.$categoryInfo->id.'&c='.$categoryId);
					}else if($categoryInfo->auto_link == 1){
						if(count($categoryInfo->seminar) == 1){
							$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'index.php?sc='.$categoryInfo->id.'&s='.$categoryInfo->seminar[0].'&c='.$categoryId);
						}else{
							$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'list.php?sc='.$categoryInfo->id.'&c='.$categoryId);
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
					if(isset($_GET['sc'])){
						$sc = intval($_GET['sc']);
					}else if(isset($_POST['sc'])){
						$sc = intval($_POST['sc']);
					}else{
						$sc = 0;
					}
					if($sc == $categoryInfo->id){
						$ctr = ' crt';
					}else{
						$ctr = '';
					}
					//$tagStr .= '<li class="contentsNav_'.$classList[$level].'">';
					$tagStr .= '<li class="ctno'.$categoryInfo->id.$ctr.'">';
					$tagStr .= '<a href="'.$link_str.'"'.$target_str.' class="ctno'.$categoryInfo->id.$ctr.'">'.htmlspecialchars($categoryTreeInfo->name).'</a>';
					if($isMulti){
						$subTagStr = self::_printSubNaviGetSeminarCategoryTag($session, $categoryTreeInfo->subInfoList, $categoryInfoList, $level+1, $categoryId, $isMulti);
						if($subTagStr !== '') {
							$tagStr .= '<ul class="children">'.$subTagStr.'</ul>';
						}
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
	private static function _printSubNaviSeminarCategory($session, $categoryGroupId, $categoryId, $isMulti) {
		require_once dirname(__FILE__).'/../../../../common/inc/data/seminar_category.php';
		$categoryData = new SeminarCategoryData('');
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
		echo self::_printSubNaviGetSeminarCategoryTag($session, $categoryTreeInfoList[-1]->subInfoList, $categoryInfoList, 0, $categoryId, $isMulti);
	}
	/**
	 * セミナーの出欠状況アイコン文字列取得
	 * @param unknown $seminarApplicantInfo
	 * @return string
	 */
	static function getApplicantAttendanceIconStr($seminarApplicantInfo) {
		if($seminarApplicantInfo->isAttend == 1) {
			return '-';
		} else if($seminarApplicantInfo->isAttend == 2) {
			return Util::dispLang(Language::WORD_00172);/*出席*/
		} else {
			return Util::dispLang(Language::WORD_00173);/*欠席*/
		}
	}
	/**
	 * セミナーの結果状況アイコン文字列取得
	 * @param unknown $seminarApplicantInfo
	 * @return string
	 */
	static function getApplicantResultIconStr($seminarApplicantInfo) {
		if($seminarApplicantInfo->isTestRes == 1) {
			return '-';
		} else if($seminarApplicantInfo->isTestRes == 2) {
			return '〇';
		} else {
			return '×';
		}
	}
	/**
	 * セミナーの申込状況アイコン文字列取得
	 * @param unknown $seminarApplicantInfo
	 * @return string
	 */
	static function getApplicantStatusIconStr($seminarApplicantInfo, $iconClass='NrIcBg') {
		if($seminarApplicantInfo->status == 1) {
			return '<span class="IcoBox '.$iconClass.' BgBlu">'.Util::dispLang(Language::WORD_00174).'</span>';/* 申込中 */
		} else if($seminarApplicantInfo->status == 2) {
			return '<span class="IcoBox '.$iconClass.' BgPnc">'.Util::dispLang(Language::WORD_00169).'</span>';/* キャンセル待ち */
		} else {
			return '<span class="IcoBox '.$iconClass.' BgGry">'.Util::dispLang(Language::WORD_00175).'</span>';/* キャンセル */
		}
	}
	/**
	 * セミナーの受付状況アイコン文字列取得
	 * @param unknown $seminarInfo
	 * @return string
	 */
	static function getAcceptStatusIconStr($seminarInfo, $iconClass='NrIcBg') {
		if($seminarInfo->isAccept && $seminarInfo->isOpen){
			$rest = max($seminarInfo->capacity-$seminarInfo->applicant, 0);
			//if($rest > 0)$rest = max($seminarInfo->web_capacity-$seminarInfo->applicant_web, 0);
			
			if(
				($seminarInfo->acceptType == 1
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				)
				|| ($seminarInfo->acceptType == 2
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				&& mktime($seminarInfo->acceptEndDatetime->hour, $seminarInfo->acceptEndDatetime->minute, 0, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day, $seminarInfo->acceptEndDatetime->year) >= time()
				)
				|| $seminarInfo->acceptType == 3
			){
				if($rest > 5) {
					return '<span class="IcoBox '.$iconClass.' BgBlu">'.Util::dispLang(Language::WORD_00167).'</span>';/* 空きあり */
				} else if($rest > 0) {
					return '<span class="IcoBox '.$iconClass.' BgPnc">'.Util::dispLang(Language::WORD_00168).'</span>';/* あとわずか */
				} else if($seminarInfo->cancel_to_wait === 1) {
					return '<span class="IcoBox '.$iconClass.' BgGry">'.Util::dispLang(Language::WORD_00169).'</span>';/* キャンセル待ち */
				} else {
					return '<span class="IcoBox '.$iconClass.' BgGry">'.Util::dispLang(Language::WORD_00170).'</span>';/* 満席 */
				}
			}else{
				return '<span class="IcoBox '.$iconClass.' BgGry">'.Util::dispLang(Language::WORD_00171).'</span>';/* 受付終了 */
			}
		}else{
			return '<span class="IcoBox '.$iconClass.' BgGry">'.Util::dispLang(Language::WORD_00171).'</span>';/* 受付終了 */
		}
	}
	static function getAcceptStatusIconStr2($seminarInfo) {
		if($seminarInfo->isAccept && $seminarInfo->isOpen){
			$rest = max($seminarInfo->capacity-$seminarInfo->applicant, 0);
			//if($rest > 0)$rest = max($seminarInfo->web_capacity-$seminarInfo->applicant_web, 0);
			
			if(
				($seminarInfo->acceptType == 1
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				)
				|| ($seminarInfo->acceptType == 2
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				&& mktime($seminarInfo->acceptEndDatetime->hour, $seminarInfo->acceptEndDatetime->minute, 0, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day, $seminarInfo->acceptEndDatetime->year) >= time()
				)
				|| $seminarInfo->acceptType == 3
			){
				if($rest > 5) {
					return Util::dispLang(Language::WORD_00167);/* 空きあり */
				} else if($rest > 0) {
					return Util::dispLang(Language::WORD_00168);/* あとわずか */
				} else if($seminarInfo->cancel_to_wait === 1) {
					return Util::dispLang(Language::WORD_00169);/* キャンセル待ち */
				} else {
					return Util::dispLang(Language::WORD_00170);/* 満席 */
				}
			}else{
				return Util::dispLang(Language::WORD_00171);/* 受付終了 */
			}
		}else{
			return Util::dispLang(Language::WORD_00171);/* 受付終了 */
		}
	}
	static function getAcceptStatus($seminarInfo) {
		if($seminarInfo->isAccept && $seminarInfo->isOpen){
			$rest = max($seminarInfo->capacity-$seminarInfo->applicant, 0);
			//if($rest > 0)$rest = max($seminarInfo->web_capacity-$seminarInfo->applicant_web, 0);
			
			if(
				($seminarInfo->acceptType == 1
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				)
				|| ($seminarInfo->acceptType == 2
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				&& mktime($seminarInfo->acceptEndDatetime->hour, $seminarInfo->acceptEndDatetime->minute, 0, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day, $seminarInfo->acceptEndDatetime->year) >= time()
				)
				|| $seminarInfo->acceptType == 3
			){
				if($rest > 5) {
					return true;
				} else if($rest > 0) {
					return true;
				} else if($seminarInfo->cancel_to_wait === 1) {
					return true;
				} else {
					return false;
				}
			}else{
				return false;
			}
		}else{
				return false;
		}
	}
}
?>