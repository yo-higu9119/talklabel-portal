<?php
	$itemInfoList = $itemData->getListIsAll();
	if(count($SYS_PurList) > 0){
?>
<?php
		foreach ($SYS_PurList as $key => $val){
			$now_buy_item[$val->plan_id] = $val->item_id;
			$itemInfo = $itemInfoList[$val->item_id];
?>
	<section class="mypageOrdBox">
		<dl class="clear_fix">
			<dt class="name"><?php echo Util::dispLang(Language::WORD_00556);/*サービス名*/?></dt>
			<dd class="name"><?php echo $itemInfo->name; ?></dd>
		</dl>
		<dl class="clear_fix">
			<dt class="name"><?php echo Util::dispLang(Language::WORD_00701);/*申込日*/?></dt>
			<dd class="name"><?php echo date("Y/m/d H:i:s",strtotime($itemInfo->create_date)); ?></dd>
		</dl>
	</section>
<?php
		}
	}else{
?>
	<p class="CautTxt CautMg"><?php echo Util::dispLang(Language::WORD_00702);/*現在申込済みのサービスはありません。*/?></p>
<?php
	}
?>