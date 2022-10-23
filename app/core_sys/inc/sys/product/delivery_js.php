<script>
$(function() {
	get_delivery_address();
	ch_delitype(true);
});

function get_delivery_address() {
	$("#delivery_address .addAreaInn").remove();
	$("#loading_delivery_address").show();
	var select_id = <?php echo $delivery_address_id; ?>;
	if(select_id == 0){
		select_id = $("[name='delivery_address_id'] option:selected").val();
		if(select_id == undefined){
			select_id = 0;
		}
	}
	 $.ajax({
	 	type: "post",
	 	url: '../../core_sys/inc/sys/product/get_delivery_list.php',
		data: JSON.stringify({"select_id" : select_id}),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			$("#loading_delivery_address").hide();
			if(data1.status == 'success'){
				$("#delivery_address ").append(data1.tags);
				//console.log('post success');
			}else if(data1.status == 'none'){
				$("#delivery_address ").append(data1.tags);
				//console.log('post none');
			}else{
				//console.log('post error');
			}
		},
		error: function () {
			//console.log('sending error');
		},
		complete: function () {
        }
	});
}

function ch_delitype(flg){
	var val = $("[name='delivery_type']:checked").val();
	if(flg){
		if(val == 2){
			$('#deliv_kbou').show();
		}else{
			$('#deliv_kbou').hide();
		}
	}else{
		if(val == 2){
			is_slide('#deliv_kbou',true);
		}else{
			is_slide('#deliv_kbou',false);
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
</script>
