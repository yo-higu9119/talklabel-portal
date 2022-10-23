					<section class="contact clear_fix">
<?php
if($mode == "input" || $mode == "check"){
	if($SYS_Message !== '') {
?>
						<p class="Art mgt10 mgb10"><?php echo htmlspecialchars($SYS_Message);?></p>
<?php
	}
	if(!$session->isLogin()){
		$nextMgt = ' mgt30';
?>
						<section class="InputForm">
<?php
	foreach($memberData->Column['base'] as $Key => $funcInfo) {
		if($funcInfo->required === 1 || (count($memberData->useList)>0 && array_key_exists($Key,$memberData->useList) && $memberData->useList[$Key])){$required = '<span class="NewIcBg BgPnc">'.Util::dispLang(Language::WORD_00058)/* 必須 */.'</span>';}else{$required = '<span class="NewIcBg BgBlu">'.Util::dispLang(Language::WORD_00059)/* 任意 */.'</span>';}
		if($funcInfo->type !== 11){
?>
							<dl class="clear_fix">
								<dt class="clear_fix"><p class="LayoutL"><?php echo $funcInfo->name.$required; ?></p></dt>
								<dd><?php if($mode == "input"){echo $memberData->getInpuTag($Key,$funcInfo,$SYS_MemInfo);}else{echo $memberData->getInputDisplay($Key,$funcInfo,$SYS_MemInfo);} ?>
									<?php echo FormUtil::getErrorStrPub($SYS_MemResult, $Key); ?>
								</dd>
							</dl>
<?php
		}else{
			echo FormUtil::hidden('file_name'.$funcInfo->id,"");
		}
	}
?>
						</section>
<?php
	}else{
		$nextMgt = '';
	}
?>
						<section class="InputForm<?php echo $nextMgt; ?>">
<?php
	if(count($inquiryData->Column['master']) !== 0 || count($inquiryData->Column['other']) !== 0){
?>
<?php
		foreach($inquiryData->Column['master'] as $Key => $funcInfo) {
			if($funcInfo->required === 1){$required = '<span class="NewIcBg BgPnc">'.Util::dispLang(Language::WORD_00058)/* 必須 */.'</span>';}else{$required = '<span class="NewIcBg BgBlu">'.Util::dispLang(Language::WORD_00059)/* 任意 */.'</span>';}
?>
							<dl class="clear_fix">
								<dt class="clear_fix"><p class="LayoutL"><?php echo $funcInfo->name.$required; ?></p></dt>
								<dd>
									<?php if($mode == "input"){echo $inquiryData->getInpuTag($Key,$funcInfo,$inquiryInfo);}else{echo $inquiryData->getInputDisplay($Key,$funcInfo,$inquiryInfo);} ?>
									<?php echo FormUtil::getErrorStrPub($SYS_InqResult, $Key); ?>
								</dd>
							</dl>
<?php
		}
?>
<?php
		$systemData = new SystemData('');
		$systemInfo = $systemData->getInfo();
		foreach($inquiryData->Column['other'] as $Key => $funcInfo) {
			if($funcInfo->required === 1){$required = '<span class="NewIcBg BgPnc">'.Util::dispLang(Language::WORD_00058)/* 必須 */.'</span>';}else{$required = '<span class="NewIcBg BgBlu">'.Util::dispLang(Language::WORD_00059)/* 任意 */.'</span>';}
			if($funcInfo->type !== 11 || ($funcInfo->type == 11 && $session->isLogin() && $systemInfo->common_id == 0)){
?>
							<dl class="clear_fix">
								<dt class="clear_fix"><p class="LayoutL"><?php echo $funcInfo->name.$required; ?></p></dt>
								<dd><?php if($mode == "input"){echo $inquiryData->getInpuTag($Key,$funcInfo,$inquiryInfo);}else{echo $inquiryData->getInputDisplay($Key,$funcInfo,$inquiryInfo);} ?>
									<?php echo FormUtil::getErrorStrPub($SYS_InqResult, $Key); ?>
								</dd>
							</dl>
<?php
			}else{
				echo FormUtil::hidden('file_name'.$funcInfo->id,"");
			}
		}
?>
						</section>
<?php
	}
?>

<?php if($mode == "input"){ ?>
						<section class="CautTxtW cnt">
							<p><?php echo Util::dispLang(Language::WORD_00060);/* 上記入力内容で問題ありませんか？ */?><br />
							<?php echo Util::dispLang(Language::WORD_00061);/* 問題なければ下記「入力内容の確認」ボタンをクリックして進んでください。 */?>
						</section>
<?php }else{ ?>
						<section class="CautTxtW cnt">
							<p><?php echo Util::dispLang(Language::WORD_00060);/* 上記入力内容で問題ありませんか？ */?><br />
							<?php echo Util::dispLang(Language::WORD_00062);/* 問題なければ下記「登録を完了する」ボタンをクリックして完了してください。 */?>
							</p>
						</section>
<?php } ?>


					</section>

					<div class="BtM mglra clear_fix spBtM spLR">
						<input type="hidden" name="regist_check" value="<?php echo htmlspecialchars($registCheckKey);?>">
						<input type="hidden" name="mode" value="<?php echo $mode; ?>" />
<?php if($mode == "input"){ ?>
						<p><button type="submit" class="whBT mgt20 mgb10 mglra btWtW next" /><?php echo Util::dispLang(Language::WORD_00063);/* 入力内容の確認 */?></button></p>
<?php }else{ ?>
						<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 mglra btWtM back" onclick="pre_submit()" /><?php echo Util::dispLang(Language::WORD_00064);/* 前の画面に戻る */?></button></p>
						<p class="LayoutR"><button type="submit" class="orBT mgt20 mgb10 mglra btWtM next" /><?php echo Util::dispLang(Language::WORD_00065);/* 登録を完了する */?></button></p>
<?php } ?>
					</div>
<?php
}
?>
