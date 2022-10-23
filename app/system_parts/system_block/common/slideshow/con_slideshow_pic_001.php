<?php if (IS_SMART_PHONE) { ?>
<?php
HtmlPartsArticle::printBunnerList($session, array(
	 'CategoryGroupId' => 1
	,'CategoryId' => 0
	,'DisplayTagType' => 2
	,'DisplayMax' => 2
	,'SortType' => 3
));
?>
<?php } else { ?>
<?php
HtmlPartsArticle::printBunnerList($session, array(
	 'CategoryGroupId' => 1
	,'CategoryId' => 0
	,'DisplayTagType' => 2
	,'DisplayMax' => 2
	,'SortType' => 3
));
?>
<?php } ?>
