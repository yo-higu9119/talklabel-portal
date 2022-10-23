				<div class="comBox order_Box">
					<h2 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00433);/*購入が完了いたしました*/?></h2>
<?php
if($sErr !== ""){
?>
					<p class="Art mgt10 mgb10 cnt"><?php echo htmlspecialchars($sErr);?></p>
<?php
}else{
?>
					<div class="CautTxtW mgt10 cnt">
						<p><?php echo Util::dispLang(Language::WORD_00434);/*購入ありがとうございました。*/?></p>
					</div>

					<div class="BtM mglra clear_fix">
						<p><button type="button" class="whBT mgt30 mgb30 mglra btWtN next" onclick="location.href='../../'" /><?php echo Util::dispLang(Language::WORD_00299);/* トップページへ進む */?></button></p>
					</div>
<?php
}
?>
				</div>
