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

<?php get_template_part('template-parts/secondary-menu'); // Load the secondary menu template part ?>

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
