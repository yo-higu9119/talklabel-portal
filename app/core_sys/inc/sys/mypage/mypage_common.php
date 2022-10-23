<?php
$memberData = new MemberData('');
$memberData->setBaseNo(1,false);

$planData = new PlanData($session->getMemberName());
$itemData = new ItemData($session->getMemberName());
$purchaseData = new PurchaseData($session->getMemberName());
$purchaseChData = new PurchaseChData($session->getMemberName());

$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
$SYS_PurList = $purchaseData->getListOrder($session->getMemberId(),0,0,true,false);
$SYS_MemBuyList = $memberData->getPurchasedIdList($session->getMemberId());
?>
