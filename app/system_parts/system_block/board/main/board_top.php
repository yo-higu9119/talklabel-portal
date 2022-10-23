					<section class="board clear_fix">
<?php
if(count($boardInfoList) > 0){//リストあり
?>
						<nav class="catenavY WidW">
							<ul class="ct5 clear_fix">
								<li><a href="./?bs=0&<?php echo $addParam;?>"<?php echo ($boardSortType == 0)?' class="crt"':'';?>><?php echo Util::dispLang(Language::WORD_00133);/*更新日時*/?></a></li>
								<li><a href="./?bs=1&<?php echo $addParam;?>"<?php echo ($boardSortType == 1)?' class="crt"':'';?>><?php echo Util::dispLang(Language::WORD_00134);/*アクセス数*/?></a></li>
								<li><a href="./?bs=2&<?php echo $addParam;?>"<?php echo ($boardSortType == 2)?' class="crt"':'';?>><?php echo Util::dispLang(Language::WORD_00135);/*いいね数*/?></a></li>
								<li><a href="./?bs=3&<?php echo $addParam;?>"<?php echo ($boardSortType == 3)?' class="crt"':'';?>><?php echo Util::dispLang(Language::WORD_00136);/*コメント数*/?></a></li>
								<li><a href="./?bs=4&<?php echo $addParam;?>"<?php echo ($boardSortType == 4)?' class="crt"':'';?>><?php echo Util::dispLang(Language::WORD_00137);/*投稿日*/?></a></li>
							</ul>
						</nav>
<?php
}
?>
						<div class="boardList">
<?php
if(count($boardInfoList) > 0){//リストあり
?>
<?php
	HtmlPartsBoard::printList($boardInfoList, $session, array('CategoryGroupId' => $boardCategoryGroupId));
?>

							<div class="PageNum">
<?php
	require_once dirname(__FILE__).'/../../../../core_sys/inc/util/html_parts.php';
	HtmlParts::printPageSelectGetParam('', $pageNo, $pageMax, $NBaddParam);
?>
							</div>
<?php
}else{//リストなし
?>
							<p class="CautTxt cnt"><?php echo Util::dispLang(Language::WORD_00443);/*トピックスは見つかりませんでした。*/?></p>
<?php
}
?>
						</div>
<?php if (IS_SMART_PHONE) { ?>
<?php if ($session->isLogin()) { ?>
							<div class="BtM mgt30 mgb30">
								<p class="inbox"><a href="<?php echo SYSTEM_TOP_URL; ?>community/board/input.php?b=0<?php echo $addParam; ?>" class="orBT mglra btWtM next fontFace"><?php echo Util::dispLang(Language::WORD_00138);/*新規トピックス投稿*/?></a></p>
							</div>
<?php } ?>
<?php } else { ?>
<?php } ?>
					</section>
