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
			$link_str = htmlspecialchars(SYSTEM_TOP_URL.$groupfileName.'?bc='.$id);
		}else if($auto_link == 1){
			if(count($contents) == 1){
				$link_str = htmlspecialchars(SYSTEM_TOP_URL.$groupfileName.'index.php?c='.$id.'&s='.$contents[0]);
			}else{
				$link_str = htmlspecialchars(SYSTEM_TOP_URL.$groupfileName.'?bc='.$id);
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
		if(isset($_GET['b'])){
			require_once dirname(__FILE__).'/../../../../../common/inc/data/board.php';
			$boardData = new BoardData($session->getMemberName());
			$panBoardInfo = $boardData->getInfo(intval($_GET['b']));
			if($panBoardInfo->id > 0 &&  $panBoardInfo->status == 1 &&  $panBoardInfo->commentAuthDefoult == 1) {
?>
					<li>｜</li>
					<li><?php echo htmlspecialchars($panBoardInfo->title)?></li>
<?php
			}

		}
	}
}else{
?>
					<li>｜</li>
					<li><?php echo Util::dispLang(Language::WORD_00139);/*全ての掲示板*/?></li>
<?php
}
?>
				</ul>
			</nav>
