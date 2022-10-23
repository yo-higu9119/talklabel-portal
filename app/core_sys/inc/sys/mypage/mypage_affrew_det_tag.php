						<div class="htibrd clear_fix">
							<h2><?php echo Util::dispLang(Language::WORD_00540);/*報酬管理*/?></h2>
						</div>

						<div class="ordDetBox mgt20">
								<table>
									<tr>
										<th><?php echo Util::dispLang(Language::WORD_00541);/*報酬トータル*/?></th>
<?php if (IS_SMART_PHONE) { ?>
									</tr>
									<tr>
<?php } else { ?>
<?php } ?>
										<td><?php echo number_format($totalReward);?><?php echo Util::dispLang(Language::WORD_00339);/*円*/?></td>
									</tr>
									<tr>
										<th><?php echo Util::dispLang(Language::WORD_00542);/*支払い済み報酬*/?></th>
<?php if (IS_SMART_PHONE) { ?>
									</tr>
									<tr>
<?php } else { ?>
<?php } ?>
										<td><?php echo number_format($totalPayment);?><?php echo Util::dispLang(Language::WORD_00339);/*円*/?></td>
									</tr>
								</table>
						</div>

						<div class="htibrd clear_fix">
							<h2><?php echo Util::dispLang(Language::WORD_00543);/*支払い済一覧*/?></h2>
						</div>
						<div class="mypageInn">
<?php
	if(count($rewardPaymentList) == 0){
?>
						<p class="Art cnt mgt10 mgb10"><?php echo Util::dispLang(Language::WORD_00544);/*支払い済情報はありません。*/?></p>
<?php
	}else{
		foreach($rewardPaymentList as $value){
?>
							<div class="TableBox">
								<table class="ScrTable">
									<tr>
									<th class=""><?php echo Util::dispLang(Language::WORD_00545);/*処理日*/?></th>
									<th class="size200"><?php echo Util::dispLang(Language::WORD_00546);/*支払金額*/?></th>
									</tr>
									<tr>
									<td class="nowrap"><?php echo $value->create_date->toString(); ?></td>
									<td class="TableBgBlu rgt nowrap"><?php echo number_format($value->payment); ?><?php echo Util::dispLang(Language::WORD_00339);/*円*/?></td>
									</tr>
								</table>
							</div>
<?php
		}
	}
?>
						</div>
						<div class="htibrd clear_fix">
							<h2><?php echo Util::dispLang(Language::WORD_00547);/*紹介者一覧*/?></h2>
						</div>
						<div class="mypageInn">
<?php
	if(count($rewardList) == 0){
?>
						<p class="Art cnt mgt10 mgb10"><?php echo Util::dispLang(Language::WORD_00548);/*紹介者の情報はありません。*/?></p>
<?php
	}else{
		foreach($rewardList as $value){
			$TypeList = $value->getType();
			$TypeTag = '<span class="NrIcBg '.$TypeList[$value->type_no]['color'].' nowrap">'.$TypeList[$value->type_no]['name'].'</span>';
			if($value->status == 0){
				$statusTag = '<span class="IcoBox NrIcBg BgGry">'.Util::dispLang(Language::WORD_00549).'</span>';/*未確定*/
			}else{
				$statusTag = '<span class="IcoBox NrIcBg BgBlu">'.Util::dispLang(Language::WORD_00550).'</span>';/*確定済*/
			}
?>
							<div class="TableBox">
								<table class="ScrTable">
									<tr>
									<th class=""><?php echo Util::dispLang(Language::WORD_00551);/*会員氏名*/?></th>
									<th class="size80"><?php echo Util::dispLang(Language::WORD_00552);/*登録*/?></th>
									<th class="size200"><?php echo Util::dispLang(Language::WORD_00553);/*登録日・購入日*/?></th>
									<th class="size100"><?php echo Util::dispLang(Language::WORD_00554);/*報酬金額*/?></th>
									<th class="size80"><?php echo Util::dispLang(Language::WORD_00555);/*報酬確定*/?></th>
									</tr>
									<tr>
									<td class="nowrap"><?php echo $value->mem_name; ?></td>
									<td class="nowrap"><?php echo $TypeTag; ?></td>
									<td class="nowrap"><?php echo $value->create_date->toString(); ?></td>
									<td class="TableBgYel rgt nowrap"><?php echo number_format($value->reward); ?><?php echo Util::dispLang(Language::WORD_00339);/*円*/?></td>
									<td class="nowrap"><?php echo $statusTag; ?></td>
									</tr>
								</table>
							</div>
<?php
		}
	}
?>
						</div>
