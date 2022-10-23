	<section class="mypageOrdBoxInn">
		<dl class="clear_fix">
			<dt><?php echo Util::dispLang(Language::WORD_00556);/*サービス名*/?></dt>
			<dd><?php echo $itemInfo->name; ?></dd>
		</dl>
		<dl class="clear_fix">
			<dt class="name"><?php echo Util::dispLang(Language::WORD_00701);/*申込日*/?></dt>
			<dd class="name"><?php echo date("Y/m/d H:i:s",strtotime($itemInfo->create_date)); ?></dd>
		</dl>
	</section>

	<section class="mypageOrdBoxInn">
<?php require dirname(__FILE__).'/./mypage_sv_ord_common_detail.php';?>
<?php
	if($val->pause == 1){
?>
		<dl>
			<dt>状態</dt>
			<dd>休止中</dd>
		</dl>
<?php
	}
	if($val->cancel == 1){
?>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00326);/*サービスキャンセル*/?></dt>
			<dd><?php echo ($val->cancel == 1)?Util::dispLang(Language::WORD_00310)/*キャンセル*/:'-'; ?></dd>
		</dl>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00327);/*キャンセル処理日*/?></dt>
			<dd><?php echo ($val->cancel == 1)?date("Y/m/d",strtotime($val->cancel_date)):'-'; ?></dd>
		</dl>
<?php
	}
?>
	</section>

	<section class="mypageOrdBoxBt">
<?php if (IS_SMART_PHONE) { ?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./payment_history.php?id=<?php echo $val->id; ?>', false, 20, 350, 600);" class="myprirekiBt"><?php echo Util::dispLang(Language::WORD_00309);/*決済履歴*/?></a></p>
<?php
		if($val->pause == 1){
		}else if($val->cancel == 0){
			if($systemInfo->card_type == 1 && $itemInfo->type > 1 && $val->pay_type > 2){
?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./sv_card_change.php?id=<?php echo $val->id; ?>', false, 20, 350, 600, true);" class="mypcardChBt">決済カード変更</a></p>
<?php
		}
?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./sv_cancel.php?id=<?php echo $val->id; ?>', false, 20, 350, 600, true);" class="mypcanBt"><?php echo Util::dispLang(Language::WORD_00310);/*キャンセル*/?></a></p>
<?php
			if($itemInfo->plan_behavior == 2){
?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./sv_change.php?id=<?php echo $itemInfo->id; ?>&nid=<?php echo $itemInfo->id; ?>', false, 20, 350, 600, true);" class="mypplanChBt"><?php echo Util::dispLang(Language::WORD_00311);/*プラン変更*/?></a></p>
<?php
		}
	}
?>
<?php } else { ?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./payment_history.php?id=<?php echo $val->id; ?>', false, 50, 920, 700);" class="myprirekiBt"><?php echo Util::dispLang(Language::WORD_00309);/*決済履歴*/?></a></p>
<?php
		if($val->pause == 1){
		}else if($val->cancel == 0){
			if(($systemInfo->card_type == 1 || $systemInfo->card_type == 4) && $itemInfo->type > 1){// && $val->pay_type > 2
?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./sv_card_change.php?id=<?php echo $val->id; ?>', false, 50, 920, 700, true);" class="mypcardChBt">決済カード変更</a></p>
<?php
		}
?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./sv_cancel.php?id=<?php echo $val->id; ?>', false, 50, 920, 700, true);" class="mypcanBt"><?php echo Util::dispLang(Language::WORD_00310);/*キャンセル*/?></a></p>
<?php
		if($itemInfo->plan_behavior == 2){
?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./sv_change.php?id=<?php echo $itemInfo->id; ?>&nid=<?php echo $itemInfo->id; ?>', false, 50, 920, 700, true);" class="mypplanChBt"><?php echo Util::dispLang(Language::WORD_00311);/*プラン変更*/?></a></p>
<?php
		}
	}
?>
<?php } ?>
	</section>
