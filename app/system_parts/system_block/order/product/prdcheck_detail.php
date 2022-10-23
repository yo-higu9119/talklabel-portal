				<div class="comBox order_Box">
					<h2 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00429);/*購入内容の最終確認*/?></h2>
<?php
if($sErr !== ""){
?>
					<p class="Art mgt10 mgb10 cnt"><?php echo htmlspecialchars($sErr);?></p>
<?php
}else{
?>
					<h3 class="fotm_ti"><?php echo Util::dispLang(Language::WORD_00217);/*選択内容*/?></h3>
					<div class="FChkBox clear_fix">
						<div class="cardAjx" style="text-align:center;display:none;" id="loading_carttList">
								<p><img src="../../core_sys/common/images/sys/ajax-loader.gif"></p><p>Loading...</p>
						</div>

						<div id="cartDisp">
						</div>
					</div>
					<h3 class="fotm_ti"><?php echo Util::dispLang(Language::WORD_00405);/*配送先情報*/?></h3>
<?php
	$area_array = Master::getPrefectureList();
?>
					<section class="FChkBox clear_fix">
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00420);/*氏名*/?></dt>
							<dd><p class="chpd chonefd"><?php echo htmlspecialchars($addressInfo->name); ?></p></dd>
						</dl>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00421);/*電話番号*/?></dt>
							<dd><p class="chpd chonefd"><?php echo htmlspecialchars($addressInfo->tel); ?></p></dd>
						</dl>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00432);/*郵便番号*/?></dt>
							<dd><p class="chpd chonefd"><?php echo htmlspecialchars($addressInfo->zip); ?></p></dd>
						</dl>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00422);/*住所*/?></dt>
							<dd><p class="chpd chonefd"><?php echo htmlspecialchars($area_array[$addressInfo->area].$addressInfo->add1.$addressInfo->add2); ?></p></dd>
						</dl>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00423);/*会社名（オプション）*/?></dt>
							<dd><p class="chpd chonefd"><?php echo ($addressInfo->company !== "")?htmlspecialchars($addressInfo->company):'-'; ?></p></dd>
						</dl>
					</section>

					<h3 class="fotm_ti"><?php echo Util::dispLang(Language::WORD_00599);/*配送希望日時*/?></h3>
					<section class="FChkBox clear_fix">
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00594);/*希望有無*/?></dt>
							<dd><p class="chpd chonefd"><?php
							if($delivery_type == 1){
								echo Util::dispLang(Language::WORD_00595);/*準備出来次第配送*/
							}else{
								echo Util::dispLang(Language::WORD_00596);/*希望日時を設定する*/
							}
							?></p></dd>
						</dl>
<?php
	if($delivery_type == 2){
		if(isset($deli_list[1])){
?>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00591);/*第1希望*/?></dt>
							<dd><p class="chpd chonefd"><?php echo $deli_list[1]; ?></p></dd>
						</dl>
<?php
		}
		if(isset($deli_list[2])){
?>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00592);/*第2希望*/?></dt>
							<dd><p class="chpd chonefd"><?php echo $deli_list[2]; ?></p></dd>
						</dl>
<?php
		}
		if(isset($deli_list[3])){
?>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00593);/*第3希望*/?></dt>
							<dd><p class="chpd chonefd"><?php echo $deli_list[3]; ?></p></dd>
						</dl>
<?php
		}
	}
?>
					</section>

					<h3 class="fotm_ti"><?php echo Util::dispLang(Language::WORD_00600);/*その他注文に関する要望*/?></h3>
					<section class="FChkBox clear_fix">
						<p><?php echo ($remarks != "")?str_replace("\r\n","<br />",$remarks):"-"; ?></p>
					</section>
<?php
	if($total_amount > 0){
?>
					<h3 class="fotm_ti">決済方法</h3>
					<section class="FChkBox clear_fix">
						<dl class="clear_fix">
							<dd><p class="chpd chonefd"><?php
		if($pay_type == 0){
			echo "代金引換";
		}else if($pay_type == 1){
			echo "銀行振込";
		}else if($pay_type == 2){
			echo "クレジットカード";
		}
							?></p></dd>
						</dl>
					</section>
<?php
	}
?>

					<h3 class="fotm_ti"><?php echo Util::dispLang(Language::WORD_00403);/*購入者情報*/?></h3>
					<section class="FChkBox clear_fix">
<?php
	foreach($memberData->Column['base'] as $Key => $funcInfo) {
		if($funcInfo->type !== 11){
?>
						<dl class="clear_fix">
							<dt><?php echo $funcInfo->name; ?></dt>
							<dd><?php
echo $memberData->getDisplayTag($Key,$funcInfo,$SYS_MemInfo);
							?></dd>
						</dl>
<?php
		}
	}
?>
					</section>

					<section class="CautTxt mgt10 cnt">
						<p><?php echo Util::dispLang(Language::WORD_00231);/*上記内容で問題ありませんか？*/?><br />
						<?php echo Util::dispLang(Language::WORD_00430);/*問題なければ下記「購入を完了する」ボタンをクリックしてください。*/?>
						</p>
					</section>
<?php
}
?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/pay_loader.php';?>

					<div class="BtM mglra clear_fix spBtM spLR">
						<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 btWtM back" id="bk_bt" onclick="$('#from_page').submit();" /><?php echo Util::dispLang(Language::WORD_00064);/*前の画面に戻る*/?></button></p>
<?php
if($sErr == ""){
?>
						<p class="LayoutR"><button type="button" class="orBT mgt20 mgb10 btWtM next" id="fc_bt" onclick="load_efect();$('#to_page').submit();" /><?php echo Util::dispLang(Language::WORD_00431);/*購入を完了する*/?></button></p>
<?php
}
?>
					</div>
<form method="post" action="<?php echo $fromPage; ?>" id="from_page">
<?php echo $hiddenStr1;?>
</form>
<form method="post" action="final_save.php" id="to_page">
<?php echo $hiddenStr2;?>
</form>
				</div>
