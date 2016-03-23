/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);
//Sticky nav
      $(function() {
        // grab the initial top offset of the navigation 
        var sticky_navigation_offset_top = $('header').offset().top;  
        // our function that decides weather the navigation bar should have "fixed" css position or not.
        var sticky_navigation = function(){
          var scroll_top = $(window).scrollTop(); // our current vertical position from the top
          
          // if we've scrolled more than the navigation, change its position to fixed to stick to top, otherwise change it back to relative
          if (scroll_top > sticky_navigation_offset_top) { 
            $('header').css({ 'position': 'fixed', 'top':0, 'left':0 });
          } else {
            $('header').css({ 'position': 'relative' }); 
          }   
        };
        // run our function on load
        sticky_navigation();
        // and run it again every time you scroll
        $(window).scroll(function() {
           sticky_navigation();
        });
      });

})(jQuery); // Fully reference jQuery after this point.
