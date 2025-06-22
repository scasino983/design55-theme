<section class="about-section" id="about">
  <h2 class="about-title"><?php esc_html_e('Meet the Designer', 'design55'); ?></h2>
  <div class="about-columns">
    <div class="about-text">
      <?php // TODO: Consider making this text content dynamic, e.g., from Customizer or page content. ?>
      <p>
        <?php esc_html_e('With a passion for creating inspired spaces, Design55 brings an artist’s eye and a client’s heart to every project.', 'design55'); ?>
      </p>
      <p>
        <?php esc_html_e('Whether it’s a modern kitchen, a serene bathroom, or a lively family living area, we believe your home should reflect your story.', 'design55'); ?>
      </p>
      <p class="about-section__cta-text">
        <?php esc_html_e('Let’s make your dream space a reality.', 'design55'); ?>
      </p>
    </div>
    <div class="about-img-wrapper"> <?php // Changed class for clarity, assuming CSS uses .about-img-wrapper ?>
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/designer.webp'); ?>" alt="<?php esc_attr_e('Lead Designer', 'design55'); ?>">
    </div>
  </div>
</section>
