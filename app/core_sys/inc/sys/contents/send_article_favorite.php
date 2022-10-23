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
				require_once dirname(__FILE__).'/../../../../../common/inc/data/article_comment_data.php';
				require_once dirname(__FILE__).'/../../../../../common/inc/data/article.php';
				
				$articleData = new ArticleData($session->getMemberName());
				$articleInfo = $articleData->getInfo($data['id']);
				if($articleInfo->id > 0){
					$Favorite = new ArticleFavoriteData($session->getMemberName());
					if($Favorite->getIsCount($articleInfo->id,$session->getMemberId()) > 0){
						if($Favorite->is_member_delete($articleInfo->id,$session->getMemberId())){
							$ret["flg"] = 0;
							$ret["count"] = $Favorite->getFavoriteCount($articleInfo->id);
							$ret["status"] = "success";
						}else{
							$ret["status"] = "error";
						}
					}else{
						$favoriteInfo = new ArticleFavoriteInfo();
						$favoriteInfo->article_id         = $articleInfo->id;
						$favoriteInfo->member_id          = $session->getMemberId();
						$favoriteInfo->id = $Favorite->insert($favoriteInfo);
						if($favoriteInfo->id > 0){
							$ret["flg"] = 1;
							$ret["count"] = $Favorite->getFavoriteCount($articleInfo->id);
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