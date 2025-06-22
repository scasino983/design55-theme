jQuery(document).ready(function($) {
  var $menu = $('.main-nav'); // Cache jQuery object
  if ($menu.length) { // Check if the menu exists
    var $window = $(window);
    var menuHeight = $menu.outerHeight();
    // Ensure origOffsetY is calculated *before* any class changes might affect its position.
    // It's relative to the document.
    var origOffsetY = $menu.offset().top;

    var $spacer = $('#sticky-menu-spacer'); // Get the spacer div from footer.php
                                          // Or create it if it doesn't exist, though it's better in PHP.
    if (!$spacer.length) { // If spacer wasn't in footer.php, create and insert it.
        $spacer = $('<div id="sticky-menu-spacer"></div>').css({
            'height': menuHeight + 'px',
            'display': 'none' // Initially hidden
        });
        $menu.before($spacer);
    } else { // If it exists, ensure its height is correctly set.
        $spacer.css({
            'height': menuHeight + 'px',
            'display': 'none'
        });
    }

    function onScroll() {
      // Check current scroll position against the original offset of the menu
      if ($window.scrollTop() >= origOffsetY) {
        if (!$menu.hasClass('sticky-nav')) {
          $menu.addClass('sticky-nav');
          $spacer.show(); // Show spacer
        }
      } else {
        if ($menu.hasClass('sticky-nav')) {
          $menu.removeClass('sticky-nav');
          $spacer.hide(); // Hide spacer
        }
      }
    }

    // Use a throttled scroll event for better performance if available, otherwise use regular scroll
    // WordPress typically includes underscore.js, which has _.throttle
    if (typeof _.throttle === 'function') {
        $window.on('scroll', _.throttle(onScroll, 200));
    } else {
        $window.on('scroll', onScroll);
    }
  }
});
