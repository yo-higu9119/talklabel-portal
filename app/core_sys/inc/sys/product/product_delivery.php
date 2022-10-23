<?php
$productData = new ProductData('');
$productApplicantData = new ProductApplicantData('');

require_once dirname(__FILE__).'/../../../../../common/inc/data/product_system_info.php';
$productSystemData = new ProductSystemData('');
$productSystemInfo = $productSystemData->getInfo();

function isOpen($productSystemInfo, $date){
	$calendarData = new ProductCalendarData('');
	$year = date('Y',strtotime($date));
	$month = date('m',strtotime($date));
	$day = intval(date('d',strtotime($date)));
	$time = intval(date('Hi',strtotime($date)));
	if($productSystemInfo->business_type == 1){
		$calInfo = $calendarData->getList($year,$month,1);
		$st = intval(str_replace(":","",$productSystemInfo->business_type1_start));
		$ed = intval(str_replace(":","",$productSystemInfo->business_type1_end));
		if(array_key_exists($day, $calInfo)){
			return 1;//全休
		}else if($time < $st || $time > $ed){
			return 4;//時間外
		}
	}else{
		$calInfo = $calendarData->getList($year,$month,1);
		$st = intval(str_replace(":","",$productSystemInfo->business_type1_start));
		$ed = intval(str_replace(":","",$productSystemInfo->business_type1_end));
		if($time >= $st && $time <= $ed){
			if(array_key_exists($day, $calInfo)){
				return 2;//午前休
			}
		}else{
			$calInfo = $calendarData->getList($year,$month,2);
			$st = intval(str_replace(":","",$productSystemInfo->business_type2_start));
			$ed = intval(str_replace(":","",$productSystemInfo->business_type2_end));
			if($time >= $st && $time <= $ed){
				if(array_key_exists($day, $calInfo)){
					return 3;//午後休
				}
			}else{
				return 4;//時間外
			}
		}
	}
	return 0;//OK
}

$sErr = "";
$SYS_Message= '';
$delivery_address_id = 0;
$group_id = 0;
$total_amount = 0;
$result = array();

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
	$productCategoryGroupData = new ProductCategoryGroupData('');
	$productCategoryGroupInfo = $productCategoryGroupData->getInfo($group_id);
}

if($sErr == ""){
	if(!$session->isLogin()){
		$sErr = "会員情報が取得できません。";
	}
}

$delivery_ship = 0;
$delivery_wait_time = 0;
$is_area = false;

if($sErr == ""){
	if(isset($_POST['mode'])) {
		if(isset($_POST['delivery_address_id']) && intval($_POST['delivery_address_id']) > 0) {
			require_once dirname(__FILE__).'/../../../../../common/inc/data/delivery_address.php';
			$addressData = new DeliveryAddressData('');
			$addressInfo = $addressData->getInfo(intval($_POST['delivery_address_id']));
			if($addressInfo->id == 0) {
				$SYS_Message = '配送先が選択されておりません。';
			}
		}else{
			$SYS_Message = '配送先が選択されておりません。';
		}
		if($SYS_Message == ""){
			if($productCategoryGroupInfo->id == 0){
				$SYS_Message = 'カテゴリグループが見つかりません。';
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
							$SYS_Message = '配送先が設定されていないか、配送エリア範囲外です。';
						}
					}
				}
			}
		}
		if($SYS_Message == ""){
			$delivery_type = intval($_POST['delivery_type']);
			if($delivery_type == 2){
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
										$res = isOpen($productSystemInfo, $datetime);
										if($res == 0){
											if($delivery_wait_time == 0){
												$addtime = "now";
											}else{
												$addtime = "+ ".$delivery_wait_time." minute";
											}
											if(strtotime($addtime) > strtotime($datetime)){
												$datetime = date("Y年m月d日H時i分",strtotime($addtime));
												$result['deli'.$i] = $datetime."より後の日時で入力してください。";
											}
										}else{
											if($res == 1){//全休
												$result['deli'.$i] = "定休日です。";
											}else if($res == 2){//午前休
												$result['deli'.$i] = "受付時間外です。";
											}else if($res == 3){//午後休
												$result['deli'.$i] = "受付時間外です。";
											}else{//時間外
												$result['deli'.$i] = "受付時間外です。";
											}
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
											$res = isOpen($productSystemInfo, $datetime);
											if($res == 0){
												if($delivery_wait_time == 0){
													$addtime = "now";
												}else{
													$addtime = "+ ".$delivery_wait_time." minute";
												}
												if(strtotime($addtime) > strtotime($datetime)){
													$datetime = date("Y年m月d日H時i分",strtotime($addtime));
													$result['deli'.$i] = $datetime."より後の日時で入力してください。";
												}
											}else{
												if($res == 1){//全休
													$result['deli'.$i] = "定休日です。";
												}else if($res == 2){//午前休
													$result['deli'.$i] = "受付時間外です。";
												}else if($res == 3){//午後休
													$result['deli'.$i] = "受付時間外です。";
												}else{//時間外
													$result['deli'.$i] = "受付時間外です。";
												}
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
			}
			if(count($result) > 0){
				$SYS_Message = '入力内容に不備があります。';
			}
		}
		if($SYS_Message == ""){
		    //POSTで戻る
			$postVal = "";
			foreach ($_POST as $key => $value) {
				$postVal .= FormUtil::hidden($key,$value);
			}
			if($total_amount > 0){
				$next_url = 'payment.php';
			}else{
				$next_url = 'final_check.php';
			}
			
			$tag = <<< EOM
<!DOCTYPE html>
<head>
<meta charset='utf-8'>
</head>
<html lang='ja'>
<body onload='document.returnForm.submit();'>
<form name='returnForm' method='post' action='{$next_url}'>
{$postVal}
</form>
</body>
</html>
EOM;
			echo $tag;
			exit();
		}
	}
}

?>
