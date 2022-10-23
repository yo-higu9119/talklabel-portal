			<div class="ptLayoutInn">
				<div class="NewTpiBox">
					<p class="systemFotmTitle"><?php echo Util::dispLang(Language::WORD_00138);/*新規トピックス投稿*/?></p>
					<div class="NewTpiBoxInn mgt20 clear_fix">
						<form id="act" method="post" action="input.php?b=0<?php echo $addParam; ?>">
							<section class="InputForm">
								<fieldset>
									<dl class="clear_fix">
										<dt><?php echo Util::dispLang(Language::WORD_00444);/*カテゴリ選択*/?></dt>
										<dd>
											<select name="categoryId" class="txt size100p selectMenu">
<?php
	foreach($boardCategoryTreeInfoList as $key => $boardCategoryTreeInfo) {
		if($key < 0)continue;
?>
											<?php echo FormUtil::option("categoryId", $boardCategoryTreeInfo->id, 0, $boardCategoryTreeInfo->name);?>
<?php
	}
?>
											</select>
										</dd>
									</dl>

									<dl class="clear_fix">
										<dt><?php echo Util::dispLang(Language::WORD_00445);/*ニックネーム*/?></dt>
										<dd>
<?php
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();
if($systemInfo->common_id == 0){
?>
											<p><?php echo FormUtil::textbox('nickname', $info->nickname, 10, 250, 'txt size100p', Util::dispLang(Language::WORD_00018)/*ニックネームを入れてください*/).FormUtil::getErrorStr($result, 'nickname')?></p>
<?php
}else{
?>
											<input type="hidden" name="nickname" value="">
<?php
}
?>
										</dd>
									</dl>
									<dl class="clear_fix">
										<dt><?php echo Util::dispLang(Language::WORD_00446);/*トピックスタイトル*/?></dt>
										<dd>
											<p><?php echo FormUtil::textbox('title', $info->title, 10, 250, 'txt size100p', Util::dispLang(Language::WORD_00142)/*トピックスタイトルを入れてください*/, 'required').FormUtil::getErrorStr($result, 'nickname')?></p>
										</dd>
									</dl>
									<dl class="clear_fix">
										<dt><?php echo Util::dispLang(Language::WORD_00447);/*コメント*/?></dt>
										<dd>
											<p><?php echo FormUtil::textArea('body', $info->body, 50, 10, 'txt size100p', Util::dispLang(Language::WORD_00019)/*コメントを入力してください*/).FormUtil::getErrorStr($result, 'name')?></p>
										</dd>
									</dl>
								</fieldset>
							</section>
							<div class="clear_fix mglra mgt20">
								<input type="hidden" name="regist_check" value="<?php echo htmlspecialchars($registCheckKey);?>" />
								<p class="BtM"><button type="submit" class="topicsPostBt next" onclick="" /><?php echo Util::dispLang(Language::WORD_00143);/*新規投稿する*/?></button></p>
							</div>
						</form>
					</div>
				</div>
			</div>
