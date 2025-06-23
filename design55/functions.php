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

    // Localize script with ajaxurl for main.js
    wp_localize_script(
        'design55-main-js',
        'design55_ajax_object',
        array('ajax_url' => admin_url('admin-ajax.php'))
    );
}
add_action('wp_enqueue_scripts', 'design55_enqueue_scripts');
add_theme_support('custom-logo');
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('menus');
register_nav_menus( array('main-menu' => __( 'Main Menu', 'design55' )));




/**
 * Adds the page slug as a class to the body element.
 *
 * @param array $classes Existing array of body classes.
 * @return array Modified array of body classes including the page slug.
 */
function design55_add_slug_to_body_class($classes) {
    global $post;
    if (isset($post)) {
        $classes[] = $post->post_name; // Add the page slug
    }
    return $classes;
}
add_filter('body_class', 'design55_add_slug_to_body_class');



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

/**
 * Appends the newsletter modal HTML to the footer.
 */
function design55_add_newsletter_modal_to_footer() {
    ?>
    <div id="newsletter-modal-overlay" class="newsletter-modal-overlay" style="display: none;"></div>
    <div id="newsletter-modal" class="newsletter-modal" role="dialog" aria-modal="true" aria-labelledby="newsletter-modal-title" style="display: none;">
        <button class="newsletter-modal-close" aria-label="Close modal">&times;</button>
        <div class="newsletter-modal-content">
            <h2 id="newsletter-modal-title" class="newsletter-modal-title"><?php esc_html_e('Stay Inspired!', 'design55'); ?></h2>
            <p class="newsletter-modal-description"><?php esc_html_e('Join our newsletter to receive the latest interior design trends, stunning project showcases, and exclusive tips directly to your inbox.', 'design55'); ?></p>
            <form id="newsletter-modal-form" class="newsletter-modal-form">
                <div class="form-group">
                    <label for="newsletter-modal-name"><?php esc_html_e('First Name', 'design55'); ?></label>
                    <input type="text" id="newsletter-modal-name" name="newsletter_name" placeholder="<?php esc_attr_e('Enter your first name', 'design55'); ?>">
                </div>
                <div class="form-group">
                    <label for="newsletter-modal-email"><?php esc_html_e('Email Address*', 'design55'); ?></label>
                    <input type="email" id="newsletter-modal-email" name="newsletter_email" required placeholder="<?php esc_attr_e('Enter your email address', 'design55'); ?>">
                </div>
                <?php wp_nonce_field('newsletter_signup_nonce', 'newsletter_modal_nonce'); ?>
                <button type="submit" class="btn newsletter-modal-submit"><?php esc_html_e('Subscribe', 'design55'); ?></button>
                <div id="newsletter-modal-message" class="newsletter-modal-message" style="display: none;"></div>
            </form>
            <p class="newsletter-modal-privacy"><small><?php esc_html_e('We respect your privacy. Unsubscribe at any time.', 'design55'); ?></small></p>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'design55_add_newsletter_modal_to_footer');


/**
 * Creates the newsletter subscribers table if it doesn't exist.
 * Should be called on theme activation.
 */
function design55_create_newsletter_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NULL,
        email VARCHAR(255) NOT NULL,
        signup_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        status VARCHAR(20) NOT NULL DEFAULT 'subscribed', -- e.g., 'subscribed', 'unsubscribed', 'pending'
        unsubscribe_token VARCHAR(64) NULL,
        ip_address VARCHAR(100) NULL, -- Increased length for IPv6
        PRIMARY KEY (id),
        UNIQUE KEY email (email(191)), -- Added length for older MySQL versions with utf8mb4
        KEY unsubscribe_token (unsubscribe_token)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // Check if table exists after attempting to create it
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        // Log an error or notify admin if table creation failed
        error_log("Error creating newsletter subscribers table: $table_name");
        // Optionally, add an admin notice
        // add_action('admin_notices', function() use ($table_name) {
        //     echo '<div class="notice notice-error"><p>Failed to create the newsletter subscribers table: ' . esc_html($table_name) . '. Please create it manually.</p></div>';
        // });
    }
}
// It's common to run this on theme activation.
// add_action('after_switch_theme', 'design55_create_newsletter_table');
// For development, you might want to call it directly once or via an admin hook if the theme is already active.
// As an agent, I cannot rely on theme activation for an existing setup.
// The user should be advised to either run the SQL manually or trigger this function once.
// For now, I'll leave this function here and ensure it's called if not existing during AJAX.


/**
 * Handles the newsletter signup AJAX request.
 */
function design55_handle_newsletter_signup() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';

    // Attempt to create table if it doesn't exist (good for robustness)
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        design55_create_newsletter_table();
        // Check again, if still not there, something is wrong
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            wp_send_json_error(['message' => 'Database table is missing and could not be created. Please contact support.']);
            return;
        }
    }

    // Verify nonce
    check_ajax_referer('newsletter_signup_nonce', 'nonce');

    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $ip_address = design55_get_user_ip();

    if (empty($email) || !is_email($email)) {
        wp_send_json_error(['message' => 'Please provide a valid email address.']);
        return;
    }

    $existing_subscriber = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_name WHERE email = %s",
        $email
    ));

    if ($existing_subscriber) {
        if ($existing_subscriber->status === 'subscribed') {
            wp_send_json_error(['message' => 'This email is already subscribed.']);
            return;
        } elseif ($existing_subscriber->status === 'unsubscribed') {
            // Resubscribe: Update status and generate a new unsubscribe token
            $unsubscribe_token = wp_generate_password(32, false); // Generate a simple token
            $updated = $wpdb->update(
                $table_name,
                [
                    'status' => 'subscribed',
                    'name' => $name ?: $existing_subscriber->name, // Keep old name if new one is empty
                    'unsubscribe_token' => $unsubscribe_token,
                    'signup_date' => current_time('mysql', 1), // Update signup date to now (GMT)
                    'ip_address' => $ip_address
                ],
                ['id' => $existing_subscriber->id],
                ['%s', '%s', '%s', '%s', '%s'],
                ['%d']
            );

            if ($updated !== false) {
                // TODO: Send welcome back / confirmation email
                design55_send_newsletter_confirmation_email($email, $name, $unsubscribe_token);
                wp_send_json_success(['message' => 'You have been resubscribed! Welcome back.']);
            } else {
                wp_send_json_error(['message' => 'Could not update subscription. Please try again.']);
            }
            return;
        }
    }

    // New subscriber
    $unsubscribe_token = wp_generate_password(32, false);
    $inserted = $wpdb->insert(
        $table_name,
        [
            'name' => $name,
            'email' => $email,
            'status' => 'subscribed',
            'unsubscribe_token' => $unsubscribe_token,
            'ip_address' => $ip_address,
            'signup_date' => current_time('mysql', 1) // GMT
        ],
        ['%s', '%s', '%s', '%s', '%s', '%s']
    );

    if ($inserted) {
        // TODO: Send welcome / confirmation email
        design55_send_newsletter_confirmation_email($email, $name, $unsubscribe_token);
        wp_send_json_success(['message' => 'Thank you for subscribing! Please check your email for a confirmation.']);
    } else {
        wp_send_json_error(['message' => 'Could not subscribe. Please try again. Database error.']);
    }
}
add_action('wp_ajax_newsletter_signup', 'design55_handle_newsletter_signup');
add_action('wp_ajax_nopriv_newsletter_signup', 'design55_handle_newsletter_signup');

/**
 * Helper function to get user IP address.
 */
function design55_get_user_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return sanitize_text_field($ip);
}

/**
 * Sends the newsletter confirmation email.
 *
 * @param string $email User's email.
 * @param string $name User's name (optional).
 * @param string $token Unsubscribe token.
 */
function design55_send_newsletter_confirmation_email($email, $name, $token) {
    $subject = get_bloginfo('name') . ' - Subscription Confirmed!';
    $user_name_display = !empty($name) ? esc_html($name) : 'there';

    $unsubscribe_url = add_query_arg([
        'action' => 'design55_unsubscribe',
        'email' => rawurlencode($email),
        'token' => $token
    ], site_url('/')); // Using site_url('/') for a cleaner base for the unsubscribe link

    $message_lines = [
        "Hi " . $user_name_display . ",",
        "",
        "Thank you for subscribing to our newsletter! You're all set to receive the latest updates from " . get_bloginfo('name') . ".",
        "",
        "We'll keep you posted on interior design trends, project showcases, and exclusive tips.",
        "",
        "If you wish to unsubscribe at any time, you can click the link below:",
        esc_url($unsubscribe_url),
        "",
        "Best regards,",
        get_bloginfo('name')
    ];
    $message = implode("\r\n", $message_lines);

    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    // Add From header if you have specific requirements, otherwise WP default is used.
    // $site_email = get_option('admin_email');
    // $headers[] = 'From: ' . get_bloginfo('name') . ' <' . $site_email . '>';

    // Ensure SMTP is configured by the user as per previous discussions.
    wp_mail($email, $subject, $message, $headers);
}

/**
 * Handles the unsubscribe request.
 * Attached to init or admin_post for GET requests.
 */
function design55_handle_unsubscribe_request() {
    if (isset($_GET['action']) && $_GET['action'] === 'design55_unsubscribe' && isset($_GET['email']) && isset($_GET['token'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'newsletter_subscribers';

        $email = sanitize_email($_GET['email']);
        $token = sanitize_text_field($_GET['token']);

        if (empty($email) || !is_email($email) || empty($token)) {
            wp_die('Invalid unsubscribe link. (Error 1)', 'Unsubscribe Failed', ['response' => 400]);
            return;
        }

        $subscriber = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE email = %s AND unsubscribe_token = %s",
            $email, $token
        ));

        if (!$subscriber) {
            // Check if already unsubscribed with this token or if email doesn't exist
            $check_status = $wpdb->get_var($wpdb->prepare("SELECT status FROM $table_name WHERE email = %s", $email));
            if ($check_status === 'unsubscribed') {
                 wp_die(
                    'You are already unsubscribed. <br><a href="' . esc_url(home_url('/')) . '">Return to homepage</a>.',
                    'Already Unsubscribed',
                    ['response' => 200, 'link_url' => esc_url(home_url('/')), 'link_text' => 'Go to Homepage']
                );
            } else {
                wp_die('Invalid unsubscribe link. (Error 2)', 'Unsubscribe Failed', ['response' => 400]);
            }
            return;
        }

        if ($subscriber->status === 'unsubscribed') {
            wp_die(
                'You are already unsubscribed. <br><a href="' . esc_url(home_url('/')) . '">Return to homepage</a>.',
                'Already Unsubscribed',
                ['response' => 200, 'link_url' => esc_url(home_url('/')), 'link_text' => 'Go to Homepage']
            );
            return;
        }

        $updated = $wpdb->update(
            $table_name,
            ['status' => 'unsubscribed'],
            ['id' => $subscriber->id],
            ['%s'],
            ['%d']
        );

        if ($updated) {
            wp_die(
                'You have been successfully unsubscribed. <br><a href="' . esc_url(home_url('/')) . '">Return to homepage</a>.',
                'Unsubscribe Successful',
                ['response' => 200, 'link_url' => esc_url(home_url('/')), 'link_text' => 'Go to Homepage']
            );
        } else {
            wp_die('Could not process your unsubscribe request at this time. Please try again later or contact support. (Error 3)', 'Unsubscribe Failed', ['response' => 500]);
        }
        exit;
    }
}
// Using 'init' allows the link to be site_url('/') based.
// admin_post_nopriv_ and admin_post_ actions are typically for form submissions to admin-post.php.
add_action('init', 'design55_handle_unsubscribe_request');

?>