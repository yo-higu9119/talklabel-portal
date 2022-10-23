			<div class="main_ti clear_fix">
				<h1 class="bsc_ti"><span><?php echo htmlspecialchars($seminarInfo->name)?></span></h1>
			</div>
			<div class="popup_Box">
				<section class="ordDetBox">
<?php require dirname(__FILE__).'/../../../system_block/seminar/main/sem_title.php';?>
<?php require dirname(__FILE__).'/../../../system_block/seminar/main/sem_visual.php';?>
<?php require dirname(__FILE__).'/../../../system_block/seminar/main/sem_detail.php';?>
<?php require dirname(__FILE__).'/../../../system_block/seminar/main/sem_detail_oth.php';?>
				</section>
				<div class="BtM mglra clear_fix">
					<p><button type="submit" class="whBT mgt20 mgb10 mglra btWtM close_popup" /><?php echo Util::dispLang(Language::WORD_00011);/*ウィンドウを閉じる*/?></button></p>
				</div>
			</div>
