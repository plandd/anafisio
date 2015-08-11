// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

(function($) {
  var items = new Array(),
    errors = new Array(),
    onComplete = function() {},
    current = 0;

  var jpreOptions = {
    splashVPos: '35%',
    loaderVPos: '75%',
    splashID: '#jpreContent',
    showSplash: true,
    showPercentage: true,
    autoClose: true,
    closeBtnText: 'Start!',
    onetimeLoad: false,
    debugMode: false,
    splashFunction: function() {}
  }

  //cookie
  var getCookie = function() {
    if( jpreOptions.onetimeLoad ) {
      var cookies = document.cookie.split('; ');
      for (var i = 0, parts; (parts = cookies[i] && cookies[i].split('=')); i++) {
        if ((parts.shift()) === "jpreLoader") {
          return (parts.join('='));
        }
      }
      return false;
    } else {
      return false;
    }

  }
  var setCookie = function(expires) {
    if( jpreOptions.onetimeLoad ) {
      var exdate = new Date();
      exdate.setDate( exdate.getDate() + expires );
      var c_value = ((expires==null) ? "" : "expires=" + exdate.toUTCString());
      document.cookie="jpreLoader=loaded; " + c_value;
    }
  }

  //create jpreLoader UI
  var createContainer = function() {

    jOverlay = $('<div></div>')
    .attr('id', 'jpreOverlay')
    .css({
      position: "fixed",
      top: 0,
      left: 0,
      width: '0',
      height: '0',
      zIndex: 0
    })
    .appendTo('body');

    if(jpreOptions.showSplash) {
      jContent = $('<div></div>')
      .attr('id', 'jpreSlide')
      .appendTo(jOverlay);

      var conWidth = $(window).width() - $(jContent).width();
      $(jContent).css({
        position: "absolute",
        top: jpreOptions.splashVPos,
        left: Math.round((50 / $(window).width()) * conWidth) + '%'
      });
      $(jContent).html($(jpreOptions.splashID).wrap('<div/>').parent().html());
      $(jpreOptions.splashID).remove();
      jpreOptions.splashFunction()
    }

    jLoader = $('<div></div>')
    .attr('id', 'jpreLoader')
    .appendTo(jOverlay);

    var posWidth = $(window).width() - $(jLoader).width();
    $(jLoader).css({
      position: 'absolute',
      top: jpreOptions.loaderVPos,
      left: Math.round((50 / $(window).width()) * posWidth) + '%'
    });

    jBar = $('<div></div>')
    .attr('id', 'jpreBar')
    .css({
      width: '100%',
      height: '3px',
      position: 'fixed',
      top: '0',
      left: '0',
      zIndex: 999999
    })
    .addClass('bg-info')
    .appendTo('body'); // aqui adiciona a barra

    if(jpreOptions.showPercentage) {
      jPer = $('<div></div>')
      .attr('id', 'jprePercentage')
      .css({
        position: 'relative',
        height: '100%'
      })
      .appendTo(jLoader)
      .html('Loading...');
    }
    if( !jpreOptions.autoclose ) {
      jButton = $('<div></div>')
      .attr('id', 'jpreButton')
      .on('click', function() {
        loadComplete();
      })
      .css({
        position: 'relative',
        height: '100%'
      })
      .appendTo(jLoader)
      .text(jpreOptions.closeBtnText)
      .hide();
    }
  }

  //get all images from css and <img> tag
  var getImages = function(element) {
    $(element).find('*:not(script)').each(function() {
      var url = "";

      if ($(this).css('background-image').indexOf('none') == -1 && $(this).css('background-image').indexOf('-gradient') == -1) {
        url = $(this).css('background-image');
        if(url.indexOf('url') != -1) {
          var temp = url.match(/url\((.*?)\)/);
          url = temp[1].replace(/\"/g, '');
        }
      } else if ($(this).get(0).nodeName.toLowerCase() == 'img' && typeof($(this).attr('src')) != 'undefined') {
        url = $(this).attr('src');
      }

      if (url.length > 0) {
        items.push(url);
      }
    });
  }

  //create preloaded image
  var preloading = function() {
    for (var i = 0; i < items.length; i++) {
      if(loadImg(items[i]));
    }
  }
  var loadImg = function(url) {
    var imgLoad = new Image();
    $(imgLoad)
    .load(function() {
      completeLoading();
    })
    .error(function() {
      errors.push($(this).attr('src'));
      completeLoading();
    })
    .attr('src', url);
  }

  //update progress bar once image loaded
  var completeLoading = function() {
    current++;

    var per = Math.round((current / items.length) * 100);
    $(jBar).stop().animate({
      width: per + '%'
    }, 500, 'linear');

    if(jpreOptions.showPercentage) {
      $(jPer).text(per+"%");
    }

    //if all images loaded
    if(current >= items.length) {
      current = items.length;
      setCookie();  //create cookie

      if(jpreOptions.showPercentage) {
        $(jPer).text("100%");
      }

      //fire debug mode
      if (jpreOptions.debugMode) {
        var error = debug();
      }


      //max progress bar
      $(jBar).stop().animate({
        width: '100%'
      }, 500, 'linear', function() {
        //autoclose on
        if( jpreOptions.autoClose )
          loadComplete();
        else
          $(jButton).fadeIn(1000);
      });
    }
  }

  //triggered when all images are loaded
  var loadComplete = function() {
    $(jOverlay).fadeOut(800, function() {
      $(jOverlay).remove();
      onComplete(); //callback function
    });
  }

  //debug mode
  var debug = function() {
    if(errors.length > 0) {
      var str = 'ERROR - IMAGE FILES MISSING!!!\n\r'
      str += errors.length + ' image files cound not be found. \n\r';
      str += 'Please check your image paths and filenames:\n\r';
      for (var i = 0; i < errors.length; i++) {
        str += '- ' + errors[i] + '\n\r';
      }
      return true;
    } else {
      return false;
    }
  }

  $.fn.jpreLoader = function(options, callback) {
        if(options) {
            $.extend(jpreOptions, options );
        }
    if(typeof callback == 'function') {
      onComplete = callback;
    }

    //show preloader once JS loaded
    $('body').css({
      'display': 'block'
    });

    return this.each(function() {
      if( !(getCookie()) ) {
        createContainer();
        getImages(this);
        preloading();
      }
      else {  //onetime load / cookie is set
        $(jpreOptions.splashID).remove();
        onComplete();
      }
    });
    };

})(jQuery);

$(document).ready(function() {
    $('#jpreBar', '#jpreLoader').clone().appendTo('#main-menu');

    $('body').jpreLoader({
        //loaderVPos: '41.5%',
        //splashID: '#logo-footer',
        //autoClose: false,
        showPercentage: false,
        closeBtnText: ''
    }, function() {
        $('#jpreBar').fadeOut('fast');
        $('#home-slider > nav').addClass('show');
    });
});

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
$('figure, div, a, section').getDataThumb(); // data-thumb para esses elementos

/**
 * Scroll
 */
$(document).on('scroll',function() {
  var offset = $('body').scrollTop();
  if(offset > 550) {
    $('#main-menu').css({
      opacity: '0'
    });
    $('#mo-menu').removeClass('hide-for-large-up')
    .css({
      position: 'absolute',
      right: '0px'
    });
  }

  if(offset < 550) {
    $('#main-menu').css({
      opacity: '1'
    });
    $('#mo-menu').addClass('hide-for-large-up')
    .css({
      position: 'inherit',
      right: 'inherit'
    });;
  }

});

/**
 * Navegação
 */
(function() {
  //Se o menu tiver submenu, sinalize
  $('li','nav[role="navigation"]').each(function(index, el) {
    var sub = $('.submenu',this);
    if(sub.length)
      $('a',this).eq(0).append('<i class="icon-icon_arrow-down-menu d-table-cell"></i>');
  });

  //Ligamos para você
  $("#call-form").on('opened.fndtn.dropdown', function(e) {
    $('.close-call-us').addClass('show');
  });
  $("#call-form").on('closed.fndtn.dropdown', function(e) {
    $('.close-call-us').removeClass('show');
  });
  $('#call-us-form').clone().appendTo('.off-call-us');
  $('.close-call-us').click(function(e) {
    e.preventDefault();
  });

  //Menu off-canvas
  //-----------------------------------------------------------------------------------------------
  $('ul','#main-menu').clone().appendTo('.off-nav'); // clone do menu principal

  //apagar luz
  $('.toggle-menu, .icon-icon_exit, .close-off-menu').on('click',function(e) {
    e.preventDefault();
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
    //e.preventDefault();
    var sb = $(this).siblings('.submenu').eq(0);

    $(this).parents('li').siblings('li')
      .find('.icon-triangle-down').removeClass('rotate')
      .end()
      .find('.submenu').fadeOut('fast').removeClass('active');

    if(sb.length) {
      e.preventDefault();
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

/**
 * Home slide
 */
(function() {
  $('.slider-items').on('cycle-after', function() {
    $('article',this).addClass('show');
  });
  $('.slider-items').on('cycle-before', function() {
    $('article',this).removeClass('show');
  });
  $('.slider-items').on('cycle-initialized', function() {
    $('article',this).addClass('show');
  });
})();

/**
 * Mapa
 */
(function() {
  if($('#map-section').length) {

    function initialize() {
      var   initLat = $('#map-section').data('lat'),
            initLng = $('#map-section').data('lng'),
            ic = new google.maps.MarkerImage($('#map-section').attr('data-brandicon'));

      var styleArray = [
        {
          stylers: [
            { hue: "#006699" },
            { saturation: 50 },
            //{ lightness: -50 },
            //{ gamma: 1.51 }
          ]
        }/*,{
          featureType: "road",
          elementType: "geometry",
          stylers: [
            { hue: "#00ffee" },
            { saturation: 50 },
            { lightness: 100 }
          ]
        },{
          featureType: "road",
          elementType: "labels",
          stylers: [
            { visibility: "off" }
          ]
        }*/
      ];

      var mapOptions = {
        center: new google.maps.LatLng(initLat,initLng),
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true,
        mapTypeControl: false,
        scaleControl: false,
        scrollwheel: false,
        backgroundColor: '#f1f1f1',
        draggable: false,
        panControl: true,
        zoomControl: true,
        zoomControlOptions: {
          style: google.maps.ZoomControlStyle.LARGE
        }
      };

      var map = new google.maps.Map(document.getElementById('map-section'),
          mapOptions);

      map.setOptions({styles: styleArray});

      var marker = new google.maps.Marker({
				position: new google.maps.LatLng(initLat, initLng),
				map: map,
        icon: ic,
				title: 'Anafísio'
			});
    }

    google.maps.event.addDomListener(window, 'load', initialize);

  }
})();

(function() {
  if($('.timer','#count-user').length) {
    $(document).on('scroll',function() {
      var offset = $('body').scrollTop();
      if(offset >= 750) {
        $('.timer','#count-user').each(function(index, el) {
          $(this).each(count);
        });
      }
      function count(options) {
        var $this = $(this);
        options = $.extend({
          onUpdate: function (value) {
            if($(this).hasClass('timer'))
              $(this).removeClass('timer');
          }
        }, options || {}, $this.data('countToOptions') || {});
        $this.countTo(options);
      }
    });
  }
})();

/**
 * Ajax setup
 */
$.ajaxSetup({
  url: getData.ajaxDir,
  type: 'GET',
  dataType: 'html'
});

function hideNotify(el) {
  $('.notify',el).fadeOut('fast');
}

function redirectAfterForm() {
  window.location.href = getData.redirect_page;
}

/**
 * Ligamos para voce
 */
(function() {
  $('.tel-form').on('submit',function(e) {
    e.preventDefault();
    var userName  = $('input[name="nome"]',this).val(),
        userDD    = $('input[name="dd"]',this).val(),
        userPhone = $('input[name="telefone"]',this).val(),
        userPage = $('input[name="page"]',this).val(),
        $this = $(this);
    
    //Apenas numeros para telefones
    

    if(userName == '' || userPhone == '') {
      alert('Seu nome e telefone devem ser preenchidos');
    } else {
      $.ajax({
        data: {
          action: 'tell_user',
          dd: userDD,
          phone: userPhone,
          name: userName,
          page: userPage,
        },
        beforeSend: function() {
          $('.call-for-user',$this).html('<img src="' + getData.urlDir + 'images/loader_form.gif">');
        },
        complete: function() {
          $('.call-for-user',$this).html('OK');
        },
        success: function(data) {
          if($('.notify',$this).length) {
            if(data != 'true') {
              $('.notify',$this).html('<div data-alert class="alert-box alert radius small-12 left" style="margin-top:20px;">'+ data +' <a href="#" class="close">&times;</a></div>');
            } else {
              $('.notify',$this).html('<div data-alert class="alert-box success radius small-12 left" style="margin-top:20px;">Telefone enviado com sucesso. Aguarde nosso contato.<a href="#" class="close">&times;</a></div>');
            }
          } else {
            if(data != 'true') {
              alert("Erro interno. Verifique seu dados.");
            } else {
              alert("Telefone enviado com sucesso. Aguarde nossa resposta.");
              redirectAfterForm();
            }
          }
          $(document).foundation();
        }
      });
    }
  });
})();

/**
 * Serviços
 */
(function() {
    var planos = $(".nav-services");
    planos.owlCarousel({
        responsiveBaseWidth: $(".row"),
        responsive: true,
        responsiveRefreshRate: 200,
        pagination: true,
        itemsCustom: [
            [200, 1],
            [700, 3],
            [800, 4],
        ],
        rewindNav: false,
        rewindSpeed: 300
    });
    /*$(".next-plains").click(function(e) {
        e.preventDefault();
        planos.trigger('owl.next');
    });
    $(".prev-plains").click(function(e) {
        e.preventDefault();
        planos.trigger('owl.prev');
    });*/
    //#template-carousel

    var planos = $("#template-carousel");
    planos.owlCarousel({
        responsiveBaseWidth: $(".row"),
        responsive: true,
        responsiveRefreshRate: 200,
        pagination: true,
        itemsCustom: [
            [200, 3],
            [700, 5],
            [800, 7],
        ],
        rewindNav: false,
        rewindSpeed: 300
    });
})();

(function() {
  $.ajaxSetup({
    url: getData.ajaxDir,
    type: 'GET',
    dataType: 'html'
  });
  
  $('.contact-form').on('submit',function(e) {
    e.preventDefault();
    var serialize = $(this).serialize(), msg, elem = $(this), subject = $(this).data('title');
    $('span[class^="erro-"]').html('');

    $.ajax({
      data: {
        action: 'send_email_generic',
        fields: serialize,
        subject: subject
      },
      success: function(data) {

        if(data != 'success') {

          if(data == 'telefone')
            msg = "Telefone inválido. Digite apenas números com limite de 11 caracteres";

          if(data == 'nome')
            msg = "Campo obrigatório. Digite apenas letras";

          $(".erro-" + data, elem).html('<div data-alert class="alert-box alert radius small-12 left">'+ msg +'<a href="#" class="close">&times;</a></div>');

        }

        if(data == 'error') {
          alert('Ocorreu algum erro interno. Tente novamente ou entre em contato a partir do nosso telefone');
        }

        if(data == 'success') {
          alert('E-mail enviado com sucesso. Aguarde nosso contato.');
          redirectAfterForm();
        }

        $(document).foundation();
      }
    });
  });
})();
