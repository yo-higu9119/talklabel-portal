<?php
	$itemInfoList = $itemData->getListIsAll();
	if(count($itemInfoList) > 0){
		$LrClass = 'LayoutR';
		$cnt = 0;
		$AppyServiceIdList = $memberData->getAppyServiceIdList($session->getMemberId());
		foreach ($itemInfoList as $key => $itemInfo){
			$is_plan_buy_cnt = $itemData->get_plan_buy_cnt($itemInfo->plan_id,$session->getMemberId());
			if(array_key_exists($key, $AppyServiceIdList)){
				$is_pay = true;
			}else{
				$is_pay = false;
			}
			if($cnt == 0){
?>

<?php
			}
			$itemInfo->type;/* 1:都度 2:継続 3:分割 4:特別決済(都度) 5:特別決済(分割) */
?>
	<section class="mypageOrdBox">
<?php require dirname(__FILE__).'/./mypage_sv_purchase_oth_detail.php';?>
	</section>
<?php
		}
	}else{
?>
	<p class="CautTxt CautMg"><?php echo Util::dispLang(Language::WORD_00702);/*現在申込済みのサービスはありません。*/?></p>
<?php
	}
?>
