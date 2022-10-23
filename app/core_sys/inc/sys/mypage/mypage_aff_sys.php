<?php
if($SYS_MemInfo->rank_id !== 0) {
	$qrStr = $SYS_MemInfo->checkQrCode();
	require_once dirname(__FILE__).'/../../../../../common/inc/data/member_rank_data.php';
	$memberRankData = new MemberRankData($session->getMemberName());
	$rankInfo = $memberRankData->getInfo($SYS_MemInfo->rank_id);
	$rankList = $memberRankData->getList();
}
?>
