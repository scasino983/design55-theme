<?php
/**
 * Template Name: About Page (Owner Bio)
 *
 * This template is designed for an "About Us" or owner biography page.
 * It features a hero section, followed by the page's featured image and content.
 *
 * @package Design55
 */

get_header(); ?>

<main id="main-content" class="site-main">

    <section class="hero-section design55-page-hero">
        <div class="hero-img-wrapper">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/palet.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); // Use page title for alt ?>" class="hero-img" />
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-content">
            <h1 class="hero-title">
                <?php the_title(); // Display the page's title in the hero ?>
            </h1>
            <div class="hero-subtitle">
                <?php esc_html_e('The Creative Force Behind The Design.', 'design55'); // Placeholder Subtitle, editable in template ?>
            </div>
            <?php // Optional: Add a CTA button here if desired for the About page hero ?>
            <?php /* <a href="#contact" class="btn"><?php esc_html_e('Get In Touch', 'design55'); ?></a> */ ?>
        </div>
    </section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('container page-content about-bio-content'); // Added container and custom class ?>>

            <div class="entry-content">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="about-bio-image-wrapper">
                        <?php the_post_thumbnail('medium_large', ['class' => 'about-bio-featured-image']); // 'medium_large' or 'large', adjust as needed ?>
                    </div>
                <?php endif; ?>

                <?php
                // This is where the main bio text (written in the WordPress editor for this page) will appear.
                the_content();
                ?>

                <?php
                // Example of adding more structured hardcoded content below the main bio if needed.
                // This section can be expanded or removed.
                /*
                <div class="additional-bio-info">
                    <h3><?php esc_html_e('Jane\'s Design Philosophy', 'design55'); ?></h3>
                    <p><?php esc_html_e('Jane believes in creating spaces that are not only beautiful but also deeply personal and functional. Her approach is collaborative, ensuring that each design reflects the client\'s personality and lifestyle.', 'design55'); ?></p>

                    <h4><?php esc_html_e('Expertise:', 'design55'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Residential Interior Design', 'design55'); ?></li>
                        <li><?php esc_html_e('Space Planning', 'design55'); ?></li>
                        <li><?php esc_html_e('Custom Furniture Design', 'design55'); ?></li>
                        <li><?php esc_html_e('Sustainable Design Practices', 'design55'); ?></li>
                    </ul>
                </div>
                */
                ?>
            </div><!-- .entry-content -->

        </article><!-- #post-<?php the_ID(); ?> -->
    <?php endwhile; endif; ?>

</main><!-- #main-content -->
<?php get_template_part('template-parts/contact-form'); ?>
<?php get_footer(); ?>
