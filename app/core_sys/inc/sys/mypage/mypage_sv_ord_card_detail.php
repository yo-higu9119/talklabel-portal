<?php
			if($gmo_orderInfo->id > 0){
?>
				<dl>
					<dt><?php echo Util::dispLang(Language::WORD_00710);/*ご利用カード*/?></dt>
					<dd>**** **** **** <?php echo $gmo_orderInfo->card_no;?><?php echo Util::dispLang(Language::WORD_00711);/*（下4桁）*/?></dd>
				</dl>
<?php
			}else{
?>
				<dl>
					<dt><?php echo Util::dispLang(Language::WORD_00710);/*ご利用カード*/?></dt>
					<dd><?php echo Util::dispLang(Language::WORD_00712);/*登録なし*/?></dd>
				</dl>
<?php
			}
?>
