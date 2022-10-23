<?php
if(isset($productInfo->comment_setting) && $productInfo->comment_setting == 1){
?>
<script>
var _nowPage = 1;
function setCommentCtlBt(){
	$('.slide_res').on('click', function() {
		var id = String($(this).attr('id')).replace(/slide/, '');
		setCommentCtlBtAllClose(id);
		var obj = $('#slideArea'+id);
		if(obj.is(':hidden')) {
			$(this).text('<?php echo Util::dispLang(Language::WORD_00051);/* 返信しないJS用 */?>').addClass('btn_close').removeClass('btn_open');
			obj.stop().slideDown('slow');
		} else {
			$(this).text('<?php echo Util::dispLang(Language::WORD_00046);/* 返信する */?>').addClass('btn_open').removeClass('btn_close');
			obj.stop().slideUp('slow');
		}
		return false;
	});
	$('.slide_rep').on('click', function() {
		var id = String($(this).attr('id')).replace(/sliderp/, '');
		setCommentCtlBtAllClose(id);
		var obj = $('#sliderpArea'+id);
		if(obj.is(':hidden')) {
			$(this).text('<?php echo Util::dispLang(Language::WORD_00052);/* 通報しないJS用 */?>').addClass('btn_close').removeClass('btn_open');
			obj.stop().slideDown('slow');
		} else {
			$(this).text('<?php echo Util::dispLang(Language::WORD_00053);/* 通報するJS用 */?>').addClass('btn_open').removeClass('btn_close');
			obj.stop().slideUp('slow');
		}
		return false;
	});
	$('.slide_edit').on('click', function() {
		var id = String($(this).attr('id')).replace(/slideed/, '');
		setCommentCtlBtAllClose(id);
		var obj = $('#slideedArea'+id);
		if(obj.is(':hidden')) {
			//$('#slideedArea'+id+" textarea[name='input_comment"+id+"'").val($('#commentNo'+id+' .commentTxt').text());
			$(this).text('<?php echo Util::dispLang(Language::WORD_00015);/* 編集しない */?>').addClass('btn_close').removeClass('btn_open');
			obj.stop().slideDown('slow');
		} else {
			$(this).text('<?php echo Util::dispLang(Language::WORD_00016);/* 編集する */?>').addClass('btn_open').removeClass('btn_close');
			obj.stop().slideUp('slow');
		}
		return false;
	});
	$('.slide_del').on('click', function() {
		var id = String($(this).attr('id')).replace(/slidedl/, '');
		setCommentCtlBtAllClose(id);
		var obj = $('#slidedlArea'+id);
		if(obj.is(':hidden')) {
			$(this).text('<?php echo Util::dispLang(Language::WORD_00054);/* 削除しないJS用 */?>').addClass('btn_close').removeClass('btn_open');
			obj.stop().slideDown('slow');
		} else {
			$(this).text('<?php echo Util::dispLang(Language::WORD_00024);/* 削除する */?>').addClass('btn_open').removeClass('btn_close');
			obj.stop().slideUp('slow');
		}
		return false;
	});
	$('.slide_rescom').on('click', function() {
		var id = String($(this).attr('id')).replace(/slide/, '');
		setCommentCtlBtAllClose(id);
		var obj = $('#slideArea'+id);
		if(obj.is(':hidden')) {
			$(this).text('<?php echo Util::dispLang(Language::WORD_00654);/* レビューしないJS用 */?>').addClass('btn_close').removeClass('btn_open');
			obj.stop().slideDown('slow');
		} else {
			$(this).text('<?php echo Util::dispLang(Language::WORD_00653);/* レビューする */?>').addClass('btn_open').removeClass('btn_close');
			obj.stop().slideUp('slow');
		}
		return false;
	});
}
function setCommentCtlBtAllClose(id){
	$('#sliderp'+id).text('<?php echo Util::dispLang(Language::WORD_00053);/* 通報するJS用 */?>').addClass('btn_open').removeClass('btn_close');
	$('#sliderpArea'+id).stop().slideUp('slow');
	$('#slideed'+id).text('<?php echo Util::dispLang(Language::WORD_00016);/* 編集する */?>').addClass('btn_open').removeClass('btn_close');
	$('#slideedArea'+id).stop().slideUp('slow');
	$('#slidedl'+id).text('<?php echo Util::dispLang(Language::WORD_00024);/* 削除する */?>').addClass('btn_open').removeClass('btn_close');
	$('#slidedlArea'+id).stop().slideUp('slow');
	$('#slide'+id).text('<?php echo Util::dispLang(Language::WORD_00046);/* 返信する */?>').addClass('btn_open').removeClass('btn_close');
	$('#slideArea'+id).stop().slideUp('slow');
}
$(function() {
	comment_get_all(_nowPage,false);
});
function comment_check(pid) {
	if(pid == 0){
		var body_obj = $("textarea[name='input_comment"+pid+"']");
		var nickname_obj = $("input[name='input_nickname"+pid+"']");
	}else{
		var body_obj = $("#slideArea"+pid+" textarea[name='input_comment"+pid+"']");
		var nickname_obj = $("#slideArea"+pid+" input[name='input_nickname"+pid+"']");
	}
	if(body_obj.val().replace(/\s+/g, "") == ''){
		$(".ComErrDisp").remove();
		body_obj.before('<p class="Art cnt mgt10 mgb10 ComErrDisp"><?php echo Util::dispLang(Language::WORD_00655);/* レビューが入力されていません */?></p>');
		return false;
	}else{
		$(".ComErrDisp").remove();
<?php if (IS_SMART_PHONE) { ?>
		utilOpenFrame('../../popup/product_comment/comment_dialog.php?id='+pid+'&t=rs', false, 50, 340, 400);
<?php } else { ?>
		utilOpenFrame('../../popup/product_comment/comment_dialog.php?id='+pid+'&t=rs', false, 50, 700, 500);
<?php } ?>
	}
}
function comment_submit(pid) {
	var product_id = <?php echo $productInfo->id; ?>;
	var parent_id = 0;
	if(pid != 0){
		parent_id = pid;
	}
	if(pid == 0){
		var body_obj = $("textarea[name='input_comment"+pid+"']");
		var nickname_obj = $("input[name='input_nickname"+pid+"']");
	}else{
		var body_obj = $("#slideArea"+pid+" textarea[name='input_comment"+pid+"']");
		var nickname_obj = $("#slideArea"+pid+" input[name='input_nickname"+pid+"']");
	}
	var body = body_obj.val();
	var nickname = nickname_obj.val();
	 $.ajax({
	 	type: "post",
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/product/send_comment.php',
		data: JSON.stringify({"product_id" : product_id, "parent_id" : parent_id, "body" : body, "nickname" : nickname }),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			if(data1.status == 'success'){
				if(pid != 0){
					comment_get_all(_nowPage,false);
				}else{
					comment_get_all(1,false);
				}
				body_obj.val("");
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
function comment_edit_check(pid) {
	if(pid == 0){
		return false;
	}
	var body_obj = $("#slideedArea"+pid+" textarea[name='input_comment"+pid+"']");
	if(body_obj.val().replace(/\s+/g, "") == ''){
		$(".ComErrDisp").remove();
		body_obj.before('<p class="Art cnt mgt10 mgb10 ComErrDisp"><?php echo Util::dispLang(Language::WORD_00655);/* レビューが入力されていません */?></p>');
		return false;
	}else{
		$(".ComErrDisp").remove();
<?php if (IS_SMART_PHONE) { ?>
		utilOpenFrame('../../popup/product_comment/comment_dialog.php?id='+pid+'&t=ed', false, 50, 340, 400);
<?php } else { ?>
		utilOpenFrame('../../popup/product_comment/comment_dialog.php?id='+pid+'&t=ed', false, 50, 700, 500);
<?php } ?>
	}
}
function comment_edit_submit(pid) {
	if(pid == 0){
		return false;
	}
	var body_obj = $("#slideedArea"+pid+" textarea[name='input_comment"+pid+"']");
	var nickname_obj = $("#slideedArea"+pid+" input[name='input_nickname"+pid+"']");
	var body = body_obj.val();
	var nickname = nickname_obj.val();
	 $.ajax({
	 	type: "post",
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/product/send_edit_comment.php',
		data: JSON.stringify({"id" : pid, "body" : body, "nickname" : nickname }),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			if(data1.status == 'success'){
				comment_get_all(_nowPage,false);
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
function comment_rep_check(pid) {
	if(pid == 0){
		return false;
	}
	var body_obj = $("#sliderpArea"+pid+" textarea[name='input_comment"+pid+"']");
	if(body_obj.val().replace(/\s+/g, "") == ''){
		$(".ComErrDisp").remove();
		body_obj.before('<p class="Art cnt mgt10 mgb10 ComErrDisp"><?php echo Util::dispLang(Language::WORD_00057);/* 通報内容が入力されていません */?></p>');
		return false;
	}else{
		$(".ComErrDisp").remove();
<?php if (IS_SMART_PHONE) { ?>
		utilOpenFrame('../../popup/product_comment/comment_dialog.php?id='+pid+'&t=rp', false, 50, 340, 400);
<?php } else { ?>
		utilOpenFrame('../../popup/product_comment/comment_dialog.php?id='+pid+'&t=rp', false, 50, 700, 500);
<?php } ?>
	}
}
function comment_rep_submit(pid) {
	if(pid == 0){
		return false;
	}
	var body_obj = $("#sliderpArea"+pid+" textarea[name='input_comment"+pid+"']");
	var body = body_obj.val();
	 $.ajax({
	 	type: "post",
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/product/send_rep_comment.php',
		data: JSON.stringify({"id" : pid, "body" : body }),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			if(data1.status == 'success'){
				$('#commentResBT'+pid).html('<span><?php echo Util::dispLang(Language::WORD_00045);/* 通報しました */?></span>');
				//$('#sliderpArea'+pid).remove();
				setCommentCtlBtAllClose(pid);
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
function comment_del_submit(pid) {
	if(pid == 0){
		return false;
	}
	 $.ajax({
	 	type: "post",
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/product/send_del_comment.php',
		data: JSON.stringify({"id" : pid }),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			if(data1.status == 'success'){
				comment_get_all(_nowPage,false);
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

function comment_empathy_submit(pid) {
	if(pid == 0){
		return false;
	}
	 $.ajax({
	 	type: "post",
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/product/send_empathy_comment.php',
		data: JSON.stringify({"id" : pid }),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			if(data1.status == 'success'){
				if(data1.flg == 0){//共感していない
					$('#ComShare'+pid).removeClass('crt');
				}else{//共感している
					$('#ComShare'+pid).addClass('crt');
				}
				$('#ComShareNo'+pid).text(data1.count);//現在の共感数
				console.log(_nowPage);
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

function comment_get_all(page,loc) {
	_nowPage = page;
	if(loc){
		location.href='#commentTop';
	}
	$("[id^='commentNo']").remove();
	$(".PageNum").remove();
	$("#loading ").show();
	var product_id = <?php echo $productInfo->id; ?>;
	 $.ajax({
	 	type: "post",
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/product/get_comment_list.php',
		data: JSON.stringify({"product_id" : product_id, "page" : page }),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			$("#loading ").hide();
			if(data1.status == 'success'){
				$(".commentBox ").append(data1.tags);
				setCommentCtlBt();
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
<?php
}
if(isset($productInfo) && $productInfo->niceDisp){
?>
<script>
function product_empathy_submit(pid) {
	if(pid == 0){
		return false;
	}
	 $.ajax({
	 	type: "post",
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/product/send_product_empathy.php',
		data: JSON.stringify({"id" : pid }),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			if(data1.status == 'success'){
				if(data1.flg == 0){//共感していない
					$('.PrdShare'+pid).removeClass('crt');
				}else{//共感している
					$('.PrdShare'+pid).addClass('crt');
				}
				$('.PrdShareNam'+pid).text(data1.count);//現在の共感数
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
<?php
}
if(isset($productInfo) && $productInfo->favorite_disp){
?>
<script>
function product_favorite_submit(pid) {
	if(pid == 0){
		return false;
	}
	 $.ajax({
	 	type: "post",
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/product/send_product_favorite.php',
		data: JSON.stringify({"id" : pid }),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			if(data1.status == 'success'){
				if(data1.flg == 0){//お気に入りしていない
					$('.PrdFavorite'+pid).removeClass('crt');
				}else{//お気に入りしている
					$('.PrdFavorite'+pid).addClass('crt');
				}
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
<?php
}
?>
