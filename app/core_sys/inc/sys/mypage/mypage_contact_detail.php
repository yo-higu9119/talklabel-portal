		<section class="mypageOrdBox">
			<div class="mypageOrdBoxInn">
				<dl>
					<dt><?php echo Util::dispLang(Language::WORD_00449);/*受付日時*/?></dt>
					<dd><?php echo date("Y年m月d日 H時i分",strtotime($value->regist_timestamp)); ?></dd>
				</dl>
				<dl>
					<dt><?php echo Util::dispLang(Language::WORD_00450);/*お問合せ番号*/?></dt>
					<dd><?php echo sprintf("%07d",$value->id); ?></dd>
				</dl>
<?php
	if(count($inquiryData->Column['master']) !== 0 || count($inquiryData->Column['other']) !== 0){
		foreach($inquiryData->Column['master'] as $Key => $funcInfo) {
?>
				<dl>
					<dt><?php echo $funcInfo->name; ?></dt>
					<dd><?php echo $inquiryData->getInputDisplay($Key,$funcInfo,$inquiryInfo); ?></dd>
				</dl>
<?php
		}
		foreach($inquiryData->Column['other'] as $Key => $funcInfo) {
			if($funcInfo->type !== 11){
?>
				<dl>
					<dt><?php echo $funcInfo->name; ?></dt>
					<dd><?php echo $inquiryData->getInputDisplay($Key,$funcInfo,$inquiryInfo); ?></dd>
				</dl>
<?php
			}
		}
	}
?>
				<dl>
					<dt><?php echo Util::dispLang(Language::WORD_00451);/*お問合せ日時*/?></dt>
					<dd><?php echo date("Y年m月d日 H時i分",strtotime($value->regist_timestamp)); ?></dd>
				</dl>
				<dl>
					<dt><?php echo Util::dispLang(Language::WORD_00452);/*事務局からの回答日時*/?></dt>
					<dd><?php echo (!is_null($value->reply_date) && $value->reply_date !== "")?date("Y年m月d日 H時i分",strtotime($value->reply_date)):"-"; ?></dd>
				</dl>
				<dl>
					<dt><?php echo Util::dispLang(Language::WORD_00453);/*事務局からの回答*/?></dt>
					<dd><?php echo (!is_null($value->reply) && $value->reply !== "")?str_replace("\r\n","<br />",$value->reply):"-"; ?></dd>
				</dl>
			</div>
		</section>
