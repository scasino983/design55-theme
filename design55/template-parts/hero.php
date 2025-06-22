<?php
// Get current page slug
$slug = is_front_page() ? 'home' : basename(get_permalink());

// Map slugs to hero images (edit as needed)
$hero_images = array(
    'home'        => get_template_directory_uri() . '/assets/images/livingroom-kitchen.jpg',
    'about'       => get_template_directory_uri() . '/assets/images/livingroom-kitchen.jpg',
    'contact'     => get_template_directory_uri() . '/assets/images/hero-contact.jpg',
    'projects'    => get_template_directory_uri() . '/assets/images/hero-projects.jpg',
    'testimonials'=> get_template_directory_uri() . '/assets/images/hero-testimonials.jpg',
    // add more as needed
);

// Get hero image for this page if it exists
$hero_image_url = isset($hero_images[$slug]) ? $hero_images[$slug] : '';

?>
<section class="hero-section" id="home">
    <?php if ($hero_image_url): ?>
        <div class="hero-img-wrapper">
            <img src="<?php echo esc_url($hero_image_url); ?>" alt="" class="hero-img" />
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-content">
            <h1 class="hero-title">
                <?php echo get_theme_mod('hero_title', 'Unforgettable Interiors for Modern Living'); ?>
            </h1>
            <div class="hero-subtitle">
                <?php echo get_theme_mod('hero_subtitle', 'Live Beautifully, Love Your Space'); ?>
            </div>
            <a href="#contact" class="btn">
                Start Your Project
            </a>
        </div>
    <?php endif; ?>
</section>

