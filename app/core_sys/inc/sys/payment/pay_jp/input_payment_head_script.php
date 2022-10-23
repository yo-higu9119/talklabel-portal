<?php
$message = '';
if(isset($_POST['Token']) || (isset($_POST['cardfinger']) && $_POST['cardfinger'] !== "")){
	//POSTで戻る
	$hiddenStr = "";
	foreach ($_POST as $key => $value) {
		if($key != 'mode'){
			$hiddenStr .= FormUtil::hidden($key,$value);
		}
	}
	$tag = <<< EOM
<!DOCTYPE html>
<head>
<meta charset='utf-8'>
</head>
<html lang='ja'>
<body onload='document.returnForm.submit();'>
<form name='returnForm' method='post' action='{$next_url}'>
{$hiddenStr}
</form>
</body>
</html>
EOM;
	echo $tag;
	exit();

}else{
	//POSTで戻る
	$hiddenStr = "";
	foreach ($_POST as $key => $value) {
		if($key != 'mode' && $key != 'pay_type'){
			$hiddenStr .= FormUtil::hidden($key,$value);
		}
	}
}
?>