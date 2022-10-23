<?php
/* 外部連携 */
for($i=1;$i<=8;$i++){
	if(isset($_GET['ex'.$i]) && trim($_GET['ex'.$i]) !== ""){
		$_SESSION['out_ex'.$i] = trim($_GET['ex'.$i]);
	}
}
/* 外部連携 */
?>