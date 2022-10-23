<?php
/**
 * 各ページ共通仕様にてtitle、metsタグの表示を行う
 * @param object $settings 簡易条件、表示設定
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
 */
if(!isset($_SYS_META_ARRAY)){
	$_SYS_META_ARRAY = array();
}
if(!isset($_SYS_META_TITLE)){
	$_SYS_META_TITLE = "";
}
HtmlPartsSysMeta::printSysMeta($_SYS_META_ARRAY,$_SYS_META_TITLE);
?>
