								<dl class="clear_fix">
									<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00633)/*現在のパスワード*/?><span class="IcoBox NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
									<dd><?php
		echo '<p>'.FormUtil::input("password", 'old_pass', "", 4, 16, 'txt size300', "-", true).'</p>';
									?>
									<p><?php echo FormUtil::getErrorStrPub($SYS_Result, 'old_pass'); ?></p></dd>
								</dl>

<?php
	foreach($memberData->Column['base'] as $Key => $funcInfo) {
		if($funcInfo->required === 1){$required = '<span class="IcoBox NewIcBg BgPnc">'.Util::dispLang(Language::WORD_00058)/*必須*/.'</span>';}else{$required = '<span class="IcoBox NewIcBg BgBlu">'.Util::dispLang(Language::WORD_00059)/*任意*/.'</span>';}
			$SYS_MemInfo->pass = "";
			$SYS_MemInfo->data['INPUT00002'] = "";
?>
								<dl class="clear_fix">
									<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00634)/*新しいパスワード*/.$required; ?></p></dt>
									<dd><?php
			echo $memberData->getInpuTag($Key,$funcInfo,$SYS_MemInfo);
									?>
									<p><?php echo FormUtil::getErrorStrPub($SYS_Result, $Key); ?></p></dd>
								</dl>
								<dl class="clear_fix">
									<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00635)/*新しいパスワード（確認）*/; ?></p></dt>
									<dd><?php
		echo '<p>'.FormUtil::input("password", 'passcheck', "", 4, 16, 'txt size300', "-", true).'</p>';
									?>
									<p><?php echo FormUtil::getErrorStrPub($SYS_Result, 'passcheck'); ?></p></dd>
								</dl>
<?php
	}
?>
