$(window).scroll(function() {
  if ($(document).scrollTop() > 40) {
    $('body>header>nav.navbar').addClass('shrink');
  } else {
    $('body>header>nav.navbar').removeClass('shrink');
  }
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})