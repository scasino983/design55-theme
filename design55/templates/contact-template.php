<?php
/*
Template Name: Contact
*/
get_header(); ?>

<main id="primary" class="site-main">
    <section class="contact-hero">
        <div class="container">
            <h1 class="contact-title">Contact Us</h1>
            <p class="contact-subtitle">
                Let’s discuss your vision. We’re here to guide you through every step of your next project—personal, luxurious, and always bespoke.
            </p>
        </div>
    </section>

    <section class="contact-form-section">
        <div class="container">
            <?php 
            // Use your custom contact template part or shortcode here:
            get_template_part('template-parts/contact-form');
            ?>
        </div>
    </section>

    <section class="cta-row">
        <div class="container">
            <?php 
            // Optionally drop in a CTA after the form:
            get_template_part('template-parts/cta-projects');
            ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
