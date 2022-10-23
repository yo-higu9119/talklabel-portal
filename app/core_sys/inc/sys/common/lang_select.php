<?php
$systemData = new SystemData('');
$systemInfo = $systemData->getInfo();
$languageList =& CorebloLanguage::getList();
if($systemInfo->use_language == 1 && count($languageList) > 1){
?>
						<div class="LangSelect clear_fix">
							<ul>
<?php
		foreach($languageList as $languageType => $languageName) {
?>
								<li><a href="javascript:void(0);" onclick="setLanguage('<?=$languageType.'\',\''.SYSTEM_TOP_URL?>');"<?=(CorebloLanguage::getLanguageSelect() == '<?=$languageType?>')?' class="crt"':'';?>><?=$languageName?></a></li>

<?php
		}
?>
							</ul>
						</div>
<?php
}
?>
