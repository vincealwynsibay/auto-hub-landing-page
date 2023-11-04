/* -- Carousel Navigation -- */
(function () {
  'use strict';

  var carousels = function () {
    $('.owl-carousel1').owlCarousel({
      loop: true,
      center: true,
      margin: 50,
      responsiveClass: true,
      nav: false,
      responsive: {
        0: {
          items: 1,
          nav: false,
        },
        680: {
          items: 2,
          nav: false,
          loop: false,
        },
        1000: {
          items: 3,
          nav: true,
        },
      },
    });
  };

  (function ($) {
    carousels();
  })(jQuery);

  var owl = $('.owl-carousel');
  owl.owlCarousel();
  // Go to the next item
  $('.carousel__nextBtn').click(function () {
    owl.trigger('next.owl.carousel');
  });
  // Go to the previous item
  $('.carousel__prevBtn').click(function () {
    // With optional speed parameter
    // Parameters has to be in square bracket '[]'
    owl.trigger('prev.owl.carousel', [300]);
  });
})();
