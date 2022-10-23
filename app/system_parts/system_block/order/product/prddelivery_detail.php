				<div class="comBox order_Box">
					<h2 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00416);/*配送先を入力してください*/?></h2>
<?php
if($sErr == ""){
	if($SYS_Message !== '') {
?>
					<p class="Art mgt10 mgb10 cnt"><?php echo htmlspecialchars($SYS_Message);?></p>
<?php
	}
?>
<!--					<section class="selectBt">
						<ul class="clear_fix cl2">
							<li><input type="radio" name="settle_type" value="1" checked="checked" onclick="ch_type(false)" id="settle_type1" /><label class="tab_item" for="settle_type1">1つの送付先を指定</label></li>
							<li><input type="radio" name="settle_type" value="2" onclick="ch_type(false)" id="settle_type2" /><label class="tab_item" for="settle_type2">複数の送付先を指定</label></li>
						</ul>
					</section>-->

					<div id="form3">
						<section class="addArea clear_fix" id="delivery_address">
							<div class="cardAjx" style="text-align:center;display:none;" id="loading_delivery_address">
									<p><img src="../../core_sys/common/images/sys/ajax-loader.gif"></p><p>Loading...</p>
							</div>
						</section>
					</div>

					<h2 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00590);/*配送希望日時を入力してください*/?></h2>
<?php
	if($productSystemInfo->business_remarks !== ""){/* 定休日注意文 */
		echo $productSystemInfo->business_remarks;
	}
?>

<?php
	/* 0:OK 1:全休 2:午前休 3:午後休 4:時間外 */
	$res = isOpen($productSystemInfo, date("Y/m/d H:i:s"));/* 現在日時の定休日チェック */
	if($res == 1){/* 全休 */
?>
					<p class="Art mgt10 mgb10 cnt">本日は休業のため準備出来次第配送は選択できません。<br />営業開始後の希望日時を設定してください。</p>
<?php
	}else if($res == 2){/* 午前休 */
?>
					<p class="Art mgt10 mgb10 cnt">午前休業のため準備出来次第配送は選択できません。<br />受付時間内での希望日時を設定してください。</p>
<?php
	}else if($res == 3){/* 午後休 */
?>
					<p class="Art mgt10 mgb10 cnt">午後休業のため準備出来次第配送は選択できません。<br />受付時間内での希望日時を設定してください。</p>
<?php
	}else if($res == 4){/* 時間外 */
?>
					<p class="Art mgt10 mgb10 cnt">現在営業時間外のため準備出来次第配送は選択できません。<br />受付時間内での希望日時を設定してください。</p>
<?php
	}
?>
					<div class="comBoxInn mgt10 mgb20 clear_fix">
						<section class="InputForm">
							<dl class="clear_fix">
								<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00594);/*希望有無*/?><span class="NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
								<dd>
									<ul class="clear_fix">
<?php
	if($res == 0){
?>
										<li class="LayoutL"><label class="radio_text"><?php echo FormUtil::radio('delivery_type', 1, 1, ' onclick="ch_delitype(false)"')?><?php echo Util::dispLang(Language::WORD_00595);/*準備出来次第配送*/?></label></li>
<?php
	}
?>
										<li class="LayoutL"><label class="radio_text"><?php echo FormUtil::radio('delivery_type', 2, (($res == 0)?1:2), ' onclick="ch_delitype(false)"')?><?php echo Util::dispLang(Language::WORD_00596);/*希望日時を設定する*/?></label></li>
									</ul>
								</dd>
							</dl>
							<div id="deliv_kbou">
								<dl class="clear_fix">
									<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00591);/*第1希望*/?><span class="NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
									<dd>
										<p><?php echo FormUtil::textbox('deli_day1', '', 4, 4, 'size200 txt input_date datepicker', '', 'required'); ?>　<?php echo FormUtil::textbox('deli_h1', '', 2, 2, 'sizeMD txt', '', 'required'); ?> 時<?php echo FormUtil::textbox('deli_m1', '', 2, 2, 'sizeMD txt', '', 'required'); ?> 分<?php echo FormUtil::getErrorStr($result, 'deli1');?></p>
									</dd>
								</dl>
								<dl class="clear_fix">
									<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00592);/*第2希望*/?><span class="NewIcBg BgBlu"><?php echo Util::dispLang(Language::WORD_00059);/*任意*/?></span></p></dt>
									<dd>
										<p><?php echo FormUtil::textbox('deli_day2', '', 4, 4, 'size200 txt input_date datepicker', ''); ?>　<?php echo FormUtil::textbox('deli_h2', '', 2, 2, 'sizeMD txt', ''); ?> 時<?php echo FormUtil::textbox('deli_m2', '', 2, 2, 'sizeMD txt', ''); ?> 分<?php echo FormUtil::getErrorStr($result, 'deli2');?></p>
									</dd>
								</dl>
								<dl class="clear_fix">
									<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00593);/*第3希望*/?><span class="NewIcBg BgBlu"><?php echo Util::dispLang(Language::WORD_00059);/*任意*/?></span></p></dt>
									<dd>
										<p><?php echo FormUtil::textbox('deli_day3', '', 4, 4, 'size200 txt input_date datepicker', ''); ?>　<?php echo FormUtil::textbox('deli_h3', '', 2, 2, 'sizeMD txt', ''); ?> 時<?php echo FormUtil::textbox('deli_m3', '', 2, 2, 'sizeMD txt', ''); ?> 分<?php echo FormUtil::getErrorStr($result, 'deli3');?></p>
									</dd>
								</dl>
							</div>
						</section>
					</div>

					<h2 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00597);/*その他注文に関する要望があれば入力してください*/?></h2>

					<div class="comBoxInn mgt10 mgb20 clear_fix">
						<p><?php echo FormUtil::textArea('remarks', "", 50, 10, 'txt size100p', '-')?></p>
					</div>

					<section class="CautTxt mgt10 cnt">
						<p><?php echo Util::dispLang(Language::WORD_00231);/*上記内容で問題ありませんか？*/?><br />
						<?php echo Util::dispLang(Language::WORD_00228);/*問題なければ「次へ進む」ボタンをクリックして進んでください。*/?>
						</p>
					</section>

					<div class="BtM mglra clear_fix spBtM spLR">
						<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 btWtM back" onclick="location.href='./personal.php'" /><?php echo Util::dispLang(Language::WORD_00064);/*前の画面に戻る*/?></button></p>
						<p class="LayoutR"><button type="button" class="blBT mgt20 mgb10 btWtM next" onclick="$('#act').attr('action', 'delivery.php');$('#act').submit();" /><?php echo Util::dispLang(Language::WORD_00229);/*次へ進む*/?></button></p>
					</div>
<?php
}else{
?>
					<section class="CautTxt mgt20 mgb20 cnt">
						<p><?php echo $sErr; ?></p>
					</section>
					<div class="BtM mglra clear_fix">
						<p><button type="button" class="whBT mglra mgt20 mgb10 btWtW back" onclick="location.href='./personal.php'" /><?php echo Util::dispLang(Language::WORD_00064);/*前の画面に戻る*/?></button></p>
					</div>
<?php
}
?>
				</div>