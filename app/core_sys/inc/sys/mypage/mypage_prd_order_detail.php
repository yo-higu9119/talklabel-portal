				<div class="TableBox">
					<h2 class="systemFotmTitle"><?php echo Util::dispLang(Language::WORD_00460);/*注文情報*/?></h2>

					<table class="PrdDetTableT">
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00438);/*購入日時*/?></th>
							<td class="lft"><?php echo $packageInfo->regist_timestamp->toString(); ?></td>
						</tr>
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00435);/*請求番号*/?></th>
							<td class="lft"><?php echo sprintf("%08d",$packageInfo->id); ?></td>
						</tr>
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00264);/*支払い方法*/?></th>
							<td class="lft"><?php
if($packageInfo->payment_type == 1){
$sale_type = Util::dispLang(Language::WORD_00337);/* 銀行振込*/
}else if($packageInfo->payment_type == 2){
$sale_type = Util::dispLang(Language::WORD_00338);/* クレジットカード*/
if($packageInfo->credit_type == 1){
	$sale_type .= '(PAY.JP)';
}else if($packageInfo->credit_type == 2){
	$sale_type .= '(STRIPE)';
}else if($packageInfo->credit_type == 3){
	$sale_type .= '(ROBOT PAYMENT)';
}else if($packageInfo->credit_type == 4){
	$sale_type .= '(ZEUS)';
}else{
	$sale_type .= Util::dispLang(Language::WORD_00462);/* (その他)*/
}
}else if($packageInfo->payment_type == 3){
$sale_type = Util::dispLang(Language::WORD_00461);/* 代金引換*/
}else{
$sale_type = Util::dispLang(Language::WORD_00463);/* 決済無し*/
}
echo $sale_type;
							?></td>
						</tr>
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00437);/*請求金額*/?></th>
							<td class="TableBGTotal lft"><?php echo number_format($packageInfo->total_amount); ?><?php echo Util::dispLang(Language::WORD_00339);/*円*/?></td>
						</tr>
					</table>

					<h2 class="systemFotmTitle"><?php echo Util::dispLang(Language::WORD_00464);/*注文商品*/?></h2>
<?php
$packageInfo->set_cart_list();
$applicantListID = array_keys($packageInfo->puroduct_applicant_list);
$puroductListID = array_values($packageInfo->puroduct_applicant_list);

$applicantData = new ProductApplicantData('');
$searchInfoList = array();
$searchInfoList['search_id'] = $applicantListID;
$applicantList = $applicantData->getInfoList($searchInfoList, 1);

$productData = new ProductData('');
$searchInfoList = array();
$searchInfoList['search_id'] = $puroductListID;
$productList = $productData->getInfoList($searchInfoList, 1);
?>
					<table class="PrdDetTable ScrTable mgt10">
						<tr>
						<th class="cnt"><?php echo Util::dispLang(Language::WORD_00394);/*商品名*/?></th>
						<th class="cnt size100 nowrap"><?php echo Util::dispLang(Language::WORD_00467);/*単価*/?></th>
						<th class="cnt size80 nowrap"><?php echo Util::dispLang(Language::WORD_00396);/*個数*/?></th>
						<th class="cnt size150 nowrap"><?php echo Util::dispLang(Language::WORD_00468);/*小計*/?></th>
						</tr>
<?php
	$proTotalAmmount = 0;
	foreach($packageInfo->puroduct_list as $key => $val) {
		$proInfo = $productList[$key];
		$no = sprintf("%05d",$proInfo->id);
		$pro_num = htmlspecialchars($proInfo->pro_num);
		$name = htmlspecialchars($proInfo->name);
		$num = intval($val);
		$amount_num = 0;
		foreach($applicantList as $applicantInfo) {
			if($applicantInfo->productId == $proInfo->id){
				$amount_num += $applicantInfo->permissionDiscountAmount;
			}
		}
		$amount = $amount_num / $num;
		$proTotalAmmount += $amount_num;
?>
						<tr>
						<td class="lft">
							<p class="prdDetNo"><span><?php echo $no; ?></span> <span><?php echo $pro_num; ?></span></p>
							<p class="prdDetName"><?php echo $name; ?></p>
						</td>
						<td class="rgt TableBgTanka nowrap"><p><?php echo $amount; ?><?php echo Util::dispLang(Language::WORD_00339);/*円*/?></p></td>
						<td class="rgt TableBgQuantity nowrap"><p><?php echo $num; ?><?php echo Util::dispLang(Language::WORD_00400);/*個*/?></p></td>
						<td class="rgt TableBgSubtotal"><p><?php echo $amount_num; ?><?php echo Util::dispLang(Language::WORD_00339);/*円*/?></p></td>
						</tr>
<?php
	}
?>

						<tr>
						<td colspan="3" class="TableBgProducttotal nowrap rgt"><?php echo Util::dispLang(Language::WORD_00469);/*商品合計*/?></td>
						<td class="TableBgProducttotal rgt"><span class="ProducttotalPay"><?php echo number_format($proTotalAmmount); ?></span> <?php echo Util::dispLang(Language::WORD_00339);/*円*/?></td>
						</tr>
						<tr>
						<td colspan="3" class="TableBgPostage nowrap rgt"><?php echo Util::dispLang(Language::WORD_00470);/*送料*/?></td>
						<td class="TableBgPostage rgt"><span class="PostagePay"><?php echo number_format($packageInfo->shipping_amount); ?></span> <?php echo Util::dispLang(Language::WORD_00339);/*円*/?></td>
						</tr>
						<tr>
						<td colspan="3" class="TableBGTotal nowrap rgt"><?php echo Util::dispLang(Language::WORD_00471);/*合計金額（税込）*/?></td>
						<td class="TableBGTotal rgt"><span class="TotalPay"><?php echo number_format($packageInfo->total_amount); ?></span> <?php echo Util::dispLang(Language::WORD_00339);/*円*/?></td>
						</tr>
<?php
	if($packageInfo->adjust_amount !== 0){
?>
						<tr>
						<td colspan="3" class="TableBGAdjustment nowrap rgt"><?php echo Util::dispLang(Language::WORD_00472);/*調整金額*/?></td>
						<td class="TableBGAdjustment rgt"><span class="AdjustmentPay"><?php echo number_format($packageInfo->adjust_amount); ?></span> <?php echo Util::dispLang(Language::WORD_00339);/*円*/?></td>
						</tr>
<?php
	}
?>
						<tr>
						<td colspan="3" class="TableBGTax nowrap rgt"><?php echo Util::dispLang(Language::WORD_00473);/*軽減税率（8％）*/?></td>
						<td class="TableBGTax rgt">(<span class="TaxPay"><?php echo number_format($packageInfo->tax1); ?></span> <?php echo Util::dispLang(Language::WORD_00339);/*円*/?>)</td>
						</tr>
						<tr>
						<td colspan="3" class="TableBGTax nowrap rgt"><?php echo Util::dispLang(Language::WORD_00474);/*標準税率（10％）*/?></td>
						<td class="TableBGTax rgt">(<span class="TaxPay"><?php echo number_format($packageInfo->tax2); ?></span> <?php echo Util::dispLang(Language::WORD_00339);/*円*/?>)</td>
						</tr>
					</table>

					<table class="mgt10">
						<tr>
						<th class="lft"><?php echo Util::dispLang(Language::WORD_00475);/*注文に対する要望*/?></th>
						</tr>
						<tr>
						<td class="lft"><?php echo (trim($packageInfo->remarks) == "")?'-':str_replace("\r\n","<br />",htmlspecialchars($packageInfo->remarks)); ?></td>
						</tr>
					</table>
<?php
	$addressInfo = $addressData->getInfo($packageInfo->delivery_address_id);
	$area_array = Master::getPrefectureList();
?>
					<h2 class="systemFotmTitle"><?php echo Util::dispLang(Language::WORD_00405);/*配送先情報*/?></h2>

					<table class="PrdDetTableT">
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00420);/*氏名*/?></th>
							<td class="lft"><?php echo htmlspecialchars($addressInfo->name); ?></td>
						</tr>
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00421);/*電話番号*/?></th>
							<td class="lft"><?php echo htmlspecialchars($addressInfo->tel); ?></td>
						</tr>
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00432);/*郵便番号*/?></th>
							<td class="lft"><?php echo htmlspecialchars($addressInfo->zip); ?></td>
						</tr>
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00422);/*住所*/?></th>
							<td class="lft"><?php echo htmlspecialchars($area_array[$addressInfo->area].$addressInfo->add1.$addressInfo->add2); ?></td>
						</tr>
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00423);/*会社名（オプション）*/?></th>
							<td class="lft"><?php echo ($addressInfo->company !== "")?htmlspecialchars($addressInfo->company):'-'; ?></td>
						</tr>
					</table>

<?php
	if($packageInfo->status == 1){
		$status = '<span class="IcoBox MdIcBg BgBlu nowrap">'.Util::dispLang(Language::WORD_00476).'</span>';/*対応中*/
	}else if($packageInfo->status == 2){
		$status = '<span class="IcoBox MdIcBg BgBlu nowrap">'.Util::dispLang(Language::WORD_00477).'</span>';/*対応済*/
	}else{
		$status = '<span class="IcoBox MdIcBg BgPnc nowrap">'.Util::dispLang(Language::WORD_00478).'</span>';/*未対応*/
	}
	if($packageInfo->shipping_status == 1){
		$shipping_status = '<span class="IcoBox MdIcBg BgOyl nowrap">'.Util::dispLang(Language::WORD_00479).'</span>';/*配送済*/
	}else if($packageInfo->shipping_status == 2){
		$shipping_status = '<span class="IcoBox MdIcBg BgBlu nowrap">'.Util::dispLang(Language::WORD_00480).'</span>';/*配送完了*/
	}else{
		$shipping_status = '<span class="IcoBox MdIcBg BgRed nowrap">'.Util::dispLang(Language::WORD_00481).'</span>';/*未配送*/
	}
?>
					<table class="PrdDetTableT">
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00439);/*対応状況*/?></th>
							<td class="lft">
								<p><?php echo $status; ?></p>
							</td>
						</tr>
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00440);/*発送状況*/?></th>
							<td class="lft">
								<p><?php echo $shipping_status; ?></p>
							</td>
						</tr>
					</table>
				</div>
