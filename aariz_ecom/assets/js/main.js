/*-----------------------------------------------------------------------------------

  Template Name: Asbab eCommerce HTML5 Template.
  Template URI: #
  Description: Asbab is a unique website template designed in HTML with a simple & beautiful look. There is an excellent solution for creating clean, wonderful and trending material design corporate, corporate any other purposes websites.
  Author: HasTech
  Author URI: https://themeforest.net/user/hastech/portfolio
  Version: 1.0

-----------------------------------------------------------------------------------*/

/*-------------------------------
[  Table of contents  ]
---------------------------------
    01. jQuery MeanMenu
    02. wow js active
    03. Product  Masonry (width)
    04. Sticky Header
    05. ScrollUp
    06. Search Bar
    07. Shopping Cart Area
    08. Filter Area
    09. Toogle Menu   
    10. User Menu 
    11. Menu 
    12. Menu Dropdown
    13. Overlay Close
    14. Testimonial Image Slider As Nav
    15. Brand Area
    16. Price Slider Active
    17. Accordion
    18. Ship to another
    19. Payment credit card    
    20 Slider Activations



/*--------------------------------
[ End table content ]
-----------------------------------*/


(function($) {
    'use strict';


/*-------------------------------------------
    01. jQuery MeanMenu
--------------------------------------------- */
    
    $('.mobile-menu nav').meanmenu({
        meanMenuContainer: '.mobile-menu-area',
        meanScreenWidth: "991",
        meanRevealPosition: "right",
    });

/*-------------------------------------------
    02. wow js active
--------------------------------------------- */

    new WOW().init();


/*-------------------------------------------
    03. Product  Masonry (width)
--------------------------------------------- */ 

    $('.htc__product__container').imagesLoaded( function() {
      
        // filter items on button click
        $('.product__menu').on( 'click', 'button', function() {
          var filterValue = $(this).attr('data-filter');
          $grid.isotope({ filter: filterValue });
        }); 
        // init Isotope
        var $grid = $('.product__list').isotope({
          itemSelector: '.single__pro',
          percentPosition: true,
          transitionDuration: '0.7s',
          masonry: {
            // use outer width of grid-sizer for columnWidth
            columnWidth: '.single__pro',
          }
        });

    });

    $('.product__menu button').on('click', function(event) {
        $(this).siblings('.is-checked').removeClass('is-checked');
        $(this).addClass('is-checked');
        event.preventDefault();
    });



/*-------------------------------------------
    04. Sticky Header
--------------------------------------------- */ 
    var win = $(window);
    var sticky_id = $("#sticky-header-with-topbar");
        win.on('scroll',function() {    
        var scroll = win.scrollTop();
        if (scroll < 245) {
        sticky_id.removeClass("scroll-header");
        }else{
            sticky_id.addClass("scroll-header");
        }
    });

/*--------------------------
    05. ScrollUp
---------------------------- */
    $.scrollUp({
        scrollText: '<i class="zmdi zmdi-chevron-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });


/*------------------------------------    
    06. Search Bar
--------------------------------------*/ 
    
    $( '.search__open' ).on( 'click', function () {
        $( 'body' ).toggleClass( 'search__box__show__hide' );
        return false;
    });

    $( '.search__close__btn .search__close__btn_icon' ).on( 'click', function () {
        $( 'body' ).toggleClass( 'search__box__show__hide' );
        return false;
    });


/*------------------------------------    
    07. Shopping Cart Area
--------------------------------------*/

    // $('.cart__menu').on('click', function(e) {
    //     e.preventDefault();
    //     $('.shopping__cart').addClass('shopping__cart__on');
    //     $('.body__overlay').addClass('is-visible');

    // });

    // $('.offsetmenu__close__btn').on('click', function(e) {
    //     e.preventDefault();
    //     $('.shopping__cart').removeClass('shopping__cart__on');
    //     $('.body__overlay').removeClass('is-visible');
    // });


/*------------------------------------    
    08. Filter Area
--------------------------------------*/

    $('.filter__menu').on('click', function(e) {
        e.preventDefault();
        $('.filter__wrap').addClass('filter__menu__on');
        $('.body__overlay').addClass('is-visible');

    });

    $('.filter__menu__close__btn').on('click', function(e) {
        e.preventDefault();
        $('.filter__wrap').removeClass('filter__menu__on');
        $('.body__overlay').removeClass('is-visible');
    });


/*------------------------------------    
    09. Toogle Menu
--------------------------------------*/

    $('.toggle__menu').on('click', function(e) {
        e.preventDefault();
        $('.offsetmenu').addClass('offsetmenu__on');
        $('.body__overlay').addClass('is-visible');

    });

    $('.offsetmenu__close__btn').on('click', function(e) {
        e.preventDefault();
        $('.offsetmenu').removeClass('offsetmenu__on');
        $('.body__overlay').removeClass('is-visible');
    });


/*------------------------------------    
    10. User Menu
--------------------------------------*/

    $('.user__menu').on('click', function(e) {
        e.preventDefault();
        $('.user__meta').addClass('user__meta__on');
        $('.body__overlay').addClass('is-visible');

    });

    $('.offsetmenu__close__btn').on('click', function(e) {
        e.preventDefault();
        $('.user__meta').removeClass('user__meta__on');
        $('.body__overlay').removeClass('is-visible');
    });



/*------------------------------------    
    11. Menu 
--------------------------------------*/

    $('.menu__click').on('click', function(e) {
        e.preventDefault();
        $('.off__canvars__wrap').addClass('off__canvars__wrap__on');
        $('.body__overlay').addClass('is-visible');
        $('body').addClass('off__canvars__open');
        $(this).hide();
    });

    $('.menu__close__btn').on('click', function() {
        $('.off__canvars__wrap').removeClass('off__canvars__wrap__on');
        $('.body__overlay').removeClass('is-visible');
        $('body').removeClass('off__canvars__open');
        $('.menu__click').show();
    });


/*------------------------------------    
    12. Menu Dropdown
--------------------------------------*/
    function offCanvasMenuDropdown(){

        $('.off__canvars__dropdown-menu').hide();

        $('.off__canvars__dropdown > a').on('click', function(e){
        e.preventDefault();

        $(this).find('i.zmdi').toggleClass('zmdi-chevron-up');
        $(this).siblings('.off__canvars__dropdown-menu').slideToggle();
        return false;
        });
    }
    offCanvasMenuDropdown();


/*------------------------------------    
    13. Overlay Close
--------------------------------------*/

    $('.body__overlay').on('click', function() {
        $(this).removeClass('is-visible');
        $('.offsetmenu').removeClass('offsetmenu__on');
        // $('.shopping__cart').removeClass('shopping__cart__on');
        $('.filter__wrap').removeClass('filter__menu__on');
        $('.user__meta').removeClass('user__meta__on');
        $('.off__canvars__wrap').removeClass('off__canvars__wrap__on');
        $('body').removeClass('off__canvars__open');
        $('.menu__click').show();
    });


/*---------------------------------------------------
    14. Testimonial Image Slider As Nav
---------------------------------------------------*/

    $('.ht__testimonial__activation').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    swipeToSlide: true,
    dots: false,
    centerMode: true,
    focusOnSelect: true,
    centerPadding: '10px',
    responsive: [
      {
        breakpoint: 600,
        settings: {
          dots: false,
          slidesToShow: 1,
          slidesToScroll: 1,  
          centerPadding: '10px',
          }
      },
      {
        breakpoint: 320,
        settings: {
          autoplay: true,
          dots: false,
          slidesToShow: 1,
          slidesToScroll: 1,
          centerMode: false,
          focusOnSelect: false,
          }
      }
    ]
    });


/*-----------------------------------------------
    15. Brand Area
-------------------------------------------------*/

    $('.brand__list').owlCarousel({
      loop: true,
      margin:0,
      nav:false,
      autoplay: true,
      autoplayTimeout: 10000,
      items:5,
      dots: false,
      lazyLoad: true,
      responsive: {
        0: {
          items: 2,
        },
        767: {
          items: 4,
        },
        991: {
          items: 5,
        }
      }
    });



/*-------------------------------
    16. Price Slider Active
--------------------------------*/

    $("#slider-range").slider({
          range: true,
          min: 10,
          max: 500,
          values: [110, 400],
          slide: function(event, ui) {
              $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
          }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
      " - $" + $("#slider-range").slider("values", 1));




/*---------------------------------------------------
    17. Accordion
---------------------------------------------------*/

    function emeAccordion(){
        $('.accordion__title')
          .siblings('.accordion__title').removeClass('active')
          .first().addClass('active');
        $('.accordion__body')
          .siblings('.accordion__body').slideUp()
          .first().slideDown();
        $('.accordion').on('click', '.accordion__title', function(){
          $(this).addClass('active').siblings('.accordion__title').removeClass('active');
          $(this).next('.accordion__body').slideDown().siblings('.accordion__body').slideUp();
        });
        };
    emeAccordion();


/*---------------------------------------------------
    18. Ship to another
---------------------------------------------------*/

    function shipToAnother(){
        var trigger = $('.ship-to-another-trigger'),
          container = $('.ship-to-another-content');
        trigger.on('click', function(e){
          e.preventDefault();
          container.slideToggle();
        });
    };
    shipToAnother();



/*---------------------------------------------------
    19. Payment credit card
---------------------------------------------------*/

    function paymentCreditCard(){
        var trigger = $('.paymentinfo-credit-trigger'),
        container = $('.paymentinfo-credit-content');
        trigger.on('click', function(e){
        e.preventDefault();
        container.slideToggle();
    });
    };
    paymentCreditCard();


/*-----------------------------------------------
    20 Slider Activations
-------------------------------------------------*/

    if ($('.slider__activation__wrap').length) {
        $('.slider__activation__wrap').owlCarousel({
        loop: true,
        margin:0,
        nav:true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1000,
        autoplay: false,
        navText: [ '<i class="icon-arrow-left icons"></i>', '<i class="icon-arrow-right icons"></i>' ],
        autoplayTimeout: 10000,
        items:1,
        dots: false,
        lazyLoad: true,
        responsive: {
          0: {
            items: 1,
          },
          767: {
            items: 1,
          },
          991: {
            items: 1,
          }
        }
        });
    }




})(jQuery);



/*-----------------------------------------------
    21 Contact Form Submit
-------------------------------------------------*/
function send_message() {
    // alert("hii");
    jQuery('.validation').html('');

    var name = jQuery("#name").val();
    var email = jQuery("#email").val();
    var mobile = jQuery("#mobile").val();
    var message = jQuery("#message").val();
    var is_error= '';

    
    if(name==""){
        jQuery('#name-error').html("Please enter Name")
        is_error = 1;
    }
    if(email==""){
        jQuery("#email-error").html("Please enter Email");
        is_error = 1;
    }
    if(mobile==""){
        jQuery("#mobile-error").html("Please enter Mobile");
        is_error = 1;
    }
    if(message==""){
        jQuery("#message-error").html("Please enter Message");
        is_error = 1;
    }

    if(is_error == ''){
        jQuery.ajax({
            url:'send_message.php',
            type:'POST',
            data:'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message,
            success:function (result) {
                alert(result);
            }

        });
    }

   
}


/*-----------------------------------------------
    22 Register Form Submit
-------------------------------------------------*/
function user_register() {

    jQuery('.validation').html('');

    var name = jQuery("#name").val();
    var email = jQuery("#email").val();
    var mobile = jQuery("#mobile").val();
    var password = jQuery("#password").val();

    var is_error = '';
    

    if(name==""){
        jQuery('#name-error').html("Please enter Name");
        is_error = 1;
    }
    if(email==""){
        jQuery("#email-error").html("Please enter Email");
        is_error = 1;
    }
    if(mobile==""){
        jQuery("#mobile-error").html("Please enter Mobile");
        is_error = 1;
    }
    if(password==""){
        jQuery("#password-error").html("Please enter Password");
        is_error = 1;
    }
    
    if(is_error == ''){
        jQuery.ajax({
            url:'register_submit.php',
            type:'POST',
            data:'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
            success:function (result) {
                if(result == "Present"){
                    jQuery("#email-error").html("Email Already Exist!!! Please Login.");
                }
                if(result == "Not Present"){
                    $(".register-msg p").addClass("success");
                    jQuery(".register-msg p").html("Thank You For Registration");
                    jQuery("#name").val('');
                    jQuery("#email").val('');
                    jQuery("#mobile").val('');
                    jQuery("#password").val('');
                }
                // alert(result);
            }

        });
    }

}



/*-----------------------------------------------
    23 User Login
-------------------------------------------------*/
function user_login() {

    jQuery('.validation').html('');

    var email = jQuery("#login_email").val();
    var password = jQuery("#login_password").val();

    var is_error = '';
    

    if(email==""){
        jQuery("#login_email-error").html("Please enter Email");
        is_error = 1;
    }
    if(password==""){
        jQuery("#login_password-error").html("Please enter Password");
        is_error = 1;
    }
    
    if(is_error == ''){
        jQuery.ajax({
            url:'login_submit.php',
            type:'POST',
            data:'email='+email+'&password='+password,
            success:function (result) {
                if(result == "wrong"){
                    $(".login_msg p").addClass("error");
                    $(".login_msg p").html("Please enter valid login details");
                }
                if(result == "right"){
                    window.location.href = window.location.href;
                }
                // alert(result);
            }

        });
    }

}






/*-----------------------------------------------
    23 Add to cart
-------------------------------------------------*/
function manage_cart(pid,type,quty) {
    if(quty == null){
        if(type == 'update'){
            var qty = $("#"+pid+"-qty").val();
        }else{
            var qty = jQuery("#qty").val();
        }
    }else{
        var qty = quty;
    }
    
    
    jQuery.ajax({
        url:'manage_cart.php',
        type:'POST',
        data:'pid='+pid+'&qty='+qty+'&type='+type,
        success:function (result) {
            if(type == 'update' || type == 'remove'){
                location.reload();
            }else{
                $('.htc__qua').html(result);
            }
            //add
            
            // alert(result);
        }

    });
}