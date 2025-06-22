<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e( 'Skip to content', 'design55' ); ?></a>
  <header class="site-header">
    <div class="branding">
      <?php if ( has_custom_logo() ) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <span class="site-title"><?php bloginfo('name'); ?></span>
      <?php endif; ?>
      <span class="site-tagline"><?php bloginfo('description'); ?></span>
    </div>
    <nav class="main-nav">
      <?php wp_nav_menu( array('theme_location' => 'main-menu', 'container' => false, 'menu_class' => 'menu a-main-menu')); // Added menu_class and container=>false for better control ?>
    </nav>
    <button class="mobile-menu-toggle" aria-label="<?php esc_attr_e('Open Mobile Menu', 'design55'); ?>" aria-expanded="false" aria-controls="mobile-menu-panel">
        <span class="toggle-bar"></span>
        <span class="toggle-bar"></span>
        <span class="toggle-bar"></span>
    </button>
  </header>

<nav class="secondary-sticky-nav" aria-label="<?php esc_attr_e('Secondary Navigation', 'design55'); ?>">
    <div class="container"> <?php // Using existing container class for alignment ?>
        <div class="secondary-logo">
            <?php
            // Display a smaller version of the logo.
            // This might involve a different custom logo size or a CSS scaled version of the main logo.
            // For now, let's re-use the custom_logo if available, CSS will handle size.
            if ( has_custom_logo() ) {
                // We need a way to make it smaller.
                // Option 1: Hope CSS handles it.
                // Option 2: Add a filter to change logo output or use a specific smaller logo size if registered.
                // For simplicity now, just outputting it.
                the_custom_logo();
            } else {
                echo '<a href="' . esc_url(home_url('/')) . '" rel="home" class="site-name-link">' . esc_html(get_bloginfo('name')) . '</a>';
            }
            ?>
        </div>
        <?php
            wp_nav_menu( array(
                'theme_location' => 'main-menu',
                'container' => false,
                'menu_class' => 'menu a-secondary-menu', // Different class for potentially different styling
                'depth' => 1 // Keep secondary menu simple, no dropdowns by default
            ) );
        ?>
    </div>
</nav>

<div class="mobile-menu-panel" id="mobile-menu-panel" aria-hidden="true">
    <div class="mobile-menu-header">
        <div class="mobile-menu-logo">
            <?php
            if ( has_custom_logo() ) {
                the_custom_logo(); // Again, CSS will need to control size
            } else {
                echo '<a href="' . esc_url(home_url('/')) . '" rel="home" class="site-name-link">' . esc_html(get_bloginfo('name')) . '</a>';
            }
            ?>
        </div>
        <button class="mobile-menu-close" aria-label="<?php esc_attr_e('Close Mobile Menu', 'design55'); ?>" aria-expanded="true">
            &times; <?php // Simple X, can be replaced with SVG icon ?>
        </button>
    </div>
    <?php
        wp_nav_menu( array(
            'theme_location' => 'main-menu',
            'container' => false,
            'menu_class' => 'menu a-mobile-menu'
        ) );
    ?>
</div>
<div class="mobile-menu-overlay"></div> <?php // For dimming content when mobile menu is open ?>
