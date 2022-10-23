<?php
$cmsCateId = 2;
$categoryGroupId = 1;
$firstDateStr = date('Y-m-d', mktime(0, 0, 0, intval(date('n')), intval(date('d')), intval(date('Y'))));

$searchInfoList = array();
$searchInfoList['search_x_is_open'] = true;
$searchInfoList['search_x_ignore_all'] = true;

$PurchasedList = $session->getMemberPurchased();
if(count($PurchasedList) > 0){
	$permission_type = 3;
	$permission_item = implode(',', $PurchasedList);
	$searchInfoList['search_x_permission'] = array('type'=>$permission_type,'item'=>$permission_item);
}else{
	$permission_type = 2;
	$searchInfoList['search_x_permission'] = array('type'=>$permission_type);
}

if($categoryGroupId > 0) {
	$searchInfoList['search_x_category_group_id'] = $categoryGroupId;
}

$searchInfoList['search_x_first_the_date_str'] = $firstDateStr;

$seminarInfoList = $seminarData->getInfoList($searchInfoList, 7);
if(count($seminarInfoList) > 0){
?>

						<div class="TableBox">
								<table>
<?php if (IS_SMART_PHONE) { ?>
									<tr>
									<th class=""><?php echo Util::dispLang(Language::WORD_00178);/*セミナー詳細*/?></th>
									<th class="size90"><?php echo Util::dispLang(Language::WORD_00179);/*申込み*/?></th>
									</tr>
<?php } else { ?>
									<tr>
									<th class="size80"><?php echo Util::dispLang(Language::WORD_00180);/*種類*/?></th>
									<th class="size300"><?php echo Util::dispLang(Language::WORD_00181);/*名称*/?></th>
									<th class="size200"><?php echo Util::dispLang(Language::WORD_00182);/*日程*/?></th>
									<th class="size200"><?php echo Util::dispLang(Language::WORD_00183);/*会場*/?></th>
									<th class="size100"><?php echo Util::dispLang(Language::WORD_00184);/*申込金額*/?></th>
									<th class="size80"><?php echo Util::dispLang(Language::WORD_00185);/*状況*/?></th>
									<th class="size80"><?php echo Util::dispLang(Language::WORD_00186);/*詳細*/?></th>
									<th class="size80"><?php echo Util::dispLang(Language::WORD_00179);/*申込み*/?></th>
									</tr>
<?php } ?>
<?php
	foreach($seminarInfoList as $seminarInfo) {
		if($seminarInfo->TypeNo == 1){
			if($seminarInfo->venue_id !== 0){
				$placeName = htmlspecialchars($VenueList[$seminarInfo->venue_id]->name);
				$placeName = '<a href="'.$VenueList[$seminarInfo->venue_id]->map.'" target="_blank">'.$placeName.'</a>';
			}else{
				$placeName = Util::dispLang(Language::WORD_00156);/*会場未定*/
			}
		}else{
			$placeName = Util::dispLang(Language::WORD_00157);/*オンライン*/
		}

		$seminarApplyStatus = $seminarInfo->applyStatus($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId());
		$seminarId = $seminarInfo->id;

		if($seminarApplyStatus===1 && HtmlPartsSeminar::getAcceptStatus($seminarInfo)) {
			if (IS_SMART_PHONE) {
				$orderLink = '<a href="javascript:utilOpenFrame(\'./sm_input.php?si='.$seminarId.'\', false, 20, 350, 600, true);">'.Util::dispLang(Language::WORD_00179).'</a>';/*申込み*/
			} else {
				$orderLink = '<a href="javascript:utilOpenFrame(\'./sm_input.php?si='.$seminarId.'\', false, 50, 920, 700, true);">'.Util::dispLang(Language::WORD_00179).'</a>';/*申込み*/
			}
		} else {
			$orderLink = '<p class="editBt"><span>'.Util::dispLang(Language::WORD_00179).'</span></p>';/*申込み*/
			//continue;
		}
		$TypeList = $seminarInfo->getTypeList();
		$typeTag = '';
		if($seminarInfo->TypeNo == 1){
			$typeTag = '<span class="IcoBox NrIcBg BgPnc">'.$TypeList[$seminarInfo->TypeNo].'</span>';
		}else if($seminarInfo->TypeNo == 2){
			$typeTag = '<span class="IcoBox NrIcBg BgGrn">'.$TypeList[$seminarInfo->TypeNo].'</span>';
		}
?>
									<tr>
<?php if (IS_SMART_PHONE) { ?>
									<td class="lft">
										<div class="clear_fix">
											<p class="SchCalIco"><?php echo $typeTag; ?></p>
											<p class="SchCalIco"><?php echo HtmlPartsSeminar::getAcceptStatusIconStr($seminarInfo)?></p>
										</div>
										<p class="SchCalTi"><?php echo $seminarInfo->name; ?></p>
										<p class="SchCalDay"><?php
				if($seminarInfo->eventType == 1){
					$eventDate = $seminarInfo->theDate->toString();
				}else if($seminarInfo->eventType == 2){
					$eventDate = Util::dispLang(Language::WORD_00159);/*常時開催*/
				}else{
					$eventDate = $seminarInfo->lectureList[0]->theDate->toString();
				}
				echo $eventDate;
?></p>
										<p class="SchCalPlc"><?php echo $placeName?></p>
										<p class="SchCalCst"><?php
				$amount = $seminarInfo->getCurrentAmount($session->isLogin(), $session->getMemberApplyService());
				if(is_numeric($amount)) {
					if(intval($amount) > 0){
						echo number_format($amount).Util::dispLang(Language::WORD_00161);/*円（税込み）*/
					}else{
						echo Util::dispLang(Language::WORD_00162);/*無料*/
					}
				} else {
					echo '-';
				}
				?></p>
									</td>
									<td class="TableBgYel">
										<p class="SchCalBt editBt"><a href="javascript:utilOpenFrame('./sm_detail.php?s=<?php echo htmlspecialchars($seminarInfo->urlKey)?>', false, 20, 350, 600);"><?php echo Util::dispLang(Language::WORD_00186);/*詳細*/?></a></p>
										<p class="SchCalBt editBt"><?php echo $orderLink; ?></p>
									</td>
<?php } else { ?>
									<td class="nowrap"><?php echo $typeTag; ?></td>
									<td class="lft"><?php echo $seminarInfo->name; ?></td>
									<td class="nowrap"><?php
		if($seminarInfo->eventType == 1){
			$eventDate = $seminarInfo->theDate->toString();
		}else if($seminarInfo->eventType == 2){
			$eventDate = Util::dispLang(Language::WORD_00159);/*常時開催*/
		}else{
			$eventDate = $seminarInfo->lectureList[0]->theDate->toString();
		}
		echo $eventDate;
?></td>
									<td><?php echo $placeName?></td>
									<td class="TableBgYel rgt nowrap"><?php
				$amount = $seminarInfo->getCurrentAmount($session->isLogin(), $session->getMemberApplyService());
				if(is_numeric($amount)) {
					if(intval($amount) > 0){
						echo number_format($amount).Util::dispLang(Language::WORD_00161);/*円（税込み）*/
					}else{
						echo Util::dispLang(Language::WORD_00162);/*無料*/
					}
				} else {
					echo '-';
				}
				?></td>
									<td class="nowrap"><?php echo HtmlPartsSeminar::getAcceptStatusIconStr($seminarInfo)?></td>
									<td class="nowrap"><p class="editBt"><a href="javascript:utilOpenFrame('./sm_detail.php?s=<?php echo htmlspecialchars($seminarInfo->urlKey)?>', false, 50, 920, 700);"><?php echo Util::dispLang(Language::WORD_00186);/*詳細*/?></a></p></td>
									<td class="nowrap"><p class="editBt"><?php echo $orderLink; ?></p></td>
<?php } ?>
									</tr>
<?php
	}
?>
								</table>
						</div>

<?php
}else{
?>
						<p class="CautTxt mgt20 mgb10"><?php echo Util::dispLang(Language::WORD_00187);/*現在開催はありません。*/?><br /><?php echo Util::dispLang(Language::WORD_00188);/*開催日程が決まるまでもうしばらくお待ちください。*/?></p>
<?php
}
?>
