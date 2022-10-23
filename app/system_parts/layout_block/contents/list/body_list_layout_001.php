	<div id="main" class="clear_fix">
<?php require dirname(__FILE__).'/../../../system_block/contents/list/con_list_cate_title.php';?>
<?php require dirname(__FILE__).'/../../../system_block/contents/navi/cate_navisl_001.php';?>
<?php require dirname(__FILE__).'/../../../system_block/contents/list/con_list_visual.php';?>
		<div class="contents_list">
<?php require dirname(__FILE__).'/../../../system_block/contents/con_list/con_list_001.php';?>
			<div class="PageNum">
<?php
HtmlParts::printPageSelectGetParam(HtmlParts::getMyPage(), $pageNo, $pageMax, $addParam);
?>
			</div>
		</div>
	</div>
