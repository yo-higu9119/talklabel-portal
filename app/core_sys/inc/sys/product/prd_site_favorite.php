<?php
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();
if($systemInfo->common_id == 0 && $productInfo->favorite_disp){
?>
					<section class="siteFavoriteBox clear_fix">
						<div class="siteFavoriteInn">
<?php
	if(!$session->isLogin()){
?>
<!================= IS_SMART_PHONE =================>
<?php if (IS_SMART_PHONE) { ?>
							<p class="siteFavorite"><span><?php echo Util::dispLang(Language::WORD_00693);/* お気に入り */?></span></p>
<?php } else { ?>
							<p class="siteFavorite"><span><?php echo Util::dispLang(Language::WORD_00644);/* お気に入りをする */?></span></p>
<?php } ?>
<!================= IS_SMART_PHONE =================>
<?php
	}else{
		require_once dirname(__FILE__).'/../../../../../common/inc/data/product_comment_data.php';
		$favoriteData = new ProductFavoriteData($session->getMemberName());
		if($favoriteData->getIsCount($productInfo->id,$session->getMemberId()) > 0){
			$empathyClass = ' class="PrdFavorite'.$productInfo->id.' crt"';
		}else{
			$empathyClass = ' class="PrdFavorite'.$productInfo->id.'"';
		}
?>
<!================= IS_SMART_PHONE =================>
<?php if (IS_SMART_PHONE) { ?>
							<p class="siteFavorite"><a href="javascript:void(0);"<?php echo $empathyClass?> onclick="product_favorite_submit(<?php echo $productInfo->id?>)"><?php echo Util::dispLang(Language::WORD_00693);/* お気に入り */?></a></p>
<?php } else { ?>
							<p class="siteFavorite"><a href="javascript:void(0);"<?php echo $empathyClass?> onclick="product_favorite_submit(<?php echo $productInfo->id?>)"><?php echo Util::dispLang(Language::WORD_00644);/* お気に入りをする */?></a></p>
<?php } ?>
<!================= IS_SMART_PHONE =================>
<?php
	}
?>
						</div>
					</section>
<?php
}
?>
