/**
 * @file
 * Leng Theme JS.
 */
(function ($) {
  'use strict';

  /**
   * Close behaviour.
   */
  Drupal.behaviors.closeCartblockcontents = {
    attach: function (context, settings) {
      $('.cart-block--contents .close-btn').click(function() {
        $(this).parent().removeClass('cart-block--contents__expanded');
      });
    }
  };

  new Swiper('.swiper-container', { 
      // Optional parameters
    direction: 'horizontal',
    loop: true,
    grabCursor: true,
    preloadImages: false,

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    effect: 'slide',
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
  });


  Drupal.behaviors.masonry = {
    attach: function (context, settings) {
      $('.grid').once().masonry({
        // options
        itemSelector: '.grid-item',
        gutter: 15,
        percentPosition: true,
        horizontalOrder: true,
      });
    }
  };

  })(jQuery);
