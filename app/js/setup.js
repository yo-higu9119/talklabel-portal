document.ondragstart = function(){return false;};
$(function(){
  function scHBtn(o){
	var scMax = parseFloat($(o).find('.mCSB_draggerRail').css('width'));
	var scBar = $(o).find('.mCSB_dragger');
	var scBarWidth = parseFloat(scBar.css('width'));
	var scBarLeft = parseFloat(scBar.css('left'));
	if(scBarLeft == 0){$(o).addClass('scStart').removeClass('scroll')}else{$(o).removeClass('scStart').addClass('scroll')}
	if(scBarWidth + scBarLeft == scMax){$(o).addClass('scEnd').removeClass('scroll')}else{$(o).removeClass('scEnd').addClass('scroll')}
  }
  var gnav = [".gnavi ul",".catenavSl ul"];
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