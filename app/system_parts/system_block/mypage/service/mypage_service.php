					<section class="mypage clear_fix">
						<div class="htibrd clear_fix">
							<h2><?php echo Util::dispLang(Language::WORD_00303);/*サービス購入履歴*/?></h2>
						</div>

<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/mypage/mypage_sv_purchase.php';?>

						<div class="htibrd clear_fix mgt20">
							<h2><?php echo Util::dispLang(Language::WORD_00306);/*その他の購入可能なサービス*/?></h2>
						</div>

<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/mypage/mypage_sv_purchase_oth.php';?>

					</section>
