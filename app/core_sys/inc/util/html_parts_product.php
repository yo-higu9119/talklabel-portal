<?php
class HtmlPartsProduct {
	/**
	 * 簡易条件指定のデータを取得し、リスト表示する
	 * @param array $session セッション情報
	 * @param object $settings 簡易条件、表示設定
	 *     CategoryGroupId ：表示する記事が所属するカテゴリグループ番号を指定（0:串刺し）
	 *     CategoryId      ：表示する記事が所属するカテゴリ番号を指定（0:串刺し）
	 *     DisplayMax      ：表示最大件数を指定（NULL:全件表示）
	 *     SortType        ：表示順指定（1：登録降順/2：登録昇順/3：公開日が新しい順/4：ランダム/5：表示件数降順）
	 *     ExcludeProductId:リストから除外する記事ID（0：除外対象無し）
	 *     ※表示設定はHtmlPartsProduct::printList()参照
	 */
	static function printSimpleConditionList($session, $settings) {
		$defaultSettings = Array(
			 'CategoryGroupId' => 0
			,'CategoryId' => 0
			,'DisplayMax' => NULL
			,'SortType' => 1
			,'ExcludeProductId' => 0
		);
		$settings = array_merge($defaultSettings, $settings);

		require_once dirname(__FILE__).'/../../../../common/inc/data/product.php';
		$productData = new ProductData($session->getMemberName());

		$searchInfoList = array();
		$searchInfoList['search_x_is_open'] = true;
		$searchInfoList['search_x_top_new_list'] = true;
		if($settings['CategoryGroupId'] > 0) {
			$searchInfoList['search_x_category_group_id'] = $settings['CategoryGroupId'];
		}
		if($settings['CategoryId'] > 0) {
			$searchInfoList['search_x_category_id'] = $settings['CategoryId'];
		}
		if($settings['ExcludeProductId'] > 0) {
			$searchInfoList['search_not_id'] = $settings['ExcludeProductId'];
		}
		$productInfoList = $productData->getInfoList($searchInfoList, $settings['SortType'], 0, $settings['DisplayMax']);

		self::printList($productInfoList, $session, $settings);
	}
	/**
	 * リスト表示する
	 * @param array $productInfoList 表示する記事一覧
	 * @param object $session セッション情報
	 * @param array $settings 表示設定
	 *      CategoryGroupId   ：詳細ページへのリンクとして利用するURLのカテゴリグループ（0:一番若いIDを自動検索）
	 *      DisplayTagType    ：デザインを指定（1～4）
	 *      DisplayColumnNum  ：1行の表示上限数の指定(1～6)　※DisplayTagType 1,2,4
	 *      DisplayTitle      ：メインタイトルを表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      DisplayImage      ：画像を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,4
	 *      DisplayEffect     ：ロールオーバー時のアニメーション指定(0:なし)　※DisplayTagType 1,2,4
	 *      DisplayDescription：ディスクリプションを表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,4
	 *      DisplayUpDate     ：更新日を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType1,2,3,4,5
	 *      DisplayTagLink    ：タグリンクを表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType1,2,3,4,5
	 *      DisplayNewDays    ：NEWを表示する期間（登録日時から指定日数、0:表示なし）　※DisplayTagType1,2,3,4,5
	 *      DisplayLankingMax ：順位を表示する最大（0:表示なし）　※DisplayTagType 1,2,4
	 *      DisplayCategory   ：所属カテゴリリスト表示設定（false:非表示 true:表示）　※DisplayTagType 1,2,3,4,5
	 *      CategoryId        ：グローバルナビのカテゴリ番号指定
	 *      DisplayView       ：ページビュー表示設定（false:非表示 true:表示）　※DisplayTagType 1,2,3,4,5
	 *      DisplayLike       ：いいね数表示設定（false:非表示 true:表示）　※DisplayTagType 1,2,3,4,5
	 *      DisplayComment    ：コメント数表示設定（false:非表示 true:表示）　※DisplayTagType 1,2,3,4,5
	 *      DisplayKingaku    ：販売価格を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      DisplayHanbaibi   ：販売期間を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      DisplayHanbaiMth  ：販売方法を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      DisplayZaiko      ：在庫を表示するかしないか指定(表示：true 非表示：false)　※DisplayTagType 1,2,3,4,5
	 *      ProductCategoryId ：商品ナビのカテゴリ番号指定
	 *      DisplayLinkBt     ：詳細リンクボタンの表示設定（false:非表示 true:表示）　※DisplayTagType 1,2,3,4,5
	 *      view_count_date_start：ビュー表示時のカウント（開始年月日を設定するとそれ以降全てを抽出）
	 *      view_count_date_end  ：ビュー表示時のカウント（終了年月日を設定するとそれ以前全てを抽出）
	 *      titleTag          ：一覧の記事タイトルのタグ(1-5:h1-h5,6:Pタグ,7:divタグ)　※DisplayTagType 1,2,3,4,5
	 */
	static function printList($productInfoList, $session, $settings) {

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
			,'DisplayCategory' => true
			,'CategoryId' => 0
			,'DisplayView' => true
			,'DisplayLike' => true
			,'DisplayComment' => true
			,'DisplayKingaku' => true
			,'DisplayHanbaibi' => true
			,'DisplayHanbaiMth' => true
			,'DisplayZaiko' => true
			,'ProductCategoryId' => 0
			,'DisplayLinkBt' => true
			,'view_count_date_start' => ""
			,'view_count_date_end' => ""
			,'titleTag' => 2
		);
		$settings = array_merge($defaultSettings, $settings);

		require_once dirname(__FILE__).'/../../../../common/inc/data/venue_data.php';
		$VenueData = new VenueData($session->getMemberName());
		$VenueList = $VenueData->getList();

		require_once dirname(__FILE__).'/../../../../common/inc/data/product_category.php';
		$categoryData = new ProductCategoryData($session->getMemberName());
		$searchInfoList = array();
		$searchInfoList['search_parent_product_category_id'] = -2;
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
			if(count($productInfoList) > 0) {
				foreach($productInfoList as $productInfo) {
					if($productInfo->TypeNo == 1){
						$placeName = Util::dispLang(Language::WORD_00380);/*配送販売*/
					}else{
						$placeName = Util::dispLang(Language::WORD_00381);/*オンライン販売*/
					}

					$url = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupPath.'?s='.$productInfo->urlKey.'&c='.$settings['CategoryId'].'&pc='.$settings['ProductCategoryId']);
?>
								<section class="column prd_<? echo $productInfo->id?>">
									<div class="tpl-contents-block-inn-image">
<?php
					if($settings['DisplayImage']){
?>
										<figure class="image">
											<a href="<?php echo $url?>"><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_product_file.php?id='.$productInfo->id)?>&type=_m" alt="">
												<figcaption class="mouseAnimeType<?php echo sprintf('%02d', $settings['DisplayEffect'])?>">
													<section>
														<p class="nextRead"><?php echo Util::dispLang(Language::WORD_00144);/*続きを見る*/?></p>
														<p class="figureCap"><?php echo Util::emptyStr($productInfo->metaDescription)?></p>
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
											<<?php echo $titleTag;?> class="ListMainTitle"><a href="<?php echo $url?>"><?php echo htmlspecialchars($productInfo->name)?></a></<?php echo $titleTag;?>>
<?php
					}
					if($settings['DisplayDescription']){
?>
											<div class="distxt"><p class="txt"><?php echo Util::emptyStr($productInfo->metaDescription)?></p></div>
<?php
					}
?>
										</div>
<?php
/* アイコンエリア　ここから */
					if($settings['DisplayView'] || $settings['DisplayLike'] || $settings['DisplayComment'] || $settings['DisplayUpDate'] || $settings['DisplayNewDays']){
?>
										<div class="rank_date_area">
											<div class="rank_date_area_inn clear_fix">
<?php
						if($settings['DisplayView']){
?>
												<p class="view"><?php echo $productInfo->viewCnt; ?></p>
<?php
						}
						if($settings['DisplayUpDate']){
?>
												<p class="cap"><?php echo htmlspecialchars($productInfo->openDatetime->toDateString())?></p>
<?php
						}
						if($settings['DisplayNewDays']) {
							if($limitDatetime->toValue() < $productInfo->openDatetime->toValue()) {
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
					if($settings['DisplayKingaku'] || $settings['DisplayHanbaibi'] || $settings['DisplayHanbaiMth'] || $settings['DisplayZaiko']){
?>

										<div class="ListSubhDet ListPrdDet">
<?php
					if($settings['DisplayKingaku']){
?>
											<dl class="prd_kinagaku clear_fix">
												<dt><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00160);/*販売価格*/?></span></dt>
												<dd><?php
					$amount = $productInfo->getCurrentAmount($session->isLogin(), $session->getMemberApplyService());
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
					if($settings['DisplayHanbaibi']){
?>
											<dl class="prd_hanbaibi clear_fix">
												<dt><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00382);/*販売期間*/?></span></dt>
												<dd><?php
					if($productInfo->eventType == 1){
						echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $productInfo->theDate->year, $productInfo->theDate->month, $productInfo->theDate->day));
					}else if($productInfo->eventType == 3){
						if(count($productInfo->lectureList) > 0){
							$lect = array_shift($productInfo->lectureList);
							echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $lect->theDate->year, $lect->theDate->month, $lect->theDate->day));
						}else{
							echo "-";
						}
					}else{
						echo htmlspecialchars(Util::dispLang(Language::WORD_00383));/*常時販売*/
					}
?></dd>
											</dl>
<?php
					}
					if($settings['DisplayHanbaiMth']){
?>
											<dl class="prd_hanbaiMth clear_fix">
												<dt><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00384);/*販売方法*/?></span></dt>
												<dd><?php echo $placeName?></dd>
											</dl>
<?php
					}
					if($settings['DisplayZaiko']){
?>
											<dl class="prd_aki clear_fix">
												<dt><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00385);/*在庫*/?></span></dt>
												<dd><?php echo self::getAcceptStatusIconStr2($productInfo);?></dd>
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
						foreach($productInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList)) {
								$categoryInfo = $categoryInfoList[$categoryId];
								if($categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased())) {
									
									$target_str = '';
									$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
									if($categoryGroupfileName == 'product/main/'){
										$categoryGroupfileName = 'product/main/';
									}
									if($categoryInfo->auto_link == 0){
										$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?pc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
									}else if($categoryInfo->auto_link == 1){
										if(count($categoryInfo->product) == 1){
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'index.php?pc='.$categoryInfo->id.'&s='.$categoryInfo->product[0].'&c='.$settings['CategoryId']);
										}else{
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?pc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
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
			if(count($productInfoList) > 0) {
				foreach($productInfoList as $productInfo) {
					if($productInfo->TypeNo == 1){
						$placeName = Util::dispLang(Language::WORD_00380);/*配送販売*/
					}else{
						$placeName = Util::dispLang(Language::WORD_00381);/*オンライン販売*/
					}
					$url = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupPath.'?s='.$productInfo->urlKey.'&c='.$settings['CategoryId'].'&pc='.$settings['ProductCategoryId']);

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
												<img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_product_file.php?id='.$productInfo->id)?>&type=_m" alt="">
												<figcaption class="mouseAnimeType<?php echo sprintf('%02d', $settings['DisplayEffect'])?>">
													<section>
														<p class="nextRead"><?php echo Util::dispLang(Language::WORD_00144);/*続きを見る*/?></p>
														<p class="figureCap"><?php echo Util::emptyStr($productInfo->metaDescription)?></p>
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
									<<?php echo $titleTag;?> class="ListMainTitle"><a href="<?php echo $url?>"><?php echo htmlspecialchars($productInfo->name)?></a></<?php echo $titleTag;?>>
<?php
					}
					if($settings['DisplayDescription']){
?>
									<div class="distxt"><p class="txt"><?php echo Util::emptyStr($productInfo->metaDescription)?></p></div>
<?php
					}
?>
<?php
/* アイコンエリア　ここから */
					if($settings['DisplayView'] || $settings['DisplayLike'] || $settings['DisplayComment'] || $settings['DisplayUpDate'] || $settings['DisplayNewDays']){
?>
									<div class="rank_date_area">
										<div class="rank_date_area_inn clear_fix">
<?php
					if($settings['DisplayView']){
?>
											<p class="view"><?php echo $productInfo->viewCnt; ?></p>
<?php
					}
					if($settings['DisplayUpDate']){
?>
											<p class="cap"><?php echo htmlspecialchars($productInfo->openDatetime->toDateString())?></p>
<?php
					}
					if($settings['DisplayNewDays']) {
						if($limitDatetime->toValue() < $productInfo->openDatetime->toValue()) {
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
					if($settings['DisplayKingaku'] || $settings['DisplayHanbaibi'] || $settings['DisplayHanbaiMth'] || $settings['DisplayZaiko']){
?>
									<div class="ListSubhDet ListPrdDet">
<?php
					if($settings['DisplayKingaku']){
?>
										<dl class="prd_kinagaku clear_fix">
											<dt><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00160);/*販売価格*/?></span></dt>
											<dd><?php
					$amount = $productInfo->getCurrentAmount($session->isLogin(), $session->getMemberApplyService());
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
					if($settings['DisplayHanbaibi']){
?>
										<dl class="prd_hanbaibi clear_fix">
											<dt><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00382);/*販売期間*/?></span></dt>
											<dd><?php
					if($productInfo->eventType == 1){
						echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $productInfo->theDate->year, $productInfo->theDate->month, $productInfo->theDate->day));
					}else if($productInfo->eventType == 3){
						if(count($productInfo->lectureList) > 0){
							$lect = array_shift($productInfo->lectureList);
							echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $lect->theDate->year, $lect->theDate->month, $lect->theDate->day));
						}else{
							echo "-";
						}
					}else{
						echo htmlspecialchars(Util::dispLang(Language::WORD_00383));/*常時販売*/
					}
?></dd>
										</dl>
<?php
					}
					if($settings['DisplayHanbaiMth']){
?>
										<dl class="prd_hanbaiMth clear_fix">
											<dt><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00384);/*販売方法*/?></span></dt>
											<dd><?php echo $placeName?></dd>
										</dl>
<?php
					}
					if($settings['DisplayZaiko']){
?>
										<dl class="prd_aki clear_fix">
											<dt><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00385);/*在庫*/?></span></dt>
											<dd><?php echo self::getAcceptStatusIconStr2($productInfo);?></dd>
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
						foreach($productInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList)) {
								$categoryInfo = $categoryInfoList[$categoryId];
								if($categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased())) {
									
									$target_str = '';
									$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
									if($categoryGroupfileName == 'product/main/'){
										$categoryGroupfileName = 'product/main/';
									}
									if($categoryInfo->auto_link == 0){
										$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?pc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
									}else if($categoryInfo->auto_link == 1){
										if(count($categoryInfo->product) == 1){
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'index.php?pc='.$categoryInfo->id.'&s='.$categoryInfo->product[0].'&c='.$settings['CategoryId']);
										}else{
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?pc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
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
			if(count($productInfoList) > 0) {
				foreach($productInfoList as $productInfo) {
					if($productInfo->TypeNo == 1){
						$placeName = Util::dispLang(Language::WORD_00380);/*配送販売*/
					}else{
						$placeName = Util::dispLang(Language::WORD_00381);/*オンライン販売*/
					}

					$url = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupPath.'?s='.$productInfo->urlKey.'&c='.$settings['CategoryId'].'&pc='.$settings['ProductCategoryId']);
?>
							<dl class="clmDetail clear_fix">
								<dd class="timeArea">
<?php
					if($settings['DisplayUpDate']) {
?>
								<p class="time"><?php echo htmlspecialchars($productInfo->openDatetime->toDateString())?></p>
<?php
					}
?>
<?php
					if($settings['DisplayNewDays']) {
						if($limitDatetime->toValue() < $productInfo->acceptStartDatetime->toValue()) {
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
									<<?php echo $titleTag;?> class="ListMainTitle"><a href="<?php echo $url?>"><?php echo htmlspecialchars($productInfo->name)?></a></<?php echo $titleTag;?>>
<?php
					if($settings['DisplayDescription']){
?>
									<p class="txt"><?php echo Util::emptyStr($productInfo->metaDescription)?></p>
<?php
					}
?>
								</dd>
<?php
/* アイコンエリア　ここから */
					if($settings['DisplayView']){
?>
								<dd class="rank_date_area">
									<div class="rank_date_area_inn clear_fix">
<?php
						if($settings['DisplayView']){
?>
												<p class="view"><?php echo $productInfo->viewCnt; ?></p>
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
					if($settings['DisplayKingaku'] || $settings['DisplayHanbaibi'] || $settings['DisplayHanbaiMth'] || $settings['DisplayZaiko']){
?>
								<dd class="ListSubhDetTpF ListPrdDet">
<?php
					if($settings['DisplayKingaku']){
?>
									<section class="prd_kinagaku clear_fix">
										<p class="SubhDetTi"><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00160);/*販売価格*/?></span></p>
										<p class="SubhDetTxt"><?php
					$amount = $productInfo->getCurrentAmount($session->isLogin(), $session->getMemberApplyService());
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
					if($settings['DisplayHanbaibi']){
?>
									<section class="prd_hanbaibi clear_fix">
										<p class="SubhDetTi"><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00382);/*販売期間*/?></span></p>
										<p class="SubhDetTxt"><?php
					if($productInfo->eventType == 1){
						echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $productInfo->theDate->year, $productInfo->theDate->month, $productInfo->theDate->day));
					}else if($productInfo->eventType == 3){
						if(count($productInfo->lectureList) > 0){
							$lect = array_shift($productInfo->lectureList);
							echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $lect->theDate->year, $lect->theDate->month, $lect->theDate->day));
						}else{
							echo "-";
						}
					}else{
						echo htmlspecialchars(Util::dispLang(Language::WORD_00383));/*常時販売*/
					}
?></p>
									</section>
<?php
					}
					if($settings['DisplayHanbaiMth']){
?>
									<section class="prd_hanbaiMth clear_fix">
										<p class="SubhDetTi"><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00384);/*販売方法*/?></span></p>
										<p class="SubhDetTxt"><?php echo $placeName?></p>
									</section>
<?php
					}
					if($settings['DisplayZaiko']){
?>
									<section class="prd_aki clear_fix">
										<p class="SubhDetTi"><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00385);/*在庫*/?></span></p>
										<p class="SubhDetTxt"><?php echo self::getAcceptStatusIconStr2($productInfo);?></p>
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
						foreach($productInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList)) {
								$categoryInfo = $categoryInfoList[$categoryId];
								if($categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased())) {
									
									$target_str = '';
									$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
									if($categoryGroupfileName == 'product/main/'){
										$categoryGroupfileName = 'product/main/';
									}
									if($categoryInfo->auto_link == 0){
										$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?pc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
									}else if($categoryInfo->auto_link == 1){
										if(count($categoryInfo->product) == 1){
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'index.php?pc='.$categoryInfo->id.'&s='.$categoryInfo->product[0].'&c='.$settings['CategoryId']);
										}else{
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?pc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
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
			if(count($productInfoList) > 0) {
				foreach($productInfoList as $productInfo) {
					if($productInfo->TypeNo == 1){
						$placeName = Util::dispLang(Language::WORD_00380);/*配送販売*/
					}else{
						$placeName = Util::dispLang(Language::WORD_00381);/*オンライン販売*/
					}
					$url = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupPath.'?s='.$productInfo->urlKey.'&c='.$settings['CategoryId'].'&pc='.$settings['ProductCategoryId']);

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
											<img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_product_file.php?id='.$productInfo->id)?>&type=_m" alt="">
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
									<<?php echo $titleTag;?> class="ListMainTitle"><?php echo htmlspecialchars($productInfo->name)?></<?php echo $titleTag;?>>
<?php
					}
					if($settings['DisplayDescription']){
?>
									<div class="distxt"><p class="txt"><?php echo Util::emptyStr($productInfo->metaDescription)?></p></div>
<?php
					}
?>
<?php
/* アイコンエリア　ここから */
					if($settings['DisplayView'] || $settings['DisplayLike'] || $settings['DisplayComment'] || $settings['DisplayUpDate'] || $settings['DisplayNewDays']){
?>
									<div class="rank_date_area">
										<div class="rank_date_area_inn clear_fix">
<?php
					if($settings['DisplayView']){
?>
											<p class="view"><?php echo $productInfo->viewCnt; ?></p>
<?php
					}
					if($settings['DisplayUpDate']){
?>
											<p class="cap"><?php echo htmlspecialchars($productInfo->openDatetime->toDateString())?></p>
<?php
					}
					if($settings['DisplayNewDays']) {
						if($limitDatetime->toValue() < $productInfo->openDatetime->toValue()) {
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
					if($settings['DisplayKingaku'] || $settings['DisplayHanbaibi'] || $settings['DisplayHanbaiMth'] || $settings['DisplayZaiko']){
?>
									<div class="ListSubhDet ListPrdDet">
<?php
					if($settings['DisplayKingaku']){
?>
										<dl class="prd_kinagaku clear_fix">
											<dt><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00160);/*販売価格*/?></span></dt>
											<dd><?php
					$amount = $productInfo->getCurrentAmount($session->isLogin(), $session->getMemberApplyService());
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
					if($settings['DisplayHanbaibi']){
?>
										<dl class="prd_hanbaibi clear_fix">
											<dt><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00382);/*販売期間*/?></span></dt>
											<dd><?php
					if($productInfo->eventType == 1){
						echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $productInfo->theDate->year, $productInfo->theDate->month, $productInfo->theDate->day));
					}else if($productInfo->eventType == 3){
						if(count($productInfo->lectureList) > 0){
							$lect = array_shift($productInfo->lectureList);
							echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $lect->theDate->year, $lect->theDate->month, $lect->theDate->day));
						}else{
							echo "-";
						}
					}else{
						echo htmlspecialchars(Util::dispLang(Language::WORD_00383));/*常時販売*/
					}
?></dd>
										</dl>
<?php
					}
					if($settings['DisplayHanbaiMth']){
?>
										<dl class="prd_hanbaiMth clear_fix">
											<dt><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00384);/*販売方法*/?></span></dt>
											<dd><?php echo $placeName?></dd>
										</dl>
<?php
					}
					if($settings['DisplayZaiko']){
?>
										<dl class="prd_aki clear_fix">
											<dt><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00385);/*在庫*/?></span></dt>
											<dd><?php echo self::getAcceptStatusIconStr2($productInfo);?></dd>
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
			if(count($productInfoList) > 0) {
				foreach($productInfoList as $productInfo) {
					if($productInfo->TypeNo == 1){
						$placeName = Util::dispLang(Language::WORD_00380);/*配送販売*/
					}else{
						$placeName = Util::dispLang(Language::WORD_00381);/*オンライン販売*/
					}

					$url = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupPath.'?s='.$productInfo->urlKey.'&c='.$settings['CategoryId'].'&pc='.$settings['ProductCategoryId']);
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
										<p class="time"><?php echo htmlspecialchars($productInfo->openDatetime->toDateString())?></p>
<?php
					}
					if($settings['DisplayNewDays']) {
						if($limitDatetime->toValue() < $productInfo->acceptStartDatetime->toValue()) {
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
											<<?php echo $titleTag;?> class="ListMainTitle"><a href="<?php echo $url?>"><?php echo htmlspecialchars($productInfo->name)?></a></<?php echo $titleTag;?>>
<?php
					if($settings['DisplayDescription']){
?>
											<p class="txt"><?php echo Util::emptyStr($productInfo->metaDescription)?></p>
<?php
					}
?>
										</dd>
<?php
/* アイコンエリア　ここから */
					if($settings['DisplayView']){
?>
										<dd class="rank_date_area">
											<div class="rank_date_area_inn clear_fix">
<?php
						if($settings['DisplayView']){
?>
												<p class="view"><?php echo $productInfo->viewCnt; ?></p>
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
					if($settings['DisplayKingaku'] || $settings['DisplayHanbaibi'] || $settings['DisplayHanbaiMth'] || $settings['DisplayZaiko']){
?>
										<dd class="ListSubhDetTpF ListPrdDet">
<?php
					if($settings['DisplayKingaku']){
?>
											<section class="prd_kinagaku clear_fix">
												<p class="SubhDetTi"><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00160);/*販売価格*/?></span></p>
												<p class="SubhDetTxt"><?php
					$amount = $productInfo->getCurrentAmount($session->isLogin(), $session->getMemberApplyService());
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
					if($settings['DisplayHanbaibi']){
?>
											<section class="prd_hanbaibi clear_fix">
												<p class="SubhDetTi"><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00382);/*販売期間*/?></span></p>
												<p class="SubhDetTxt"><?php
					if($productInfo->eventType == 1){
						echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $productInfo->theDate->year, $productInfo->theDate->month, $productInfo->theDate->day));
					}else if($productInfo->eventType == 3){
						if(count($productInfo->lectureList) > 0){
							$lect = array_shift($productInfo->lectureList);
							echo htmlspecialchars(sprintf('%04d年%02d月%02d日', $lect->theDate->year, $lect->theDate->month, $lect->theDate->day));
						}else{
							echo "-";
						}
					}else{
						echo htmlspecialchars(Util::dispLang(Language::WORD_00383));/*常時販売*/
					}
?></p>
											</section>
<?php
					}
					if($settings['DisplayHanbaiMth']){
?>
											<section class="prd_hanbaiMth clear_fix">
												<p class="SubhDetTi"><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00384);/*販売方法*/?></span></p>
												<p class="SubhDetTxt"><?php echo $placeName?></p>
											</section>
<?php
					}
					if($settings['DisplayZaiko']){
?>
											<section class="prd_aki clear_fix">
												<p class="SubhDetTi"><span class="SubhIco PrdIco"><?php echo Util::dispLang(Language::WORD_00385);/*在庫*/?></span></p>
												<p class="SubhDetTxt"><?php echo self::getAcceptStatusIconStr2($productInfo);?></p>
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
						foreach($productInfo->categoryList as $categoryId) {
							if(array_key_exists($categoryId, $categoryInfoList)) {
								$categoryInfo = $categoryInfoList[$categoryId];
								if($categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased())) {
									
									$target_str = '';
									$categoryGroupfileName = $categoryInfo->categoryGroupfileName;
									if($categoryGroupfileName == 'product/main/'){
										$categoryGroupfileName = 'product/main/';
									}
									if($categoryInfo->auto_link == 0){
										$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?pc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
									}else if($categoryInfo->auto_link == 1){
										if(count($categoryInfo->product) == 1){
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'index.php?pc='.$categoryInfo->id.'&s='.$categoryInfo->product[0].'&c='.$settings['CategoryId']);
										}else{
											$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'tag_list.php?pc='.$categoryInfo->id.'&c='.$settings['CategoryId']);
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
	 * @return string 「公開側対象ファイル」（指定カテゴリグループIDが無い、または公開側対象ファイル未設定時は「product/main/」）
	 */
	static function getCategoryGroupPath($categoryGroupId) {
		require_once dirname(__FILE__).'/../../../../common/inc/data/product_category_group.php';
		$categoryGroupData = new ProductCategoryGroupData('');
		$categoryGroupInfo = $categoryGroupData->getInfo($categoryGroupId);

		if(trim($categoryGroupInfo->fileName)==='') {
			return 'product/main/';
		} else {
			return $categoryGroupInfo->fileName;
		}
	}

	static function getIsUseTag($categoryGroupId) {
		require_once dirname(__FILE__).'/../../../../common/inc/data/product_category_group.php';
		$categoryGroupData = new ProductCategoryGroupData('');
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
		require_once dirname(__FILE__).'/../../../../common/inc/data/product_category_group.php';
		$categoryGroupData = new ProductCategoryGroupData('');
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
				<ul><?php self::_printSubNaviProductCategory($session, $categoryGroupId, $categoryId, $isMulti); ?></ul>
			</nav>
<?php
		if($isMulti){
?>
		</div>
<?php
		}
	}

	private static function _printSubNaviGetProductCategoryTag($session, $categoryTreeInfoList, $categoryInfoList, $level, $categoryId, $isMulti) {
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
					if($categoryGroupfileName == 'product/main/'){
						$categoryGroupfileName = 'product/main/';
					}
					if($categoryInfo->auto_link == 0){
						$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'list.php?pc='.$categoryInfo->id.'&c='.$categoryId);
					}else if($categoryInfo->auto_link == 1){
						if(count($categoryInfo->product) == 1){
							$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'index.php?pc='.$categoryInfo->id.'&s='.$categoryInfo->product[0].'&c='.$categoryId);
						}else{
							$link_str = htmlspecialchars(SYSTEM_TOP_URL.$categoryGroupfileName.'list.php?pc='.$categoryInfo->id.'&c='.$categoryId);
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
					if(isset($_GET['pc'])){
						$pc = intval($_GET['pc']);
					}else if(isset($_POST['pc'])){
						$pc = intval($_POST['pc']);
					}else{
						$pc = 0;
					}
					if($pc == $categoryInfo->id){
						$ctr = ' crt';
					}else{
						$ctr = '';
					}
					//$tagStr .= '<li class="contentsNav_'.$classList[$level].'">';
					$tagStr .= '<li class="ctno'.$categoryInfo->id.$ctr.'">';
					$tagStr .= '<a href="'.$link_str.'"'.$target_str.' class="ctno'.$categoryInfo->id.$ctr.'">'.htmlspecialchars($categoryTreeInfo->name).'</a>';
					if($isMulti){
						$subTagStr = self::_printSubNaviGetProductCategoryTag($session, $categoryTreeInfo->subInfoList, $categoryInfoList, $level+1, $categoryId, $isMulti);
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
	private static function _printSubNaviProductCategory($session, $categoryGroupId, $categoryId, $isMulti) {
		require_once dirname(__FILE__).'/../../../../common/inc/data/product_category.php';
		$categoryData = new ProductCategoryData('');
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
		echo self::_printSubNaviGetProductCategoryTag($session, $categoryTreeInfoList[-1]->subInfoList, $categoryInfoList, 0, $categoryId, $isMulti);
	}

	static function printCartCateAll($session, $categoryGroupId, $categoryId) {
		$tags = '';
		$items = self::_printCartCateAll($session, $categoryGroupId, $categoryId);

		if($items !== ""){
			$tags .= <<<"__LONG_STRRING__"
					<nav class="PrdCartNVAll">
						<ul class="clear_fix">
{$items}
						</ul>
					</nav>

__LONG_STRRING__;
		}

		return $tags;
	}
	private static function _printCartCateAll($session, $categoryGroupId, $categoryId) {
		require_once dirname(__FILE__).'/../../../../common/inc/data/product_category.php';
		$categoryData = new ProductCategoryData('');
		$categoryTreeInfoList = $categoryData->getTreeList($categoryGroupId);
		$categoryIdList = array();
		foreach($categoryTreeInfoList[-1]->subInfoList as $categoryTreeInfo) {
			$categoryIdList[$categoryTreeInfo->id] = $categoryTreeInfo->id;
		}
		if(count($categoryIdList) === 0) {
			return '';
		}

		$searchInfoList = array();
		$searchInfoList['search_id'] = $categoryIdList;
		$categoryInfoList = $categoryData->getInfoList($searchInfoList, 1);
		return self::_printCartCateAllTag($session, $categoryTreeInfoList[-1]->subInfoList, $categoryInfoList, $categoryId);
	}
	private static function _printCartCateAllTag($session, $categoryTreeInfoList, $categoryInfoList, $categoryId) {
		$tagStr = '';
		$tagStr .= '<li><a href="javascript:void(0);" id="cart_category0" onclick="cart_cate_crt(0);get_product_list();"'.(($categoryId == 0)?' class="crt"':'').'>全ての商品</a></li>';
		$tagStr .= '<li><a href="javascript:void(0);" id="cart_category99999999" onclick="cart_cate_crt(99999999);get_product_list();"'.(($categoryId == 99999999)?' class="crt"':'').'>過去購入商品</a></li>';
		return $tagStr;
	}

	static function printCartCate($session, $categoryGroupId, $categoryId) {
		$tags = '';
		$items = self::_printCartCate($session, $categoryGroupId, $categoryId);

		if($items !== ""){
			$tags .= <<<"__LONG_STRRING__"
					<nav class="PrdCartCate">
						<ul class="clear_fix">
{$items}
						</ul>
					</nav>

__LONG_STRRING__;
		}

		return $tags;
	}
	private static function _printCartCate($session, $categoryGroupId, $categoryId) {
		require_once dirname(__FILE__).'/../../../../common/inc/data/product_category.php';
		$categoryData = new ProductCategoryData('');
		$categoryTreeInfoList = $categoryData->getTreeList($categoryGroupId);
		$categoryIdList = array();
		foreach($categoryTreeInfoList[-1]->subInfoList as $categoryTreeInfo) {
			$categoryIdList[$categoryTreeInfo->id] = $categoryTreeInfo->id;
		}
		if(count($categoryIdList) === 0) {
			return '';
		}

		$searchInfoList = array();
		$searchInfoList['search_id'] = $categoryIdList;
		$categoryInfoList = $categoryData->getInfoList($searchInfoList, 1);
		return self::_printCartCateTag($session, $categoryTreeInfoList[-1]->subInfoList, $categoryInfoList, $categoryId);
	}
	private static function _printCartCateTag($session, $categoryTreeInfoList, $categoryInfoList, $categoryId) {
		$tagStr = '';
		$tagStr .= '<li><a href="javascript:void(0);" id="cart_category0" onclick="cart_cate_crt(0);get_product_list();"'.(($categoryId == 0)?' class="crt"':'').'>全ての商品</a></li>';
		if(count($categoryTreeInfoList) > 0) {
			foreach($categoryTreeInfoList as $categoryTreeInfo) {
				$categoryInfo = $categoryInfoList[$categoryTreeInfo->id];
				if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased())) {
					if($categoryId == $categoryInfo->id){
						$ctr = ' class="crt"';
					}else{
						$ctr = '';
					}
					$tagStr .= '<li><a href="javascript:void(0);" id="cart_category'.$categoryInfo->id.'" onclick="cart_cate_crt('.$categoryInfo->id.');get_product_list();"'.$ctr.'>'.htmlspecialchars($categoryTreeInfo->name).'</a></li>';
				}
			}
		}
		return $tagStr;
	}

	/**
	 * 商品の購入状況アイコン文字列取得
	 * @param unknown $productApplicantInfo
	 * @return string
	 */
	static function getApplicantStatusIconStr($productApplicantInfo, $iconClass='NrIcBg') {
		if($productApplicantInfo->status == 1) {
			return '<span class="IcoBox '.$iconClass.' BgBlu">'.Util::dispLang(Language::WORD_00386).'</span>';/* 購入済 */
		} else if($productApplicantInfo->status == 2) {
			return '<span class="IcoBox '.$iconClass.' BgPnc">'.Util::dispLang(Language::WORD_00169).'</span>';/* キャンセル待ち */
		} else {
			return '<span class="IcoBox '.$iconClass.' BgGry">'.Util::dispLang(Language::WORD_00175).'</span>';/* キャンセル */
		}
	}
	/**
	 * 商品の受付状況アイコン文字列取得
	 * @param unknown $productInfo
	 * @return string
	 */
	static function getAcceptStatusIconStr($productInfo, $iconClass='NrIcBg') {
		if($productInfo->isAccept && $productInfo->isOpen){
			if($productInfo->stock_type == 1){
				$rest = max($productInfo->capacity-$productInfo->applicant, 0);
			}else{
				$rest = 99;
			}
			if(
				($productInfo->acceptType == 1
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				)
				|| ($productInfo->acceptType == 2
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				&& mktime($productInfo->acceptEndDatetime->hour, $productInfo->acceptEndDatetime->minute, 0, $productInfo->acceptEndDatetime->month, $productInfo->acceptEndDatetime->day, $productInfo->acceptEndDatetime->year) >= time()
				)
				|| $productInfo->acceptType == 3
			){
				if($rest > 5) {
					return '<span class="IcoBox '.$iconClass.' BgBlu">'.Util::dispLang(Language::WORD_00387).'</span>';/* 在庫あり */
				} else if($rest > 0) {
					return '<span class="IcoBox '.$iconClass.' BgPnc">'.Util::dispLang(Language::WORD_00168).'</span>';/* あとわずか */
				} else if($productInfo->cancel_to_wait === 1) {
					return '<span class="IcoBox '.$iconClass.' BgGry">'.Util::dispLang(Language::WORD_00388).'</span>';/* 入荷待ち */
				} else {
					return '<span class="IcoBox '.$iconClass.' BgGry">'.Util::dispLang(Language::WORD_00389).'</span>';/* 完売 */
				}
			}else{
				return '<span class="IcoBox '.$iconClass.' BgGry">'.Util::dispLang(Language::WORD_00390).'</span>';/* 販売終了 */
			}
		}else{
			return '<span class="IcoBox '.$iconClass.' BgGry">'.Util::dispLang(Language::WORD_00390).'</span>';/* 販売終了 */
		}
	}
	static function getAcceptStatusIconStr2($productInfo) {
		if($productInfo->isAccept && $productInfo->isOpen){
			if($productInfo->stock_type == 1){
				$rest = max($productInfo->capacity-$productInfo->applicant, 0);
			}else{
				$rest = 99;
			}
			if(
				($productInfo->acceptType == 1
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				)
				|| ($productInfo->acceptType == 2
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				&& mktime($productInfo->acceptEndDatetime->hour, $productInfo->acceptEndDatetime->minute, 0, $productInfo->acceptEndDatetime->month, $productInfo->acceptEndDatetime->day, $productInfo->acceptEndDatetime->year) >= time()
				)
				|| $productInfo->acceptType == 3
			){
				if($rest > 5) {
					return Util::dispLang(Language::WORD_00387);/* 在庫あり */
				} else if($rest > 0) {
					return Util::dispLang(Language::WORD_00168);/* あとわずか */
				} else if($productInfo->cancel_to_wait === 1) {
					return Util::dispLang(Language::WORD_00388);/* 入荷待ち */
				} else {
					return Util::dispLang(Language::WORD_00389);/* 完売 */
				}
			}else{
				return Util::dispLang(Language::WORD_00390);/* 販売終了 */
			}
		}else{
			return Util::dispLang(Language::WORD_00390);/* 販売終了 */
		}
	}
	static function getAcceptStatus($productInfo) {
		if($productInfo->isAccept && $productInfo->isOpen){
			if($productInfo->stock_type == 1){
				$rest = max($productInfo->capacity-$productInfo->applicant, 0);
			}else{
				$rest = 99;
			}
			if(
				($productInfo->acceptType == 1
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				)
				|| ($productInfo->acceptType == 2
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				&& mktime($productInfo->acceptEndDatetime->hour, $productInfo->acceptEndDatetime->minute, 0, $productInfo->acceptEndDatetime->month, $productInfo->acceptEndDatetime->day, $productInfo->acceptEndDatetime->year) >= time()
				)
				|| $productInfo->acceptType == 3
			){
				if($rest > 5) {
					return true;
				} else if($rest > 0) {
					return true;
				} else if($productInfo->cancel_to_wait === 1) {
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