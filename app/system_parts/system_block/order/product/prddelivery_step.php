<?php if (IS_SMART_PHONE) { ?>
			<div class="step_flow ">
				<ul class="clear_fix">
					<li><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00402);/* 選択 */?></p></li>
					<li><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00404);/* 購入者 */?></p></li>
					<li class="crt"><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00406);/* 配送先 */?></p></li>
<?php if($total_amount > 0){ ?>
					<li><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00408);/* 決済 */?></p></li>
<?php } ?>
					<li><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00410);/* 確認 */?></p></li>
					<li><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00412);/* 完了 */?></p></li>
				</ul>
			</div>
<?php } else { ?>
			<div class="step_flow ">
				<ul class="clear_fix">
					<li><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00401);/* 商品選択 */?></p><p class="flow_com"><?php echo Util::dispLang(Language::WORD_00413);/* 商品を選択してください */?></p></li>
					<li><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00403);/* 購入者情報 */?></p><p class="flow_com"><?php echo Util::dispLang(Language::WORD_00223);/* 必要事項を入力してください */?></p></li>
					<li class="crt"><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00405);/* 配送先情報 */?></p><p class="flow_com"><?php echo Util::dispLang(Language::WORD_00223);/* 必要事項を入力してください */?></p></li>
<?php if($total_amount > 0){ ?>
					<li><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00407);/* 決済情報 */?></p><p class="flow_com"><?php echo Util::dispLang(Language::WORD_00223);/* 必要事項を入力してください */?></p></li>
<?php } ?>
					<li><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00409);/* 最終確認 */?></p><p class="flow_com"><?php echo Util::dispLang(Language::WORD_00414);/* 購入内容を確認してください */?></p></li>
					<li><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00411);/* 購入完了 */?></p><p class="flow_com"><?php echo Util::dispLang(Language::WORD_00415);/* 購入完了しました */?></p></li>
				</ul>
			</div>
<?php } ?>
