<?php
	foreach($memberData->Column['master'] as $Key => $funcInfo) {
		if($funcInfo->required === 1){$required = '<span class="IcoBox NewIcBg BgPnc">'.Util::dispLang(Language::WORD_00058)/*必須*/.'</span>';}else{$required = '<span class="IcoBox NewIcBg BgBlu">'.Util::dispLang(Language::WORD_00059)/*任意*/.'</span>';}

?>
								<dl class="clear_fix">
									<dt class="clear_fix"><p class="LayoutL"><?php echo $funcInfo->name.$required; ?></p><?php echo FormUtil::getErrorStrPub($SYS_Result, $Key); ?></dt>
									<dd>
										<?php echo $memberData->getInpuTag($Key,$funcInfo,$SYS_MemInfo); ?>
									</dd>
								</dl>
<?php
	}
?>