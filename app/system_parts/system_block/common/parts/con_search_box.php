	<div class="searchBox">
		<form method="get" action="#">
			<section class="search_container">
				<input type="text" name="search_box" size="25" placeholder="<?php echo Util::dispLang(Language::WORD_00214);/*キーワード検索*/?>">
				<input type="submit" value="<?php echo Util::dispLang(Language::WORD_00215);/*検索*/?>" onclick="search_box_link();return false">
			</section>
		</form>
	</div>
	<script type="text/javascript">
	<!--
	function search_box_link(){
		var val = $("input[name='search_box']").val();
		if(val != ""){
			val = encodeURIComponent(val);
			location.href='<?php echo SYSTEM_TOP_URL; ?>contents/main/list.php?sr='+val;
		}
	}
	//-->
	</script>