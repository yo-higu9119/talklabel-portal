							<dl class="DetDlStock clear_fix bga">
								<dt><?php echo Util::dispLang(Language::WORD_00385);/*在庫*/?></dt>
								<dd><?php 
							if($productInfo->stock_type == 1){
								echo $productInfo->capacity-$productInfo->applicant;
							}else{
								echo "-";
							}
							?></dd>
							</dl>
