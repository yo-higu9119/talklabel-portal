			<div class="cart_Box clear_fix">
<?php
if($sErr == ""){
?>
				<div class="PrdCartList comBox">
					<h2 class="sys_ti">購入商品を選択してください</h2>

					<div class="SearchArea clear_fix">
						<div class="SearchBox clear_fix">
							<p class="SearchForm"><input type="text" name="ser_name" size="10" value="" maxlength="300" class="txt size250"  placeholder="商品名"   /></p>
							<p class="SearchForm"><input type="text" name="ser_pro_num" size="10" value="" maxlength="300" class="txt size250"  placeholder="商品型番"   /></p>
							<p class="SearchBT"><a href="javascript:void(0)" onclick="$('#page').val(0);get_product_list();return false;">検索</a></p>
							<p class="SearchBT"><a href="javascript:void(0)" class="clear_btn" onclick="pro_ser_clear();get_product_list();return false;" >条件クリア</a></p>
						</div>
					</div>
<?php
echo HtmlPartsProduct::printCartCate($session, 1, 0);
?>
					<div class="cardAjx" style="text-align:center;display:none;" id="loading_productList">
							<p><img src="../../core_sys/common/images/sys/ajax-loader.gif"></p><p>Loading...</p>
					</div>

					<div id="productList">
					</div>
				</div>
				<div class="PrdCartInt comBox">
<?php if (IS_SMART_PHONE) { ?>
					<div class="cartOpenBt"><button type="button" onclick="cart_contlol()">カート</button></div>
<?php } else { ?>
<?php } ?>
					<div class="cardAjx" style="text-align:center;display:none;" id="loading_carttList">
							<p><img src="../../core_sys/common/images/sys/ajax-loader.gif"></p><p>Loading...</p>
					</div>

					<div id="cartList">
					</div>
				</div>
<?php
}else{
?>
				<div class="comBox">
					<section class="CautTxt mgt20 mgb20 cnt">
						<p><?php echo $sErr; ?></p>
					</section>
					<div class="BtM mglra clear_fix">
						<p><button type="button" class="whBT mglra mgt20 mgb10 btWtW back" onclick="location.href='../../product/main/list.php'">買い物を続ける</button></p>
					</div>
				</div>
<?php
}
?>
			</div>
