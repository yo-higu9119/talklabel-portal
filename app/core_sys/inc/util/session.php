<?php
require_once dirname(__FILE__).'/sms_ip_control.php';

//$_cp = session_get_cookie_params();
//session_set_cookie_params($_cp['lifetime'], $_cp['path'] . '; SameSite=None', $_cp['domain'], true, true);

if(!isset($_SESSION)) {
	session_start();
}

require_once dirname(__FILE__).'/language.php';
if(CorebloLanguage::isUsetLanguage() == 1){
	$tmp_lang = "";
	if(isset($_GET['language'])){
		$langList = CorebloLanguage::getNumToStrList();
		if (array_key_exists(intval($_GET['language']),$langList)) {
			CorebloLanguage::setLanguageType($langList[$_GET['language']]);
			$tmp_lang = "get";
		}
	}else if(isset($_POST['language'])){
		$langList = CorebloLanguage::getStrToNumList();
		if (array_key_exists($_POST['language'],$langList)) {
			CorebloLanguage::setLanguageType($_POST['language']);
		}
	}
	if($tmp_lang == "get"){
		CorebloLanguage::getLanguageType_session();
	}else{
		CorebloLanguage::getLanguageType();
	}
}else{
	CorebloLanguage::setLanguageType('jp');
	CorebloLanguage::getLanguageType();
}

require_once dirname(__FILE__).'/../../../../common/inc/data/system_info.php';
require_once dirname(__FILE__).'/../../../../common/inc/data/member_data.php';
require_once dirname(__FILE__).'/../../../../common/inc/util/util.php';
require_once dirname(__FILE__).'/../../../../common/inc/util/form_util.php';
require_once dirname(__FILE__).'/html_parts.php';
require_once dirname(__FILE__).'/html_parts_sys_meta.php';
require_once dirname(__FILE__).'/html_parts_article.php';
require_once dirname(__FILE__).'/html_parts_seminar.php';
require_once dirname(__FILE__).'/html_parts_product.php';
require_once dirname(__FILE__).'/html_parts_board.php';

$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();
if($systemInfo->app_login_type == 0){
	$systemInfo->setS3_CF_setcookie();
}

class Session {
	function __construct($isTop=false){
		$systemData = new SystemData('');
		$systemInfo = $systemData->getInfo();
		if($isTop){
			define('SYSTEM_TOP_URL', $systemInfo->public_url);
		}else{
			define('SYSTEM_TOP_URL', '../../');
		}
		define('SYSTEM_URL', $systemInfo->public_url);
		define('SYSTEM_LOGIN_REDIRECT_URL', $systemInfo->public_url.$systemInfo->login_redirect_url);
		$user_agent = isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'';
		define('IS_SMART_PHONE', Util::isSmartPhone($user_agent));
		define('SYSTEM_ACCESS_DATETIME', date("?YmdHis"));
	}

	function login($account, $password) {
		if(isset($_SESSION['App'])){
			$_SESSION['App'] = array();
		}
		$memberData = new MemberData('');
		$memberId = $memberData->getLoginId($account, $password);
		session_regenerate_id();
		$_SESSION['App']['NowSessionId'] = session_id();

		$loginLogData = new appLoginLogData('');

		if($memberId > 0) {
			$memberData->updateLastLogin($memberId);
			$_SESSION['App']['MemberId'] = $memberId;
			$_SESSION['App']['MemberName'] = $memberData->getName($memberId);
			$_SESSION['App']['MemberNumber'] = $memberData->getAC($memberId);
			$_SESSION['App']['Purchased'] = $memberData->getPurchasedIdList($memberId);
			$_SESSION['App']['ApplyService'] = $memberData->getAppyServiceIdList($memberId);
			$_SESSION['App']['NowSessionId'] = session_id();
// 			if(isset($_POST['type'])){
// 				if($_POST['type'] === "ct"){
// 					header('Location: '.SYSTEM_TOP_URL.'mypage/cart/');
// 					exit();
// 				}
// 			}

			$loginLogData->setLoginLog($memberData->getName($memberId),$memberData->getAC($memberId), 0);

			$systemData = new SystemData('');
			$systemInfo = $systemData->getInfo();
			$systemInfo->setS3_CF_setcookie();
			
			if(isset($_POST["isLogin"])){
				setcookie(Config::DB_NAME."_id", $account, time()+315360000,"/");
				setcookie(Config::DB_NAME."_password", $password, time()+315360000,"/");
				setcookie(Config::DB_NAME."_is_login", true, time()+315360000,"/");
			}
			
			if($systemInfo->pay_setting == 0 && count($_SESSION['App']['Purchased']) == 0){
				$loginLogData->setLoginLog($memberData->getName($memberId),$memberData->getAC($memberId), 3);
				$_SESSION['App'] = array();
				return Util::dispLang(Language::WORD_00080);/*IDまたはパスワードが違います。*/
			}else{
				return '';
			}
		} else {
			$loginLogData->setLoginLog('不明','不明', 1, $account, $password);
			return Util::dispLang(Language::WORD_00080);/*IDまたはパスワードが違います。*/
		}
	}

	function loginMemId($member_id) {
		if(isset($_SESSION['App'])){
			$_SESSION['App'] = array();
		}
		$memberData = new MemberData('');
		$memberId = $memberData->getLoginMemId($member_id);
		session_regenerate_id();
		$_SESSION['App']['NowSessionId'] = session_id();

		$loginLogData = new appLoginLogData('');

		if($memberId > 0) {
			$memberData->updateLastLogin($memberId);
			$_SESSION['App']['MemberId'] = $memberId;
			$_SESSION['App']['MemberName'] = $memberData->getName($memberId);
			$_SESSION['App']['MemberNumber'] = $memberData->getAC($memberId);
			$_SESSION['App']['Purchased'] = $memberData->getPurchasedIdList($memberId);
			$_SESSION['App']['ApplyService'] = $memberData->getAppyServiceIdList($memberId);
			$_SESSION['App']['NowSessionId'] = session_id();

			$loginLogData->setLoginLog($memberData->getName($memberId),$memberData->getAC($memberId), 0);

			$systemData = new SystemData('');
			$systemInfo = $systemData->getInfo();
			$systemInfo->setS3_CF_setcookie();
			
			if($systemInfo->pay_setting == 0 && count($_SESSION['App']['Purchased']) == 0){
				$loginLogData->setLoginLog($memberData->getName($memberId),$memberData->getAC($memberId), 3);
				$_SESSION['App'] = array();
				return Util::dispLang(Language::WORD_00080);/*IDまたはパスワードが違います。*/
			}else{
				return '';
			}
		} else {
			$loginLogData->setLoginLog('不明','不明', 1, $account, $password);
			return Util::dispLang(Language::WORD_00080);/*IDまたはパスワードが違います。*/
		}
	}

	function loginACId($acId) {
		if(isset($_SESSION['App'])){
			$_SESSION['App'] = array();
		}

		$memberData = new MemberData('');
		$memberId = $memberData->getLoginACId($acId);
		$_SESSION['App']['NowSessionId'] = session_id();

		if($memberId > 0) {
			$memberData->updateLastLogin($memberId);
			$_SESSION['App']['MemberId'] = $memberId;
			$_SESSION['App']['MemberName'] = $memberData->getName($memberId);
			$_SESSION['App']['MemberNumber'] = $memberData->getAC($memberId);
			$_SESSION['App']['Purchased'] = $memberData->getPurchasedIdList($memberId);
			$_SESSION['App']['ApplyService'] = $memberData->getAppyServiceIdList($memberId);
			$_SESSION['App']['NowSessionId'] = session_id();

			$systemData = new SystemData('');
			$systemInfo = $systemData->getInfo();
			if($systemInfo->pay_setting == 0 && count($_SESSION['App']['Purchased']) == 0){
				$_SESSION['App'] = array();
				return false;
			}else{
				return true;
			}
		} else {
			return false;
		}
	}

	function loginFBId($fbId) {
		if(isset($_SESSION['App'])){
			$_SESSION['App'] = array();
		}

		$memberData = new MemberData('');
		$memberId = $memberData->getLoginFBId($fbId);
		session_regenerate_id();
		$_SESSION['App']['NowSessionId'] = session_id();
		
		if($memberId > 0) {
			$memberData->updateLastLogin($memberId);
			$_SESSION['App']['MemberId'] = $memberId;
			$_SESSION['App']['MemberName'] = $memberData->getName($memberId);
			$_SESSION['App']['MemberNumber'] = $memberData->getAC($memberId);
			$_SESSION['App']['Purchased'] = $memberData->getPurchasedIdList($memberId);
			$_SESSION['App']['ApplyService'] = $memberData->getAppyServiceIdList($memberId);
			$_SESSION['App']['NowSessionId'] = session_id();
			
			$systemData = new SystemData('');
			$systemInfo = $systemData->getInfo();
			if($systemInfo->pay_setting == 0 && count($_SESSION['App']['Purchased']) == 0){
				$_SESSION['App'] = array();
				$_SESSION['App']['Message'] = Util::dispLang(Language::WORD_00082);/*Facebookアカウントに紐付けされていません。*/
				return false;
			}else{
				return true;
			}
		} else {
			$_SESSION['App']['Message'] = Util::dispLang(Language::WORD_00081);/*会員が登録されていません。*/
			return false;
		}
	}

	function loginLINEId($lineId) {
		if(isset($_SESSION['App'])){
			$_SESSION['App'] = array();
		}

		$memberData = new MemberData('');
		$memberId = $memberData->getLoginLINEId($lineId);
		session_regenerate_id();
		$_SESSION['App']['NowSessionId'] = session_id();
		
		if($memberId > 0) {
			$memberData->updateLastLogin($memberId);
			$_SESSION['App']['MemberId'] = $memberId;
			$_SESSION['App']['MemberName'] = $memberData->getName($memberId);
			$_SESSION['App']['MemberNumber'] = $memberData->getAC($memberId);
			$_SESSION['App']['Purchased'] = $memberData->getPurchasedIdList($memberId);
			$_SESSION['App']['ApplyService'] = $memberData->getAppyServiceIdList($memberId);
			$_SESSION['App']['NowSessionId'] = session_id();
			
			$systemData = new SystemData('');
			$systemInfo = $systemData->getInfo();
			if($systemInfo->pay_setting == 0 && count($_SESSION['App']['Purchased']) == 0){
				$_SESSION['App'] = array();
				$_SESSION['App']['Message'] = Util::dispLang(Language::WORD_00083);/*LINEアカウントに紐付けされていません。*/
				return false;
			}else{
				return true;
			}
		} else {
			$_SESSION['App']['Message'] = Util::dispLang(Language::WORD_00081);/*会員が登録されていません。*/
			return false;
		}
	}

	function check() {
		if(!isset($_SESSION)
		|| empty($_SESSION['App']['MemberId'])
		|| $_SESSION['App']['NowSessionId'] !== session_id()) {
			$_SESSION['App'] = array();
			$_SESSION['redirectURL'] = (empty($_SERVER['HTTPS'])?'http://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			
			if(isset($_COOKIE[Config::DB_NAME."_is_login"])){
				if(isset($_COOKIE[Config::DB_NAME."_id"])){
					$account = $_COOKIE[Config::DB_NAME."_id"];
				}else{
					$account = "";
				}
				if(isset($_COOKIE[Config::DB_NAME."_password"])){
					$password = $_COOKIE[Config::DB_NAME."_password"];
				}else{
					$password = "";
				}
				if($account !== "" && $password !== ""){
					$message = $this->login($account, $password );
					if($message === '') {
						return true;
					}
				}
			}
			
			header('Location: '.SYSTEM_TOP_URL.'users/login/index.php');
			exit();
		}
	}

	function delete() {
		$loginLogData = new appLoginLogData('');
		$loginLogData->setLoginLog($this->getMemberName(),$this->getMemberNumber(), 2);
		
		$_SESSION['App'] = array();
		setcookie(Config::DB_NAME."_id", "", time() - 1800,"/");
		setcookie(Config::DB_NAME."_password", "", time() - 1800,"/");
		setcookie(Config::DB_NAME."_is_login", "", time() - 1800,"/");
		
		$systemData = new SystemData('');
		$systemInfo = $systemData->getInfo();
		$systemInfo->setS3_CF_delcookie();
		
		$_SESSION['App']['Message'] = Util::dispLang(Language::WORD_00084);/*ログアウトしました。*/
	}

	function isLogin() {
		if(!isset($_SESSION['App'])
		|| empty($_SESSION['App']['MemberId'])
		|| $_SESSION['App']['NowSessionId'] !== session_id()) {
			return false;
		} else {
			return true;
		}
	}

	function getMemberId() {
		if($this->isLogin()) {
			return intval($_SESSION['App']['MemberId']);
		} else {
			return 0;
		}
	}
	function getMemberName() {
		if($this->isLogin()) {
			$memberData = new MemberData('');
			$_SESSION['App']['MemberName'] = $memberData->getName($this->getMemberId());
			return $_SESSION['App']['MemberName'];
		} else {
			return '';
		}
	}
	function getMemberNickname() {
		if($this->isLogin()) {
			$memberData = new MemberData('');
			$_SESSION['App']['MemberNickname'] = $memberData->getNickname($this->getMemberId());
			return $_SESSION['App']['MemberNickname'];
		} else {
			return '';
		}
	}
	function getMemberVeto() {
		if($this->isLogin()) {
			$memberData = new MemberData('');
			$_SESSION['App']['Memberveto'] = $memberData->getComVeto($this->getMemberId());
			return $_SESSION['App']['Memberveto'];
		} else {
			return 0;
		}
	}
	function getMemberAuthority() {
		if($this->isLogin()) {
			$memberData = new MemberData('');
			$_SESSION['App']['Authority'] = $memberData->getAuthority($this->getMemberId());
			return $_SESSION['App']['Authority'];
		} else {
			return 0;
		}
	}
	function getMemberImage() {
		if($this->isLogin()) {
			$memberData = new MemberData('');
			return $memberData->getImage($this->getMemberId());
		} else {
			return '';
		}
	}
	function getMemberNumber() {
		if($this->isLogin()) {
			$memberData = new MemberData('');
			$_SESSION['App']['MemberNumber'] = $memberData->getAC($this->getMemberId());
			return $_SESSION['App']['MemberNumber'];
		} else {
			return '';
		}
	}
	function getMemberPassword() {
		if($this->isLogin()) {
			$memberData = new MemberData('');
			return $memberData->getPassword($this->getMemberId());
		} else {
			return '';
		}
	}
	function getMemberPurchased() {
		if($this->isLogin()) {
			$memberData = new MemberData('');
			$_SESSION['App']['Purchased'] = $memberData->getPurchasedIdList($this->getMemberId());
			return $_SESSION['App']['Purchased'];
		} else {
			return '';
		}
	}
	function getMemberPurchaseBuyList() {
		if($this->isLogin()) {
			$memberData = new MemberData('');
			return $memberData->getPurchasedBuyList($this->getMemberId());
		} else {
			return array();
		}
	}
	function getMemberApplyService() {
		if($this->isLogin()) {
			$memberData = new MemberData('');
			$_SESSION['App']['ApplyService'] = $memberData->getAppyServiceIdList($this->getMemberId());
			return $_SESSION['App']['ApplyService'];
		} else {
			return '';
		}
	}
	function getMemberStatus() {
		if($this->isLogin()) {
			$memberData = new MemberData('');
			$SYS_MemBuyList = $memberData->getPurchasedIdList($this->getMemberId());
			$status = (count($SYS_MemBuyList) == 0)?Util::dispLang(Language::WORD_00085)/* 無料会員 */:Util::dispLang(Language::WORD_00086)/* 有料会員 */;
			return $status;
		} else {
			return '';
		}
	}

	function getSessionMsg() {
		if(!isset($_SESSION['App'])
		|| !isset($_SESSION['App']['Message'])
		|| trim($_SESSION['App']['Message'])===''
		|| $_SESSION['App']['NowSessionId'] !== session_id()) {
			return '';
		} else {
			return htmlspecialchars($_SESSION['App']['Message']);
		}
	}
	function clearSessiomMsg() {
		unset($_SESSION['App']['Message']);
	}

	/* リマインダー時 */
	function createReminderSession($mailAddress) {
		$_SESSION['App'] = array();
		if(trim($mailAddress) === '') {
			return Util::dispLang(Language::WORD_00087);/*入力してください。*/
		}

		$memberData = new MemberData('');
		$memberId = $memberData->getReminderMemberId($mailAddress);
		if($memberId > 0) {
			session_regenerate_id();
			$_SESSION['App']['MemberTmpId'] = $memberId;
			$_SESSION['App']['NowSessionId'] = session_id();
			return $memberId;
		} else {
			return 0;
		}
	}

	function checkReminderSession() {
		if(!isset($_SESSION['App'])
		|| empty($_SESSION['App']['MemberTmpId'])
		|| $_SESSION['App']['NowSessionId'] !== session_id()) {
			$_SESSION['App'] = array();
			header('Location: '.SYSTEM_TOP_URL.'users/login/index.php');
			exit();
		}
	}

	function getReminderSessenMemberId() {
		if(!isset($_SESSION['App'])
		|| empty($_SESSION['App']['MemberTmpId'])
		|| $_SESSION['App']['NowSessionId'] !== session_id()) {
			return 0;
		} else {
			return intval($_SESSION['App']['MemberTmpId']);
		}
	}

	function reminderLogin($memberTmpId, $tmpPassword) {
		// 仮パスワードセッションから本セッションに変更
		require_once dirname(__FILE__).'/../../../../common/inc/data/tmp_password.php';
		$tmpPasswordData = new TmpPasswordData('');
		$memberId = $tmpPasswordData->getMemberId($memberTmpId, $tmpPassword);
		if($memberId > 0) {
			$tmpPasswordData->delete($memberId);
			$memberData = new MemberData('');
			unset($_SESSION['App']['MemberTmpId']);
			session_regenerate_id();
			$_SESSION['App']['MemberId'] = $memberId;
			$_SESSION['App']['NowSessionId'] = session_id();
			$_SESSION['App']['Purchased'] = $memberData->getPurchasedIdList($memberId);
			$_SESSION['App']['ApplyService'] = $memberData->getAppyServiceIdList($memberId);
			$_SESSION['App']['MemberName'] = $memberData->getName($memberId);
			$_SESSION['App']['MemberNumber'] = $memberData->getAC($memberId);
			
			return true;
		} else {
			return false;
		}
	}

	function getErrorMsg() {
		$msg = '';
		if(isset($_SESSION['App']['Message'])) {
			$msg = htmlspecialchars($_SESSION['App']['Message']);
			unset($_SESSION['App']['Message']);
		}
		return $msg;
	}

	function setOutArgument() {
		$_SESSION['outer'] = array();
		for($i=1;$i<=10;$i++){
			if(isset($_GET['ex'.$i])) {
				$_SESSION['outer']['ex'.$i] = $_GET['ex'.$i];
			}else{
				$_SESSION['outer']['ex'.$i] = '';
			}
		}
	}
	
	/* 外部変数用プロパティ $info->out_ex1～$info->out_ex10がある場合のみ利用可能 */
	function getOutArgument($info) {
		if(isset($_SESSION['outer'])){
			for($i=1;$i<=10;$i++){
				if(isset($_SESSION['outer']['ex'.$i])) {
					$tmp = $_SESSION['outer']['ex'.$i];
					$str = '$info->out_ex'.$i.' = $tmp;';
					eval($str);
				}else{
					$str = '$info->out_ex'.$i.' = \'\';';
					eval($str);
				}
			}
		}
		unset($_SESSION['outer']);
		return $info;
	}
	
	function getCartNum() {
		$cart_name = 'app_cart';
		if(isset($_SESSION[$cart_name]) && is_array($_SESSION[$cart_name]) && count($_SESSION[$cart_name]) > 0){
			$totav_val = 0;
			foreach($_SESSION[$cart_name] as $val){
				$totav_val += intval($val);
			}
			if($totav_val > 0){
				return sprintf("%d",$totav_val);
			}else{
				return '';
			}
		}else{
			return '';
		}
	}
	
	function displayCartNum() {
		$val = $this->getCartNum();
		if($val != ""){
			return '<span class="PrdCntDisp">'.$this->getCartNum().'</span>';
		}else{
			return '';
		}
	}

	function isNativeApp() {
		if(isset($_SESSION['App']) && isset($_SESSION['App']['isNativeApp'])) {
			if($_SESSION['App']['isNativeApp'] == 'app'){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

}

/*
暫定でパーツ毎に定義されている関数を転記
*/
/* 元ファイル：app/system_parts/system_block/common/parts/con_tagsearch_box.php */
function display_tag_list($session,$group_id=1,$category_id=-2,$sort_type=3){
	require_once dirname(__FILE__).'/../../../../common/inc/data/category.php';/* 転記時に階層を一つ上にしています */
	$categoryData = new CategoryData($session->getMemberName());
	$searchInfoList = array();
	$searchInfoList['search_category_group_id'] = $group_id;
	$searchInfoList['search_parent_category_id'] = $category_id;
	$searchInfoList['is_disp'] = true;

	$systemData = new SystemData('');
	$systemInfo = $systemData->getInfo();
	if($systemInfo->use_authority_group == 1){
		$searchInfoList['search_x_view_authority'] = $session->getMemberId();
	}
	if($systemInfo->use_language == 1){
		$StrToNumList = CorebloLanguage::getStrToNumList();
		if(isset($_SESSION['app_language'])){
			$langKey = $_SESSION['app_language'];
			$langId = array_key_exists($langKey,$StrToNumList)?$StrToNumList[$langKey]:0;
		}else{
			$langId = 0;
		}
		$searchInfoList['search_x_view_language'] = $langId;
	}

	$categoryTagList = $categoryData->getInfoList($searchInfoList, $sort_type);

	if(count($categoryTagList) > 0){
?>
	<div class="tagSearch">
		<h3 class="tagSearchTi"><?php echo Util::dispLang(Language::WORD_00212);/*タグ検索*/?></h3>
		<section class="tagSearchInn">
<?php if (IS_SMART_PHONE) { ?>
<?php } else { ?>
		    <input id="trigger1" class="grad-trigger" type="checkbox">
		    <label class="grad-btn" for="trigger1" data-open="<?php echo Util::dispLang(Language::WORD_00605);/*もっと見る*/?>" data-close="<?php echo Util::dispLang(Language::WORD_00715);/*閉じる*/?>"></label>
<?php } ?>
			<ul class="tagLink clear_fix">
<?php
		foreach($categoryTagList as $categoryInfo) {
			if($categoryInfo->isDisp && $categoryInfo->isDisp($session->isLogin(), $session->getMemberPurchased(), $session->getMemberId())) {
?>
				<li><a href="<?php echo SYSTEM_TOP_URL; ?>contents/main/tag_list.php?c=<?php echo $categoryInfo->id; ?>"><?php echo $categoryInfo->name; ?></a></li>
<?php
			}
		}
?>
			</ul>
		</section>
	</div>
<?php
	}
}

?>