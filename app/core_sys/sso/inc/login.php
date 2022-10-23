<?php
	$systemData = new SystemData('');
	$systemInfo = $systemData->getInfo();
	if($systemInfo->azure_type !== 0){
		if($systemInfo->azure_type == 1 || $systemInfo->azure_type == 3){/* AzureAD or HENNGE */
			$Identifier = SYSTEM_URL.'core_sys/sso/metadata/';
			$Date = date("Y-m-d");
			$Time = date("H:i:s");
			$_SESSION['Guid'] = $systemInfo->guid();

			$samlRequest = '<samlp:AuthnRequest xmlns="urn:oasis:names:tc:SAML:2.0:metadata"
			ID="id'.$_SESSION['Guid'].'" Version="2.0" IsPassive="false" ForceAuthn="false"
			IssueInstant="'.$Date.'T'.$Time.'Z"
			xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol">
			<Issuer xmlns="urn:oasis:names:tc:SAML:2.0:assertion">'.$Identifier.'</Issuer>
		</samlp:AuthnRequest>';

			$samlRequestDeflate = gzdeflate($samlRequest);
			$samlRequestB64 = base64_encode($samlRequestDeflate);
			$samlRequestURL = $systemInfo->azure_login_url.'?SAMLRequest='.urlencode($samlRequestB64);
		}else if($systemInfo->azure_type == 2){/* GoogleWorkspace */
			$Identifier = SYSTEM_URL.'core_sys/sso/metadata/';
			$Date = date("Y-m-d");
			$Time = date("H:i:s");
			$_SESSION['Guid'] = $systemInfo->guid();
			
			$samlRequest = '<samlp:AuthnRequest xmlns="urn:oasis:names:tc:SAML:2.0:metadata"
			ID="id'.$_SESSION['Guid'].'" Version="2.0" IsPassive="false" ForceAuthn="false"
			IssueInstant="'.$Date.'T'.$Time.'Z"
			xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol">
			<Issuer xmlns="urn:oasis:names:tc:SAML:2.0:assertion">'.$Identifier.'</Issuer>
		</samlp:AuthnRequest>';

			$samlRequestDeflate = gzdeflate($samlRequest);
			$samlRequestB64 = base64_encode($samlRequestDeflate);
			
			$samlRequestURL = $systemInfo->azure_login_url.'&SAMLRequest='.urlencode($samlRequestB64);
		}
	}
	if(isset($_GET['is_app']) && is_numeric($_GET['is_app']) && strlen($_GET['is_app']) === 1 && intval($_GET['is_app']) === 1) {
		if(isset($_GET['app_uuid']) && trim($_GET['app_uuid']) !== ""){
			$_SESSION['sso_access_to_app'] = trim($_GET['app_uuid']);
			setcookie("sso_access_to_app", trim($_GET['app_uuid']), time() + 300);
			header('Location: '.$samlRequestURL);
			$_SESSION['sso_app_language'] = 1;
			if(isset($_GET['language'])){
				$_SESSION['sso_app_language'] = $_GET['language'];
			}
		}else{
			echo '引数が不正です';
		}
		exit();
	}else{
		unset($_SESSION['sso_access_to_app']);
		setcookie("sso_access_to_app", "", time() - 3600);
	}
?>
