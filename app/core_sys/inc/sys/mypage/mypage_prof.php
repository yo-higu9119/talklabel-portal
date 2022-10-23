<?php
$inputFuncData = new InputFunctionData('');
$masterBaseData = new MasterBaseData('');
$memberData = new MemberData('会員本人');
$memberData->setBaseNo(1,true);

$SYS_BaseList = $inputFuncData->getBase();
$SYS_Message = '';
$SYS_Result = array();
$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
if(isset($_POST['mode'])) {
	$SYS_MemInfo = $memberData->getInputValue($SYS_MemInfo);
	$SYS_Result = $memberData->check($SYS_MemInfo);
	if(count($SYS_Result) === 0) {
		$isPostClear = false;
		if($memberData->update($SYS_MemInfo)) {
			$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
			//spl_write($SYS_MemInfo,array());
			$SYS_Message = Util::dispLang(Language::WORD_00630);/*編集が完了しました。*/

			$isPostClear = true;
		} else {
			$SYS_Message = Util::dispLang(Language::WORD_00631)/*編集に失敗しました。*/;
		}

		foreach($memberData->Column as $Key => $funcInfo) {
			if($Key !== 'base' && $Key !== 'master' && $Key !== 'other' && $Key !== 'all'){
				if($funcInfo->type === 11){
					$fileOperation = intval($_POST['file_operation'.$funcInfo->id]);
					switch($fileOperation) {
						case 1:
							break;
						case 2:
							$toFile = PathInfo::getMemberFilePathPub(false, $session->getMemberId(), $funcInfo->id, $session->getMemberId(), false, true);
							if(!FileUtil::createDir($toFile)) {
								echo Util::dispLang(Language::WORD_00632)/*ディレクトリ作成エラー*/;
								exit();
							}
							$fromFile = PathInfo::getMemberFilePathPub(true, $session->getMemberId(), $funcInfo->id, $session->getMemberId(), false, true);
							$targetFile = $fromFile.$funcInfo->id.'.bin';
							if(is_file($targetFile)) {
								ImageFileUtil::make_images($targetFile, $toFile , $funcInfo->id);
								
							}

							break;
						default:
							$tmp = array("","_m","_s");
							foreach($tmp as $str) {
								$file = PathInfo::getMemberFilePathPub(true, $session->getMemberId(), $funcInfo->id, $session->getMemberId(), false, false, $str);
								if(is_file($file)) {
									unlink($file);
								}
								$file = PathInfo::getMemberFilePathPub(false, $session->getMemberId(), $funcInfo->id, $session->getMemberId(), false, false, $str);
								if(is_file($file)) {
									unlink($file);
								}
							}
							break;
					}
				}
			}
		}
		if($isPostClear){
			$_POST = array();
			$file = PathInfo::getMemberFilePathPub(true, $session->getMemberId(), 0, $session->getMemberId(), true);
			exec("rm -Rf '".$file."'");
		}
	} else {
		$SYS_Message = Util::dispLang(Language::WORD_00114)/*入力内容に間違いがあります。*/;
	}
}
?>
