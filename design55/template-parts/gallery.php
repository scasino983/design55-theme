<section class="gallery-section" id="gallery">
  <h2 class="gallery-title"><?php esc_html_e('Featured Projects', 'design55'); ?></h2>
  <div class="gallery-grid">
    <?php // TODO: Consider making gallery images dynamic, e.g., from Customizer, a CPT, or page ACF gallery field. ?>
    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/living-room-2.jpg'); ?>" alt="<?php esc_attr_e('Elegant Kitchen Project', 'design55'); ?>">
    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/living-room-3.jpg'); ?>" alt="<?php esc_attr_e('Modern Living Room', 'design55'); ?>">
    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/living-room-4.jpg'); ?>" alt="<?php esc_attr_e('Bathroom Retreat', 'design55'); ?>">
    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/living-room-5.jpg'); ?>" alt="<?php esc_attr_e('Inviting Dining Area', 'design55'); ?>">
  </div>
</section>
