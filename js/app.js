// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

//plugins
$.fn.getDataThumb = function(options) {
    options = $.extend({
        bgClass: 'bg-cover'
    }, options || {});
    return this.each(function() {
        var th = $(this).data('thumb');
        if (th) {
            $(this).css('background-image', 'url(' + th + ')').addClass(options.bgClass);
        }
    });
};
$('figure').getDataThumb(); // data-thumb para esses elementos

/**
 * Navegação
 */
(function() {
  //Se o menu tiver submenu, sinalize
  $('li','nav[role="navigation"]').each(function(index, el) {
    var sub = $('.submenu',this);
    if(sub.length)
      $('a',this).eq(0).append('<i class="icon-triangle-down d-table-cell"></i>');
  });

  //Ligamos para você
  $("#call-form").on('opened.fndtn.dropdown', function(e) {
    $('.close-call-us').addClass('show');
  });
  $("#call-form").on('closed.fndtn.dropdown', function(e) {
    $('.close-call-us').removeClass('show');
  });
  $('#call-us-form').clone().appendTo('.off-call-us');

  //Menu off-canvas
  //-----------------------------------------------------------------------------------------------
  $('ul','#main-menu').clone().appendTo('.off-nav'); // clone do menu principal

  //apagar luz
  $('.toggle-menu, .icon-close2, .close-off-menu').on('click',function() {
    $('#off-canvas').toggleClass('show');

    if(!$('#off-canvas').hasClass('show'))
      $('.close-off-menu').removeClass('show');
    else
      $('.close-off-menu').addClass('show');
  });

  //barra de rolagem
  $('#off-canvas').perfectScrollbar();

  //interação com submenu
  $('a','.off-nav').on('click',function(e) {
    e.preventDefault();
    var sb = $(this).siblings('.submenu').eq(0);

    $(this).parents('li').siblings('li')
      .find('.icon-triangle-down').removeClass('rotate')
      .end()
      .find('.submenu').fadeOut('fast').removeClass('active');

    if(sb.length) {
      sb.toggleClass('active');
      $('i',this).toggleClass('rotate');

      if(sb.hasClass('active')) {
        sb.fadeIn('fast');
      } else {
        sb.fadeOut('fast');
      }
    }
  });

})();
