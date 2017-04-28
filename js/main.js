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
      if ($('body').hasClass('page-home')) {
        _this.Home.init();
      }
      if ($('body').hasClass('page-info')) {
        _this.Info.init();
      }
    });

  },

  onResize: function() {
    var _this = this;

    if (_this.Home.workExists) {
      // layout masonry, refresh skrollr via masonry layout callback
      _this.Home.$work.masonry('layout');
    }

    if (_this.Info.teamExists) {
      // layout masonry
      _this.Info.$team.masonry('layout');
    }
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

Site.Home = {
  workExists: false,

  init: function() {
    var _this = this;

    _this.layoutWork();
    _this.bindImageHover();
    _this.initSkrollr();
  },

  initSkrollr: function() {
    var _this = this;

    _this.skrollr = skrollr.init({
      forceHeight: false // idk why but this helps
    });
  },

  layoutWork: function() {
    var _this = this;

    if ($('.js-masonry').length) {
      _this.$work = $('.js-masonry').masonry({
        transitionDuration: 0, // no fucking animations :<
      });

      // masonry layout callback
      _this.$work.on( 'layoutComplete',
        function( event, laidOutItems ) {
          _this.skrollr.refresh();
          $('.home-work-item').css('opacity',1);
        }
      );

      $('.js-masonry').imagesLoaded(function() {
        _this.workExists = true; // for resize handler
        _this.$work.masonry('layout');
      });
    }
  },

  bindImageHover: function() {
    $('.home-work-image').hover(
      function() {
        // z-index item to top, hide image, show text details
        $(this).closest('.home-work-item').css('z-index',100);
        $(this).css('opacity',0);
        $(this).siblings('.home-work-details').css('opacity',1);
      },
      function() {
        // clear z-index, show image, hide text details
        $(this).closest('.home-work-item').css('z-index','initial');
        $(this).css('opacity',1);
        $(this).siblings('.home-work-details').css('opacity',0);
      }
    );
  }
};

Site.Info = {
  teamExists: false,

  init: function() {
    var _this = this;

    _this.bindNavScroll();
    _this.layoutTeam();
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
  },

  layoutTeam: function() {
    var _this = this;

    if ($('.js-masonry').length) {
      _this.$team = $('.js-masonry').masonry({
        transitionDuration: 0,
      });

      $('.js-masonry').imagesLoaded(function() {
        _this.teamExists = true; // for resize handler
        _this.$team.masonry('layout');
      });
    }
  }
}

Site.init();
