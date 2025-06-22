jQuery(document).ready(function($) {
  var $window = $(window);
  var $body = $('body');

  // Secondary Sticky-Scroll Menu (Desktop)
  var $secondaryStickyNav = $('.secondary-sticky-nav');
  var $siteHeader = $('.site-header'); // Reference to the main header
  var siteHeaderHeight = $siteHeader.length ? $siteHeader.outerHeight() : 0;

  if ($secondaryStickyNav.length && $siteHeader.length) {
    function handleSecondaryNavVisibility() {
      if ($window.width() > 600) { // Only apply for desktop
        if ($window.scrollTop() > siteHeaderHeight) {
          $secondaryStickyNav.addClass('secondary-sticky-nav--visible');
        } else {
          $secondaryStickyNav.removeClass('secondary-sticky-nav--visible');
        }
      } else {
        $secondaryStickyNav.removeClass('secondary-sticky-nav--visible'); // Ensure it's hidden on mobile
      }
    }

    // Initial check
    handleSecondaryNavVisibility();
    $window.on('scroll', _.throttle(handleSecondaryNavVisibility, 150));
    $window.on('resize', _.throttle(handleSecondaryNavVisibility, 150));
  }


  // Mobile Menu
  var $mobileMenuToggle = $('.mobile-menu-toggle');
  var $mobileMenuPanel = $('.mobile-menu-panel');
  var $mobileMenuClose = $('.mobile-menu-close');
  var $mobileMenuOverlay = $('.mobile-menu-overlay');

  if ($mobileMenuToggle.length && $mobileMenuPanel.length) {
    function openMobileMenu() {
      $body.addClass('mobile-menu-active');
      $mobileMenuToggle.addClass('active').attr('aria-expanded', 'true');
      $mobileMenuPanel.addClass('open').attr('aria-hidden', 'false');
      $mobileMenuOverlay.addClass('active');
    }

    function closeMobileMenu() {
      $body.removeClass('mobile-menu-active');
      $mobileMenuToggle.removeClass('active').attr('aria-expanded', 'false');
      $mobileMenuPanel.removeClass('open').attr('aria-hidden', 'true');
      $mobileMenuOverlay.removeClass('active');
    }

    $mobileMenuToggle.on('click', function() {
      if ($mobileMenuPanel.hasClass('open')) {
        closeMobileMenu();
      } else {
        openMobileMenu();
      }
    });

    $mobileMenuClose.on('click', function() {
      closeMobileMenu();
    });

    $mobileMenuOverlay.on('click', function() {
      closeMobileMenu();
    });

    // Close mobile menu if user clicks a link within it
    $mobileMenuPanel.find('a').on('click', function(e) {
        // If it's a link to a section on the same page (#hash-link), close menu
        if (this.pathname === window.location.pathname && this.hash !== '') {
            closeMobileMenu();
        }
        // For other links, the page will navigate away, so menu closure is implicit.
        // If you want to ensure it closes even for external links before navigation,
        // you might add closeMobileMenu(); here unconditionally, but it's usually not needed.
    });


    // Close on ESC key
    $(document).on('keydown', function(e) {
      if (e.key === "Escape" && $mobileMenuPanel.hasClass('open')) {
        closeMobileMenu();
      }
    });
  }

  // Consolidate scroll and resize listeners if other functions need them
  // For now, only the original sticky nav (if kept) and secondary nav use scroll/resize heavily.
  // The original sticky nav logic for .main-nav is kept separate for now,
  // as its behavior (using a spacer) is different from the secondary-sticky-nav.
  // If .main-nav itself is NOT supposed to be sticky anymore, its related JS should be removed.
  // Based on the new requirement, .main-nav (original one) is hidden on mobile,
  // and secondary-sticky-nav appears on desktop scroll. So the original stickiness of .main-nav is redundant and has been removed.
});
