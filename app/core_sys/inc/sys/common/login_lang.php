							<fieldset>
								<dl class="clear_fix">
<?php
	$languageList =& CorebloLanguage::getList();
	if(count($languageList) > 1) {
?>
								<dt><?php echo Util::dispLang(Language::WORD_00079);/* Œ¾Œê‘I‘ð */?></dt>
								<dd>
									<select name="language" class="txt size100p selectMenu">
<?php
		foreach($languageList as $languageType => $languageName) {
			echo '<option value="'.$languageType.'"';
			if(isset($_SESSION['app_language']) && $_SESSION['app_language'] === $languageType) {
				echo ' selected="selected"';
			}
			echo '>'.htmlspecialchars($languageName).'</option>';
		}
?>

									</select>
								</dd>
<?php
	}
?>
								</dl>
							</fieldset>
