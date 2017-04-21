/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    $(document).ready(function () {
      if ($('body').hasClass('page-info')) {
        _this.Info.init();
      }
    });

  },

  onResize: function() {
    var _this = this;

  },

  fixWidows: function() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function(){
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
      $(this).html(string);
    });
  },
};

Site.Info = {
  init: function() {
    var _this = this;

    _this.bindNavScroll();
  },

  bindNavScroll: function() {
    var $navItem = $('#info-nav a');

    $navItem.on('click', function(event) {
      event.preventDefault();

      var sectionId = $(this).attr('data-section');
      var $section = $('#' + sectionId);
      var sectionTop = $section.offset().top;
      var headerHeight = $('#header').outerHeight(true);

      $('html, body').stop().animate({
        scrollTop: sectionTop - headerHeight,
      });
    })
  }
}

Site.init();
