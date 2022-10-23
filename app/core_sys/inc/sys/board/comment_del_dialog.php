			<section class="mainTi">
				<h1 class="mainTiInn"><span><?php echo Util::dispLang(Language::WORD_00021);/* コメント削除の最終確認 */?></span></h1>
			</section>
			<div class="popup_Box">
				<section class="CautTxtW cnt mgt20">
					<p><?php echo Util::dispLang(Language::WORD_00022);/* コメントを削除しても良いですか？ */?></p>
				</section>
				<div class="BtM flexBtM clear_fix">
					<p><button type="button" class="closePuBt close_popup" /><?php echo Util::dispLang(Language::WORD_00023);/* 削除しない */?></button></p>
					<p><button type="button" class="editPuBt close_popup" onclick="window.parent.comment_del_submit(<?php echo $id; ?>)" /><?php echo Util::dispLang(Language::WORD_00024);/* 削除する */?></button></p>
				</div>
			</div>
