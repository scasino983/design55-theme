<?php
/*
Template Name: General Page (Info + Image)
*/
get_header(); ?>

<main id="main-content" class="site-main"> <?php // Changed ID for skip link ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <section class="info-image-section">
            <div class="info-image-container">
                <div class="info-image-text">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <?php
                        if (get_the_content()) {
                            the_content();
                        } else {
                            // Fallback content if the editor is empty
                            echo '<p>' . esc_html__('Our approach combines artistry, attention to detail, and premium materials to deliver results that are truly one-of-a-kind. Every project begins with listening and ends with your dream made real.', 'design55') . '</p>';
                            echo '<ul>';
                            echo '<li>' . esc_html__('Personalized, collaborative design', 'design55') . '</li>';
                            echo '<li>' . esc_html__('Flawless project management', 'design55') . '</li>';
                            echo '<li>' . esc_html__('Dedicated to long-term value', 'design55') . '</li>';
                            echo '</ul>';
                            // The button is harder to place generically with the_content(),
                            // consider a Customizer option or a block pattern for this.
                            // For now, if content is empty, this button shows.
                            echo '<a href="' . esc_url(home_url('/contact')) . '" class="cta-button">' . esc_html__('Start Your Consultation', 'design55') . '</a>';
                        }
                    ?>
                </div>
                <div class="info-image-photo">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', ['class' => 'info-image', 'alt' => esc_attr(get_the_title())]); // Use 'large' or another appropriate size ?>
                    <?php else :
                        // Placeholder image if no featured image is set
                        // Using 'entry-alt.jpg' as decided.
                        $placeholder_image_url = get_template_directory_uri() . '/assets/images/entry-alt.jpg';
                        echo '<img src="' . esc_url($placeholder_image_url) . '" alt="' . esc_attr__('Placeholder Image', 'design55') . '" class="info-image placeholder-image" />';
                        echo '<p><small>' . esc_html__('Please set a Featured Image for this page.', 'design55') . '</small></p>';
                    endif; ?>
                </div>
            </div>
        </section>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
