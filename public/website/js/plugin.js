/* $global , document */
$(document).ready(function () {
  'use strict';
  // Sliders
  $('.main-slider .owl-carousel').owlCarousel({
    items:1,
    rtl: true,
    dots:true,
    nav: false,
    autoplay: true,
    autoplaySpeed: 3000,
    autoplayTimeout: 6000,
    loop:true
  });

  $(".companies-hired .owl-carousel").owlCarousel({
    items:5,
    rtl: true,
    dots:false,
    nav: false,
    autoplay: true,
    autoplaySpeed: 3000,
    autoplayTimeout: 5000,
    rewind:true,
    responsive : {
      0 : {
        items: 2
      },
      480 : {
        items: 3
      },
      992: {
        items: 4
      },
      1200 : {
        items: 5
      }
    }
  });

});

new WOW().init();
