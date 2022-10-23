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
			if(!isset($data['board_id']) || trim($data['board_id']) == "" || !is_numeric($data['board_id'])){
				$sErr = "parameter error";
			}
			if(!isset($data['body']) || trim($data['body']) == ""){
				$sErr = "parameter error";
			}
			if($sErr == ""){
				require_once dirname(__FILE__).'/../../../../../common/inc/data/board.php';
				$boardData = new BoardData($session->getMemberName());
				$boardInfo = $boardData->getInfo($data['board_id']);
				
				if($boardInfo->id > 0){
					require_once dirname(__FILE__).'/../../../../../common/inc/data/board_comment_data.php';
					$boardReportData = new BoardReportData($session->getMemberName());
					if($boardReportData->getIsCount($boardInfo->id,$session->getMemberId()) == 0){
						$boardRepInfo = new BoardReportInfo();
						$boardRepInfo->board_id           = $boardInfo->id;
						$boardRepInfo->member_id          = $session->getMemberId();
						$boardRepInfo->body               = $data['body'];
						
						$boardRepInfo->id = $boardReportData->insert($boardRepInfo);
						if($boardRepInfo->id > 0){
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