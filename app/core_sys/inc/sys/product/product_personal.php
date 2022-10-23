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
	$inputFuncData = new InputFunctionData('');
	$masterBaseData = new MasterBaseData('');
	$memberData = new MemberData('会員本人');
	
	$useList = array();
	$useList['INPUT00003'] = true;//氏名
	$useList['INPUT00004'] = false;//氏名(フリガナ)
	$useList['INPUT00005'] = false;//電話番号
	$useList['INPUT00001'] = true;//アドレス
	//$useList['INPUT00006'] = true;//アドレス2
	$useList['INPUT00002'] = true;//パスワード
	$useList['INPUT00007'] = false;//住所
	//$useList['INPUT00008'] = true;//生年月日
	
	$memberData->setBaseNo(1,false,false,$useList);
	
	$SYS_BaseList = $inputFuncData->getBase();
	$SYS_Result = array();
	$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
	if(isset($_POST['mode']) && $_POST['mode'] == "save") {
		$SYS_MemInfo = $memberData->getInputValue($SYS_MemInfo);
		$SYS_Result = $memberData->check($SYS_MemInfo);
		if(count($SYS_Result) === 0) {
			if($session->isLogin()){/* 現会員 */
				$memberData->update($SYS_MemInfo);
			}else{
				$SYS_MemInfo = $session->getOutArgument($SYS_MemInfo);
				$id = $memberData->insert($SYS_MemInfo);
				if($id > 0) {
					$memberData->setBaseNo(1,false);
					$SYS_MemInfo = $memberData->getInfo($id);
					$sErr = $session->login($SYS_MemInfo->data['INPUT00001'], $SYS_MemInfo->data['INPUT00002']);
				} else {
					$sErr = '会員情報の登録に失敗しました。';
				}
			}
			if($sErr == ""){
			    //POSTで戻る
				$postVal = "";
				foreach ($_POST as $key => $value) {
					if($key !== "mode"){
						$postVal .= FormUtil::hidden($key,$value);
					}
				}
				
				$next_url = 'delivery.php';
				
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
		} else {
			$SYS_Message = '入力内容に間違いがあります。';
		}
	}else if(isset($_POST['mode']) && $_POST['mode'] == "login") {
		if(isset($_POST['account'])) {
			$message = $session->login($_POST['account'], $_POST['password']);
			if($message === '') {
				$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
			}
		} else {
			$message = $session->getErrorMsg();
		}
	}
}
?>
