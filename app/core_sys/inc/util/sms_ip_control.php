<?php
require_once dirname(__FILE__).'/../../../../common/inc/data/sms_domain_data.php';

$DomainData = new DomainData('');
$domainInfo = $DomainData->getInfoDomain();

//print_r($_SERVER['REMOTE_ADDR']);

if($domainInfo->id > 0){
	//$ipList = $domainInfo->admin_ip_limit;
	$ipList = $domainInfo->app_ip_limit;
	if(trim($ipList) !== "") {
		$access = false;
		$list = explode(",",trim($ipList));
		if(Config::SYSTEM_CONTROARL == 1){/*  アプリモード01 */
			if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
				$userIpList = explode(",",trim($_SERVER['HTTP_X_FORWARDED_FOR']));
			}else{
				$userIpList = explode(",",trim($_SERVER['REMOTE_ADDR']));
			}
		}else{
			$userIpList = explode(",",trim($_SERVER['REMOTE_ADDR']));
		}
		foreach ($list as $val){
			if(in_array($val,$userIpList)){
				$access = true;
			}
		}
		if(!$access){
			header('HTTP/1.1 403 Forbidden');
			exit();
		}
	}
}
?>