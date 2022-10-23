				<div class="comBox order_Box">
					<h2 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00226);/*選択内容を確認してください*/?></h2>
<?php
if($sErr == ""){
?>
<?php require dirname(__FILE__).'/../../../system_block/seminar/main/sem_detail_oth.php';?>
					<section class="CautTxt mgt10 cnt">
						<p><?php echo Util::dispLang(Language::WORD_00227);/*上記選択内容で問題ありませんか？*/?><br />
						<?php echo Util::dispLang(Language::WORD_00228);/*問題なければ「次へ進む」ボタンをクリックして進んでください。*/?>
						</p>
					</section>

					<div class="BtM mglra clear_fix spBtM spLR">
						<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 btWtM back fontFace" onclick="location.href='../../seminar/main/index.php?s=<?php echo $seminarInfo->urlKey; ?>'" /><?php echo Util::dispLang(Language::WORD_00064);/*前の画面に戻る*/?></button></p>
						<p class="LayoutR"><button type="button" class="blBT mgt20 mgb10 btWtM next fontFace" onclick="location.href='./personal.php?si=<?php echo $seminarId; ?>'" /><?php echo Util::dispLang(Language::WORD_00229);/*次へ進む*/?></button></p>
					</div>
<?php
}else{
?>
					<section class="CautTxt mgt20 mgb20 cnt">
						<p><?php echo $sErr; ?></p>
					</section>
					<div class="BtM mglra clear_fix">
						<p><button type="button" class="whBT mglra mgt20 mgb10 btWtW back fontFace" onclick="location.href='../../seminar/main/index.php?s=<?php echo $seminarInfo->urlKey; ?>'" /><?php echo Util::dispLang(Language::WORD_00064);/*前の画面に戻る*/?></button></p>
					</div>
<?php
}
?>
				</div>
