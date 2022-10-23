<dl class="DetDlName clear_fix">
	<dt class="name"><?php echo Util::dispLang(Language::WORD_00673);/*購入商品名*/?></dt>
	<dd class="name"><?php echo htmlspecialchars($seminarInfo->name)?></dd>
</dl>
<dl class="DetDlPay clear_fix">
	<dt class="amount"><?php echo Util::dispLang(Language::WORD_00674);/*決済金額*/?></dt>
	<dd class="amount"><?php
if(isset($previewKeyData)){/* プレビュー用処理 */
	$amount = $seminarInfo->dispAmount;
}else{
	$amount = $seminarInfo->getCurrentAmount($session->isLogin(), $session->getMemberApplyService());
}
if(is_numeric($amount)) {
	if(intval($amount) > 0){
		$dispAmount = "<span class='kinagakuTxt'>".number_format($amount)."</span>".Util::dispLang(Language::WORD_00161);/*円（税込み）*/
	}else{
		$dispAmount = "<span class='IcoBox MdIcBg BgYel'>".Util::dispLang(Language::WORD_00162);/*無料*/"</span>";
	}
} else {
	$dispAmount = '-';
}
 echo $dispAmount;?></dd>
</dl>
