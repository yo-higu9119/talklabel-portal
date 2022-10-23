//ポップアップウィンドウのクローズ処理
<!--
$(function() {
  function close() {
    parent.$.colorbox.close();
  }

  $('.close_popup').on('click', function(e) {
    close();
    return false;
  });
});
//-->
//日付カレンダー
$(function() {
	$(".datepicker").datepicker({
		onSelect: function () {
			$(this).datepicker("hide");
			$(this).parent().nextAll("input").focus();
		}
	});
});
//日付カレンダー(年月選択あり)
$(function() {
	$(".datepickerYM").datepicker({
		showButtonPanel: true,
		changeYear: true,
		changeMonth: true,
		yearRange: "-5:+3",
		onSelect: function () {
			$(this).datepicker("hide");
			$(this).parent().nextAll("input").focus();
		}
	});
});
//日付カレンダー(生年月日対応)
$(function() {
	$(".datepickerAge").datepicker({
		showButtonPanel: true,
		changeYear: true,
		changeMonth: true,
		yearRange: "-90:+0",
		onSelect: function () {
			$(this).datepicker("hide");
			$(this).parent().nextAll("input").focus();
		}
	});
});
//オープンクローズ処理
$(function() {
  $('.OCArea').each(function(i,e) {
    $(this).width($(this).width());
  });

  $('.slide_btn').on('click', function() {
    var id = String($(this).attr('id')).replace(/slide/, 'slideArea');
    var obj = $('#'+id);
    if(obj.is(':hidden')) {
      $(this).text('CLOSE').addClass('btn_close').removeClass('btn_open');
      obj.stop().slideDown('slow');
    } else {
      $(this).text('OPEN').addClass('btn_open').removeClass('btn_close');
      obj.stop().slideUp('slow');
    }
    return false;
  });

//  $('.OCArea').hide();
//  $('.slide_btn').text('OPEN').addClass('btn_open').removeClass('btn_close');
});

//ページトップスクロール
$(document).ready(function() {
    var pagetop = $('.pagetop');
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            pagetop.fadeIn();
        } else {
            pagetop.fadeOut();
        }
    });
    pagetop.click(function () {
        $('body, html').animate({ scrollTop: 0 }, 500);
        return false;
    });
});

//アンカーリンクスクロール
$(function(){
// #で始まるリンクをクリックしたら実行されます
	$('a[href^="#"]').click(function() {
		// スクロールの速度
		const speed = 500; // ミリ秒で記述
		const scrollFix = $('.scroll-fix');
		const spheader = $('#spheader');
		let topOffset = 0;
		if(spheader.length){
			topOffset = spheader.height();
		}else if(scrollFix.length){
			topOffset = scrollFix.eq(0).height();
		}
		const href= $(this).attr("href");
		const target = $(href == "#" || href == "" ? 'html' : href);
		const position = target.offset().top - topOffset;
		$('body,html').animate({scrollTop:position}, speed, 'swing');
		return false;
	});
});

//スクロールに合わせてのアニメーション効果
$(function() {
	$('.fadebox').css('opacity', 0);
	$('.fadebox').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
	  if (isInView) {
	    $(this).stop().animate({opacity: 1}, 600);
	  }
	  else {
	    $(this).stop().animate({opacity: 0}, 600);
	  }
	});

	$('.anmType1').on('inview', function(event, isInView) {
		if (isInView) {
		//表示領域に入った時
		$(this).addClass('fadeIn');
		} else {
	//表示領域から出た時
		$(this).removeClass('fadeIn');
		$(this).css('opacity',0); //非表示にしておく
		}
	});
	$('.anmType2').on('inview', function(event, isInView) {
		if (isInView) {
		$(this).addClass('bounceIn');
		} else {
		$(this).removeClass('bounceIn');
		}
	});
	$('.anmType3').on('inview', function(event, isInView) {
		if (isInView) {
		$(this).addClass('bounceInDown');
		} else {
		$(this).removeClass('bounceInDown');
		}
	});
	$('.anmType4').on('inview', function(event, isInView) {
		if (isInView) {
		$(this).addClass('rubberBand');
		} else {
		$(this).removeClass('rubberBand');
		}
	});
});

//toggleClass()でクリック時のクラスの付け外しを指示
$(function() {
 $('.drbtn').on('click', function () {
  $(this).toggleClass('action');
  $('.drawer').toggleClass('action');
 });
});

$(function() {
 $('.mobtn').on('click',function () {
  $('.modal-search').toggleClass('action');
  $('.overlay').toggleClass('action');
  $('.drbtn,.drawer').removeClass('action');
 });
 $('.overlay').on('click',function () {
   $(this).toggleClass('action');
   $('.modal-search').toggleClass('action');
 });
});

//ドロワー内のオープンクローズ
$(function(){
   $("ul.children").after("<span class='btn'></span>");
   $("ul.children").hide();
   $("ul .btn").on("click", function() {
     $(this).prev("ul").slideToggle();
     $(this).toggleClass("active");
   });
});

// ヘッダー追従
//scroll fix header
$(function () {
	"use strict";
	var flag = "view";
	$(window).on("scroll", function () {
		if ($(this).scrollTop() > 200) {
			if (flag === "view") {
				$(".scroll-fix").stop().css({opacity: '1.0'}).animate({
				top: 0
				}, 500);
			flag = "hide";
			}
			} else {
				if (flag === "hide") {
				$(".scroll-fix").stop().animate({top:"-100px",opacity: 0}, 500);
			flag = "view";
			}
		}
	});
});
// ヘッダースクロールカラー変更
jQuery(window).on('scroll', function () {
    if (200 < jQuery(this).scrollTop()) {
        jQuery('.scrFixed').addClass('change-color');
    } else {
        jQuery('.scrFixed').removeClass('change-color');
    }
});
// タブ切り替え横スライド
$(function() {
  var sliderList = $(".swipeList");
  var buttonList = $(".swipeListSelect");

  slider = [];

  for (var i = sliderList.length - 1; i >= 0; i--) {
    var thisSlider = sliderList.eq(i);
    slider[i] = thisSlider.bxSlider({
      pager: false,
      controls: false,
      oneToOneTouch: false,
      touchEnabled: true,
      adaptiveHeight: true,
      onSlideAfter: function($slideElement, oldIndex, newIndex){
        var crtSlider = $slideElement.parents(".swipeList");
        var crtSliderNumber = sliderList.index(crtSlider);
        console.log(crtSliderNumber);
        var thisButtonList = buttonList.eq(crtSliderNumber);
        thisButtonList.children().eq(oldIndex).find("button").removeClass("is-active");
        thisButtonList.children().eq(newIndex).find("button").addClass("is-active");
      }
    });
  }


  var button = $(".swipeListSelect li");
  button.on("click", function() {
    var thisParent = $(this).parent();
    var indexList = buttonList.index(thisParent);
    var index = thisParent.children().index(this);
    slider[indexList].goToSlide(index);
    return false;
  });
});
//タブ切り替えフェイド切り替え
jQuery(function($){
    $('.tabcontent > div').hide();
 
    $('.tabnav a').click(function () {
        $('.tabcontent > div').hide().filter(this.hash).fadeIn();
 
        $('.tabnav a').removeClass('active');
        $(this).addClass('active');
 
        return false;
    }).filter(':eq(0)').click();
});

//アコーディオン
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

//ドロップダウンメニュー(マイページ用)
$(function(){
    $('.dropdwn li').hover(function(){
        $("ul.dropdwn_menu:not(:animated)", this).slideDown();
    }, function(){
        $("ul.dropdwn_menu",this).slideUp();
    });
});
$(function(){
    $("ul.dropdwn_tap li").on({
        'click': function(){
            $("ul.dropdwn_menu_tap:not(:animated)",this).slideDown();
        },
        'dblclick': function(){
            $("ul.dropdwn_menu_tap:not(:animated)",this).slideUp();
        }
    });
});
//ドロップダウンメニュー(グローバル用)
$(function(){
	$(".gnavi ul.dropdown>li").hover(function(){
		$(this).children("nav").stop().slideToggle(200);
	});
});
//ドロップダウンメニュー(グローバルシンプル用)
$(function(){
	$(".gnavis ul.dropdown>li").hover(function(){
		$(this).children("nav").stop().slideToggle(200);
	});
});
//ドロップダウンメニュー(サブナビ用)
$(function(){
	$(".snavi ul.dropdown>li").hover(function(){
		$(this).children("nav").stop().slideToggle(200);
	});
});
//言語切替
function setLanguage(name,url){
	$.cookie('coreblo_app_language',name,{ expires: -1 });
	$.cookie('coreblo_app_language',name,{ expires: 3650, path:'/' });
	window.location = url;
}
//グローバルメニュー(横スクロール)
$(function(){
  function scHBtn(o){
	var scMax = parseFloat($(o).find('.mCSB_draggerRail').css('width'));
	var scBar = $(o).find('.mCSB_dragger');
	var scBarWidth = parseFloat(scBar.css('width'));
	var scBarLeft = parseFloat(scBar.css('left'));
	if(scBarLeft == 0){$(o).addClass('scStart').removeClass('scroll')}else{$(o).removeClass('scStart').addClass('scroll')}
	if(scBarWidth + scBarLeft == scMax){$(o).addClass('scEnd').removeClass('scroll')}else{$(o).removeClass('scEnd').addClass('scroll')}
  }
  var gnav = [".gnavi>nav>ul:not(.dropdown)",".catenavSl ul"];
  for( var i=0; i<gnav.length; i++){
    var gnavCrt = $(gnav[i] + " a.crt");
    if(gnavCrt.length == 1){
      gnavCrt.parent("li").addClass("CrtLi");
      var TabMenuCrtIndex = $(gnav[i] + " li.CrtLi").index();
      var gnaviCrtWidth = parseFloat(gnavCrt.css('width'));
      var setLeftPx = "-" + (TabMenuCrtIndex * gnaviCrtWidth) + "px";
    }else{
      var setLeftPx = 0; 
    }
    $(gnav[i]).mCustomScrollbar({
      axis:"x",
      setLeft: setLeftPx,
      autoHideScrollbar: false,
      mouseWheelPixels: 50,
      scrollInertia:0,
      scrollButtons:{ 
        enable: true,
        scrollAmount: 20,
        scrollType: "continuous"
      },
      contentTouchScroll:true,
      callbacks:{
        whileScrolling: function(){scHBtn($(this))}
      }
    });
    scHBtn($(gnav[i]));
  }
});
//画像ポップアップ
$(function() {
  $(".modal_img_single").colorbox({
    maxWidth:"90%",
    maxHeight:"90%",
    opacity: 0.7
  });
});
//アップロードボタン
$(function() {
	$('input').on('change', function () {
	    var file = $(this).prop('files')[0];
	    $('p.fileName').text(file.name);
	});
});
//全選択・解除のチェックボックス
$(function() {
	let checkbox_all = document.querySelector("#checkbox_all");
	//チェックボックスのリスト
	let checkbox_list = document.querySelectorAll(".checkbox_list");

	//全選択のチェックボックスイベント
	checkbox_all.addEventListener('change', change_all);

	function change_all() {

		//チェックされているか
		if (checkbox_all.checked) {
			//全て選択
			for (let i in checkbox_list) {
				if (checkbox_list.hasOwnProperty(i)) {
					checkbox_list[i].checked = true;
				}
			}
			
		} else {
			//全て解除
			for (let i in checkbox_list) {
				if (checkbox_list.hasOwnProperty(i)) {
					checkbox_list[i].checked = false;
				}
			}
			
		}
	};
});
