<?php
require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';

$session = new Session();
$session->delete();
header('Location: ../login/');
?>