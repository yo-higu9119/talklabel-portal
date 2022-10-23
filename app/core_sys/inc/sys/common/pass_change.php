<?php
$message = '';
if(isset($_GET['key']) && trim($_GET['key']) !== '') {
	//$session->checkReminderSession();

	$MemberId = substr( $_GET['key'], 32);

	//if(!$session->reminderLogin($session->getReminderSessenMemberId(), $_GET['key'])) {
	if(!$session->reminderLogin($MemberId, $_GET['key'])) {
		header('Location: '.SYSTEM_TOP_URL.'users/login/index.php');
		exit();
	}
} else if(isset($_POST['password'])) {
	$session->check();
	$password = $_POST['password'];

	$systemData = new SystemData('');
	$systemInfo = $systemData->getInfo();
	if($systemInfo->use_password_limit === 1){
		$flg = false;
		if(preg_match("/^[a-zA-Z0-9]+$/", $password) === 0) {
			$flg = true;
		}else{
			if(preg_match("/[\d]+/", $password) === 0) {
				$flg = true;
			}else if(preg_match("/[a-zA-Z]+/", $password) === 0) {
				$flg = true;
			}
		}
		if($flg){
			$message = '半角の数字+英字で入力して下さい';
		}
	}else if($systemInfo->use_password_limit === 2){
		$flg = false;
		if(preg_match("/^[a-zA-Z0-9]+$/", $password) === 0) {
			$flg = true;
		}else{
			if(preg_match("/[\d]+/", $password) === 0) {
				$flg = true;
			}else if(preg_match("/[a-z]+/", $password) === 0) {
				$flg = true;
			}else if(preg_match("/[A-Z]+/", $password) === 0) {
				$flg = true;
			}
		}
		if($flg){
			$message = '半角の数字+英字（小文字）+英字（大文字）で入力して下さい';
		}
	}else if($systemInfo->use_password_limit === 3){
		$flg = false;
		if(preg_match("/^[\da-zA-Z\$\-\.\+%&_#]+$/", $password) === 0) {
			$flg = true;
		}else{
			if(preg_match("/[\d]+/", $password) === 0) {
				$flg = true;
			}else if(preg_match("/[a-zA-Z]+/", $password) === 0) {
				$flg = true;
			}else if(preg_match("/[\$\-\.\+%&_#]+/", $password) === 0) {
				$flg = true;
			}
		}
		if($flg){
			$message = '半角の数字+英字+記号で入力して下さい';
		}
	}else if($systemInfo->use_password_limit === 4){
		$flg = false;
		if(preg_match("/^[\da-zA-Z\$\-\.\+%&_#]+$/", $password) === 0) {
			$flg = true;
		}else{
			if(preg_match("/[\d]+/", $password) === 0) {
				$flg = true;
			}else if(preg_match("/[a-z]+/", $password) === 0) {
				$flg = true;
			}else if(preg_match("/[A-Z]+/", $password) === 0) {
				$flg = true;
			}else if(preg_match("/[\$\-\.\+%&_#]+/", $password) === 0) {
				$flg = true;
			}
		}
		if($flg){
			$message = '半角の数字+英字（小文字）+英字（大文字）+記号で入力して下さい';
		}
	}else{
		if(preg_match("/^[a-zA-Z0-9]+$/", $password) === 0) {
			$message = '半角英数字で入力して下さい';
		}
	}
	if($message == ""){
		if(strlen($password) < 8 || strlen($password) > 16) {
			$message = '8文字以上、16文字以下で入力して下さい。';
		}
	}

	if($message == ""){
		if(isset($_SESSION['regist_check']) && isset($_POST['regist_check']) && $_SESSION['regist_check'] == $_POST['regist_check']){
			unset($_SESSION['regist_check']);
		}else{
			$message = '操作が不正です。';
		}
	}
	if($message === '') {
		require_once dirname(__FILE__).'/../../../../../common/inc/data/member_data.php';
		$memberData = new MemberData($session->getMemberName());
		if($memberData->updatePassword($session->getMemberId(), $_POST['password'])) {
			
			header('Location: ./pass_save.php');
			exit();
		} else {
			$message = 'DBアクセスに失敗しました。';
		}
	}
} else {
	header('Location: '.SYSTEM_TOP_URL.'users/login/index.php');
	exit();
}
$registCheckKey = Util::randomStr(64);
$_SESSION['regist_check'] = $registCheckKey;
?>
