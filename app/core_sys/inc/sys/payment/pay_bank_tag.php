						<h2 class="systemFotmTitle"><?php echo Util::dispLang(Language::WORD_00264);/*支払い方法*/?><br class="sp_only" /><?php echo Util::dispLang(Language::WORD_00233);/*(銀行振込を選択された方へ)*/?></h2>
						<div class="comBoxInn mgt10 mgb10">
							<article class="articleBox">
<?php require dirname(__FILE__).'/../../../../system_parts/crt_block/bank.php';?>
							</article>
						</div>

						<section class="CautTxt mgt10 cnt">
							<p><?php echo Util::dispLang(Language::WORD_00231);/*上記内容で問題ありませんか？*/?><br />
							<?php echo Util::dispLang(Language::WORD_00234);/*問題なければ「最終確認へ進む」ボタンをクリックして進んでください。*/?>
							</p>
						</section>
