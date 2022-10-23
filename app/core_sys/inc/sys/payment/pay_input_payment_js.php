<script>
function ch_type(flg){
	var val = $("input[name='settle_type']:checked").val();
	$('#pay_type1').val(val);
	$('#pay_type2').val(val);
	if(flg){
		if(val == 1){
			$('#form1').show();
			$('#form2').hide();
		}else{
			$('#form1').hide();
			$('#form2').show();
		}
	}else{
		if(val == 1){
			is_slide('#form1',true);
			is_slide('#form2',false);
		}else{
			is_slide('#form1',false);
			is_slide('#form2',true);
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
	ch_type(true);
});
</script>
