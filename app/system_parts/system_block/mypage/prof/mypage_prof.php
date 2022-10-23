					<section class="mypage">
						<div class="mypageInput mgt30">
							<!-- <p class="CautTxt mgt20 mgb10">メールアドレス等の登録情報に変更がある場合はこちらから編集してください。</p> -->
<?php
if($SYS_Message !== '') {
?>
							<p class="Art cnt mgt20 mgb10"><?php echo htmlspecialchars($SYS_Message);?></p>
<?php
}
?>
							<div class="InputForm">
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/mypage/mypage_member_edit01.php';?>
<?php
if(count($memberData->Column['master']) !== 0 || count($memberData->Column['other']) !== 0){
?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/mypage/mypage_member_edit02.php';?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/mypage/mypage_member_edit03.php';?>
							</div>
<?php
}
?>
							<div class="BtM mglra clear_fix">
								<input type="hidden" name="mode", value="save">
								<p><button type="submit" class="whBT mgt20 mglra btWtW fontFace" />入力内容の保存</button></p>
							</div>
						</div>
					</section>
