<?php
if(isset($info) && isset($info->snsShareDisp) && $info->snsShareDisp || isset($seminarInfo) && $seminarInfo->snsShareDisp || isset($productInfo) && $productInfo->snsShareDisp){
?>
<script>
$(function(){
  var url = location.href;
  var title = $('title').html();
 
  // twitter シェアの生成
  var text = encodeURIComponent(title);
  var tweet_url = 'http://twitter.com/share?text=' + text + '&url=' + url;
  $('a.icon-twitter').attr("href", tweet_url);
 
  // facebookシェアの生成
  var facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' + url;
  $('a.icon-facebook').attr("href", facebook_url);
 
  // はてなブックマーク
  var hatena_url = 'https://b.hatena.ne.jp/entry/' + url;
  $('a.icon-hatebu').attr("href", hatena_url);

  // Pocket
  var text = encodeURIComponent(title);
  var pocket_url = 'https://getpocket.com/edit?title=' + text + '&url=' + url;
  $('a.icon-pocket').attr("href", pocket_url);

  // Feedly
  var feedly_url = 'https://feedly.com/i/subscription/feed/' + url;
  $('a.icon-feedly').attr("href", feedly_url);

  // Pinterest
  var pinterest_url = 'https://www.pinterest.com/pin/create/button/?url=' + url;
  $('a.icon-pinterest').attr("href", pinterest_url);

  // Linkedin
  var linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&url' + url;
  $('a.icon-linkedin').attr("href", linkedin_url);

  // LINE
  var text = encodeURIComponent(title);
  var line_url = 'http://line.me/R/msg/text/?' + title + '&' + url;
  $('a.icon-line').attr("href", line_url);

});
</script>

<div id="SNSboxArea" class="clear_fix">
	<ul class="shareList">
	  <li class="shareList__item"><a class="shareList__link icon-twitter" href="#" target="_blank" title="Twitter"></a></li>
	  <li class="shareList__item"><a class="shareList__link icon-facebook" href="#" target="_blank" title="Facebook"></a></li>
	  <!-- li class="shareList__item"><a class="shareList__link icon-google-plus" href="#"></a></li -->
	  <li class="shareList__item"><a class="shareList__link icon-hatebu" href="#" target="_blank" title="はてなブックマーク"></a></li>
	  <li class="shareList__item"><a class="shareList__link icon-pocket" href="#" target="_blank" title="Pocket"></a></li>
	  <!-- li class="shareList__item"><a class="shareList__link icon-rss" href="#" target="_blank" title="RSS"></a></li -->
	  <!-- li class="shareList__item"><a class="shareList__link icon-feedly" href="#" target="_blank" title="Feedly"></a></li -->
	  <li class="shareList__item"><a class="shareList__link icon-pinterest" href="#" target="_blank" title="Pinterest"></a></li>
	  <li class="shareList__item"><a class="shareList__link icon-linkedin" href="#" target="_blank" title="Linkedin"></a></li>
	  <li class="shareList__item"><a class="shareList__link icon-line" href="#" target="_blank" title="LINE"></a></li>
	</ul>
</div>
<?php
}
?>
