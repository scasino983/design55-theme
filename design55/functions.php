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
 * Add favicon to the site using icon-2.png from assets/images
 */
function design55_add_favicon() {
    $favicon_url = get_template_directory_uri() . '/assets/images/icon-2.png';
    echo '<link rel="icon" type="image/png" href="' . esc_url($favicon_url) . '">' . "\n";
    echo '<link rel="shortcut icon" type="image/png" href="' . esc_url($favicon_url) . '">' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url($favicon_url) . '">' . "\n";
}
add_action('wp_head', 'design55_add_favicon');



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

add_action( 'phpmailer_init', function( $phpmailer ) {
    // Load environment variables
    design55_load_env();
    
    $smtp_host = getenv('SMTP_HOST');
    $smtp_username = getenv('SMTP_USERNAME');
    $smtp_password = getenv('SMTP_PASSWORD');
    $smtp_port = getenv('SMTP_PORT') ?: 587;
    $smtp_secure = getenv('SMTP_SECURE') ?: 'tls';
    
    // Only configure SMTP if credentials are available
    if ($smtp_host && $smtp_username && $smtp_password) {
        $phpmailer->isSMTP();
        $phpmailer->Host       = $smtp_host;
        $phpmailer->SMTPAuth   = true;
        $phpmailer->Port       = $smtp_port;
        $phpmailer->Username   = $smtp_username;
        $phpmailer->Password   = $smtp_password;
        $phpmailer->SMTPSecure = $smtp_secure;
    }
});


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
 * UNIFIED NEWSLETTER & CONTACT SYSTEM
 * Consolidates all form submissions into a single database system
 * Handles: Modal signup, shortcode signup, and contact form submissions
 */

// Update the newsletter table structure to handle all submissions
function design55_create_unified_subscribers_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(50) NULL,
        message TEXT NULL,
        signup_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        status VARCHAR(20) NOT NULL DEFAULT 'subscribed',
        source VARCHAR(50) NOT NULL DEFAULT 'unknown', -- 'modal', 'shortcode', 'contact_form'
        unsubscribe_token VARCHAR(64) NULL,
        ip_address VARCHAR(100) NULL,
        PRIMARY KEY (id),
        UNIQUE KEY email (email(191)),
        KEY unsubscribe_token (unsubscribe_token),
        KEY source (source),
        KEY status (status)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // Check if table exists after attempting to create it
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        error_log("Error creating newsletter subscribers table: $table_name");
        add_action('admin_notices', function() use ($table_name) {
            echo '<div class="notice notice-error"><p>Failed to create the newsletter subscribers table: ' . esc_html($table_name) . '. Please create it manually.</p></div>';
        });
    }
}

// Replace the old table creation function
function design55_create_newsletter_table() {
    design55_create_unified_subscribers_table();
}

// Unified newsletter signup handler (for AJAX)
function design55_handle_newsletter_signup() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';

    // Ensure table exists
    design55_create_unified_subscribers_table();
    
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        wp_send_json_error(['message' => 'Database table is missing and could not be created. Please contact support.']);
        return;
    }

    // Verify nonce
    check_ajax_referer('newsletter_signup_nonce', 'nonce');

    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $source = isset($_POST['source']) ? sanitize_text_field($_POST['source']) : 'modal';
    $ip_address = design55_get_user_ip();

    if (empty($email) || !is_email($email)) {
        wp_send_json_error(['message' => 'Please provide a valid email address.']);
        return;
    }

    // Check for existing subscriber
    $existing_subscriber = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_name WHERE email = %s",
        $email
    ));

    if ($existing_subscriber) {
        if ($existing_subscriber->status === 'subscribed') {
            wp_send_json_error(['message' => 'This email is already subscribed.']);
            return;
        } elseif ($existing_subscriber->status === 'unsubscribed') {
            // Resubscribe
            $unsubscribe_token = wp_generate_password(32, false);
            $updated = $wpdb->update(
                $table_name,
                [
                    'status' => 'subscribed',
                    'name' => $name ?: $existing_subscriber->name,
                    'unsubscribe_token' => $unsubscribe_token,
                    'signup_date' => current_time('mysql', 1),
                    'source' => $source,
                    'ip_address' => $ip_address
                ],
                ['id' => $existing_subscriber->id],
                ['%s', '%s', '%s', '%s', '%s', '%s'],
                ['%d']
            );

            if ($updated !== false) {
                design55_send_newsletter_confirmation_email($email, $name, $unsubscribe_token);
                design55_send_admin_notification($email, $name, 'Newsletter Resubscription', $source);
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
            'source' => $source,
            'unsubscribe_token' => $unsubscribe_token,
            'ip_address' => $ip_address,
            'signup_date' => current_time('mysql', 1)
        ],
        ['%s', '%s', '%s', '%s', '%s', '%s', '%s']
    );

    if ($inserted) {
        design55_send_newsletter_confirmation_email($email, $name, $unsubscribe_token);
        design55_send_admin_notification($email, $name, 'Newsletter Signup', $source);
        wp_send_json_success(['message' => 'Thank you for subscribing! Please check your email for a confirmation.']);
    } else {
        wp_send_json_error(['message' => 'Could not subscribe. Please try again. Database error.']);
    }
}

// Contact form handler
function design55_handle_contact_form() {
    // Only process if this is a contact form submission
    if (!isset($_POST['contact_nonce']) || !isset($_POST['cf-name'])) {
        return;
    }
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';

    // Ensure table exists
    design55_create_unified_subscribers_table();

    // Verify nonce for contact form
    if (!wp_verify_nonce($_POST['contact_nonce'], 'contact_form_nonce')) {
        wp_die('Security check failed. Please try again.');
    }

    $name = isset($_POST['cf-name']) ? sanitize_text_field($_POST['cf-name']) : '';
    $email = isset($_POST['cf-email']) ? sanitize_email($_POST['cf-email']) : '';
    $phone = isset($_POST['cf-phone']) ? sanitize_text_field($_POST['cf-phone']) : '';
    $message = isset($_POST['cf-message']) ? sanitize_textarea_field($_POST['cf-message']) : '';
    $newsletter_optin = isset($_POST['cf-newsletter']) ? true : false;
    $ip_address = design55_get_user_ip();

    // Validate required fields
    if (empty($name) || empty($email) || !is_email($email)) {
        wp_die('Please fill in all required fields with valid information.');
    }

    // Send contact form email to admin
    design55_send_contact_form_email($name, $email, $phone, $message);

    // Handle newsletter signup if opted in
    if ($newsletter_optin) {
        $existing_subscriber = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE email = %s",
            $email
        ));

        if (!$existing_subscriber) {
            // New subscriber via contact form
            $unsubscribe_token = wp_generate_password(32, false);
            $wpdb->insert(
                $table_name,
                [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'message' => $message,
                    'status' => 'subscribed',
                    'source' => 'contact_form',
                    'unsubscribe_token' => $unsubscribe_token,
                    'ip_address' => $ip_address,
                    'signup_date' => current_time('mysql', 1)
                ],
                ['%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s']
            );
            design55_send_newsletter_confirmation_email($email, $name, $unsubscribe_token);
        } elseif ($existing_subscriber->status === 'unsubscribed') {
            // Resubscribe via contact form
            $unsubscribe_token = wp_generate_password(32, false);
            $wpdb->update(
                $table_name,
                [
                    'status' => 'subscribed',
                    'name' => $name,
                    'phone' => $phone,
                    'message' => $message,
                    'unsubscribe_token' => $unsubscribe_token,
                    'signup_date' => current_time('mysql', 1),
                    'source' => 'contact_form',
                    'ip_address' => $ip_address
                ],
                ['id' => $existing_subscriber->id],
                ['%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'],
                ['%d']
            );
            design55_send_newsletter_confirmation_email($email, $name, $unsubscribe_token);
        }
    }

    // Redirect with success message
    wp_safe_redirect(add_query_arg('contact_sent', 'success', wp_get_referer()));
    exit;
}

// Simple newsletter signup handler (for shortcode forms)
function design55_handle_simple_newsletter_signup() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';

    if (!isset($_POST['ns_signup_nonce']) || !wp_verify_nonce($_POST['ns_signup_nonce'], 'ns_signup')) {
        return;
    }

    if (empty($_POST['ns_email']) || !is_email($_POST['ns_email'])) {
        wp_die('Please enter a valid email.');
    }

    $email = sanitize_email($_POST['ns_email']);
    $ip_address = design55_get_user_ip();

    // Ensure table exists
    design55_create_unified_subscribers_table();

    // Check for existing subscriber
    $existing_subscriber = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_name WHERE email = %s",
        $email
    ));

    if (!$existing_subscriber) {
        // New subscriber
        $unsubscribe_token = wp_generate_password(32, false);
        $wpdb->insert(
            $table_name,
            [
                'email' => $email,
                'status' => 'subscribed',
                'source' => 'shortcode',
                'unsubscribe_token' => $unsubscribe_token,
                'ip_address' => $ip_address,
                'signup_date' => current_time('mysql', 1)
            ],
            ['%s', '%s', '%s', '%s', '%s', '%s']
        );
        design55_send_newsletter_confirmation_email($email, '', $unsubscribe_token);
        design55_send_admin_notification($email, '', 'Newsletter Signup', 'shortcode');
    } elseif ($existing_subscriber->status === 'unsubscribed') {
        // Resubscribe
        $unsubscribe_token = wp_generate_password(32, false);
        $wpdb->update(
            $table_name,
            [
                'status' => 'subscribed',
                'unsubscribe_token' => $unsubscribe_token,
                'signup_date' => current_time('mysql', 1),
                'source' => 'shortcode',
                'ip_address' => $ip_address
            ],
            ['id' => $existing_subscriber->id],
            ['%s', '%s', '%s', '%s', '%s'],
            ['%d']
        );
        design55_send_newsletter_confirmation_email($email, $existing_subscriber->name ?: '', $unsubscribe_token);
        design55_send_admin_notification($email, $existing_subscriber->name ?: '', 'Newsletter Resubscription', 'shortcode');
    }

    wp_safe_redirect(add_query_arg('ns_signup', 'success', wp_get_referer()));
    exit;
}
// Register all form handlers
add_action('wp_ajax_newsletter_signup', 'design55_handle_newsletter_signup');
add_action('wp_ajax_nopriv_newsletter_signup', 'design55_handle_newsletter_signup');
add_action('init', 'design55_handle_simple_newsletter_signup');
add_action('init', 'design55_handle_contact_form');

// Create table on theme activation
add_action('after_switch_theme', 'design55_create_unified_subscribers_table');

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
    ], site_url('/'));

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
    wp_mail($email, $subject, $message, $headers);
}

/**
 * Sends admin notification for new signups/contacts
 *
 * @param string $email User's email.
 * @param string $name User's name.
 * @param string $type Type of notification.
 * @param string $source Source of signup.
 */
function design55_send_admin_notification($email, $name, $type, $source) {
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');
    
    $subject = $site_name . ' - ' . $type . ' (' . ucfirst($source) . ')';
    
    $message_lines = [
        "New " . strtolower($type) . " on " . $site_name,
        "",
        "Details:",
        "Name: " . ($name ?: 'Not provided'),
        "Email: " . $email,
        "Source: " . ucfirst($source),
        "Date: " . current_time('F j, Y g:i a'),
        "",
        "View all subscribers in your WordPress admin area."
    ];
    
    $message = implode("\r\n", $message_lines);
    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    
    wp_mail($admin_email, $subject, $message, $headers);
}

/**
 * Sends contact form email to admin
 *
 * @param string $name User's name.
 * @param string $email User's email.
 * @param string $phone User's phone.
 * @param string $message User's message.
 */
function design55_send_contact_form_email($name, $email, $phone, $message) {
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');
    
    $subject = $site_name . ' - New Contact Form Submission';
    
    $email_body = [
        "New contact form submission from " . $site_name,
        "",
        "Contact Details:",
        "Name: " . $name,
        "Email: " . $email,
        "Phone: " . ($phone ?: 'Not provided'),
        "",
        "Message:",
        $message,
        "",
        "Date: " . current_time('F j, Y g:i a'),
        "",
        "Reply directly to this email to respond to the inquiry."
    ];
    
    $email_content = implode("\r\n", $email_body);
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>'
    ];
    
    wp_mail($admin_email, $subject, $email_content, $headers);
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


/**
 * Load environment variables from .env file
 */
function design55_load_env() {
    $env_file = get_template_directory() . '/.env';
    if (file_exists($env_file)) {
        $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, '#') === 0) continue; // Skip comments
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                if (!getenv($key)) {
                    putenv("$key=$value");
                }
            }
        }
    }
}
// Load environment variables early
add_action('init', 'design55_load_env', 1);





/**
 * Add CORS headers for development and testing
 * WARNING: These are permissive settings for development only!
 * For production, restrict the Access-Control-Allow-Origin to specific domains.
 */
function design55_add_cors_headers() {
    // Allow requests from any origin (development only)
    header('Access-Control-Allow-Origin: *');
    
    // Allow specific HTTP methods
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE, PATCH');
    
    // Allow specific headers
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, X-WP-Nonce');
    
    // Allow credentials to be sent with requests
    header('Access-Control-Allow-Credentials: true');
    
    // Set max age for preflight requests (24 hours)
    header('Access-Control-Max-Age: 86400');
    
    // Handle preflight OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        // Return 200 status for OPTIONS requests
        status_header(200);
        exit();
    }
}
// Add CORS headers early in the process
add_action('init', 'design55_add_cors_headers', 0);

// Also add CORS headers specifically for AJAX requests
add_action('wp_ajax_newsletter_signup', 'design55_add_ajax_cors_headers', 1);
add_action('wp_ajax_nopriv_newsletter_signup', 'design55_add_ajax_cors_headers', 1);

function design55_add_ajax_cors_headers() {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, X-Requested-With, X-WP-Nonce');
    header('Access-Control-Allow-Credentials: true');
}


/**
 * Updated newsletter signup shortcode - now uses unified system
 */
function design55_render_newsletter_form($atts) {
    ob_start();
    $success = isset($_GET['ns_signup']) && $_GET['ns_signup'] === 'success';
    ?>
    <div class="ns-signup-wrapper">
        <?php if ($success): ?>
            <p class="ns-thanks">🎉 Thanks for signing up! Check your inbox for confirmation.</p>
        <?php endif; ?>

        <h2>GET THE LATEST</h2>
        <p class="ns-sub">…design tips, trends, and our favorite home products straight to your inbox!</p>

        <form method="post" class="ns-form">
            <?php wp_nonce_field('ns_signup', 'ns_signup_nonce'); ?>
            <input
                type="email"
                name="ns_email"
                class="ns-input"
                placeholder="Email Address"
                required
            />
            <button type="submit" class="ns-submit">SIGN UP</button>
        </form>

        <div class="ns-social">
            <a href="https://instagram.com/yourprofile" target="_blank" rel="noopener">
                <span class="dashicons dashicons-instagram"></span>
            </a>
            <a href="https://facebook.com/yourpage" target="_blank" rel="noopener">
                <span class="dashicons dashicons-facebook"></span>
            </a>
            <a href="https://pinterest.com/yourprofile" target="_blank" rel="noopener">
                <span class="dashicons dashicons-pinterest"></span>
            </a>
            <a href="https://medium.com/@yourprofile" target="_blank" rel="noopener">
                <span class="dashicons dashicons-edit"></span>
            </a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('newsletter_signup', 'design55_render_newsletter_form');

?>