<?php
	if(count($list) > 0) {
		foreach($list as $pkInfo) {
			if($pkInfo->payment_type == 1){
				$payment_type = '銀行振込';
			}else if($pkInfo->payment_type == 2){
				$payment_type = 'クレカ';
				if($pkInfo->credit_type == 1){
					$payment_type .= '(PAY.JP)';
				}else if($pkInfo->credit_type == 2){
					$payment_type .= '(STRIPE)';
				}else if($pkInfo->credit_type == 3){
					$payment_type .= '(ROBOT PAYMENT)';
				}else if($pkInfo->credit_type == 4){
					$payment_type .= '(ZEUS)';
				}else{
					$payment_type .= '(その他)';
				}
			}else if($pkInfo->payment_type == 3){
				$payment_type = Util::dispLang(Language::WORD_00461);/* 代金引換*/
			}else{
				$payment_type = Util::dispLang(Language::WORD_00463);/* 決済無し*/
			}
			if($pkInfo->status == 1){
				$status = '<span class="IcoBox MdIcBg BgBlu nowrap">'.Util::dispLang(Language::WORD_00476).'</span>';/*対応中*/
			}else if($pkInfo->status == 2){
				$status = '<span class="IcoBox MdIcBg BgBlu nowrap">'.Util::dispLang(Language::WORD_00477).'</span>';/*対応済*/
			}else{
				$status = '<span class="IcoBox MdIcBg BgPnc nowrap">'.Util::dispLang(Language::WORD_00478).'</span>';/*未対応*/
			}
			if($pkInfo->shipping_status == 1){
				$shipping_status = '<span class="IcoBox MdIcBg BgOyl nowrap">'.Util::dispLang(Language::WORD_00479).'</span>';/*配送済*/
			}else if($pkInfo->shipping_status == 2){
				$shipping_status = '<span class="IcoBox MdIcBg BgBlu nowrap">'.Util::dispLang(Language::WORD_00480).'</span>';/*配送完了*/
			}else{
				$shipping_status = '<span class="IcoBox MdIcBg BgRed nowrap">'.Util::dispLang(Language::WORD_00481).'</span>';/*未配送*/
			}
?>
	<section class="mypageOrdBox">
<?php require dirname(__FILE__).'/./mypage_prd_purchase_detail.php';?>
	</section>
<?php
		}
	}else{
?>
	<p class="CautTxt CautMg"><?php echo Util::dispLang(Language::WORD_00441);/*現在購入済みの商品はありません。*/?></p>
<?php
	}
?>