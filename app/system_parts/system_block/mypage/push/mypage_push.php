					<section class="mypage">
						<div class="mypageInput clear_fix mgt30 mgb30">
<?php if($listCnt === 0){?>
							<p class="CautTxt Caution cnt mgt10 mgb10">通知はありません</p>
<?php }else{?>
						<ul class="pushList">
<?php	foreach($list as $info){?>
							<li>
								<div class="pushDate"><?php 
			$pushDate = $info->delivery_date;
			if($pushDate != NULL){
				echo $pushDate->year.'/'.$pushDate->month.'/'.$pushDate->day;
			}
									?></div>
								<div class="pushText">
									<div class="pushTtl"><?php echo $info->title;?></div>
									<div class="pushBody"><?php echo $info->body;?></div>
								</div>
								<?php 
			$linkUrl = $info->link_url;
			if($linkUrl != NULL){
				$target = '';
				if($_SERVER["HTTP_HOST"] != parse_url($linkUrl, PHP_URL_HOST)){
					$target = ' target="_blank"';
				}
									?><a href=<?php echo '"'.$linkUrl.'"'.$target;?>></a><?php
								}?>
							</li>
<?php 	}?>
						</ul>
<?php }?>
						<div class="PageNum">
<?php
HtmlParts::printPageSelectGetParam(HtmlParts::getMyPage(), $pageNo, $pageMax);
?>
						</div>

						</div>
					</section>
