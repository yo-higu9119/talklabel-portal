				<div class="comBox order_Box">
					<h2 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00226);/*�I����e���m�F���Ă�������*/?></h2>
<?php
if($sErr == ""){
?>
<?php require dirname(__FILE__).'/../../../system_block/seminar/main/sem_detail_oth.php';?>
					<section class="CautTxt mgt10 cnt">
						<p><?php echo Util::dispLang(Language::WORD_00227);/*��L�I����e�Ŗ�肠��܂��񂩁H*/?><br />
						<?php echo Util::dispLang(Language::WORD_00228);/*���Ȃ���΁u���֐i�ށv�{�^�����N���b�N���Đi��ł��������B*/?>
						</p>
					</section>

					<div class="BtM mglra clear_fix spBtM spLR">
						<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 btWtM back fontFace" onclick="location.href='../../seminar/main/index.php?s=<?php echo $seminarInfo->urlKey; ?>'" /><?php echo Util::dispLang(Language::WORD_00064);/*�O�̉�ʂɖ߂�*/?></button></p>
						<p class="LayoutR"><button type="button" class="blBT mgt20 mgb10 btWtM next fontFace" onclick="location.href='./personal.php?si=<?php echo $seminarId; ?>'" /><?php echo Util::dispLang(Language::WORD_00229);/*���֐i��*/?></button></p>
					</div>
<?php
}else{
?>
					<section class="CautTxt mgt20 mgb20 cnt">
						<p><?php echo $sErr; ?></p>
					</section>
					<div class="BtM mglra clear_fix">
						<p><button type="button" class="whBT mglra mgt20 mgb10 btWtW back fontFace" onclick="location.href='../../seminar/main/index.php?s=<?php echo $seminarInfo->urlKey; ?>'" /><?php echo Util::dispLang(Language::WORD_00064);/*�O�̉�ʂɖ߂�*/?></button></p>
					</div>
<?php
}
?>
				</div>
