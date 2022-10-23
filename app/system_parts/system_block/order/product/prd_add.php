			<div class="main_ti clear_fix">
				<h1 class="bsc_ti"><span><?php echo $title; ?></span></h1>
			</div>
			<div class="popup_Box">
<?php
if($sErr !== '') {
?>
				<div class="Art mgt20 mgb20"><?php echo htmlspecialchars($sErr);?></div>
<?php
}else{
	if($message !== '') {
?>
				<div class="Art mgt20 mgb20"><?php echo htmlspecialchars($message);?></div>
<?php
	}
?>
				<section class="ordDetBox">
					<div class="InputForm">
						<dl class="clear_fix">
							<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00420);/*氏名*/?><span class="NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
							<dd><p><?php echo FormUtil::textBox('name', $info->name, 10, 250, 'txt size300', '-', 'required').FormUtil::getErrorStr($result, 'name');?></p></dd>
						</dl>
						<dl class="clear_fix">
							<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00421);/*電話番号*/?><span class="NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
							<dd><p><?php echo FormUtil::textBox('tel', $info->tel, 10, 12, 'txt size300', '-', 'required').FormUtil::getErrorStr($result, 'tel');?></p></dd>
						</dl>
<?php
$zip  = $info->zip;
$zip_array = explode("-", $zip);
$zip_array = array_map('trim', $zip_array);
$zip_array = array_filter($zip_array, 'strlen');
$zip_array = array_values($zip_array);
if(count($zip_array) != 2){
	$zip_array[0] = "";
	$zip_array[1] = "";
}
?>
						<dl class="clear_fix">
							<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00422);/*住所*/?><span class="NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
							<dd>
								<div class="clear_fix">
								<p class="LayoutL"><?php echo FormUtil::textBox('zip1', $zip_array[0], 3, 3, 'txt ime size60', '-', '').' - '.FormUtil::textBox('zip2', $zip_array[1], 4, 4, 'txt ime size80', '-', '');?></p>
								<p class="SearchBT LayoutL" id="zip_button"><a href="javascript:AjaxZip3.zip2addr('zip1','zip2','area','add1');"><?php echo Util::dispLang(Language::WORD_00424);/*住所検索*/?></a></p>
								<?php echo FormUtil::getErrorStr($result, 'zip');?>
								</div>
								<p class="mgt10 mgb10">
<?php
$area_array = Master::getPrefectureList();
$tmp_str = "";
if(intval($info->area) !== 0){
	$area = $area_array[intval($info->area)];
}else{
	$area = "";
}
?>
								<select name="area" class="txt size150 selectMenu">
								<?php echo FormUtil::option('area', "", $area, '選択して下さい');?>
<?php
foreach($area_array as $val) {
?>
								<?php echo FormUtil::option('area', $val, $area, $val);?>
<?php
}
?>
								</select><?php echo FormUtil::getErrorStr($result, 'area');?>
								</p>
								<p><?php echo FormUtil::textBox('add1', $info->add1, 50, 250, 'txt size100p', '市区町村番地', 'required').FormUtil::getErrorStr($result, 'add1');?></p>
								<p><?php echo FormUtil::textBox('add2', $info->add2, 50, 250, 'txt size100p', 'マンション名').FormUtil::getErrorStr($result, 'add2');?></p>
							</dd>
						</dl>
						<dl class="clear_fix">
							<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00423);/*会社名（オプション）*/?><span class="NewIcBg BgBlu"><?php echo Util::dispLang(Language::WORD_00059);/*任意*/?></span></p></dt>
							<dd><p><?php echo FormUtil::textBox('company', $info->company, 50, 250, 'txt size100p', '-').FormUtil::getErrorStr($result, 'company');?></p></dd>
						</dl>
					</div>
				</section>
<?php
}
?>
				<section class="CautTxt cnt mgt20">
					<p><?php echo Util::dispLang(Language::WORD_00417);/*上記内容で新しい配送先を追加しても良いですか？*/?><br class="pc_only" />
					<?php echo Util::dispLang(Language::WORD_00418);/*問題なければ下の「新しい配送先を追加する」のボタンをクリックしてください。*/?>
					</p>
				</section>
				<div class="BtM mglra clear_fix spBtM mgb30">
					<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 mglra btWtM close_popup" /><?php echo Util::dispLang(Language::WORD_00011);/*ウィンドウを閉じる*/?></button></p>
<?php   if($sErr === '') { ?>
					<p class="LayoutR"><button type="submit" class="grBT mgt20 mgb10 mglra btWtM" /><?php echo Util::dispLang(Language::WORD_00419);/*住所を編集する*/?></button></p>
<?php   } ?>
				</div>
			</div>