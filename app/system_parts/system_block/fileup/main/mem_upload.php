			<div class="main_ti clear_fix">
				<h1 class="bsc_ti"><span><?php echo Util::dispLang(Language::WORD_00454);/*ファイルアップロード*/?></span></h1>
			</div>
			<div class="popup_Box">
				<section class="ordDetBox">
					<section class="Art mgt10 mgb10" id="upload_msg_area" style="display: none;">
						<p><?php echo Util::dispLang(Language::WORD_00457);/*ファイルをアップロード中です...*/?></p>
					</section>
					<dl class="InputForm clear_fix">
						<dt><?php echo Util::dispLang(Language::WORD_00458);/*画像ファイル*/?></dt>
<?php
if($fileType !== 4 && $fileType !== 19) {
?>
						<dd><p><input type="file" name="up_file" size="30" accept=".jpg,.jpeg,.gif"></p></dd>
<?php
}else{
?>
						<dd><p><input type="file" name="up_file" size="30" accept="*"></p></dd>
<?php
}
?>
					</dl>
				</section>
				<section class="CautTxt cnt mgt20">
<?php
if($fileType !== 4 && $fileType !== 19) {
?>
					<p><?php echo Util::dispLang(Language::WORD_00455);/*アップロードできるファイル形式はjpg・jpeg・png・gifになります。*/?></p>
<?php
}
?>
					<p><?php echo Util::dispLang(Language::WORD_00459);/*アップロードの上限*/?><?php echo $maxSize;?>byte</p>
				</section>
				<div class="BtM mglra clear_fix spBtM mgb30">
					<input type="hidden" name="id" value="<?php echo $fileId?>" />
					<input type="hidden" name="sub" value="<?php echo $subKey?>" />
					<input type="hidden" name="add" value="<?php echo $addKey?>" />
					<input type="hidden" name="type" value="<?php echo $fileType?>" />
					<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 mglra btWtM close_popup" /><?php echo Util::dispLang(Language::WORD_00011);/*ウィンドウを閉じる*/?></button></p>
					<p class="LayoutR"><button type="submit" class="blBT mgt20 mgb10 mglra btWtM" id="upload_submit" /><?php echo Util::dispLang(Language::WORD_00456);/*アップロードする*/?></button></p>
				</div>
			</div>
