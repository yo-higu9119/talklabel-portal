					<section class="mypage clear_fix">
						<div class="htibrd clear_fix">
							<h2><?php echo Util::dispLang(Language::WORD_00127);/*セミナー申込履歴*/?></h2>
						</div>

<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/mypage/mypage_sm_purchase.php';?>

						<div class="htibrd clear_fix mgt20">
							<h2><?php echo Util::dispLang(Language::WORD_00306);/*その他の購入可能なセミナー*/?></h2>
						</div>

						<section class="SchCal">
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/mypage/mypage_sm_purchase_oth.php';?>
						</section>

					</section>
