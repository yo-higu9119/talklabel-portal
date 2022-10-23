<?php
require_once dirname(__FILE__).'/../../util/session.php';
$session = new Session(true);

if(empty($_POST['token'])) {
	header( 'Content-Type: text/javascript; charset=utf-8' );
	echo '{"result":0}';
	exit();
}

set_time_limit(0);

$result = 0;

require_once dirname(__FILE__).'/../../../../../common/inc/data/member_data.php';
$memberData = new MemberData($session->getMemberName());
$memberData->setBaseNo(1);
$info = $memberData->getInfo($session->getMemberId());
if($info->id === 0) {
	syslog(LOG_ERR, 'Error:['.__FILE__.':'.__LINE__.']');
	header( 'Content-Type: text/javascript; charset=utf-8' );
	echo '{"result":0}';
	exit();
}

require_once dirname(__FILE__).'/../../../../../common/inc/data/push_token.php';
$pushTokenData = new PushTokenData($session->getMemberName());
$pushTokenInfo = new PushTokenInfo();
$pushTokenInfo->memberId = $session->getMemberId();
$pushTokenInfo->token = $_POST['token'];
if($pushTokenData->isRegisted($pushTokenInfo)) {
	$result = 1;
}

header( 'Content-Type: text/javascript; charset=utf-8' );
echo '{"result":'.$result.'}';
?>
