<?php
// Get current page slug
$slug = is_front_page() ? 'home' : basename(get_permalink());

//Map slugs to hero images (edit as needed)
$hero_images = array(
    'home'        => get_template_directory_uri() . '/assets/images/livingroom-8.jpg',
    // 'about'       => get_template_directory_uri() . '/assets/images/bedroom-2.jpg',
    // 'contact'     => get_template_directory_uri() . '/assets/images/boise.jpg',
    // 'projects'    => get_template_directory_uri() . '/assets/images/livingroom-2.jpg',
    // 'testimonials'=> get_template_directory_uri() . '/assets/images/livingroom-3.jpg',
    // // add more as needed
);

// Get hero image for this page if it exists
$hero_image_url = isset($hero_images[$slug]) ? $hero_images[$slug] : '';

// Prepare alt text
$hero_alt_text = get_theme_mod('hero_title', __('Unforgettable Interiors for Modern Living', 'design55'));
if (empty($hero_alt_text)) {
    $hero_alt_text = get_bloginfo('name');
}

?>
<section class="hero-section" id="home">
    <?php if ($hero_image_url): ?>
        <div class="hero-img-wrapper">
            <img src="<?php echo esc_url($hero_image_url); ?>" alt="<?php echo esc_attr($hero_alt_text); ?>" class="hero-img" />
            
        </div>
        <div class="hero-overlay">
        <div class="hero-content">
            <h1 class="hero-title">
                <?php
                // Ensure theme_mod output is escaped if it can contain user-input HTML. For simple strings, esc_html is fine.
                echo esc_html(get_theme_mod('hero_title', __('Unforgettable Interiors for Modern Living', 'design55')));
                ?>
            </h1>
            <div class="hero-subtitle">
                <?php echo esc_html(get_theme_mod('hero_subtitle', __('Live Beautifully, Love Your Space', 'design55'))); ?>
            </div>
            <a href="#contact" class="btn">
                <?php esc_html_e('Book Your Design Clarity Session', 'design55'); ?>
            </a>
        </div>
    </div>
    <?php endif; ?>
</section>

