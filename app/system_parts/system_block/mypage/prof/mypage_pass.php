					<section class="mypage">
						<div class="mypageInput mgt30">
<?php
if($SYS_Message !== '') {
?>
							<p class="Art cnt mgt20 mgb10"><?php echo htmlspecialchars($SYS_Message);?></p>
<?php
}
?>
							<div class="InputForm">
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/mypage/mypage_member_passedit.php';?>
							</div>

							<div class="BtM mglra clear_fix">
								<input type="hidden" name="mode", value="save">
								<input type="hidden" name="regist_check" value="<?php echo $registCheckKey; ?>">
								<p><button type="submit" class="whBT mgt20 mglra btWtW fontFace" />入力内容の保存</button></p>
							</div>
						</div>
					</section>
