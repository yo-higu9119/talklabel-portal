<?php
$inputFuncData = new InputFunctionData('');
$masterBaseData = new MasterBaseData('');
$memberData = new MemberData('会員本人');

$useList = array();
$useList['INPUT00002'] = true;

$memberData->setBaseNo(1,false,0,$useList);

$SYS_BaseList = $inputFuncData->getBase();
$SYS_Message = '';
$SYS_Result = array();
$old_pass = "";
$passcheck = "";
$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
if(isset($_POST['mode'])) {
	if(isset($_POST['old_pass'])){
		if(trim($_POST['old_pass']) !== ""){
			if($_POST['old_pass'] != $SYS_MemInfo->pass){
				$old_pass = Util::dispLang(Language::WORD_00636)/*パスワードが違います*/;
			}
		}else{
			$old_pass = Util::dispLang(Language::WORD_00637)/*必須です*/;
		}
	}else{
		$old_pass = Util::dispLang(Language::WORD_00637)/*必須です*/;
	}
	if(isset($_POST['passcheck'])){
		if(trim($_POST['passcheck']) !== ""){
			if($_POST['passcheck'] != $_POST['INPUT00002']){
				$passcheck = Util::dispLang(Language::WORD_00638)/*パスワードが一致しません*/;
			}
		}else{
			$passcheck = Util::dispLang(Language::WORD_00637)/*必須です*/;
		}
	}else{
		$passcheck = Util::dispLang(Language::WORD_00637)/*必須です*/;
	}
	
	$SYS_MemInfo = $memberData->getInputValue($SYS_MemInfo);
	$SYS_Result = $memberData->check($SYS_MemInfo);
	if($old_pass !== ""){
		$SYS_Result['old_pass'] = $old_pass;
	}
	if($passcheck !== ""){
		$SYS_Result['passcheck'] = $passcheck;
	}
	
	if(isset($_SESSION['regist_check']) && isset($_POST['regist_check']) && $_SESSION['regist_check'] == $_POST['regist_check']){
		unset($_SESSION['regist_check']);
	}else{
		$SYS_Message = Util::dispLang(Language::WORD_00639)/*操作が不正です。*/;
	}
	
	if(count($SYS_Result) === 0 && $SYS_Message == "") {
		$isPostClear = false;
		if($memberData->update($SYS_MemInfo)) {
			$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
			$SYS_Message = Util::dispLang(Language::WORD_00640)/*パスワードが変更されました。*/;

			$isPostClear = true;
		} else {
			$SYS_Message = Util::dispLang(Language::WORD_00641)/*パスワードの変更に失敗しました。*/;
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
		$SYS_Message = Util::dispLang(Language::WORD_00642)/*入力内容に間違いがあります。*/;
	}
}
$registCheckKey = Util::randomStr(64);
$_SESSION['regist_check'] = $registCheckKey;
?>