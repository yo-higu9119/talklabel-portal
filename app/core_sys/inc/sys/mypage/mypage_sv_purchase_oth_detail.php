	<section class="mypageOrdBoxInn">
		<dl class="clear_fix">
			<dt><?php echo Util::dispLang(Language::WORD_00556);/*サービス名*/?></dt>
			<dd><?php echo $itemInfo->name; ?></dd>
		</dl>
	</section>

	<section class="mypageOrdBoxInn">
<?php require dirname(__FILE__).'/./mypage_sv_ord_common_detail.php';?>
	</section>

	<section class="mypageOrdBoxBt">
<?php if (IS_SMART_PHONE) { ?>
		<p class="BtM"><?php
if($is_pay){
	if($itemInfo->plan_behavior == 1 || $is_plan_buy_cnt == 0){
		?><span class="mypnewBt"><?php echo Util::dispLang(Language::WORD_00329);/*新規申込*/?></span><?php
	}else{
		?><span class="mypplanChBt"><?php echo Util::dispLang(Language::WORD_00311);/*プラン変更*/?></span><?php
	}
}else{
	if($itemInfo->plan_behavior == 1 || $is_plan_buy_cnt == 0){
		?><a href="javascript:utilOpenFrame('./sv_input.php?id=<?php echo $itemInfo->id; ?>', false, 20, 350, 600, true);" class="mypnewBt"><?php echo Util::dispLang(Language::WORD_00329);/*新規申込*/?></a><?php
	}else{
		$nid = $now_buy_item[$itemInfo->plan_id];
		?><a href="javascript:utilOpenFrame('./sv_change.php?id=<?php echo $nid; ?>&nid=<?php echo $itemInfo->id; ?>&<?php echo SYSTEM_ACCESS_DATETIME; ?>', false, 20, 350, 600, true);" class="mypplanChBt"><?php echo Util::dispLang(Language::WORD_00311);/*プラン変更*/?></a><?php
	}
}
										?></p>
<?php } else { ?>
		<p class="BtM"><?php
if($is_pay){
	if($itemInfo->plan_behavior == 1 || $is_plan_buy_cnt == 0){
		?><span class="mypnewBt"><?php echo Util::dispLang(Language::WORD_00329);/*新規申込*/?></span><?php
	}else{
		?><span class="mypplanChBt"><?php echo Util::dispLang(Language::WORD_00311);/*プラン変更*/?></span><?php
	}
}else{
	if($itemInfo->plan_behavior == 1 || $is_plan_buy_cnt == 0){
		?><a href="javascript:utilOpenFrame('./sv_input.php?id=<?php echo $itemInfo->id; ?>', false, 50, 920, 700, true);" class="mypnewBt"><?php echo Util::dispLang(Language::WORD_00329);/*新規申込*/?></a><?php
		}else{
			$nid = $now_buy_item[$itemInfo->plan_id];
			?><a href="javascript:utilOpenFrame('./sv_change.php?id=<?php echo $nid; ?>&nid=<?php echo $itemInfo->id; ?>&<?php echo SYSTEM_ACCESS_DATETIME; ?>', false, 50, 920, 700, true);" class="mypplanChBt"><?php echo Util::dispLang(Language::WORD_00311);/*プラン変更*/?></a><?php
		}
	}
										?></p>
<?php } ?>
	</section>
