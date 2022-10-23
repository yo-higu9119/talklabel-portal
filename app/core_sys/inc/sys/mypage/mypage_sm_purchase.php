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
		if($seminarInfo->TypeNo == 1){
			if($seminarInfo->venue_id !== 0){
				$placeName = htmlspecialchars($VenueList[$seminarInfo->venue_id]->name);
				$placeName = '<a href="'.$VenueList[$seminarInfo->venue_id]->map.'" target="_blank">'.$placeName.'</a>';
			}else{
				$placeName = Util::dispLang(Language::WORD_00156);/* 会場未定*/
			}
		}else{
			$placeName = Util::dispLang(Language::WORD_00157);/* オンライン*/
		}

		$seminarApplyStatus = $seminarInfo->applyStatus($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId());
		$seminarId = $seminarInfo->id;

		$TypeList = $seminarInfo->getTypeList();
		$typeTag = '';
		if($seminarInfo->TypeNo == 1){
			$typeTag = '<span class="IcoBox MdIcBg BgPnc">'.$TypeList[$seminarInfo->TypeNo].'</span>';
		}else if($seminarInfo->TypeNo == 2){
			$typeTag = '<span class="IcoBox MdIcBg BgGrn">'.$TypeList[$seminarInfo->TypeNo].'</span>';
		}
		
		$seminarPaymentInfoList = $seminarPaymentData->getInfoList($seminarApplicantInfo->id, 2);
		$seminarPaymentInfo = current($seminarPaymentInfoList);
		if(!$seminarPaymentInfo->isPaid) {	//TODO
			$paidTag = '<span class="IcoBox MdIcBg BgBlu">'.Util::dispLang(Language::WORD_00341).'</span>';/*未決済*/
		} else {
			$paidTag = '<span class="IcoBox MdIcBg BgOyl">'.Util::dispLang(Language::WORD_00340).'</span>';/*決済済*/
		}
		if($seminarApplicantInfo->status == 3){
			$colspanTag = ' colspan="2"';
		}else{
			$colspanTag = '';
		}

?>

	<section class="mypageOrdBox">
<?php require dirname(__FILE__).'/./mypage_sm_purchase_detail.php';?>
	</section>
<?php
		}
	}else{
?>
	<p class="CautTxt CautMg"><?php echo Util::dispLang(Language::WORD_00357);/*現在申込済みのセミナーはありません。*/?></p>
<?php
	}
?>