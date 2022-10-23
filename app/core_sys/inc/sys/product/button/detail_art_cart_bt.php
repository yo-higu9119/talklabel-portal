								<div class="BtM prdOrdBt">
									<button type="button" class="productOrdBt next" onclick="setProductCart(<?php echo $productInfo->id; ?>, 0, $('input[name=cart_item]').val());location.href='../../order/product/cart.php?si=<?php echo $productInfo->id?>'" /><?php echo Util::dispLang(Language::WORD_00397);/*カートへ入れる*/?></button>
								</div>
