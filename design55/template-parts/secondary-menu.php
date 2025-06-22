<?php
/**
 * Template Part for the Secondary Sticky-Scroll Navigation menu.
 *
 * @package Design55
 */
?>
<nav class="secondary-sticky-nav" aria-label="<?php esc_attr_e('Secondary Navigation', 'design55'); ?>">
    <div class="container"> <?php // Using existing container class for alignment ?>
        <div class="secondary-logo">
            <?php
            // Display a smaller version of the logo.
            // CSS will primarily handle the sizing.
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                // Fallback to site name if no custom logo.
                echo '<a href="' . esc_url(home_url('/')) . '" rel="home" class="site-name-link">' . esc_html(get_bloginfo('name')) . '</a>';
            }
            ?>
        </div>
        <?php
            wp_nav_menu( array(
                'theme_location' => 'main-menu',
                'container'      => false,
                'menu_class'     => 'menu a-secondary-menu', // Class for styling this specific menu instance
                'depth'          => 1 // Keep secondary menu simple, no dropdowns by default
            ) );
        ?>
    </div>
</nav>
