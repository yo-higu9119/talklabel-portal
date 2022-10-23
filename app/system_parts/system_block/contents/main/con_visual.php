<?php
if($info->fileName !== ""){
?>
		<figure class="mainVisual"><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_article_file.php?id='.$info->id)?>"></figure>
<?php
}
?>
