<section class="contact-section" id="contact">
  <h2>Contact</h2>
  <?php if ( function_exists('wpcf7') ) : ?>
    <?php echo do_shortcode('[contact-form-7 id="1" title="Contact form 1"]'); ?>
  <?php else : ?>
    <form class="contact-form">
      <label for="cf-name">Name</label>
      <input type="text" id="cf-name" name="cf-name" required>
      <label for="cf-email">Email</label>
      <input type="email" id="cf-email" name="cf-email" required>
      <label for="cf-message">Message</label>
      <textarea id="cf-message" name="cf-message" rows="5" required></textarea>
      <div class="newsletter-optin">
        <input type="checkbox" id="cf-newsletter" name="cf-newsletter">
        <label for="cf-newsletter">Sign me up for the weekly newsletter</label>
      </div>
      <input type="submit" value="Send Message">
    </form>
  <?php endif; ?>
</section>
