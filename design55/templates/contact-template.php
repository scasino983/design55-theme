<?php
/*
Template Name: Contact
*/
get_header(); ?>

<main id="main-content" class="site-main">

    <section class="hero-section design55-page-hero">
        <div class="hero-img-wrapper">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/dining.webp'); ?>" alt="<?php esc_attr_e('Dining area background', 'design55'); ?>" class="hero-img object-position-custom" />
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-content">
            <h1 class="hero-title">
                <?php esc_html_e('Get In Touch', 'design55'); // Placeholder Title - Or use the_title() if preferred ?>
            </h1>
            <div class="hero-subtitle">
                <?php // If using the_content() for hero subtitle, it would go here. For now, hardcoded.
                      // the_content(); // Example if you want WP editor content here.
                      esc_html_e("We're here to help and answer any question you might have.", 'design55');
                ?>
            </div>
            <?php /* <a href="#" class="btn"> <?php esc_html_e('Learn More', 'design55'); ?> </a> */ ?>
        </div>
    </section>

    <div class="contact-page-content-wrapper container">
        <div class="contact-layout-flex">
            <div class="contact-details-column">
                <h2><?php esc_html_e('Contact Information', 'design55'); ?></h2>
                <address>
                    <strong><?php esc_html_e('Design55 Studios', 'design55'); ?></strong><br>
                    <?php esc_html_e('123 Design Drive', 'design55'); ?><br>
                    <?php esc_html_e('Boise, ID 83702', 'design55'); ?><br>
                    <abbr title="<?php esc_attr_e('Phone', 'design55'); ?>"><?php esc_html_e('P:', 'design55'); ?></abbr> <a href="tel:+12085551234">(208) 555-1234</a><br>
                    <abbr title="<?php esc_attr_e('Email', 'design55'); ?>"><?php esc_html_e('E:', 'design55'); ?></abbr> <a href="mailto:hello@design55.example.com">hello@design55.example.com</a>
                </address>

                <h3><?php esc_html_e('Business Hours', 'design55'); ?></h3>
                <p>
                    <?php esc_html_e('Monday - Friday: 9:00 AM - 5:00 PM', 'design55'); ?><br>
                    <?php esc_html_e('Saturday - Sunday: By Appointment Only', 'design55'); ?>
                </p>

                <h3><?php esc_html_e('Areas Served', 'design55'); ?></h3>
                <p><?php esc_html_e('Serving Boise, Meridian, Eagle, and surrounding communities in the Treasure Valley.', 'design55'); ?></p>
            </div>

            <div class="contact-form-column">
                <?php
                // This already has an H2 "Contact" inside it if using the fallback, or from CF7.
                // If not, you might want to add an H2 here like "Send us a Message".
                get_template_part('template-parts/contact-form');
                ?>
            </div>
        </div>
    </div>

    <section class="map-placeholder-section">
        <div class="container">
            <h2 class="map-title"><?php esc_html_e('Find Us', 'design55'); ?></h2>
            <div class="map-placeholder">
                <!-- Google Maps embed code or image placeholder for Boise, ID area goes here -->
                <p><?php esc_html_e('Map of Boise, ID area will be displayed here. Please add your map embed code or a static map image.', 'design55'); ?></p>
                <?php // Example: <iframe src="YOUR_GOOGLE_MAP_EMBED_URL" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe> ?>
            </div>
        </div>
    </section>

    <?php // The CTA row section was here, decide if it's still needed or where it should go.
          // For now, I'm removing it to match the Chie Design example more closely.
          // If needed, it can be re-added:
    /*
    <section class="cta-row">
        <div class="container">
            <?php get_template_part('template-parts/cta-projects'); ?>
        </div>
    </section>
    */
    ?>
</main>

<?php get_footer(); ?>
