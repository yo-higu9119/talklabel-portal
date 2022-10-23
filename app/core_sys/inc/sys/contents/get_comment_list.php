<?php
require_once dirname(__FILE__).'/../../../inc/util/session.php';
$session = new Session();

require_once dirname(__FILE__).'/../../../../../common/inc/data/article_comment_data.php';

$ret = array();
$sErr = "";

function getTags($info,$class,$session,$prohibition,$systemInfo){
	$str = "";
	$str .= '<section class="commentList '.$class.' clear_fix" id="commentNo'.$info->id.'">';
	$str .= '<div class="commentNameArea clear_fix">';
	if($systemInfo->common_id == 1 || $info->status == 2 || $info->status == 1 || $info->auth_status == 2){
		$str .= '<p class="commentPh"><img src="'.SYSTEM_TOP_URL.'core_sys/common/images/sys/no_photo.gif" /></p>';
	}else{
		if($info->post_type == 0){
			$str .= '<p class="commentPh"><img src="'.SYSTEM_TOP_URL.'core_sys/sys/file/get_com_mem_file.php?id='.$info->member_id.'" /></p>';
		}else{
			$str .= '<p class="commentPh"><img src="'.SYSTEM_TOP_URL.'core_sys/sys/file/get_com_admin_file.php?id='.$info->account_id.'" /></p>';
		}
	}
	$str .= '<div class="commentNameInn clear_fix">';
	if($systemInfo->common_id == 1 || $info->status == 2 || $info->status == 1 || $info->auth_status == 2){
	}else{
		$referral_id = (trim($info->referral_id) !== "")?$info->referral_id:'-';
		$nickname = (trim($info->nickname) !== "")?htmlspecialchars($info->nickname):'-';
		$str .= '<p class="commentName">'.$nickname.'<span class="commentNameS">【 '.$referral_id.' 】</span></p>';
	}
	$str .= '<p class="commentTime">'.sprintf("%07d",$info->id).'　'.$info->create_date->toString().'</p>';
	$str .= '</div>';
	$str .= '</div>';
	$str .= '<div class="commentTxtArea">';
	if($info->status == 2){
		$str .= '<p class="commentTxt">'.Util::dispLang(Language::WORD_00039).'</p>';/* 削除されました */
	}else if($info->status == 1){
		$str .= '<p class="commentTxt">'.Util::dispLang(Language::WORD_00040).'</p>';/* 現在、閲覧できません */
	}else if($info->auth_status == 0){
		$str .= '<p class="commentTxt">'.Util::dispLang(Language::WORD_00041).'</p>';/* 承認待ちです */
	}else if($info->auth_status == 2){
		$str .= '<p class="commentTxt">'.Util::dispLang(Language::WORD_00042).'</p>';/* 承認が拒否されました */
	}else{
		if($info->depth > 1){
			$str .= '<p class="commentTxtRes">＞'.Util::dispLang(Language::WORD_00043).'（'.sprintf("%07d",$info->parent_id).'）</p>';/* 返信 */
		}
		$str .= '<p class="commentTxt">'.str_replace(array("\r\n","\n"),"<br />",htmlspecialchars(Util::mb_str_replace($prohibition, "***", $info->body))).'</p>';
	}
	if($info->status == 2){
	}else if($info->status == 1){
	}else if($info->auth_status == 0){
	}else if($info->auth_status == 2){
	}else if($systemInfo->common_id == 1){
	}else if(!$session->isLogin() || $info->is_accept == 0 || $session->getMemberVeto() == 1){
		$str .= '<div class="commentResArea clear_fix">';
		$str .= '<div class="commentResL clear_fix">';
		$str .= '<p class="siteShare"><span>'.Util::dispLang(Language::WORD_00044).'</span></p>';/* 共感する */
		$str .= '<p class="siteShareNo">'.$info->respond_cnt.'</p>';
		$str .= '</div>';
		$str .= '</div>';
	}else{
		$commentRespond = new ArticleCommentRespondData($session->getMemberName());
		if($commentRespond->getIsCount($info->id,$session->getMemberId()) > 0){
			$empathyClass = ' class="crt"';
		}else{
			$empathyClass = '';
		}
		$str .= '<div class="commentResArea clear_fix">';
		if($info->member_id == $session->getMemberId()){
			$str .= '<div class="commentResL clear_fix">';
			$str .= '<p class="siteShare"><span>'.Util::dispLang(Language::WORD_00044).'</span></p>';/* 共感する */
			$str .= '<p class="siteShareNo">'.$info->respond_cnt.'</p>';
			$str .= '</div>';
			$str .= '<div class="commentResR clear_fix">';
			$str .= '<p class="commentEdit commentResBT editBt"><a href="" id="slideed'.$info->id.'" class="slide_edit">'.Util::dispLang(Language::WORD_00016).'</a></p>';/* 編集する */
			$str .= '<p class="commentDel commentResBT editBt"><a href="" id="slidedl'.$info->id.'" class="slide_del">'.Util::dispLang(Language::WORD_00024).'</a></p>';/* 削除する */
			$str .= '</div>';
		}else{
			$str .= '<div class="commentResL clear_fix">';
			$str .= '<p class="siteShare"><a href="javascript:void(0);"'.$empathyClass.' onclick="comment_empathy_submit('.$info->id.')" id="ComShare'.$info->id.'">'.Util::dispLang(Language::WORD_00044).'</a></p>';/* 共感する */
			$str .= '<p class="siteShareNo" id="ComShareNo'.$info->id.'">'.$info->respond_cnt.'</p>';
			$str .= '</div>';
			$str .= '<div class="commentResR clear_fix">';
			$commentReportData = new ArticleCommentReportData($session->getMemberName());
			$commentReportCount = $commentReportData->getIsCount($info->id,$session->getMemberId());
			if($commentReportCount == 0){
				$str .= '<p class="commentReport commentResBT editBt" id="commentResBT'.$info->id.'"><a href="" id="sliderp'.$info->id.'" class="slide_rep">'.Util::dispLang(Language::WORD_00030).'</a></p>';/* 通報する */
			}else{
				$str .= '<p class="commentReport commentResBT editBt"><span>'.Util::dispLang(Language::WORD_00045).'</span></p>';/* 通報しました */
			}
			$str .= '<p class="commentRes commentResBT editBt"><a href="" id="slide'.$info->id.'" class="slide_res">'.Util::dispLang(Language::WORD_00046).'</a></p>';/* 返信する */
			$str .= '</div>';
		}
		$str .= '</div>';
	}
	if($info->status == 2){
	}else if($info->status == 1){
	}else if($info->auth_status == 0){
	}else if($info->auth_status == 2){
	}else if($systemInfo->common_id == 1){
	}else if(!$session->isLogin() || $info->is_accept == 0 || $session->getMemberVeto() == 1){
	}else{
		if($info->member_id == $session->getMemberId()){
			$str .= '<div class="" id="slideedArea'.$info->id.'" style="display:none">';
			$str .= '<div class="commentInput">';
			$str .= '<p class="commentForm">'.FormUtil::textbox('input_nickname'.$info->id, htmlspecialchars($session->getMemberNickname()), 10, 250, 'txt size100p', Util::dispLang(Language::WORD_00018)).'</p>';/* ニックネームを入れてください */
			$str .= '<p class="commentForm"><textarea name="input_comment'.$info->id.'" cols="50" rows="5"  class="txt size100p"  placeholder="'.Util::dispLang(Language::WORD_00019).'" >'.htmlspecialchars($info->body).'</textarea></p>';/* コメントを入力してください */
			$str .= '</div>';
			$str .= '<div class="clear_fix">';
			$str .= '<p class="commentBT BtM"><button type="button" class="commentEditBt" onclick="comment_edit_check('.$info->id.');" >'.Util::dispLang(Language::WORD_00016).'</button></p>';/* 編集する */
			$str .= '</div>';
			$str .= '</div>';
			
			if(IS_SMART_PHONE){
				$utilOpenFrame_prm = "20, 350, 600";
			}else{
				$utilOpenFrame_prm = "50, 800, 600";
			}
			$str .= '<div class="" id="slidedlArea'.$info->id.'" style="display:none">';
			$str .= '<p class="CautTxt CautMg cnt">'.Util::dispLang(Language::WORD_00047).'</p>';/* このコメントを削除しますか？ */
			$str .= '<div class="clear_fix">';
			$str .= '<p class="commentBT BtM"><button type="button" class="commentDelBt" onclick="utilOpenFrame(\'../../popup/comment/comment_dialog.php?id='.$info->id.'&t=de\', false, '.$utilOpenFrame_prm.');" >'.Util::dispLang(Language::WORD_00024).'</button></p>';/* 削除する */
			$str .= '</div>';
			$str .= '</div>';
		}else{
			$str .= '<div class="" id="slideArea'.$info->id.'" style="display:none">';
			$str .= '<div class="commentInput">';
			$str .= '<p class="commentForm">'.FormUtil::textbox('input_nickname'.$info->id, htmlspecialchars($session->getMemberNickname()), 10, 250, 'txt size100p', Util::dispLang(Language::WORD_00018)).'</p>';/* ニックネームを入れてください */
			$str .= '<p class="commentForm"><textarea name="input_comment'.$info->id.'" cols="50" rows="5"  class="txt size100p"  placeholder="'.Util::dispLang(Language::WORD_00019).'" ></textarea></p>';/* コメントを入力してください */
			$str .= '</div>';
			$str .= '<div class="clear_fix">';
			$str .= '<p class="commentBT BtM"><button type="button" class="commentResBt" onclick="comment_check('.$info->id.');" >'.Util::dispLang(Language::WORD_00048).'</button></p>';/* 返信のコメントする */
			$str .= '</div>';
			$str .= '</div>';
			
			if($commentReportCount == 0){
				$str .= '<div class="" id="sliderpArea'.$info->id.'" style="display:none">';
				$str .= '<div class="commentInput">';
				$str .= '<p class="commentForm"><textarea name="input_comment'.$info->id.'" cols="50" rows="5"  class="txt size100p"  placeholder="'.Util::dispLang(Language::WORD_00049).'" ></textarea></p>';/* 通報理由を入力してください */
				$str .= '</div>';
				$str .= '<div class="clear_fix">';
				$str .= '<p class="commentBT BtM"><button type="button" class="commentRepBt" onclick="comment_rep_check('.$info->id.');" >'.Util::dispLang(Language::WORD_00030).'</button></p>';/* 通報する */
				$str .= '</div>';
				$str .= '</div>';
			}
		}
	}
	$str .= '</div>';
	$str .= '</section>';
	return $str;
}

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	//if($session->isLogin()){
		$json = file_get_contents("php://input");
		$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'); 
		$data = json_decode($json,true);
		if($data === NULL){
			$ret["status"] = "error";
		}else{
			if(!isset($data['article_id']) && trim($data['article_id']) == "" && !is_numeric($data['article_id'])){
				$sErr = "parameter error";
			}
			if(!isset($data['page']) && trim($data['page']) == "" && !is_numeric($data['page'])){
				$sErr = "parameter error";
			}
			if($sErr == ""){
				$pageDispCntMax = 5;
				$pageNo = intval($data['page']) - 1;

				$articleCommentData = new ArticleCommentData($session->getMemberName());

				require_once dirname(__FILE__).'/../../../inc/util/html_parts.php';

				$systemData = new SystemData($session->getMemberName());
				$systemInfo = $systemData->getInfo();
				
				if($systemInfo->app_login_type == 0 || ($systemInfo->app_login_type == 1 && $session->isLogin())){
					$prohibition = explode(',',str_replace("\r\n",",",$systemInfo->cms_prohibition));

					$searchInfoList = array();
					$totalCnt = $articleCommentData->getListPrCnt($data['article_id']);
					$List = $articleCommentData->getInfoListPr($data['article_id'],$pageNo*$pageDispCntMax,$pageDispCntMax);
					$pageMax = intval(ceil($totalCnt / $pageDispCntMax));
					if($pageNo >= $pageMax) {
						$pageNo = $pageMax;
					}
					if($pageNo < 1) {
						$pageNo = 1;
					}else{
						$pageNo++;
					}
					
					if(count($List) !== 0){
						$ret["tags"] = "";
						foreach($List as $val){
							$info = $val['data'];
							$class = "commentFst";
							$ret["tags"] .= getTags($info,$class,$session,$prohibition,$systemInfo);
							
							foreach($val['child'] as $valCh){
								$info = $valCh['data'];
								$class = "commentSec";
								$ret["tags"] .= getTags($info,$class,$session,$prohibition,$systemInfo);
							}
						}
						$ret["tags"] .= HtmlParts::printPageSelectJs($pageNo, $pageMax);
						$ret["status"] = "success";
					}else{
						$ret["status"] = "none";
					}
				}else{
					$ret["status"] = "error";
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