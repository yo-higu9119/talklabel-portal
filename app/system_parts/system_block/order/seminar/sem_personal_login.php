<?php
	/* -- �����O�C���� -- */
	if(!$session->isLogin()){
?>
				<div class="comBox order_Box mgb30">
					<h2 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00210);/*���ɉ���o�^�����ς݂̕��͉�����O�C�������Ă�������*/?></h2>
					<div class="comBoxInn clear_fix">
						<form method="post" action="<?php $path_parts = pathinfo($_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);echo $path_parts['basename'];?>" id="login_frm">
							<input type="hidden" name="mode" id="mode" value="login" />
							<input type="hidden" name="si" value="<?php echo $seminarId;?>" />
							<section class="InputFormT">
<?php
		if($message !== '') {
				echo '<p class="Art cnt mgt10 mgb10">'.htmlspecialchars($message).'</p>';
		}
?>

<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/common/login_field.php';?>

								<div class="BtM"><button type="button" class="bkBT mgt10 mgb10 mglra btWtN next" onclick="$('#login_frm').submit();" /><?php echo Util::dispLang(Language::WORD_00074);/* ����T�C�g�փ��O�C������ */?></button></div>
								<p class="BTM"><a href="<?php echo SYSTEM_TOP_URL; ?>users/reminder/" class="whBT mgt20 mgb10 mglra btWtSS next"><?php echo Util::dispLang(Language::WORD_00075);/* �p�X���[�h��Y�ꂽ���͂����� */?></a></p>
							</section>
						</form>
					</div>
				</div>
<?php
	}
	/* -- �����O�C���� -- */
?>
