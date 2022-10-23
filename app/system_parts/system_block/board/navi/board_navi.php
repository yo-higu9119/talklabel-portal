<?php if ($session->isLogin()) { ?>
					<p class="BtM mgb30"><a href="<?php echo SYSTEM_TOP_URL; ?>community/board/input.php?b=0<?php echo $addParam; ?>" class="orBT btInp"><?php echo Util::dispLang(Language::WORD_00138);/*新規トピックス投稿*/?></a></p>
<?php } ?>
					<div class="catenav">
<?php
HtmlPartsBoard::printSubNavi($session, $boardCategoryGroupId, $addParam);
?>
					</div>