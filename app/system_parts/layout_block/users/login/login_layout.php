	<div id="main" class="clear_fix">
		<div class="login_det_Box">
			<div class="comBox">
				<div class="comBoxInn">
					<div class="InputFormT">
			<?php
			if($message !== '') {
			echo '<p class="Art cnt mgt10 mgb10">'.htmlspecialchars($message).'</p>';
			}
			?>

			<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/common/login_field.php';?>
			<?php if($isUsetLanguage == 1){ ?>
			<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/common/login_lang.php';?>
			<?php } ?>

						<div class="BtM"><button type="submit" class="bkBT mgt10 mgb10 mglra btWtN next" />ログインする</button></div>
			<?php
			$systemData = new SystemData('');
			$systemInfo = $systemData->getInfo();
			if($systemInfo->common_id == 0){
			?>
			<?php } ?>
		</div>
				</div>
			</div>
		</div>
	</div>
