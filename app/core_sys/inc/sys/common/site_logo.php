<?php
require_once dirname(__FILE__).'/../../../../../common/inc/data/path_info.php';
require_once dirname(__FILE__).'/../../../../../common/inc/util/dir_util.php';
require_once dirname(__FILE__).'/../../../../../common/inc/util/file_util.php';
require_once dirname(__FILE__).'/../../../../../common/inc/util/util.php';

$targetFile = PathInfo::getSiteLogoFilePath(false, 0);
if(!is_file($targetFile)) {
	$logo_tag = '';
}else{
	$logo_tag = '<img src="'.SYSTEM_TOP_URL.'core_sys/sys/file/get_site_logo.php" alt="">';
}
echo $logo_tag;
?>