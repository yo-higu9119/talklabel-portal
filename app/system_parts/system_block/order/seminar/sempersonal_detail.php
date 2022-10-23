<?php
if($sErr !== ""){
/* -- 致命的なエラー時 -- */
?>
				<div class="comBox order_Box">
					<p class="Art"><?php echo htmlspecialchars($sErr);?></p>
					<form method="post" action="<?php $path_parts = pathinfo($_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);echo $path_parts['basename'];?>" id="act">
						<input type="hidden" name="si" value="<?php echo $seminarId;?>" />
						<div class="BtM mglra clear_fix">
							<p><button type="button" class="whBT mglra mgt20 mgb10 btWtW back" onclick="$('#act').attr('action', 'cart.php');$('#act').submit();" /><?php echo Util::dispLang(Language::WORD_00064);/*前の画面に戻る*/?></button></p>
						</div>
					</form>
				</div>
<?php
/* -- 致命的なエラー時 -- */
}else{
/* -- 通常時 -- */
?>
<?php
$from_basename_file = basename(__FILE__);
require dirname(__FILE__).'/../../../../system_parts/system_block/order/seminar/sem_personal_login.php';
?>
				<div class="comBox order_Box">
					<form method="post" action="<?php $path_parts = pathinfo($_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);echo $path_parts['basename'];?>" id="act">
						<input type="hidden" name="mode" id="mode" value="save" />
						<input type="hidden" name="si" value="<?php echo $seminarId;?>" />
						<h2 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00230);/*個人情報を入力してください*/?></h2>
						<div class="comBoxInn mgt10 clear_fix">
							<section class="InputForm">
<?php
	if($SYS_Message !== '') {
?>
								<p class="Art mgt10 mgb10 cnt"><?php echo htmlspecialchars($SYS_Message);?></p>
<?php
	}
?>
<?php
	foreach($memberData->Column['base'] as $Key => $funcInfo) {
		if($funcInfo->type !== 11){
			if($funcInfo->required === 1){$required = '<span class="NewIcBg BgPnc">'.Util::dispLang(Language::WORD_00058)/* 必須 */.'</span>';}else{$required = '<span class="NewIcBg BgBlu">'.Util::dispLang(Language::WORD_00059)/* 任意 */.'</span>';}
?>
								<dl class="clear_fix">
									<dt class="clear_fix"><p class="LayoutL"><?php echo $funcInfo->name.$required; ?></p></dt>
									<dd><?php echo $memberData->getInpuTag($Key,$funcInfo,$SYS_MemInfo); ?>
										<?php echo FormUtil::getErrorStrPub($SYS_Result, $Key); ?>
									</dd>
								</dl>
<?php
		}
	}
?>
							</section>
						</div>
						<section class="CautTxt mgt10 cnt">
							<p><?php echo Util::dispLang(Language::WORD_00231);/*上記内容で問題ありませんか？*/?><br />
							<?php echo Util::dispLang(Language::WORD_00228);/*問題なければ「次へ進む」ボタンをクリックして進んでください。*/?>
							</p>
						</section>

						<div class="BtM mglra clear_fix spBtM spLR">
							<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 btWtM back" onclick="$('#act').attr('action', 'cart.php');$('#act').submit();" /><?php echo Util::dispLang(Language::WORD_00064);/*前の画面に戻る*/?></button></p>
							<p class="LayoutR"><button type="button" class="blBT mgt20 mgb10 btWtM next" onclick="$('#act').submit();" /><?php echo Util::dispLang(Language::WORD_00229);/*次へ進む*/?></button></p>
						</div>
					</form>
				</div>
<?php
/* -- 通常時 -- */
}
?>
