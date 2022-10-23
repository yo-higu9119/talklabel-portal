				<div class="comBox">
					<div class="comBoxInn clear_fix">
						<section class="InputForm">
<?php
	if($SYS_Message !== '') {
?>
							<p class="Art mgt10 mgb10 cnt"><?php echo htmlspecialchars($SYS_Message);?></p>
<?php
	}
?>
<?php
	foreach($memberData->Column['base'] as $Key => $funcInfo) {
		if($funcInfo->required === 1){$required = '<span class="IcoBox NewIcBg BgPnc">'.Util::dispLang(Language::WORD_00058)/* �K�{ */.'</span>';}else{$required = '<span class="IcoBox NewIcBg BgBlu">'.Util::dispLang(Language::WORD_00059)/* �C�� */.'</span>';}
		if($funcInfo->type !== 11){
?>
							<dl class="clear_fix">
								<dt class="clear_fix"><p class="LayoutL"><?php echo $funcInfo->name.$required; ?></p></dt>
								<dd><?php if($mode == "input"){echo $memberData->getInpuTag($Key,$funcInfo,$SYS_MemInfo);}else{echo $memberData->getInputDisplay($Key,$funcInfo,$SYS_MemInfo);} ?>
									<?php echo FormUtil::getErrorStrPub($SYS_Result, $Key); ?>
								</dd>
							</dl>
<?php
		}else{
			echo FormUtil::hidden('file_name'.$funcInfo->id,"");
		}
	}
?>
						</section>
						<section class="InputForm mgt30">
<?php
	if(count($memberData->Column['master']) > 0){
?>
							<h2 class="fotm_ti"><?php echo Util::dispLang(Language::WORD_00110);/* ���̑��⑫���� */?></h2>
<?php
		foreach($memberData->Column['master'] as $Key => $funcInfo) {
			if($funcInfo->required === 1){$required = '<span class="IcoBox NewIcBg BgPnc">'.Util::dispLang(Language::WORD_00058)/* �K�{ */.'</span>';}else{$required = '<span class="IcoBox NewIcBg BgBlu">'.Util::dispLang(Language::WORD_00059)/* �C�� */.'</span>';}
?>
							<dl class="clear_fix">
								<dt class="clear_fix"><p class="LayoutL"><?php echo $funcInfo->name.$required; ?></p></dt>
								<dd>
									<?php if($mode == "input"){echo $memberData->getInpuTag($Key,$funcInfo,$SYS_MemInfo);}else{echo $memberData->getInputDisplay($Key,$funcInfo,$SYS_MemInfo);} ?>
									<?php echo FormUtil::getErrorStrPub($SYS_Result, $Key); ?>
								</dd>
							</dl>
<?php
		}
	}
?>
<?php
	foreach($memberData->Column['other'] as $Key => $funcInfo) {
		if($funcInfo->required === 1){$required = '<span class="IcoBox NewIcBg BgPnc">'.Util::dispLang(Language::WORD_00058)/* �K�{ */.'</span>';}else{$required = '<span class="IcoBox NewIcBg BgBlu">'.Util::dispLang(Language::WORD_00059)/* �C�� */.'</span>';}
		if($funcInfo->type !== 11){
?>
							<dl class="clear_fix">
								<dt class="clear_fix"><p class="LayoutL"><?php echo $funcInfo->name.$required; ?></p></dt>
								<dd><?php if($mode == "input"){echo $memberData->getInpuTag($Key,$funcInfo,$SYS_MemInfo);}else{echo $memberData->getInputDisplay($Key,$funcInfo,$SYS_MemInfo);} ?>
									<?php echo FormUtil::getErrorStrPub($SYS_Result, $Key); ?>
								</dd>
							</dl>
<?php
		}else{
			echo FormUtil::hidden('file_name'.$funcInfo->id,"");
		}
	}
?>
<?php if($mode == "input"){ ?>
							<section class="CautTxtW cnt">
								<p><?php echo Util::dispLang(Language::WORD_00060);/* ��L���͓��e�Ŗ�肠��܂��񂩁H */?><br />
								<?php echo Util::dispLang(Language::WORD_00061);/* ���Ȃ���Ή��L�u���͓��e�̊m�F�v�{�^�����N���b�N���Đi��ł��������B�H */?>
								</p>
							</section>
<?php }else{ ?>
							<section class="CautTxtW cnt">
								<p><?php echo Util::dispLang(Language::WORD_00062);/* ���Ȃ���Ή��L�u�o�^����������v�{�^�����N���b�N���Ċ������Ă��������B */?>
								</p>
							</section>
<?php } ?>
						</section>
					</div>

					<div class="BtM mglra clear_fix spBtM">
						<input type="hidden" name="mode" value="<?php echo $mode; ?>" id="mode" />
<?php if($mode == "input"){ ?>
						<p><button type="submit" class="grBT mgt20 mgb10 mglra btWtW next" onclick="javascript:$('#mode').val('check');" /><?php echo Util::dispLang(Language::WORD_00063);/* ���͓��e�̊m�F */?></button></p>
<?php }else{ ?>
						<p class="LayoutL"><button type="submit" class="whBT mgt20 mgb10 mglra btWtM back" onclick="javascript:$('#mode').val('input');" /><?php echo Util::dispLang(Language::WORD_00064);/* �O�̉�ʂɖ߂� */?></button></p>
						<p class="LayoutR"><button type="submit" class="orBT mgt20 mgb10 mglra btWtM next" onclick="javascript:$('#mode').val('save');" /><?php echo Util::dispLang(Language::WORD_00065);/* �o�^���������� */?></button></p>
<?php } ?>
					</div>

				</div>
