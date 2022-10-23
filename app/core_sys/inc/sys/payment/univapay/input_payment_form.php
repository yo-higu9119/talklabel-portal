									<section class="InputForm" id="newCardInput">
										<dl class="clear_fix">
											<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00237);/*カード番号*/?><span class="IcoBox NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
											<dd>
												<p><input type="tel" name="crd_num" size="10" value="" maxlength="16" class="txt size400 crd_num"  placeholder="<?php echo Util::dispLang(Language::WORD_00238);/*ハイフン無し数字で入力してください*/?>" pattern="([0-9]| )*" required /><span style="top:20px;margin:10px;" id="card_img"></span></p>
												<hr class="hiddenborder" style="transform: scaleX(0);">
											</dd>
										</dl>
										<dl class="clear_fix">
											<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00239);/*カード名義人*/?><span class="IcoBox NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
											<dd>
												<p><input type="text" inputtype="email" name="crd_name" size="10" value="" maxlength="100" class="txt size400 crd_name" style="text-transform: uppercase;"  placeholder="<?php echo Util::dispLang(Language::WORD_00240);/*ローマ字で入力してください*/?>"  required /></p>
												<hr class="hiddenborder" style="transform: scaleX(0);">
											</dd>
										</dl>
										<dl class="clear_fix">
											<dt><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00241);/*有効期限*/?><span class="IcoBox NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
											<dd>
												<p><input type="tel" name="crd_m" size="10" value="" maxlength="2" class="txt size80 crd_m" placeholder="<?php echo Util::dispLang(Language::WORD_00242);/*月*/?>"  required />　/　<input type="tel" name="crd_y" size="10" value="" maxlength="2" class="txt size80 crd_y" placeholder="<?php echo Util::dispLang(Language::WORD_00243);/*年*/?>" required /></p>
												<hr class="hiddenborder" style="transform: scaleX(0);">
											</dd>
										</dl>
										<dl class="clear_fix">
											<dt class="clear_fix"><p class="LayoutL"><?php echo Util::dispLang(Language::WORD_00244);/*セキュリティコード*/?><span class="IcoBox NewIcBg BgPnc"><?php echo Util::dispLang(Language::WORD_00058);/*必須*/?></span></p></dt>
											<dd>
												<p><input type="tel" name="crd_sec" size="10" value="" maxlength="100" class="txt size300 crd_sec"  placeholder="<?php echo Util::dispLang(Language::WORD_00245);/*セキュリティコードを入力してください*/?>"  required /></p>
												<hr class="hiddenborder" style="transform: scaleX(0);">
											</dd>
										</dl>
									</section>
