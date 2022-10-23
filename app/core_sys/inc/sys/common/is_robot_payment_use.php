<?php
	$systemData = new SystemData('');
	$systemInfo = $systemData->getInfo();
	if($systemInfo->card_type == 3){/* ROBOT PAYMENT */
		require_once dirname(__FILE__).'/../../../../../common/inc/data/input_function.php';
		$inputFuncData = new InputFunctionData('');
		$myBaseNo = 1;
		$inputFuncInfoList = $inputFuncData->getInfoList($myBaseNo,false,false);
		$fInfo = null;
		foreach($inputFuncInfoList['base'] as $funcInfo) {
			if($funcInfo->fixed !== 0 && $funcInfo->type == 10){
				$fInfo = $funcInfo;
				break;
			}
		}
		unset($inputFuncInfoList);
		if(is_null($fInfo)){
			$sErr = '会員基本情報「電話番号フィールド」が存在しません。';
		}else{
			if($fInfo->system_use != 1 || $fInfo->use != 1 || $fInfo->required != 1){
				$sErr = '会員基本情報「電話番号フィールド」の「管理画面での利用」または「項目状態（会員編集FORM）」が、有効になっていません。「管理画面での利用」または「項目状態（会員編集FORM）」を有効にしてください。ロボットペイメントで決済を行うには電話番号が必須です。';
			}
		}
	}
?>