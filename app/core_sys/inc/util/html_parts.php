<?php
class HtmlParts {
	static function printPageSelectGetParam($basename, $pageNo, $pageMax, $addParamStr="") {
		echo '<nav class="PageNum_link clear_fix">';
		echo '<ul>';
		$pageFirst = $pageNo-2;
		$pageLast = $pageNo+2;
		if($pageMax > 0)echo '<li><a href="'.htmlspecialchars('./'.$basename.'?p=1'.$addParamStr).'">'.Util::dispLang(Language::WORD_00146)/* 最初 */.'</a></li>';
		for($i=$pageFirst; $i<=$pageLast; $i++) {
			if($i >= 1 && $i <= $pageMax) {
				echo '<li><a href="'.htmlspecialchars('./'.$basename.'?p='.$i.$addParamStr).'"'.($pageNo===$i?' class="crt"':'').'>'.$i.'</a></li>';
			}
		}
		if($pageMax > 0)echo '<li><a href="'.htmlspecialchars('./'.$basename.'?p='.$pageMax.$addParamStr).'">'.Util::dispLang(Language::WORD_00147)/* 最後 */.'</a></li>';
		echo '</ul>';
		echo '</nav>';
	}

	static function printPageSelectJs($pageNo, $pageMax) {
	$str = "";
		$str .= '<div class="PageNum">';
		$str .= '<nav class="PageNum_link  clear_fix">';
		$str .= '<ul>';
		$pageFirst = $pageNo-2;
		$pageLast = $pageNo+2;
		$str .= '<li><a href="javascript:void(0);" onclick="comment_get_all(1,true);return false;">'.Util::dispLang(Language::WORD_00146)/* 最初 */.'</a></li>';
		for($i=$pageFirst; $i<=$pageLast; $i++) {
			if($i >= 1 && $i <= $pageMax) {
				$str .= '<li><a href="javascript:void(0);" onclick="comment_get_all('.$i.',true);return false;"'.(($pageNo)===$i?' class="crt"':'').'>'.$i.'</a></li>';
			}
		}
		$str .= '<li><a href="javascript:void(0);" onclick="comment_get_all('.($pageMax).',true);return false;">'.Util::dispLang(Language::WORD_00147)/* 最後 */.'</a></li>';
		$str .= '</ul>';
		$str .= '</nav>';
		$str .= '</div>';
		return $str;
	}

	static function printPageSelectCartJs($pageNo, $pageMax, $pageDispNum) {
		$pageDispNum--;
		$pageNo = ($pageNo<0?0:$pageNo);
		$str = "";
		$str .= '<div class="PageNum">';
		$str .= '<nav class="PageNum_link  clear_fix">';
		$str .= '<ul>';
		$str .= '<li><a href="javascript:void(0);" onclick="$(\'#page\').val(0);get_product_list();return false;">'.Util::dispLang(Language::WORD_00146)/* 最初 */.'</a></li>';
		
		if($pageMax-$pageDispNum > 0) {
			$start = min(max(0, ($pageNo-floor($pageDispNum/2))), $pageMax-$pageDispNum);
		} else {
			$start = max(0, ($pageNo-floor($pageDispNum/2)));
		}

		if($pageDispNum < $pageMax) {
			$end = max(min($pageMax, ($pageNo+ceil($pageDispNum/2))), $pageDispNum);
		} else {
			$end = min($pageMax, ($pageNo+ceil($pageDispNum/2)));
		}
		for($i = $start; $i<= $end; $i++){
			$str .= "\t".'<li>';
			$str .= self::_pageNextBackAtagProCartJs(($pageNo==$i), $i, ($i+1));
			$str .= '</li>';
			$str .= "\n";
		}
		
		$str .= '<li><a href="javascript:void(0);" onclick="$(\'#page\').val('.$pageMax.');get_product_list();return false;">'.Util::dispLang(Language::WORD_00147)/* 最後 */.'</a></li>';
		$str .= '</ul>';
		$str .= '</nav>';
		$str .= '</div>';
		return $str;
	}

	static function _pageNextBackAtagProCartJs($isFocus, $pageNo, $linkStr) {
		return '<a href="javascript:void(0);" onclick="$(\'#page\').val('.$pageNo.');get_product_list();return false;"'.(($isFocus)?' class="crt"':'').'>'.$linkStr.'</a>';
	}

	static function getDayOfWeekClass($val, $addStr) {
		if($val===-1) {
			return 'theday';
		} else if($val===0) {
			return 'sun'.$addStr;
		} else if($val===6) {
			return 'sut'.$addStr;
		} else {
			return 'day'.$addStr;
		}
	}

	static function getMyPage(){
		// URLを取得
		$uri = parse_url((empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$uri = substr($uri['path'], strrpos($uri['path'], '/') + 1);
		return $uri;
	}
}
?>