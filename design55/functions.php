<?php
/**
 * Enqueues theme stylesheets and Google Fonts for the Design55 theme.
 *
 * This function loads the main stylesheet and includes Google Fonts (Lora and Inter)
 * to be used throughout the theme. It should be hooked to 'wp_enqueue_scripts'.
 *
 * @since 1.0.0
 */

function design55_enqueue_scripts() {
    wp_enqueue_style('design55-style', get_stylesheet_uri());
    wp_enqueue_style('design55-google-fonts', 'https://fonts.googleapis.com/css2?family=Lora:wght@400;700&family=Inter:wght@400;600&display=swap', array(), null); // Added empty array for deps, null for version

    // Enqueue main.js
    wp_enqueue_script(
        'design55-main-js', // Handle
        get_template_directory_uri() . '/assets/js/main.js', // Path to file
        array('jquery'), // Dependencies (jQuery)
        '1.0.0', // Version number
        true // Load in footer
    );
}
add_action('wp_enqueue_scripts', 'design55_enqueue_scripts');
add_theme_support('custom-logo');
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('menus');
register_nav_menus( array('main-menu' => __( 'Main Menu', 'design55' )));




/**
 * Adds SVG file support to the list of allowed MIME types for uploads.
 *
 * This function enables uploading SVG files by adding the 'svg' MIME type
 * ('image/svg+xml') to the array of permitted MIME types in WordPress.
 *
 * @param array $mimes Existing array of allowed MIME types.
 * @return array Modified array of allowed MIME types including SVG.
 */
function design55_svg_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'design55_svg_mime_types');



/**
 * Loads the theme customizer settings and configures PHPMailer to use SMTP for outgoing emails.
 *
 * - Requires the customizer settings from the 'inc/customizer.php' file.
 * - Hooks into 'phpmailer_init' to set up SMTP parameters for PHPMailer:
 *   - Uses smtp.example.com as the SMTP host.
 *   - Enables SMTP authentication.
 *   - Sets the SMTP port to 587.
 *   - Sets the SMTP username and password.
 *   - Uses TLS encryption for SMTP.
 *
 * @see https://developer.wordpress.org/reference/hooks/phpmailer_init/
 */
require get_template_directory() . '/inc/customizer.php';

/*
 * The following PHPMailer SMTP configuration is commented out by default.
 * It's generally recommended to handle SMTP settings via a dedicated plugin
 * (e.g., WP Mail SMTP) or by defining constants in wp-config.php for better
 * security and portability, rather than hardcoding credentials in functions.php.
 *
 * If you choose to use this, uncomment the block and replace the placeholder
 * values with your actual SMTP credentials.
 */
/*
add_action( 'phpmailer_init', function( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = 'smtp.example.com'; // E.g., smtp.gmail.com or your SMTP host
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = 587; // Or 465 for SSL, 25 for non-secure (not recommended)
    $phpmailer->Username   = 'your_smtp_username'; // Your SMTP username
    $phpmailer->Password   = 'your_smtp_password'; // Your SMTP password
    $phpmailer->SMTPSecure = 'tls'; // Or 'ssl' if using port 465
});
*/

?>