				<div class="comBox">
					<div class="comBoxInn clear_fix">
						<section class="InputFormT">
<?php
if($message !== '') {
		echo '<p class="Art cnt mgt10 mgb10">'.htmlspecialchars($message).'</p>';
}
?>

<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/common/login_field.php';?>
<?php if($isUsetLanguage == 1){ ?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/common/login_lang.php';?>
<?php } ?>

							<div class="BtM"><button type="submit" class="bkBT mgt10 mgb10 mglra btWtN next" /><?php echo Util::dispLang(Language::WORD_00074);/* 会員サイトへログインする */?></button></div>
<?php
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();
if($systemInfo->common_id == 0){
?>
							<p class="BTM"><a href="<?php echo SYSTEM_TOP_URL; ?>users/reminder/" class="whBT mgt20 mgb10 mglra btWtSS next"><?php echo Util::dispLang(Language::WORD_00075);/* パスワードを忘れた方はこちら */?></a></p>
<?php } ?>
						</section>
					</div>
					<div class="BtM"><button type="button" class="whBT mgt30 mgb30 mglra btWtN next" onclick="location.href='<?php echo SYSTEM_TOP_URL; ?>users/new_member/'" /><?php echo Util::dispLang(Language::WORD_00076);/* 新規無料会員登録 */?></button></div>
				</div>
