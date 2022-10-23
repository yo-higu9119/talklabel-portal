						<div class="commentInput">
<?php
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();
if($systemInfo->common_id == 0){
?>
							<p class="commentForm">
								<input type="text" name="input_nickname0" size="10" value="<?php echo $session->getMemberNickname(); ?>" maxlength="250" class="txt size100p" placeholder="<?php echo Util::dispLang(Language::WORD_00018);/* ニックネームを入れてください */?>">
							</p>
<?php
}else{
?>
							<input type="hidden" name="input_nickname0" value="">
<?php
}
?>
							<p class="commentForm">
								<textarea name="input_comment0" cols="50" rows="5" class="txt size100p" placeholder="<?php echo Util::dispLang(Language::WORD_00652);/* レビューを入力してください */?>"></textarea>
							</p>
						</div>
						<div class="clear_fix">
							<p class="commentBT BtM">
								<button type="button" class="commentRegBt" onclick="comment_check(0);"><?php echo Util::dispLang(Language::WORD_00653);/* レビューする */?></button>
							</p>
						</div>
