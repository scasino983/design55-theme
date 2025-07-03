Anywhere in PHP you can now do:

php
Copy
Edit
global $wpdb;
$table = $wpdb->prefix . 'newsletter_signups';
$subs  = $wpdb->get_col( "SELECT email FROM {$table} ORDER BY date DESC" );
// $subs is now a simple array of all signed-up emails
You can export that to CSV, feed it into Mailchimp/Mautic/SendGrid, etc.