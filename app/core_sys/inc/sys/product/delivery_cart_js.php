<script>
$(function() {
	setProductCart();
});

function setProductCart(){
	$("#cartDisp").empty();
	$("#loading_carttList").show();
	var member_id = <?php echo $session->getMemberId(); ?>;
	var group_id = <?php echo (isset($productCategoryGroupInfo))?$productCategoryGroupInfo->id:0; ?>;
	var delivery_address_id = <?php echo (isset($addressInfo))?$addressInfo->id:0; ?>;
	 $.ajax({
	 	type: "post",
	 	url: '../../core_sys/inc/sys/product/get_cart.php',
		data: JSON.stringify({"member_id" : member_id, "group_id" : group_id, "delivery_address_id" : delivery_address_id}),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			$("#loading_carttList").hide();
			if(data1.status == 'success'){
				$("#cartDisp").append(data1.tags);
				console.log('post success');
			}else if(data1.status == 'none'){
				$("#cartDisp").append(data1.tags);
				console.log('post none');
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
