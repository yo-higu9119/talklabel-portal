<?php
if($seminarInfo->fileName !== ""){
?>
		<div class="mainVisual">
			<div class="slide_single_box">
<?php
if($seminarInfo->fileName !== ""){
?>
				<div><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_seminar_file.php?id='.$seminarInfo->id)?>" alt=""></div>
<?php
}
if($seminarInfo->fileName2 != ""){
?>
				<div><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_seminar_other_file.php?id='.$seminarInfo->id)?>&n=1" alt=""></div>
<?php
}
if($seminarInfo->fileName3 != ""){
?>
				<div><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_seminar_other_file.php?id='.$seminarInfo->id)?>&n=2" alt=""></div>
<?php
}
if($seminarInfo->fileName4 != ""){
?>
				<div><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_seminar_other_file.php?id='.$seminarInfo->id)?>&n=3" alt=""></div>
<?php
}
if($seminarInfo->fileName5 != ""){
?>
				<div><img src="<?php echo htmlspecialchars(SYSTEM_TOP_URL.'core_sys/sys/file/get_seminar_other_file.php?id='.$seminarInfo->id)?>&n=4" alt=""></div>
<?php
}
?>
			</div>
		</div>
<?php
}
?>
