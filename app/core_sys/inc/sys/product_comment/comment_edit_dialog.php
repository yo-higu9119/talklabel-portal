			<section class="mainTi">
				<h1 class="mainTiInn"><span><?php echo Util::dispLang(Language::WORD_00659);/* レビュー編集の最終確認 */?></span></h1>
			</section>
			<div class="popup_Box">
				<section class="CautTxt cnt CautMg">
					<p><?php echo Util::dispLang(Language::WORD_00660);/* レビューを編集しても良いですか？ */?></p>
				</section>
				<div class="BtM flexBtM clear_fix">
					<p><button type="button" class="closePuBt close_popup" /><?php echo Util::dispLang(Language::WORD_00015);/* 編集しない */?></button></p>
					<p><button type="button" class="editPuBt close_popup" onclick="window.parent.comment_edit_submit(<?php echo $id; ?>)" /><?php echo Util::dispLang(Language::WORD_00016);/* 編集する */?></button></p>
				</div>
			</div>
