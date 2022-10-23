<?php
require_once dirname(__FILE__).'/../../../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../../../../common/inc/data/product.php';

$ret = array();
$sErr = "";

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	//if($session->isLogin()){
		$json = file_get_contents("php://input");
		$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'); 
		$data = json_decode($json,true);
		if($data === NULL){
			$ret["status"] = "error";
		}else{
			if(!isset($data['member_id']) && trim($data['member_id']) == "" && !is_numeric($data['member_id'])){
				$sErr = "parameter error";
			}
			if(!isset($data['product_id']) && trim($data['product_id']) == "" && !is_numeric($data['product_id'])){
				$sErr = "parameter error";
			}
			if(!isset($data['del_flg']) && trim($data['del_flg']) == "" && !is_numeric($data['del_flg'])){
				$sErr = "parameter error";
			}
			if(!isset($data['num']) && trim($data['num']) == "" && !is_numeric($data['num'])){
				$sErr = "parameter error";
			}
			if($sErr == ""){
				$productData = new ProductData($session->getMemberName());
				$sort = 1;
				$product_id = intval($data['product_id']);
				$del_flg = intval($data['del_flg']);
				
				/*** session ***/
				$cart_name = 'app_cart';
				if($product_id > 0){
					if($del_flg == 0){
						if(isset($_SESSION[$cart_name]) && is_array($_SESSION[$cart_name]) && count($_SESSION[$cart_name]) > 0){
							if(array_key_exists($product_id,$_SESSION[$cart_name])){
								if($data['num'] !== ""){
									$_SESSION[$cart_name][$product_id] = intval($data['num']);
								}else{
									$_SESSION[$cart_name][$product_id] += 1;
								}
							}else{
								if($data['num'] !== ""){
									$_SESSION[$cart_name][$product_id] = intval($data['num']);
								}else{
									$_SESSION[$cart_name][$product_id] += 1;
								}
							}
						}else{
							$_SESSION[$cart_name] = array();
							if($data['num'] !== ""){
								$_SESSION[$cart_name][$product_id] = intval($data['num']);
							}else{
								$_SESSION[$cart_name][$product_id] = 1;
							}
						}
					}else{
						if(isset($_SESSION[$cart_name]) && is_array($_SESSION[$cart_name]) && count($_SESSION[$cart_name]) > 0){
							if(array_key_exists($product_id,$_SESSION[$cart_name])){
								unset($_SESSION[$cart_name][$product_id]);
							}
						}
					}
				}
				/*** session ***/
				$ret["status"] = "success";
			}else{
				$ret["status"] = "error";
			}
		}
	//}else{
	//	$ret["status"] = "error";
	//}
}else{
	$ret["status"] = "error";
}
echo json_encode($ret);
?>