<?php
if($session->isLogin() && isset($_GET['id']) && is_numeric($_GET['id']) //ID
) {
	$id = intval($_GET['id']);
} else {
	header('HTTP/1.0 404 Not Found');
	exit();
}
?>
