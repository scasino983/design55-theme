<?php
/*
Template Name: Contact
*/
get_header(); ?>


<main id="main-content" class="site-main">

    <section class="hero-section design55-page-hero">
        <div class="hero-img-wrapper">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/dining.webp'); ?>" alt="<?php esc_attr_e('Dining area background', 'design55'); ?>" class="hero-img object-position-custom" />
            <?php // The object-position-custom class can be used if this hero needs different image positioning than the default hero-img. Add corresponding CSS if needed. ?>
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-content">
            <h1 class="hero-title">
                <?php esc_html_e('Get In Touch', 'design55'); // Placeholder Title ?>
            </h1>
            <div class="hero-subtitle">
                <?php esc_html_e("We're here to help and answer any question you might have.", 'design55'); // Placeholder Subtitle ?>

            </div>
            <a href="#" class="btn"> <?php // Placeholder CTA ?>
                <?php esc_html_e('Learn More', 'design55'); ?>
            </a>
        </div>
    </section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php // Page content from editor can go here if needed, or be removed if hero is full replacement ?>
        <?php // Example: if (get_the_content()) { the_content(); } ?>
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
