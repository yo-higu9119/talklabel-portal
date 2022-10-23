	<section class="mypageOrdBoxInn">
		<dl class="clear_fix">
			<dt><?php echo Util::dispLang(Language::WORD_00714);/*セミナー名*/?></dt>
			<dd><?php echo $seminarInfo->name; ?></dd>
		</dl>
		<dl class="clear_fix">
			<dt class="name"><?php echo Util::dispLang(Language::WORD_00701);/*申込日*/?></dt>
			<dd class="name"></dd>
		</dl>
	</section>

	<section class="mypageOrdBoxInn">
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00180);/*種類*/?></dt>
			<dd><?php echo $typeTag?></dd>
		</dl>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00158);/*開催日*/?></dt>
			<dd><?php
	if($seminarInfo->eventType == 1){
		$eventDate = $seminarInfo->theDate->toString();
	}else if($seminarInfo->eventType == 2){
		$eventDate = Util::dispLang(Language::WORD_00159);/* 常時開催*/
	}else{
		$eventDate = $seminarInfo->lectureList[0]->theDate->toString();
	}
	echo $eventDate;
?></dd>
		</dl>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00183);/*会場*/?></dt>
			<dd><?php echo $placeName?></dd>
		</dl>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00359);/*価格*/?></dt>
			<dd><?php
	$amount = $seminarPaymentInfo->amountBilled;
	if(is_numeric($amount)) {
	if(intval($amount) > 0){
		echo number_format($amount).Util::dispLang(Language::WORD_00161);/* 円（税込み）*/
	}else{
		echo Util::dispLang(Language::WORD_00162);/* 無料*/
	}
	} else {
	echo '-';
	}
?></dd>
		</dl>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00361);/*決済状況*/?></dt>
			<dd><?php echo $paidTag?></dd>
		</dl>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00362);/*申込状況*/?></dt>
			<dd><?php echo HtmlPartsSeminar::getApplicantStatusIconStr($seminarApplicantInfo,'MdIcBg')?></dd>
		</dl>
<?php
	if($seminarApplicantInfo->repaymentDate->toString() !== ""){
?>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00363);/*返金日*/?></dt>
			<dd><?php echo $seminarApplicantInfo->repaymentDate->toString()?></dd>
		</dl>
<?php
	}
	if($seminarApplicantInfo->repaymentAmount !== ""){
?>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00363);/*返金金額*/?></dt>
			<dd><?php echo number_format($seminarApplicantInfo->repaymentAmount).Util::dispLang(Language::WORD_00339);/*円*/?></dd>
		</dl>
<?php
	}
?>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00364);/*出欠状況*/?></dt>
			<dd><?php echo HtmlPartsSeminar::getApplicantAttendanceIconStr($seminarApplicantInfo)?></dd>
		</dl>

		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00365);/*結果*/?></dt>
			<dd><?php echo HtmlPartsSeminar::getApplicantResultIconStr($seminarApplicantInfo)?></dd>
		</dl>
<?php
	if($seminarPaymentInfo->isPaid && $seminarInfo->TypeNo === 2){
?>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00366);/*動画セミナーURL*/?></dt>
			<dd><?php echo $seminarInfo->mov_link?></dd>
		</dl>
<?php
		if($seminarInfo->video_id !== ""){
?>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00367);/*ビデオ会議ID*/?></dt>
			<dd><?php echo $seminarInfo->video_id?></dd>
		</dl>
<?php
		}
		if($seminarInfo->video_pass !== ""){
?>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00368);/*ビデオ会議PASS*/?></dt>
			<dd><?php echo $seminarInfo->video_pass?></dd>
		</dl>
<?php
		}
		if($seminarInfo->dl_file_name !== ""){
?>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00369);/*DLファイル*/?></dt>
			<dd><a href="../../sys/file/get_seminar_dl_file.php?id=<?php echo $seminarInfo->id?>"><?php echo $seminarInfo->dl_file_name?></a></dd>
		</dl>
<?php
		}
	}
?>
	</section>

	<section class="mypageOrdBoxBt">

<?php if (IS_SMART_PHONE) { ?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./payment_history.php?id=<?php echo $seminarApplicantInfo->id; ?>', false, 20, 350, 600);" class="myprirekiBt"><?php echo Util::dispLang(Language::WORD_00309);/*決済履歴*/?></a></p></dd>
<?php
		if($seminarApplicantInfo->status !== 3){
?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./sm_cancel.php?id=<?php echo $seminarApplicantInfo->id; ?>', false, 20, 350, 600, true);" class="mypcanBt"><?php echo Util::dispLang(Language::WORD_00310);/*キャンセル*/?></a></p></dd>
<?php
		}
?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./sm_detail.php?s=<?php echo htmlspecialchars($seminarInfo->urlKey)?>', false, 20, 350, 600, true);" class="mypcanBt"><?php echo Util::dispLang(Language::WORD_00186);/*詳細*/?></a></p></dd>
<?php } else { ?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./payment_history.php?id=<?php echo $seminarApplicantInfo->id; ?>', false, 50, 920, 700);" class="myprirekiBt"><?php echo Util::dispLang(Language::WORD_00309);/*決済履歴*/?></a></p></dd>
<?php
		if($seminarApplicantInfo->status !== 3){
?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./sm_cancel.php?id=<?php echo $seminarApplicantInfo->id; ?>', false, 50, 920, 700, true);" class="mypcanBt"><?php echo Util::dispLang(Language::WORD_00310);/*キャンセル*/?></a></p></dd>
<?php
		}
?>
		<p class="BtM"><a href="javascript:utilOpenFrame('./sm_detail.php?s=<?php echo htmlspecialchars($seminarInfo->urlKey)?>', false, 50, 920, 700, true);" class="mypcanBt"><?php echo Util::dispLang(Language::WORD_00178);/*セミナー詳細*/?></a></p></dd>
<?php } ?>

	</section>
