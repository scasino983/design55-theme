<section class="contact-section" id="contact">
  <h2><?php esc_html_e('Contact', 'design55'); ?></h2>
  <?php if ( function_exists('wpcf7') ) : ?>
    <?php
        // Tip: Consider making the shortcode ID configurable via Customizer or a theme option.
        echo do_shortcode('[contact-form-7 id="1" title="Contact form 1"]');
    ?>
  <?php else : ?>
    <p><?php esc_html_e('Contact Form 7 plugin is not active. Please install and activate it, or use the basic form below.', 'design55'); ?></p>
    <form class="contact-form" action="#" method="post"> <?php // Added action and method for basic functionality ?>
      <div class="form-group">
        <label for="cf-name"><?php esc_html_e('Name', 'design55'); ?></label>
        <input type="text" id="cf-name" name="cf-name" required>
      </div>
      <div class="form-group">
        <label for="cf-email"><?php esc_html_e('Email', 'design55'); ?></label>
        <input type="email" id="cf-email" name="cf-email" required>
      </div>
      <div class="form-group">
        <label for="cf-message"><?php esc_html_e('Message', 'design55'); ?></label>
        <textarea id="cf-message" name="cf-message" rows="5" required></textarea>
      </div>
      <div class="form-group newsletter-optin"> <?php // Wrapped in form-group for consistency ?>
        <input type="checkbox" id="cf-newsletter" name="cf-newsletter">
        <label for="cf-newsletter"><?php esc_html_e('Sign me up for the weekly newsletter', 'design55'); ?></label>
      </div>
      <input type="submit" value="<?php esc_attr_e('Send Message', 'design55'); ?>">
    </form>
  <?php endif; ?>
</section>
