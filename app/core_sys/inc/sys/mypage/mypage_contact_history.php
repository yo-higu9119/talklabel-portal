<?php
$inputFuncData = new InputFunctionData('');
$memberData = new MemberData('');
$memberData->setBaseNo(1);

$planData = new PlanData('');
$itemData = new ItemData('');
$purchaseData = new PurchaseData('');
$purchaseChData = new PurchaseChData('');
$seminarData = new SeminarData('');
$seminarApplicantData = new SeminarApplicantData('');

$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
$SYS_PurList = $purchaseData->getListOrder($session->getMemberId());

$searchInfoList = array();
$searchInfoList['search_member_id'] = $session->getMemberId();
$SYS_SemiAppList = $seminarApplicantData->getInfoList($searchInfoList, 1);
$seminarIdList = array();
foreach($SYS_SemiAppList as $seminarApplicantInfo) {
	$seminarIdList[$seminarApplicantInfo->seminarId] = $seminarApplicantInfo->seminarId;
}
$searchInfoList = array();
$searchInfoList['search_id'] = $seminarIdList;
$seminarInfoList = $seminarData->getInfoList($searchInfoList, 1);

$inquiryBaseData = new InquiryBaseData($session->getMemberId());
$inputFunctionData = new InputFunctionData($session->getMemberId());
$inquiryData = new InquiryData($session->getMemberId());
?>
