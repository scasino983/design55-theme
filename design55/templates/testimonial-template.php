<?php
/* Template Name: Testimonials Page */
get_header();
?>

<main id="main-content" class="site-main">

    <section class="hero-section design55-page-hero">
        <div class="hero-img-wrapper">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/entry-alt.jpg'); ?>" alt="<?php esc_attr_e('Client testimonials background', 'design55'); ?>" class="hero-img" />
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-content">
            <h1 class="hero-title">
                <?php esc_html_e('What Our Clients Say', 'design55'); // Specific Title for Testimonials Hero ?>
            </h1>
            <div class="hero-subtitle">
                <?php esc_html_e('Kind words from happy clients.', 'design55'); // Placeholder Subtitle ?>
            </div>
            <?php // No CTA button here by default, can be added if needed ?>
        </div>
    </section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php // The <header class="page-header"> with the_title() is removed as the hero serves this purpose. ?>
        <div class="page-content container">
            <?php
                // Display page content if any (e.g., an introduction to testimonials)
                // This content will appear *below* the new hero section.
                if (trim(get_the_content())) { // Check if there's actual content
                    the_content();
                }
            ?>
            <?php get_template_part('template-parts/testimonials'); // This is the placeholder part ?>
        </div>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
