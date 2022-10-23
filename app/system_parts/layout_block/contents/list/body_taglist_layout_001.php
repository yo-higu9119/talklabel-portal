	<div id="main" class="clear_fix">
<?php require dirname(__FILE__).'/../../../system_block/contents/list/con_taglist_cate_title.php';?>
		<div class="contents_list">
<?php require dirname(__FILE__).'/../../../system_block/contents/con_list/con_list_001.php';?>
			<div class="PageNum">
<?php
HtmlParts::printPageSelectGetParam(HtmlParts::getMyPage(), $pageNo, $pageMax, $addParam);
?>
			</div>
		</div>
	</div>
