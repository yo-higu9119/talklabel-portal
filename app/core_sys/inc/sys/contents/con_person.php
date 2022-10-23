<?php
if($info->createrDisp){
?>
					<section class="authorBox clear_fix">
<?php
	if($info->accounInfo["img_name"] != ""){
?>
						<figure class="authorPhoto"><img src="../../core_sys/sys/file/get_prof_file.php?id=<?php echo $info->accountId; ?>"></figure>
<?php
	}
?>
						<div class="authorDetail">
							<p class="authorDetTi"><?php echo Util::dispLang(Language::WORD_00067);/* この記事を書いた人 */?></p>
							<p class="authorDetName"><?php echo htmlspecialchars($info->accounInfo['name'])?></p>
							<p class="authorDetCorp"><?php echo htmlspecialchars($info->accounInfo['aff'])?></p>
							<p class="authorDetProf"><?php echo str_replace("\r\n","<br />",$info->accounInfo['profile'])?></p>
						</div>
					</section>
<?php
}
?>
