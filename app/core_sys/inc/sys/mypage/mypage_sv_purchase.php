<?php
	$systemData = new SystemData('');
	$systemInfo = $systemData->getInfo();

	$itemInfoList = $itemData->getListIsAll();
	if(count($SYS_PurList) > 0){
?>
<?php
		foreach ($SYS_PurList as $key => $val){
			$now_buy_item[$val->plan_id] = $val->item_id;
			$itemInfo = $itemInfoList[$val->item_id];
?>
	<section class="mypageOrdBox">
<?php require dirname(__FILE__).'/./mypage_sv_purchase_detail.php';?>
	</section>
<?php
		}
	}else{
?>
	<p class="CautTxt CautMg"><?php echo Util::dispLang(Language::WORD_00702);/*現在申込済みのサービスはありません。*/?></p>
<?php
	}
?>