	<section class="mypageOrdBoxInn">
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00438);/*購入日時*/?></dt>
			<dd><?php echo $pkInfo->regist_timestamp->toString(); ?></dd>
		</dl>
		<dl class="clear_fix">
			<dt><?php echo Util::dispLang(Language::WORD_00435);/*請求番号*/?></dt>
			<dd><?php echo sprintf("%07d",$pkInfo->id); ?></dd>
		</dl>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00264);/*支払い方法*/?></dt>
			<dd><?php echo $payment_type; ?></dd>
		</dl>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00437);/*請求金額*/?></dt>
			<dd><?php echo number_format($pkInfo->total_amount); ?> <?php echo Util::dispLang(Language::WORD_00339);/*円*/?></dd>
		</dl>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00439);/*対応状況*/?></dt>
			<dd><?php echo $status; ?></dd>
		</dl>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00440);/*発送状況*/?></dt>
			<dd><?php echo $shipping_status; ?></dd>
		</dl>
	</section>

	<section class="mypageOrdBoxBt">

<?php if (IS_SMART_PHONE) { ?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./pr_detail.php?pn=<?php echo $pkInfo->id; ?>', false, 20, 350, 600);" class="myprirekiBt"><?php echo Util::dispLang(Language::WORD_00436);/*注文内容*/?></a></p></dd>
<?php } else { ?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./pr_detail.php?pn=<?php echo $pkInfo->id; ?>', false, 20, 920, 700);" class="myprirekiBt"><?php echo Util::dispLang(Language::WORD_00436);/*注文内容*/?></a></p></dd>
<?php } ?>

	</section>
