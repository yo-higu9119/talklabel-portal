<?php
	if($productInfo->comment_setting == 1){
?>
					<section class="commentBox clear_fix">
						<p class="commentTtitle"><a id="commentTop" name="commentTop"><?php echo Util::dispLang(Language::WORD_00651);/* この商品へのレビュー */?></a></p>
<?php
		if($productInfo->comment_is_accept == 1){
			if(!$session->isLogin()){
				require dirname(__FILE__).'/./comment_mem.php';
			}else{
				if($productInfo->comment_is_accept == 1 && $session->getMemberVeto() == 0){
					require dirname(__FILE__).'/./comment_input.php';
				}
			}
?>
						<div class="cardAjx" style="text-align:center;display:none;" id="loading">
							<p><img src="../../core_sys/common/images/sys/ajax-loader.gif" /></p><p>Loading...</p>
						</div>
<?php
		}
?>
					</section>
<?php
	}
?>
