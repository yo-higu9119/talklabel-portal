				<div id="form1">
					<form method="post" action="<?php $path_parts = pathinfo($_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);echo $path_parts['basename'];?>" id="payment-form1">
					<input type="hidden" name="pay_type" id="pay_type1" value="" />
					<?php echo $hiddenStr;?>
					<section class="selectBox">

<?php require dirname(__FILE__).'/./pay_bank_tag.php';?>

						<div class="BtM flexBtM clear_fix">
							<p><button type="button" class="sbmBNBt back" onclick="$('#payment-form1').attr('action', 'sm_input.php');$('#payment-form1').submit();" /><?php echo Util::dispLang(Language::WORD_00064);/*前の画面に戻る*/?></button></p>
							<p><button type="button" class="sbmNxBt next" onclick="$('#payment-form1').attr('action', 'sm_input_check.php');$('#payment-form1').submit();" /><?php echo Util::dispLang(Language::WORD_00262);/*最終確認へ進む*/?></button></p>
						</div>
					</section>
					</form>
				</div>

				<div id="form2">
					<form method="post" action="<?php $path_parts = pathinfo($_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);echo $path_parts['basename'];?>" id="payment-form2">
					<input type="hidden" name="pay_type" id="pay_type2" value="" />
					<?php echo $hiddenStr;?>
					<p class="Art mgt10 mgb10 payment-errors" style="display:none;"></p>
					<section class="selectBox">

<?php require dirname(__FILE__).'/./pay_crdcard_tag.php';?>
<?php require dirname(__FILE__).'/./pay_loader.php';?>

						<div class="BtM flexBtM clear_fix">
							<p><button type="button" class="sbmBNBt back" onclick="$('#payment-form2').attr('action', 'sm_input.php');$('#payment-form2').submit();" /><?php echo Util::dispLang(Language::WORD_00064);/*前の画面に戻る*/?></button></p>
							<p><button type="button" class="sbmNxBt next" id="setting_submit" onclick="load_efect();" /><?php echo Util::dispLang(Language::WORD_00262);/*最終確認へ進む*/?></button></p>
						</div>
					</section>
					</form>
				</div>
