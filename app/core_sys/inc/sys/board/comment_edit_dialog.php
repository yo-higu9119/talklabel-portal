			<section class="mainTi">
				<h1 class="mainTiInn"><span><?php echo Util::dispLang(Language::WORD_00013);/* コメント編集の最終確認 */?></span></h1>
			</section>
			<div class="popup_Box">
				<section class="CautTxtW cnt mgt20">
					<p><?php echo Util::dispLang(Language::WORD_00014);/* コメントを編集しても良いですか？ */?></p>
				</section>
				<div class="BtM flexBtM clear_fix">
					<p><button type="button" class="closePuBt close_popup" /><?php echo Util::dispLang(Language::WORD_00015);/* 編集しない */?></button></p>
					<p><button type="button" class="editPuBt close_popup" onclick="window.parent.comment_edit_submit(<?php echo $id; ?>)" /><?php echo Util::dispLang(Language::WORD_00016);/* 編集する */?></button></p>
				</div>
			</div>
