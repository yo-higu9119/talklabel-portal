<?php
$inputFuncData = new InputFunctionData('');
$masterBaseData = new MasterBaseData('');
$memberData = new MemberData('会員本人');
$memberData->setBaseNo(1,false,false,array(),true);
$itemData = new ItemData("");
$purchaseData = new PurchaseData("");
$purchaseChData = new PurchaseChData("");

if(isset($_POST['mode'])) {
	$mode = $_POST['mode'];
}else{
	$mode = "input";
}
$SYS_Message = '';
$SYS_Result = array();
$SYS_MemInfo = $memberData->getInfo(0);
if(isset($_POST['mode']) && $mode != "input") {
	$SYS_MemInfo = $memberData->getInputValue($SYS_MemInfo);
	$SYS_MemInfo->base_no = 1;
	$SYS_Result = $memberData->check($SYS_MemInfo);
	if(count($SYS_Result) === 0) {
		if($mode == "save"){
			$isPostClear = false;
			$SYS_MemInfo = $session->getOutArgument($SYS_MemInfo);
			$id = $memberData->insert($SYS_MemInfo);
			if($id > 0) {
				$memberData->setBaseNo(1);
				$SYS_MemInfo = $memberData->getInfo($id);
				$SYS_Message = Util::dispLang(Language::WORD_00111);/*新規登録が完了しました*/

				/* ログイン */
				$_SESSION['App']['MemberId'] = $SYS_MemInfo->id;
				$_SESSION['App']['NowSessionId'] = session_id();
				$_SESSION['App']['Purchased'] = $memberData->getPurchasedIdList($SYS_MemInfo->id);

				/* 紹介処理 */
				if(isset($_SESSION['Referral'])){
					$parentMemInfo = $memberData->getInfo(intval($_SESSION['Referral']));
					if($parentMemInfo->id > 0){
						require_once dirname(__FILE__).'/../../../../../common/inc/data/member_rank_data.php';
						$rewardInfoData = new RewardInfoData($session->getMemberName());
						$rewardInfoData->regist($parentMemInfo->id,$SYS_MemInfo->id);
					}
					unset($_SESSION['Referral']);
				}

				/* メール送信 */
				require_once dirname(__FILE__).'/../../../../../common/inc/util/my_mail_util.php';
				$myMailUtil = new MyMailUtil();
				$result = $myMailUtil->send(1, $memberData->getInfoData($SYS_MemInfo,true));
				if($result > 0) {
					header('Location: ./save.php');
					exit();
				} else {
					$message = Util::dispLang(Language::WORD_00112).'('.$result.')';/* メールの送信に失敗しました。 */
				}

				$isPostClear = true;
				$mode = "end";
			} else {
				$SYS_Message = Util::dispLang(Language::WORD_00113);/*登録に失敗しました*/
				$mode = "input";
			}

			if($isPostClear){
				$_POST = array();
			}
		}else{
			$mode = "check";
		}
	} else {
		$SYS_Message = Util::dispLang(Language::WORD_00114);/*入力内容に間違いがあります*/
		$mode = "input";
	}
}else{
	$mode = "input";
	$session->setOutArgument();
	if(isset($_GET['ref'])){
		$ref = $memberData->getReferral(1, $_GET['ref']);
		if($ref > 0){
			$_SESSION['Referral'] = $ref;
		}
	}
}
?>
