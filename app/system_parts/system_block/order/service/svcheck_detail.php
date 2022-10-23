				<div class="comBox order_Box">
					<h2 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00263);/*申込内容の最終確認*/?></h2>
<?php
if($sErr !== ""){
?>
					<p class="Art mgt10 mgb10 cnt"><?php echo htmlspecialchars($sErr);?></p>
<?php
}else{
?>
					<h3 class="fotm_ti"><?php echo Util::dispLang(Language::WORD_00217);/*選択内容*/?></h3>
					<section class="FChkBox clear_fix">
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00556);/*サービス名*/?></dt>
							<dd><?php echo $itemInfo->name; ?></dd>
						</dl>
<?php
		if($itemInfo->type == 1){/* 1:都度 */
?>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00312);/*決済種別*/?></dt>
							<dd><?php echo Util::dispLang(Language::WORD_00313);/*都度決済*/?></dd>
						</dl>
						<dl class="clear_fix">
							<dt>料金</dt>
							<dd><?php echo number_format($itemInfo->money); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
						</dl>
<?php
		}else if($itemInfo->type == 2){/* 2:継続 */
?>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00312);/*決済種別*/?></dt>
							<dd><?php echo Util::dispLang(Language::WORD_00316);/*継続（毎月）決済*/?></dd>
						</dl>
<?php
			if($itemInfo->pay_timing == 2){
?>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00317);/*無料月数*/?></dt>
							<dd><?php echo $itemInfo->split; ?><?php echo Util::dispLang(Language::WORD_00318);/*ヶ月無料*/?></dd>
						</dl>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00319);/*手数料*/?></dt>
							<dd><?php echo number_format($itemInfo->init_money); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
						</dl>
<?php
			}
?>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00320);/*毎月料金*/?></dt>
							<dd><?php echo number_format($itemInfo->money); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
						</dl>
<?php
		}else{/* 3:分割 */
?>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00312);/*決済種別*/?></dt>
							<dd><?php echo Util::dispLang(Language::WORD_00321);/*分割決済*/?></dd>
						</dl>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00319);/*手数料*/?></dt>
							<dd><?php echo number_format($itemInfo->spl[0]); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
						</dl>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00322);/*合計料金*/?></dt>
							<dd><?php echo number_format(array_sum ($itemInfo->spl)); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
						</dl>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00323);/*分割回数*/?></dt>
							<dd><?php echo $itemInfo->split; ?><?php echo Util::dispLang(Language::WORD_00324);/*回*/?></dd>
						</dl>
<?php
		}
		if($itemInfo->remarks !== ""){
?>
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00325);/*サービス説明*/?></dt>
							<dd><?php echo str_replace("\r\n","<br />",$itemInfo->remarks);?></dd>
						</dl>
<?php
		}
?>
					</section>

					<h3 class="fotm_ti"><?php echo Util::dispLang(Language::WORD_00264);/*支払い方法*/?></h3>
					<section class="FChkBox clear_fix">
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00264);/*支払い方法*/?></dt>
							<dd><?php echo (intval($_POST['pay_type']) == 1)?Util::dispLang(Language::WORD_00260)/* 銀行振込 */:Util::dispLang(Language::WORD_00261)/* クレジットカード */; ?></dd>
						</dl>
					</section>

					<h3 class="fotm_ti"><?php echo Util::dispLang(Language::WORD_00218);/*申込者情報*/?></h3>
					<section class="FChkBox clear_fix">
<?php
	foreach($memberData->Column['base'] as $Key => $funcInfo) {
		if($funcInfo->type !== 11){
?>
						<dl class="clear_fix">
							<dt><?php echo $funcInfo->name; ?></dt>
							<dd><?php
echo $memberData->getInputDisplay($Key,$funcInfo,$SYS_MemInfo);
							?></dd>
						</dl>
<?php
		}
	}
?>
					</section>

					<section class="CautTxt mgt10 cnt">
						<p><?php echo Util::dispLang(Language::WORD_00231);/*上記内容で問題ありませんか？)*/?><br />
						<?php echo Util::dispLang(Language::WORD_00265);/*問題なければ下記「申込を完了する」ボタンをクリックしてください。)*/?>
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
						<p class="LayoutR"><button type="button" class="orBT mgt20 mgb10 btWtM next" id="fc_bt" onclick="load_efect();$('#to_page').submit();" /><?php echo Util::dispLang(Language::WORD_00266);/*申込を完了する*/?></button></p>
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
