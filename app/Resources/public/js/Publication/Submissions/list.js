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
