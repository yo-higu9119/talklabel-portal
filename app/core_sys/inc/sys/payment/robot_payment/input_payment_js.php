<?php
$shop = $systemInfo->roboto_pay_shop_id;
?>
<script type="text/javascript" src ="https://credit.j-payment.co.jp/gateway/js/CPToken.js"></script>
<style type="text/css">
<!--
.hiddenborder{
	left:0;
	border-style:none none solid;
	position:relative;
	width:100%;
	bottom:0;
	height:0;
	border-color:#198fcc;
	-webkit-transform:scaleX(0);
	-moz-transform:scaleX(0);
	-ms-transform:scaleX(0);
	-o-transform:scaleX(0);
	transform:scaleX(0);
	-webkit-transition:all 450ms cubic-bezier(.23,1,.32,1) 0ms;
	-o-transition:all 450ms cubic-bezier(.23,1,.32,1) 0ms;
	-moz-transition:all 450ms cubic-bezier(.23,1,.32,1) 0ms;
	transition: all 450ms cubic-bezier(.23,1,.32,1) 0ms;
	margin-bottom:-1px;
	top:5px;
}
-->
</style>
<script>
<!--
function get_card_type(str){
	var visa = ['4'];
	var mastercard = ['51','52','53','54','55'];
	var jcb = ['35'];
	var americanExpress = ['34','37'];
	var dinersClub = ['30','36','38','39'];
	var discover = ['60','64','65'];
	
	if($.inArray(str.substr(0,1),visa) != -1){//VISA
		return 'visa';
	}else if($.inArray(str.substr(0,2),mastercard) != -1){
		return 'mastercard';
	}else if($.inArray(str.substr(0,2),jcb) != -1){
		return 'jcb';
	}else if($.inArray(str.substr(0,2),americanExpress) != -1){
		return 'americanExpress';
	}else if($.inArray(str.substr(0,2),dinersClub) != -1){
		return 'dinersClub';
	}else if($.inArray(str.substr(0,2),discover) != -1){
		return 'discover';
	}else{
		return '';
	}
}

jQuery(document).ready(function(){
	$("#payment-form2").find('input[name="crd_num"]').keyup(function() {
		var str = $(this).val();
		var res = get_card_type(str);
		if(res != ''){
			$("#card_img").html('<img src="../../core_sys/common/images/sys/'+ res + '.png" style="vertical-align:middle;" width="40" >');
		}else{
			$("#card_img").html('');
		}
	});
	$("#payment-form2").find('input[name="crd_num"]').focusout(function() {
		var str = $(this).val();
		var res = get_card_type(str);
		if(res != ''){
			$("#card_img").html('<img src="../../core_sys/common/images/sys/'+ res + '.png" style="vertical-align:middle;" width="40" >');
		}else{
			$("#card_img").html('');
		}
	});
	$("#payment-form2").find('input').focusin(function(e) {
		$(this).parent().parent().find('.hiddenborder').css('transform', 'scaleX(1)');
	});
	$("#payment-form2").find('input').focusout(function(e) {
		$(this).parent().parent().find('.hiddenborder').css('transform', 'scaleX(0)');
	});
});

function load_efect(){
	var form = $("#payment-form2");
	var crd_num = $(".crd_num"),
		crd_sec = $(".crd_sec"),
		crd_m = $(".crd_m"),
		crd_y = $(".crd_y"),
		fn = $(".fn"),
		ln = $(".ln")

		var sErr = '';
		if(crd_num.val() == ''){
			sErr = sErr + '<?php echo Util::dispLang(Language::WORD_00250);/* カード番号が入力されていません。 */ ?><br />';
		}else if(!crd_num.val().match(/^[0-9]+$/)){
			sErr = sErr + '<?php echo Util::dispLang(Language::WORD_00251);/* カード番号に半角数字以外が入力されています。 */ ?><br />';
		}
		if(fn.val() == ''){
			sErr = sErr + '<?php echo Util::dispLang(Language::WORD_00252);/* カード名義人が入力されていません。 */ ?><br />';
		}else if(!fn.val().toUpperCase().match(/^[A-Z ]+$/)){
			sErr = sErr + '<?php echo Util::dispLang(Language::WORD_00253);/* カード名義人に半角英大字以外が入力されています。 */ ?><br />';
		}else{
			if(ln.val() == ''){
				sErr = sErr + '<?php echo Util::dispLang(Language::WORD_00252);/* カード名義人が入力されていません。 */ ?><br />';
			}else if(!ln.val().toUpperCase().match(/^[A-Z ]+$/)){
				sErr = sErr + '<?php echo Util::dispLang(Language::WORD_00253);/* カード名義人に半角英大字以外が入力されています。 */ ?><br />';
			}
		}
		if(crd_m.val() == ''){
			sErr = sErr + '<?php echo Util::dispLang(Language::WORD_00254);/* 有効期限(月)が入力されていません。 */ ?><br />';
		}else if(!crd_m.val().match(/^[0-9]+$/)){
			sErr = sErr + '<?php echo Util::dispLang(Language::WORD_00255);/* 有効期限(月)に半角数字以外が入力されています。 */ ?><br />';
		}
		if(crd_y.val() == ''){
			sErr = sErr + '<?php echo Util::dispLang(Language::WORD_00256);/* 有効期限(年)が入力されていません。 */ ?><br />';
		}else if(!crd_y.val().match(/^[0-9]+$/)){
			sErr = sErr + '<?php echo Util::dispLang(Language::WORD_00257);/* 有効期限(年)に半角数字以外が入力されています。 */ ?><br />';
		}
		if(crd_sec.val() == ''){
			sErr = sErr + '<?php echo Util::dispLang(Language::WORD_00258);/* セキュリティコードが入力されていません。 */ ?><br />';
		}else if(!crd_sec.val().match(/^[0-9]+$/)){
			sErr = sErr + '<?php echo Util::dispLang(Language::WORD_00259);/* セキュリティコードに半角数字以外が入力されています。 */ ?><br />';
		}
		if(sErr != ''){
			$('.payment-errors').show();
			$('.payment-errors').html(sErr);
			$('body, html').animate({ scrollTop: 0 }, 500);
			return false;
		}
		
		var card = {
			aid: '<?php echo $shop; ?>',
			cn: crd_num.val(),
			cvv: crd_sec.val(),
			ed: crd_y.val() + crd_m.val(),
			fn: fn.val().toUpperCase(),
			ln: ln.val().toUpperCase()
		};
		CPToken.TokenCreate (card,function(resultCode, errMsg) {
			if(resultCode != "Success") {
				$('.payment-errors').show();
				$('.payment-errors').text(errMsg);
				$('body, html').animate({ scrollTop: 0 }, 500);
			}
			else {
				var token = $("#tkn").val();
				form.append($('<input type="hidden" name="Token" />').val(token));
				
				crd_num.removeAttr("name");
				crd_sec.removeAttr("name");
				crd_m.removeAttr("name");
				crd_y.removeAttr("name");
				fn.removeAttr("name");
				ln.removeAttr("name");
				$("#tkn").removeAttr("name");
				
				$('#bk_bt').prop("disabled", true);
				$('#fc_bt').prop("disabled", true);
				$('#loading').show();
				form.submit();
			}
		});

}
//-->
</script>
