<?php
if(count($breadcrumbList) > 0){
	foreach($breadcrumbList as $breadcrumbInfo) {
		$target_str = '';
		$groupfileName = $breadcrumbInfo['group_file_name'];
		
		$id = $breadcrumbInfo['id'];
		$auto_link = intval($breadcrumbInfo['auto_link']);
		$auto_path = $breadcrumbInfo['auto_path'];
		$link_url = intval($breadcrumbInfo['link_url']);
		$link_target = intval($breadcrumbInfo['link_target']);
		$breadcrumb_name = $breadcrumbInfo['breadcrumb_name'];
		$contents = explode(',', $breadcrumbInfo['contents']);
		if($auto_link == 0){
			$link_str = htmlspecialchars(SYSTEM_TOP_URL.$groupfileName.'list.php?c='.$categoryId.'&sc='.$id);
		}else if($auto_link == 1){
			if(count($contents) == 1){
				$link_str = htmlspecialchars(SYSTEM_TOP_URL.$groupfileName.'index.php?c='.$categoryId.'&sc='.$id.'&s='.$contents[0]);
			}else{
				$link_str = htmlspecialchars(SYSTEM_TOP_URL.$groupfileName.'list.php?c='.$categoryId.'&sc='.$id);
			}
		}else{
			if($auto_path == 0){
					$groupFilePath = '';
			}else{
					$groupFilePath = SYSTEM_TOP_URL;
			}
			if($link_url == ""){
				$link_str = htmlspecialchars($groupFilePath);
			}else{
				$link_str = htmlspecialchars($groupFilePath.$link_url);
				if($link_target == 1){
					$target_str = ' target="_blank"';
				}
			}
		}
?>
			<p class="BtM"><a href="<?php echo $link_str?>" class="ListBkBt back"><?php echo Util::dispLang(Language::WORD_00650);/* 一覧に戻る */?></a></p>
<?php
		}
}
?>
