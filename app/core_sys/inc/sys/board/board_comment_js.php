<?php if($info->status == 1 && $info->commentAuthDefoult == 1){ ?>
<script>
var _nowPage = 1;
function setCommentCtlBt(){
	$('.slide_res').off("click");
	$('.slide_rep').off("click");
	$('.slide_edit').off("click");
	$('.slide_del').off("click");
	$('.slide_rescom').off("click");
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
			$(this).text('<?php echo Util::dispLang(Language::WORD_00055);/* コメントしないJS用 */?>').addClass('btn_close').removeClass('btn_open');
			obj.stop().slideDown('slow');
		} else {
			$(this).text('<?php echo Util::dispLang(Language::WORD_00020);/* コメントする */?>').addClass('btn_open').removeClass('btn_close');
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
		body_obj.before('<p class="Art cnt mgt10 mgb10 ComErrDisp"><?php echo Util::dispLang(Language::WORD_00056);/* コメントが入力されていません */?></p>');
		return false;
	}else{
		$(".ComErrDisp").remove();
<?php if (IS_SMART_PHONE) { ?>
		utilOpenFrame('../../popup/board/comment_dialog.php?id='+pid+'&t=rs', false, 50, 340, 400);
<?php } else { ?>
		utilOpenFrame('../../popup/board/comment_dialog.php?id='+pid+'&t=rs', false, 50, 700, 500);
<?php } ?>
	}
}
function comment_submit(pid) {
	var board_id = <?php echo $info->id; ?>;
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
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/board/send_board_comment.php',
		data: JSON.stringify({"board_id" : board_id, "parent_id" : parent_id, "body" : body, "nickname" : nickname }),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			if(data1.status == 'success'){
				setCommentCtlBtAllClose(pid);
				$("#ComCount").text(data1.cnt);
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
		body_obj.before('<p class="Art cnt mgt10 mgb10 ComErrDisp"><?php echo Util::dispLang(Language::WORD_00056);/* コメントが入力されていません */?></p>');
		return false;
	}else{
		$(".ComErrDisp").remove();
<?php if (IS_SMART_PHONE) { ?>
		utilOpenFrame('../../popup/board/comment_dialog.php?id='+pid+'&t=ed', false, 50, 340, 400);
<?php } else { ?>
		utilOpenFrame('../../popup/board/comment_dialog.php?id='+pid+'&t=ed', false, 50, 700, 500);
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
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/board/send_board_edit_comment.php',
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
		utilOpenFrame('../../popup/board/comment_dialog.php?id='+pid+'&t=rp', false, 50, 340, 400);
<?php } else { ?>
		utilOpenFrame('../../popup/board/comment_dialog.php?id='+pid+'&t=rp', false, 50, 700, 500);
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
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/board/send_board_rep_comment.php',
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
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/board/send_board_del_comment.php',
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
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/board/send_board_empathy_comment.php',
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
	var board_id = <?php echo $info->id; ?>;
	 $.ajax({
	 	type: "post",
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/board/get_board_comment_list.php',
		data: JSON.stringify({"board_id" : board_id, "page" : page }),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			$("#loading ").hide();
			if(data1.status == 'success'){
				$(".commentBox ").append(data1.tags);
				setCommentCtlBt();
			}else if(data1.status == 'none'){
				setCommentCtlBt();
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
function board_empathy_submit(pid) {
	if(pid == 0){
		return false;
	}
	 $.ajax({
	 	type: "post",
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/board/send_board_empathy.php',
		data: JSON.stringify({"id" : pid }),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			if(data1.status == 'success'){
				if(data1.flg == 0){//共感していない
					$('.BrdShare'+pid).removeClass('crt');
				}else{//共感している
					$('.BrdShare'+pid).addClass('crt');
				}
				$('#BrdShareNo'+pid).text(data1.count);//現在の共感数
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
function board_rep_check() {
	var body_obj = $("#sliderpArea0 textarea[name='input_comment0']");
	if(body_obj.val().replace(/\s+/g, "") == ''){
		$(".ComErrDisp").remove();
		body_obj.before('<p class="Art cnt mgt10 mgb10 ComErrDisp"><?php echo Util::dispLang(Language::WORD_00057);/* 通報内容が入力されていません */?></span>');
		return false;
	}else{
		$(".ComErrDisp").remove();
<?php if (IS_SMART_PHONE) { ?>
		utilOpenFrame('../../popup/board/comment_dialog.php?id=0&t=brp', false, 50, 340, 400);
<?php } else { ?>
		utilOpenFrame('../../popup/board/comment_dialog.php?id=0&t=brp', false, 50, 700, 500);
<?php } ?>
	}
}
function board_rep_submit() {
	var board_id = <?php echo $info->id; ?>;
	var body_obj = $("#sliderpArea0 textarea[name='input_comment0']");
	var body = body_obj.val();
	 $.ajax({
	 	type: "post",
	 	url: '<?php echo SYSTEM_TOP_URL; ?>core_sys/inc/sys/board/send_board_rep.php',
		data: JSON.stringify({"board_id" : board_id, "body" : body }),
		contentType: 'application/json',
		dataType: "json",
		success: function (data1) {
			if(data1.status == 'success'){
				$('#commentResBT0').html('<span><?php echo Util::dispLang(Language::WORD_00045);/* 通報しました */?></span>');
				//$('#sliderpArea0').remove();
				setCommentCtlBtAllClose(0);
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
<?php } ?>
