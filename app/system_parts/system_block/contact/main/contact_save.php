					<section class="contact clear_fix">
						<h2 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00558);/*お問合せの受付が完了いたしました*/?></h2>
<?php
if($tmpInquiryOrderId !== ""){
?>
						<div class="CautTxtW mgt10 cnt">
							<p>
							<?php echo Util::dispLang(Language::WORD_00560);/*お問合せありがとうございます。*/?><br />
							<?php echo Util::dispLang(Language::WORD_00561);/*後日担当よりご連絡させていただきますのでしばらくお待ちください。*/?>
							</p>
						</div>

						<div class="BtM mglra clear_fix">
							<p><button type="button" class="whBT mgt30 mgb30 mglra btWtN next" onclick="location.href='../../'" /><?php echo Util::dispLang(Language::WORD_00299);/* トップページへ進む */?></button></p>
						</div>
<?php
}else{
?>
							<p class="Art mgt10 mgb10"><?php echo Util::dispLang(Language::WORD_00559);/*画面が更新されました。*/?></p>
<?php
}
?>
					</section>