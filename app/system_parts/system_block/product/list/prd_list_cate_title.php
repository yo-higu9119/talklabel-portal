<?php
if($productCategoryId > 0 && $productCategoryInfo->id > 0){
	$categoryImg ='';
	if(trim($productCategoryInfo->fileName) !== ""){
		$categoryImg = '<img src="'.SYSTEM_TOP_URL.'core_sys/sys/file/get_product_category_file.php?id='.$productCategoryInfo->id.'">';
	}
?>
			<div class="main_ti"><h1 class="bsc_ti"><span><?php echo htmlspecialchars($categoryInfo->name)?></span></h1></div>
<?php
}else if($categoryInfo->id > 0) {
	$categoryImg ='';
	if(trim($categoryInfo->fileName) !== ""){
		$categoryImg = '<img src="'.SYSTEM_TOP_URL.'sys/file/get_article_category_file.php?id='.$categoryInfo->id.'">';
	}
?>
			<div class="main_ti"><h1 class="bsc_ti"><span><?php echo htmlspecialchars($categoryInfo->name)?></span></h1></div>
<?php
}else{
?>
			<div class="main_ti"><h1 class="bsc_ti"><span><?php echo Util::dispLang(Language::WORD_00379);/*‘S‚Ä‚Ì¤•i*/?></span></h1></div>
<?php
}
?>