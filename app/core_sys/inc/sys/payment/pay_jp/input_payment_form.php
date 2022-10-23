<?php
$cardList = array();
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();
$CardImgList = $systemInfo->getPayCardImgList();

require_once '/var/www/pay_jp/init.php';
$user_tkn = $session->getMemberNumber();
		
Payjp\Payjp::setApiKey($systemInfo->getSkKey());
try {
	$result = \Payjp\Customer::retrieve($user_tkn)->cards->all(array("limit"=>10, "offset"=>0));
	$cardList = $result->data;
} catch (Exception $e) {
}
?>
									<section class="InputForm">
										<dl class="clear_fix">
											<dd>
												<p><label class="radio_text"><?php echo FormUtil::radio('cardfinger', '', '', 'onclick="ch_card(false)"');?><?php echo Util::dispLang(Language::WORD_00236);/*カード情報を入力する*/?></label></p>
											</dd>
										</dl>
<?php
if(count($cardList) > 0){
	foreach ($cardList as $key => $val){
		$BrandNo = $systemInfo->getPayCardBrandToNo($val['brand']);
		if($BrandNo != 0){
			$img = '<span style="top:20px;margin:10px;"><img src="../../core_sys/common/images/sys/'.$CardImgList[$BrandNo].'.png" style="vertical-align:middle;" width="40" ></span>';
			$cardNo = $systemInfo->getCardMaskStr($BrandNo, $val['last4']);
			$cardName = $val['name'];
			$fingerprint = $val['fingerprint'];
			$exp = sprintf("%02d/%02d",$val['exp_month'] ,substr($val['exp_year'], -2, 2));
		}else{
			continue;
		}
?>
										<dl class="clear_fix">
											<dd>
												<p><label class="radio_text"><?php echo FormUtil::radio('cardfinger', $fingerprint, '', 'onclick="ch_card(false)"');?><?php echo $img.$cardNo.' '.$exp.' '.$cardName; ?></label></p>
											</dd>
										</dl>
<?php
	}
}
?>
									</section>
									<section class="InputForm" id="newCardInput">
										<dl class="clear_fix">
											<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00237);/*カード番号*/?><span class="IcoBox NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span><span style="top:20px;margin:10px;" id="card_img"></span></p></dt>
											<dd>
												<p><div id="number-form" class="payjs-outer"></div></p>
												<hr class="hiddenborder pay-cardnumber" style="transform: scaleX(0);">
												
											</dd>
										</dl>
										<dl class="clear_fix">
											<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00239);/*カード名義人*/?><span class="IcoBox NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
											<dd>
												<p><input type="text" inputtype="email" name="crd_name" size="10" value="" maxlength="100" class="txt size400 crd_name" style="text-transform: uppercase;" autocomplete="cc-name" autocorrect="off" placeholder="<?php echo Util::dispLang(Language::WORD_00240);/*ローマ字で入力してください*/?>"  required /></p>
												<hr class="hiddenborder" style="transform: scaleX(0);">
											</dd>
										</dl>
										<dl class="clear_fix">
											<dt><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00241);/*有効期限*/?><span class="IcoBox NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
											<dd>
												<p><div id="expiry-form" class="payjs-outer"></div></p>
												<hr class="hiddenborder pay-exp" style="transform: scaleX(0);">
											</dd>
										</dl>
										<dl class="clear_fix">
											<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00244);/*セキュリティコード*/?><span class="IcoBox NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
											<dd>
												<p><div id="cvc-form" class="payjs-outer"></div></p>
												<hr class="hiddenborder pay-cvc" style="transform: scaleX(0);">
											</dd>
										</dl>
									</section>
