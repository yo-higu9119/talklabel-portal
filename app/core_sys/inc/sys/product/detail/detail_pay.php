							<div class="DetPayArea clear_fix">
								<p class="DetPay"><?php
if(isset($previewKeyData)){/* プレビュー用処理 */
	$amount = $productInfo->dispAmount;
}else{
	$amount = $productInfo->getCurrentAmount($session->isLogin(), $session->getMemberApplyService());
}
if(is_numeric($amount)) {
	if(intval($amount) > 0){
		$dispAmount = "<span class='kinagakuTxt'>".number_format($amount)."</span>".Util::dispLang(Language::WORD_00161);/* 円（税込み） */
	}else{
		$dispAmount = "<span class='IcoBox MdIcBg BgYel'>".Util::dispLang(Language::WORD_00162)."</span>";/* 無料 */
	}
} else {
	$dispAmount = '-';
}
echo $dispAmount;?></p>
							</div>
