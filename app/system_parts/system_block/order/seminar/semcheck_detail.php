				<div class="comBox order_Box">
					<h2 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00263);/*�\�����e�̍ŏI�m�F*/?></h2>
<?php
if($sErr !== ""){
?>
					<p class="Art mgt10 mgb10 cnt"><?php echo htmlspecialchars($sErr);?></p>
<?php
}else{
?>
					<h3 class="fotm_ti"><?php echo Util::dispLang(Language::WORD_00217);/*�I����e*/?></h3>
<?php require dirname(__FILE__).'/../../../system_block/seminar/main/sem_detail_oth.php';?>

<?php
if(isset($ammount) && $ammount > 0){
?>
					<h3 class="fotm_ti"><?php echo Util::dispLang(Language::WORD_00264);/*�x�������@*/?></h3>
					<section class="FChkBox clear_fix">
						<dl class="clear_fix">
							<dt><?php echo Util::dispLang(Language::WORD_00264);/*�x�������@*/?></dt>
							<dd><?php echo (intval($_POST['pay_type']) == 1)?Util::dispLang(Language::WORD_00260)/* ��s�U�� */:Util::dispLang(Language::WORD_00261)/* �N���W�b�g�J�[�h */; ?></dd>
						</dl>
					</section>
<?php
}
?>
					<h3 class="fotm_ti"><?php echo Util::dispLang(Language::WORD_00218);/*�\���ҏ��*/?></h3>
					<section class="FChkBox clear_fix">
<?php
	foreach($memberData->Column['base'] as $Key => $funcInfo) {
		if($funcInfo->type !== 11){
?>
						<dl class="clear_fix">
							<dt><?php echo $funcInfo->name; ?></dt>
							<dd><?php
echo $memberData->getInputDisplay($Key,$funcInfo,$SYS_MemInfo);
							?></dd>
						</dl>
<?php
		}
	}
?>
					</section>

					<section class="CautTxt mgt10 cnt">
						<p><?php echo Util::dispLang(Language::WORD_00231);/*��L���e�Ŗ�肠��܂��񂩁H)*/?><br />
						<?php echo Util::dispLang(Language::WORD_00265);/*���Ȃ���Ή��L�u�\������������v�{�^�����N���b�N���Ă��������B)*/?>
						</p>
					</section>
<?php
}
?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/pay_loader.php';?>

					<div class="BtM mglra clear_fix spBtM spLR">
						<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 btWtM back" id="bk_bt" onclick="$('#from_page').submit();" /><?php echo Util::dispLang(Language::WORD_00064);/*�O�̉�ʂɖ߂�*/?></button></p>
<?php
if($sErr == ""){
?>
						<p class="LayoutR"><button type="button" class="orBT mgt20 mgb10 btWtM next" id="fc_bt" onclick="load_efect();$('#to_page').submit();" /><?php echo Util::dispLang(Language::WORD_00266);/*�\������������*/?></button></p>
<?php
}
?>
					</div>
<form method="post" action="<?php echo $fromPage; ?>" id="from_page">
<?php echo $hiddenStr1;?>
</form>
<form method="post" action="final_save.php" id="to_page">
<?php echo $hiddenStr2;?>
</form>
				</div>
