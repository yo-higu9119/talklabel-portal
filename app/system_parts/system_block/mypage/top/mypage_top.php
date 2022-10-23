					<section class="mypage clear_fix">

						<div class="htibrd clear_fix">
							<h2><?php echo Util::dispLang(Language::WORD_00286);/*登録情報*/?></h2>
						</div>

						<div class="clear_fix">
							<div class="mypageDet hlfCln LayoutL clear_fix">
<?php
	foreach($memberData->Column['base'] as $Key => $funcInfo) {
?>
								<dl class="clear_fix">
									<dt><?php echo $funcInfo->name; ?></dt>
									<dd><?php
		if($funcInfo->type === 11){/* 画像 */
			$value = $SYS_MemInfo->data[$Key];
			if($value !== ""){
				$imgPath = htmlspecialchars('../../core_sys/sys/file/get_member_file.php?id=9&type=_m');
?>
									<div id="file_view">
										<figure class="FileUpImg"><img src="<?php echo $imgPath;?>"></figure>
										<p class="FileUpName"><a href="<?php echo $imgPath;?>" target="_blank"><?php echo htmlspecialchars($value);?></a></p>
									</div>
<?php
			}else{
				echo "-";
			}
		}else{
			echo $memberData->getDisplayTag($Key,$funcInfo,$SYS_MemInfo);
		}
									?></dd>
								</dl>
<?php
	}
?>
							</div>
							<div class="mypageDet hlfCln LayoutR clear_fix">
								<dl class="clear_fix">
									<dt>Facebook</dt>
									<dd><?php echo (is_null($SYS_MemInfo->facebook_id) || $SYS_MemInfo->facebook_id == "")?Util::dispLang(Language::WORD_00289)/*連携無し*/:Util::dispLang(Language::WORD_00290)/*連携有り*/; ?></dd>
								</dl>
								<dl class="clear_fix">
									<dt>Twitter</dt>
									<dd><?php echo (is_null($SYS_MemInfo->twitter_id) || $SYS_MemInfo->twitter_id == "")?Util::dispLang(Language::WORD_00289)/*連携無し*/:Util::dispLang(Language::WORD_00290)/*連携有り*/; ?></dd>
								</dl>
								<dl class="clear_fix">
									<dt>Line</dt>
									<dd><?php echo (is_null($SYS_MemInfo->line_id) || $SYS_MemInfo->line_id == "")?Util::dispLang(Language::WORD_00289)/*連携無し*/:Util::dispLang(Language::WORD_00290)/*連携有り*/; ?></dd>
								</dl>
								<dl class="clear_fix">
									<dt><?php echo Util::dispLang(Language::WORD_00288);/*最終ログイン日時*/?></dt>
									<dd><?php echo is_null($SYS_MemInfo->last_login)?'-':date("Y/m/d H:i:s",strtotime($SYS_MemInfo->last_login)); ?></dd>
								</dl>
							</div>
						</div>
					</section>
