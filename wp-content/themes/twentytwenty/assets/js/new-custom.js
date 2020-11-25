(function ($) {
  Drupal.behaviors.newHome = {
      attach: function (context, settings) {

        // clickable visit campus block
        $(".visit-our-campus-home .content").wrap('<a href="https://dukekunshan.edu.cn/vte/?data-platform=v&data-inst=60148&data-loc=139410&"/>');


    }
  }
})(jQuery);