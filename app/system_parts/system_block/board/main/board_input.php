					<section class="board clear_fix">
<?php
	if (!$session->isLogin()) {
?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/board/board_mem.php';?>
<?php
	} else {
		if($sErr != ""){
			echo $sErr;
?>

<?php
		} else {
			echo $message;
?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/board/board_topics_input.php';?>
<?php
		}
	}
?>
						<div class="BtM mgt30 mgb30">
							<p><button type="button" class="whBT mglra btWtM back" onclick="location.href='./?b=0<?php echo $addParam; ?>'" /><?php echo Util::dispLang(Language::WORD_00140);/*掲示板一覧に戻る*/?></button></p>
						</div>
					</section>
