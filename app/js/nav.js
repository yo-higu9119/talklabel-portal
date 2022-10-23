'use strict';

{    
  // ハンバーガーメニュー
  var spNav = document.getElementById('spNav');
  var close = document.getElementById('close');
  
  spNav.addEventListener('click', function(){
    spNav.classList.toggle('open')
    close.classList.toggle('open')
  });

}