			<section class="mainTi">
				<h1 class="mainTiInn"><span><?php echo Util::dispLang(Language::WORD_00027);/* 通報コメント投稿の最終確認 */?></span></h1>
			</section>
			<div class="popup_Box">
				<section class="CautTxtW cnt mgt20">
					<p><?php echo Util::dispLang(Language::WORD_00028);/* 通報コメントを投稿しても良いですか？ */?></p>
				</section>
				<div class="BtM flexBtM clear_fix">
					<p><button type="button" class="closePuBt close_popup" /><?php echo Util::dispLang(Language::WORD_00029);/* 通報しない */?></button></p>
					<p><button type="button" class="editPuBt close_popup" onclick="window.parent.comment_rep_submit(<?php echo $id; ?>)" /><?php echo Util::dispLang(Language::WORD_00030);/* 通報する */?></button></p>
				</div>
			</div>
