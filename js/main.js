// ハンバーガーメニュー
jQuery('.nav_toggle').on('click', function () {
  jQuery('.nav_toggle, .nav, .mask').toggleClass('show');
});

jQuery('#link').on('click', function () {
  jQuery('.nav_toggle, .nav, .mask').removeClass('show');
});

jQuery('.mask').on('click', function () {
  jQuery('.nav_toggle, .nav, .mask').removeClass('show');
});

// タブメニュー切り替え
jQuery(function($){
  $('.tab').on('click',function(){
    var idx=$('.tab').index(this);
    $(this).addClass('is-active').siblings('.tab').removeClass('is-active');
    $(this).closest('.tab-group').next('.panel-group').find('.panel').removeClass('is-show');
    $('.panel').eq(idx).addClass('is-show');
  });
});
