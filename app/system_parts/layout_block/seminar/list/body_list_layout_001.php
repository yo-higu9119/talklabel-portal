	<div id="main" class="clear_fix">
<?php require dirname(__FILE__).'/../../../system_block/seminar/list/sem_list_cate_title.php';?>
<?php require dirname(__FILE__).'/../../../system_block/seminar/navi/sem_cate_navisl_001.php';?>
<?php require dirname(__FILE__).'/../../../system_block/seminar/list/sem_list_visual.php';?>
<?php require dirname(__FILE__).'/../../../system_block/seminar/navi/sem_select_navi_a.php';?>
		<div class="contents_list">
<?php require dirname(__FILE__).'/../../../system_block/seminar/sem_list/sem_list_001.php';?>
			<div class="PageNum">
<?php
HtmlParts::printPageSelectGetParam(HtmlParts::getMyPage(), $pageNo, $pageMax, $addParam);
?>
			</div>
		</div>
	</div>
