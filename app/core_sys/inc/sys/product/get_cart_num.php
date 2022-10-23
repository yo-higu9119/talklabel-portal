<?php
require_once dirname(__FILE__).'/../../../../core_sys/inc/util/session.php';
$session = new Session();

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
			if($sErr == ""){
				$ret["tags"] = $session->getCartNum();
				if($ret["tags"] !== ""){
					$ret["tags"] = Util::dispLang(Language::WORD_00118).$ret["tags"];/*カート*/
					$ret["status"] = "success";
				}else{
					$ret["status"] = "none";
				}
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