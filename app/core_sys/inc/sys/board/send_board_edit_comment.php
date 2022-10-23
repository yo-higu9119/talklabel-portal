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
				
				require_once dirname(__FILE__).'/../../../../../common/inc/data/board_category_group.php';
				$groupData = new BoardCategoryGroupData($session->getMemberName());
				$groupInfo = $groupData->getIdFronToBoard($data['id']);
				
				require_once dirname(__FILE__).'/../../../../../common/inc/data/board_comment_data.php';
				$boardCommentData = new BoardCommentData($session->getMemberName());
				
				$boardInfo = $boardCommentData->getInfo($data['id']);
				if($boardInfo->id > 0){
					$boardInfo->body        = $data['body'];
					if($groupInfo->commentAuthDisp === true){
						$boardInfo->auth_status = 0;
					}else{
						$boardInfo->auth_status = 1;
					}
					if($boardCommentData->update($boardInfo)){
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