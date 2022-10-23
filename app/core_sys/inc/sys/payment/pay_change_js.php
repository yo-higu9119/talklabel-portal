<script>
function ch_plan(flg){
	var val = $("input[name='item']:checked").val();
	if(flg){
<?php
		$init = 0;
		foreach ($itemList as $key1 => $val1){
			if($itemInfo->id == $key1){
				continue;
			}
			if($init === 0){
?>
		if(val == <?php echo $key1; ?>){
<?php
			}else{
?>
		}else if(val == <?php echo $key1; ?>){
<?php
			}
			foreach ($itemList2 as $key2 => $val2){
				if($itemInfo->id == $key2){
					continue;
				}
				if($key1 == $key2){
?>
			$('#Plan_Block<?php echo $key2; ?>').show();
<?php
				}else{
?>
			$('#Plan_Block<?php echo $key2; ?>').hide();
<?php
				}
			}
			$init++;
		}
?>
		}else{
<?php
		foreach ($itemList as $key1 => $val1){
			if($itemInfo->id == $key1){
				continue;
			}
?>
			$('#Plan_Block<?php echo $key1; ?>').hide();
<?php
		}
?>
		}
	}else{
<?php
		$init = 0;
		foreach ($itemList as $key1 => $val1){
			if($itemInfo->id == $key1){
				continue;
			}
			if($init === 0){
?>
		if(val == <?php echo $key1; ?>){
<?php
			}else{
?>
		}else if(val == <?php echo $key1; ?>){
<?php
			}
			foreach ($itemList2 as $key2 => $val2){
				if($itemInfo->id == $key2){
					continue;
				}
				if($key1 == $key2){
?>
			is_slide('#Plan_Block<?php echo $key2; ?>',true);
<?php
				}else{
?>
			is_slide('#Plan_Block<?php echo $key2; ?>',false);
<?php
				}
			}
			$init++;
		}
?>
		}else{
<?php
		foreach ($itemList as $key1 => $val1){
			if($itemInfo->id == $key1){
				continue;
			}
?>
			is_slide('#Plan_Block<?php echo $key1; ?>',false);
<?php
		}
?>
		}
	}
}
function is_slide(Name,flg){
	if(flg){
		if(!$(Name).is(':visible')){
			$(Name).slideToggle('fast');
		}
	}else{
		if($(Name).is(':visible')){
			$(Name).slideToggle('fast');
		}
	}
}
$(document).ready(function(){
	ch_plan(true);
});
</script>
