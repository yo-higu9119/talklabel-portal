<script>
$(function() {
	get_product_list();
	enter_disable();
	setProductCart(0, 0);
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

function set_ajast_amount_event(){
	$("input[name=ajast_amount]").keyup(function(e) {
		if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
			//if($.isNumeric($(this).val())){
				
			//}else{
			//	$(this).val('');
			//}
			//setProductCart(0,0,'',$(this).val());
		} else {
			if($(this).val() == '-'){
				
			}else if($.isNumeric($(this).val())){
				
			}else{
				$(this).val('');
			}
		}
	});
}

function pro_ser_clear(){
	$('input[name="ser_name"]').val('');
	$('input[name="ser_pro_num"]').val('');
	$("#page").val(0);
}

function get_product_list() {
	$("#productList").empty();
	$("#loading_productList").show();
	var member_id = <?php echo $session->getMemberId(); ?>;
	var group_id = $("#group_id").val();
	var page = $("#page").val();
	var disp_max = $("#disp_max").val();
	var page_disp_num = $("#page_disp_num").val();
	var ser_name = $('input[name="ser_name"]').val();
	var ser_pro_num = $('input[name="ser_pro_num"]').val();
	var category_id = get_cart_cate_crt();
	 $.ajax({
	 	type: "post",
	 	url: '../../core_sys/inc/sys/product/get_product_list.php',
		data: JSON.stringify({"member_id" : member_id, "group_id" : group_id, "page" : page, "disp_max" : disp_max, "ser_name" : ser_name, "ser_pro_num" : ser_pro_num, "page_disp_num" : page_disp_num, "category_id" : category_id}),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			$("#loading_productList").hide();
			if(data1.status == 'success'){
				$("#productList").append(data1.tags);
				//console.log('get_product_list post success');
			}else if(data1.status == 'none'){
				$("#productList").append(data1.tags);
				//console.log('get_product_list post none');
			}else{
				console.log('get_product_list post error');
			}
		},
		error: function () {
			console.log('get_product_list sending error');
		},
		complete: function () {
        }
	});
}

function setProductCart(product_id, del_flg, num_change='', ajast_amount=''){
	$("#cartList").empty();
	$("#loading_carttList").show();
	var member_id = <?php echo $session->getMemberId(); ?>;
	var group_id = $("#group_id").val();
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
	 	url: '../../core_sys/inc/sys/product/get_cart_list.php',
		data: JSON.stringify({"member_id" : member_id, "group_id" : group_id, "product_id" : product_id, "del_flg" : del_flg, "num" : num, "ajast" : ajast}),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			$("#loading_carttList").hide();
			if(data1.status == 'success'){
				$("#cartList").append(data1.tags);
				enter_disable();
				set_cart_item_event();
				set_ajast_amount_event();
				getProductCartNum();
				//console.log('setProductCart post success');
			}else if(data1.status == 'none'){
				$("#cartList").append(data1.tags);
				getProductCartNum();
				//console.log('setProductCart post none');
			}else{
				console.log('setProductCart post error');
			}
		},
		error: function () {
			console.log('setProductCart sending error');
		},
		complete: function () {
        }
	});
}

function setProductCartOp(product_id, option_id, num_change=''){
	$("#cartList").empty();
	$("#loading_carttList").show();
	var member_id = <?php echo $session->getMemberId(); ?>;
	var group_id = $("#group_id").val();
	var num = '';
	if(num_change != "" && $.isNumeric(num_change)){
		num = num_change;
	}
	$.ajax({
	 	type: "post",
	 	url: '../../core_sys/inc/sys/product/get_cart_list_op.php',
		data: JSON.stringify({"member_id" : member_id, "group_id" : group_id, "product_id" : product_id, "option_id" : option_id,  "num" : num}),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			$("#loading_carttList").hide();
			if(data1.status == 'success'){
				$("#cartList").append(data1.tags);
				enter_disable();
				set_cart_item_event();
				set_ajast_amount_event();
				getProductCartNum();
				//console.log('setProductCart post success');
			}else if(data1.status == 'none'){
				$("#cartList").append(data1.tags);
				getProductCartNum();
				//console.log('setProductCart post none');
			}else{
				console.log('setProductCart post error');
			}
		},
		error: function () {
			console.log('setProductCart sending error');
		},
		complete: function () {
        }
	});
}

function setProductCartCaop(option_id, num_change=''){
	$("#cartList").empty();
	$("#loading_carttList").show();
	var member_id = <?php echo $session->getMemberId(); ?>;
	var group_id = $("#group_id").val();
	var num = '';
	if(num_change != "" && $.isNumeric(num_change)){
		num = num_change;
	}
	$.ajax({
	 	type: "post",
	 	url: '../../core_sys/inc/sys/product/get_cart_list_caop.php',
		data: JSON.stringify({"member_id" : member_id, "group_id" : group_id, "option_id" : option_id,  "num" : num}),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			$("#loading_carttList").hide();
			if(data1.status == 'success'){
				$("#cartList").append(data1.tags);
				enter_disable();
				set_cart_item_event();
				set_ajast_amount_event();
				getProductCartNum();
				//console.log('setProductCart post success');
			}else if(data1.status == 'none'){
				$("#cartList").append(data1.tags);
				getProductCartNum();
				//console.log('setProductCart post none');
			}else{
				console.log('setProductCart post error');
			}
		},
		error: function () {
			console.log('setProductCart sending error');
		},
		complete: function () {
        }
	});
}

function cart_cate_crt(product_cate_id){
	$('[id^="cart_category"]').each(function(index, element){
		var id = $(element).attr('id').replace( 'cart_category', '' );
		if(id == product_cate_id){
			$(element).addClass("crt");
		}else{
			$(element).removeClass("crt");
		}
	});
}

function get_cart_cate_crt(){
	var id = 0;
	$('[id^="cart_category"]').each(function(index, element){
		if($(element).hasClass("crt")){
			id = $(element).attr('id').replace( 'cart_category', '' );
			return false;
		}
	});
	return id;
}

function setProductCartNum(cal_num,target_id){
	if(!isNaN(cal_num) && !isNaN(target_id)){
		let target_name = 'cart_item' + String(target_id);
		let target_obj = $("input[name=" + target_name + "]");
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

function setProductCartNumOp(cal_num,pr_id,op_id){
	if(!isNaN(cal_num) && !isNaN(pr_id) && !isNaN(op_id)){
		let target_name = 'cart_item' + String(pr_id) + '_' + String(op_id);
		let target_obj = $("input[name=" + target_name + "]");
		let now_val = Number(target_obj.val());
		if(!isNaN(now_val)){
			now_val = now_val + Number(cal_num);
			if(now_val < 0){
				now_val = 0;
			}
			target_obj.val(now_val);
		}
	}
}

function setProductCartNumCaop(cal_num,op_id){
	if(!isNaN(cal_num) && !isNaN(op_id)){
		let target_name = 'cart_op' + String(op_id);
		let target_obj = $("input[name=" + target_name + "]");
		let now_val = Number(target_obj.val());
		if(!isNaN(now_val)){
			now_val = now_val + Number(cal_num);
			if(now_val < 0){
				now_val = 0;
			}
			target_obj.val(now_val);
		}
	}
}

function cart_contlol(){
	let min_height = 200;
	let max_height = 550;
	let ani_duration = 550;
	let athis = $('.PrdCartInt');
	if (athis.hasClass('active')) {
		athis.stop()
		.animate({height:min_height}, ani_duration,
		function(){});
		athis.removeClass('active');
	} else {
		athis.height(min_height).stop()
		.animate({height:max_height},ani_duration, 
		function(){});
		athis.addClass('active');
	}
}

function getProductCartNum(){
	var num = '';
	var member_id = <?php echo $session->getMemberId(); ?>;
	 $.ajax({
	 	type: "post",
	 	url: '../../core_sys/inc/sys/product/get_cart_num.php',
		data: JSON.stringify({"member_id" : member_id}),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			if(data1.status == 'success'){
				$("#cart_bt_header").html(data1.tags);
			}else if(data1.status == 'none'){
				$("#cart_bt_header").html('<?php echo Util::dispLang(Language::WORD_00118);/*カート*/ ?>');
				//console.log('getProductCartNum none');
			}else{
				//console.log('getProductCartNum error');
			}
		},
		error: function () {
			console.log('getProductCartNum sending error');
		},
		complete: function () {
        }
	});
}

</script>
