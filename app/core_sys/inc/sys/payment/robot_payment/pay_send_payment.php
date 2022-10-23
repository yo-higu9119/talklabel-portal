<?php
		require_once dirname(__FILE__).'/../../../../../../common/inc/data/roboto_payment.php';
		$robotPayment = new robotPayment($systemInfo->roboto_pay_shop_id);
		
		$uid = $session->getMemberNumber();//会員番号
		$key = '';//ユーザーキー（ユーザー登録時の戻り値）
		$em = $SYS_MemInfo->mail;//メアド
		$pn = $SYS_MemInfo->data['INPUT00005'];//電話番号
		$tkn = $Token;
		$cod = $buy_id;//購入明細番号
		$num = $cardfinger;//カード登録連番
		$am = $money;//金額
		
		/* ユーザー登録確認 */
		$result = $robotPayment->carduserSearch($uid);
		if($result['rst'] == 0){
			$CreditMes = $result['curlError'];
		}else{
			if($result['rst'] == 1){
				$key = $result['key'];/* カード登録済み */
			}else{
				if($result['ec'] == 'ER653'){//削除済み
					$CreditMes = '会員番号「'.$uid.'」は使用できません。';
				}else if($result['ec'] == 'ER147'){//カード未登録
					$CreditMes = '会員情報が確認できませんでした。';
				}else{
					$CreditMes = $result2['ec_mes'];
				}
			}
		}
		/*
		if($CreditMes == ''){
			if($key == ''){//新規ユーザー登録
				$result = $robotPayment->carduserCreate($uid,$em,$pn);
				if($result['rst'] == 0){
					$CreditMes = $result['curlError'];
				}else{
					if($result['rst'] == 1){
						$key = $result['key'];
					}else{
						if($result['ec'] == 'ER652'){//登録済み
							$result2 = $robotPayment->carduserSearch($uid);
							if($result2['rst'] == 0){
								$CreditMes = $result2['curlError'];
							}else{
								if($result2['rst'] == 1){
									$key = $result2['key'];
								}else{
									$CreditMes = $result2['ec_mes'];
								}
							}
						}else{
							$CreditMes = $result['ec_mes'];
						}
					}
				}
			}
		}
		if($CreditMes == ''){
			if($tkn !== ''){//カード登録
				$result = $robotPayment->carduserCardEntry($uid,$key,$tkn);
				if($result['rst'] == 0){
					$CreditMes = $result['curlError'];
				}else{
					if($result['rst'] == 1){
						$num = $result['num'];
					}else{
						$CreditMes = $result['ec_mes'];
					}
				}
			}
		}
		*/

		if($CreditMes == ''){
			if($num != ''){/* カード登録確認 */
				$result = $robotPayment->carduserCardGet($uid,$key,$num);
				if($result['rst'] == 0){
					$CreditMes = $result['curlError'];
				}else{
					if($result['rst'] == 1){
						$card_no = $result['cn'];
					}else{
						$CreditMes = $result['ec_mes'];
					}
				}
			}else{
				$card_no = '';
			}
		}

		$acceptid = 0;
		if($CreditMes == "" && $uid != "" && $key != "" && $num != "" && intval($money) != 0){
			$result = $robotPayment->order($cod,$uid,$key,$num,$am,$em,$pn);
			if($result['rst'] == 0){
				$CreditMes = $result['curlError'];
			}else{
				if($result['rst'] == 1){
					$acceptid = $result['gid'];
				}else{
					$CreditMes = $result['ec_mes'];
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
		$gmo_orderInfo->user_tkn = $uid;
		$gmo_orderInfo->error_result = $CreditMes;
		$gmo_orderInfo->member_id = $session->getMemberId();
		$gmo_orderInfo->member_ac_id = $session->getMemberNumber();
		$gmo_orderInfo->card_id = $num;
		$gmo_orderInfo->fingerprint = '';
		$gmo_orderInfo->card_no = $card_no;
		$gmo_orderInfo->payment_agency = 3;

		$res = $gmo_order->insert($gmo_orderInfo);
		if($res !== 0){
			$gmo_orderInfo->id = $res;
		}else{
			$CreditMes = "カード情報の確認に失敗しました。";
		}
?>