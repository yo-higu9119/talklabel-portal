<?php
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();

$seminarData = new SeminarData('');
$seminarApplicantData = new SeminarApplicantData('');

$sErr = "";
$SYS_OrderId = "";

if(isset($_POST['si'])){
	$seminarId = intval($_POST['si']);
}else{
	$seminarId = 0;
}

if($seminarId !== 0){
	$seminarInfo = $seminarData->getInfo($seminarId);
	if($seminarInfo->id == 0){
		$sErr = Util::dispLang(Language::WORD_00269);/* 選択された情報がありません */
	}else{
		$seminarApplyStatus = $seminarInfo->applyStatus($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId());
		if($seminarApplyStatus == -2 || $seminarApplyStatus == -3) {
			$sErr = Util::dispLang(Language::WORD_00270);/* 申込済みです */
		}else if($seminarApplyStatus == -1){
			$sErr = Util::dispLang(Language::WORD_00271);/* 受付を行っておりません */
		}else if($seminarApplyStatus == 0 || $seminarApplyStatus == -4){
			$sErr = Util::dispLang(Language::WORD_00272);/* 申し込みできません */
		}else{
			$rest = max($seminarInfo->capacity-$seminarInfo->applicant, 0);
			//if($rest > 0)$rest = max($seminarInfo->web_capacity-$seminarInfo->applicant_web, 0);
			
			if(
				($seminarInfo->acceptType == 1
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				)
				|| ($seminarInfo->acceptType == 2
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				&& mktime($seminarInfo->acceptEndDatetime->hour, $seminarInfo->acceptEndDatetime->minute, 0, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day, $seminarInfo->acceptEndDatetime->year) >= time()
				)
				|| $seminarInfo->acceptType == 3
			){
			}else{
				$sErr = Util::dispLang(Language::WORD_00273);/* 受付が終了しています */
			}
		}
	}
}else{
	$sErr = Util::dispLang(Language::WORD_00269);/* 選択された情報がありません */
}

if($sErr == ""){
	$seminarApplyStatus = $seminarInfo->applyStatus($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId());
	if($seminarApplyStatus == -2 || $seminarApplyStatus == -3) {
		$sErr = "申込済みです。";
	}else if($seminarApplyStatus == -1){
		$sErr = "受付を行っておりません。";
	}else{
		if($seminarInfo->dispAmount > 0){/* 有料ルート */
			if(isset($_POST['pay_type']) ){
				$pay_type = intval($_POST['pay_type']);
				if($pay_type ==1 || $pay_type == 2){
					if($pay_type == 2){
						if($systemInfo->card_type == 1 && isset($_POST['cardfinger']) && $_POST['cardfinger'] !== ''){
						}else if($systemInfo->card_type == 1 && isset($_POST['fingerprint']) && $_POST['fingerprint'] !== '' && isset($_POST['Token']) && $_POST['Token'] !== ''){
						}else if($systemInfo->card_type == 3 && isset($_POST['cardfinger']) && $_POST['cardfinger'] !== ''){
						}else if($systemInfo->card_type == 4 && isset($_POST['Token']) && $_POST['Token'] !== ''){
						}else{
							$sErr = Util::dispLang(Language::WORD_00274);/* クレジットカードが判別できません */
						}
					}
				}else{
					$sErr = Util::dispLang(Language::WORD_00275);/* 決済方法が判別できません */
				}
			}else{
				$sErr = Util::dispLang(Language::WORD_00275);/* 決済方法が判別できません */
			}
		}else{/* 無料ルート */
			
		}
	}
}

if($sErr == ""){
	/* 会員処理 */
	$masterBaseData = new MasterBaseData('');
	$memberData = new MemberData('会員本人');
	$memberData->setBaseNo(1,false);
	
	if($session->isLogin()){
		$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
		if($SYS_MemInfo->id == 0){
			$sErr = Util::dispLang(Language::WORD_00276);/* 会員が取得できません */
		}
	}else{
		$sErr = Util::dispLang(Language::WORD_00276);/* 会員が取得できません */
	}
	
	if($sErr == ""){
		$permissionType = 0;
		$permissionItemId = 0;
		$permissionDiscountAmount = 0;
		$amount = 0;

		$memberPurcharsedIdList = $session->getMemberPurchased();
		if(array_key_exists(1, $seminarInfo->paymentTypeList)) {
			if(array_key_exists(0, $seminarInfo->paymentTypeList[1])) {
				$amount = $seminarInfo->paymentTypeList[1][0];
			}
		}
		if(count($memberPurcharsedIdList) === 0
		&& array_key_exists(2, $seminarInfo->permissionList)
		&& array_key_exists(1, $seminarInfo->permissionList[2])
		) {//無料会員
			$permissionType = 2;
			$permissionItemId = 1;
			$permissionDiscountAmount = $seminarInfo->permissionList[$permissionType][$permissionItemId];
		}else{//有料会員
			if(array_key_exists(3, $seminarInfo->permissionList)) {
				foreach($memberPurcharsedIdList as $purcharsedId) {
					if(array_key_exists($purcharsedId, $seminarInfo->permissionList[3])) {
						if($seminarInfo->permissionList[3][$purcharsedId] > $permissionDiscountAmount){
							$permissionType = 3;
							$permissionItemId = $purcharsedId;
							$permissionDiscountAmount = $seminarInfo->permissionList[3][$purcharsedId];
						}
					}
				}
				if($permissionType === 0){
					foreach($memberPurcharsedIdList as $purcharsedId) {
						$permissionType = 3;
						$permissionItemId = $purcharsedId;
						$permissionDiscountAmount = 0;
						break;
					}
				}
			}
		}
		
		$amount = $amount - $permissionDiscountAmount;
		if($amount < 0){
			$amount = 0;
		}
		
		if($amount > 0){/* 有料ルート */
			if($pay_type == 2){/* クレカ */
				$payTypeNo = $systemInfo->getPayTypeNo($systemInfo->card_type);
			}else{
				$payTypeNo = 2;/* 銀行振込・その他請求 */
			}
		}else{/* 無料ルート */
			$payTypeNo = 1;/* 決済無し */
		}
		
		$seminarApplicantRegistInfo = new SeminarApplicantRegistInfo();
		$seminarApplicantRegistInfo->seminarId = $seminarInfo->id;
		$seminarApplicantRegistInfo->memberId = $session->getMemberId();
		$seminarApplicantRegistInfo->paymentCount = 1;
		$seminarApplicantRegistInfo->permissionType = $permissionType;
		$seminarApplicantRegistInfo->permissionItemId = $permissionItemId;
		$seminarApplicantRegistInfo->permissionDiscountAmount = $permissionDiscountAmount;
		$seminarApplicantRegistInfo->paymentType = $payTypeNo;
		$seminarApplicantRegistInfo->paymentName = "";
		$seminarApplicantRegistInfo->order_type = 2;//公開側
		
		$seminarApplicantRegistInfo = $session->getOutArgument($seminarApplicantRegistInfo);
		
		$result = $seminarApplicantRegistInfo->check();
		if(count($result) === 0) {
			$SYS_seminarApplicantId = $seminarApplicantData->regist($seminarApplicantRegistInfo);
			
			if($amount > 0 && $pay_type == 2){/* 有料ルート クレカ */
				/* クレカ決済情報登録 */
				$CreditMes = "";
				$settle_type = 2;/* 0：なし 1：サービス 2：セミナー 3：商品 4:決済リンク */
				if($systemInfo->card_type == 1){/* PAY.JP */
					$user_tkn = $session->getMemberNumber();
					$Token = isset($_POST['Token'])?$_POST['Token']:'';
					$fingerprint = isset($_POST['fingerprint'])?$_POST['fingerprint']:'';
					$cardfinger = isset($_POST['cardfinger'])?$_POST['cardfinger']:'';
					$description = $seminarInfo->name;
					$buy_id = $SYS_seminarApplicantId;
					$money = $amount;
				}else if($systemInfo->card_type == 2){/* STRIPE */
					
				}else if($systemInfo->card_type == 3){/* ROBOT PAYMENT */
					$user_tkn = $session->getMemberNumber();
					$Token = isset($_POST['Token'])?$_POST['Token']:'';
					$cardfinger = isset($_POST['cardfinger'])?intval($_POST['cardfinger']):'';
					$description = $seminarInfo->name;
					$buy_id = $SYS_seminarApplicantId;
					$money = $amount;
				}else if($systemInfo->card_type == 4){/* UNIVA PAYT */
					$user_tkn = $session->getMemberNumber();
					$Token = isset($_POST['Token'])?$_POST['Token']:'';
					$description = $seminarInfo->name;
					$buy_id = $SYS_seminarApplicantId;
				}else{
				}

require_once dirname(__FILE__).'/../payment/pay_send_payment.php';

				/* クレカ決済情報登録 */
				
				if($CreditMes == ""){
					require_once dirname(__FILE__).'/../../../../../common/inc/data/seminar_payment.php';
					$seminarPaymentData = new SeminarPaymentData("");
					$seminarPaymentInfoList = $seminarPaymentData->getInfoList($SYS_seminarApplicantId, 1);
					foreach($seminarPaymentInfoList as $pos => $seminarPaymentInfo) {
						if($seminarPaymentInfo->num !== 0){
							continue;
						}else{
							$num = $seminarPaymentInfo->num;
							$seminarPaymentInfoList[$pos]->isPaid = true;
							$seminarPaymentInfoList[$pos]->amountPaid = $amount;
							if(!@$seminarPaymentInfoList[$pos]->paymentDate->setFromStr(date("Y/m/d"))) {
							}
							break;
						}
					}
					$seminarPaymentData->update($SYS_seminarApplicantId, $seminarPaymentInfoList);
				}else{
					$seminarApplicantData->delete($seminarApplicantRegistInfo->seminarId, $SYS_seminarApplicantId);
					$sErr = $CreditMes;
				}
			}
			if($sErr == ""){
				$SYS_OrderId = sprintf("%06d",$SYS_seminarApplicantId);
				if($SYS_seminarApplicantId) {
					//セミナー申込完了
					/* セミナー購入情報 */
					if($seminarInfo->eventType === 1){
						$date = htmlspecialchars(sprintf('%04d/%02d/%02d %02d:%02d～%02d:%02d'
								, $seminarInfo->theDate->year, $seminarInfo->theDate->month, $seminarInfo->theDate->day
								, $seminarInfo->startTime->hour, $seminarInfo->startTime->minute
								, $seminarInfo->endTime->hour, $seminarInfo->endTime->minute
						));
					}else if($seminarInfo->eventType === 3){
						if(count($seminarInfo->lectureList) > 0){
							$lecTmp = "\r\n";
							foreach($seminarInfo->lectureList as $lect) {
									$lecTmp .= $lect->name.'：'. htmlspecialchars(sprintf('%04d/%02d/%02d %02d:%02d～%02d:%02d'
											, $lect->theDate->year, $lect->theDate->month, $lect->theDate->day
											, $lect->startTime->hour, $lect->startTime->minute
											, $lect->endTime->hour, $lect->endTime->minute
									));
									$lecTmp .= "\r\n";
							}
							$date = $lecTmp;
						}else{
							$date = "-";
						}
					}else{
						$date = htmlspecialchars(Util::dispLang(Language::WORD_00159));/*常時開催*/
					}
					
					require_once dirname(__FILE__).'/../../../../../common/inc/data/venue_data.php';
					$VenueData = new VenueData($session->getMemberName());
					$VenueList = $VenueData->getList();
					$mapUrl = '';
					if($seminarInfo->TypeNo == 1){
						if($seminarInfo->venue_id !== 0){
							$placeName = $VenueList[$seminarInfo->venue_id]->name;
							$placeName .= '（'.$VenueList[$seminarInfo->venue_id]->map.'）';
						}else{
							$placeName = Util::dispLang(Language::WORD_00156);/*会場未定*/
						}
					}else{
						$placeName = Util::dispLang(Language::WORD_00157);/*オンライン*/
					}
					
					$amount_str = ($amount == 0)?Util::dispLang(Language::WORD_00162)/* 無料 */:number_format($amount).Util::dispLang(Language::WORD_00161);/* 円 */

					/* 会員情報 */
					$memberData->setBaseNo(1,false);
					$memberInfo = $memberData->getInfo($session->getMemberId());

					$sendInfo = array();
					$sendInfo["ac_id"] = $memberInfo->ac_id;
					$sendInfo["name"] = $memberInfo->data['INPUT00003'];
					$sendInfo["mail"] = $memberInfo->mail;
					$sendInfo["semi_name"] = $seminarInfo->name;
					$sendInfo["semi_amount"] = $amount_str;
					$sendInfo["semi_order_id"] = $SYS_OrderId;
					
					$sendInfo["semi_place"] = $placeName;
					$sendInfo["semi_date"] = $date;
					$sendInfo["send_date"] = date("Y/m/d h:i:s");

					//セミナー単品
					$replaceCharInfoList = array(
						 '<--MAIL_ITEM_00001-->' => array('name' => '会員番号', 'replace' => '$options["ac_id"]')
						,'<--MAIL_ITEM_00002-->' => array('name' => '会員氏名', 'replace' => '$options["name"]')
						,'<--MAIL_ITEM_00003-->' => array('name' => '会員メールアドレス', 'replace' => '$options["mail"]')
						,'<--MAIL_ITEM_00004-->' => array('name' => 'セミナー名', 'replace' => '$options["semi_name"]')
						,'<--MAIL_ITEM_00005-->' => array('name' => '会場', 'replace' => '$options["semi_place"]')
						,'<--MAIL_ITEM_00006-->' => array('name' => '開催日時', 'replace' => '$options["semi_date"]')
						,'<--MAIL_ITEM_00007-->' => array('name' => '申込日時', 'replace' => '$options["send_date"]')
						,'<--MAIL_ITEM_00008-->' => array('name' => '購入金額', 'replace' => '$options["semi_amount"]')
						,'<--MAIL_ITEM_00009-->' => array('name' => 'セミナー申込番号', 'replace' => '$options["semi_order_id"]')
					);

					$toList = array($memberInfo->mail);

					/* メールテンプレート */
					require_once dirname(__FILE__).'/../../../../../common/inc/data/seminar_mail_template.php';
					$MailTemplateData = new SeminarMailTemplateData("");
					$MailTemplateInfo = $MailTemplateData->getInfo($seminarInfo->mail_tmp_id);
					$subject =  $MailTemplateInfo->name;
					$body = $MailTemplateInfo->body;
					/* メールテンプレート */

					if($MailTemplateInfo->id > 0){
						/* メール送信 */
						require_once dirname(__FILE__).'/../../../../../common/inc/util/my_mail_util.php';
						$myMailUtil = new MyMailUtil();
						$result = $myMailUtil->sendSeminar($sendInfo, $subject, $body, $replaceCharInfoList, $toList);
						if($result > 0) {
							//メール送信完了
						} else {
							$message = Util::dispLang(Language::WORD_00112).'('.$result.')';/* メールの送信に失敗しました。 */
						}
					}
				} else {
					$sErr = Util::dispLang(Language::WORD_00283);/*セミナーの申込ができませんでした*/
				}
			}
		}
	}
}
?>
