<!-- タグマネ埋め込み用コード -->
<?php require dirname(__FILE__).'/../../../../system_parts/crt_block/head_tag.php';?>

<?php require dirname(__FILE__).'/../../../../core_sys/inc/meta/user_meta_inn.php';?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/parts/contents_nav_type1.php';?>
<?php require dirname(__FILE__).'/../../../../system_parts/crt_block/meta_individual.php';?>

<!-- 追加CSS -->
<link href="<?php echo SYSTEM_TOP_URL; ?>css/nav/nav.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">
<link href="<?php echo SYSTEM_TOP_URL; ?>css/base/base.css<?php echo SYSTEM_ACCESS_DATETIME; ?>" rel="stylesheet">

<script>
  (function(d) {
    var config = {
      kitId: 'wcb3zpu',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>

<?php

// お問い合わせ資料請求URL
$url_contact="https://talk-label.com/top/contact/index.php?s=request&step=1";

if(isset($_GET['add']) && trim($_GET['add']) !==""){
  // セッション保持
  $_SESSION['add'] = $_GET['add'];
}
// プロプラン申込URL
//if(isset($_SESSION['add'])){
//  $add = $_SESSION['add'];
//  if($add == '4'){
//    $url_buy_pro="https://console.talklabel.com/registration?plan_id=cc123d33-c446-46e0-adb3-817cb8a5d696";//004_プロプラン
//  }else if($add == '5'){
//    $url_buy_pro="https://console.talklabel.com/registration?plan_id=7a8fe9c1-ca85-4521-9487-a90678f10fc6";//005_プロプラン
//  }
//}else{
//  $url_buy_pro="https://console.talklabel.com/registration?plan_id=c305b7bc-afb5-4427-bf57-d4b93a95c15d";//その他プロプラン
//}
$url_buy_pro="https://talk-label.com/top/contact/index.php?s=request";


?>
