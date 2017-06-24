$(document).ready(function () {
     $('.btn-filter').on('click', function () {
       var $target = $(this).data('target');
       if ($target != 'all') {
         $('li.list-group-item').css('display', 'none');
         $('li.list-group-item[data-status="' + $target + '"]').fadeIn('slow');
       } else {
         $('li.list-group-item').css('display', 'none').fadeIn('slow');
       }
       $('.btn-filter').removeClass('active');
       $(this).addClass('active');
     });
 
  });