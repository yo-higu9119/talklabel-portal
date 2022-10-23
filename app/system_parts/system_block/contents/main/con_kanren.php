<?php
if(isset($categoryInfo) && $categoryInfo->id > 0 && $categoryInfo->linksDisp){
?>
<section class="kanrenArea">
	<h3 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00006);/* その他の関連記事 */?></h3>
	<div class="kanrenLink">
<?php require dirname(__FILE__).'/../con_list/kanren_list_001.php';?>
	</div>
</section>
<?php
}
?>
