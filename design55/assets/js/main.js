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
          $secondaryStickyNav.addClass('secondary-menu--active'); // Use new class for slide animation
        } else {
          $secondaryStickyNav.removeClass('secondary-menu--active');
        }
      } else {
        $secondaryStickyNav.removeClass('secondary-menu--active'); // Ensure it's hidden and transform reset on mobile
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

  // Newsletter Modal
  var $newsletterModal = $('#newsletter-modal');
  var $newsletterModalOverlay = $('#newsletter-modal-overlay');
  var $newsletterModalClose = $('.newsletter-modal-close');
  var $newsletterModalForm = $('#newsletter-modal-form');
  var $newsletterModalMessage = $('#newsletter-modal-message');
  var NEWSLETTER_COOKIE_NAME = 'design55_newsletter_shown';
  var NEWSLETTER_SIGNUP_COOKIE_NAME = 'design55_newsletter_signed_up';

  function openNewsletterModal() {
    if ($newsletterModal.hasClass('active')) return; // Already open

    $newsletterModalOverlay.css('display', 'block').addClass('active');
    $newsletterModal.css('display', 'block').addClass('active');
    $body.addClass('newsletter-modal-active'); // Optional: for body scroll lock
    $newsletterModal.find('input[type="email"]').first().focus(); // Focus on email field
    setCookie(NEWSLETTER_COOKIE_NAME, 'true', 7); // Don't show again for 7 days
  }

  function closeNewsletterModal() {
    if (!$newsletterModal.hasClass('active')) return; // Already closed

    $newsletterModalOverlay.removeClass('active');
    $newsletterModal.removeClass('active');
    $body.removeClass('newsletter-modal-active');

    // Delay display:none to allow fade-out transition
    setTimeout(function() {
        if (!$newsletterModal.hasClass('active')) { // Check again in case it was reopened quickly
            $newsletterModalOverlay.css('display', 'none');
            $newsletterModal.css('display', 'none');
        }
    }, 300); // Should match CSS transition time
  }

  // Cookie helper functions
  function setCookie(name, value, days) {
    var expires = "";
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
  }

  function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  if ($newsletterModal.length && $newsletterModalOverlay.length) {
    // Check if already shown or signed up
    if (!getCookie(NEWSLETTER_COOKIE_NAME) && !getCookie(NEWSLETTER_SIGNUP_COOKIE_NAME)) {
      setTimeout(function() {
        openNewsletterModal();
      }, 10000); // Show modal after 10 seconds
    }

    $newsletterModalClose.on('click', closeNewsletterModal);
    $newsletterModalOverlay.on('click', closeNewsletterModal); // Close on overlay click

    $(document).on('keydown', function(e) {
      if (e.key === "Escape" && $newsletterModal.hasClass('active')) {
        closeNewsletterModal();
      }
    });

    // Basic form handling for now (actual submission in next step)
    $newsletterModalForm.on('submit', function(e) {
      e.preventDefault();
      // In a later step, this will be an AJAX call
      var email = $('#newsletter-modal-email').val();
      $newsletterModalMessage.hide().removeClass('success error');

      if (!email || !/\S+@\S+\.\S+/.test(email)) {
          $newsletterModalMessage.text('Please enter a valid email address.').addClass('error').show();
          return;
      }

      // Placeholder for AJAX call in next step
      console.log('Form submitted. Name: ' + $('#newsletter-modal-name').val() + ', Email: ' + email);
      // $newsletterModalMessage.text('Submitting...').removeClass('success error').show();
      $newsletterModalMessage.text('Submitting...').removeClass('success error').addClass('info').show(); // Using a generic info class for submitting
      var submitButton = $(this).find('button[type="submit"]');
      submitButton.prop('disabled', true).text('Submitting...');


      $.ajax({
        url: design55_ajax_object.ajax_url, // Passed from WordPress
        type: 'POST',
        data: {
          action: 'newsletter_signup', // Matches PHP action hook
          nonce: $('#newsletter_modal_nonce').val(), // Nonce from the form
          email: email,
          name: $('#newsletter-modal-name').val()
        },
        success: function(response) {
          if (response.success) {
            $newsletterModalMessage.text(response.data.message).removeClass('error info').addClass('success').show();
            setCookie(NEWSLETTER_SIGNUP_COOKIE_NAME, 'true', 365); // User signed up
            // Optionally clear form fields
             $newsletterModalForm.find('input[type="text"], input[type="email"]').val('');
            setTimeout(function() {
                closeNewsletterModal();
                // Re-enable button here if modal wasn't closed, but it is.
            }, 3000); // Close after 3 seconds on success
          } else {
            $newsletterModalMessage.text(response.data.message || 'An unknown error occurred.').removeClass('success info').addClass('error').show();
            submitButton.prop('disabled', false).text('Subscribe');
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error("AJAX Error: " + textStatus, errorThrown, jqXHR.responseText);
          var errorMessage = 'A server error occurred. Please try again later.';
          if (jqXHR.responseJSON && jqXHR.responseJSON.data && jqXHR.responseJSON.data.message) {
            errorMessage = jqXHR.responseJSON.data.message;
          }
          $newsletterModalMessage.text(errorMessage).removeClass('success info').addClass('error').show();
          submitButton.prop('disabled', false).text('Subscribe');
        }
      });
    });
  }
  // Add class to body when modal is active (for potential overflow:hidden)
  // This is handled in open/close functions now.

});
