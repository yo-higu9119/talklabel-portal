<?php
require_once dirname(__FILE__).'/../../inc/util/session.php';
$session = new Session();
CorebloLanguage::setLanguageType(CorebloLanguage::getLanguageSelect());
// 受け取ったXMLレスポンスをPHPの連想配列へ変換
$SAMLResponsed_flg = false;
if(isset($_POST['SAMLResponse'])){
	$xmlObj = simplexml_load_string(base64_decode($_POST['SAMLResponse']));
	$json = json_encode($xmlObj);
	$response = json_decode($json, true);
	//print_r($xmlObj);
	
	$systemData = new SystemData('');
	$systemInfo = $systemData->getInfo();
	$azure_certificate = str_replace(array("\r", "\n"), '', $systemInfo->azure_certificate);
	$azure_id = str_replace(array("\r", "\n"), '', $systemInfo->azure_id);

	if($systemInfo->azure_type == 1){/* AzureAD */
		if(array_key_exists("Assertion",$response)){
			$x509certificate = "";
			if(
				array_key_exists("Signature",$response['Assertion']) && 
				array_key_exists("KeyInfo",$response['Assertion']['Signature']) && 
				array_key_exists("X509Data",$response['Assertion']['Signature']['KeyInfo']) && 
				array_key_exists("X509Certificate",$response['Assertion']['Signature']['KeyInfo']['X509Data'])
			){
				$x509certificate = $response['Assertion']['Signature']['KeyInfo']['X509Data']['X509Certificate'];
			}

			if($x509certificate == $azure_certificate && array_key_exists("AttributeStatement",$response['Assertion'])){
				if(array_key_exists("Attribute",$response['Assertion']['AttributeStatement'])){
					$Issuer = $response['Assertion']['Issuer'];
					$tmp = $response['Assertion']['AttributeStatement']['Attribute'];
					$id = '';
					$name = '';
					$mail = '';
					foreach ($tmp as $val){
						if(preg_match('/\/objectidentifier/',$val['@attributes']['Name'])){
							$id = $val['AttributeValue'];//objectidentifier
						}else if(preg_match('/\/displayname/',$val['@attributes']['Name'])){
							$name = $val['AttributeValue'];//displayname
						}else if(preg_match('/\/emailaddress/',$val['@attributes']['Name'])){/* 暫定 emailaddress */
							$mail = $val['AttributeValue'];//name
						}
					}
					if($Issuer == $azure_id){
						$SAMLResponsed_flg = true;
					}
				}
			}
		}
	}else if($systemInfo->azure_type == 2){/* GoogleWorkspace */
		$ns = $xmlObj->getNamespaces(true);
		$Issuer = strval($xmlObj->children($ns["saml2"])->Issuer);

		$Assertion = $xmlObj->children($ns["saml2"])->Assertion;
		$AssertionJson = json_encode($Assertion);
		$AssertionResponse = json_decode($AssertionJson, true);

		$mail = $AssertionResponse['Subject']['NameID'];
		$names = $AssertionResponse['AttributeStatement']['Attribute'];
		$name = $names[0]['AttributeValue'].$names[1]['AttributeValue'];
		$id = $response['@attributes']['InResponseTo'];

		$X509Certificate = str_replace(array("\r", "\n"), '', strval($Assertion->children($ns["ds"])->Signature->KeyInfo->X509Data->X509Certificate));
		if($X509Certificate == $azure_certificate && $Issuer == $azure_id){
			$SAMLResponsed_flg = true;
		}
	}else if($systemInfo->azure_type == 3){/* HENNGE */
		$ns = $xmlObj->getNamespaces(true);
		$id = $response["@attributes"]["InResponseTo"];
		$Issuer = $xmlObj->children($ns["saml"])->Issuer;
		$mail = $xmlObj->children($ns["saml"])->Assertion->Subject->NameID;
		$name = $xmlObj->children($ns["saml"])->Assertion->AttributeStatement->Attribute->AttributeValue;
		$X509Certificate = str_replace(array("\r", "\n"), '', strval($xmlObj->children($ns["ds"])->Signature->KeyInfo->X509Data->X509Certificate));

		if($X509Certificate == $azure_certificate && $Issuer == $azure_id){
			$SAMLResponsed_flg = true;
		}
	}
}

$is_app = false;
if(isset($_SESSION['sso_access_to_app'])){
	$is_app = true;
	$sso_access_to_app = trim($_SESSION['sso_access_to_app']);
}else if(isset($_COOKIE['sso_access_to_app'])){
	$is_app = true;
	$sso_access_to_app = trim($_COOKIE['sso_access_to_app']);
}

if(isset($_SESSION['sso_access_to_app'])){
	//unset($_SESSION['sso_access_to_app']);
}
if(isset($_COOKIE['sso_access_to_app'])){
	//setcookie("sso_access_to_app", "", time() - 3600);
}

if($SAMLResponsed_flg){
	if($id !== "" && $name !== "" && $mail != ""){
		$memberData = new MemberData('');
		$memberData->setBaseNo(1,false,false,array(),true);
		$info = $memberData->getInfoMail($mail);
		if($info->id > 0){
			$message = $session->login($info->mail, $info->pass);
			if($message === ''){
				if($is_app){
					require_once dirname(__FILE__).'/../../../../common/inc/data/app_token.php';
					$TokenData = new AppTokenData('');
					$tokenInfo = new AppTokenInfo();
					$tokenInfo->member_id = $session->getMemberId();
					$tokenInfo->token = $tokenInfo->getToken(0);
					$tokenInfo->refresh_token = $tokenInfo->getToken(1);
					$tokenInfo->language_type = $_SESSION['sso_app_language'];//1;//$language;
					$tokenInfo->member_uuid = $sso_access_to_app;
					
					$tokenInfo = $TokenData->insert($tokenInfo);
					if($tokenInfo->member_id > 0){
						$_SESSION['sso_access_token'] = $tokenInfo->token;
						$_SESSION['sso_refresh_token'] = $tokenInfo->refresh_token;
						header('Location: CommuSuppo://app?access_token='.$tokenInfo->token.'&refresh_token='.$tokenInfo->refresh_token);
					}else{
						echo 'ログインに失敗しました。';
					}
					exit();
				}else{
					if(array_key_exists('redirectURL', $_SESSION)){
						$redirectURL = $_SESSION['redirectURL'];
						$_SESSION['redirectURL'] = '';
						unset($_SESSION['redirectURL']);
						header('Location: '.$redirectURL);
						exit();
					}else{
						header('Location: '.SYSTEM_URL.'index.php');
						exit();
					}
				}
			}
		}else{//新規
			$info->data['INPUT00003'] = $name;
			$info->mail = $mail;
			$info->data['INPUT00001'] = $mail;
			$info->data['INPUT00002'] = $memberData->randomStr(8);
			$info->invalid = 0;
			
			/*
			require_once dirname(__FILE__).'/../../../../common/inc/data/authority_data.php';
			$authorityData = new AuthorityData('');
			$authorityInfo = $authorityData->getInfo(1);
			
			if($authorityInfo->id > 0){
				$info->authList[$authorityInfo->id] = $authorityInfo->id;
			}
			*/
			
			if($systemInfo->azure_default_id > 0){
				$info->authList[$systemInfo->azure_default_id] = $systemInfo->azure_default_id;
			}
			
			$result = $memberData->check($info);
			if(count($result) === 0) {
				$id = $memberData->insert($info);
				if($id > 0) {
					$info = $memberData->getInfo($id);
					if($info->id > 0){
						$message = $session->login($info->mail, $info->pass);
						if($message === ''){
							if($is_app){
								require_once dirname(__FILE__).'/../../../../common/inc/data/app_token.php';
								$TokenData = new AppTokenData('');
								$tokenInfo = new AppTokenInfo();
								$tokenInfo->member_id = $session->getMemberId();
								$tokenInfo->token = $tokenInfo->getToken(0);
								$tokenInfo->refresh_token = $tokenInfo->getToken(1);
								$tokenInfo->language_type = 1;//$language;
								$tokenInfo->member_uuid = $sso_access_to_app;
								
								$tokenInfo = $TokenData->insert($tokenInfo);
								if($tokenInfo->member_id > 0){
									$_SESSION['sso_access_token'] = $tokenInfo->token;
									$_SESSION['sso_refresh_token'] = $tokenInfo->refresh_token;
									header('Location: CommuSuppo://app?access_token='.$tokenInfo->token.'&refresh_token='.$tokenInfo->refresh_token);
								}else{
									echo 'ログインに失敗しました。';
								}
							}else{
								header('Location: '.SYSTEM_URL.'index.php');
							}
							exit();
						}
					}
				}
			}else{
				if(!$is_app){
					$_SESSION['App'] = array();
					$_SESSION['App']['Message'] = '初回ログインに失敗しました。';
					$sErr = "";
					foreach($result as $key => $val){
						$sErr .= ($sErr != "")?' | ':'';
						$sErr .= $key.':'.$val;
					}
					if($sErr != ""){
						$_SESSION['App']['Message'] .= '[ '.$sErr.' ]';
					}
					header('Location: '.SYSTEM_URL.'users/login/index.php');
					exit();
				}
			}
			if($is_app){
				echo '初回ログインに失敗しました。';
			}else{
				$_SESSION['App'] = array();
				$_SESSION['App']['Message'] = '初回ログインに失敗しました。';
				header('Location: '.SYSTEM_URL.'users/login/index.php');
			}
			exit();
		}
	}else{
		if($mail == ""){
			if($is_app){
				echo '連携先のメールアドレスが設定されていません。';
			}else{
				$_SESSION['App'] = array();
				$_SESSION['App']['Message'] = '連携先のメールアドレスが設定されていません。';
				header('Location: '.SYSTEM_URL.'users/login/index.php');
			}
			exit();
		}
		if($id == ""){
			if($is_app){
				echo '連携先のobjectidentifierが取得できません。';
			}else{
				$_SESSION['App'] = array();
				$_SESSION['App']['Message'] = '連携先のobjectidentifierが取得できません。';
				header('Location: '.SYSTEM_URL.'users/login/index.php');
			}
			exit();
		}
		if($name == ""){
			if($is_app){
				echo '連携先のdisplaynameが取得できません。';
			}else{
				$_SESSION['App'] = array();
				$_SESSION['App']['Message'] = '連携先のdisplaynameが取得できません。';
				header('Location: '.SYSTEM_URL.'users/login/index.php');
			}
			exit();
		}
	}
}
if($is_app){
	echo 'アカウント又はパスワードが違います。';
}else{
	$_SESSION['App'] = array();
	$_SESSION['App']['Message'] = 'アカウント又はパスワードが違います。';
	header('Location: '.SYSTEM_URL.'users/login/index.php');
}
exit();
?>
