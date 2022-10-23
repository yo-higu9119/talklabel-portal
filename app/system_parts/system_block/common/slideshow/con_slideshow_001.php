<?php if (IS_SMART_PHONE) { ?>
<?php
HtmlPartsArticle::printBunnerList($session, array(
	 'CategoryGroupId' => 1
	,'CategoryId' => 0
	,'DisplayMax' => 10
	,'SortType' => 1
));
?>
<?php } else { ?>
<?php
HtmlPartsArticle::printBunnerList($session, array(
	 'CategoryGroupId' => 1
	,'CategoryId' => 0
	,'DisplayMax' => 10
	,'SortType' => 1
));
?>
<?php } ?>
