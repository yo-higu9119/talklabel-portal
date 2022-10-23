<?php	//申込状態 + ログイン状態 + 残数状態
$productApplyStatus = $productInfo->applyStatus($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId());
switch($productApplyStatus) {
	case 1:	//申込可
		if($session->isLogin()){//ログイン後
			if($productInfo->stock_type == 1){
				$rest = max($productInfo->capacity-$productInfo->applicant, 0);
			}else{
				$rest = 99;
			}
			if(
				($productInfo->acceptType == 1
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				)
				|| ($productInfo->acceptType == 2
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				&& mktime($productInfo->acceptEndDatetime->hour, $productInfo->acceptEndDatetime->minute, 0, $productInfo->acceptEndDatetime->month, $productInfo->acceptEndDatetime->day, $productInfo->acceptEndDatetime->year) >= time()
				)
				|| $productInfo->acceptType == 3
			){//受付中
				if($rest > 5) {//空きあり
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_empty.php';?>
<?php require dirname(__FILE__).'/./option/detail_art_cart_nm.php';?>
<?php require dirname(__FILE__).'/./button/detail_art_cart_bt.php';?>
							</section>

<?php
				} else if($rest > 0) {//あとわずか
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_little.php';?>
<?php require dirname(__FILE__).'/./option/detail_art_cart_nm.php';?>
<?php require dirname(__FILE__).'/./button/detail_art_cart_bt.php';?>
							</section>
<?php
				} else if($productInfo->cancel_to_wait === 1) {//キャンセル待ち
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_can.php';?>
<?php require dirname(__FILE__).'/./option/detail_art_cart_nm.php';?>
<?php require dirname(__FILE__).'/./button/detail_art_can_bt.php';?>
							</section>
<?php
				} else {
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_sout.php';?>
							</section>
<?php
				}
			}
		}else{//ログイン前
			if($productInfo->stock_type == 1){
				$rest = max($productInfo->capacity-$productInfo->applicant, 0);
			}else{
				$rest = 99;
			}
			if(
				($productInfo->acceptType == 1
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				)
				|| ($productInfo->acceptType == 2
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				&& mktime($productInfo->acceptEndDatetime->hour, $productInfo->acceptEndDatetime->minute, 0, $productInfo->acceptEndDatetime->month, $productInfo->acceptEndDatetime->day, $productInfo->acceptEndDatetime->year) >= time()
				)
				|| $productInfo->acceptType == 3
			){//受付中
				if($rest > 5) {//空きあり
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_empty.php';?>
<?php require dirname(__FILE__).'/./message/detail_art_reg.php';?>
<?php require dirname(__FILE__).'/./option/detail_art_cart_nm.php';?>
<?php require dirname(__FILE__).'/./button/detail_art_cart_bt.php';?>
							</section>
<?php
				} else if($rest > 0) {//あとわずか
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_little.php';?>
<?php require dirname(__FILE__).'/./message/detail_art_reg.php';?>
<?php require dirname(__FILE__).'/./option/detail_art_cart_nm.php';?>
<?php require dirname(__FILE__).'/./button/detail_art_cart_bt.php';?>
							</section>
<?php
				} else if($productInfo->cancel_to_wait === 1) {//キャンセル待ち
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_can.php';?>
<?php require dirname(__FILE__).'/./message/detail_art_reg.php';?>
<?php require dirname(__FILE__).'/./option/detail_art_cart_nm.php';?>
<?php require dirname(__FILE__).'/./button/detail_art_can_bt.php';?>
							</section>
<?php
				} else {
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_sout.php';?>
							</section>
<?php
				}
			}
		}
		break;
	case -2:	//購入済み
		if($session->isLogin()){//ログイン後
			if($productInfo->stock_type == 1){
				$rest = max($productInfo->capacity-$productInfo->applicant, 0);
			}else{
				$rest = 99;
			}
			if(
				($productInfo->acceptType == 1
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				)
				|| ($productInfo->acceptType == 2
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				&& mktime($productInfo->acceptEndDatetime->hour, $productInfo->acceptEndDatetime->minute, 0, $productInfo->acceptEndDatetime->month, $productInfo->acceptEndDatetime->day, $productInfo->acceptEndDatetime->year) >= time()
				)
				|| $productInfo->acceptType == 3
			){//受付中
				if($rest > 5) {//空きあり
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_done.php';?>
<?php require dirname(__FILE__).'/./message/detail_art_empty.php';?>
<?php require dirname(__FILE__).'/./option/detail_art_cart_nm.php';?>
<?php require dirname(__FILE__).'/./button/detail_art_cart_bt.php';?>
							</section>
<?php
				} else if($rest > 0) {//あとわずか
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_done.php';?>
<?php require dirname(__FILE__).'/./message/detail_art_little.php';?>
<?php require dirname(__FILE__).'/./option/detail_art_cart_nm.php';?>
<?php require dirname(__FILE__).'/./button/detail_art_cart_bt.php';?>
							</section>
<?php
				} else if($productInfo->cancel_to_wait === 1) {//キャンセル待ち
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_done.php';?>
<?php require dirname(__FILE__).'/./message/detail_art_can.php';?>
<?php require dirname(__FILE__).'/./option/detail_art_cart_nm.php';?>
<?php require dirname(__FILE__).'/./button/detail_art_can_bt.php';?>
							</section>
<?php
				} else {
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_sout.php';?>
							</section>
<?php
				}
			}
		}
		break;
	case -3:	//同一カテゴリ内別商品購入済
		if($session->isLogin()){//ログイン後
			if($productInfo->stock_type == 1){
				$rest = max($productInfo->capacity-$productInfo->applicant, 0);
			}else{
				$rest = 99;
			}
			if(
				($productInfo->acceptType == 1
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				)
				|| ($productInfo->acceptType == 2
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				&& mktime($productInfo->acceptEndDatetime->hour, $productInfo->acceptEndDatetime->minute, 0, $productInfo->acceptEndDatetime->month, $productInfo->acceptEndDatetime->day, $productInfo->acceptEndDatetime->year) >= time()
				)
				|| $productInfo->acceptType == 3
			){//受付中
				if($rest > 5) {//空きあり
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_otdone.php';?>
<?php require dirname(__FILE__).'/./button/detail_art_mypage_bt.php';?>
							</section>
<?php
				} else if($rest > 0) {//あとわずか
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_otdone.php';?>
<?php require dirname(__FILE__).'/./button/detail_art_mypage_bt.php';?>
							</section>
<?php
				} else if($productInfo->cancel_to_wait === 1) {//キャンセル待ち
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_otdone.php';?>
<?php require dirname(__FILE__).'/./button/detail_art_mypage_bt.php';?>
							</section>
<?php
				} else {
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_sout.php';?>
							</section>
<?php
				}
			}
		}
		break;
	case -4:	//閲覧のみ、申込不可
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_ordno.php';?>
							</section>
<?PHP
		break;
	default:	//購入不可
		if($session->isLogin()){//ログイン後
			if($productInfo->stock_type == 1){
				$rest = max($productInfo->capacity-$productInfo->applicant, 0);
			}else{
				$rest = 99;
			}
			if(
				($productInfo->acceptType == 1
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				)
				|| ($productInfo->acceptType == 2
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				&& mktime($productInfo->acceptEndDatetime->hour, $productInfo->acceptEndDatetime->minute, 0, $productInfo->acceptEndDatetime->month, $productInfo->acceptEndDatetime->day, $productInfo->acceptEndDatetime->year) >= time()
				)
				|| $productInfo->acceptType == 3
			){//申込不可 受付中
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_ordno.php';?>
							</section>
<?php
			}else{//受付不可（受付終了）
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_ordthk.php';?>
							</section>
<?php
			}
		}else{//ログイン前
			if($productInfo->stock_type == 1){
				$rest = max($productInfo->capacity-$productInfo->applicant, 0);
			}else{
				$rest = 99;
			}
			if(
				($productInfo->acceptType == 1
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				)
				|| ($productInfo->acceptType == 2
				&& mktime($productInfo->acceptStartDatetime->hour, $productInfo->acceptStartDatetime->minute, 0, $productInfo->acceptStartDatetime->month, $productInfo->acceptStartDatetime->day, $productInfo->acceptStartDatetime->year) <= time()
				&& mktime($productInfo->acceptEndDatetime->hour, $productInfo->acceptEndDatetime->minute, 0, $productInfo->acceptEndDatetime->month, $productInfo->acceptEndDatetime->day, $productInfo->acceptEndDatetime->year) >= time()
				)
				|| $productInfo->acceptType == 3
			){//申込不可 受付中
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_ordno.php';?>
							</section>
<?php
			}else{//受付不可（受付終了）
?>
							<section class="prd_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_ordthk.php';?>
							</section>
<?php
			}
		}
}
?>
