					<section class="mypage clear_fix">
						<div class="htibrd clear_fix">
							<h2><?php echo $SYS_FormTitle; ?><?php echo Util::dispLang(Language::WORD_00448);/*履歴*/?></h2>
						</div>

<?php
if($SYS_Message !== '') {
?>
						<div class="CautTxt mgt10 mgb20">
							<p><?php echo htmlspecialchars($SYS_Message);?></p>
						</div>
<?php
}
foreach($inquiryList as $value){
	$inquiryInfo = $inquiryData->getInfo($value->id);
?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/mypage/mypage_contact_detail.php';?>
<?php
}
?>
					</section>
