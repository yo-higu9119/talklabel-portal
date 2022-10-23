							<p class="DetStock"><?php echo Util::dispLang(Language::WORD_00385);/*在庫*/?>： <?php 
							if($productInfo->stock_type == 1){
								echo $productInfo->capacity-$productInfo->applicant;
							}else{
								echo "-";
							}
							?></p>
