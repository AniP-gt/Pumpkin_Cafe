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
