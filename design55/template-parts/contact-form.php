<section class="contact-section" id="contact">
  <h2><?php esc_html_e('Contact', 'design55'); ?></h2>
  <?php if ( function_exists('wpcf7') ) : ?>
    <?php
        // Custom Contact Form 7 with asterisks for required fields
        echo do_shortcode('[contact-form-7 id="1" title="Contact form 1"]');
    ?>
    <style>
      /* Add asterisks to Contact Form 7 required fields */
      .wpcf7-form label:after {
        content: " *";
        color: #e91e63;
        font-weight: bold;
        font-size: 1.1em;
      }
      /* Remove asterisk from optional fields if any */
      .wpcf7-form .optional-field label:after {
        content: "";
      }
    </style>
  <?php else : ?>
    <p><?php esc_html_e('Contact Form 7 plugin is not active. Please install and activate it, or use the basic form below.', 'design55'); ?></p>
    <form class="contact-form" action="#" method="post"> <?php // Added action and method for basic functionality ?>
      <div class="form-row">
        <div class="form-group">
          <label for="cf-name">
            <?php esc_html_e('Name', 'design55'); ?>
            <span class="required-star">*</span>
          </label>
          <input type="text" id="cf-name" name="cf-name" required>
        </div>
        <div class="form-group">
          <label for="cf-email">
            <?php esc_html_e('Email', 'design55'); ?>
            <span class="required-star">*</span>
          </label>
          <input type="email" id="cf-email" name="cf-email" required>
        </div>
      </div>
      <div class="form-group">
        <label for="cf-phone">
          <?php esc_html_e('Phone Number', 'design55'); ?>
          <span class="required-star">*</span>
        </label>
        <input type="tel" id="cf-phone" name="cf-phone" placeholder="<?php esc_attr_e('(555) 123-4567', 'design55'); ?>" required>
      </div>
      <div class="form-group">
        <label for="cf-message">
          <?php esc_html_e('Message', 'design55'); ?>
          <span class="required-star">*</span>
        </label>
        <textarea id="cf-message" name="cf-message" rows="5" required></textarea>
      </div>
      <div class="form-group newsletter-optin">
        <input type="checkbox" id="cf-newsletter" name="cf-newsletter" required>
        <label for="cf-newsletter">
          <?php esc_html_e('Sign me up for the weekly newsletter', 'design55'); ?>
          <span class="required-star">*</span>
        </label>
      </div>
      <input class="btn" type="submit" value="<?php esc_attr_e('Send Message', 'design55'); ?>">
    </form>
  <?php endif; ?>
  <!-- <img class="contact-section-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/svg/frames.svg" alt="Decorative Frame"  /> -->
    <img class="contact-section-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/livingroom-3.jpg" alt="Decorative Frame"  />
</section>
