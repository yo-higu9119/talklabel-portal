						<h2 class="systemFotmTitle"><?php echo Util::dispLang(Language::WORD_00264);/*支払い方法*/?><br class="sp_only" /><?php echo Util::dispLang(Language::WORD_00235);/*(クレジットカードを選択された方へ)*/?></h2>
						<div class="comBoxInn mgt10 mgb10">
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/pay_input.php';?>
						</div>
						<div class="comBoxInn mgt10 mgb10">
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/card.php';?>
						</div>

						<section class="CautTxt mgt10 cnt">
							<p><?php echo Util::dispLang(Language::WORD_00231);/*上記内容で問題ありませんか？*/?><br />
							<?php echo Util::dispLang(Language::WORD_00234);/*問題なければ「最終確認へ進む」ボタンをクリックして進んでください。*/?>
							</p>
						</section>
