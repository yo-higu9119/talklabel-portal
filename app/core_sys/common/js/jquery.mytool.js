/**
 * JQueryを利用したツール群
 * @copy Copyright (C) 2013 maverica corporation. All Rights Reserved.
 * @version 0.2
 */
(function($){
	/**
	 * テキスト入力の文字数上限を制御
	 * 対象に以下属性を付加しておくこと。
	 * max_input:文字数上限
	 * out_area：残文字数表示先ID
	 */
	$.fn.myCheckLength = function() {
		var max = Number($(this).attr('max_input'));
		if(max > 0) {
			var now = $(this).val().length;
			var str = '';
			if(now <= max) {
				str =  'あと'+(max - now)+'文字'
			} else {
				$(this).val($(this).val().substring(0, max));
				str =  'あと0文字'
			}

			var outId = $(this).attr('out_area');
			$('#'+outId).text(str);
		}
	}

	/**
	 * テキストボックス・テキストエリアの初期文字設定
	 * 初期文字時はondesクラスを付加。
	 * @param str [in] 初期文字
	 */
	$.fn.mySetDefaultStr = function(str) {
		var obj = $(this).filter('input[type=text], textarea')

		if(obj.val() == ''
		|| obj.val() == str) {
			obj.val(str).addClass('ondes');
		}

		obj
		.attr('defaultValue', str)
		.focus(function() {
			if($(this).val() == $(this).attr('defaultValue')) {
				$(this).val('');
			}
			$(this).removeClass('ondes');
		}).blur(function() {
			$(this).removeClass('ondes');
			if($(this).val() == '') {
				$(this).addClass('ondes').val($(this).attr('defaultValue'));
			}
		});
	}


})(jQuery)
