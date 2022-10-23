<?php
$addressData = new DeliveryAddressData('');
$productPackageData = new ProductPackageData('');
$memberData = new MemberData('');
$memberData->setBaseNo(1);

$sErr = '';

if(isset($_GET['pn'])) {
	$pn = intval($_GET['pn']);
} elseif(isset($_POST['pn'])) {
	$pn = intval($_POST['pn']);
} else {
	$pn = 0;
}


$packageInfo = $productPackageData->getInfo($pn,$session->getMemberId());
if($packageInfo->id > 0){
}else{
	header('HTTP/1.0 404 Not Found');
	exit();
}
?>
