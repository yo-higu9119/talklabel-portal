						<div class="htibrd clear_fix">
							<h2><?php echo Util::dispLang(Language::WORD_00524);/*振込先情報*/?></h2>
						</div>
						<div class="mypageInput clear_fix mgb30">
<?php
if($message !== '') {
?>
							<p class="Art cnt mgt20 mgb10"><?php echo htmlspecialchars($message)?></p>
<?php
}
?>
							<section class="InputForm">
								<dl class="clear_fix">
									<dt><?php echo Util::dispLang(Language::WORD_00525);/*金融機関名*/?></dt>
									<dd><p><?php echo FormUtil::textbox('financial_name', $accInfo->financial_name, 10, 300, 'txt size300', 'みずほ銀行').FormUtil::getErrorStr($result, 'financial_name')?></p></dd>
								</dl>
								<dl class="clear_fix">
									<dt><?php echo Util::dispLang(Language::WORD_00526);/*金融機関コード*/?></dt>
									<dd>
										<p><?php echo FormUtil::textbox('financial_code', $accInfo->financial_code, 10, 4, 'txt size200', '0001').FormUtil::getErrorStr($result, 'financial_code')?></p>
										<p class="CautTxtS mgt10">※半角数字4桁でご記入ください。<br />
										※金融機関コード・銀行コード・支店コードが不明の場合は、<a href="https://zengin.ajtw.net/" target="_blank">こちら</a>からご確認いただけます。</p>
									</dd>
								</dl>
								<dl class="clear_fix">
									<dt><?php echo Util::dispLang(Language::WORD_00527);/*支店名*/?></dt>
									<dd>
										<p><?php echo FormUtil::textbox('branch_name', $accInfo->branch_name, 10, 300, 'txt size300', '○○支店').FormUtil::getErrorStr($result, 'branch_name')?></p>
									</dd>
								</dl>
								<dl class="clear_fix">
									<dt><?php echo Util::dispLang(Language::WORD_00528);/*支店コード*/?></dt>
									<dd>
										<p><?php echo FormUtil::textbox('branch_code', $accInfo->branch_code, 10, 3, 'txt size200', '000').FormUtil::getErrorStr($result, 'branch_code')?></p>
										<p class="CautTxtS mgt10"><?php echo Util::dispLang(Language::WORD_00529);/*※半角数字3桁でご記入ください。*/?><br />
										<?php echo Util::dispLang(Language::WORD_00530);/*※ゆうちょ銀行を登録される場合は、振込用の店名・口座番号が必要です。*/?><br />
										※記号番号しかわからない場合は、振込用の店名・口座番号は<a href="https://www.jp-bank.japanpost.jp/kojin/sokin/furikomi/kouza/kj_sk_fm_kz_1.html" target="_blank">ゆうちょ銀行のホームページ</a>でお調べいただけます。</p>
									</dd>
								</dl>
								<dl class="clear_fix">
									<dt><?php echo Util::dispLang(Language::WORD_00531);/*口座種別*/?></dt>
									<dd>
										<ul class="clear_fix">
<?php
	$tmpList = $accInfo->getType();
	foreach ($tmpList as $key => $val){
?>
											<li><label class="radio_text"><?php echo FormUtil::radio('acc_type', $key, $accInfo->acc_type)?><?php echo $val;?></label></li>
<?php
	}
?>
										</ul>
									</dd>
								</dl>
								<dl class="clear_fix">
									<dt><?php echo Util::dispLang(Language::WORD_00532);/*口座番号*/?></dt>
									<dd>
										<p><?php echo FormUtil::textbox('acc_no', $accInfo->acc_no, 10, 7, 'txt size200', '1234567').FormUtil::getErrorStr($result, 'acc_no')?></p>
										<p class="CautTxtS mgt10"><?php echo Util::dispLang(Language::WORD_00533);/*※半角数字7桁でご記入ください。*/?><br />
										<?php echo Util::dispLang(Language::WORD_00534);/*※口座番号が7桁に満たない場合は、先頭部分に「0」を入力して、全部で7桁となるようにご入力ください。*/?></p>
									</dd>
								</dl>
								<dl class="clear_fix">
									<dt><?php echo Util::dispLang(Language::WORD_00535);/*口座名義人（カナ）*/?></dt>
									<dd>
										<p><?php echo FormUtil::textbox('name_kana', $accInfo->name_kana, 10, 300, 'txt size300', '-').FormUtil::getErrorStr($result, 'name_kana')?></p>
										<p class="CautTxtS mgt10"><?php echo Util::dispLang(Language::WORD_00536);/*※通帳に記載された口座名義を正確に登録してください。*/?><br />
										<?php echo Util::dispLang(Language::WORD_00537);/*※名義が異なる場合、送金が遅れる可能性がございますのでご注意ください。*/?><br />
										<?php echo Util::dispLang(Language::WORD_00538);/*※入力方法は、全角カタカナ・全角英数字・全角記号（，．‐－ー／（）「」￥スペース）にてお願いいたします。*/?></p>
									</dd>
								</dl>
								<dl class="clear_fix">
									<dt><?php echo Util::dispLang(Language::WORD_00539);/*口座名義人（漢字）*/?></dt>
									<dd>
										<p><?php echo FormUtil::textbox('name', $accInfo->name, 10, 300, 'txt size300', '-').FormUtil::getErrorStr($result, 'name')?></p>
									</dd>
								</dl>
							</section>

							<div class="BtM mglra clear_fix">
								<input type="hidden" name="mode" value="save">
								<p><button type="submit" class="whBT mgt20 mgb10 mglra btWtW" /><?php echo Util::dispLang(Language::WORD_00294);/*入力内容の保存*/?></button></p>
							</div>

						</div>
