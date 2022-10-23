<?php
		require_once '/var/www/pay_jp/init.php';
		Payjp\Payjp::setApiKey($systemInfo->getSkKey());

		if($cardfinger == ''){
			$param = array(
				 "email" => $SYS_MemInfo->mail
				,"id" => $user_tkn
			);
			try {
				$result = \Payjp\Customer::create($param);
				$user_tkn = $result->id;
			} catch (Exception $e) {
				if(isset($e->jsonBody["error"])){
					if($e->jsonBody["error"]["code"] == "already_exist_id"){
						//DBから顧客IDを取得
						$user_tkn = $user_tkn;
					}else{
						$CreditMes = $e->jsonBody["error"]["code"];
					}
				}else{
					$CreditMes = "情報が取得できないエラー";
				}
			}
			$card_id = "";
			$card_fingerprint = "";
			$card_no = "";
			if($CreditMes == "" && $user_tkn != ""){
				$cu = \Payjp\Customer::retrieve($user_tkn);
				try {
					$result = $cu->cards->create(array("card" => $Token));
					$card_id = $result->id;
					$card_fingerprint = $result->fingerprint;
					$card_no = $result->last4;
				} catch (Exception $e) {
					if(isset($e->jsonBody["error"])){
						if($e->jsonBody["error"]["code"] == "already_have_card"){
							//pay.jpからカードIDを取得
							try {
								$result = \Payjp\Customer::retrieve($user_tkn)->cards->all(array("limit"=>10, "offset"=>0));
								foreach ($result->data as $key => $value){
									if($value->fingerprint == $fingerprint){
										$card_id = $value->id;
										$card_fingerprint = $value->fingerprint;
										$card_no = $value->last4;
									}
								}
								if($card_id == ""){
									$CreditMes = "カード情報が取得できません";
								}
							} catch (Exception $e) {
								if(isset($e->jsonBody["error"])){
									$CreditMes = $e->jsonBody["error"]["code"];
								}else{
									$CreditMes = "情報が取得できないエラー";
								}
							}
						}else{
							$CreditMes = $e->jsonBody["error"]["code"];
						}
					}else{
						$CreditMes = "情報が取得できないエラー";
					}
				}
			}
		}else{
			//pay.jpからカードIDを取得
			$user_tkn = $user_tkn;
			try {
				$result = \Payjp\Customer::retrieve($user_tkn)->cards->all(array("limit"=>10, "offset"=>0));
				foreach ($result->data as $key => $value){
					if($value->fingerprint == $cardfinger){
						$card_id = $value->id;
						$card_fingerprint = $value->fingerprint;
						$card_no = $value->last4;
					}
				}
				if($card_id == ""){
					$CreditMes = "カード情報が取得できません";
				}
			} catch (Exception $e) {
				if(isset($e->jsonBody["error"])){
					$CreditMes = $e->jsonBody["error"]["code"];
				}else{
					$CreditMes = "情報が取得できないエラー";
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
		$gmo_orderInfo->acceptid = 0;
		$gmo_orderInfo->user_tkn = $user_tkn;
		$gmo_orderInfo->error_result = $CreditMes;
		$gmo_orderInfo->member_id = $session->getMemberId();
		$gmo_orderInfo->member_ac_id = $session->getMemberNumber();
		$gmo_orderInfo->card_id = $card_id;
		$gmo_orderInfo->fingerprint  = $card_fingerprint;
		$gmo_orderInfo->card_no = $card_no;
		$gmo_orderInfo->payment_agency = 1;
		$gmo_orderInfo->authori_type_no = 0;

		$res = $gmo_order->insert($gmo_orderInfo);
		if($res !== 0){
			$gmo_orderInfo->id = $res;
		}else{
			$CreditMes = "カード情報の確認に失敗しました。";
		}
?>