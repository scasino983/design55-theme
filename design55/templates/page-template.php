<?php
/*
Template Name: General Page (Info + Image)
*/
get_header(); ?>

<main id="main-content" class="site-main">

    <section class="hero-section design55-page-hero">
        <div class="hero-img-wrapper">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/livingroom-kitchen.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); // Use page title for alt if appropriate ?>" class="hero-img" />
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-content">
            <h1 class="hero-title">
                <?php the_title(); // Using the page's actual title for the hero ?>
            </h1>
            <div class="hero-subtitle">
                <?php esc_html_e('Dynamic subtitle for this page.', 'design55'); // Placeholder Subtitle, consider using post_excerpt or a custom field ?>
            </div>
            <!-- <a href="#" class="btn"> <?php // Placeholder CTA ?>
                <?php esc_html_e('Discover More', 'design55'); ?>
            </a> -->
        </div>
    </section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <section class="info-image-section">
            <div class="info-image-container">
                <div class="info-image-text">
                    <?php // The H1 from this section is removed as the hero now serves as the primary title section for the page template ?>
                    <?php
                        if (get_the_content()) {
                            the_content();
                             echo '<a href="' . esc_url(home_url('/contact')) . '" class="cta-button">' . esc_html__('Start Your Consultation', 'design55') . '</a>';
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
                    <div class="image-accent-square"></div>
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
<?php echo do_shortcode('[newsletter_signup]'); ?>
<!-- <?php //get_template_part('template-parts/contact-form'); ?> -->
<?php get_footer(); ?>

<script>
jQuery(document).ready(function($) {
    var infoImage = $('.info-image');
    var accentSquare = $('.image-accent-square');

    function updateAccentSquare() {
        var imageHeight = infoImage.height();
        var imageWidth = infoImage.width();

        accentSquare.css({
            height: imageHeight * 0.8,
            width: imageWidth * 0.8
        });
    }

    // Initial update
    updateAccentSquare();

    // Update on window resize
    $(window).resize(updateAccentSquare);
});
</script>
