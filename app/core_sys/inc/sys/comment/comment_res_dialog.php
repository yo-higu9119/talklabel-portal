			<section class="mainTi">
				<h1 class="mainTiInn"><span><?php echo Util::dispLang(Language::WORD_00031);/* 返信コメント投稿の最終確認 */?></span></h1>
			</section>
			<div class="popup_Box">
				<section class="CautTxt cnt CautMg">
					<p><?php echo Util::dispLang(Language::WORD_00032);/* 返信コメントを投稿しても良いですか？ */?></p>
				</section>
				<div class="BtM flexBtM clear_fix">
					<p><button type="button" class="closePuBt close_popup" /><?php echo Util::dispLang(Language::WORD_00033);/* 投稿しない */?></button></p>
					<p><button type="button" class="editPuBt close_popup" onclick="window.parent.comment_submit(<?php echo $id; ?>)" /><?php echo Util::dispLang(Language::WORD_00034);/* 投稿する */?></button></p>
				</div>
			</div>
