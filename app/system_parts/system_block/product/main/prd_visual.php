<?php
if($productInfo->fileName !== ""){
?>
		<div class="mainVisual">
			<div class="slide_single_box">
<?php
if($productInfo->fileName !== ""){
?>
						<div><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_product_file.php?id='.$productInfo->id)?>" alt=""></div>
<?php
}
if($productInfo->fileName2 != ""){
?>
						<div><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_product_other_file.php?id='.$productInfo->id)?>&n=1" alt=""></div>
<?php
}
if($productInfo->fileName3 != ""){
?>
						<div><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_product_other_file.php?id='.$productInfo->id)?>&n=2" alt=""></div>
<?php
}
if($productInfo->fileName4 != ""){
?>
						<div><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_product_other_file.php?id='.$productInfo->id)?>&n=3" alt=""></div>
<?php
}
if($productInfo->fileName5 != ""){
?>
						<div><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_product_other_file.php?id='.$productInfo->id)?>&n=4" alt=""></div>
<?php
}
?>
			</div>
		</div>
<?php
}
?>
