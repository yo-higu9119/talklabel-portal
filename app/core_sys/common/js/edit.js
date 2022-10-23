tinymce.init({
  selector: '.editTxt',
  body_class: 'articleBox',
  language: 'ja',
  height: 400,
  menubar: false,
  theme: 'modern',
  relative_urls : false, 
  extended_valid_elements : 'script[src|type]',
  plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
  ],
  toolbar1: 'insertfile undo redo | fontselect | fontsizeselect forecolor backcolor | bold italic | code',
  toolbar2: 'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | media | preview',
  fontsize_formats: "12px 14px 16px 18px 20px 22px",
  content_css: [
    '../css/sys_common.css',
    '../css/base.css',
    '../css/form_common.css',
  ],
  branding: false,
  fixed_toolbar_container: '#mytoolbar'
});