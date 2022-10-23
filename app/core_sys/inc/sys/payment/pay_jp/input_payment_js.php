<?php
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();
$public_secrett = $systemInfo->getPkKey();
?>
<script src="https://js.pay.jp/v2/pay.js"></script>
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
div.payjs-outer {
  margin: 2px;
  border: 1px solid #cdcdcd;
  width: 400px;
}
-->
</style>
<script>
<!--
var style1 = {
    base: {
      backgroundColor: '#fffef6',
      color: '#434343',
      fontSize: '14px',
      lineHeight: '43px'
    },
    invalid: {
      color: 'red'
    }
};

var payjp = Payjp('<?php echo $public_secrett; ?>');
var elements = payjp.elements();
var numberElement = elements.create('cardNumber',{style:style1,placeholder:'<?php echo Util::dispLang(Language::WORD_00238);/*ハイフン無し数字で入力してください*/?>'});
var expiryElement = elements.create('cardExpiry',{style:style1,placeholder:'<?php echo Util::dispLang(Language::WORD_00242);/*月*/?>/<?php echo Util::dispLang(Language::WORD_00243);/*年*/?>'});
var cvcElement = elements.create('cardCvc',{style:style1,placeholder:'<?php echo Util::dispLang(Language::WORD_00245);/*セキュリティコードを入力してください*/?>'});

function get_card_type(str){
	if(str == 'Visa'){//VISA
		return 'visa';
	}else if(str == 'MasterCard'){
		return 'mastercard';
	}else if(str == 'JCB'){
		return 'jcb';
	}else if(str == 'American Express'){
		return 'americanExpress';
	}else if(str == 'Diners Club'){
		return 'dinersClub';
	}else if(str == 'Discover'){
		return 'discover';
	}else{
		return 'unknown';
	}
}

jQuery(document).ready(function(){
	numberElement.mount('#number-form');
	expiryElement.mount('#expiry-form');
	cvcElement.mount('#cvc-form');

	numberElement.on('change', (e) => {
		var res = get_card_type(e.brand);
		if(res != 'unknown'){
			$("#card_img").html('<img src="../../core_sys/common/images/sys/'+ res + '.png" style="vertical-align:middle;" width="40" >');
		}else{
			$("#card_img").html('');
		}
	});

	numberElement.on('focus', (e) => {
	 $('.pay-cardnumber').css('transform', 'scaleX(1)');
	});
	numberElement.on('blur', (e) => {
	 $('.pay-cardnumber').css('transform', 'scaleX(0)');
	});
	expiryElement.on('focus', (e) => {
	 $('.pay-exp').css('transform', 'scaleX(1)');
	});
	expiryElement.on('blur', (e) => {
	 $('.pay-exp').css('transform', 'scaleX(0)');
	});
	cvcElement.on('focus', (e) => {
	 $('.pay-cvc').css('transform', 'scaleX(1)');
	});
	cvcElement.on('blur', (e) => {
	 $('.pay-cvc').css('transform', 'scaleX(0)');
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
	var crd_name = $(".crd_name"),
		cardfinger = $("input[name='cardfinger']:checked");
	
	if(cardfinger.val() == ''){
		var sErr = '';
		if(crd_name.val() == ''){
			sErr = sErr + '<?php echo Util::dispLang(Language::WORD_00252);/* カード名義人が入力されていません。 */ ?><br />';
		}else if(!crd_name.val().toUpperCase().match(/^[A-Z ]+$/)){
			sErr = sErr + '<?php echo Util::dispLang(Language::WORD_00253);/* カード名義人に半角英大字以外が入力されています。 */ ?><br />';
		}
		if(sErr != ''){
			$('.payment-errors').show();
			$('.payment-errors').html(sErr);
			$('body, html').animate({ scrollTop: 0 }, 500);
			return false;
		}
		payjp.createToken(numberElement,{card: {name: crd_name.val()}}).then(function(r) {
			if(r.error) {
				$('.payment-errors').show();
				$('.payment-errors').text(r.error.message);
				$('body, html').animate({ scrollTop: 0 }, 500);
			}else{
				var token = r.id;
				form.append($('<input type="hidden" name="Token" />').val(token));
				var fingerprint = r.card.fingerprint;
				form.append($('<input type="hidden" name="fingerprint" />').val(fingerprint));
				
				crd_name.removeAttr("name");
				
				$('#bk_bt').prop("disabled", true);
				$('#fc_bt').prop("disabled", true);
				$('#loading').show();
				form.submit();
			}
		})
	}else{
		crd_name.removeAttr("name");
		
		$('#bk_bt').prop("disabled", true);
		$('#fc_bt').prop("disabled", true);
		$('#loading').show();
		form.submit();
	}
}

function ch_card(flg){
	var val = $("input[name='cardfinger']:checked").val();
	if(flg){
		if(val == ''){
			$('#newCardInput').show();
		}else{
			$('#newCardInput').hide();
		}
	}else{
		if(val == ''){
			is_slide('#newCardInput',true);
		}else{
			is_slide('#newCardInput',false);
		}
	}
}

$(document).ready(function(){
	ch_card(true);
});
//-->
</script>
