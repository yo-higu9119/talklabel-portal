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
			if($sErr == ""){
				require_once dirname(__FILE__).'/../../../../../common/inc/data/board_comment_data.php';
				$commentData = new BoardCommentData($session->getMemberName());
				$commentInfo = $commentData->getInfo($data['id']);
				
				if($commentInfo->id > 0){
					$commentReportData = new BoardCommentReportData($session->getMemberName());
					if($commentReportData->getIsCount($commentInfo->id,$session->getMemberId()) == 0){
						$commentRepInfo = new BoardCommentReportInfo();
						$commentRepInfo->board_id         = $commentInfo->board_id;
						$commentRepInfo->board_comment_id = $commentInfo->id;
						$commentRepInfo->member_id          = $session->getMemberId();
						$commentRepInfo->body               = $data['body'];
						
						$commentRepInfo->id = $commentReportData->insert($commentRepInfo);
						if($commentRepInfo->id > 0){
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