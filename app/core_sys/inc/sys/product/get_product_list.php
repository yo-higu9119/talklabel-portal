<?php
require_once dirname(__FILE__).'/../../../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../../../../common/inc/data/product.php';

$ret = array();
$sErr = "";

function getTags($info,$member_id){
	$no = sprintf("%05d",$info->id);
	$pro_num = htmlspecialchars($info->pro_num);
	$name = htmlspecialchars($info->name);
	$amount = number_format($info->dispAmount);
	if($info->fileName === '') {
		$fileName = '';
	} else {
		$fileName = '<img src="'.htmlspecialchars('../../core_sys/sys/file/get_product_file.php?id='.$info->id.'&type=_s&f='.trim($info->fileName)).'" />';
	}
	$str = "";
	$str .= <<<"__LONG_STRRING__"
							<div class="PrdCartBoxInn clear_fix">
								<div class="PrdCartPh PCIDBlock">
									<p class="PrdCartPhDet">{$fileName}</p>
								</div>
								<div class="PrdCartDet PCIDBlock clear_fix">
									<div class="PrdCartDetName">
										<p class="PrdCrtNo">{$pro_num}</p>
										<p class="PrdCrtName">{$name}</p>
									</div>
									<div class="PrdCartDetAmt">
										<p class="PrdCrtPay"><span class="kingakuTxt">{$amount}</span>円</p>
									</div>
									<div class="PrdCartBt PCIDBlock">
										<p class="PrdCrtEdBt BtM"><a href="../../product/main/index.php?s={$info->urlKey}" class="prdCartDetBt">確認</a></p>
										<p class="PrdCrtEdBt BtM"><a href="javascript:void(0);" class="prdCartOrdBt" onclick="setProductCart({$info->id},0,'',$('input[name=ajast_amount]').val());">カート</a></p>
									</div>
								</div>
							</div>

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
			if(!isset($data['disp_max']) && trim($data['disp_max']) == "" && !is_numeric($data['disp_max'])){
				$sErr = "parameter error";
			}
			if(!isset($data['page']) && trim($data['page']) == "" && !is_numeric($data['page'])){
				$sErr = "parameter error";
			}
			if(!isset($data['group_id']) && trim($data['group_id']) == "" && !is_numeric($data['group_id'])){
				$sErr = "parameter error";
			}
			if(!isset($data['page_disp_num']) && trim($data['page_disp_num']) == "" && !is_numeric($data['page_disp_num'])){
				$sErr = "parameter error";
			}
			if(!isset($data['category_id']) && trim($data['category_id']) == "" && !is_numeric($data['category_id'])){
				$sErr = "parameter error";
			}
			if($sErr == ""){
				$sort = 2;
				$member_id = intval($data['member_id']);
				$category_id = intval($data['category_id']);
				$page_disp_num = intval($data['page_disp_num']);
				$pageNo = intval($data['page']);
				$pageDispCntMax = intval($data['disp_max']);

				$productData = new ProductData($session->getMemberName());
				
				$searchInfoList = array();
				$searchInfoList['search_x_category_group_id'] = $data['group_id'];
				$searchInfoList['search_x_name_search'] = $data['ser_name'];
				$searchInfoList['search_x_pro_num_search'] = $data['ser_pro_num'];
				$searchInfoList['search_x_is_open'] = true;
				$searchInfoList['search_x_is_accept_open_cart'] = true;
				$searchInfoList['search_x_stok_exists'] = true;
				if($category_id > 0){
					if($category_id == 99999999){
						$searchInfoList['search_x_buy_member_id'] = $member_id;
					}else{
						$searchInfoList['search_x_category_id'] = $category_id;
					}
				}
				$totalCnt = $productData->getCount($searchInfoList);
				$list = $productData->getInfoList($searchInfoList, $sort, $pageDispCntMax*$pageNo, $pageDispCntMax);
				$listCnt = count($list);
				$pageMax = ceil($totalCnt/ $pageDispCntMax)-1;
				$listDispCntMin = $pageNo * $pageDispCntMax + 1;
				
				if(count($list) !== 0){
					$ret["tags"] = "";
					$ret["tags"] .= <<<"__LONG_STRRING__"
						<section class="PrdCartListBox clear_fix">

__LONG_STRRING__;
					/*** product list ***/
					$ret["tags"] .= <<<"__LONG_STRRING__"

__LONG_STRRING__;
					foreach($list as $info){
						$ret["tags"] .= getTags($info,intval($data['member_id']));
					}
					$ret["tags"] .= <<<"__LONG_STRRING__"

__LONG_STRRING__;
					/*** product list ***/
					$ret["tags"] .= <<<"__LONG_STRRING__"
						</section>

__LONG_STRRING__;
					/*** pager ***/
					$ret["tags"] .= HtmlParts::printPageSelectCartJs($pageNo, $pageMax, $page_disp_num);
					/*** pager ***/
					$ret["status"] = "success";
				}else{
					$ret["tags"] = '<div class="CautTxt CautMg cnt">商品が見つかりませんでした。</div>';
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