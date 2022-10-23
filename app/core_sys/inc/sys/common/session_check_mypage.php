<?php
$tmp = getallheaders();
if(isset($tmp['Authorization']) || isset($tmp['authorization'])){
	require_once dirname(__FILE__).'/../../../../../common/inc/data/app_token.php';
	if(isset($tmp['Authorization'])){
		$Authorization = str_replace("Bearer ","",$tmp['Authorization']);
	}else if(isset($tmp['authorization'])){
		$Authorization = str_replace("Bearer ","",$tmp['authorization']);
	}else{
		$Authorization = "";
	}
	$TokenData = new AppTokenData('');
	$tokenInfo = $TokenData->getInfo($Authorization,1);
	if($tokenInfo->member_id > 0){
		$langList = CorebloLanguage::getNumToStrList();
		CorebloLanguage::setLanguageType($langList[$tokenInfo->language_type]);
		
		if(CorebloLanguage::isUsetLanguage() == 1){
			CorebloLanguage::getLanguageType();
		}else{
			CorebloLanguage::setLanguageType('jp');
			CorebloLanguage::getLanguageType();
		}
		
		if($session->loginMemId($tokenInfo->member_id) !== ""){
			header('HTTP/1.1 403 Forbidden');
			exit();
		}else{
			$_SESSION['App']['isNativeApp'] = 'app';
		}
	}else{
		header('HTTP/1.1 403 Forbidden');
		exit();
	}
}else{
	if($session->isNativeApp()){
		if(!$session->isLogin()){
			header('HTTP/1.1 403 Forbidden');
			exit();
		}
	}else{
		$session->check();
	}
}
?>