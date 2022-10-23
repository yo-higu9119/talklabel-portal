<?php
$message = '';
if(isset($_POST['Token'])){
	$CreditMes = '';
	$Token = isset($_POST['Token'])?$_POST['Token']:'';

	require_once dirname(__FILE__).'/../../../../../../common/inc/data/member_data.php';
	$memberData = new MemberData('本人');
	$memberData->setBaseNo(1,false);
	$SYS_MemInfo = $memberData->getInfo($session->getMemberId());

	require_once dirname(__FILE__).'/../../../../../../common/inc/data/roboto_payment.php';
	$robotPayment = new robotPayment($systemInfo->roboto_pay_shop_id);
	
	$uid = $session->getMemberNumber();//会員番号
	$key = '';//ユーザーキー（ユーザー登録時の戻り値）
	$em = $SYS_MemInfo->mail;//メアド
	$pn = $SYS_MemInfo->data['INPUT00005'];//電話番号
	$tkn = $Token;
	$num = '';//カード登録連番
	
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
			}else{
				$CreditMes = $result2['ec_mes'];
			}
		}
	}
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

	unset($_POST['Token']);
	if($CreditMes == ""){
		$_POST['cardfinger'] = $num;
	}

	//POSTで戻る
	$hiddenStr = "";
	foreach ($_POST as $key => $value) {
		if($key != 'mode'){
			$hiddenStr .= FormUtil::hidden($key,$value);
		}
	}

	if($CreditMes == ""){
		$tag = <<< "EOM"
<!DOCTYPE html>
<head>
<meta charset='utf-8'>
</head>
<html lang='ja'>
<body onload='document.returnForm.submit();'>
<form name='returnForm' method='post' action='{$next_url}'>
{$hiddenStr}
</form>
</body>
</html>
EOM;
		echo $tag;
		exit();
	}else{
		$message = $CreditMes;
	}
}else{
	//POSTで戻る
	$hiddenStr = "";
	foreach ($_POST as $key => $value) {
		if($key != 'mode' && $key != 'pay_type'){
			$hiddenStr .= FormUtil::hidden($key,$value);
		}
	}
}
?>