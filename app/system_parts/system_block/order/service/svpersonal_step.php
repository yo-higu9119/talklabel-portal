			<div class="step_flow ">
				<ul class="clear_fix">
					<li class="crt"><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00218);/*個人情報*/?></p><p class="flow_com"><?php echo Util::dispLang(Language::WORD_00223);/*必要事項を入力してください*/?></p></li>
<?php
if(isset($money) && $money > 0){
?>
					<li><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00219);/*決済情報*/?></p><p class="flow_com"><?php echo Util::dispLang(Language::WORD_00223);/*必要事項を入力してください*/?></p></li>
<?php
}
?>
					<li><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00220);/*最終確認*/?></p><p class="flow_com"><?php echo Util::dispLang(Language::WORD_00224);/*申込内容を確認してください*/?></p></li>
					<li><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00221);/*申込完了*/?></p><p class="flow_com"><?php echo Util::dispLang(Language::WORD_00225);/*申込完了しました*/?></p></li>
				</ul>
			</div>
