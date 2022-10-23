<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
require_once dirname(__FILE__).'/../../../common/inc/util/file_util.php';
require_once dirname(__FILE__).'/../../../common/inc/util/util.php';
require_once dirname(__FILE__).'/../../../common/inc/data/path_info.php';

$session = new Session();

function uploadFile($myUserInfo) {
	if(!is_numeric($_POST['type']) || !is_numeric($_POST['id']) || !is_numeric($_POST['sub']) || !is_numeric($_POST['add'])){
		return 'Error:パラメータが不正です。。';
	}

	$uploadMaxStr = ini_get('upload_max_filesize');
	$postMaxStr = ini_get('post_max_size');

	$uploadMax = Util::returnBytes($uploadMaxStr);
	$postMax = Util::returnBytes($postMaxStr);

	$maxSize = (($uploadMax > $postMax)?$postMaxStr:$uploadMaxStr);

	if(isset($_FILES['up_file']['error']) && intval($_FILES['up_file']['error'])!==0) {
		if(intval($_FILES['up_file']['error'])===1
		|| intval($_FILES['up_file']['error'])===2) {
			return 'Error:アップロードできるファイルサイズ上限は'.$maxSize.'Byteです。';
		} else {
			return 'Error:アップロードに失敗しました。エラーコード:'.$_FILES['up_file']['error'];
		}
	}

	if(intval($_SERVER['CONTENT_LENGTH']) > $postMax) {
		return 'Error:POSTサイズオーバー:アップロードできるファイルサイズ上限は'.$maxSize.'Byteです。';
	}

	switch(intval($_POST['type'])) {
		case 5:
			$filePath = PathInfo::getSeminarFilePathS(true, $_POST['id'], $myUserInfo);
			break;
		case 8:
			$tmpPath = PathInfo::getMemberFilePathPub(true, $_POST['id'], $_POST['sub'], $myUserInfo);
			break;
		case 12:
			$tmpPath = PathInfo::getProductFilePathS(true, $_POST['id'], $myUserInfo);
			break;
		case 13:
			$tmpPath = PathInfo::getProductFilePathS2(true, $_POST['id'], $_POST['sub'], $myUserInfo);
			break;
		case 19:
			$tmpPath = PathInfo::getInquiryFilePath(true, $_POST['id'], $_POST['sub'], $_POST['add'], false, false, $_POST['add']);
			break;
		default:
			return 'Error:不明なファイルです。';
	}
	$orgName = $_FILES['up_file']['name'];
	$fileInfo = pathinfo($orgName);

	if(intval($_POST['type']) !== 4 && intval($_POST['type']) !== 19) {
		switch(strtolower($fileInfo['extension'])) {
			case 'jpg';
			case 'jpeg':
			case 'gif':
			case 'png':
				break;
			default:
				return 'Error:アップロードできないファイルです。';
		}
	}

	exec('rm -rf '.$tmpPath);

	if(!FileUtil::createDir($tmpPath)) {
		return 'Error:作業ディレクトリの作成に失敗しました。';
	}

	if(!copy($_FILES['up_file']['tmp_name'], $tmpPath)) {
		return 'Error:ファイル移動に失敗しました。';
	}

	return 'Success:'.htmlspecialchars($orgName);
}
if(!$session->isLogin()){
	$message = 'Error:アクセスが不正です。';
}else{
	$message = uploadFile($session->getMemberId());
}

?>
<html>
<body>
<?php echo $message;?>
</body>
</html>