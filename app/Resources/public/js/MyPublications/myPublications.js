$(document).ready(function () {

  $('#closedMessage').hide();
  $('#activeMessage').hide();
  $('#cancelledMessage').hide();
  $('#calificarMessage').hide();
  var last;

  $('.btn-filter').on('click', function () {
    var $target = $(this).data('target');
    var count = 0;
    if ($target != 'all') {
      $('li.list-group-item').hide();

      $('li.list-group-item[data-status="' + $target + '"]').each(function () {
        $(this).fadeIn('slow');
        count++;
      });
      if (count == 0) {
        $('#' + $target + 'Message').fadeIn('slow');
      }
    } else {
      $('li.list-group-item').css('display', 'none').fadeIn('slow');
    $('#closedMessage').hide();
    $('#activeMessage').hide();
    $('#cancelledMessage').hide();
    $('#calificarMessage').hide();
    }
    $('.btn-filter').removeClass('active');
    $(this).addClass('active');
  });

});