			<div class="step_flow ">
				<ul class="clear_fix">
					<li<?php echo ($mode == "input")?' class="crt"':''; ?>><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00104);/* 情報入力 */?></p><p class="flow_com"><?php echo Util::dispLang(Language::WORD_00105);/* 基本情報を入力してください */?></p></li>
					<li<?php echo ($mode == "check")?' class="crt"':''; ?>><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00106);/* 内容の確認 */?></p><p class="flow_com"><?php echo Util::dispLang(Language::WORD_00107);/* 内容の確認をしてください */?></p></li>
					<li<?php echo ($mode == "end")?' class="crt"':''; ?>><p class="flow_ti"><?php echo Util::dispLang(Language::WORD_00108);/* 登録完了 */?></p><p class="flow_com"><?php echo Util::dispLang(Language::WORD_00109);/* 申込みが完了しました */?></p></li>
				</ul>
			</div>
