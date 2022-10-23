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
			if(!isset($data['body']) || trim($data['body']) == ""){
				$sErr = "parameter error";
			}
			if(!isset($data['nickname'])){
				$sErr = "parameter error";
			}else{
				if(trim($data['nickname']) == ""){
					$data['nickname'] = Util::dispLang(Language::WORD_00050);//匿名希望
				}
			}
			if($sErr == ""){
				require_once dirname(__FILE__).'/../../../../../common/inc/data/member_data.php';
				$memberData = new MemberData($session->getMemberName());
				$memberData->setBaseNo(1);
				$memberInfo = $memberData->getInfo($session->getMemberId());
				$memberInfo->nickname = $data['nickname'];
				$memberData->update($memberInfo);
				
				require_once dirname(__FILE__).'/../../../../../common/inc/data/product_comment_data.php';
				$productCommentData = new ProductCommentData($session->getMemberName());
				
				$productInfo = $productCommentData->getInfo($data['id']);
				if($productInfo->id > 0){
					$productInfo->body        = $data['body'];
					$productInfo->auth_status = $productInfo->auth_defoult;
					if($productCommentData->update($productInfo)){
						$ret["status"] = "success";
					}else{
						$ret["status"] = "error";
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