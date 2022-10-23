	<section class="mypageOrdBoxInn">
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00705);/*申込中のサービス*/?></dt>
			<dd><?php echo $itemInfo->name; ?></dd>
		</dl>
<?php require dirname(__FILE__).'/./mypage_sv_ord_card_detail.php';?>
	</section>
	<section class="mypageOrdBoxInn">
<?php require dirname(__FILE__).'/./mypage_sv_ord_common_detail.php';?>
	</section>
