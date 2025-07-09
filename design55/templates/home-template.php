<?php
/**
 * Template Name: Home Page (LANDING PAGE)
 * This template is designed for a "Home" or landing page.
 * It features a hero section, followed by a gallery, testimonials, and a contact form.
 * 
 *
 * @package Design55
 */
    get_header(); ?>
<main id="main-content">
  <?php get_template_part('template-parts/hero'); ?>
  <?php get_template_part('template-parts/services'); ?>
      <?php get_template_part('template-parts/cta-primary'); ?>

  <?php get_template_part('template-parts/testimonial-section'); ?>
   <?php get_template_part('template-parts/cta-air-bnb'); ?>
  <?php get_template_part('template-parts/about'); ?>
    <?php get_template_part('template-parts/cta-secondary'); ?>
  <?php get_template_part('template-parts/contact-form'); ?>
 
  <?php echo do_shortcode('[newsletter_signup]'); ?>

</main>
<?php get_footer(); ?>


