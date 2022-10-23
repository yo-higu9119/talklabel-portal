<?php
require_once dirname(__FILE__).'/../../../../../common/inc/data/seminar.php';
$seminarData = new SeminarData($session->getMemberName());
require_once dirname(__FILE__).'/../../../../../common/inc/data/seminar_applicant.php';
$seminarApplicantData = new SeminarApplicantData($session->getMemberName());
require_once dirname(__FILE__).'/../../../../../common/inc/data/seminar_payment.php';
$seminarPaymentData = new SeminarPaymentData($session->getMemberName());

require_once dirname(__FILE__).'/../../../../../common/inc/data/venue_data.php';
$VenueData = new VenueData($session->getMemberName());
$VenueList = $VenueData->getList();

$searchInfoList = array();
$searchInfoList['search_member_id'] = $session->getMemberId();
$seminarApplicantInfoList = $seminarApplicantData->getInfoList($searchInfoList, 1);
$seminarIdList = array();
foreach($seminarApplicantInfoList as $seminarApplicantInfo) {
	$seminarIdList[$seminarApplicantInfo->seminarId] = $seminarApplicantInfo->seminarId;
}
$searchInfoList = array();
$searchInfoList['search_id'] = $seminarIdList;
$seminarInfoList = $seminarData->getInfoList($searchInfoList, 1);

if(count($seminarApplicantInfoList) > 0){
	foreach($seminarApplicantInfoList as $seminarApplicantInfo) {
		$seminarInfo = $seminarInfoList[$seminarApplicantInfo->seminarId];
		$seminarApplyStatus = $seminarInfo->applyStatus($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId());
		$seminarId = $seminarInfo->id;
		
		$seminarPaymentInfoList = $seminarPaymentData->getInfoList($seminarApplicantInfo->id, 2);
?>
	<section class="mypageOrdBox">
		<dl class="ordDetTi clear_fix">
			<dt><?php echo Util::dispLang(Language::WORD_00358);/*申込済セミナー*/?></dt>
			<dd><?php echo $seminarInfo->name; ?></dd>
		</dl>
		<dl class="clear_fix">
			<dt class="name"><?php echo Util::dispLang(Language::WORD_00158);/*開催日*/?></dt>
			<dd class="name"><?php
		if($seminarInfo->eventType == 1){
			$eventDate = $seminarInfo->theDate->toString();
		}else if($seminarInfo->eventType == 2){
			$eventDate = Util::dispLang(Language::WORD_00159);/* 常時開催*/
		}else{
			$eventDate = $seminarInfo->lectureList[0]->theDate->toString();
		}
		echo $eventDate;
?></dd>
		</dl>
		<dl class="clear_fix">
			<dt class="name"><?php echo Util::dispLang(Language::WORD_00701);/*申込日*/?></dt>
			<dd class="name"></dd>
		</dl>
	</section>
<?php
		}
	}else{
?>
		<p class="CautTxt CautMg"><?php echo Util::dispLang(Language::WORD_00357);/*現在申込済みのセミナーはありません。*/?></p>
<?php
	}
?>