<?php
	foreach($memberData->Column['other'] as $Key => $funcInfo) {
		if($funcInfo->required === 1){$required = '<span class="IcoBox NewIcBg BgPnc">'.Util::dispLang(Language::WORD_00058)/*必須*/.'</span>';}else{$required = '<span class="IcoBox NewIcBg BgBlu">'.Util::dispLang(Language::WORD_00059)/*任意*/.'</span>';}
?>
								<dl class="clear_fix">
									<dt class="clear_fix"><p class="LayoutL"><?php echo $funcInfo->name.$required; ?></p><?php echo FormUtil::getErrorStrPub($SYS_Result, $Key); ?></dt>
									<dd><?php
		if($funcInfo->type === 11){/* 画像アップロード */
			$str = "";
			$value = $SYS_MemInfo->data[$Key];
			echo FormUtil::hidden('file_name'.$funcInfo->id, $value);
			echo FormUtil::hidden('file_operation'.$funcInfo->id, (trim($value)===''?0:1));/*0:無し(削除)/1:有り/2:Tmp有り*/

			if(isset($_POST['file_operation'.$funcInfo->id]) && intval($_POST['file_operation'.$funcInfo->id])===2) {
				$rVal = 2;
			} else {
				$rVal = 1;
			}
			$imgPath = htmlspecialchars('../../core_sys/sys/file/get_file.php?type=8&r='.$rVal.'&id='.$SYS_MemInfo->id.'&sub='.$funcInfo->id.'&f='.trim($value));
			$display_view = trim($value)===''?' style="display:none;"':'';
			$display_up = trim($value)!==''?' style="display:none;"':'';
			$value_esc = htmlspecialchars($value);
?>
									<div id="file_view<?php echo $funcInfo->id;?>"<?php echo $display_view;?>>
										<figure class="FileUpImg"><a href="<?php echo $imgPath;?>" target="_blank"><img src="<?php echo $imgPath;?>"></a></figure>
										<p class="FileUpName"><a href="<?php echo $imgPath;?>" target="_blank"><?php echo $value_esc;?></a></p>
										<div class="fileDelBT mgt10 mgb10"><a href="#" id="file_del<?php echo $funcInfo->id;?>" class="file_del"><?php echo Util::dispLang(Language::WORD_00629);/*ファイル削除*/?></a></div>
									</div>
									<div id="file_up<?php echo $funcInfo->id;?>" class="fileUpBT mgt10 mgb10"<?php echo $display_up;?>>
<?php if (IS_SMART_PHONE) { ?>
										<a href="javascript:utilOpenFrame('../../file_up/upload/pop_upload.php?type=8&amp;id=<?php echo $SYS_MemInfo->id;?>&amp;sub=<?php echo $funcInfo->id;?>', false, 20, 350, 600);"><?php echo Util::dispLang(Language::WORD_00454);/*ファイルアップロード*/?></a>
<?php } else { ?>
										<a href="javascript:utilOpenFrame('../../file_up/upload/pop_upload.php?type=8&amp;id=<?php echo $SYS_MemInfo->id;?>&amp;sub=<?php echo $funcInfo->id;?>', false, 20, 920, 700);"><?php echo Util::dispLang(Language::WORD_00454);/*ファイルアップロード*/?></a>
<?php } ?>
									</div>
<?php
		}else{
			echo $memberData->getInpuTag($Key,$funcInfo,$SYS_MemInfo); 
		}
									?></dd>
								</dl>
<?php
	}
?>