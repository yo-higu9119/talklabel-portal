<?php
if($boardCategoryInfo->id > 0) {
?>
			<div class="main_ti"><h1 class="bsc_ti"><span><?php echo htmlspecialchars($boardCategoryInfo->name)?></span></h1></div>
<?php
}else{
?>
			<div class="main_ti"><h1 class="bsc_ti"><span><?php echo Util::dispLang(Language::WORD_00139);/*‘S‚Ä‚ÌŒfŽ¦”Â*/?></span></h1></div>
<?php
}
?>
<?php if (IS_SMART_PHONE) { ?>
					<div class="catenavSl">
<?php
HtmlPartsBoard::printSubNavi($session, $boardCategoryGroupId, $addParam);
?>
					</div>
<?php } else { ?>
<?php } ?>
