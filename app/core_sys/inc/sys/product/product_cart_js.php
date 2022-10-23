<script>
$(function() {
	enter_disable();
	set_cart_item_event();
});

function enter_disable(){
	$("input").keydown(function(e) {
		if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
			return false;
		} else {
			return true;
		}
	});
}

function set_cart_item_event(){
	$("input[name^=cart_item]").keyup(function(e) {
		if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
			//if($.isNumeric($(this).val())){
				
			//}else{
			//	$(this).val(1);
			//}
			//var id = $(this).attr('name').replace( 'cart_item', '' );
			
			//setProductCart(id,0,$(this).val(),$("input[name=ajast_amount]").val());
		} else {
			if($.isNumeric($(this).val())){
				
			}else{
				$(this).val(1);
			}
		}
	});
}

function setProductCartNum(cal_num){
	if(!isNaN(cal_num)){
		let target_obj = $("input[name=cart_item]");
		let now_val = Number(target_obj.val());
		if(!isNaN(now_val)){
			now_val = now_val + Number(cal_num);
			if(now_val <= 0){
				now_val = 1;
			}
			target_obj.val(now_val);
		}
	}
}

function setProductCart(product_id, del_flg, num_change='', ajast_amount=''){
	var member_id = <?php echo $session->getMemberId(); ?>;
	var num = '';
	if(num_change != "" && $.isNumeric(num_change)){
		num = num_change;
	}
	var ajast = '';
	if(ajast_amount != "" && $.isNumeric(ajast_amount)){
		ajast = ajast_amount;
	}
	 $.ajax({
	 	type: "post",
	 	url: '../../core_sys/inc/sys/product/set_cart.php',
		data: JSON.stringify({"member_id" : member_id, "product_id" : product_id, "del_flg" : del_flg, "num" : num, "ajast" : ajast}),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			if(data1.status == 'success'){
			}else if(data1.status == 'none'){
			}else{
				console.log('post error');
			}
		},
		error: function () {
			console.log('sending error');
		},
		complete: function () {
        }
	});
}

</script>
