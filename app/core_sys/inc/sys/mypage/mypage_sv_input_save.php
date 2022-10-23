<?php
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();

$sErr = "";
$itemId = 0;
if(isset($_POST['id']) && is_numeric($_POST['id'])){
	$itemId = intval($_POST['id']);
}
$itemInfo = $itemData->getInfo($itemId);
if($itemInfo->id === 0 || $itemData->getIsOrder($session->getMemberId(),$itemId) > 0){
	header('HTTP/1.0 404 Not Found');
	exit();
}

if($itemInfo->plan_behavior == 2){

}

if($itemInfo->type === 1){/* 1:都度 */
	$money = $itemInfo->money;
}else if($itemInfo->type === 2){/* 2:継続 */
	if($itemInfo->pay_timing === 1){/* 即時課金 */
		$money = $itemInfo->money;
	}else if($itemInfo->pay_timing === 2){/* 申込月無料 */
		$money = $itemInfo->init_money;
	}
}else if($itemInfo->type === 3){/* 3:分割 */
	$money = $itemInfo->spl[0];
}


if(isset($_POST['pay_type']) && (intval($_POST['pay_type']) == 1 || intval($_POST['pay_type']) == 2)){
	$pay_type = intval($_POST['pay_type']);
}else{
	header('HTTP/1.0 404 Not Found');
	exit();
}

if($pay_type == 2){
	if($systemInfo->card_type == 1 && isset($_POST['cardfinger']) && $_POST['cardfinger'] !== ''){
	}else if($systemInfo->card_type == 1 && isset($_POST['fingerprint']) && $_POST['fingerprint'] !== '' && isset($_POST['Token']) && $_POST['Token'] !== ''){
	}else if($systemInfo->card_type == 3 && isset($_POST['cardfinger']) && $_POST['cardfinger'] !== ''){
	}else{
		header('HTTP/1.0 404 Not Found');
		exit();
	}
}

if($money > 0){/* 有料ルート */
	if($pay_type == 2){/* クレカ */
		$payTypeNo = $systemInfo->getPayTypeNo($systemInfo->card_type);
	}else{
		$payTypeNo = 2;/* 銀行振込・その他請求 */
	}
}else{/* 無料ルート */
	$payTypeNo = 1;/* 決済無し */
}

require_once dirname(__FILE__).'/../../../../../common/inc/data/member_data.php';
$memberData = new MemberData('本人');
$memberData->setBaseNo(1,false);
$SYS_MemInfo = $memberData->getInfo($session->getMemberId());

$PurInfo = new PurchaseInfo();
$PurInfo->mem_id = $SYS_MemInfo->id;
$PurInfo->item_id = $itemInfo->id;
$PurInfo->plan_id = $itemInfo->plan_id;
$PurInfo->ac_id = $SYS_MemInfo->ac_id;
$PurInfo->pay_type = $payTypeNo;

$PurInfo->id = $purchaseData->insert($PurInfo);
if($PurInfo->id !== 0){
	$SYS_OrderId = sprintf("%06d",$PurInfo->id);
	if($pay_type == 2){
		/* クレカ決済情報登録 */
		$CreditMes = "";
		$settle_type = 1;/* 0：なし 1：サービス 2：セミナー 3：商品 4:決済リンク */
		if($systemInfo->card_type == 1){/* PAY.JP */
			$user_tkn = $session->getMemberNumber();
			$Token = isset($_POST['Token'])?$_POST['Token']:'';
			$fingerprint = isset($_POST['fingerprint'])?$_POST['fingerprint']:'';
			$cardfinger = isset($_POST['cardfinger'])?$_POST['cardfinger']:'';
			$description = $itemInfo->name;
			$buy_id = $PurInfo->id;
		}else if($systemInfo->card_type == 2){/* STRIPE */
			
		}else if($systemInfo->card_type == 3){/* ROBOT PAYMENT */
			$user_tkn = $session->getMemberNumber();
			$Token = isset($_POST['Token'])?$_POST['Token']:'';
			$cardfinger = isset($_POST['cardfinger'])?intval($_POST['cardfinger']):'';
			$description = $itemInfo->name;
			$buy_id = $PurInfo->id;
		}else{
		}

require_once dirname(__FILE__).'/../payment/pay_send_payment.php';

		/* クレカ決済情報登録 */
		if($CreditMes !== ""){
			$purchaseData->delete($PurInfo->id);
			$sErr = $CreditMes;
		}
	}

	if($sErr == ""){
		if($itemInfo->type === 1){/* 1:都度 */
			$purchaseChInfo = new PurchaseChInfo();
			$purchaseChInfo->par_id = $PurInfo->id;
			$purchaseChInfo->mem_id = $PurInfo->mem_id;
			$purchaseChInfo->item_id = $PurInfo->item_id;
			$purchaseChInfo->split = 0;
			$purchaseChInfo->claim_money = $itemInfo->money;
			if($pay_type == 1 || $CreditMes != ""){
				$purchaseChInfo->set = 0;
				$purchaseChInfo->pay_money = 0;
			}else{
				$purchaseChInfo->set = 1;
				$purchaseChInfo->pay_money = $itemInfo->money;
			}
			$purchaseChInfo->pay_type  = $PurInfo->pay_type;
			$purchaseChInfo->retry = 1;
			$purchaseChInfo->pay_date = date("Y/m/d H:i:s");

			$pch = $purchaseChData->insert($purchaseChInfo);
		}else if($itemInfo->type === 2){/* 2:継続 */
			if($itemInfo->pay_timing === 1){/* 即時課金 */
				$purchaseChInfo = new PurchaseChInfo();
				$purchaseChInfo->par_id = $PurInfo->id;
				$purchaseChInfo->mem_id = $PurInfo->mem_id;
				$purchaseChInfo->item_id = $PurInfo->item_id;
				$purchaseChInfo->split = 0;
				$purchaseChInfo->claim_money = $itemInfo->money;
				if($pay_type == 1 || $CreditMes != ""){
					$purchaseChInfo->set = 0;
					$purchaseChInfo->pay_money = 0;
				}else{
					$purchaseChInfo->set = 1;
					$purchaseChInfo->pay_money = $itemInfo->money;
				}
				$purchaseChInfo->pay_type  = $PurInfo->pay_type;
				$purchaseChInfo->retry = 1;
				$purchaseChInfo->pay_date = date("Y/m/d H:i:s");

				$pch = $purchaseChData->insert($purchaseChInfo);
			}else if($itemInfo->pay_timing === 2){/* 申込月無料 */
				/* 初回（手数料） */
				$purchaseChInfo = new PurchaseChInfo();
				$purchaseChInfo->par_id = $PurInfo->id;
				$purchaseChInfo->mem_id = $PurInfo->mem_id;
				$purchaseChInfo->item_id = $PurInfo->item_id;
				$purchaseChInfo->split = 0;
				$purchaseChInfo->claim_money = $itemInfo->init_money;
				if($pay_type == 1 || $CreditMes != ""){
					$purchaseChInfo->set = 0;
					$purchaseChInfo->pay_money = 0;
				}else{
					$purchaseChInfo->set = 1;
					$purchaseChInfo->pay_money = $itemInfo->init_money;
				}
				$purchaseChInfo->pay_type  = $PurInfo->pay_type;
				$purchaseChInfo->retry = 1;
				$purchaseChInfo->pay_date = date("Y/m/d H:i:s");

				$pch = $purchaseChData->insert($purchaseChInfo);

				/* 指定月数無料 */
				$last_days = 1;//〆日
				$now_day = intval(date("d"));
				for($i=1;$i<=$itemInfo->split;$i++){
					$purchaseChInfo = new PurchaseChInfo();
					$purchaseChInfo->par_id = $PurInfo->id;
					$purchaseChInfo->mem_id = $PurInfo->mem_id;
					$purchaseChInfo->item_id = $PurInfo->item_id;
					$purchaseChInfo->split = $i;
					$purchaseChInfo->claim_money = 0;
					$purchaseChInfo->pay_type  = $PurInfo->pay_type;
					$purchaseChInfo->retry = 1;
					$purchaseChInfo->pay_money = 0;
					$purchaseChInfo->set = 1;
					if($i == 1){
						/* 申込翌月を１回目の場合 */
						//if($now_day < $last_days){
						//	$add_month_num = 0;
						//	$add_month = "";
						//}else{
						//	$add_month_num = 1;
						//	$add_month = " +{$add_month_num} month";
						//}
						/* 申込翌月を１回目の場合 */
						/* 申込当月を１回目の場合 */
						$add_month_num = 0;
						$add_month = "";
						/* 申込当月を１回目の場合 */
						$purchaseChInfo->pay_date = date("Y/m/{$last_days} 00:00:00",strtotime(date("Y/m/{$last_days}").$add_month));
						$pch = $purchaseChData->insert($purchaseChInfo);
					}else{
						$add_month_num++;
						$add_month = " +{$add_month_num} month";
						$purchaseChInfo->pay_date = date("Y/m/{$last_days} 00:00:00",strtotime(date("Y/m/{$last_days}").$add_month));
						$pch = $purchaseChData->insert($purchaseChInfo);
					}
				}
			}
		}else if($itemInfo->type === 3){/* 3:分割 */
			for($i=0;$i<=$itemInfo->split;$i++){
				$purchaseChInfo = new PurchaseChInfo();
				$purchaseChInfo->par_id = $PurInfo->id;
				$purchaseChInfo->mem_id = $PurInfo->mem_id;
				$purchaseChInfo->item_id = $PurInfo->item_id;
				$purchaseChInfo->split = $i;
				$purchaseChInfo->claim_money = $itemInfo->spl[$i];
				$purchaseChInfo->pay_type  = $PurInfo->pay_type;
				$purchaseChInfo->retry = 1;
				if($i == 0){
					if($pay_type == 1 || $CreditMes != ""){
						$purchaseChInfo->set = 0;
						$purchaseChInfo->pay_money = 0;
					}else{
						$purchaseChInfo->set = 1;
						$purchaseChInfo->pay_money = $itemInfo->spl[$i];
					}
					$purchaseChInfo->pay_date = date("Y/m/d H:i:s");
				}else{
					$purchaseChInfo->pay_money = 0;
					$purchaseChInfo->set = 0;
					if($i == 1){
						$now_day = intval(date("d"));
						if($now_day < 1){
							$add_month_num = 0;
							$add_month = "";
						}else{
							$add_month_num = 1;
							$add_month = " +{$add_month_num} month";
						}
					}else{
						$add_month_num++;
						$add_month = " +{$add_month_num} month";
					}
					$purchaseChInfo->pay_date = date("Y/m/1 00:00:00",strtotime(date("Y/m/1").$add_month));
				}

				$pch = $purchaseChData->insert($purchaseChInfo);
			}
		}

		if($itemInfo->use_mail !== 0){
			require_once dirname(__FILE__).'/../../../../../common/inc/data/service_mail_template.php';
			$ServiceMailTemplateData = new ServiceMailTemplateData("");
			$ServiceMailTemplateInfo = $ServiceMailTemplateData->getInfo($itemInfo->use_mail);
			if($ServiceMailTemplateInfo->id !== 0){
				$replaceCharInfoList = $ServiceMailTemplateInfo->getReplaceCharInfo();

				$sendInfo = array();
				$sendInfo["ac_id"] = $SYS_MemInfo->ac_id;//会員番号
				$sendInfo["mail"] = $SYS_MemInfo->mail;//会員メールアドレス
				$sendInfo["name"] = $SYS_MemInfo->data['INPUT00003'];//氏名
				$sendInfo["service_name"] = $itemInfo->name;//購入サービス名
				$sendInfo["no"] = $SYS_OrderId;//請求番号
				$sendInfo["date"] = date("Y/m/d h:i:s");//購入日時
				$sendInfo["way"] = 2;//決済方法
				//決済種別
				if($itemInfo->type == 1){
					$sendInfo["type"] = '都度';
					$sendInfo["count"] =0;//支払回数
					$sendInfo["amount"] = $itemInfo->money;//請求額
				}else if($itemInfo->type == 2){
					$sendInfo["type"] = '継続';
					$sendInfo["count"] =0;//支払回数
					$sendInfo["amount"] = $itemInfo->money;//請求額
				}else if($itemInfo->type == 3){
					$sendInfo["type"] = '分割';
					$sendInfo["count"] = $itemInfo->split;//支払回数
					if($pay_type == 1 || $CreditMes != ""){
						$sendInfo["amount"] = $itemInfo->spl[0] + $itemInfo->spl[1];//請求額
					}else{
						$sendInfo["amount"] = $itemInfo->spl[1];//請求額
					}
				}else if($itemInfo->type == 4){
					$sendInfo["type"] = '都度';
					$sendInfo["count"] =0;//支払回数
					$sendInfo["amount"] = $itemInfo->money;//請求額
				}else if($itemInfo->type == 5){
					$sendInfo["type"] = '分割';
					$sendInfo["count"] =$itemInfo->split;//支払回数
					if($pay_type == 1 || $CreditMes != ""){
						$sendInfo["amount"] = $itemInfo->spl[0] + $itemInfo->spl[1];//請求額
					}else{
						$sendInfo["amount"] = $itemInfo->spl[1];//請求額
					}
				}

				$toList = array($SYS_MemInfo->mail);
				$subject =  $ServiceMailTemplateInfo->name;
				$body =  $ServiceMailTemplateInfo->body;

				/* メール送信 */
				require_once dirname(__FILE__).'/../../../../../common/inc/util/my_mail_util.php';
				$myMailUtil = new MyMailUtil();
				$result = $myMailUtil->sendSeminar($sendInfo, $subject, $body, $replaceCharInfoList, $toList);
				if($result > 0) {
					//メール送信完了
				} else {
					$sErr = 'メールの送信に失敗しました。('.$result.')';
				}
			}
		}
	}
}else{
	$sErr = '決済に失敗しました';
}

if($sErr == ""){
	$sErr = 'サービスの申込が完了いたしました。';
}
?>
