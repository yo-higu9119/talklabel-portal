<?php
require_once dirname(__FILE__).'/../../../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../../../../common/inc/data/product.php';
require_once dirname(__FILE__).'/../../../../../common/inc/data/tax_master.php';
require_once dirname(__FILE__).'/../../../../../common/inc/data/product_system_info.php';
require_once dirname(__FILE__).'/../../../../../common/inc/data/product_category_group.php';

$ret = array();
$sErr = "";

function getTags($info,$cart_list,$optionList,$cart_op_list){
	$no = sprintf("%05d",$info->id);
	$pro_num = htmlspecialchars($info->pro_num);
	$name = htmlspecialchars($info->name);
	$num = $cart_list[$info->id];
	$amount = number_format($info->dispAmount);
	$amount = $info->dispAmount * $num;
	if($info->fileName === '') {
		$fileName = '';
	} else {
		$fileName = '<img src="'.htmlspecialchars('../../core_sys/sys/file/get_product_file.php?id='.$info->id.'&type=_s&f='.trim($info->fileName)).'" />';
	}
	$str = "";
	$option_tags = "";
	foreach ($info->option_list as $val){
		if(array_key_exists($val,$optionList) && $optionList[$val]->status == 0){
			$op_name = $optionList[$val]->name;
			$op_amount = number_format($optionList[$val]->amount);
			if(array_key_exists($info->id,$cart_op_list)){
				if(array_key_exists($optionList[$val]->id,$cart_op_list[$info->id])){
					$op_num = $cart_op_list[$info->id][$optionList[$val]->id];
				}else{
					$op_num = 0;
				}
			}else{
				$op_num = 0;
			}
			//{$op_amount}
			$option_tags .= <<<"__LONG_STRRING__"
						<div class="PrdNumOpBox clear_fix">
							<div class="PrdNumOpBoxInn clear_fix">
								<p class="PrdNumOpTi">{$op_name}：{$op_amount}円</p>
								<p class="PrdNum"><input type="text" name="cart_item{$info->id}_{$optionList[$val]->id}" size="10" value="{$op_num}" maxlength="50" class="txt size50 rgt" placeholder="-"></p>
								<p class="PrdNumTxt">個</p>
								<p class="PrdNumCtrBt BtM"><button type="button" onclick="setProductCartNumOp(-1,{$info->id},{$optionList[$val]->id})" class="whBT">-1</button></p>
								<p class="PrdNumCtrBt BtM"><button type="button" onclick="setProductCartNumOp(1,{$info->id},{$optionList[$val]->id})" class="whBT">+1</button></p>
								<p class="PrdNumUpdBt BtM"><a href="javascript:void(0);" onclick="setProductCartOp({$info->id},{$optionList[$val]->id},$('input[name=cart_item{$info->id}_{$optionList[$val]->id}]').val());" class="prdCartUpdBt">更新</a></p>
							</div>
						</div>

__LONG_STRRING__;
		}
	}
	$str .= <<<"__LONG_STRRING__"

					<section class="PrdCartSBox">
						<div class="PrdCartSBoxInn clear_fix">
							<div class="PrdCartSPh PCIDBlock">
								<p class="PrdCartSPhDet">{$fileName}</p>
							</div>
							<div class="PrdCartSDet PCIDBlock">
								<div class="PrdCartSDetInn">
									<p class="PrdCrtSNo">{$pro_num}</p>
									<p class="PrdCrtSName">{$name}</p>
								</div>
								<div class="PrdCartSAmt">
									<p class="PrdCrtSPay"><span class="kingakuTxt">{$amount}</span>円</p>
									<p class="PrdCrtSpayS">({$info->dispAmount}円)</p>
								</div>
							</div>
						</div>
						<div class="PrdNumBox clear_fix">
							<div class="PrdNumBoxInn clear_fix">
								<p class="PrdNum"><input type="text" name="cart_item{$info->id}" size="10" value="{$num}" maxlength="50" class="txt size50 rgt"  placeholder="-"   /></p>
								<p class="PrdNumTxt">個</p>
								<p class="PrdNumCtrBt BtM"><button type="button" onclick="setProductCartNum(-1,{$info->id})" class="whBT">-1</button></p>
								<p class="PrdNumCtrBt BtM"><button type="button" onclick="setProductCartNum(1,{$info->id})" class="whBT">+1</button></p>
								<p class="PrdNumUpdBt BtM"><a href="javascript:void(0);" onclick="setProductCart({$info->id},0,$('input[name=cart_item{$info->id}]').val(),0);" class="prdCartUpdBt">更新</a></p>
								<p class="PrdNumUpdBt BtM"><a href="javascript:void(0);" onclick="setProductCart({$info->id},1,'',0);" class="prdCartDelBt">削除</a></p>
							</div>
						</div>
{$option_tags}
					</section>

__LONG_STRRING__;

	return $str;
}

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	//if($session->isLogin()){
		$json = file_get_contents("php://input");
		$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'); 
		$data = json_decode($json,true);
		if($data === NULL){
			$ret["status"] = "error";
		}else{
			if(!isset($data['member_id']) && trim($data['member_id']) == "" && !is_numeric($data['member_id'])){
				$sErr = "parameter error";
			}
			if(!isset($data['group_id']) && trim($data['group_id']) == "" && !is_numeric($data['group_id'])){
				$sErr = "parameter error";
			}
			if(!isset($data['product_id']) && trim($data['product_id']) == "" && !is_numeric($data['product_id'])){
				$sErr = "parameter error";
			}
			if(!isset($data['option_id']) && trim($data['option_id']) == "" && !is_numeric($data['option_id'])){
				$sErr = "parameter error";
			}
			if(!isset($data['num']) && trim($data['num']) == "" && !is_numeric($data['num'])){
				$sErr = "parameter error";
			}
			if($sErr == ""){
				$productData = new ProductData($session->getMemberName());
				$sort = 1;
				$product_id = intval($data['product_id']);
				$group_id = intval($data['group_id']);
				$option_id = intval($data['option_id']);
				
				$productSystemData = new ProductSystemData($session->getMemberName());
				$productSystemInfo = $productSystemData->getInfo();
				$categoryGroupData = new ProductCategoryGroupData($session->getMemberName());
				$categoryGroupInfo = $categoryGroupData->getInfo($group_id);
				
				/*** session ***/
				$cart_name = 'app_cart';
				$cart_name_op = $cart_name.'_pro_op';
				$cart_name_caop = $cart_name.'_op';
				$tmp_num = intval($data['num']);
				
				if($product_id > 0 && $option_id > 0){
					if(isset($_SESSION[$cart_name]) && is_array($_SESSION[$cart_name]) && count($_SESSION[$cart_name]) > 0){
						if(array_key_exists($product_id,$_SESSION[$cart_name])){
							if($_SESSION[$cart_name][$product_id] < $tmp_num){
								$tmp_num = $_SESSION[$cart_name][$product_id];
							}
						}else{
							$tmp_num = 0;
						}
					}else{
						$tmp_num = 0;
					}
					
					/* cart product option */
					if(isset($_SESSION[$cart_name_op]) && is_array($_SESSION[$cart_name_op]) && count($_SESSION[$cart_name_op]) > 0){
						if(array_key_exists($product_id,$_SESSION[$cart_name_op])){
							if(array_key_exists($option_id,$_SESSION[$cart_name_op][$product_id])){
								$_SESSION[$cart_name_op][$product_id][$option_id] = $tmp_num;
							}else{
								$_SESSION[$cart_name_op][$product_id][$option_id] = $tmp_num;
							}
						}else{
							$_SESSION[$cart_name_op][$product_id] = array();
							$_SESSION[$cart_name_op][$product_id][$option_id] = $tmp_num;
						}
					}else{
						$_SESSION[$cart_name_op] = array();
						$_SESSION[$cart_name_op][$product_id] = array();
						$_SESSION[$cart_name_op][$product_id][$option_id] = $tmp_num;
					}
				}
				/*** session ***/
				$cart_list = isset($_SESSION[$cart_name])?$_SESSION[$cart_name]:array();
				$cart_op_list = isset($_SESSION[$cart_name_op])?$_SESSION[$cart_name_op]:array();
				$cart_caop_list = isset($_SESSION[$cart_name_caop])?$_SESSION[$cart_name_caop]:array();
				if(count($cart_list) <= 0){
					unset($_SESSION[$cart_name]);
					unset($_SESSION[$cart_name_op]);
					unset($_SESSION[$cart_name_caop]);
				}
				
				$searchInfoList = array();
				if(count($cart_list) > 0){
					$searchInfoList['search_id'] = array_keys($cart_list);
				}else{
					$searchInfoList['search_id'] = 0;
				}
				$list = $productData->getInfoList($searchInfoList, $sort);
				
				if(count($list) !== 0){
					$ret["tags"] = "";
					/*** cart list ***/
					$amount = 0;/* 合計金額 */
					$tax1 = 0;/* 税金用合計金額 */
					$tax2 = 0;/* 税金用合計金額 */
					$post = false;/* 宅配 */
					$mail = false;/* メール便 */
					$delivery = false;/* デリバリー */

					$productOptionData = new ProductOptionData($session->getMemberName());
					$optionList = $productOptionData->getList();
					
					$productCartOptionData = new ProductCartOptionData($session->getMemberName());
					$cartOptionList = $productCartOptionData->getList();

					foreach($list as $info){
						$ret["tags"] .= getTags($info,$cart_list,$optionList,$cart_op_list);
						
						$amount += $info->dispAmount * $cart_list[$info->id];
						$op_tax = 0;
						foreach ($info->option_list as $op){
							if(array_key_exists($op,$optionList) && $optionList[$op]->status == 0){
								$op_amount = $optionList[$op]->amount;
								if(array_key_exists($info->id,$cart_op_list)){
									if(array_key_exists($optionList[$op]->id,$cart_op_list[$info->id])){
										$op_num = $cart_op_list[$info->id][$optionList[$op]->id];
									}else{
										$op_num = 0;
									}
								}else{
									$op_num = 0;
								}
								$op_amount = $op_amount * $op_num;
								$op_tax += $op_amount;
								$amount += $op_amount;
							}
						}
						if($info->tax_type == 1){
							$tax1 += $info->dispAmount * $cart_list[$info->id] + $op_tax;;
						}else{
							$tax2 += $info->dispAmount * $cart_list[$info->id] + $op_tax;;
						}
						if($info->TypeNo == 1){
							if($info->delivery_type == 1){/* 宅配 */
								$post = true;
								/* 配送方法処理は保留 */
							}else if($info->delivery_type == 2){/* メール便 */
								$mail = true;
							}else if($info->delivery_type == 3){/* デリバリー */
								$delivery = true;
							}
						}
					}
					/* カートオプション */
					foreach ($cartOptionList as $key => $val){
						if($val->status !== 0)continue;
						$cart_op_amount = number_format($val->amount);
						$cart_op_num = (array_key_exists($val->id,$cart_caop_list))?$cart_caop_list[$val->id]:0;
						$amount += $cart_op_amount * $cart_op_num;
					}
					/*** cart list ***/
					/*** cost ***/
					$amount_str = number_format($amount);
					
					/* 消費税 */
					$taxMasterData = new TaxMasterData($session->getMemberName());
					$taxInfo = $taxMasterData->getInfo();
					$tax1_str = number_format(round($tax1 * $taxInfo->tax1 / 100));
					$tax2_str = number_format(round($tax2 * $taxInfo->tax2 / 100));
					/* 消費税 */
					/* 各種手数料 */
					$post_str = 0;
					$mail_str = 0;
					$delivery_str = 0;
					if($post){
						//$post_str = $productSystemInfo->shipping;//宅配
					}
					if($mail){
						//$mail_str = $productSystemInfo->mail_service_shipping;//メール便
					}
					if($delivery){
						//$delivery_str = $productSystemInfo->delivery_shipping;//デリバリー
					}
					
					$free_limit = 0;
					if($productSystemInfo->free_shipping_setting == 1){
						$free_limit = $productSystemInfo->free_limit;
						if(($free_limit-$amount) < 0){
							$free_limit = 0;
						}else{
							$free_limit = $free_limit-$amount;
						}
						if($free_limit <= 0){
							$post_str = 0;//宅配
							$mail_str = 0;//メール便
							$delivery_str = 0;//デリバリー
						}
					}
					
					$total_amount = $amount+$post_str+$mail_str+$delivery_str;
					$total_amount_str = number_format($total_amount);

					
					$post_str = number_format($post_str);
					$mail_str = number_format($mail_str);
					$delivery_str = number_format($delivery_str);
					$free_limit_str = number_format($free_limit);
					
					/* 各種手数料 */
					
					if($free_limit > 0){
						$ret["tags"] .= <<<"__LONG_STRRING__"
											<div class="Art CautMg fewmoreArt cnt">あと{$free_limit_str}円購入で送料無料となります。</div>

__LONG_STRRING__;
					}

					$ret["tags"] .= <<<"__LONG_STRRING__"
					<section class="PrdCartTotalBox clear_fix">
						<table>

__LONG_STRRING__;
					$ret["tags"] .= <<<"__LONG_STRRING__"
							<tr>
								<td class="PrdCartTotalTiSd">合計金額</td>
								<td class="PrdCartTotalpay">{$total_amount_str} <span>円</span></td>
							</tr>
							<tr>
								<td class="PrdCartTotalTiS">内税 (定率減税8％)</td>
								<td class="PrdCartTotalSpay">{$tax1_str} 円</td>
							</tr>
							<tr>
								<td class="PrdCartTotalTiS">内税 (定率減税10％)</td>
								<td class="PrdCartTotalSpay">{$tax2_str} 円</td>
							</tr>

__LONG_STRRING__;
					foreach ($cartOptionList as $key => $val){
						if($val->status !== 0)continue;
						$cart_op_name = $val->name;
						$cart_op_amount = number_format($val->amount);
						$cart_op_num = (array_key_exists($val->id,$cart_caop_list))?$cart_caop_list[$val->id]:0;
						$ret["tags"] .= <<<"__LONG_STRRING__"
							<tr class="PrdCartTotalBrdNo">
								<td class="PrdCartTotalTiS">{$cart_op_name}</td>
								<td class="PrdCartTotalSpay">
									<div class="PrdCartOpArea">
										<p class="PrdCartOpPay">{$cart_op_amount}円</p>
								</td>
							</tr>
							<tr>
								<td class="PrdCartTotalSpayNo" colspan="2">
									<div class="PrdCartOpArea">
										<div class="PrdCartOpCrt clear_fix">
											<p class="PrdCartOpNum"><input type="text" name="cart_op{$val->id}" size="10" value="{$cart_op_num}" maxlength="50" class="txt size50 rgt" placeholder="-"> 個</p>
											<p class="PrdCartOpBt"><button type="button" onclick="setProductCartNumCaop(-1,{$val->id})" class="whBT">-1</button></p>
											<p class="PrdCartOpBt"><button type="button" onclick="setProductCartNumCaop(1,{$val->id})" class="whBT">+1</button></p>
											<p class="PrdNumUpdBt BtM"><a href="javascript:void(0);" onclick="setProductCartCaop({$val->id},$('input[name=cart_op{$val->id}]').val());" class="prdCartUpdBt">更新</a></p>
										</div>
									</div>
								</td>
							</tr>

__LONG_STRRING__;
					}
					if($post){
						$ret["tags"] .= <<<"__LONG_STRRING__"
							<tr class="PrdCartDelv">
								<td class="PrdCartTotalTiSd">送料（宅配便）</td>
								<td class="PrdCartTotalpayS">{$post_str} 円</td>
							</tr>

__LONG_STRRING__;
					}
					if($mail){
						$ret["tags"] .= <<<"__LONG_STRRING__"
							<tr class="PrdCartDelv">
								<td class="PrdCartTotalTiSd">送料（メール便）</td>
								<td class="PrdCartTotalpayS">{$mail_str} 円</td>
							</tr>

__LONG_STRRING__;
					}
					if($delivery){
						$ret["tags"] .= <<<"__LONG_STRRING__"
							<tr class="PrdCartDelv">
								<td class="PrdCartTotalTiSd">送料（デリバリー）</td>
								<td class="PrdCartTotalpayS">{$delivery_str} 円</td>
							</tr>

__LONG_STRRING__;
					}
					$ret["tags"] .= <<<"__LONG_STRRING__"
						</table>
					</section>

					<section class="CautTxt CautMg cnt">
						<p>上記選択内容で問題ありませんか？<br />
						問題なければ「購入手続きへ進む」ボタンをクリックして進んでください。
						</p>
					</section>

					<div class="BtM clear_fix">
						<p><button type="button" class="productPurchaseBt next" onclick="location.href='./personal.php'">購入手続きへ進む</button></p>
					</div>

__LONG_STRRING__;
					/*** cost ***/
					$ret["status"] = "success";
				}else{
					$ret["tags"] = '<div class="Art CautMg nocartArt cnt">現在カートに商品はありません。<br>商品一覧から購入したい商品を<br />カートに入れてください。</div>';
					$ret["status"] = "none";
				}
				
			}else{
				$ret["status"] = "error";
			}
		}
	//}else{
	//	$ret["status"] = "error";
	//}
}else{
	$ret["status"] = "error";
}
echo json_encode($ret);
?>