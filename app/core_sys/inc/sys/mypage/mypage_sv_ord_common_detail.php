<?php
			if($itemInfo->type == 1){/* 1:都度 */
?>
							<dl>
								<dt><?php echo Util::dispLang(Language::WORD_00312);/*決済種別*/?></dt>
								<dd><?php echo Util::dispLang(Language::WORD_00313);/*都度決済*/?></dd>
							</dl>
							<dl>
								<dt><?php echo Util::dispLang(Language::WORD_00314);/*料金*/?></dt>
								<dd><?php echo number_format($itemInfo->money); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
							</dl>
<?php
			}else if($itemInfo->type == 2){/* 2:継続 */
?>
							<dl>
								<dt><?php echo Util::dispLang(Language::WORD_00312);/*決済種別*/?></dt>
								<dd><?php echo Util::dispLang(Language::WORD_00316);/*継続（毎月）決済*/?></dd>
							</dl>
<?php
				if($itemInfo->pay_timing == 2){
?>
							<dl>
								<dt><?php echo Util::dispLang(Language::WORD_00317);/*無料月数*/?></dt>
								<dd><?php echo $itemInfo->split; ?><?php echo Util::dispLang(Language::WORD_00318);/*ヶ月無料*/?></dd>
							</dl>
							<dl>
								<dt><?php echo Util::dispLang(Language::WORD_00319);/*手数料*/?></dt>
								<dd><?php echo number_format($itemInfo->init_money); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
							</dl>
<?php
				}
?>
							<dl>
								<dt><?php echo Util::dispLang(Language::WORD_00320);/*毎月料金*/?></dt>
								<dd><?php echo number_format($itemInfo->money); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
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
								<dd><?php echo number_format($itemInfo->spl[0]); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
							</dl>
							<dl>
								<dt><?php echo Util::dispLang(Language::WORD_00322);/*合計料金*/?></dt>
								<dd><?php echo number_format(array_sum ($itemInfo->spl)); ?><?php echo Util::dispLang(Language::WORD_00315);/*円（税込）*/?></dd>
							</dl>
							<dl>
								<dt><?php echo Util::dispLang(Language::WORD_00323);/*分割回数*/?></dt>
								<dd><?php echo $itemInfo->split; ?><?php echo Util::dispLang(Language::WORD_00324);/*回*/?></dd>
							</dl>
<?php
			}
			if($itemInfo->remarks !== ""){
?>
							<dl>
								<dt><?php echo Util::dispLang(Language::WORD_00325);/*サービス説明*/?></dt>
								<dd><?php echo str_replace("\r\n","<br />",$itemInfo->remarks);?></dd>
							</dl>
<?php
			}
?>
