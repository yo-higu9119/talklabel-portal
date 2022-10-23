<?php
		if($info->comment_is_accept == 1){
			if(!$session->isLogin()){
				require dirname(__FILE__).'/./board_mem.php';
			}
?>
					<section class="commentBox clear_fix">
						<div class="cardAjx" style="text-align:center;display:none;" id="loading">
							<p><img src="../../core_sys/common/images/sys/ajax-loader.gif"></p><p>Loading...</p>
						</div>
					</section>
<?php
		}
?>
