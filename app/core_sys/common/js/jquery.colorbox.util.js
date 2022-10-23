if (jQuery && jQuery.colorbox) {
	jQuery.colorbox.reloadOnClosedSettings = {
		reloadFunc: function() {location.reload(true);},
		needReloadParent: false,
		nextParentUrl: ''
	};
	jQuery.colorbox.reloadOnClosed = function(options) {
		var reloadOnClosedSettings = jQuery.colorbox.reloadOnClosedSettings;
		if (options === undefined) {
			reloadOnClosedSettings.needReloadParent = true;
			return;
		};
		if (options.needReloadParent === true || options.needReloadParent === false) {
			reloadOnClosedSettings.needReloadParent = options.needReloadParent;
		}
		if (options.reloadFunc && (typeof options.reloadFunc === "function")) {
			reloadOnClosedSettings.reloadFunc = options.reloadFunc;
		} else if (options.reloadFunc === null) {
			reloadOnClosedSettings.reloadFunc = null;
		}
	};
	jQuery.colorbox.setNextUrlOnClosed = function(url) {
		var reloadOnClosedSettings = jQuery.colorbox.reloadOnClosedSettings;
		reloadOnClosedSettings.nextParentUrl = url;
	}
	jQuery(document).on('cbox_open', function(){
		jQuery.colorbox.reloadOnClosedSettings.needReloadParent = false;
		jQuery.colorbox.reloadOnClosedSettings.nextParentUrl = '';
	});
	jQuery(document).on('cbox_closed', function(){
		var reloadOnClosedSettings = jQuery.colorbox.reloadOnClosedSettings;
		if (reloadOnClosedSettings.needReloadParent === true && reloadOnClosedSettings.reloadFunc && (typeof reloadOnClosedSettings.reloadFunc === "function")) {
			reloadOnClosedSettings.reloadFunc();
		}
		if (reloadOnClosedSettings.nextParentUrl !== '') {
			location.href = reloadOnClosedSettings.nextParentUrl;
		}
	});
}

var isUtilResize = false;
function utilOpenFrame(url, isLink, top, width, height, isReload) {
	if(isLink) {
		location.href = url;
	} else {
		if(arguments.length===2) {
			isUtilResize = true;
			$.colorbox({
				 iframe: true
				,href: addFrameType(url)
				,closeButton: false
				,overlayClose: false
				,scrolling: false
				,opacity: 0.85
				,speed: 100
				,fadeOut: 100
				,innerWidth: 32
				,innerHeight: 32
				,fastIframe: false
			});
		} else {
			$.colorbox({
				 iframe: true
				,href: url
				,closeButton: false
				,overlayClose: false
				,top: top
				,width: width
				,height: height
				,fixed: true
				,maxWidth: '90%'
				,maxHeight: '90%'
				,onClosed: function() {
					if(isReload) {
						location.reload(true);
					}
				}
			});
		}
	}
}

function utilPostFrame(url, isLink, paramList, top, width, height) {
	if(isLink) {
		var obj = $('<form />', {action: url, method: 'post'});
		for(var i in paramList) {
			obj.append($('<input />', {type: 'hidden', name: i, value: paramList[i]}));
		}
		obj.appendTo(document.body).submit();
	} else {
		if(arguments.length===3) {
			isUtilResize = true;
			$.colorbox({
				 iframe: true
				,href: '../../common/dummy/dummy.php'
				,closeButton: false
				,overlayClose: false
				,scrolling: false
				,opacity: 0.85
				,speed: 100
				,fadeOut: 100
				,innerWidth: 32
				,innerHeight: 32
				,fastIframe: false
				,onComplete: function() {
					setTimeout(function() {
						$('.cboxIframe')[0].contentWindow.name = $('.cboxIframe').attr('name');
						var obj = $('<form />', {action: addFrameType(url), method: 'post', target: $('.cboxIframe').attr('name')});
						for(var i in paramList) {
							obj.append($('<input />', {type: 'hidden', name: i, value: paramList[i]}));
						}
						obj.appendTo(document.body).submit();
					}, 200);
				}
			});
		} else {
			$.colorbox({
				 iframe: true
				,href: '../../common/dummy/dummy.php'
				,closeButton: false
				,overlayClose: false
				,top: top
				,width: width
				,height: height
				,fixed: true
				,maxWidth: '90%'
				,maxHeight: '90%'
				,onComplete: function() {
					setTimeout(function() {
						$('.cboxIframe')[0].contentWindow.name = $('.cboxIframe').attr('name');
						var obj = $('<form />', {action: url, method: 'post', target: $('.cboxIframe').attr('name')});
						for(var i in paramList) {
							obj.append($('<input />', {type: 'hidden', name: i, value: paramList[i]}));
						}
						obj.appendTo(document.body).submit();
					}, 200);
				}
			});
		}
	}
}

function addFrameType(url) {
	if(url.indexOf('?') >= 0) {
		url += '&onif=1';
	} else {
		url += '?onif=1';
	}
	return url;
}
