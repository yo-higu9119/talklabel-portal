				<section class="selectBt">
					<ul class="clear_fix">
						<li><input type="radio" name="settle_type" value="1" checked="checked" onclick="ch_type(false)" id="settle_type1" /><label class="tab_item" for="settle_type1"><?php echo Util::dispLang(Language::WORD_00260);/*銀行振込*/?></label></li>
						<li><input type="radio" name="settle_type" value="2" onclick="ch_type(false)" id="settle_type2" /><label class="tab_item" for="settle_type2"><?php echo Util::dispLang(Language::WORD_00751);/*クレジット*/?></label></li>
					</ul>
				</section>
