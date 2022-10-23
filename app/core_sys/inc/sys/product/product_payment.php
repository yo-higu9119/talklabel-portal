<?php
$productData = new ProductData('');
$productApplicantData = new ProductApplicantData('');

$sErr = "";
$message= '';
$SYS_Message = '';
$group_id = 0;
$total_amount = 0;

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
$next_url = 'final_check.php';
require_once dirname(__FILE__).'/../payment/input_payment_head_script.php';
}
?>
