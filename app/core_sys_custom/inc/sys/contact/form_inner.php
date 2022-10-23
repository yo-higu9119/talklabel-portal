<?php
require_once dirname(__FILE__).'/../../../../../common/inc/util/form_util.php';
require_once dirname(__FILE__).'/../../../../../common/inc/data/path_info.php';
require_once dirname(__FILE__).'/../../../../../common/inc/util/file_util.php';
require_once dirname(__FILE__).'/../../../../../common/inc/data/input_function.php';
require_once dirname(__FILE__).'/../../../../../common/inc/data/master_base.php';
require_once dirname(__FILE__).'/../../../../../common/inc/data/member_data.php';
require_once dirname(__FILE__).'/../../../../../common/inc/data/inquiry_data.php';
require_once dirname(__FILE__).'/../../../../../common/inc/data/inquiry_input_function.php';
require_once dirname(__FILE__).'/../../../../../common/inc/data/inquiry_base.php';
require_once dirname(__FILE__).'/../../../../../common/inc/util/spl_lib.php';

require_once dirname(__FILE__).'/../../../../core_sys/inc/sys/external/external_cooperation.php';
require_once dirname(__FILE__).'/../../../../core_sys/inc/sys/contact/contact_sys.php';
require_once dirname(__FILE__).'/../../../../core_sys/inc/sys/contact/contact.php';

if($sErrCon == ""){
$isDisplay = false;
if(isset($comReq) && $comReq){
	if($inquiryBaseInfo->tempalte_use == 0){
		$isDisplay = true;
	}
}else{
	$isDisplay = true;
}

if($isDisplay){
?>
<script type="text/javascript">
	function pre_submit(){
		$('input:hidden[name="mode"]').val("pre");
		$('#act').attr('action', '<?php echo $submit_action_before; ?>');
		$('#act').submit();
	}
	function set_submit_action(){
		$('#act').attr('action', '<?php echo $submit_action; ?>');
	}
	function set_submit_action_last(){
		$('#act').attr('action', '<?php echo $submit_action_after; ?>');
	}
</script>
				<div class="comBox contact_Box <?php if($mode=="end"){echo "end";}?>">

					<h2 class="fotm_ti"><a id="formTop" name="formTop"></a><?php echo $inquiryBaseInfo->name; ?></h2>

					<div class="comBoxInn mgt10 clear_fix">
<?php
if($mode == "input" || $mode == "check"){
	if($SYS_Message !== '') {
?>
						<p class="Art mgt10 mgb10"><?php echo htmlspecialchars($SYS_Message);?></p>
<?php
	}
	if(!$session->isLogin()){
		$nextMgt = ' mgt30';
?>
						<section class="InputForm">
<?php
	foreach($memberData->Column['base'] as $Key => $funcInfo) {
		if($funcInfo->required === 1 || (count($memberData->useList)>0 && array_key_exists($Key,$memberData->useList) && $memberData->useList[$Key])){$required = '<span class="NewIcBg BgPnc">'.Util::dispLang(Language::WORD_00058)/* 必須 */.'</span>';}else{$required = '<span class="NewIcBg BgBlu">'.Util::dispLang(Language::WORD_00059)/* 任意 */.'</span>';}
		if($funcInfo->type !== 11){
?>
							<dl class="clear_fix">
								<dt class="clear_fix"><p class="LayoutL"><?php echo $funcInfo->name.$required; ?></p></dt>
								<dd><?php if($mode == "input"){echo $memberData->getInpuTag($Key,$funcInfo,$SYS_MemInfo);}else{echo $memberData->getInputDisplay($Key,$funcInfo,$SYS_MemInfo);} ?>
									<?php echo FormUtil::getErrorStrPub($SYS_MemResult, $Key); ?>
								</dd>
							</dl>
<?php
		}else{
			echo FormUtil::hidden('file_name'.$funcInfo->id,"");
		}
	}
?>
						</section>
<?php
	}else{
		$nextMgt = '';
	}
?>
						<section class="InputForm<?php echo $nextMgt; ?>">
<?php
	if(count($inquiryData->Column['master']) !== 0 || count($inquiryData->Column['other']) !== 0){
?>
<?php
		foreach($inquiryData->Column['master'] as $Key => $funcInfo) {
			if($funcInfo->required === 1){$required = '<span class="NewIcBg BgPnc">'.Util::dispLang(Language::WORD_00058)/* 必須 */.'</span>';}else{$required = '<span class="NewIcBg BgBlu">'.Util::dispLang(Language::WORD_00059)/* 任意 */.'</span>';}
?>
							<dl class="clear_fix">
								<dt class="clear_fix"><p class="LayoutL"><?php echo $funcInfo->name.$required; ?></p></dt>
								<dd>
									<?php if($mode == "input"){echo $inquiryData->getInpuTag($Key,$funcInfo,$inquiryInfo);}else{echo $inquiryData->getInputDisplay($Key,$funcInfo,$inquiryInfo);} ?>
									<?php echo FormUtil::getErrorStrPub($SYS_InqResult, $Key); ?>
								</dd>
							</dl>
<?php
		}
?>
<?php
		$systemData = new SystemData('');
		$systemInfo = $systemData->getInfo();
		foreach($inquiryData->Column['other'] as $Key => $funcInfo) {
			if($funcInfo->required === 1){$required = '<span class="NewIcBg BgPnc">'.Util::dispLang(Language::WORD_00058)/* 必須 */.'</span>';}else{$required = '<span class="NewIcBg BgBlu">'.Util::dispLang(Language::WORD_00059)/* 任意 */.'</span>';}
			if($funcInfo->type !== 11 || ($funcInfo->type == 11 && $session->isLogin() && $systemInfo->common_id == 0)){
?>
							<dl class="clear_fix">
								<dt class="clear_fix"><p class="LayoutL"><?php echo $funcInfo->name.$required; ?></p></dt>
								<dd><?php if($mode == "input"){echo $inquiryData->getInpuTag($Key,$funcInfo,$inquiryInfo);}else{echo $inquiryData->getInputDisplay($Key,$funcInfo,$inquiryInfo);} ?>
									<?php echo FormUtil::getErrorStrPub($SYS_InqResult, $Key); ?>
								</dd>
							</dl>
<?php
			}else{
				echo FormUtil::hidden('file_name'.$funcInfo->id,"");
			}
		}
?>
						</section>
<?php
		if($mode == "input"){
?>
<script>
$(function() {
	$(function() {
<?php
			foreach($inquiryData->Column as $Key => $funcInfo) {
				if($Key !== 'base' && $Key !== 'master' && $Key !== 'other'){
					if($funcInfo->type === 11){
?>
		$('#file_del<?php echo $funcInfo->id; ?>').on('click', function() {
			$('input[name="file_operation<?php echo $funcInfo->id; ?>"]').val(0);
			$('input[name="file_name<?php echo $funcInfo->id; ?>"]').val('');
			$('#file_view<?php echo $funcInfo->id; ?>').hide();
			$('#file_up<?php echo $funcInfo->id; ?>').show();
			return false;
		});
<?php
					}
				}
			}
?>
	});
});
</script>
<?php
		}
	}
?>
<?php if($mode == "input"){ ?>
<section class="InputForm">
	<dl class="clear_fix">
		<dt class="clear_fix">
			<p class="LayoutL">個人情報の取り扱い<span class="NewIcBg BgPnc">必須</span></p>
		</dt>
		<dd>
			<ul class="clear_fix">
				<li><label class="checkbox_text">
					<input type="checkbox" name="FORM00010_0" value="<a href=&quot;https://talk-label.com/company/?s=privacy&quot; target=&quot;_blank&quot;>プライバシーポリシー</a>に同意します" class="validate[minCheckbox[1]]"><a href="https://talk-label.com/company/?s=privacy" target="_blank">プライバシーポリシー</a>に同意します
				</label></li>
			</ul>
		</dd>
	</dl>
</section>
<?php }?>
						<section class="InputForm mgt30">
<?php if($mode == "input"){ ?>
							<section class="CautTxtW cnt">
								<p><?php echo Util::dispLang(Language::WORD_00060);/* 上記入力内容で問題ありませんか？ */?><br />
								<?php echo Util::dispLang(Language::WORD_00061);/* 問題なければ下記「入力内容の確認」ボタンをクリックして進んでください。 */?>
								</p>
							</section>
<?php }else{ ?>
							<section class="CautTxtW cnt">
								<p><?php echo Util::dispLang(Language::WORD_00060);/* 上記入力内容で問題ありませんか？ */?><br />
								<?php echo Util::dispLang(Language::WORD_00062);/* 問題なければ下記「登録を完了する」ボタンをクリックして完了してください。 */?>
								</p>
							</section>
<?php } ?>
						</section>
					</div>

					<div class="BtM mglra clear_fix spBtM spLR">
						<input type="hidden" name="regist_check" value="<?php echo htmlspecialchars($registCheckKey);?>">
						<input type="hidden" name="mode" value="<?php echo $mode; ?>" />
<?php if($mode == "input"){ ?>
						<p><button type="submit" class="whBT mgt20 mgb10 mglra btWtW next" onclick="set_submit_action();" /><?php echo Util::dispLang(Language::WORD_00063);/* 入力内容の確認 */?></button></p>
<?php }else{ ?>
						<p class="LayoutL"><button type="button" class="whBT mgt20 mgb10 mglra btWtM back" onclick="set_submit_action();pre_submit();" /><?php echo Util::dispLang(Language::WORD_00064);/* 前の画面に戻る */?></button></p>
						<p class="LayoutR"><button type="submit" class="orBT mgt20 mgb10 mglra btWtM next" onclick="set_submit_action_last();" /><?php echo Util::dispLang(Language::WORD_00065);/* 登録を完了する */?></button></p>
<?php } ?>
					</div>
<?php
}else if($mode == "end"){
?>
						<div class="formThanks">
						<p class="formThanksParagraph">
							ご依頼いただきました資料に関しましては、<br>
							下記URLよりご確認ください。<br>
							<br>
							<a href="https://talk-label.com/contents/pdf/talklabel_materials.pdf">https://talk-label.com/contents/pdf/talklabel_materials.pdf</a><br>
							<br>
							こちらの資料は、別途メールでも<br>
							お送りさせていただいておりますので<br class="spOnly">ご確認ください。<br>
							<br>
							フォームにご記入いただいた<br class="spOnly">ご質問等に関しましては<br class="spOnly"><br>
							担当よりメールまたはお電話にて、<br class="spOnly">ご回答させていただきます。<br>
						</p>
						</div>
					</div>
					<div>
						<p class="LayoutM"><button type="button" class="whBT mgt20 mgb10 mglra btWtM back" onclick="location.href='../../'">トップページに戻る</button></p>
					</div>
<?php
}
?>
				</div>
<?php
}
}
?>
