<?php
/* Template Name: Testimonials Page */
get_header();
?>

<main id="main-content" class="site-main"> <?php // Changed ID for skip link ?>
  <?php get_template_part('template-parts/hero'); ?>   
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <header class="page-header container"> <?php // Added a container for consistency ?>
            <h1 class="page-title"><?php the_title(); ?></h1>
        </header>
        <div class="page-content container"> <?php // Added a container for consistency ?>
            <?php
                // Display page content if any (e.g., an introduction to testimonials)
                if (get_the_content()) {
                    the_content();
                }
            ?>
            <?php get_template_part('template-parts/testimonials'); ?>
        </div>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
