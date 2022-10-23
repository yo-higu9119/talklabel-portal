<?php
	$systemData = new SystemData($session->getMemberName());
	$systemInfo = $systemData->getInfo();
	$prohibition = explode(',',str_replace("\r\n",",",$systemInfo->bbs_prohibition));
	if($info->postType == 0){
		$imgSrc = SYSTEM_TOP_URL.'core_sys/sys/file/get_com_mem_file.php?id='.$info->memberId;
	}else{
		$imgSrc = SYSTEM_TOP_URL.'core_sys/sys/file/get_com_admin_file.php?id='.$info->accountId;
	}
?>
					<section class="board_topicsBox clear_fix">
						<h1><?php echo $info->title; ?></h1>

						<section class="commentList commentZero clear_fix">
							<div class="commentNameArea clear_fix">
								<p class="commentPh"><img src="<?php echo $imgSrc; ?>"></p>
								<div class="commentNameInn clear_fix">
									<p class="commentName"><?php echo $info->nickname; ?><span class="commentNameS">【 <?php echo $info->referral_id; ?> 】</span></p>
									<p class="commentTime"><?php echo htmlspecialchars($info->registTimestamp->toString())?></p>
								</div>
							</div>
							<div class="commentTxtArea">
								<p class="commentTxt"><?php echo str_replace(array("\r\n","\n"),"<br />",htmlspecialchars(Util::mb_str_replace($prohibition, "***", $info->body))); ?></p>
								
								<div class="commentResArea clear_fix">
									<div class="commentResL clear_fix">
<?php
	if($systemInfo->common_id == 0){
		if(!$session->isLogin() || $info->comment_is_accept == 0){
?>
										<p class="siteShare"><span><?php echo Util::dispLang(Language::WORD_00066);/*いいねをする*/?></span></p>
										<p class="siteShareNo"><?php echo $info->empathy_cnt?></p>
<?php
		}else{
			require_once dirname(__FILE__).'/../../../../../common/inc/data/board_comment_data.php';
			$respondData = new BoardRespondData($session->getMemberName());
			if($respondData->getIsCount($info->id,$session->getMemberId()) > 0){
				$empathyClass = ' class="BrdShare'.$info->id.' crt"';
			}else{
				$empathyClass = ' class="BrdShare'.$info->id.'"';
			}
?>
										<p class="siteShare"><a href="javascript:void(0);"<?php echo $empathyClass?> onclick="board_empathy_submit(<?php echo $info->id; ?>)"><?php echo Util::dispLang(Language::WORD_00066);/*いいねをする*/?></a></p>
										<p class="siteShareNo" id="BrdShareNo<?php echo $info->id; ?>"><?php echo $info->empathy_cnt; ?></p>
<?php
		}
	}
?>
										<p class="BrdSiteRes"><span id="ComCount"><?php echo $info->comment_cnt; ?></span></p>
									</div>
<?php
		if($info->comment_is_accept == 1){
			if($session->isLogin() && $session->getMemberVeto() == 0){
?>
									<div class="commentResR clear_fix">
<?php
				if($systemInfo->common_id == 0){
					$boardReportData = new BoardReportData($session->getMemberName());
					if($boardReportData->getIsCount($info->id,$session->getMemberId()) == 0){
?>
										<p class="commentReport commentResBT editBt" id="commentResBT0"><a href="" id="sliderp0" class="slide_rep"><?php echo Util::dispLang(Language::WORD_00030);/*通報する*/?></a></p>
<?php
					}else{
?>
										<p class="commentReport commentResBT editBt" id="commentResBT0"><span><?php echo Util::dispLang(Language::WORD_00045);/*通報しました*/?></span></p>
<?php
					}
				}
?>
										<p class="commentRes commentResBT editBt"><a href="" id="slide0" class="slide_res"><?php echo Util::dispLang(Language::WORD_00020);/*コメントする*/?></a></p>
									</div>
<?php
			}
		}
?>
								</div>
<?php
		if($info->comment_is_accept == 1){
			if($session->isLogin() && $session->getMemberVeto() == 0){
?>
								<div class="" id="slideArea0" style="display:none">
									<div class="commentInput">
<?php
				if($systemInfo->common_id == 0){
?>
										<p class="commentForm"><input type="text" name="input_nickname0" size="10" value="<?php echo $session->getMemberNickname(); ?>" maxlength="250" class="txt size100p" placeholder="<?php echo Util::dispLang(Language::WORD_00018);/*ニックネームを入れてください*/?>"></p>
<?php
				}else{
?>
										<input type="hidden" name="input_nickname0" value="">
<?php
				}
?>
										<p class="commentForm"><textarea name="input_comment0" cols="50" rows="5" class="txt size100p" placeholder="<?php echo Util::dispLang(Language::WORD_00019);/*コメントを入力してください*/?>"></textarea></p>
									</div>
									<div class="clear_fix">
										<p class="commentBT BtM"><button type="button" class="commentResBt" onclick="comment_check(0);"><?php echo Util::dispLang(Language::WORD_00048);/*返信のコメントする*/?></button></p>
									</div>
								</div>
<?php
				if($systemInfo->common_id == 0){
					$boardReportData = new BoardReportData($session->getMemberName());
					if($boardReportData->getIsCount($info->id,$session->getMemberId()) == 0){
?>
								<div class="" id="sliderpArea0" style="display:none">
									<div class="commentInput">
										<p class="commentForm"><textarea name="input_comment0" cols="50" rows="5" class="txt size100p" placeholder="<?php echo Util::dispLang(Language::WORD_00049);/*通報理由を入力してください*/?>"></textarea></p>
									</div>
									<div class="clear_fix">
										<p class="commentBT BtM"><button type="button" class="commentRepBt" onclick="board_rep_check();"><?php echo Util::dispLang(Language::WORD_00030);/*通報する*/?></button></p>
									</div>
								</div>
<?php
					}
				}
			}
		}
?>
							</div>
						</section>
					</section>
