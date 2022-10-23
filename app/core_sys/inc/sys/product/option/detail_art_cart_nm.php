								<section class="PrdNumBox clear_fix">
									<div class="PrdNumBoxInn clear_fix">
										<p class="PrdNumTi"><?php echo Util::dispLang(Language::WORD_00396);/*個数*/?>：</p>
										<p class="PrdNum"><input type="text" name="cart_item" size="10" value="1" maxlength="250" class="txt size60 rgt"  placeholder="-" /></p>
										<p class="PrdNumTxt"><?php echo Util::dispLang(Language::WORD_00400);/*個*/?></p>
										<p class="PrdNumCtrBt BtM"><button type="button" onclick="setProductCartNum(-1)" class="whBT">-1</button></p>
										<p class="PrdNumCtrBt BtM"><button type="button" onclick="setProductCartNum(1)" class="whBT">+1</button></p>
									</div>
								</section>
