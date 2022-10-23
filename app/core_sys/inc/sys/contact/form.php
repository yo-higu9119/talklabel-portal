<?php
	if($info->formId > 0){
		$comReq = true;
		$inquiryNo = $info->formId;
		require_once dirname(__FILE__).'/form_inner.php';
	}
?>
