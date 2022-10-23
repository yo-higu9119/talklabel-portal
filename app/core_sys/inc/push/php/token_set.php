<?php
require_once dirname(__FILE__).'/../../util/session.php';
$session = new Session(true);

if(empty($_POST['token'])) {
	syslog(LOG_ERR, 'Token empty:['.__FILE__.':'.__LINE__.']');
	header( 'Content-Type: text/javascript; charset=utf-8' );
	echo '{"result":-1}';
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
	echo '{"result":-2}';
	exit();
}

require_once dirname(__FILE__).'/../../../../../common/inc/data/push_token.php';
$pushTokenData = new PushTokenData($session->getMemberName());
$pushTokenData->del($_POST['token']);//相談所等が試している場合対応
$pushTokenInfo = new PushTokenInfo();
$pushTokenInfo->memberId = $session->getMemberId();
$pushTokenInfo->token = $_POST['token'];
if($pushTokenData->set($pushTokenInfo)) {
	if($memberData->registTopicOne($info->id, $_POST['token'])) {
		$result = 1;
	} else {
		syslog(LOG_ERR, 'registTopic() error:['.__FILE__.':'.__LINE__.']['.$_POST['token'].']');
	}
} else {
	syslog(LOG_ERR, 'set() error:['.__FILE__.':'.__LINE__.']');
}

header( 'Content-Type: text/javascript; charset=utf-8' );
echo '{"result":'.$result.'}';
?>
