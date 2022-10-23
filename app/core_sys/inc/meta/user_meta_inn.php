<link rel="manifest" href="<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/push/js/manifest.json<?php echo SYSTEM_ACCESS_DATETIME; ?>" />
<link rel="shortcut icon" href="<?php echo SYSTEM_TOP_URL; ?>ico/favicon.ico<?php echo SYSTEM_ACCESS_DATETIME; ?>">
<link rel="apple-touch-icon-precomposed" href="<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/push/images/apple-touch-icon.png<?php echo SYSTEM_ACCESS_DATETIME; ?>">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/css/jquery-ui.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/css/colorbox.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/css/slick.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/css/slick-theme.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/css/jquery.bxslider.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/css/jquery.mCustomScrollbar.min.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/css/sns/icon.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/css/sys_common.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/css/form_common.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/css/sns/icon.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/css/basic_parts.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>css/common/dez_parts.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">

<?php if (IS_SMART_PHONE) { ?>
<?php if($session->isNativeApp()){ ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0">
<?php }else{ ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<?php } ?>
<link href="<?php echo SYSTEM_TOP_URL; ?>css/common/sp_tmp_parts.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>css/users/sp_user_parts.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<?php } else { ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/common/width.php" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>css/common/tmp_parts.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>css/users/user_parts.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<?php } ?>

<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/common/sys_dez.php" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/common/dez.php" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/common/article.php" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/common/user.php" rel="stylesheet">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/js/jquery.bxslider.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/js/jquery.colorbox.util.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/js/accordion.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/js/jquery.inview.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/js/jquery.ui.datepicker-ja.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/js/slick.min.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/js/common.js<?php echo SYSTEM_ACCESS_DATETIME; ?>"></script>
<script type="text/javascript" src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_TOP_URL; ?>core_sys/common/js/jquery.cookie.js"></script>
<script src="//ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
