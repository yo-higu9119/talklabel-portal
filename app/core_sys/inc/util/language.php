<?php
require_once dirname(__FILE__).'/../../../../common/inc/config/config.php';
require_once dirname(__FILE__).'/../../../../common/inc/data/data_access.php';

class CorebloLanguage {

	private static function &getPath() {
		$languagePathBase = dirname(__FILE__).'/../../language/';
		return $languagePathBase;
	}

	static function &getList() {
		$langDefineList = array(
			 'jp' => 'Japanese'
			,'en' => 'English'
			,'kr' => 'Korean'
			,'cn' => 'Chinese'
		);

		$languagePathBase = CorebloLanguage::getPath();
		foreach($langDefineList as $fileName => $name) {
			if(file_exists($languagePathBase.$fileName.'.php')) {
				$languageList[$fileName] = $name;
			}
		}

		return $languageList;
	}

	static function getStrToNumList() {
		$List = array(
			 'jp' => 1
			,'en' => 2
			,'kr' => 3
			,'cn' => 4
		);

		return $List;
	}

	static function getNumToStrList() {
		$List = array(
			 1 => 'jp'
			,2 => 'en'
			,3 => 'kr'
			,4 => 'cn'
		);

		return $List;
	}

	static function setLanguageType($languageType) {
		$languageList =& CorebloLanguage::getList();
		if(array_key_exists($languageType, $languageList) && $languageType !== 'jp') {
			$_SESSION['app_language'] = CorebloLanguage::_langType($languageType);
		} else {
			$_SESSION['app_language'] = CorebloLanguage::_langType('jp');
		}
		setcookie("coreblo_app_language", $_SESSION['app_language'], time()+315360000,"/");
	}

	static function getLanguageType() {
		$languageType = null;
		if(isset($_COOKIE['coreblo_app_language'])) {
			$_SESSION['app_language'] = $_COOKIE['coreblo_app_language'];
			$languageType = $_SESSION['app_language'];
		}else if(isset($_SESSION['app_language'])){
			$languageType = $_SESSION['app_language'];
		}
		if(is_null($languageType) || trim($languageType) == ""){
			$languageType = 'jp';
		}
		$languageType = CorebloLanguage::_langType($languageType);
		CorebloLanguage::setDefine($languageType);
	}

	static function getLanguageType_session() {
		$languageType = null;
		if(isset($_SESSION['app_language'])){
			$languageType = $_SESSION['app_language'];
		}else if(isset($_COOKIE['coreblo_app_language'])) {
			$_SESSION['app_language'] = $_COOKIE['coreblo_app_language'];
			$languageType = $_SESSION['app_language'];
		}
		if(is_null($languageType) || trim($languageType) == ""){
			$languageType = 'jp';
		}
		$languageType = CorebloLanguage::_langType($languageType);
		CorebloLanguage::setDefine($languageType);
	}

	static function getLanguageSelect() {
		$languageType = null;
		if(isset($_SESSION['app_language'])){
			$languageType = $_SESSION['app_language'];
		}else if(isset($_COOKIE['coreblo_app_language'])) {
			$languageType = $_COOKIE['coreblo_app_language'];
		}
		if(is_null($languageType) || trim($languageType) == ""){
			$languageType = 'jp';
		}
		$languageType = CorebloLanguage::_langType($languageType);
		return $languageType;
	}

	private static function _langType($languageType) {
		static $_languaeType = null;
		if(!is_null($languageType) && trim($languageType) !== ""){
			$_languaeType = $languageType;
		}
		if(is_null($_languaeType)){
			$_languaeType = 'jp';
			//CorebloLanguage::setLanguageType('jp');
		}
		return $_languaeType;
	}

	private static function setDefine($languageType) {
		$pathBase = CorebloLanguage::getPath();
		require_once $pathBase.$languageType.'.php';
	}

	static function isUsetLanguage() {
		$CorebloLanguageUtil = new CorebloLanguageUtil('');
		return $CorebloLanguageUtil->isUsetLanguage();
	}
}

class CorebloLanguageUtil extends DataAccessBase {

	function isUsetLanguage() {
		$rs = pg_query(self::$dbConn, 'SELECT use_language FROM system_info WHERE sys_no=1');
		if($rs === FALSE || pg_num_rows($rs) !== 1) {
			return 0;
		}
		$row = pg_fetch_array($rs, 0, PGSQL_ASSOC);
		return intval($row['use_language']);
	}
	
}
?>