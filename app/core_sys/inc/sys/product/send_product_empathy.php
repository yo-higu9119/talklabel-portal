<?php
require_once dirname(__FILE__).'/../../../inc/util/session.php';
$session = new Session();

$ret = array();
$sErr = "";
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	if($session->isLogin()){
		$json = file_get_contents("php://input");
		$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'); 
		$data = json_decode($json,true);
		if($data === NULL){
			$ret["status"] = "error";
		}else{
			if(!isset($data['id']) || trim($data['id']) == "" || !is_numeric($data['id'])){
				$sErr = "parameter error";
			}
			if($sErr == ""){
				require_once dirname(__FILE__).'/../../../../../common/inc/data/product_comment_data.php';
				require_once dirname(__FILE__).'/../../../../../common/inc/data/product.php';
				
				$productData = new ProductData($session->getMemberName());
				$productInfo = $productData->getInfo($data['id']);
				if($productInfo->id > 0){
					if($productData->isCommonId == 0){
						$Respond = new ProductRespondData($session->getMemberName());
						if($Respond->getIsCount($productInfo->id,$session->getMemberId()) > 0){
							if($Respond->is_member_delete($productInfo->id,$session->getMemberId())){
								$ret["flg"] = 0;
								$ret["count"] = $Respond->getEmpathyCount($productInfo->id);
								$ret["status"] = "success";
							}else{
								$ret["status"] = "error";
							}
						}else{
							$respondInfo = new ProductRespondInfo();
							$respondInfo->product_id         = $productInfo->id;
							$respondInfo->member_id          = $session->getMemberId();
							$respondInfo->id = $Respond->insert($respondInfo);
							if($respondInfo->id > 0){
								$ret["flg"] = 1;
								$ret["count"] = $Respond->getEmpathyCount($productInfo->id);
								$ret["status"] = "success";
							}else{
								$ret["status"] = "error";
							}
						}
					}else{
						if (isset($_SESSION['RespondCount']) && intval($_SESSION['RespondCount']) > time()){
							$RespondCount = false;
						}else{
							$RespondCount = true;
						}
						if($RespondCount && $productData->setPublicRespondCount($productInfo->id)){
							$_SESSION['RespondCount'] = time()+(60*1);
							$productInfo = $productData->getInfo($productInfo->id);
							$ret["flg"] = 1;
							$ret["count"] = $productInfo->empathy_cnt;
							$ret["status"] = "success";
						}else{
							$ret["status"] = "error";
						}
					}
				}else{
					$ret["status"] = "error";
				}
			}else{
				$ret["status"] = "error";
			}
		}
	}else{
		$ret["status"] = "error";
	}
}else{
	$ret["status"] = "error";
}
echo json_encode($ret);
?>