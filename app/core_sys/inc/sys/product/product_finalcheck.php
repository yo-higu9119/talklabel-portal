<?php
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();

$productData = new ProductData('会員本人');
$productApplicantData = new ProductApplicantData('会員本人');

require_once dirname(__FILE__).'/../../../../../common/inc/data/product_system_info.php';
$productSystemData = new ProductSystemData('会員本人');
$productSystemInfo = $productSystemData->getInfo();

$sErr = "";
$message= '';
$SYS_Message = '';
$hiddenStr1 = "";
$hiddenStr2 = "";
$fromPage ="";
$group_id = 0;
$total_amount = 0;
$result = array();
$pay_type = null;

$cart_name = 'app_cart';
if(isset($_SESSION[$cart_name]) && is_array($_SESSION[$cart_name]) && count($_SESSION[$cart_name]) > 0){
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
		$sErr = "選択された商品が見つからないか、在庫が無くなりました。";
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
	$productCategoryGroupData = new ProductCategoryGroupData('会員本人');
	$productCategoryGroupInfo = $productCategoryGroupData->getInfo($group_id);
}

if($sErr == ""){
	if(!$session->isLogin()){
		$sErr = "会員情報が取得できません。";
	}
}

if($sErr == ""){
	if(isset($_POST['delivery_address_id']) && intval($_POST['delivery_address_id']) > 0) {
		$addressData = new DeliveryAddressData('会員本人');
		$addressInfo = $addressData->getInfo(intval($_POST['delivery_address_id']));
		if($addressInfo->id > 0) {
		} else {
			$SYS_Message = '配送先が取得できません。';
		}
	}else{
		$SYS_Message = '配送先が取得できません。';
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
										$deli_list[$i] = date("Y年m月d日H時i分",strtotime($datetime));
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
											$deli_list[$i] = date("Y年m月d日H時i分",strtotime($datetime));
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
				$SYS_Message = '配送希望日時情報が取得できません。';
			}
		}else{
			$SYS_Message = '配送希望日時情報が取得できません。';
		}
	}else{
		$SYS_Message = '配送希望日時情報が取得できません。';
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
				}else{
					$SYS_Message = '決済情報が取得できません。';
				}
			}else{
				$SYS_Message = '決済情報が取得できません。';
			}
		}else{
			$SYS_Message = '決済情報が取得できません。';
		}
	}else{
		$SYS_Message = '決済情報が取得できません。';
	}
}

if(isset($_POST['remarks']) && trim($_POST['remarks']) != "") {
	$remarks = trim($_POST['remarks']);
}else{
	$remarks = '';
}

if($sErr == ""){
	$amount = $productInfo->getCurrentAmount($session->isLogin(), $session->getMemberPurchased());
	
	$inputFuncData = new InputFunctionData('会員本人');
	$masterBaseData = new MasterBaseData('会員本人');
	$memberData = new MemberData('会員本人');
	
	$useList = array();
	$useList['INPUT00003'] = true;//氏名
	$useList['INPUT00004'] = false;//氏名(フリガナ)
	$useList['INPUT00005'] = false;//電話番号
	$useList['INPUT00001'] = true;//アドレス
	//$useList['INPUT00006'] = true;//アドレス2
	//$useList['INPUT00002'] = true;//パスワード
	$useList['INPUT00007'] = false;//住所
	//$useList['INPUT00008'] = true;//生年月日
	
	$memberData->setBaseNo(1,false,false,$useList);
	$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
}
//POSTで戻る
$fromPage ="delivery.php";
foreach ($_POST as $key => $value) {
	if($key !== "mode"){
		$hiddenStr1 .= FormUtil::hidden($key,$value);
	}
	$hiddenStr2 .= FormUtil::hidden($key,$value);
}
?>
