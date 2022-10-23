<?php
require_once dirname(__FILE__).'/../../../../core_sys/inc/util/session.php';
$session = new Session();
require_once dirname(__FILE__).'/../../../../../common/inc/data/delivery_address.php';

$ret = array();
$sErr = "";

function getTags($info, $select_id){
	$is_select = ($info->id == $select_id)?' checked':'';
	if(IS_SMART_PHONE){
		$utilOpenFrame_prm = "20, 350, 600";
	}else{
		$utilOpenFrame_prm = "50, 800, 600";
	}
	if($info->is_basic == 0){
		$basic_class = "";
	
	}else{
		$basic_class = " addAreaDef";
	}

	$str =<<<"__LONG_STRRING__"
									<div class="addAreaInn clear_fix{$basic_class}">
										<p class="radio-toggle addSelect"><label><input type="radio" name="delivery_address_id" value="{$info->id}"{$is_select} /><span class="toggle-button unapproved">選択する</span></label>
										<div class="addDetail">
											<p class="addName">{$info->name}</p>
											<p class="addPost">{$info->zip}</p>
											<p class="addDet">{$info->area_name}{$info->add1}{$info->add2}</p>
											<p class="addTel">{$info->tel}</p>

__LONG_STRRING__;
	if($info->is_basic == 0){
		$str .=<<<"__LONG_STRRING__"
											<div class="clear_fix addBTArea">
												<p class="addBT BtM"><a href="javascript:void(0);" onclick="utilOpenFrame('./pop_add.php?id={$info->id}', false, {$utilOpenFrame_prm});" class="whBT">編集</a></p>
												<p class="addBT BtM"><a href="javascript:void(0);" onclick="utilOpenFrame('./pop_add_del.php?id={$info->id}', false, {$utilOpenFrame_prm});" class="whBT">削除</a></p>
											</div>

__LONG_STRRING__;
	}
	$str .=<<<"__LONG_STRRING__"
										</div>
									</div>

__LONG_STRRING__;
	return $str;
}

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	if($session->isLogin()){
		$json = file_get_contents("php://input");
		$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'); 
		$data = json_decode($json,true);
		if($data === NULL){
			$ret["status"] = "error";
		}else{
			if(!isset($data['select_id']) && trim($data['select_id']) == "" && !is_numeric($data['select_id'])){
				$sErr = "parameter error";
			}
			if($sErr == ""){
				$addressData = new DeliveryAddressData('');
				$List = $addressData->getList($session->getMemberId());
				$select_id = 0;
				if(intval($data['select_id']) == 0){
					$select_id = $addressData->getMin($session->getMemberId());
				}else{
					$select_id = intval($data['select_id']);
				}
				
				$ret["tags"] = "";
				if(count($List) !== 0){
					foreach($List as $info){
						$ret["tags"] .= getTags($info,$select_id);
					}
					$ret["status"] = "success";
				}else{
					$ret["status"] = "none";
				}
				if(IS_SMART_PHONE){
					$utilOpenFrame_prm = "20, 350, 600";
				}else{
					$utilOpenFrame_prm = "50, 800, 600";
				}
				$ret["tags"] .= <<<"__LONG_STRRING__"
									<div class="comBoxInn addAreaInn clear_fix">
										<div class="addAddition link_box">
											<p class="addAdditionTi">新しい住所を追加する</p>
											<p class="addAdditionIco">＋</p>
											<a href="javascript:void(0);" onclick="utilOpenFrame('./pop_add.php', false, {$utilOpenFrame_prm});">リンク</a>
										</div>
									</div>
__LONG_STRRING__;

			}else{
				$ret["status"] = "error";
			}
		}
	}else{
		$ret["status"] = "error";
	}
}else{
	$ret["status"] = "error";
}
echo json_encode($ret);
?>