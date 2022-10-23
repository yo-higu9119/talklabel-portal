					<div class="drbtn">
						<span class="hambarg"></span>
						<span class="hambarg"></span>
						<span class="hambarg"></span>
						<span class="hambargMenu">MENU</span>
					</div>
					<div class="drawer">
<?php require dirname(__FILE__).'/../../../../system_parts/system_block/common/parts/member_info.php';?>
<?php require dirname(__FILE__).'/../../../../system_parts/system_block/common/navi/mnavi_001.php';?>
<?php
if($session->isLogin()) {
?>
<?php require dirname(__FILE__).'/../../../../system_parts/system_block/mypage/navi/mypage_navi.php';?>

<?php
}
?>
<?php require dirname(__FILE__).'/../../../../system_parts/system_block/contents/navi/cate_navit_001.php';?>
						<div class="drSnavi">
<?php require dirname(__FILE__).'/../../../../system_parts/system_block/common/navi/snavi_001.php';?>
						</div>
					</div>
