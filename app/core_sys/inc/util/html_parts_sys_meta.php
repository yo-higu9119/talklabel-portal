<?php
class HtmlPartsSysMeta {
	/**
	 * 各ページ共通仕様にてtitle、metsタグの表示を行う
	 * @param array $settings 表示設定
	 *     title           ：こにタイトルとサイト名が表示されます。
	 *     description     ：ここにディスクリプションが入ります。
	 *     keywords        ：ここにキーワードが入ります。
	 *     og:title        ：ページのタイトル
	 *     og:type         ：ページの種類
	 *     og:url          ：ページのURL
	 *     og:image        ：サムネイル画像のURL
	 *     og:site_name    ：サイト名
	 *     og:description  ：ページのディスクリプション
	 *     twitter:card    ：twitter:card
	 *     twitter:site    ：twitter:site
	 *     twitter:creator ：twitter:creator
	 * @param $addTitleStr タイトルへの追加文字列
	 */
	static function printSysMeta($settings, $addTitleStr="") {
		$systemData = new SystemData('');
		$info = $systemData->getPublicInfo();
		$defaultSettings = Array(
			'title' => (($addTitleStr !== "")?$addTitleStr." | ":"").$info["name"]
			,'description' => ""
			,'keywords' => ""
			,'og:title' => (($addTitleStr !== "")?$addTitleStr." | ":"").$info["name"]
			,'og:type' => "website"
			,'og:url' => htmlspecialchars((empty($_SERVER["HTTPS"])?"http://" : "https://").$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])
			,'og:image' => ""
			,'og:site_name' => $info["name"]
			,'og:description' => ""
			,'twitter:card' => ""
			,'twitter:site' => ""
			,'twitter:creator' => ""
		);
		$settings = array_merge($defaultSettings, $settings);

		if($settings['title'] !== "") {
?>
<title><?php echo $settings['title']; ?></title>
<?php
		}
		if($settings['description'] !== "") {
?>
<meta name="description" content="<?php echo $settings['description']; ?>">
<?php
		}
		if($settings['keywords'] !== "") {
?>
<meta name="keywords" content="<?php echo $settings['keywords']; ?>">
<?php
		}
		if($info["app_login_type"] == 1) {
?>
<meta name="robots" content="nofollow,noindex">
<?php
		}else{
?>
<meta name="robots" content="follow,index">
<?php
		}
		if($settings['og:title'] !== "") {
?>
<meta property="og:title" content="<?php echo $settings['og:title']; ?>" />
<?php
		}
		if($settings['og:type'] !== "") {
?>
<meta property="og:type" content="<?php echo $settings['og:type']; ?>" />
<?php
		}
		if($settings['og:url'] !== "") {
?>
<meta property="og:url" content="<?php echo htmlspecialchars($settings['og:url']); ?>" />
<?php
		}
		if($settings['og:image'] !== "") {
?>
<meta property="og:image" content="<?php echo $settings['og:image']; ?>" />
<?php
		}
		if($settings['og:site_name'] !== "") {
?>
<meta property="og:site_name" content="<?php echo $settings['og:site_name']; ?>" />
<?php
		}
		if($settings['og:description'] !== "") {
?>
<meta property="og:description" content="<?php echo $settings['og:description']; ?>" />
<?php
		}
		if($settings['twitter:card'] !== "") {
?>
<meta name="twitter:card" content="<?php echo $settings['twitter:card']; ?>" />
<?php
		}
		if($settings['twitter:site'] !== "") {
?>
<meta name="twitter:site" content="<?php echo $settings['twitter:site']; ?>" />
<?php
		}
		if($settings['twitter:creator'] !== "") {
?>
<meta name="twitter:creator" content="<?php echo $settings['twitter:creator']; ?>" />
<?php
		}
	}
}
?>