				<div class="comBox">
					<h2 class="sys_ti"><?php echo Util::dispLang(Language::WORD_00116);/* 会員登録が完了いたしました */?></h2>
					<div class="comBoxInn InputForm">
						<section class="CautTxtW">
							<p class="cnt"><?php echo Util::dispLang(Language::WORD_00117);/* あなたの会員番号は下記になります。 */?><br /><span class="txtSize140">｢<?php echo sprintf("%07d",$session->getMemberId()); ?>｣</span></p>
						</section>

						<div class="BtM mglra clear_fix">
							<p><button type="button" class="whBT mgt30 mgb30 mglra btWtN next" onclick="location.href='../../'" /><?php echo Util::dispLang(Language::WORD_00299);/* トップページへ進む */?></button></p>
						</div>
					</div>
				</div>
