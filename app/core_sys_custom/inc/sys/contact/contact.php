<?php
if($sErrCon == ""){
	if(isset($_POST['mode'])) {
		if($mode == "pre"){
			$mode = "input";
		}else{
			if(isset($_POST['INPUT00001']) && !$session->isLogin()){
				$SYS_MemInfo = $memberData->getInfoMail($_POST['INPUT00001']);
			}
			if(!$session->isLogin()){
				$SYS_MemInfo = $memberData->getInputValue($SYS_MemInfo);
				$SYS_MemResult = $memberData->check($SYS_MemInfo);
			}else{
				$SYS_MemInfo = $memberData->getInfo($session->getMemberId());
				$SYS_MemResult = array();
			}
			
			$SYS_InqInfo = $inquiryData->getInputValue($inquiryInfo);
			$SYS_InqResult = $inquiryData->check($SYS_InqInfo);
			if(count($SYS_MemResult) === 0 && count($SYS_InqResult) === 0) {
				if($mode == "check"){
					$isPostClear = false;
					if(isset($_SESSION['regist_check']) && $_SESSION['regist_check'] === $_POST['regist_check']) {
						if(isset($_SESSION['LineID']) && $_SESSION['LineID'] != "") {
							$SYS_MemInfo->line_id = $_SESSION['LineID'];
							unset($_SESSION['LineID']);
						}
						if(isset($_SESSION['FacebookID']) && $_SESSION['FacebookID'] != "") {
							$SYS_MemInfo->facebook_id = $_SESSION['FacebookID'];
							unset($_SESSION['FacebookID']);
						}
						
						if(isset($_SESSION['out_ex1']) && $_SESSION['out_ex1'] != ""){
							$SYS_MemInfo->out_ex1 = $_SESSION['out_ex1'];
							unset($_SESSION['out_ex1']);
						}
						if(isset($_SESSION['out_ex2']) && $_SESSION['out_ex2'] != ""){
							$SYS_MemInfo->out_ex2 = $_SESSION['out_ex2'];
							unset($_SESSION['out_ex2']);
						}
						if(isset($_SESSION['out_ex3']) && $_SESSION['out_ex3'] != ""){
							$SYS_MemInfo->out_ex3 = $_SESSION['out_ex3'];
							unset($_SESSION['out_ex3']);
						}
						if(isset($_SESSION['out_ex4']) && $_SESSION['out_ex4'] != ""){
							$SYS_MemInfo->out_ex4 = $_SESSION['out_ex4'];
							unset($_SESSION['out_ex4']);
						}
						if(isset($_SESSION['out_ex5']) && $_SESSION['out_ex5'] != ""){
							$SYS_MemInfo->out_ex5 = $_SESSION['out_ex5'];
							unset($_SESSION['out_ex5']);
						}
						if(isset($_SESSION['out_ex6']) && $_SESSION['out_ex6'] != ""){
							$SYS_MemInfo->out_ex6 = $_SESSION['out_ex6'];
							unset($_SESSION['out_ex6']);
						}
						if(isset($_SESSION['out_ex7']) && $_SESSION['out_ex7'] != ""){
							$SYS_MemInfo->out_ex7 = $_SESSION['out_ex7'];
							unset($_SESSION['out_ex7']);
						}
						if(isset($_SESSION['out_ex8']) && $_SESSION['out_ex8'] != ""){
							$SYS_MemInfo->out_ex8 = $_SESSION['out_ex8'];
							unset($_SESSION['out_ex8']);
						}
						
						if($SYS_MemInfo->id === 0){
							$SYS_MemInfo->invalid = 0;
							if(isset($_SESSION['out_aug_ad']) && $_SESSION['out_aug_ad'] != "") {
								$SYS_MemInfo->ad_num = $_SESSION['out_aug_ad'];
								unset($_SESSION['out_aug_ad']);
							}
							if(isset($_SESSION['out_aug_fl']) && $_SESSION['out_aug_fl'] != "") {
								$SYS_MemInfo->inflow = $_SESSION['out_aug_fl'];
								unset($_SESSION['out_aug_fl']);
							}
							$id = $memberData->insert($SYS_MemInfo);
							if($id > 0) {
								$memberData->setBaseNo(1,false);
								$SYS_MemInfo = $memberData->getInfo($id);
								$isPostClear = true;
							} else {
								$SYS_Message = '登録に失敗しました。';
								$mode = "input";
							}
						}else{
							if($memberData->update($SYS_MemInfo)) {
								$memberData->setBaseNo(1,false);
								$SYS_MemInfo = $memberData->getInfo($SYS_MemInfo->id);
								$isPostClear = true;
							} else {
								$SYS_Message = '登録に失敗しました。';
								$mode = "input";
							}
						}
						//spl_write($SYS_MemInfo,array());

						if($isPostClear && $SYS_MemInfo->id > 0){/* 会員登録正常終了時 */
							$SYS_InqInfo->base_no = $inquiryNo;
							$SYS_InqInfo->mem_id  = $SYS_MemInfo->id;
							if(isset($info) && $info->id > 0){
								$SYS_InqInfo->article_id  = $info->id;
							}
							
							$id = $inquiryData->insert($SYS_InqInfo);
							$isNew = true;
							if($id > 0) {
								$SYS_InqInfo = $inquiryData->getInfo($id);
								foreach($inquiryData->Column as $Key => $funcInfo) {
									if($Key !== 'base' && $Key !== 'master' && $Key !== 'other'){
										if($funcInfo->type === 11){
											if(isset($_POST['file_operation'.$funcInfo->id])){
											$fileOperation = intval($_POST['file_operation'.$funcInfo->id]);
												switch($fileOperation) {
													case 1:
														break;
													case 2:
														$toFile = PathInfo::getInquiryFilePath(false, $SYS_InqInfo->id, $funcInfo->id, $SYS_InqInfo->mem_id, false, false, $SYS_InqInfo->mem_id);
														if(!FileUtil::createDir($toFile)) {
															echo 'ディレクトリ作成エラー';
															exit();
														}

														if($isNew){
															$fromId = 0;
														}else{
															$fromId = $SYS_InqInfo->id;
														}
														$fromFile = PathInfo::getInquiryFilePath(true, $fromId, $funcInfo->id, $SYS_InqInfo->mem_id, false, false, $SYS_InqInfo->mem_id);
														if(is_file($fromFile)) {
															rename($fromFile, $toFile);
														}

														break;
													default:
														if($isNew){
															$fromId = 0;
														}else{
															$fromId = $SYS_InqInfo->id;
														}
														$file = PathInfo::getInquiryFilePath(true, $fromId, $funcInfo->id, $SYS_InqInfo->mem_id, false, false, $SYS_InqInfo->mem_id);
														if(is_file($file)) {
															unlink($file);
														}
														$file = PathInfo::getInquiryFilePath(false, $SYS_InqInfo->id, $funcInfo->id, $SYS_InqInfo->mem_id, false, false, $SYS_InqInfo->mem_id);
														if(is_file($file)) {
															unlink($file);
														}
														break;
												}
											}
										}
									}
								}
								
								$tmpInquiryOrderId = sprintf("%07d",$SYS_InqInfo->id);
								$_SESSION['tmpInquiryOrderId'] = $tmpInquiryOrderId;
								
								/* メール送信 */
								$sendInfo = array();
								$replaceCharInfoList = array();
								
								
								$sendInfo["<--MAIL_ITEM_INQUILY_ID-->"] = $tmpInquiryOrderId;
								$replaceCharInfoList["<--MAIL_ITEM_INQUILY_ID-->"] = array('name' => 'お問合せ番号', 'replace' => '$options["<--MAIL_ITEM_INQUILY_ID-->"]');
								$sendInfo["<--MAIL_ITEM_MEMBER_ID-->"] = $SYS_MemInfo->ac_id;
								$replaceCharInfoList["<--MAIL_ITEM_MEMBER_ID-->"] = array('name' => '会員番号', 'replace' => '$options["<--MAIL_ITEM_MEMBER_ID-->"]');

								if(count($memberData->Column['base']) !== 0) {
									foreach($memberData->Column['base'] as $funcInfo) {
										if($funcInfo->type !== 11){
											$Key = sprintf("<--MAIL_ITEM_%05d-->",$funcInfo->id);
											$fncKey = sprintf("INPUT%05d",$funcInfo->id);
											if($funcInfo->type === 8){
												$sendInfo[$Key] = $memberData->getZipValueStr($funcInfo->id, $SYS_MemInfo);
											}else{
												$sendInfo[$Key] = isset($SYS_MemInfo->data[$fncKey])?$SYS_MemInfo->data[$fncKey]:"";
											}
											$replaceCharInfoList[$Key] = array('name' => $funcInfo->name, 'replace' => '$options["'.$Key.'"]');
										}
									}
								}
								foreach($inquiryData->Column['master'] as $funcInfo) {
									if($funcInfo->type !== 11){
										$Key = sprintf("<--MAIL_FORM_%05d-->",$funcInfo->id);
										$fncKey = sprintf("FORM%05d",$funcInfo->id);
										if($funcInfo->type === 8){
											$sendInfo[$Key] = $inquiryData->getZipValueStr($funcInfo->id, $SYS_InqInfo);
										}else{
											$sendInfo[$Key] = isset($SYS_InqInfo->data[$fncKey])?$SYS_InqInfo->data[$fncKey]:"";
										}
										$replaceCharInfoList[$Key] = array('name' => $funcInfo->name, 'replace' => '$options["'.$Key.'"]');
									}
								}
								foreach($inquiryData->Column['other'] as $funcInfo) {
									if($funcInfo->type !== 11){
										$Key = sprintf("<--MAIL_FORM_%05d-->",$funcInfo->id);
										$fncKey = sprintf("FORM%05d",$funcInfo->id);
										if($funcInfo->type === 8){
											$sendInfo[$Key] = $inquiryData->getZipValueStr($funcInfo->id, $SYS_InqInfo);
										}else{
											$sendInfo[$Key] = isset($SYS_InqInfo->data[$fncKey])?$SYS_InqInfo->data[$fncKey]:"";
										}
										$replaceCharInfoList[$Key] = array('name' => $funcInfo->name, 'replace' => '$options["'.$Key.'"]');
									}
								}
								
								$toList = array($SYS_MemInfo->mail);
								$bccList = inquiryBaseInfo::getBccList($inquiryBaseInfo->bcc_list);

								$subject =  $inquiryBaseInfo->mail_subject;
								$body =  $inquiryBaseInfo->mail_body;

								/* メール送信 */
								require_once dirname(__FILE__).'/../../../../../common/inc/util/my_mail_util.php';
								$myMailUtil = new MyMailUtil();
								$result = $myMailUtil->sendSeminar($sendInfo, $subject, $body, $replaceCharInfoList, $toList, $bccList);
								if($result > 0) {
									/* login*/
									//$session->loginACId($SYS_MemInfo->ac_id);
									/* login*/
									if(isset($comReq) && $comReq){//contents/main/index.phpからの呼び出し
										
									}else{//お問合せ画面からの呼び出し
										header('Location: ./save.php');
										exit();
									}
								} else {
									$message = 'メールの送信に失敗しました。('.$result.')';
								}
								
								$isPostClear = true;
								$mode = "end";
							} else {
								$message = '登録に失敗しました。';
								$isPostClear = false;
								$mode = "input";
							}
						}
					} else {
						$SYS_Message = 'ブラウザの更新ボタンがクリックされました。一度画面を閉じて再度登録内容をご確認ください。';
						
						$SYS_MemInfo = $memberData->getInfo(0);
						$inquiryInfo = $inquiryData->getInfo(0);
						$SYS_MemResult = array();
						$SYS_InqResult = array();
						
						$mode = "input";
						$isPostClear = true;
					}
					if($isPostClear){
						$_POST = array();
					}
				}else{
					$mode = "check";
				}
			} else {
				$SYS_Message = '入力内容に間違いがあります。';
				$mode = "input";
			}
		}
	}else{
		$mode = "input";
	}
	$registCheckKey = Util::randomStr(64);
	$_SESSION['regist_check'] = $registCheckKey;
}
?>