<?php
if(isset($_POST['account'])) {
	if(isset($_POST['account']) && isset($_POST['password']) && strlen($_POST['account']) <= 250 && strlen($_POST['password']) <= 50) {
		$message = $session->login($_POST['account'], $_POST['password']);
		if($message === '') {
			if(array_key_exists('redirectURL', $_SESSION)){
				$redirectURL = $_SESSION['redirectURL'];
				$_SESSION['redirectURL'] = '';
				unset($_SESSION['redirectURL']);
				header('Location: '.$redirectURL);
				exit();
			}else if(isset($_SESSION['tmpSeminarOrderKey'])){
				header('Location: '.SYSTEM_TOP_URL.'seminar/order/index.php');
				exit();
			} else if(isset($_SESSION['tmpSeminarApplyIdList'])){
				header('Location: '.SYSTEM_TOP_URL.'seminar/order_cart/index.php');
				exit();
			} else {
				header('Location: '.SYSTEM_LOGIN_REDIRECT_URL);
				exit();
			}
		}
	}
} else {
	$message = $session->getErrorMsg();
}
if(isset($_COOKIE[Config::DB_NAME."_is_login"])){
	if(isset($_COOKIE[Config::DB_NAME."_id"])){
		$account = $_COOKIE[Config::DB_NAME."_id"];
	}else{
		$account = "";
	}
	if(isset($_COOKIE[Config::DB_NAME."_password"])){
		$password = $_COOKIE[Config::DB_NAME."_password"];
	}else{
		$password = "";
	}

	if($account !== "" && $password !== ""){
		$message = $session->login($account, $password );
		if($message === '') {
			if(isset($_SESSION['App']['redirectURL']) && trim($_SESSION['App']['redirectURL']) !== ""){
				$redirectURL = $_SESSION['App']['redirectURL'];
				$_SESSION['App']['redirectURL'] = '';
				unset($_SESSION['App']['redirectURL']);
				header('Location: '.$redirectURL);
				exit();
			}else{
				header('Location: '.SYSTEM_LOGIN_REDIRECT_URL);
				exit();
			}
		}
	}
}

?>
