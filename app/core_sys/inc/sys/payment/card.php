<?php
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();
if($systemInfo->card_type == 1){/* pay.jp */
		$tmpVal = explode(',',$systemInfo->card_payjp);
}else if($systemInfo->card_type == 2){/* stripe */
		$tmpVal = explode(',',$systemInfo->card_stripe);
}else if($systemInfo->card_type == 3){/* ROBOT PAYMENT */
		$tmpVal = explode(',',$systemInfo->card_roboto_pay);
}else if($systemInfo->card_type == 4){/* UNIVA PAYCAST */
		$tmpVal = explode(',',$systemInfo->card_univapay);
}else{
		$tmpVal = array();
}
if(count($tmpVal) > 0){
	$list = $systemInfo->getPayCardImgList();
?>
								<section class="cardBland">
									<h3 class="systemFotmTitleSub"><?php echo Util::dispLang(Language::WORD_00246);/*利用出来るカードブランド*/?></h3>
									<ul class="cardImg clear_fix">
<?php
	foreach ($list as $key => $val){
		if(in_array($key, $tmpVal)){
?>
										<li><img src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/images/sys/<?php echo $list[$key]; ?>.png"></li>
<?php
		}
	}
?>
									</ul>
								</section>
<?php
}
?>
								<section class="cardSec">
									<h3 class="systemFotmTitleSub"><?php echo Util::dispLang(Language::WORD_00247);/*セキュリティコードについて*/?></h3>
									<div class="cardImg clear_fix">
										<p><img src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/images/sys/card_sec1.png"></p>
										<p><img src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/images/sys/card_sec2.png"></p>
									</div>
								</section>
<?php
if($systemInfo->card_type == 1){/* pay.jp */
?>
								<section class="cardAgt">
									<h3 class="systemFotmTitleSub"><?php echo Util::dispLang(Language::WORD_00248);/*決済会社について*/?></h3>
									<p class="cardAgtLogo"><img src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/images/sys/payjp_logo_b.png"></p>
									<p class="cardAgtName"><?php echo Util::dispLang(Language::WORD_00249);/*本決済はPAY.JPを利用して決済しております。*/?></p>
								</section>
<?php
}else if($systemInfo->card_type == 2){/* stripe */
?>
								<section class="cardAgt">
									<h3 class="systemFotmTitleSub"><?php echo Util::dispLang(Language::WORD_00248);/*決済会社について*/?></h3>
									<p class="cardAgtLogo"><img src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/images/sys/stripe_logo_b.png"></p>
									<p class="cardAgtName"><?php echo Util::dispLang(Language::WORD_00670);/*本決済はSTRIPEを利用して決済しております。*/?></p>
								</section>
<?php
}else if($systemInfo->card_type == 3){/* ROBOT PAYMENT */
?>
								<section class="cardAgt">
									<h3 class="systemFotmTitleSub"><?php echo Util::dispLang(Language::WORD_00248);/*決済会社について*/?></h3>
									<p class="cardAgtLogo"><img src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/images/sys/robotpayment_logo_b.png"></p>
									<p class="cardAgtName"><?php echo Util::dispLang(Language::WORD_00671);/*本決済はROBOT PAYMENTを利用して決済しております。*/?></p>
								</section>
<?php
}else if($systemInfo->card_type == 4){/* UNIVA PAYCAST */
?>
								<section class="cardAgt">
									<h3 class="systemFotmTitleSub"><?php echo Util::dispLang(Language::WORD_00248);/*決済会社について*/?></h3>
									<p class="cardAgtLogo"><img src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/images/sys/univapay_logo_b.png"></p>
									<p class="cardAgtName"><?php echo Util::dispLang(Language::WORD_00672);/*本決済はUNIVA PAYCASTを利用して決済しております。*/?></p>
								</section>
<?php
}
?>
