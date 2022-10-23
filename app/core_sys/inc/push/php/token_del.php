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

require_once dirname(__FILE__).'/../../../../../common/inc/data/push_token.php';
$pushTokenData = new PushTokenData($session->getMemberName());
$memberData->deleteTopicOne($session->getMemberId(), $_POST['token']);	//エラーでも無視（登録が無い場合対応）
if($pushTokenData->del($_POST['token'])) {
	$result = 1;
}

header( 'Content-Type: text/javascript; charset=utf-8' );
echo '{"result":'.$result.'}';
?>
