<script type="text/javascript"><!--
$(function() {
	function close() {
		parent.$.colorbox.close();
	}

	$('.close_popup').on('click', function(e) {
		close();
		return false;
	});

	var obj = document.getElementById('up_frame');
	if(document.all) {	//IE
		obj.onreadystatechange = function() {
			if (this.readyState == 'complete') {
				uploadResult(this.contentWindow.document);
			}
		}
	} else {
		obj.onload = function() {
			uploadResult(this.contentWindow.document);
		};
	}

	$('#upload_submit').on('click', function(e) {

		if($('#up_file').val()=='') {
			return false;
		}
		$('#upload_msg_area').show();
		$('.upload_info').hide();
		$('#act').submit();

		return false;
	});

	function uploadResult(obj) {
		if(obj && obj.body && obj.body.innerHTML) {
			var retStr = obj.body.innerHTML;
			if(retStr.indexOf('Success') >= 0) {
				var fileName = retStr.replace('Success:', '').replace(/[\n\r]/g, '');
				var filePath = '<?php
	echo '../../core_sys/sys/file/get_file.php?id='.$fileId.'&sub='.$subKey.'&add='.$addKey.'&r=2&type='.$fileType;
	echo '&f=';
	?>'+fileName;
				$('#file_view<?php echo $subKey?>',parent.document).show();
				$('#file_up<?php echo $subKey?>',parent.document).hide();
				$('input[name="file_name<?php echo $subKey?>"]',parent.document).val(fileName);
				$('input[name="file_operation<?php echo $subKey?>"]',parent.document).val(2);
				$('#file_view<?php echo $subKey?> .FileUpImg img',parent.document).attr('src', filePath).text(fileName);
				$('#file_view<?php echo $subKey?> .FileUpName a',parent.document).attr('href', filePath).text(fileName);
			} else {
				var msg = 'Unknown Error';
				if(retStr.indexOf('Error:') >= 0) {
					msg = retStr;
				}
				alert(msg);
			}
			close();
		}
	}
});
//-->
</script>
