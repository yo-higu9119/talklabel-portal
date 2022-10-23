<?php
$rewardData = new RewardInfoData($session->getMemberName());
$rewardPaymentData = new RewardPaymentData($session->getMemberName());
$introductionData = new MemberIntroductionData($session->getMemberName());

$totalReward = $rewardData->getRewardSum($session->getMemberId());
$totalPayment = $rewardPaymentData->getPaymentSum($session->getMemberId());

$rewardPaymentList = $rewardPaymentData->getList($session->getMemberId());

$searchInfoList = array();
$searchInfoList['search_reward_member_id'] = $session->getMemberId();
$rewardList = $rewardData->getInfoList($searchInfoList,1);
?>
