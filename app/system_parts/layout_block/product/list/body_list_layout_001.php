	<div id="main" class="clear_fix">
<?php require dirname(__FILE__).'/../../../system_block/product/list/prd_list_cate_title.php';?>
<?php require dirname(__FILE__).'/../../../system_block/product/navi/prd_cate_navisl_001.php';?>
<?php require dirname(__FILE__).'/../../../system_block/product/list/prd_list_visual.php';?>
		<div class="contents_list">
<?php require dirname(__FILE__).'/../../../system_block/product/prd_list/prd_list_001.php';?>
			<div class="PageNum">
<?php
HtmlParts::printPageSelectGetParam(HtmlParts::getMyPage(), $pageNo, $pageMax, $addParam);
?>
			</div>
		</div>
	</div>
