			<nav class="pan_link">
				<ul class="clear_fix">
					<li><a href="<?php echo SYSTEM_TOP_URL; ?>">HOME</a></li>
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
			$link_str = htmlspecialchars(SYSTEM_TOP_URL.$groupfileName.'list.php?c='.$id);
		}else if($auto_link == 1){
			if(count($contents) == 1){
				$link_str = htmlspecialchars(SYSTEM_TOP_URL.$groupfileName.'index.php?c='.$id.'&s='.$contents[0]);
			}else{
				$link_str = htmlspecialchars(SYSTEM_TOP_URL.$groupfileName.'list.php?c='.$id);
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
					<li>｜</li>
					<li><a href="<?php echo $link_str?>"<?php echo $target_str?>><?php echo htmlspecialchars($breadcrumb_name)?></a></li>
<?php
	}
	if(isset($_GET['s'])){
		require_once dirname(__FILE__).'/../../../../../common/inc/data/article.php';
		$articleData = new ArticleData($session->getMemberName());
		$panArticleInfo = $articleData->getInfoFromUrlKey($_GET['s']);
		if($panArticleInfo->id > 0 &&  $panArticleInfo->isOpen) {
?>
					<li>｜</li>
					<li><?php echo htmlspecialchars($panArticleInfo->title)?></li>
<?php
		}

	}
}else{
?>
					<li>｜</li>
					<li>ALL</li>
<?php
}
?>
				</ul>
			</nav>
