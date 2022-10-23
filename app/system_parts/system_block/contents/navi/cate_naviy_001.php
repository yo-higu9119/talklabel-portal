<?php
if($categoryId > 0){
?>
			<div class="catenavY clear_fix">
<?php HtmlPartsArticle::printSubNavi($session, $categoryGroupId, false, $categoryId);?>
			</div>
<?php
}
?>
