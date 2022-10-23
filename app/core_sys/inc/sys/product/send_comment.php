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
			if(!isset($data['product_id']) || trim($data['product_id']) == "" || !is_numeric($data['product_id'])){
				$sErr = "parameter error";
			}
			if(!isset($data['parent_id']) || trim($data['parent_id']) == "" || !is_numeric($data['parent_id'])){
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
				
				require_once dirname(__FILE__).'/../../../../../common/inc/data/product.php';
				$productData = new ProductData($session->getMemberName());
				$productInfo = $productData->getInfo(intval($data['product_id']));
				if($productInfo->id > 0){
					require_once dirname(__FILE__).'/../../../../../common/inc/data/product_comment_data.php';
					$productCommentData = new ProductCommentData($session->getMemberName());
					
					$commentInfo = new ProductCommentInfo();
					$commentInfo->product_id  = intval($data['product_id']);
					$commentInfo->parent_id   = intval($data['parent_id']);
					$commentInfo->post_type   = 0;
					$commentInfo->member_id   = $session->getMemberId();
					$commentInfo->body        = $data['body'];
					$commentInfo->auth_status = $productInfo->commentAuthDefoult;
					$commentInfo->id = $productCommentData->insert($commentInfo);
					
					if($commentInfo->id > 0){
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