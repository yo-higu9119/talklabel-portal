	<section class="mypageOrdBoxInn">
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00705);/*申込中のサービス*/?></dt>
			<dd><?php echo $itemInfo->name; ?></dd>
		</dl>
		<dl>
			<dt><?php echo Util::dispLang(Language::WORD_00353);/*変更後サービス*/?></dt>
			<dd>
				<ul>
<?php
		$init = 0;
		foreach ($itemList as $key => $val){
			if($itemInfo->id == $key){
				continue;
			}
?>
					<li><label class="radio_text"><input type="radio" name="item" value="<?php echo $key; ?>"<?php echo ((isset($_POST['item']) && intval($_POST['item']) == $key) || $itemNId == $key || ($itemNId == 0 && $init == 0))?' checked="checked"':''; ?> onclick="ch_plan(false)" /><?php echo $val->name; ?></label></li>
<?php
			$init++;
		}
?>
				</ul>
			</dd>
		</dl>

	</section>
<?php
		foreach ($itemList as $key => $val){
			if($itemInfo->id == $key){
				continue;
			}
?>
	<div id="Plan_Block<?php echo $key; ?>">
		<section class="mypageOrdBoxInn">
			<dl>
				<dt><?php echo Util::dispLang(Language::WORD_00328);/*申込サービス*/?></dt>
				<dd><?php echo $val->name; ?></dd>
			</dl>
<?php
			if($val->type == 1){/* 1:都度 */
?>
			<dl>
				<dt><?php echo Util::dispLang(Language::WORD_00312);/*決済種別*/?></dt>
				<dd><?php echo Util::dispLang(Language::WORD_00313);/*都度決済*/?></dd>
			</dl>
			<dl>
				<dt><?php echo Util::dispLang(Language::WORD_00314);/*料金*/?></dt>
				<dd><?php echo number_format($val->money); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
			</dl>
<?php
			}else if($val->type == 2){/* 2:継続 */
?>
			<dl>
				<dt><?php echo Util::dispLang(Language::WORD_00312);/*決済種別*/?></dt>
				<dd><?php echo Util::dispLang(Language::WORD_00316);/*継続（毎月）決済*/?></dd>
			</dl>
<?php
				if($val->pay_timing == 2){
?>
			<dl>
				<dt><?php echo Util::dispLang(Language::WORD_00317);/*無料月数*/?></dt>
				<dd><?php echo $val->split; ?><?php echo Util::dispLang(Language::WORD_00318);/*ヶ月無料*/?></dd>
			</dl>
			<dl>
				<dt><?php echo Util::dispLang(Language::WORD_00319);/*手数料*/?></dt>
				<dd><?php echo number_format($val->init_money); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
			</dl>
<?php
				}
?>
			<dl>
				<dt><?php echo Util::dispLang(Language::WORD_00320);/*毎月料金*/?></dt>
				<dd><?php echo number_format($val->money); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
			</dl>
<?php
			}else{/* 3:分割 */
?>
			<dl>
				<dt><?php echo Util::dispLang(Language::WORD_00312);/*決済種別*/?></dt>
				<dd><?php echo Util::dispLang(Language::WORD_00321);/*分割決済*/?></dd>
			</dl>
			<dl>
				<dt><?php echo Util::dispLang(Language::WORD_00319);/*手数料*/?></dt>
				<dd><?php echo number_format($val->spl[0]); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
			</dl>
			<dl>
				<dt><?php echo Util::dispLang(Language::WORD_00322);/*合計料金*/?></dt>
				<dd><?php echo number_format(array_sum ($val->spl)); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
			</dl>
			<dl>
				<dt><?php echo Util::dispLang(Language::WORD_00323);/*分割回数*/?></dt>
				<dd><?php echo $val->split; ?><?php echo Util::dispLang(Language::WORD_00324);/*回*/?></dd>
			</dl>
<?php
			}
			if($val->remarks !== ""){
?>
			<dl>
				<dt><?php echo Util::dispLang(Language::WORD_00325);/*サービス説明*/?></dt>
				<dd><?php echo str_replace("\r\n","<br />",$val->remarks);?></dd>
			</dl>
<?php
			}
?>
		</section>
	</div>
<?php
		}
?>
