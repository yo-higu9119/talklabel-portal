<?php
$SYS_PurList = $purchaseChData->getListOrder($purchaseId,1);
if(count($SYS_PurList) > 0){
?>
					<table>
						<tr>
<?php if (IS_SMART_PHONE) { ?>
							<th><?php echo Util::dispLang(Language::WORD_00330);/*決済手段*/?></th>
							<th class="size100"><?php echo Util::dispLang(Language::WORD_00331);/*決済金額*/?></th>
							<th class="size80"><?php echo Util::dispLang(Language::WORD_00332);/*状況*/?></th>
<?php } else { ?>
							<th class="size100"><?php echo Util::dispLang(Language::WORD_00333);/*回数*/?></th>
							<th class="size200"><?php echo Util::dispLang(Language::WORD_00334);/*決済日*/?></th>
							<th><?php echo Util::dispLang(Language::WORD_00330);/*決済手段*/?></th>
							<th class="size150"><?php echo Util::dispLang(Language::WORD_00331);/*決済金額*/?></th>
							<th class="size100"><?php echo Util::dispLang(Language::WORD_00332);/*状況*/?></th>
<?php } ?>
						</tr>
<?php
	foreach ($SYS_PurList as $key => $PurInfo){
?>
						<tr>
<?php if (IS_SMART_PHONE) { ?>
							<td>
								<p><?php echo ($PurInfo->split == 0)?Util::dispLang(Language::WORD_00335)/*初回*/:$PurInfo->split.Util::dispLang(Language::WORD_00324)/*回*/; ?></p>
								<p><?php echo date("Y/m/d",strtotime($PurInfo->pay_date)); ?></p>
								<p><?php
		if($PurInfo->pay_type == 1){
			echo Util::dispLang(Language::WORD_00336);/* 決済なし*/
		} else if($PurInfo->pay_type == 2) {
			echo Util::dispLang(Language::WORD_00337);/* 銀行振込*/
		} else {
			echo Util::dispLang(Language::WORD_00338);/* クレジットカード*/
		}
								?></p>
							</td>
							<td class="TableBgYel rgt"><?php echo $PurInfo->claim_money; ?><?php echo Util::dispLang(Language::WORD_00339);/*円*/?></td>
							<td><?php
		if($PurInfo->retry == 1){
			echo '<span class="IcoBox NrIcBg BgGry">休止中</span>';/*休止中*/
		}else if($PurInfo->retry == 2){
			echo '<span class="IcoBox NrIcBg BgRed">カード変更</span>';/*カード変更*/
		}else if($PurInfo->set == 1){
			echo '<span class="IcoBox NrIcBg BgOyl">'.Util::dispLang(Language::WORD_00340).'</span>';/*決済済*/
		}else{
			echo '<span class="IcoBox NrIcBg BgBlu">'.Util::dispLang(Language::WORD_00341).'</span>';/*未決済*/
		}
								?></td>
<?php } else { ?>
							<td><?php echo ($PurInfo->split == 0)?Util::dispLang(Language::WORD_00335)/*初回*/:$PurInfo->split.Util::dispLang(Language::WORD_00324)/*回*/; ?></td>
							<td><?php echo date("Y/m/d",strtotime($PurInfo->pay_date)); ?></td>
							<td><?php
		if($PurInfo->pay_type == 1){
			echo Util::dispLang(Language::WORD_00336);/* 決済なし*/
		} else if($PurInfo->pay_type == 2) {
			echo Util::dispLang(Language::WORD_00337);/* 銀行振込*/
		} else {
			echo Util::dispLang(Language::WORD_00338);/* クレジットカード*/
		}
								?></td>
							<td class="TableBgYel rgt"><?php echo $PurInfo->claim_money; ?><?php echo Util::dispLang(Language::WORD_00339);/*円*/?></td>
							<td><?php
		if($PurInfo->retry == 1){
			echo '<span class="IcoBox NrIcBg BgGry">休止中</span>';/*休止中*/
		}else if($PurInfo->retry == 2){
			echo '<span class="IcoBox NrIcBg BgRed">カード変更</span>';/*カード変更*/
		}else if($PurInfo->set == 1){
			echo '<span class="IcoBox NrIcBg BgOyl">'.Util::dispLang(Language::WORD_00340).'</span>';/*決済済*/
		}else{
			echo '<span class="IcoBox NrIcBg BgBlu">'.Util::dispLang(Language::WORD_00341).'</span>';/*未決済*/
		}
								?></td>
<?php } ?>
						</tr>
<?php
	}
?>
					</table>
<?php
}else{
?>

<?php
}
?>
