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
				require_once dirname(__FILE__).'/../../../../../common/inc/data/board_comment_data.php';
				$boardCommentData = new BoardCommentData($session->getMemberName());
				$commentInfo = $boardCommentData->getInfo($data['id']);
				if($commentInfo->id > 0){
					$commentRespond = new BoardCommentRespondData($session->getMemberName());
					if($commentRespond->getIsCount($commentInfo->id,$session->getMemberId()) > 0){
						if($commentRespond->is_member_delete($commentInfo->id,$session->getMemberId())){
							$ret["flg"] = 0;
							$ret["count"] = $commentRespond->getEmpathyCount($commentInfo->id);
							$ret["status"] = "success";
						}else{
							$ret["status"] = "error";
						}
					}else{
						$respondInfo = new BoardRespondInfo();
						$respondInfo->board_id         = $commentInfo->board_id;
						$respondInfo->board_comment_id = $commentInfo->id;
						$respondInfo->member_id          = $session->getMemberId();
						$respondInfo->id = $commentRespond->insert($respondInfo);
						if($respondInfo->id > 0){
							$ret["flg"] = 1;
							$ret["count"] = $commentRespond->getEmpathyCount($commentInfo->id);
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