<?php
		require_once '/var/www/univapay/vendor/autoload.php';
		$pk = $systemInfo->getPkKey();
		$sk = $systemInfo->getSkKey();
		
		$card_id = "";
		try {
			$client = new Univapay\UnivapayClient(Univapay\Resources\Authentication\AppJWT::createToken($pk, $sk));
			$card_id = $Token;
		} catch (Exception $e) {
			$CreditMes = 'カード情報が正しくないか、使用できないカードです。';
			if(isset($e->errors[0])){
				$CreditMes .= '  '.$e->code.'('.implode(',',$e->errors[0]).')';
			}
		}

		$card_no = "";
		if($CreditMes == ''){
			try {
				$tokenInfo = $client->getTransactionToken($Token);
				$card_no = $tokenInfo->data->card->lastFour;
			} catch (Exception $e) {
			}
		}

		if(isset($authori_type)){
			$capture = ($authori_type == 2)?true:false;
		}else{
			$capture = true;
		}

		$acceptid = 0;
		if($CreditMes == "" && $card_id != ""){
			if(intval($money) != 0){
				try {
					$meta = array(
						"customer_id" => $user_tkn,
						"shipping_details" => $description
					);
					$charge = $client->createCharge($card_id, Money\Money::JPY($money),$capture,null,$meta)->awaitResult();
					$acceptid = $charge->id;
				} catch (Exception $e) {
					$CreditMes = 'カード情報が正しくないか、使用できないカードです。';
					if(isset($e->errors[0])){
						$CreditMes .= '  '.$e->code.'('.implode(',',$e->errors[0]).')';
					}
				}
			}
		}

		require_once dirname(__FILE__).'/../../../../../../common/inc/data/gmo_credit.php';

		$gmo_order = new gmo_order($session->getMemberName());
		$gmo_orderInfo = new gmo_orderInfo();
		$gmo_orderInfo->authori_type = 'payment';
		$gmo_orderInfo->settle_type = $settle_type;/* 0：なし 1：サービス 2：セミナー 3：商品 4:決済リンク */
		$gmo_orderInfo->settle_id = $buy_id;/* 決済対象ID */
		$gmo_orderInfo->order_id = 0;
		$gmo_orderInfo->acceptid = $acceptid;
		$gmo_orderInfo->user_tkn = $user_tkn;
		$gmo_orderInfo->error_result = $CreditMes;
		$gmo_orderInfo->member_id = $session->getMemberId();
		$gmo_orderInfo->member_ac_id = $session->getMemberNumber();
		$gmo_orderInfo->card_id = $card_id;
		$gmo_orderInfo->fingerprint  = '';
		$gmo_orderInfo->card_no =$card_no;
		$gmo_orderInfo->payment_agency = 4;
		$gmo_orderInfo->authori_type_no = ($capture)?2:1;

		$res = $gmo_order->insert($gmo_orderInfo);
		if($res !== 0){
			$gmo_orderInfo->id = $res;
		}else{
			$CreditMes = "カード情報の確認に失敗しました。";
		}
?>