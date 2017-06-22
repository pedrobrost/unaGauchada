$(function () {
    if (window.location == window.parent.location) {
        $('#back-to-bootsnipp').removeClass('hide');
    }
    
    
    $('[data-toggle="tooltip"]').tooltip();
    
    $('#fullscreen').on('click', function(event) {
        event.preventDefault();
        window.parent.location = "http://bootsnipp.com/iframe/4l0k2";
    });
    
    $('[data-command="toggle-search"]').on('click', function(event) {
        event.preventDefault();
        $(this).toggleClass('hide-search');
        
        if ($(this).hasClass('hide-search')) {        
            $('.c-search').closest('.search').slideUp(100);
        }else{   
            $('.c-search').closest('.search').slideDown(100);
        }
    })
    
    $('#contact-list').searchable({
        searchField: '#contact-list-search',
        selector: 'li',
        childSelector: '.col-xs-12',
        show: function( elem ) {
            elem.slideDown(100);
        },
        hide: function( elem ) {
            elem.slideUp( 100 );
        }
    })
});

$(document).ready(function() {
    $("#calificar").hide();
});    

var last=null;
var isActive=false;


$("#calificarButton").click(function(){
    $("#calificar").fadeIn("500");
    $(this).attr('style', 'visibility: hidden;');
});

$("#puntuar").click(function(){
    $("#calificar").hide();
    $("#calificarButton").attr('style', 'visibility: visible;');
});

$("#cancelar").click(function(){
    $("#calificar").hide();
    $("#calificarButton").attr('style', 'visibility: visible;');
});


$('.replyButton').on('click', function () {
    if((last != null) && (isActive)){
      $('#' + last).fadeOut('50');
      $('button[data-target="' + last + '"]').fadeIn('10');
      $('textarea').val('');
      $("#form" + last).validate().resetForm();
    }
      var $target = $(this).data('target');
      $('#' + $target).fadeIn('slow');
      $(this).hide();
      last=$target;
      isActive = true;
});