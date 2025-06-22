<?php
/*
Template Name: Contact
*/
get_header(); ?>

<main id="main-content" class="site-main"> <?php // Changed ID for skip link ?>
  <?php get_template_part('template-parts/hero'); ?>   
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <section class="contact-hero">
            <div class="container">
                <h1 class="contact-title"><?php the_title(); ?></h1>
                <?php if (get_the_content()) : ?>
                    <div class="contact-subtitle">
                        <?php the_content(); // Ideal for the subtitle/intro text ?>
                    </div>
                <?php else: ?>
                    <p class="contact-subtitle">
                        <?php esc_html_e('Let’s discuss your vision. We’re here to guide you through every step of your next project—personal, luxurious, and always bespoke.', 'design55'); ?>
                    </p>
                <?php endif; ?>
            </div>
        </section>
    <?php endwhile; endif; ?>

    <section class="contact-form-section">
        <div class="container">
            <?php 
            // Use your custom contact template part or shortcode here:
            get_template_part('template-parts/contact-form');
            ?>
        </div>
    </section>

    <section class="cta-row">
        <div class="container">
            <?php 
            // Optionally drop in a CTA after the form:
            get_template_part('template-parts/cta-projects');
            ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
