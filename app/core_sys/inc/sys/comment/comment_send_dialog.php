			<section class="mainTi">
				<h1 class="mainTiInn"><span><?php echo Util::dispLang(Language::WORD_00035);/* コメント投稿の最終確認 */?></span></h1>
			</section>
			<div class="popup_Box">
				<section class="CautTxt cnt CautMg">
					<p><?php echo Util::dispLang(Language::WORD_00036);/* コメントを投稿しても良いですか？ */?></p>
				</section>
				<div class="BtM flexBtM clear_fix">
					<p><button type="button" class="closePuBt close_popup" /><?php echo Util::dispLang(Language::WORD_00037);/* 投稿しない */?></button></p>
					<p><button type="button" class="editPuBt close_popup" onclick="window.parent.comment_submit(0)" /><?php echo Util::dispLang(Language::WORD_00038);/* 投稿する */?></button></p>
				</div>
			</div>
