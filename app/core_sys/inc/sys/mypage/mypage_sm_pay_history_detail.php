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
foreach($seminarPaymentInfoList as $Info) {
	if($Info->paymentType == 1){
		$paymentType = Util::dispLang(Language::WORD_00336);/* 決済なし*/
	}else if($Info->paymentType == 2){
		$paymentType = Util::dispLang(Language::WORD_00337);/* 銀行振込*/
	}else{
		$paymentType = Util::dispLang(Language::WORD_00338);/* クレジットカード*/
	}
	if($Info->isPaid){
		$isPaid = '<span class="IcoBox NrIcBg BgOyl">'.Util::dispLang(Language::WORD_00340).'</span>';/*決済済*/
	}else{
		$isPaid = '<span class="IcoBox NrIcBg BgBlu">'.Util::dispLang(Language::WORD_00341).'</span>';/*未決済*/
	}
?>
						<tr>
<?php if (IS_SMART_PHONE) { ?>
							<td>
								<p><?php echo $Info->num+1; ?><?php echo Util::dispLang(Language::WORD_00324);/*回*/?></p>
								<p><?php echo $Info->paymentDate->toString(); ?></p>
								<p><?php echo $paymentType; ?></p>
							</td>
							<td class="TableBgYel rgt"><?php echo number_format($Info->amountBilled)?><?php echo Util::dispLang(Language::WORD_00339);/*円*/?></td>
							<td><?php echo $isPaid; ?></td>
<?php } else { ?>
							<td><?php echo $Info->num+1; ?><?php echo Util::dispLang(Language::WORD_00324);/*回*/?></td>
							<td><?php echo $Info->paymentDate->toString(); ?></td>
							<td><?php echo $paymentType; ?></td>
							<td class="TableBgYel rgt"><?php echo number_format($Info->amountBilled)?><?php echo Util::dispLang(Language::WORD_00339);/*円*/?></td>
							<td><?php echo $isPaid; ?></td>
<?php } ?>
						</tr>
<?php
}
?>
					</table>
