<?php
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();
//if($systemInfo->common_id == 0 && $productInfo->niceDisp){
if($productInfo->niceDisp && ($systemInfo->common_id == 0 || $systemInfo->common_id == 1 && $systemInfo->common_nice == 1)){
?>
					<section class="siteShareBox clear_fix">
						<div class="siteShareInn">
<?php
	if(!$session->isLogin()){
?>
<!================= IS_SMART_PHONE =================>
<?php if (IS_SMART_PHONE) { ?>
							<p class="siteShare"><span><?php echo Util::dispLang(Language::WORD_00487);/* いいね */?></span></p>
<?php } else { ?>
							<p class="siteShare"><span><?php echo Util::dispLang(Language::WORD_00066);/* いいねをする */?></span></p>
<?php } ?>
<!================= IS_SMART_PHONE =================>
							<p class="siteShareNo"><?php echo $productInfo->empathy_cnt?></p>
<?php
	}else{
		require_once dirname(__FILE__).'/../../../../../common/inc/data/product_comment_data.php';
		$respondData = new ProductRespondData($session->getMemberName());
		if($respondData->getIsCount($productInfo->id,$session->getMemberId()) > 0){
			$empathyClass = ' class="PrdShare'.$productInfo->id.' crt"';
		}else{
			$empathyClass = ' class="PrdShare'.$productInfo->id.'"';
		}
?>
<!================= IS_SMART_PHONE =================>
<?php if (IS_SMART_PHONE) { ?>
							<p class="siteShare"><a href="javascript:void(0);"<?php echo $empathyClass?> onclick="article_empathy_submit(<?php echo $productInfo->id?>)"><?php echo Util::dispLang(Language::WORD_00487);/* いいね */?></a></p>
<?php } else { ?>
							<p class="siteShare"><a href="javascript:void(0);"<?php echo $empathyClass?> onclick="article_empathy_submit(<?php echo $productInfo->id?>)"><?php echo Util::dispLang(Language::WORD_00066);/* いいねをする */?></a></p>
<?php } ?>
<!================= IS_SMART_PHONE =================>
<!--							<p class="siteShareNo PrdShareNam<?php echo $productInfo->id?>"><?php echo $productInfo->empathy_cnt?></p>-->
<?php
	}
?>
						</div>
					</section>
<?php
}
?>
