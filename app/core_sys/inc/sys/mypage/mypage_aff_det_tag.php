<?php
if($SYS_MemInfo->rank_id === 0) {
?>
							<p class="Art cnt mgt20 mgb10"><?php echo Util::dispLang(Language::WORD_00514);/*会員ランクがありません*/?></p>
<?php
}else{
?>
						<div class="htibrd clear_fix">
							<h2><?php echo Util::dispLang(Language::WORD_00511);/*紹介URL*/?></h2>
						</div>
						<div class="mypageDet mgb20 clear_fix">
							<dl class="clear_fix">
								<dt><?php echo Util::dispLang(Language::WORD_00515);/*あなたのランク*/?></dt>
								<dd><p><?php echo $rankInfo->name; ?></p></dd>
							</dl>
<?php
	if($rankInfo->introduction_rank !== 0){
?>
							<dl class="clear_fix">
								<dt><?php echo Util::dispLang(Language::WORD_00516);/*紹介者ランク*/?></dt>
								<dd><p><?php echo $rankList[$rankInfo->id]->name; ?></p></dd>
							</dl>
							<dl class="clear_fix">
								<dt><?php echo Util::dispLang(Language::WORD_00517);/*紹介報酬*/?></dt>
								<dd><?php echo number_format($rankInfo->introduction_reward); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
							</dl>
<?php
	}
?>
							<dl class="clear_fix">
								<dt><?php echo Util::dispLang(Language::WORD_00518);/*1ティア報酬*/?></dt>
<?php
	if($rankInfo->tier1_type == 1){
?>
								<dd><?php echo Util::dispLang(Language::WORD_00519);/*固定金額指定*/?>:　<?php echo number_format($rankInfo->tier1_reward); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
<?php
	}else{
?>
								<dd><?php echo Util::dispLang(Language::WORD_00520);/*売上料率指定*/?>:　<?php echo $rankInfo->tier1_reward; ?>％</dd>
<?php
	}
?>
							</dl>
							<dl class="clear_fix">
								<dt><?php echo Util::dispLang(Language::WORD_00521);/*2ティア報酬*/?></dt>
<?php
	if($rankInfo->tier2_type == 1){
?>
								<dd><?php echo Util::dispLang(Language::WORD_00519);/*固定金額指定*/?>:　<?php echo number_format($rankInfo->tier2_reward); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
<?php
	}else{
?>
								<dd><?php echo Util::dispLang(Language::WORD_00520);/*売上料率指定*/?>:　<?php echo $rankInfo->tier2_reward; ?>％</dd>
<?php
	}
?>
							</dl>
							<dl class="clear_fix">
								<dt><?php echo Util::dispLang(Language::WORD_00522);/*3ティア報酬*/?></dt>
<?php
	if($rankInfo->tier3_type == 1){
?>
								<dd><?php echo Util::dispLang(Language::WORD_00519);/*固定金額指定*/?>:　<?php echo number_format($rankInfo->tier3_reward); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
<?php
	}else{
?>
								<dd><?php echo Util::dispLang(Language::WORD_00520);/*売上料率指定*/?>:　<?php echo $rankInfo->tier3_reward; ?>％</dd>
<?php
	}
?>
							</dl>
							<dl class="clear_fix">
								<dt><?php echo Util::dispLang(Language::WORD_00511);/*紹介URL*/?></dt>
								<dd><p class="breakall"><?php echo $qrStr; ?></p></dd>
							</dl>
							<dl class="clear_fix">
								<dt><?php echo Util::dispLang(Language::WORD_00523);/*QRコード*/?></dt>
								<dd><p><img src="<?php echo SYSTEM_TOP_URL; ?>core_sys/sys/file/get_member_qr_code_file.php"></p></dd>
							</dl>
						</div>
<?php
}
?>
