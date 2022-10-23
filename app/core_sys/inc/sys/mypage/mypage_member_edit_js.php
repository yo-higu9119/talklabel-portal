<script>
$(function() {
	$(function() {
<?php
			foreach($memberData->Column as $Key => $funcInfo) {
				if($Key !== 'base' && $Key !== 'master' && $Key !== 'other' && $Key !== 'all'){
					if($funcInfo->type === 11){
?>
		$('#file_del<?php echo $funcInfo->id; ?>').on('click', function() {
			$('input[name="file_operation<?php echo $funcInfo->id; ?>"]').val(0);
			$('input[name="file_name<?php echo $funcInfo->id; ?>"]').val('');
			$('#file_view<?php echo $funcInfo->id; ?>').hide();
			$('#file_up<?php echo $funcInfo->id; ?>').show();
			return false;
		});
<?php
					}
				}
			}
?>
	});
});
$(document).ready(function(){
	$('.crt').parents('ul').show();
});
</script>
