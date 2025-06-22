<?php
/*
Template Name: General Page (Info + Image)
*/
get_header(); ?>

<main id="primary" class="site-main">
    <section class="info-image-section">
        <div class="info-image-container">
            <div class="info-image-text">
                <h1>Luxury, Crafted For You</h1>
                <p>
                    Our approach combines artistry, attention to detail, and premium materials to deliver results that are truly one-of-a-kind. 
                    Every project begins with listening and ends with your dream made real.
                </p>
                <ul>
                    <li>Personalized, collaborative design</li>
                    <li>Flawless project management</li>
                    <li>Dedicated to long-term value</li>
                </ul>
                <a href="/contact" class="cta-button">Start Your Consultation</a>
            </div>
            <div class="info-image-photo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/showcase.jpg" alt="Luxury kitchen project" />
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
