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
		$('#act').submit();
	}
	function set_submit_action(){
		$('#act').attr('action', '<?php echo $submit_action; ?>#formTop');
	}
</script>
				<div class="contactBox">

					<p class="contactTtitle"><a id="formTop" name="formTop"></a><?php echo $inquiryBaseInfo->name; ?></p>

					<div class="contactBoxInn mgt10 clear_fix">
<?php
if($mode == "input" || $mode == "check"){
	if($SYS_Message !== '') {
?>
						<p class="Art CautMg"><?php echo htmlspecialchars($SYS_Message);?></p>
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
						<section class="InputForm">
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
				if($Key !== 'base' && $Key !== 'master' && $Key !== 'other' && $Key !== 'all'){
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
						<section class="InputForm mgt10">
<?php if($mode == "input"){ ?>
							<section class="CautTxt cnt CautMg">
								<p><?php echo Util::dispLang(Language::WORD_00060);/* 上記入力内容で問題ありませんか？ */?><br />
								<?php echo Util::dispLang(Language::WORD_00061);/* 問題なければ下記「入力内容の確認」ボタンをクリックして進んでください。 */?>
								</p>
							</section>
<?php }else{ ?>
							<section class="CautTxt cnt CautMg">
								<p><?php echo Util::dispLang(Language::WORD_00060);/* 上記入力内容で問題ありませんか？ */?><br />
								<?php echo Util::dispLang(Language::WORD_00062);/* 問題なければ下記「登録を完了する」ボタンをクリックして完了してください。 */?>
								</p>
							</section>
<?php } ?>
						</section>
					</div>

					<div class="BtM clear_fix">
						<input type="hidden" name="regist_check" value="<?php echo htmlspecialchars($registCheckKey);?>">
						<input type="hidden" name="mode" value="<?php echo $mode; ?>" />
<?php if($mode == "input"){ ?>
						<p><button type="submit" class="contactRegBt next" onclick="set_submit_action();" /><?php echo Util::dispLang(Language::WORD_00063);/* 入力内容の確認 */?></button></p>
<?php }else{ ?>
						<div class="flexBtM">
							<p><button type="button" class="sbmBNBt back" onclick="set_submit_action();pre_submit();" /><?php echo Util::dispLang(Language::WORD_00064);/* 前の画面に戻る */?></button></p>
							<p><button type="submit" class="sbmCpBt next" onclick="set_submit_action();" /><?php echo Util::dispLang(Language::WORD_00065);/* 登録を完了する */?></button></p>
						</div>
<?php } ?>
					</div>
<?php
}else if($mode == "end"){
?>
						<div class="formThanks">
							<?php echo str_replace("\r\n","<br />",htmlspecialchars($inquiryBaseInfo->end_body)); ?>
						</div>
					</div>
<?php
}
?>
				</div>
<?php
}
}
?>
