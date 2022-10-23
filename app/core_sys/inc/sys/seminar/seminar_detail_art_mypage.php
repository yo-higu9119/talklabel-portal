<?php	//申込状態 + ログイン状態 + 残数状態
$seminarApplyStatus = $seminarInfo->applyStatus($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId());
switch($seminarApplyStatus) {
	case 1:	//申込可
		if($session->isLogin()){//ログイン後
			$rest = max($seminarInfo->capacity-$seminarInfo->applicant, 0);
			//if($rest > 0)$rest = max($seminarInfo->web_capacity-$seminarInfo->applicant_web, 0);
			if(
				($seminarInfo->acceptType == 1
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				)
				|| ($seminarInfo->acceptType == 2
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				&& mktime($seminarInfo->acceptEndDatetime->hour, $seminarInfo->acceptEndDatetime->minute, 0, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day, $seminarInfo->acceptEndDatetime->year) >= time()
				)
				|| $seminarInfo->acceptType == 3
			){//受付中
				if($rest > 5) {//空きあり
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_empty.php';?>
							</section>

<?php
				} else if($rest > 0) {//あとわずか
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_little.php';?>
							</section>
<?php
				} else if($seminarInfo->cancel_to_wait === 1) {//キャンセル待ち
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_can.php';?>
							</section>
<?php
				} else {
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_sout.php';?>
							</section>
<?php
				}
			}
		}else{//ログイン前
			$rest = max($seminarInfo->capacity-$seminarInfo->applicant, 0);
			//if($rest > 0)$rest = max($seminarInfo->web_capacity-$seminarInfo->applicant_web, 0);
			if(
				($seminarInfo->acceptType == 1
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				)
				|| ($seminarInfo->acceptType == 2
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				&& mktime($seminarInfo->acceptEndDatetime->hour, $seminarInfo->acceptEndDatetime->minute, 0, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day, $seminarInfo->acceptEndDatetime->year) >= time()
				)
				|| $seminarInfo->acceptType == 3
			){//受付中
				if($rest > 5) {//空きあり
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_empty.php';?>
<?php require dirname(__FILE__).'/./message/detail_art_reg.php';?>
							</section>
<?php
				} else if($rest > 0) {//あとわずか
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_little.php';?>
<?php require dirname(__FILE__).'/./message/detail_art_reg.php';?>
							</section>
<?php
				} else if($seminarInfo->cancel_to_wait === 1) {//キャンセル待ち
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_can.php';?>
<?php require dirname(__FILE__).'/./message/detail_art_reg.php';?>
							</section>
<?php
				} else {
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_sout.php';?>
							</section>
<?php
				}
			}
		}
		break;
	case -2:	//申込済み
		if($session->isLogin()){//ログイン後
			$rest = max($seminarInfo->capacity-$seminarInfo->applicant, 0);
			//if($rest > 0)$rest = max($seminarInfo->web_capacity-$seminarInfo->applicant_web, 0);
			if(
				($seminarInfo->acceptType == 1
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				)
				|| ($seminarInfo->acceptType == 2
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				&& mktime($seminarInfo->acceptEndDatetime->hour, $seminarInfo->acceptEndDatetime->minute, 0, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day, $seminarInfo->acceptEndDatetime->year) >= time()
				)
				|| $seminarInfo->acceptType == 3
			){//受付中
				if($rest > 5) {//空きあり
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_done.php';?>

							</section>
<?php
				} else if($rest > 0) {//あとわずか
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_done.php';?>
							</section>
<?php
				} else if($seminarInfo->cancel_to_wait === 1) {//キャンセル待ち
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_done.php';?>
							</section>
<?php
				} else {
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_sout.php';?>
							</section>
<?php
				}
			}
		}
		break;
	case -3:	//同一カテゴリ内別セミナー申込済
		if($session->isLogin()){//ログイン後
			$rest = max($seminarInfo->capacity-$seminarInfo->applicant, 0);
			//if($rest > 0)$rest = max($seminarInfo->web_capacity-$seminarInfo->applicant_web, 0);
			if(
				($seminarInfo->acceptType == 1
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				)
				|| ($seminarInfo->acceptType == 2
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				&& mktime($seminarInfo->acceptEndDatetime->hour, $seminarInfo->acceptEndDatetime->minute, 0, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day, $seminarInfo->acceptEndDatetime->year) >= time()
				)
				|| $seminarInfo->acceptType == 3
			){//受付中
				if($rest > 5) {//空きあり
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_otdone.php';?>
							</section>
<?php
				} else if($rest > 0) {//あとわずか
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_otdone.php';?>
							</section>
<?php
				} else if($seminarInfo->cancel_to_wait === 1) {//キャンセル待ち
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_otdone.php';?>
							</section>
<?php
				} else {
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_sout.php';?>
							</section>
<?php
				}
			}
		}
		break;
	case -4:	//閲覧のみ、申込不可
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_ordno.php';?>
							</section>
<?PHP
		break;
	default:	//申込不可
		if($session->isLogin()){//ログイン後
			$rest = max($seminarInfo->capacity-$seminarInfo->applicant, 0);
			//if($rest > 0)$rest = max($seminarInfo->web_capacity-$seminarInfo->applicant_web, 0);
			if(
				($seminarInfo->acceptType == 1
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				)
				|| ($seminarInfo->acceptType == 2
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				&& mktime($seminarInfo->acceptEndDatetime->hour, $seminarInfo->acceptEndDatetime->minute, 0, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day, $seminarInfo->acceptEndDatetime->year) >= time()
				)
				|| $seminarInfo->acceptType == 3
			){//申込不可 受付中
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_ordno.php';?>
							</section>
<?php
			}else{//受付不可（受付終了）
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_ordthk.php';?>
							</section>
<?php
			}
		}else{//ログイン前
			$rest = max($seminarInfo->capacity-$seminarInfo->applicant, 0);
			//if($rest > 0)$rest = max($seminarInfo->web_capacity-$seminarInfo->applicant_web, 0);
			if(
				($seminarInfo->acceptType == 1
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				)
				|| ($seminarInfo->acceptType == 2
				&& mktime($seminarInfo->acceptStartDatetime->hour, $seminarInfo->acceptStartDatetime->minute, 0, $seminarInfo->acceptStartDatetime->month, $seminarInfo->acceptStartDatetime->day, $seminarInfo->acceptStartDatetime->year) <= time()
				&& mktime($seminarInfo->acceptEndDatetime->hour, $seminarInfo->acceptEndDatetime->minute, 0, $seminarInfo->acceptEndDatetime->month, $seminarInfo->acceptEndDatetime->day, $seminarInfo->acceptEndDatetime->year) >= time()
				)
				|| $seminarInfo->acceptType == 3
			){//申込不可 受付中
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_ordno.php';?>
							</section>
<?php
			}else{//受付不可（受付終了）
?>
							<section class="sem_det ord_art">
<?php require dirname(__FILE__).'/./message/detail_art_ordthk.php';?>
							</section>
<?php
			}
		}
}
?>