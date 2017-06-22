$(document).ready(function() {
    $(".escribirComentario").hide();
});    


$(".close").click(function(){
    $("#popUpSuccess").hide();
});

var last=null;
var isActive=false;

$("#comment").click(function(){
    if((last != null) && (isActive)){
      $('#' + last).hide();
      $('button[data-target="' + last + '"]').fadeIn('10');
      $('textarea').val('');
      $("#form" + last).validate().resetForm();
    }
    $("#writecomment").fadeIn("500");
      $(this).hide();
      last=$(this).data('target');
      isActive = true;
});

$('.replyButton').on('click', function () {
    if((last != null) && (isActive)){
      $('#' + last).hide();
      $('button[data-target="' + last + '"]').fadeIn('10');
      $('textarea').val('');
      $("#form" + last).validate().resetForm();
    }
      var $target = $(this).data('target');
      $('#' + $target).fadeIn('250');
      $(this).hide();
      last=$target;
      isActive = true;
});

$('.cancelComment').on('click', function () {
      var $target = $(this).data('target');
      $('#' + $target).hide();
      $('button[data-target="' + $target + '"]').show();
      $('textarea').val('');
      $("#form" + last).validate().resetForm();
      isActive = false;
});



$(function() {
   $('textarea').autogrow();
});

//Declaracion de la funcion autogrow.

(function($)
{
    $.fn.autogrow = function(options)
    {
        return this.filter('textarea').each(function()
        {
            var self         = this;
            var $self        = $(self);
            var minHeight    = $self.height();
            var noFlickerPad = $self.hasClass('autogrow-short') ? 0 : parseInt($self.css('lineHeight')) || 0;
            var settings = $.extend({
                preGrowCallback: null,
                postGrowCallback: null
              }, options );

            var shadow = $('<div></div>').css({
                position:    'absolute',
                top:         -10000,
                left:        -10000,
                width:       $self.width(),
                fontSize:    $self.css('fontSize'),
                fontFamily:  $self.css('fontFamily'),
                fontWeight:  $self.css('fontWeight'),
                lineHeight:  $self.css('lineHeight'),
                resize:      'none',
    			'word-wrap': 'break-word'
            }).appendTo(document.body);

            var update = function(event)
            {
                var times = function(string, number)
                {
                    for (var i=0, r=''; i<number; i++) r += string;
                    return r;
                };

                var val = self.value.replace(/&/g, '&amp;')
                                    .replace(/</g, '&lt;')
                                    .replace(/>/g, '&gt;')
                                    .replace(/\n$/, '<br/>&#xa0;')
                                    .replace(/\n/g, '<br/>')
                                    .replace(/ {2,}/g, function(space){ return times('&#xa0;', space.length - 1) + ' ' });

				if (event && event.data && event.data.event === 'keydown' && event.keyCode === 13) {
					val += '<br />';
				}

                shadow.css('width', $self.width());
                shadow.html(val + (noFlickerPad === 0 ? '...' : ''));
                
                var newHeight=Math.max(shadow.height() + noFlickerPad, minHeight);
                if(settings.preGrowCallback!=null){
                  newHeight=settings.preGrowCallback($self,shadow,newHeight,minHeight);
                }
                
                $self.height(newHeight);
                
                if(settings.postGrowCallback!=null){
                  settings.postGrowCallback($self);
                }
            }

            $self.change(update).keyup(update).keydown({event:'keydown'},update);
            $(window).resize(update);

            update();
        });
    };
})(jQuery);

