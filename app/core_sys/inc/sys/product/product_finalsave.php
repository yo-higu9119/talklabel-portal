<?php
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();

$productData = new ProductData('会員本人');
$productApplicantData = new ProductApplicantData('会員本人');
$productPackageData = new ProductPackageData('会員本人');

require_once dirname(__FILE__).'/../../../../../common/inc/data/product_system_info.php';
$productSystemData = new ProductSystemData('');
$productSystemInfo = $productSystemData->getInfo();

$sErr = "";
$message = "";
$SYS_OrderId = "";
$group_id = 0;
$total_amount = 0;
$result = array();
$pay_type = null;
$token = "";
$cardfinger = "";
$remarks = '';

if(isset($_POST['delivery_address_id'])){
	$delivery_address_id = intval($_POST['delivery_address_id']);
}else{
	$delivery_address_id = 0;
}

$cart_name = 'app_cart';
$cart_name_op = $cart_name.'_pro_op';
$cart_name_caop = $cart_name.'_op';

$cart_op_list = isset($_SESSION[$cart_name.'_pro_op'])?$_SESSION[$cart_name.'_pro_op']:array();
$cart_caop_list = isset($_SESSION[$cart_name.'_op'])?$_SESSION[$cart_name.'_op']:array();

if(isset($_SESSION[$cart_name]) && is_array($_SESSION[$cart_name])){
	if(count($_SESSION[$cart_name]) > 0){
		$searchInfoList = array();
		$searchInfoList['search_id'] = array_keys($_SESSION[$cart_name]);
		$searchInfoList['search_is_disp'] = true;
		$list = $productData->getInfoList($searchInfoList, 1);
		if(count($list) !== 0){
			foreach($list as $productInfo){
				if($productInfo->stock_type == 1){
					$rest = max($productInfo->capacity-$productInfo->applicant, 0);
				}else{
					$rest = 99;
				}
				if($rest <= 0){
					$sErr = "選択された商品の在庫が無くなりました。";
					break;
				}
			}
		}else{
			$sErr = "購入商品情報が取得できません。。";
		}
	}else{
		$sErr = "購入済みか、F5キーが押下されました。";
	}
}else{
	$sErr = "購入商品が選択されておりません。";
}

if($sErr == ""){
	foreach($list as $productInfo){
		$total_amount += intval($productInfo->dispAmount);
		if($group_id == 0){
			$group_id = $productInfo->category_group_id;
		}
		if($productInfo->category_group_id !== $group_id){
			$sErr = "購入商品の商品グループが違うものが含まれています。";
			break;
		}
	}
}

if($sErr == ""){
	require_once dirname(__FILE__).'/../../../../../common/inc/data/product_category_group.php';
	$productCategoryGroupData = new ProductCategoryGroupData('');
	$productCategoryGroupInfo = $productCategoryGroupData->getInfo($group_id);
}

if($sErr == ""){
	if(!$session->isLogin()){
		$sErr = "会員情報が取得できません。";
	}else{
		$masterBaseData = new MasterBaseData('');
		$memberData = new MemberData('会員本人');
		$memberData->setBaseNo(1);
		$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
	}
}

if($sErr == ""){
	if(isset($_POST['delivery_address_id']) && intval($_POST['delivery_address_id']) > 0) {
		$addressData = new DeliveryAddressData('');
		$addressInfo = $addressData->getInfo(intval($_POST['delivery_address_id']));
		if($addressInfo->id > 0) {
		} else {
			$sErr = '配送先が取得できません。';
		}
	}else{
		$sErr = '配送先が取得できません。';
	}
}

$delivery_ship = 0;
$delivery_wait_time = 0;
$is_area = false;

if($sErr == ""){
	if($productCategoryGroupInfo->id == 0){
		$sErr = 'カテゴリグループが見つかりません。';
	}else{
		if($productCategoryGroupInfo->sale_type == 1){/* 配送 */
			
		}else if($productCategoryGroupInfo->sale_type == 2){/* オンライン */
			
		}else if($productCategoryGroupInfo->sale_type == 3){/* デリバリー */
			if($productSystemInfo->delivery_setting == 1){
				$delivery_ship = $productSystemInfo->delivery_shipping;
			}else{
				foreach ($productSystemInfo->delivery_area as $key => $val){
					if($val->status == 0 && $val->zip == $addressInfo->zip){
						$delivery_ship = $val->shipping;
						$delivery_wait_time = $val->wait_time;
						$is_area = true;
						break;
					}
				}
				if(!$is_area){
					$sErr = '配送先が設定されていないか、配送エリア範囲外です。';
				}
			}
		}
	}
}

if($sErr == ""){
	if(isset($_POST['delivery_type']) && intval($_POST['delivery_type']) > 0) {
		$delivery_type = intval($_POST['delivery_type']);
		$deli_list = array();
		if($delivery_type == 1) {
		}else if($delivery_type == 2) {
			for($i=1;$i<=3;$i++){
				$year = 0;
				$month = 0;
				$day = 0;
				$deli_day = $_POST['deli_day'.$i];
				$deli_h = $_POST['deli_h'.$i];
				$deli_m = $_POST['deli_m'.$i];
				if($i == 1){
					if($deli_day == "" || $deli_h == "" || $deli_m == ""){
						$result['deli'.$i] = "必須です";
					}else{
						$dateTmp = explode('/', $deli_day, 3);
						if(isset($dateTmp[0])) {
							$year = $dateTmp[0];
						}
						if(isset($dateTmp[1])) {
							$month = $dateTmp[1];
						}
						if(isset($dateTmp[2])) {
							$day = $dateTmp[2];
						}
						if(checkdate($month, $day, $year)){
							if(is_numeric($deli_h)
							&& is_numeric($deli_m)) {
								if($deli_h >= 0 && $deli_h <= 23
								&& $deli_m >= 0 && $deli_m <= 59) {
									$datetime = sprintf("%d/%d/%d %d:%d:00",$year,$month,$day,$deli_h,$deli_m);
									if($delivery_wait_time == 0){
										$addtime = "now";
									}else{
										$addtime = "+ ".$delivery_wait_time." minute";
									}
									if(strtotime($addtime) > strtotime($datetime)){
										$datetime = date("Y年m月d日H時i分",strtotime($addtime));
										$result['deli'.$i] = $datetime."より後の日時で入力してください。";
									}else{
										$deli_list[$i] = date("Y/m/d H:i:00.0",strtotime($datetime));
									}
								} else {
									$result['deli'.$i] = "不正な時刻です。";
								}
							}else{
								$result['deli'.$i] = "不正な時刻です。";
							}
						}else{
							$result['deli'.$i] = "不正な日付です。";
						}
					}
				}else{
					if($deli_day != "" || $deli_h != "" || $deli_m != ""){
						if($deli_day == "" || $deli_h == "" || $deli_m == ""){
							$result['deli'.$i] = "正しい日時を入力してください";
						}else{
							$dateTmp = explode('/', $deli_day, 3);
							if(isset($dateTmp[0])) {
								$year = $dateTmp[0];
							}
							if(isset($dateTmp[1])) {
								$month = $dateTmp[1];
							}
							if(isset($dateTmp[2])) {
								$day = $dateTmp[2];
							}
							if(checkdate($month, $day, $year)){
								if(is_numeric($deli_h)
								&& is_numeric($deli_m)) {
									if($deli_h >= 0 && $deli_h <= 23
									&& $deli_m >= 0 && $deli_m <= 59) {
										$datetime = sprintf("%d/%d/%d %d:%d:00",$year,$month,$day,$deli_h,$deli_m);
										if($delivery_wait_time == 0){
											$addtime = "now";
										}else{
											$addtime = "+ ".$delivery_wait_time." minute";
										}
										if(strtotime($addtime) > strtotime($datetime)){
											$datetime = date("Y年m月d日H時i分",strtotime($addtime));
											$result['deli'.$i] = $datetime."より後の日時で入力してください。";
										}else{
											$deli_list[$i] = date("Y/m/d H:i:00.0",strtotime($datetime));
										}
									} else {
										$result['deli'.$i] = "不正な時刻です。";
									}
								}else{
									$result['deli'.$i] = "不正な時刻です。";
								}
							}else{
								$result['deli'.$i] = "不正な日付です。";
							}
						}
					}
				}
			}
			if(count($result) > 0){
				$sErr = '配送希望日時情報が取得できません。';
			}
		}else{
			$sErr = '配送希望日時情報が取得できません。';
		}
	}else{
		$sErr = '配送希望日時情報が取得できません。';
	}
}

if($total_amount > 0){
	if(isset($_POST['pay_type']) && intval($_POST['pay_type']) >= 0) {
		$pay_type = intval($_POST['pay_type']);
		if($pay_type == 0 || $pay_type == 1 || $pay_type == 2){
			if($pay_type == 2){
				if($systemInfo->card_type == 1 && isset($_POST['cardfinger']) && $_POST['cardfinger'] !== ''){
				}else if($systemInfo->card_type == 1 && isset($_POST['fingerprint']) && $_POST['fingerprint'] !== '' && isset($_POST['Token']) && $_POST['Token'] !== ''){
				}else if($systemInfo->card_type == 3 && isset($_POST['cardfinger']) && $_POST['cardfinger'] !== ''){
				}else if($systemInfo->card_type == 4 && isset($_POST['Token']) && $_POST['Token'] !== ''){
				}else{
					$sErr = '決済情報が取得できません。';
				}
			}
		}else{
			$sErr = '決済情報が取得できません。';
		}
	}else{
		$sErr = '決済情報が取得できません。';
	}
}

if(isset($_POST['remarks']) && trim($_POST['remarks']) != "") {
	$remarks = trim($_POST['remarks']);
}

if($sErr == ""){
	$packageInfo = $productPackageData->getInfo(0);
	$packageInfo->puroduct_list = $_SESSION[$cart_name];
	$packageInfo->delivery_address_id = $delivery_address_id;
	$packageInfo->member_id = $SYS_MemInfo->id;
	$packageInfo->delivery_request = $delivery_type;
	$packageInfo->delivery_date1->setFromStr(isset($deli_list[1])?$deli_list[1]:"");
	$packageInfo->delivery_date2->setFromStr(isset($deli_list[2])?$deli_list[2]:"");
	$packageInfo->delivery_date3->setFromStr(isset($deli_list[3])?$deli_list[3]:"");
	$packageInfo->remarks = $remarks;
	$packageInfo->sale_type = $productCategoryGroupInfo->sale_type;
	$packageInfo->payment_type = 0;//決済種別 0:決済無し 1:銀行振込 2:クレカ 3:代金引換
	
	if($total_amount > 0){
		if($pay_type == 0){//0:代金引換
			$packageInfo->payment_type = 3;
		}else if($pay_type == 1){//1:銀行振込
			$packageInfo->payment_type = 1;
		}else if($pay_type == 2){//2:クレカ
			$packageInfo->payment_type = 2;
			$packageInfo->credit_type = $systemInfo->card_type;
		}else{//決済無し
			$packageInfo->payment_type = 0;
		}
	}
	
	$result = $packageInfo->cart_check();
	if(count($result) == 0){
		$productData = new ProductData('会員本人');
		$searchInfoList = array();
		$searchInfoList['search_id'] = array_keys($packageInfo->puroduct_list);
		$list = $productData->getInfoList($searchInfoList, 1);
		
		$amount = 0;/* 合計金額 */
		$tax1 = 0;/* 税金用合計金額 */
		$tax2 = 0;/* 税金用合計金額 */
		$post = false;/* 宅配 */
		$mail = false;/* メール便 */
		$delivery = false;/* デリバリー */
		
		$productOptionData = new ProductOptionData('会員本人');
		$optionList = $productOptionData->getList();
		
		$productCartOptionData = new ProductCartOptionData('会員本人');
		$cartOptionList = $productCartOptionData->getList();
		
		foreach($list as $proInfo){
			$amount += $proInfo->dispAmount * $packageInfo->puroduct_list[$proInfo->id];
			$op_tax = 0;
			foreach ($proInfo->option_list as $op){
				if(array_key_exists($op,$optionList) && $optionList[$op]->status == 0){
					$op_amount = $optionList[$op]->amount;
					if(array_key_exists($proInfo->id,$cart_op_list)){
						if(array_key_exists($optionList[$op]->id,$cart_op_list[$proInfo->id])){
							$op_num = intval($cart_op_list[$proInfo->id][$optionList[$op]->id]);
						}else{
							$op_num = 0;
						}
					}else{
						$op_num = 0;
					}
					$op_amount = $op_amount * $op_num;
					$op_tax += $op_amount;
					$amount += $op_amount;
				}
			}
			if($proInfo->tax_type == 1){
				$tax1 += $proInfo->dispAmount * $packageInfo->puroduct_list[$proInfo->id] + $op_tax;
			}else{
				$tax2 += $proInfo->dispAmount * $packageInfo->puroduct_list[$proInfo->id] + $op_tax;
			}
			if($proInfo->TypeNo == 1){/* 配送 */
				if($proInfo->delivery_type == 1){/* 宅配 */
					$post = true;
					/* 配送方法処理は保留 */
				}else if($proInfo->delivery_type == 2){/* メール便 */
					$mail = true;
				}
			}else if($proInfo->TypeNo == 2){/* オンライン */
				
			}else if($proInfo->TypeNo == 3){/* デリバリー */
				$delivery = true;
			}
		}
		/* カートオプション */
		foreach ($cartOptionList as $key => $val){
			if($val->status !== 0)continue;
			$cart_op_amount = number_format($val->amount);
			$cart_op_num = (array_key_exists($val->id,$cart_caop_list))?intval($cart_caop_list[$val->id]):0;
			$amount += $cart_op_amount * $cart_op_num;
		}
		/* 消費税 */
		$taxMasterData = new TaxMasterData('');
		$taxInfo = $taxMasterData->getInfo();
		$tax1 = round($tax1 * $taxInfo->tax1 / 100);
		$tax2 = round($tax2 * $taxInfo->tax2 / 100);
		/* 消費税 */
		/* 各種手数料 */
		$productSystemData = new ProductSystemData('');
		$productSystemInfo = $productSystemData->getInfo();
		
		$post_str = 0;
		$mail_str = 0;
		$delivery_str = 0;
		if($post){
			$post_str = $productSystemInfo->shipping;//宅配
		}
		if($mail){
			$mail_str = $productSystemInfo->mail_service_shipping;//メール便
		}
		if($delivery){
			$delivery_str = $delivery_ship;//デリバリー
		}
		
		$free_limit = 0;
		if($productSystemInfo->free_shipping_setting == 1){
			$free_limit = $productSystemInfo->free_limit;
			if(($free_limit-$amount) < 0){
				$free_limit = 0;
			}else{
				$free_limit = $free_limit-$amount;
			}
			if($free_limit <= 0){
				$post_str = 0;//宅配
				$mail_str = 0;//メール便
				$delivery_str = 0;//デリバリー
			}
		}
		
		$total_amount = $amount+$post_str+$mail_str+$delivery_str;

		$ajast = $packageInfo->adjust_amount;
		if(($total_amount + $ajast) <= 0){
			$ajast = $total_amount * -1;
			$packageInfo->adjust_amount = $ajast;
			$total_amount = 0;
		}else{
			$total_amount = $total_amount + $ajast;
		}
		
		/* 各種手数料 */
		$packageInfo->total_amount = $total_amount;//合計金額
		$packageInfo->shipping_amount = $delivery_str;//配送料
		$packageInfo->tax1 = $tax1;//軽減税率
		$packageInfo->tax2 = $tax2;//標準税率
		
		$packageInfo->cart_option_list = array();
		if(is_array($cart_caop_list) && count($cart_caop_list) > 0){
			$packageInfo->cart_option_list = $cart_caop_list;
		}
				
		$packageInfo->pro_option_list = array();
		if(is_array($cart_op_list) && count($cart_op_list) > 0){
			$packageInfo->pro_option_list = $cart_op_list;
		}
		
		$productApplicantIdList = array();
		
		foreach($list as $proInfo){
			for($i=1;$i<=$packageInfo->puroduct_list[$proInfo->id];$i++){
				$permissionType = 2;
				$permissionItemId = 1;
				$permissionDiscountAmount = $proInfo->dispAmount;

				$productApplicantRegistInfo = new ProductApplicantRegistInfo();
				$productApplicantRegistInfo->productId = $proInfo->id;
				$productApplicantRegistInfo->memberId = $packageInfo->member_id;
				$productApplicantRegistInfo->paymentCount = 1;
				$productApplicantRegistInfo->permissionType = $permissionType;
				$productApplicantRegistInfo->permissionItemId = $permissionItemId;
				$productApplicantRegistInfo->permissionDiscountAmount = $permissionDiscountAmount;
				$productApplicantRegistInfo->paymentType = 1;
				$productApplicantRegistInfo->paymentName = '';
				$result = $productApplicantRegistInfo->check();
				
				if(count($result) === 0 && (($proInfo->stock_type == 1 && max($proInfo->capacity-$proInfo->applicant, 0) > 0 && (max($proInfo->capacity-$proInfo->applicant, 0)-1) > 0) || $proInfo->stock_type == 2)) {
					$productApplicantID = $productApplicantData->regist($productApplicantRegistInfo);
					if($productApplicantID) {
						$productApplicantIdList[$productApplicantID] = $productApplicantID;
					}
				}
			}
		}
		if(count($productApplicantIdList) > 0){
			$packageID = $productPackageData->regist($packageInfo,$productApplicantIdList);
			if($packageID > 0){
				$packageInfo = $productPackageData->getInfo($packageID);
				$SYS_OrderId = sprintf("%06d",$packageInfo->id);

				if($packageInfo->payment_type == 2){//2:クレカ
					/* クレカ決済情報登録 */
					$CreditMes = "";
					$settle_type = 3;/* 0：なし 1：サービス 2：セミナー 3：商品 4:決済リンク */
					$authori_type = $productCategoryGroupInfo->authori_type;/* 1:仮売 2:本売 */
					$money = $packageInfo->total_amount;
					if($systemInfo->card_type == 1){/* PAY.JP */
						$user_tkn = $session->getMemberNumber();
						$Token = isset($_POST['Token'])?$_POST['Token']:'';
						$fingerprint = isset($_POST['fingerprint'])?$_POST['fingerprint']:'';
						$cardfinger = isset($_POST['cardfinger'])?$_POST['cardfinger']:'';
						$description = "商品購入(".$packageInfo->id.")";
						$buy_id = $packageInfo->id;
					}else if($systemInfo->card_type == 2){/* STRIPE */
						
					}else if($systemInfo->card_type == 3){/* ROBOT PAYMENT */
						$user_tkn = $session->getMemberNumber();
						$Token = isset($_POST['Token'])?$_POST['Token']:'';
						$cardfinger = isset($_POST['cardfinger'])?intval($_POST['cardfinger']):'';
						$description = "商品購入(".$packageInfo->id.")";
						$buy_id = $packageInfo->id;
					}else if($systemInfo->card_type == 4){/* UNIVA PAYT */
						$user_tkn = $session->getMemberNumber();
						$Token = isset($_POST['Token'])?$_POST['Token']:'';
						$description = "商品購入(".$packageInfo->id.")";
						$buy_id = $packageInfo->id;
					}else{
					}

					require_once dirname(__FILE__).'/../payment/pay_send_payment.php';

					/* クレカ決済情報登録 */
					if($CreditMes !== ""){
						$productPackageData->delete($packageInfo->id);
						$sErr = $CreditMes;
					}
				}

				if($sErr == ""){
					/* 商品購入情報 */
					$packageInfo->set_cart_list();
					$applicantListID = array_keys($packageInfo->puroduct_applicant_list);
					$puroductListID = array_values($packageInfo->puroduct_applicant_list);

					$applicantData = new ProductApplicantData('');
					$searchInfoList = array();
					$searchInfoList['search_id'] = $applicantListID;
					$applicantList = $applicantData->getInfoList($searchInfoList, 1);

					$productData = new ProductData('会員本人');
					$searchInfoList = array();
					$searchInfoList['search_id'] = $puroductListID;
					$productList = $productData->getInfoList($searchInfoList, 1);

					$groupInfo = $productData->getGroupInfo(reset($puroductListID));
					
					$proTotalAmmount = 0;
					$str = "";
					foreach($packageInfo->puroduct_list as $key => $val) {
						$proInfo = $productList[$key];
						$no = sprintf("%05d",$proInfo->id);
						$pro_num = htmlspecialchars($proInfo->pro_num);
						$name = htmlspecialchars($proInfo->name);
						$num = intval($val);
						$amount_num = 0;
						foreach($applicantList as $applicantInfo) {
							if($applicantInfo->productId == $proInfo->id){
								$amount_num += $applicantInfo->permissionDiscountAmount;
							}
						}
						$amount = $amount_num / $num;
						$proTotalAmmount += $amount_num;
						
						$str .= <<<"__LONG_STRRING__"
---------------------------------------------------------------
（{$pro_num}）{$name}  （単価：{$amount}）
 数量：{$num}個  合計：{$amount_num}円

__LONG_STRRING__;
						foreach ($proInfo->option_list as $val){
							if(array_key_exists($val,$optionList) && $optionList[$val]->status == 0){
								$op_name = $optionList[$val]->name;
								$op_amount = number_format($optionList[$val]->amount);
								$op_num = 0;
								$op_amount_num = 0;
								if(array_key_exists($proInfo->id,$cart_op_list)){
									if(array_key_exists($optionList[$val]->id,$cart_op_list[$proInfo->id])){
										$op_num = $cart_op_list[$proInfo->id][$optionList[$val]->id];
										$op_amount_num = number_format($op_amount * $op_num);
									}
								}
								if($op_num > 0){
									$str .= <<<"__LONG_STRRING__"
 {$op_name}  （単価：{$op_amount}）
 数量：{$op_num}個  合計：{$op_amount_num}円

__LONG_STRRING__;
								}
							}
						}
					}

					foreach ($cartOptionList as $key => $val){
						if($val->status !== 0)continue;
						$cart_op_name = $val->name;
						$cart_op_amount = number_format($val->amount);
						$cart_op_num = (array_key_exists($val->id,$cart_caop_list))?$cart_caop_list[$val->id]:0;
						$cart_op_amount_num = number_format($cart_op_amount * $cart_op_num);
						if($cart_op_num > 0){
							$str .= <<<"__LONG_STRRING__"
---------------------------------------------------------------
 {$cart_op_name}  （単価：{$cart_op_amount}）
 数量：{$cart_op_num}個  合計：{$cart_op_amount_num}円

__LONG_STRRING__;
						}
					}

					$proTotalAmmount = number_format($proTotalAmmount);
					$shipping_amount = number_format($packageInfo->shipping_amount);
					$total_amount = number_format($packageInfo->total_amount);
					$str .= <<<"__LONG_STRRING__"
---------------------------------------------------------------
 商品合計        {$proTotalAmmount}円
---------------------------------------------------------------
 送料            {$shipping_amount}円
---------------------------------------------------------------
 合計金額（税込）{$total_amount}円

__LONG_STRRING__;

					if($packageInfo->adjust_amount !== 0){
						$adjust_amount = number_format($packageInfo->adjust_amount);
						$str .= <<<"__LONG_STRRING__"
---------------------------------------------------------------
 調整金額        {$adjust_amount}円

__LONG_STRRING__;
					}

					$tax1 = number_format($packageInfo->tax1);
					$tax2 = number_format($packageInfo->tax2);
					$str .= <<<"__LONG_STRRING__"
---------------------------------------------------------------
 軽減税率（8％） {$tax1}円
---------------------------------------------------------------
 標準税率（10％）{$tax2}円
---------------------------------------------------------------

__LONG_STRRING__;

					$dl_name = $addressInfo->name;
					$dl_tel = $addressInfo->tel;
					$dl_zip = $addressInfo->zip;
					$dl_area = $addressInfo->area_name;
					$dl_add1 = $addressInfo->add1;
					$dl_add2 = $addressInfo->add2;
					$dl_company = $addressInfo->company;
					$shipping_info = <<<"__LONG_STRRING__"
---------------------------------------------------------------
 氏名     {$dl_name}
---------------------------------------------------------------
 電話番号 {$dl_tel}
---------------------------------------------------------------
 住所     〒{$dl_zip} {$dl_area}{$dl_add1}{$dl_add2}
---------------------------------------------------------------
 会社名   {$dl_company}
---------------------------------------------------------------

__LONG_STRRING__;

					if($packageInfo->delivery_request == 1){
						$deli_info = "準備出来次第配送";
					}else{
						$deli_info = <<<"__LONG_STRRING__"
希望日時を設定する

__LONG_STRRING__;
						if(!$packageInfo->delivery_date1->isEmpty()){
							$dateStr = $packageInfo->delivery_date1->toString();
							$deli_info .= <<<"__LONG_STRRING__"
---------------------------------------------------------------
 第1希望日     {$dateStr}

__LONG_STRRING__;
						}
						if(!$packageInfo->delivery_date2->isEmpty()){
							$dateStr = $packageInfo->delivery_date2->toString();
							$deli_info .= <<<"__LONG_STRRING__"
---------------------------------------------------------------
 第2希望日     {$dateStr}

__LONG_STRRING__;
						}
						if(!$packageInfo->delivery_date3->isEmpty()){
							$dateStr = $packageInfo->delivery_date3->toString();
							$deli_info .= <<<"__LONG_STRRING__"
---------------------------------------------------------------
 第3希望日     {$dateStr}

__LONG_STRRING__;
						}
					}
					if($packageInfo->payment_type == 1){
						$pay_info = "銀行振込";
					}else if($packageInfo->payment_type == 2){
						$pay_info = "クレジットカード";
					}else if($packageInfo->payment_type == 3){
						$pay_info = "代金引換";
					}else{
						$pay_info = "決済無し";
					}

					/* 会員情報 */
					$memberData->setBaseNo(1,false);
					$memberInfo = $memberData->getInfo($session->getMemberId());

					$sendInfo = array();
					$sendInfo["ac_id"] = $memberInfo->ac_id;
					$sendInfo["name"] = $memberInfo->data['INPUT00003'];
					$sendInfo["mail"] = $memberInfo->mail;
					$sendInfo["pro_cart_info"] = $str;
					$sendInfo["pro_order_id"] = $SYS_OrderId;
					$sendInfo["send_date"] = date("Y/m/d H:i:s");
					$sendInfo["shipping_info"] = $shipping_info;
					$sendInfo["deli_info"] = $deli_info;
					$sendInfo["pay_info"] = $pay_info;

					/* メールテンプレート */
					require_once dirname(__FILE__).'/../../../../../common/inc/data/product_mail_template.php';
					$MailTemplateData = new ProductMailTemplateData("");
					$MailTemplateInfo = $MailTemplateData->getInfo($groupInfo['mail_tmp_id']);
					$subject =  $MailTemplateInfo->name;
					$body = $MailTemplateInfo->body;
					$toList = array($memberInfo->mail);
					$bccList = $MailTemplateInfo->getBccList($MailTemplateInfo->bcc_list);
					/* メールテンプレート */

					//商品購入情報
					$replaceCharInfoList = $MailTemplateInfo->getReplaceCharInfo(2);
					/*
					$replaceCharInfoList = array(
						 '<--MAIL_ITEM_00001-->' => array('name' => '会員番号', 'replace' => '$options["ac_id"]')
						,'<--MAIL_ITEM_00002-->' => array('name' => '会員氏名', 'replace' => '$options["name"]')
						,'<--MAIL_ITEM_00003-->' => array('name' => '会員メールアドレス', 'replace' => '$options["mail"]')
						,'<--MAIL_ITEM_00004-->' => array('name' => '購入日時', 'replace' => '$options["send_date"]')
						,'<--MAIL_ITEM_00005-->' => array('name' => '購入受付番号', 'replace' => '$options["pro_order_id"]')
						,'<--MAIL_ITEM_00006-->' => array('name' => '商品購入情報', 'replace' => '$options["pro_cart_info"]')
						,'<--MAIL_ITEM_00007-->' => array('name' => '発送先情報', 'replace' => '$options["shipping_info"]')
						,'<--MAIL_ITEM_00008-->' => array('name' => '発送希望日情報', 'replace' => '$options["deli_info"]')
						,'<--MAIL_ITEM_00009-->' => array('name' => '決済情報', 'replace' => '$options["pay_info"]')
					);
					*/

					if($MailTemplateInfo->id > 0){
						/* メール送信 */
						require_once dirname(__FILE__).'/../../../../../common/inc/util/my_mail_util.php';
						$myMailUtil = new MyMailUtil();
						$result = $myMailUtil->sendSeminar($sendInfo, $subject, $body, $replaceCharInfoList, $toList, $bccList);
						if($result > 0) {
							//メール送信完了
						} else {
							$sErr = 'メールの送信に失敗しました。('.$result.')';
						}
					}
					$message = '商品の購入が完了しました。';
				}
			}else{
				$sErr = '商品の購入に失敗しました。';
			}
		}else{
			$sErr = '在庫が無くなったため、商品が購入できませんでした。';
		}
	}else{
		$sErr = '購入商品、または配送先情報が取得できませんでした。';
	}
}
unset($_SESSION[$cart_name]);
unset($_SESSION[$cart_name_op]);
unset($_SESSION[$cart_name_caop]);

?>
